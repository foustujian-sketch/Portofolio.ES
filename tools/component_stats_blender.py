from collections import defaultdict, deque
from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar-before-static-deform.glb"


bpy.ops.object.select_all(action="SELECT")
bpy.ops.object.delete()
bpy.ops.import_scene.gltf(filepath=str(SOURCE))

mesh_obj = next(obj for obj in bpy.context.scene.objects if obj.type == "MESH" and obj.name.startswith("char"))
bpy.ops.object.select_all(action="DESELECT")
mesh_obj.select_set(True)
bpy.context.view_layer.objects.active = mesh_obj
bpy.ops.object.transform_apply(location=False, rotation=False, scale=True)

mesh = mesh_obj.data
vertex_to_polys = defaultdict(list)
for poly in mesh.polygons:
    for vertex_index in poly.vertices:
        vertex_to_polys[vertex_index].append(poly.index)

neighbors = defaultdict(set)
for poly_indices in vertex_to_polys.values():
    for poly_index in poly_indices:
        neighbors[poly_index].update(poly_indices)

remaining = set(poly.index for poly in mesh.polygons)
components = []
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
    mins = tuple(round(min(getattr(v, axis) for v in verts), 4) for axis in "xyz")
    maxs = tuple(round(max(getattr(v, axis) for v in verts), 4) for axis in "xyz")
    center = tuple(round((mins[i] + maxs[i]) / 2, 4) for i in range(3))
    components.append((len(component), mins, maxs, center))

for index, (poly_count, mins, maxs, center) in enumerate(sorted(components, reverse=True)[:40]):
    print(
        f"[component-stats] {index}: polys={poly_count} "
        f"bbox={mins} {maxs} center={center}"
    )
