from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar.glb"


def log(message):
    print(f"[inspect-avatar] {message}")


bpy.ops.object.select_all(action="SELECT")
bpy.ops.object.delete()
bpy.ops.import_scene.gltf(filepath=str(SOURCE))

for obj in bpy.context.scene.objects:
    log(
        f"object={obj.name} type={obj.type} parent={obj.parent.name if obj.parent else '-'} "
        f"children={len(obj.children)} modifiers={[m.type for m in getattr(obj, 'modifiers', [])]} "
        f"groups={len(getattr(obj, 'vertex_groups', [])) if obj.type == 'MESH' else '-'} "
        f"loc={tuple(round(v, 3) for v in obj.location)} "
        f"scale={tuple(round(v, 3) for v in obj.scale)} "
        f"dims={tuple(round(v, 3) for v in obj.dimensions)}"
    )

armatures = [obj for obj in bpy.context.scene.objects if obj.type == "ARMATURE"]
for armature in armatures:
    log(f"armature={armature.name} bones={[bone.name for bone in armature.data.bones]}")
    for name in ["Hips", "Spine", "LeftArm", "RightArm", "Head"]:
        bone = armature.data.bones.get(name)
        if bone:
            log(
                f"bone={name} head={tuple(round(v, 3) for v in bone.head_local)} "
                f"tail={tuple(round(v, 3) for v in bone.tail_local)}"
            )
