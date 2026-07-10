from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar-before-static-deform.glb"
OUTPUT = ROOT / "public" / "models" / "avatar-body-noarms.glb"


def in_arm_region(co):
    x_abs = abs(co.x)
    if x_abs < 0.245:
        return False
    if co.y < 0.58 or co.y > 1.04:
        return False
    return True


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
    removed = 0
    for polygon in mesh.polygons:
        arm_votes = sum(1 for vertex_index in polygon.vertices if in_arm_region(mesh.vertices[vertex_index].co))
        if arm_votes >= max(1, len(polygon.vertices) // 2):
            polygon.select = True
            removed += 1

    bpy.ops.object.mode_set(mode="EDIT")
    bpy.ops.mesh.delete(type="FACE")
    bpy.ops.object.mode_set(mode="OBJECT")
    mesh.update()

    for obj in list(bpy.context.scene.objects):
        if obj != character:
            bpy.data.objects.remove(obj, do_unlink=True)

    bpy.ops.object.select_all(action="DESELECT")
    character.select_set(True)
    bpy.context.view_layer.objects.active = character
    bpy.ops.export_scene.gltf(
        filepath=str(OUTPUT),
        export_format="GLB",
        use_selection=True,
        export_materials="EXPORT",
        export_animations=False,
    )
    print(f"[prepare-avatar-body] Removed {removed} arm faces and exported {OUTPUT}")


if __name__ == "__main__":
    main()
