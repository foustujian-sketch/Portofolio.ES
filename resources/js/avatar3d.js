import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const MODEL_PATH = '/models/avatar-sunny-scholar-safe.glb?v=loading-screen-1';

const config = {
    characterHeight: 2.13,
    cameraDistance: 5.9,
    globeRadius: 1.38,
    upperTurn: 0.38,
    upperPitch: 0.16,
    trackingLerp: 1,
    globeSpin: 0.014,
    armSwing: 0.48,
};

function clamp(value, min, max) {
    return Math.max(min, Math.min(max, value));
}

function smoothstep(edge0, edge1, value) {
    if (edge0 === edge1) return value >= edge1 ? 1 : 0;
    const t = clamp((value - edge0) / (edge1 - edge0), 0, 1);
    return t * t * (3 - 2 * t);
}

function webglAvailable() {
    try {
        const canvas = document.createElement('canvas');
        return !!(window.WebGLRenderingContext && (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')));
    } catch {
        return false;
    }
}

function makeStarTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 64;
    canvas.height = 64;
    const context = canvas.getContext('2d');
    const glow = context.createRadialGradient(32, 32, 0, 32, 32, 32);
    glow.addColorStop(0, 'rgba(255,255,255,1)');
    glow.addColorStop(0.12, 'rgba(255,255,255,0.96)');
    glow.addColorStop(0.36, 'rgba(190,220,255,0.42)');
    glow.addColorStop(1, 'rgba(150,195,255,0)');
    context.fillStyle = glow;
    context.fillRect(0, 0, 64, 64);

    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;
    return texture;
}

function makeStarField() {
    const group = new THREE.Group();
    const twinkles = [];
    const starTexture = makeStarTexture();

    [
        { count: 280, size: 0.036, opacity: 0.54, depth: 5.4, color: 0xbfd8ff, speed: 0.18 },
        { count: 82, size: 0.062, opacity: 0.86, depth: 4.6, color: 0xffffff, speed: 0.34 },
        { count: 18, size: 0.096, opacity: 1, depth: 4, color: 0xffefd2, speed: 0.52 },
    ].forEach((layer, layerIndex) => {
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(layer.count * 3);

        for (let i = 0; i < layer.count; i += 1) {
            positions[i * 3] = THREE.MathUtils.randFloatSpread(7.2);
            positions[i * 3 + 1] = THREE.MathUtils.randFloat(-2.6, 4.1);
            positions[i * 3 + 2] = -4 - Math.random() * layer.depth;
        }

        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

        const material = new THREE.PointsMaterial({
            color: layer.color,
            map: starTexture,
            size: layer.size,
            transparent: true,
            opacity: layer.opacity,
            alphaTest: 0.015,
            depthWrite: false,
            depthTest: true,
            sizeAttenuation: true,
            blending: THREE.AdditiveBlending,
            fog: false,
        });
        const points = new THREE.Points(geometry, material);
        points.renderOrder = -10;
        group.add(points);
        twinkles.push({
            material,
            baseOpacity: layer.opacity,
            speed: layer.speed,
            phase: layerIndex * 1.73,
        });
    });

    const sparkleMaterial = new THREE.SpriteMaterial({
        map: starTexture,
        color: 0xffffff,
        transparent: true,
        opacity: 0.84,
        depthWrite: false,
        depthTest: true,
        blending: THREE.AdditiveBlending,
        fog: false,
    });
    [
        [-2.8, 2.6, -3.6, 0.12],
        [2.6, 3.0, -4.2, 0.09],
        [-1.2, 3.7, -5.2, 0.08],
        [1.7, 1.8, -4.8, 0.07],
        [-3.3, 0.9, -4.1, 0.06],
    ].forEach(([x, y, z, scale]) => {
        const sparkle = new THREE.Sprite(sparkleMaterial.clone());
        sparkle.position.set(x, y, z);
        sparkle.scale.set(scale, scale, 1);
        group.add(sparkle);
        twinkles.push({
            material: sparkle.material,
            baseOpacity: sparkle.material.opacity,
            speed: THREE.MathUtils.randFloat(0.6, 1.15),
            phase: THREE.MathUtils.randFloat(0, Math.PI * 2),
        });
    });

    return { group, twinkles };
}

function updateStarField(twinkles, elapsed) {
    twinkles.forEach((star) => {
        const pulse = 0.82 + Math.sin(elapsed * star.speed + star.phase) * 0.18;
        star.material.opacity = star.baseOpacity * pulse;
    });
}

function makeEarthTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 1024;
    canvas.height = 512;
    const context = canvas.getContext('2d');
    let seed = 7319;
    const random = () => {
        seed = (seed * 16807) % 2147483647;
        return (seed - 1) / 2147483646;
    };

    const ocean = context.createLinearGradient(0, 0, 0, canvas.height);
    ocean.addColorStop(0, '#3aa7c7');
    ocean.addColorStop(0.46, '#1676a6');
    ocean.addColorStop(1, '#0b4f86');
    context.fillStyle = ocean;
    context.fillRect(0, 0, canvas.width, canvas.height);

    context.globalAlpha = 0.12;
    for (let y = 54; y < canvas.height; y += 62) {
        context.fillStyle = y % 124 === 0 ? '#9ee3ef' : '#052d67';
        context.fillRect(0, y, canvas.width, 2);
    }
    for (let i = 0; i < 900; i += 1) {
        const x = random() * canvas.width;
        const y = random() * canvas.height;
        const size = 0.4 + random() * 1.8;
        context.fillStyle = random() > 0.52 ? 'rgba(157,226,239,0.18)' : 'rgba(4,45,91,0.16)';
        context.fillRect(x, y, size, size);
    }
    context.globalAlpha = 1;

    const makePath = (points) => {
        const path = new Path2D();
        const scaled = points.map(([x, y]) => [x * canvas.width, y * canvas.height]);
        const first = scaled[0];
        const last = scaled[scaled.length - 1];
        path.moveTo((last[0] + first[0]) * 0.5, (last[1] + first[1]) * 0.5);
        scaled.forEach((point, index) => {
            const next = scaled[(index + 1) % scaled.length];
            path.quadraticCurveTo(point[0], point[1], (point[0] + next[0]) * 0.5, (point[1] + next[1]) * 0.5);
        });
        path.closePath();
        return path;
    };

    const drawLand = (points, topColor = '#91d45f', bottomColor = '#4e9e45') => {
        const path = makePath(points);
        const ys = points.map(([, y]) => y * canvas.height);
        const minY = Math.min(...ys);
        const maxY = Math.max(...ys);
        const land = context.createLinearGradient(0, minY, 0, maxY);
        land.addColorStop(0, topColor);
        land.addColorStop(1, bottomColor);
        context.fillStyle = land;
        context.fill(path);
        context.strokeStyle = 'rgba(24, 79, 48, 0.7)';
        context.lineWidth = 7;
        context.stroke(path);
        context.strokeStyle = 'rgba(206, 247, 147, 0.32)';
        context.lineWidth = 2.5;
        context.stroke(path);

        const xs = points.map(([x]) => x * canvas.width);
        const minX = Math.min(...xs);
        const maxX = Math.max(...xs);
        context.save();
        context.clip(path);
        for (let i = 0; i < 54; i += 1) {
            const x = minX + random() * (maxX - minX);
            const y = minY + random() * (maxY - minY);
            context.fillStyle = random() > 0.58 ? 'rgba(226,224,112,0.22)' : 'rgba(28,102,49,0.2)';
            context.beginPath();
            context.ellipse(x, y, 7 + random() * 24, 3 + random() * 10, random() * Math.PI, 0, Math.PI * 2);
            context.fill();
        }
        context.restore();
    };

    drawLand([[0.00,0.25],[0.05,0.18],[0.12,0.14],[0.2,0.18],[0.25,0.26],[0.29,0.3],[0.27,0.39],[0.22,0.43],[0.19,0.52],[0.12,0.49],[0.08,0.41],[0.02,0.4]], '#8ed15d', '#4d9944');
    drawLand([[0.2,0.49],[0.27,0.52],[0.32,0.59],[0.34,0.7],[0.31,0.82],[0.27,0.91],[0.23,0.8],[0.2,0.67],[0.17,0.57]], '#89cd5a', '#418f43');
    drawLand([[0.4,0.24],[0.47,0.2],[0.54,0.22],[0.57,0.29],[0.53,0.35],[0.47,0.36],[0.42,0.32]], '#93d265', '#58a34a');
    drawLand([[0.49,0.37],[0.57,0.34],[0.63,0.4],[0.62,0.53],[0.57,0.68],[0.51,0.61],[0.47,0.49]], '#92d265', '#499445');
    drawLand([[0.54,0.21],[0.64,0.17],[0.76,0.19],[0.87,0.24],[0.96,0.31],[0.99,0.42],[0.93,0.48],[0.83,0.44],[0.78,0.49],[0.7,0.43],[0.64,0.35],[0.57,0.31]], '#8dce5d', '#4a9745');
    drawLand([[0.79,0.65],[0.87,0.62],[0.94,0.69],[0.92,0.8],[0.84,0.84],[0.77,0.76]], '#9bd66b', '#579d47');
    drawLand([[0.34,0.08],[0.42,0.06],[0.46,0.13],[0.42,0.21],[0.35,0.18],[0.31,0.12]], '#b3d986', '#76aa61');

    context.fillStyle = '#75ba53';
    [[0.7,0.51,8],[0.73,0.53,5],[0.76,0.55,6],[0.97,0.57,5],[0.15,0.5,5],[0.45,0.34,4]].forEach(([x,y,radius]) => {
        context.beginPath();
        context.ellipse(x * canvas.width, y * canvas.height, radius, radius * 0.55, 0, 0, Math.PI * 2);
        context.fill();
    });

    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;
    texture.anisotropy = 4;
    texture.needsUpdate = true;
    return texture;
}

function makeCloudTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 1024;
    canvas.height = 512;
    const context = canvas.getContext('2d');
    let seed = 1187;
    const random = () => {
        seed = (seed * 48271) % 2147483647;
        return (seed - 1) / 2147483646;
    };

    context.filter = 'blur(5px)';
    for (let band = 0; band < 7; band += 1) {
        const bandY = 56 + band * 66 + random() * 24;
        for (let i = 0; i < 9; i += 1) {
            const x = ((i / 9) * canvas.width + random() * 100 + band * 77) % canvas.width;
            const width = 45 + random() * 96;
            const height = 5 + random() * 14;
            const cloud = context.createRadialGradient(x, bandY, 0, x, bandY, width);
            cloud.addColorStop(0, 'rgba(255,255,255,0.68)');
            cloud.addColorStop(0.45, 'rgba(237,249,255,0.3)');
            cloud.addColorStop(1, 'rgba(255,255,255,0)');
            context.fillStyle = cloud;
            context.beginPath();
            context.ellipse(x, bandY, width, height, random() * 0.45 - 0.22, 0, Math.PI * 2);
            context.fill();
        }
    }
    context.filter = 'none';

    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;
    texture.needsUpdate = true;
    return texture;
}

function makeGlobe() {
    const group = new THREE.Group();
    const earthTexture = makeEarthTexture();

    const ocean = new THREE.Mesh(
        new THREE.SphereGeometry(config.globeRadius, 64, 32),
        new THREE.MeshStandardMaterial({
            color: 0xffffff,
            map: earthTexture,
            roughness: 0.78,
            metalness: 0.02,
            emissive: 0x06213a,
            emissiveIntensity: 0.14,
        })
    );
    ocean.castShadow = true;
    ocean.receiveShadow = true;
    group.add(ocean);

    const clouds = new THREE.Mesh(
        new THREE.SphereGeometry(config.globeRadius * 1.012, 56, 28),
        new THREE.MeshStandardMaterial({
            color: 0xffffff,
            map: makeCloudTexture(),
            transparent: true,
            opacity: 0.42,
            alphaTest: 0.025,
            depthWrite: false,
            roughness: 1,
        })
    );
    clouds.renderOrder = 1;
    group.add(clouds);

    const atmosphere = new THREE.Mesh(
        new THREE.SphereGeometry(config.globeRadius * 1.055, 56, 28),
        new THREE.ShaderMaterial({
            uniforms: {
                glowColor: { value: new THREE.Color(0x8edcff) },
            },
            vertexShader: `
                varying vec3 vNormal;
                varying vec3 vViewDirection;
                void main() {
                    vec4 viewPosition = modelViewMatrix * vec4(position, 1.0);
                    vNormal = normalize(normalMatrix * normal);
                    vViewDirection = normalize(-viewPosition.xyz);
                    gl_Position = projectionMatrix * viewPosition;
                }
            `,
            fragmentShader: `
                uniform vec3 glowColor;
                varying vec3 vNormal;
                varying vec3 vViewDirection;
                void main() {
                    float rim = pow(1.0 - max(dot(vNormal, vViewDirection), 0.0), 2.4);
                    gl_FragColor = vec4(glowColor, rim * 0.62);
                }
            `,
            transparent: true,
            depthWrite: false,
            blending: THREE.AdditiveBlending,
            side: THREE.FrontSide,
        })
    );
    atmosphere.renderOrder = 2;
    group.add(atmosphere);
    group.userData.clouds = clouds;

    group.position.set(0, -3.02, -0.55);
    group.rotation.x = -0.34;
    group.rotation.z = -0.08;
    return group;
}

function makeContactShadow() {
    const canvas = document.createElement('canvas');
    canvas.width = 256;
    canvas.height = 128;
    const context = canvas.getContext('2d');
    const gradient = context.createRadialGradient(128, 64, 4, 128, 64, 118);
    gradient.addColorStop(0, 'rgba(3, 8, 18, 0.24)');
    gradient.addColorStop(0.46, 'rgba(3, 8, 18, 0.13)');
    gradient.addColorStop(1, 'rgba(3, 8, 18, 0)');
    context.fillStyle = gradient;
    context.fillRect(0, 0, canvas.width, canvas.height);

    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;

    const shadow = new THREE.Sprite(
        new THREE.SpriteMaterial({
            map: texture,
            transparent: true,
            depthWrite: false,
            depthTest: true,
            opacity: 0.58,
        })
    );
    shadow.position.set(0, -1.42, 0.9);
    shadow.scale.set(0.52, 0.2, 1);
    shadow.renderOrder = 1;
    return shadow;
}

function makeShootingStarOverlay(container) {
    if (window.getComputedStyle(container).position === 'static') {
        container.style.position = 'relative';
    }

    const layer = document.createElement('div');
    layer.setAttribute('aria-hidden', 'true');
    Object.assign(layer.style, {
        position: 'absolute',
        inset: '0',
        overflow: 'hidden',
        pointerEvents: 'none',
        zIndex: '0',
    });

    const star = document.createElement('div');
    Object.assign(star.style, {
        position: 'absolute',
        width: '250px',
        height: '20px',
        opacity: '0',
        transform: 'translate3d(0,0,0) rotate(-16deg)',
        transformOrigin: 'left center',
        willChange: 'transform, opacity',
    });

    const tail = document.createElement('div');
    Object.assign(tail.style, {
        position: 'absolute',
        left: '0',
        top: '9px',
        width: '100%',
        height: '2px',
        borderRadius: '999px',
        background: 'linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(184,224,255,.82) 12%, rgba(120,184,255,.28) 52%, rgba(105,160,255,0) 100%)',
        boxShadow: '0 0 10px rgba(196,228,255,.72)',
    });

    const head = document.createElement('div');
    Object.assign(head.style, {
        position: 'absolute',
        left: '-4px',
        top: '6px',
        width: '8px',
        height: '8px',
        borderRadius: '50%',
        background: '#fff',
        boxShadow: '0 0 6px #fff, 0 0 15px rgba(196,230,255,1), 0 0 28px rgba(108,176,255,.82)',
    });

    const flare = document.createElement('div');
    Object.assign(flare.style, {
        position: 'absolute',
        left: '0',
        top: '0',
        width: '1px',
        height: '20px',
        background: 'linear-gradient(180deg, transparent, rgba(255,255,255,.88), transparent)',
        transform: 'translateX(-0.5px)',
    });
    star.append(tail, head, flare);
    layer.appendChild(star);
    container.appendChild(layer);

    const meteor = {
        active: false,
        start: 0,
        duration: 1.7,
        next: 2.1,
        fromX: 0,
        fromY: 0,
        toX: 0,
        toY: 0,
        angle: -16,
    };

    function startShot(elapsed) {
        const width = Math.max(1, container.clientWidth);
        const height = Math.max(1, container.clientHeight);
        meteor.active = true;
        meteor.start = elapsed;
        meteor.duration = THREE.MathUtils.randFloat(1.55, 1.9);
        meteor.fromX = width + 300;
        meteor.fromY = THREE.MathUtils.randFloat(34, Math.max(66, height * 0.2));
        meteor.toX = -330;
        meteor.toY = meteor.fromY + THREE.MathUtils.randFloat(Math.max(120, height * 0.3), Math.max(160, height * 0.42));
        meteor.angle = THREE.MathUtils.randFloat(-18, -13);
        star.style.width = `${clamp(width * 0.52, 210, 290)}px`;
    }

    return {
        update(elapsed) {
            if (!meteor.active && elapsed >= meteor.next) {
                startShot(elapsed);
            }

            if (!meteor.active) return;

            const progress = (elapsed - meteor.start) / meteor.duration;
            if (progress >= 1) {
                meteor.active = false;
                meteor.next = elapsed + THREE.MathUtils.randFloat(13.2, 16.2);
                star.style.opacity = '0';
                return;
            }

            const eased = progress * (0.55 + progress * 0.45);
            const x = THREE.MathUtils.lerp(meteor.fromX, meteor.toX, eased);
            const y = THREE.MathUtils.lerp(meteor.fromY, meteor.toY, eased);
            const opacity = Math.min(1, smoothstep(0, 0.06, progress) * (1 - smoothstep(0.92, 1, progress)) * 1.15);
            const scale = 1 + Math.sin(progress * Math.PI) * 0.18;
            star.style.opacity = String(opacity);
            star.style.transform = `translate3d(${x}px, ${y}px, 0) rotate(${meteor.angle}deg) scaleX(${scale})`;
        },
    };
}

function prepareUpperBodyDeformer(mesh) {
    if (!mesh.geometry || !mesh.geometry.attributes.position) return null;

    const geometry = mesh.geometry;
    geometry.computeBoundingBox();
    const box = geometry.boundingBox;
    const height = box.max.y - box.min.y;
    const original = geometry.attributes.position.array.slice();

    return {
        geometry,
        position: geometry.attributes.position,
        original,
        minY: box.min.y,
        maxY: box.max.y,
        pivotY: box.min.y + height * 0.38,
        pivotZ: (box.min.z + box.max.z) * 0.5,
        fadeStart: box.min.y + height * 0.24,
        fadeEnd: box.min.y + height * 0.64,
        lastYaw: null,
        lastPitch: null,
    };
}

function deformUpperBody(deformer, yaw, pitch) {
    if (
        deformer.lastYaw !== null
        && Math.abs(deformer.lastYaw - yaw) < 0.0005
        && Math.abs(deformer.lastPitch - pitch) < 0.0005
    ) {
        return;
    }

    const { position, original, pivotY, pivotZ, fadeStart, fadeEnd } = deformer;
    const values = position.array;
    const yawSin = Math.sin(yaw);
    const yawCos = Math.cos(yaw);
    const pitchSin = Math.sin(pitch);
    const pitchCos = Math.cos(pitch);

    for (let index = 0; index < original.length; index += 3) {
        const x = original[index];
        const y = original[index + 1];
        const z = original[index + 2];
        const upperWeight = smoothstep(fadeStart, fadeEnd, y);
        const headWeight = smoothstep(fadeEnd, deformer.maxY, y) * 0.24;
        const weight = clamp(upperWeight + headWeight, 0, 1);
        const xAbs = Math.abs(x);
        const armRootStart = deformer.minY + (deformer.maxY - deformer.minY) * 0.08;
        const armRootEnd = deformer.minY + (deformer.maxY - deformer.minY) * 0.38;
        const armWeight = smoothstep(0.1, 0.25, xAbs)
            * smoothstep(armRootStart, armRootEnd, y)
            * (1 - smoothstep(deformer.maxY - 0.08, deformer.maxY, y));
        const shoulderWeight = smoothstep(0.12, 0.28, xAbs)
            * smoothstep(fadeStart, fadeEnd, y)
            * (1 - smoothstep(deformer.maxY - 0.12, deformer.maxY, y));
        const handWeight = armWeight
            * (1 - smoothstep(pivotY + 0.06, pivotY + 0.42, y));

        if (weight <= 0.001) {
            values[index] = x;
            values[index + 1] = y;
            values[index + 2] = z;
            continue;
        }

        const localY = y - pivotY;
        const localZ = z - pivotZ;
        const yawedX = x * yawCos + localZ * yawSin;
        const yawedZ = -x * yawSin + localZ * yawCos;
        const side = x < 0 ? -1 : 1;
        const armCounter = -yaw * side * armWeight * config.armSwing;
        const shoulderCounter = -yaw * side * shoulderWeight * 0.24;
        const torsoCounter = -yaw * side * upperWeight * 0.026;
        const connectedHandPull = -Math.abs(yaw) * side * handWeight * 0.026;
        const pitchedY = localY * pitchCos - yawedZ * pitchSin;
        const pitchedZ = localY * pitchSin + yawedZ * pitchCos + armCounter + shoulderCounter + torsoCounter;

        values[index] = x + (yawedX - x) * weight + connectedHandPull;
        values[index + 1] = y + (pivotY + pitchedY - y) * weight;
        values[index + 2] = z + (pivotZ + pitchedZ - z) * weight;
    }

    position.needsUpdate = true;
    deformer.geometry.computeBoundingSphere();
    deformer.lastYaw = yaw;
    deformer.lastPitch = pitch;
}

function initAvatar() {
    const container = document.getElementById('avatar-3d-canvas-container');
    const canvas = document.getElementById('avatar-canvas');
    if (!container || !canvas) return;

    const fallback = container.querySelector('.avatar-3d-fallback');
    const fallbackText = fallback ? fallback.querySelector('[data-avatar-loading-text]') : null;
    const fallbackProgress = fallback ? fallback.querySelector('[data-avatar-loading-progress]') : null;
    const shootingStars = makeShootingStarOverlay(container);

    if (!webglAvailable()) {
        if (fallbackText) fallbackText.textContent = '3D is not supported on this device.';
        return;
    }

    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x101232, 0.035);

    const camera = new THREE.PerspectiveCamera(31, 1, 0.01, 100);
    camera.position.set(0, 0.54, config.cameraDistance);
    camera.lookAt(0, -0.16, 0);

    const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha: true,
        antialias: true,
        powerPreference: 'high-performance',
    });

    renderer.setClearColor(0x000000, 0);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, window.innerWidth < 760 ? 1.25 : 1.65));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.08;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    const starField = makeStarField();
    scene.add(starField.group);

    const globe = makeGlobe();
    scene.add(globe);
    scene.add(makeContactShadow());

    scene.add(new THREE.HemisphereLight(0xdceaff, 0x17111f, 1.34));

    const key = new THREE.DirectionalLight(0xffefd7, 2.9);
    key.position.set(2.9, 4.7, 3.4);
    key.castShadow = true;
    key.shadow.mapSize.set(1536, 1536);
    key.shadow.camera.near = 0.1;
    key.shadow.camera.far = 12;
    key.shadow.camera.left = -3.2;
    key.shadow.camera.right = 3.2;
    key.shadow.camera.top = 3.2;
    key.shadow.camera.bottom = -3.2;
    key.shadow.bias = 0.00018;
    key.shadow.normalBias = 0.034;
    scene.add(key);

    const rim = new THREE.DirectionalLight(0x7fb2ff, 1.45);
    rim.position.set(-3.8, 2.3, -2.7);
    scene.add(rim);

    const fill = new THREE.DirectionalLight(0xc8fff0, 0.68);
    fill.position.set(1.3, 1.2, -2.3);
    scene.add(fill);

    const portraitFill = new THREE.DirectionalLight(0xffd9bd, 0.7);
    portraitFill.position.set(-0.4, 1.7, 4.2);
    scene.add(portraitFill);

    const state = {
        model: null,
        target: new THREE.Vector2(0, 0),
        current: new THREE.Vector2(0, 0),
        pointerActive: false,
        footY: -1.36,
        modelBaseY: 0,
        deformers: [],
        starTwinkles: starField.twinkles,
        shootingStars,
    };

    function resize() {
        const width = Math.max(1, container.clientWidth);
        const height = Math.max(1, container.clientHeight);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height, false);
    }

    function frameCharacter(model) {
        const box = new THREE.Box3().setFromObject(model);
        const size = box.getSize(new THREE.Vector3());
        const center = box.getCenter(new THREE.Vector3());

        model.position.sub(center);
        model.position.y -= box.min.y - center.y;

        const scale = config.characterHeight / Math.max(size.y, 0.001);
        model.scale.setScalar(scale);

        const framedBox = new THREE.Box3().setFromObject(model);
        model.position.y += state.footY - framedBox.min.y;
        model.position.z = 0.82;
        model.rotation.y = 0;
        state.modelBaseY = model.position.y;
    }

    resize();

    const loader = new GLTFLoader();
    loader.load(
        MODEL_PATH,
        (gltf) => {
            const model = gltf.scene;

            model.traverse((node) => {
                if (!node.isMesh) return;
                node.castShadow = false;
                node.receiveShadow = false;
                const deformer = prepareUpperBodyDeformer(node);
                if (deformer) state.deformers.push(deformer);
                if (node.material) {
                    node.material.roughness = Math.min(0.78, node.material.roughness ?? 0.72);
                    node.material.envMapIntensity = 0.48;
                    node.material.depthWrite = true;
                    if (node.material.normalMap && node.material.normalScale) {
                        node.material.normalScale.set(0.18, 0.18);
                    }
                    if (node.material.map) {
                        node.material.map.anisotropy = renderer.capabilities.getMaxAnisotropy();
                        node.material.map.minFilter = THREE.LinearMipmapLinearFilter;
                        node.material.map.magFilter = THREE.LinearFilter;
                        node.material.map.needsUpdate = true;
                    }
                    node.material.needsUpdate = true;
                }
            });

            frameCharacter(model);

            scene.add(model);
            state.model = model;

            if (fallbackText) fallbackText.textContent = 'Ready';
            if (fallbackProgress) fallbackProgress.style.width = '100%';
            requestAnimationFrame(() => fallback?.classList.add('is-complete'));
        },
        (event) => {
            if (!fallbackText || !event.lengthComputable) return;
            const progress = Math.round((event.loaded / event.total) * 100);
            fallback.classList.add('is-measured');
            fallbackText.textContent = `${progress}%`;
            if (fallbackProgress) fallbackProgress.style.width = `${progress}%`;
        },
        () => {
            if (fallbackText) fallbackText.textContent = 'Could not load 3D avatar.';
        }
    );

    window.addEventListener('pointermove', (event) => {
        const rect = container.getBoundingClientRect();
        const x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        const y = -(((event.clientY - rect.top) / rect.height) * 2 - 1);
        state.target.set(clamp(x, -1, 1), clamp(y, -1, 1));
        state.pointerActive = true;
    });

    window.addEventListener('pointerleave', () => {
        state.pointerActive = false;
    });

    window.addEventListener('resize', resize);
    if (typeof ResizeObserver !== 'undefined') {
        new ResizeObserver(resize).observe(container);
    }

    const clock = new THREE.Clock();
    function render() {
        requestAnimationFrame(render);

        const elapsed = clock.getElapsedTime();
        const desiredX = state.pointerActive ? state.target.x : 0;
        const desiredY = state.pointerActive ? state.target.y : 0;
        state.current.x += (desiredX - state.current.x) * config.trackingLerp;
        state.current.y += (desiredY - state.current.y) * config.trackingLerp;

        globe.rotation.y = elapsed * config.globeSpin;
        if (globe.userData.clouds) {
            globe.userData.clouds.rotation.y = elapsed * 0.012;
        }
        updateStarField(state.starTwinkles, elapsed);
        state.shootingStars.update(elapsed);

        if (state.model) {
            state.model.position.y = state.modelBaseY;
            const idleYaw = state.pointerActive ? 0 : Math.sin(elapsed * 0.72) * 0.009;
            const idlePitch = state.pointerActive ? 0 : Math.sin(elapsed * 1.15) * 0.005;
            const yaw = state.current.x * config.upperTurn + idleYaw;
            const pitch = state.current.y * -config.upperPitch + idlePitch;
            state.deformers.forEach((deformer) => deformUpperBody(deformer, yaw, pitch));
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
