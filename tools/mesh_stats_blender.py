from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar.glb"

bpy.ops.object.select_all(action="SELECT")
bpy.ops.object.delete()
bpy.ops.import_scene.gltf(filepath=str(SOURCE))

mesh = next(obj for obj in bpy.context.scene.objects if obj.type == "MESH" and obj.name.startswith("char"))
bpy.ops.object.select_all(action="DESELECT")
mesh.select_set(True)
bpy.context.view_layer.objects.active = mesh
bpy.ops.object.transform_apply(location=False, rotation=False, scale=True)

verts = [v.co.copy() for v in mesh.data.vertices]
mins = [min(getattr(v, axis) for v in verts) for axis in "xyz"]
maxs = [max(getattr(v, axis) for v in verts) for axis in "xyz"]
print("[mesh-stats] bbox", tuple(round(v, 4) for v in mins), tuple(round(v, 4) for v in maxs))

for threshold in [0.18, 0.24, 0.30, 0.36, 0.42, 0.48]:
    left = [v for v in verts if v.x < -threshold]
    right = [v for v in verts if v.x > threshold]
    for label, group in [("left", left), ("right", right)]:
        if not group:
            continue
        gmins = [min(getattr(v, axis) for v in group) for axis in "xyz"]
        gmaxs = [max(getattr(v, axis) for v in group) for axis in "xyz"]
        print(
            f"[mesh-stats] {label} x>{threshold}: count={len(group)} "
            f"bbox={tuple(round(v, 4) for v in gmins)} {tuple(round(v, 4) for v in gmaxs)}"
        )
