import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const MODEL_PATH = '/models/avatar.glb';

const config = {
    targetHeight: 4.35,
    cameraDistance: 4.05,
    cameraHeightOffset: 0.62,
    headYaw: 0.34,
    headPitch: 0.20,
    trackingLerp: 0.075,
    modelTurn: 0.14,
};

function clamp(value, min, max) {
    return Math.max(min, Math.min(max, value));
}

function findFirstBone(root, tests) {
    let match = null;
    root.traverse((node) => {
        if (match || !node.isBone) return;
        const name = node.name.toLowerCase();
        if (tests.some((test) => test(name))) match = node;
    });
    return match;
}

function findArmBone(root, side) {
    const sideTests = side === 'left'
        ? [(name) => name.includes('left'), (name) => name.includes('_l'), (name) => name.startsWith('l'), (name) => name.includes('.l')]
        : [(name) => name.includes('right'), (name) => name.includes('_r'), (name) => name.startsWith('r'), (name) => name.includes('.r')];

    let fallback = null;
    let upper = null;

    root.traverse((node) => {
        if (!node.isBone) return;
        const name = node.name.toLowerCase();
        const isSide = sideTests.some((test) => test(name));
        const isArm = name.includes('arm') || name.includes('shoulder') || name.includes('upperarm');
        const isForearm = name.includes('fore') || name.includes('lower') || name.includes('hand') || name.includes('wrist');
        if (!isSide || !isArm || isForearm) return;
        fallback = fallback || node;
        if (name.includes('upper')) upper = node;
    });

    return upper || fallback;
}

function webglAvailable() {
    try {
        const canvas = document.createElement('canvas');
        return !!(window.WebGLRenderingContext && (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')));
    } catch {
        return false;
    }
}

function initAvatar() {
    const container = document.getElementById('avatar-3d-canvas-container');
    const canvas = document.getElementById('avatar-canvas');
    if (!container || !canvas) return;

    const fallback = container.querySelector('.avatar-3d-fallback');
    const fallbackText = fallback ? fallback.querySelector('span') : null;

    if (!webglAvailable()) {
        if (fallbackText) fallbackText.textContent = '3D is not supported on this device.';
        return;
    }

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(29, 1, 0.01, 100);
    const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha: true,
        antialias: true,
        powerPreference: 'high-performance',
    });

    renderer.setClearColor(0x000000, 0);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, window.innerWidth < 760 ? 1.35 : 1.8));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.15;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    scene.add(new THREE.HemisphereLight(0xeafff4, 0x322716, 1.45));

    const key = new THREE.DirectionalLight(0xfff3df, 2.7);
    key.position.set(2.8, 5.5, 4.2);
    key.castShadow = true;
    key.shadow.mapSize.set(1536, 1536);
    scene.add(key);

    const rim = new THREE.DirectionalLight(0x83b8ff, 1.8);
    rim.position.set(-4.4, 2.2, -2.4);
    scene.add(rim);

    const fill = new THREE.DirectionalLight(0x7ee0b2, 0.9);
    fill.position.set(3, 1.5, -3);
    scene.add(fill);

    const floor = new THREE.Mesh(
        new THREE.CircleGeometry(1.5, 64),
        new THREE.ShadowMaterial({ opacity: 0.24 })
    );
    floor.rotation.x = -Math.PI / 2;
    floor.position.y = 0.01;
    floor.receiveShadow = true;
    scene.add(floor);

    const state = {
        model: null,
        head: null,
        neck: null,
        headBase: null,
        neckBase: null,
        target: new THREE.Vector2(0, 0),
        current: new THREE.Vector2(0, 0),
        pointerActive: false,
    };

    function resize() {
        const width = Math.max(1, container.clientWidth);
        const height = Math.max(1, container.clientHeight);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height, false);
    }

    function frameModel(model) {
        const box = new THREE.Box3().setFromObject(model);
        const size = box.getSize(new THREE.Vector3());
        const center = box.getCenter(new THREE.Vector3());

        model.position.sub(center);
        model.position.y -= box.min.y - center.y;

        const scale = config.targetHeight / Math.max(size.y, 0.001);
        model.scale.setScalar(scale);

        const framedBox = new THREE.Box3().setFromObject(model);
        const framedSize = framedBox.getSize(new THREE.Vector3());
        const framedCenter = framedBox.getCenter(new THREE.Vector3());

        floor.scale.setScalar(Math.max(0.9, framedSize.x * 0.62));
        floor.position.y = 0;

        camera.position.set(0, framedCenter.y + config.cameraHeightOffset, config.cameraDistance);
        camera.lookAt(0, framedCenter.y + 0.62, 0);
    }

    function poseArms(model) {
        const leftArm = findArmBone(model, 'left');
        const rightArm = findArmBone(model, 'right');

        if (leftArm) {
            leftArm.rotation.z += 0.92;
            leftArm.rotation.x += 0.10;
            leftArm.rotation.y -= 0.08;
        }
        if (rightArm) {
            rightArm.rotation.z -= 0.92;
            rightArm.rotation.x += 0.10;
            rightArm.rotation.y += 0.08;
        }
    }

    function setupTracking(model) {
        state.head = findFirstBone(model, [
            (name) => name.includes('head') && !name.includes('top') && !name.includes('end'),
            (name) => name === 'mixamorighead',
        ]);
        state.neck = findFirstBone(model, [
            (name) => name.includes('neck'),
            (name) => name.includes('spine2'),
        ]);

        if (state.head) state.headBase = state.head.quaternion.clone();
        if (state.neck) state.neckBase = state.neck.quaternion.clone();
    }

    resize();

    const loader = new GLTFLoader();
    loader.load(
        MODEL_PATH,
        (gltf) => {
            const model = gltf.scene;
            model.rotation.y = 0;

            model.traverse((node) => {
                if (!node.isMesh) return;
                node.castShadow = true;
                node.receiveShadow = true;
                if (node.material) {
                    node.material.envMapIntensity = 0.85;
                    node.material.needsUpdate = true;
                }
            });

            poseArms(model);
            setupTracking(model);
            frameModel(model);
            scene.add(model);
            state.model = model;

            if (fallback) fallback.style.display = 'none';
        },
        (event) => {
            if (!fallbackText || !event.lengthComputable) return;
            fallbackText.textContent = `Loading 3D avatar... ${Math.round((event.loaded / event.total) * 100)}%`;
        },
        () => {
            if (fallbackText) fallbackText.textContent = 'Could not load 3D avatar.';
        }
    );

    container.addEventListener('pointermove', (event) => {
        const rect = container.getBoundingClientRect();
        const x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        const y = -(((event.clientY - rect.top) / rect.height) * 2 - 1);
        state.target.set(clamp(x, -1, 1), clamp(y, -1, 1));
        state.pointerActive = true;
    });

    container.addEventListener('pointerleave', () => {
        state.pointerActive = false;
    });

    window.addEventListener('resize', resize);
    if (typeof ResizeObserver !== 'undefined') {
        new ResizeObserver(resize).observe(container);
    }

    const euler = new THREE.Euler(0, 0, 0, 'YXZ');
    const lookQuat = new THREE.Quaternion();
    const targetQuat = new THREE.Quaternion();

    function render() {
        requestAnimationFrame(render);

        const desiredX = state.pointerActive ? state.target.x : 0;
        const desiredY = state.pointerActive ? state.target.y : 0;
        state.current.x += (desiredX - state.current.x) * config.trackingLerp;
        state.current.y += (desiredY - state.current.y) * config.trackingLerp;

        if (state.model) {
            const targetTurn = state.head ? state.current.x * 0.035 : state.current.x * config.modelTurn;
            const targetPitch = state.head ? 0 : state.current.y * -0.045;
            state.model.rotation.y += (targetTurn - state.model.rotation.y) * 0.045;
            state.model.rotation.x += (targetPitch - state.model.rotation.x) * 0.045;
        }

        if (state.head && state.headBase) {
            euler.set(
                state.current.y * config.headPitch,
                state.current.x * config.headYaw,
                0,
                'YXZ'
            );
            lookQuat.setFromEuler(euler);
            targetQuat.copy(state.headBase).multiply(lookQuat);
            state.head.quaternion.slerp(targetQuat, 0.16);
        }

        if (state.neck && state.neckBase) {
            euler.set(
                state.current.y * config.headPitch * 0.35,
                state.current.x * config.headYaw * 0.35,
                0,
                'YXZ'
            );
            lookQuat.setFromEuler(euler);
            targetQuat.copy(state.neckBase).multiply(lookQuat);
            state.neck.quaternion.slerp(targetQuat, 0.12);
        }

        renderer.render(scene, camera);
    }

    render();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAvatar);
} else {
    initAvatar();
}
