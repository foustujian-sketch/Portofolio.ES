from pathlib import Path
from collections import defaultdict, deque

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar-relaxed.glb"
OUTPUT = ROOT / "public" / "models" / "avatar-headsplit.glb"

NECK_PIVOT = (0.0, 1.04, 0.02)


def log(message):
    print(f"[split-avatar] {message}")


def main():
    bpy.ops.object.select_all(action="SELECT")
    bpy.ops.object.delete()
    bpy.ops.import_scene.gltf(filepath=str(SOURCE))

    character = next(
        obj for obj in bpy.context.scene.objects
        if obj.type == "MESH" and obj.name.startswith("char")
    )

    bpy.ops.object.select_all(action="DESELECT")
    character.select_set(True)
    bpy.context.view_layer.objects.active = character
    bpy.ops.object.transform_apply(location=False, rotation=False, scale=True)

    bpy.ops.object.mode_set(mode="EDIT")
    bpy.ops.mesh.select_mode(type="FACE")
    bpy.ops.mesh.select_all(action="DESELECT")
    bpy.ops.object.mode_set(mode="OBJECT")

    mesh = character.data
    vertex_to_polys = defaultdict(list)
    for polygon in mesh.polygons:
        for vertex_index in polygon.vertices:
            vertex_to_polys[vertex_index].append(polygon.index)

    neighbors = defaultdict(set)
    for poly_indices in vertex_to_polys.values():
        for poly_index in poly_indices:
            neighbors[poly_index].update(poly_indices)

    remaining = set(polygon.index for polygon in mesh.polygons)
    selected_polygons = set()
    while remaining:
        start = remaining.pop()
        queue = deque([start])
        component = [start]

        while queue:
            poly_index = queue.popleft()
            for neighbor_index in neighbors[poly_index]:
                if neighbor_index in remaining:
                    remaining.remove(neighbor_index)
                    queue.append(neighbor_index)
                    component.append(neighbor_index)

        vertex_indices = {
            vertex_index
            for poly_index in component
            for vertex_index in mesh.polygons[poly_index].vertices
        }
        verts = [mesh.vertices[index].co for index in vertex_indices]
        min_x = min(vertex.x for vertex in verts)
        max_x = max(vertex.x for vertex in verts)
        min_y = min(vertex.y for vertex in verts)
        max_y = max(vertex.y for vertex in verts)
        center_y = (min_y + max_y) * 0.5

        is_head_island = (
            min_y > 0.89
            and max_y > 1.0
            and center_y > 1.0
            and (max_x - min_x) < 0.72
        )
        if is_head_island:
            selected_polygons.update(component)

    if not selected_polygons:
        raise RuntimeError("No head islands matched the split rules.")

    for polygon in mesh.polygons:
        polygon.select = polygon.index in selected_polygons

    before = set(bpy.context.scene.objects)
    bpy.ops.object.mode_set(mode="EDIT")
    bpy.ops.mesh.separate(type="SELECTED")
    bpy.ops.object.mode_set(mode="OBJECT")
    after = set(bpy.context.scene.objects)

    created = list(after - before)
    if not created:
        raise RuntimeError("Head separation did not create a new object.")

    head = created[0]
    body = next(obj for obj in bpy.context.scene.objects if obj.type == "MESH" and obj != head)
    head.name = "AvatarHead"
    head.data.name = "AvatarHeadMesh"
    body.name = "AvatarBody"
    body.data.name = "AvatarBodyMesh"

    bpy.ops.object.select_all(action="DESELECT")
    bpy.context.scene.cursor.location = NECK_PIVOT
    head.select_set(True)
    bpy.context.view_layer.objects.active = head
    bpy.ops.object.origin_set(type="ORIGIN_CURSOR", center="MEDIAN")

    bpy.ops.object.select_all(action="SELECT")
    bpy.ops.export_scene.gltf(
        filepath=str(OUTPUT),
        export_format="GLB",
        export_materials="EXPORT",
        export_animations=False,
    )
    log(f"Exported head-split avatar to {OUTPUT}")


if __name__ == "__main__":
    main()
