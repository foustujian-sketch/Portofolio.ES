from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar-before-static-deform.glb"


bpy.ops.object.select_all(action="SELECT")
bpy.ops.object.delete()
bpy.ops.import_scene.gltf(filepath=str(SOURCE))

mesh = next(obj for obj in bpy.context.scene.objects if obj.type == "MESH" and obj.name.startswith("char"))
bpy.ops.object.select_all(action="DESELECT")
mesh.select_set(True)
bpy.context.view_layer.objects.active = mesh
bpy.ops.object.transform_apply(location=False, rotation=False, scale=True)

for slot_index, slot in enumerate(mesh.material_slots):
    polys = [poly for poly in mesh.data.polygons if poly.material_index == slot_index]
    if not polys:
        continue

    vertex_indices = {index for poly in polys for index in poly.vertices}
    verts = [mesh.data.vertices[index].co for index in vertex_indices]
    mins = tuple(round(min(getattr(v, axis) for v in verts), 4) for axis in "xyz")
    maxs = tuple(round(max(getattr(v, axis) for v in verts), 4) for axis in "xyz")
    print(
        f"[material-stats] {slot_index}: {slot.name} "
        f"polys={len(polys)} bbox={mins} {maxs}"
    )
