import math
import sys
from pathlib import Path

import bpy


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar.glb"
OUTPUT = ROOT / "public" / "models" / "avatar-repaired.glb"


def log(message):
    print(f"[repair-avatar] {message}")


def clear_scene():
    bpy.ops.object.select_all(action="SELECT")
    bpy.ops.object.delete()


def import_glb(path):
    bpy.ops.import_scene.gltf(filepath=str(path))
    meshes = [obj for obj in bpy.context.scene.objects if obj.type == "MESH"]
    armatures = [obj for obj in bpy.context.scene.objects if obj.type == "ARMATURE"]
    if not meshes:
        raise RuntimeError("No mesh object found in GLB.")
    if not armatures:
        raise RuntimeError("No armature object found in GLB.")
    log(f"Imported {len(meshes)} mesh object(s), {len(armatures)} armature(s).")
    return meshes, armatures[0]


def auto_weight(meshes, armature):
    bpy.ops.object.mode_set(mode="OBJECT") if bpy.context.object else None

    for mesh in meshes:
        mesh.select_set(False)
        for modifier in list(mesh.modifiers):
            if modifier.type == "ARMATURE":
                mesh.modifiers.remove(modifier)
        mesh.vertex_groups.clear()

    bpy.ops.object.select_all(action="DESELECT")
    for mesh in meshes:
        mesh.select_set(True)
    armature.select_set(True)
    bpy.context.view_layer.objects.active = armature

    bpy.ops.object.parent_set(type="ARMATURE_AUTO")
    log("Applied Armature Deform with automatic weights.")


def set_pose_bone(pose_bone, xyz_degrees):
    pose_bone.rotation_mode = "XYZ"
    pose_bone.rotation_euler = tuple(math.radians(value) for value in xyz_degrees)


def pose_character(armature):
    bpy.context.view_layer.objects.active = armature
    armature.select_set(True)
    bpy.ops.object.mode_set(mode="POSE")

    bones = armature.pose.bones

    # Meshy biped bones are exported in a broad T-pose. These values create
    # a simple relaxed A-pose, with elbows slightly bent forward.
    pose_map = {
        "LeftShoulder": (0, 0, 8),
        "RightShoulder": (0, 0, -8),
        "LeftArm": (0, 0, 72),
        "RightArm": (0, 0, -72),
        "LeftForeArm": (0, 0, 12),
        "RightForeArm": (0, 0, -12),
        "LeftHand": (0, 0, 4),
        "RightHand": (0, 0, -4),
    }

    applied = []
    for name, euler in pose_map.items():
        if name in bones:
            set_pose_bone(bones[name], euler)
            applied.append(name)

    bpy.context.view_layer.update()
    log(f"Applied pose to: {', '.join(applied) if applied else 'no matching arm bones'}")

    bpy.ops.pose.select_all(action="SELECT")
    try:
        bpy.ops.pose.armature_apply(selected=False)
        log("Applied current pose as rest pose.")
    except Exception as exc:
        log(f"Could not apply pose as rest pose: {exc}")

    bpy.ops.object.mode_set(mode="OBJECT")


def export_glb(path):
    bpy.ops.object.select_all(action="SELECT")
    bpy.ops.export_scene.gltf(
        filepath=str(path),
        export_format="GLB",
        export_skins=True,
        export_animations=False,
        export_materials="EXPORT",
    )
    log(f"Exported repaired GLB to {path}")


def main():
    if not SOURCE.exists():
        raise RuntimeError(f"Source model not found: {SOURCE}")

    clear_scene()
    meshes, armature = import_glb(SOURCE)
    auto_weight(meshes, armature)
    pose_character(armature)
    export_glb(OUTPUT)


if __name__ == "__main__":
    try:
        main()
    except Exception as exc:
        log(f"FAILED: {exc}")
        sys.exit(1)
