from pathlib import Path

import bpy
from mathutils import Vector


ROOT = Path(r"C:\Users\foust\Portfolio")
SOURCE = ROOT / "public" / "models" / "avatar.glb"


def bounds_for(obj):
    corners = [obj.matrix_world @ Vector(corner) for corner in obj.bound_box]
    mins = tuple(round(min(getattr(corner, axis) for corner in corners), 4) for axis in "xyz")
    maxs = tuple(round(max(getattr(corner, axis) for corner in corners), 4) for axis in "xyz")
    return mins, maxs


bpy.ops.object.select_all(action="SELECT")
bpy.ops.object.delete()
bpy.ops.import_scene.gltf(filepath=str(SOURCE))

for obj in bpy.context.scene.objects:
    if obj.type == "MESH":
        mins, maxs = bounds_for(obj)
        materials = [slot.name for slot in obj.material_slots]
        print(
            f"[active-avatar] object={obj.name} polys={len(obj.data.polygons)} "
            f"bbox={mins} {maxs} materials={materials}"
        )
        for index, slot in enumerate(obj.material_slots):
            polys = [poly for poly in obj.data.polygons if poly.material_index == index]
            if not polys:
                continue
            vertex_indices = {vertex_index for poly in polys for vertex_index in poly.vertices}
            verts = [obj.matrix_world @ obj.data.vertices[vertex_index].co for vertex_index in vertex_indices]
            vmins = tuple(round(min(getattr(vertex, axis) for vertex in verts), 4) for axis in "xyz")
            vmaxs = tuple(round(max(getattr(vertex, axis) for vertex in verts), 4) for axis in "xyz")
            print(
                f"[active-avatar]   material={index}:{slot.name} "
                f"polys={len(polys)} bbox={vmins} {vmaxs}"
            )
    else:
        print(f"[active-avatar] object={obj.name} type={obj.type}")
