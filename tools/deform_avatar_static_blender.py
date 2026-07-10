import math
from pathlib import Path

import bpy
from mathutils import Vector


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar.glb"
OUTPUT = ROOT / "public" / "models" / "avatar-relaxed.glb"


def log(message):
    print(f"[deform-avatar] {message}")


def smoothstep(edge0, edge1, value):
    if edge0 == edge1:
        return 1.0 if value >= edge1 else 0.0
    t = max(0.0, min(1.0, (value - edge0) / (edge1 - edge0)))
    return t * t * (3.0 - 2.0 * t)


def rotate_xy(point, pivot, angle):
    sin_a = math.sin(angle)
    cos_a = math.cos(angle)
    dx = point.x - pivot.x
    dy = point.y - pivot.y
    return Vector((
        pivot.x + dx * cos_a - dy * sin_a,
        pivot.y + dx * sin_a + dy * cos_a,
        point.z,
    ))


def make_arm_rest_pose(point, side, weight):
    x_abs = abs(point.x)
    target_x = side * (0.255 + smoothstep(0.34, 0.78, x_abs) * 0.055)
    target_y = point.y - smoothstep(0.34, 0.78, x_abs) * 0.28
    target_z = point.z + smoothstep(0.46, 0.78, x_abs) * 0.03
    target = Vector((target_x, target_y, target_z))
    return point.lerp(target, weight)


def deform_arms(mesh_obj):
    bpy.ops.object.select_all(action="DESELECT")
    mesh_obj.select_set(True)
    bpy.context.view_layer.objects.active = mesh_obj
    bpy.ops.object.transform_apply(location=False, rotation=False, scale=True)

    mesh = mesh_obj.data
    left_pivot = Vector((-0.34, 0.875, 0.0))
    right_pivot = Vector((0.34, 0.875, 0.0))
    left_angle = math.radians(18)
    right_angle = math.radians(-18)
    changed = 0

    for vertex in mesh.vertices:
        co = vertex.co.copy()
        side = -1 if co.x < 0 else 1
        x_abs = abs(co.x)

        # Arms occupy the middle-height horizontal span. Head/ears/hair are
        # intentionally excluded by the Y band, and jacket torso by the X ramp.
        x_weight = smoothstep(0.30, 0.48, x_abs)
        y_weight = smoothstep(0.68, 0.78, co.y) * (1.0 - smoothstep(1.00, 1.10, co.y))
        weight = x_weight * y_weight

        if weight <= 0.001:
            continue

        pivot = left_pivot if side < 0 else right_pivot
        angle = left_angle if side < 0 else right_angle
        rotated = rotate_xy(co, pivot, angle)
        rested = make_arm_rest_pose(rotated, side, smoothstep(0.38, 0.66, x_abs))
        vertex.co = co.lerp(rested, weight)
        changed += 1

    mesh.update()
    log(f"Deformed {changed} arm vertices.")


def main():
    bpy.ops.object.select_all(action="SELECT")
    bpy.ops.object.delete()
    bpy.ops.import_scene.gltf(filepath=str(SOURCE))

    character = next(
        obj for obj in bpy.context.scene.objects
        if obj.type == "MESH" and obj.name.startswith("char")
    )
    deform_arms(character)

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
    log(f"Exported relaxed static avatar to {OUTPUT}")


if __name__ == "__main__":
    main()
