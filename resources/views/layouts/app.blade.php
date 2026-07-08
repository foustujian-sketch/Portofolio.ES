<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy - Backend Developer</title>
    <meta name="description" content="Portfolio of Abdurrahman Al Farisy, an Information Systems student building Laravel APIs, PostgreSQL schemas, and Flutter apps.">

    @vite(['resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #070807;
            --panel: rgba(16, 18, 16, 0.78);
            --panel-strong: rgba(22, 25, 22, 0.92);
            --line: rgba(238, 247, 233, 0.12);
            --line-strong: rgba(238, 247, 233, 0.22);
            --text: #f3f7ef;
            --muted: #a7b0a1;
            --soft: #d6dece;
            --mint: #7ee0b2;
            --amber: #f0b85a;
            --coral: #ff8066;
            --blue: #7fb4ff;
            --violet: #b99cff;
            --radius: 8px;
        }

        html { min-height: 100%; background: var(--bg); }
        body {
            min-height: 100vh;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                linear-gradient(rgba(126, 224, 178, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(126, 224, 178, 0.04) 1px, transparent 1px),
                radial-gradient(circle at 18% 12%, rgba(240, 184, 90, 0.16), transparent 24rem),
                radial-gradient(circle at 84% 16%, rgba(127, 180, 255, 0.14), transparent 26rem),
                linear-gradient(145deg, #070807 0%, #11140f 52%, #080a08 100%);
            background-size: 44px 44px, 44px 44px, auto, auto, auto;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(90deg, rgba(255,255,255,0.06), transparent 18%, transparent 82%, rgba(255,255,255,0.04));
            opacity: 0.45;
            z-index: 0;
        }

        a { color: inherit; }
        img { max-width: 100%; }

        .site-shell {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        .site-nav {
            position: sticky;
            top: 16px;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 64px;
            margin: 16px 0 28px;
            padding: 0.75rem;
            background: rgba(7, 8, 7, 0.78);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            backdrop-filter: blur(18px);
        }

        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-weight: 800;
            letter-spacing: 0;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: var(--radius);
            color: #06100b;
            background: linear-gradient(135deg, var(--mint), var(--amber));
            font-family: "JetBrains Mono", monospace;
            font-weight: 600;
        }

        .nav-links { display: flex; gap: 0.25rem; }
        .nav-links a {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            padding: 0 0.9rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            border-radius: var(--radius);
            transition: color 0.2s ease, background 0.2s ease;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--text); background: rgba(255,255,255,0.08); }

        .page-content { padding-bottom: 4rem; }
        .reveal {
            opacity: 1;
            transform: translateY(0);
            animation: reveal-up 0.72s ease both;
        }
        .reveal:nth-child(2) { animation-delay: 0.08s; }
        .reveal:nth-child(3) { animation-delay: 0.14s; }
        @keyframes reveal-up {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(340px, 0.84fr);
            gap: clamp(1.5rem, 4vw, 4rem);
            align-items: center;
            min-height: calc(100vh - 132px);
            padding-bottom: 2rem;
        }

        .eyebrow, .font-mono {
            font-family: "JetBrains Mono", monospace;
            font-size: 0.76rem;
            letter-spacing: 0;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            color: var(--mint);
            margin-bottom: 1.15rem;
        }
        .eyebrow::before {
            content: "";
            width: 30px;
            height: 2px;
            background: var(--mint);
        }

        .heading-xl {
            max-width: 720px;
            color: var(--text);
            font-size: clamp(3rem, 7vw, 6.7rem);
            line-height: 0.92;
            font-weight: 900;
            letter-spacing: 0;
        }

        .heading-gradient {
            color: transparent;
            background: linear-gradient(105deg, var(--mint), var(--amber) 48%, var(--coral));
            -webkit-background-clip: text;
            background-clip: text;
        }

        .heading-md {
            color: var(--text);
            font-size: 1.08rem;
            line-height: 1.25;
            font-weight: 800;
            letter-spacing: 0;
        }

        .lead {
            max-width: 620px;
            margin-top: 1.4rem;
            color: var(--soft);
            font-size: 1.03rem;
            line-height: 1.75;
        }

        .text-muted { color: var(--muted); }
        .text-sm { font-size: 0.9rem; }
        .text-xs { font-size: 0.75rem; }

        .action-row, .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .gap-1 { gap: 0.5rem; }
        .gap-2 { gap: 1rem; }
        .gap-3 { gap: 1.5rem; }
        .gap-4 { gap: 2rem; }
        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mt-4 { margin-top: 2rem; }

        .action-row { gap: 0.8rem; flex-wrap: wrap; margin-top: 1.7rem; }

        .btn-primary, .btn-ghost {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0 1rem;
            border-radius: var(--radius);
            font-size: 0.88rem;
            font-weight: 800;
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }
        .btn-primary { color: #06100b; background: var(--mint); }
        .btn-ghost { color: var(--text); background: rgba(255,255,255,0.04); border-color: var(--line); }
        .btn-primary:hover, .btn-ghost:hover { transform: translateY(-2px); }
        .btn-ghost:hover { border-color: var(--line-strong); background: rgba(255,255,255,0.08); }

        .avatar-3d-container {
            position: relative;
            min-height: 560px;
            height: min(68vh, 680px);
            overflow: hidden;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background:
                radial-gradient(circle at 50% 18%, rgba(126, 224, 178, 0.20), transparent 18rem),
                linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
        }
        .avatar-3d-container::before {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius);
            pointer-events: none;
            z-index: 2;
        }
        .avatar-3d-container::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 34%;
            background: linear-gradient(180deg, transparent 0%, rgba(13, 17, 14, 0.88) 42%, rgba(13, 17, 14, 0.98) 100%);
            pointer-events: none;
            z-index: 2;
        }
        .avatar-3d-container canvas {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: block;
        }
        .avatar-3d-fallback {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
            color: var(--muted);
        }
        .avatar-3d-fallback img {
            width: 128px;
            height: 128px;
            border-radius: var(--radius);
            object-fit: cover;
            border: 1px solid var(--line);
        }

        .status-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1px;
            margin-top: 1.5rem;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--line);
        }
        .status-strip div { padding: 1rem; background: rgba(10, 12, 10, 0.86); }
        .status-strip strong { display: block; color: var(--text); font-size: 1.3rem; }
        .status-strip span { color: var(--muted); font-size: 0.78rem; }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }
        .grid-span-full { grid-column: 1 / -1; }

        .inner-card {
            position: relative;
            min-height: 180px;
            padding: 1.35rem;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--panel);
            backdrop-filter: blur(18px);
            transform-style: preserve-3d;
            transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease;
        }
        .inner-card:hover { border-color: var(--line-strong); background: var(--panel-strong); }
        .inner-card .card-content { transform: translateZ(34px); }

        .pill {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 0 0.65rem;
            border-radius: var(--radius);
            color: var(--soft);
            background: rgba(255,255,255,0.07);
            border: 1px solid var(--line);
            font-size: 0.74rem;
            font-weight: 800;
        }

        .divider { height: 1px; margin: 2rem 0; background: var(--line); }

        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; min-height: auto; }
            .avatar-3d-container { min-height: 460px; height: 58vh; }
            .grid-2 { grid-template-columns: 1fr; }
            .status-strip { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .site-shell { width: min(100% - 24px, 1180px); }
            .site-nav { top: 8px; align-items: flex-start; flex-direction: column; }
            .nav-links { width: 100%; }
            .nav-links a { flex: 1; justify-content: center; padding: 0 0.5rem; }
            .heading-xl { font-size: clamp(2.8rem, 18vw, 4.2rem); }
            .avatar-3d-container { min-height: 390px; height: 54vh; }
            .inner-card { padding: 1.1rem; }
        }
    </style>
</head>
<body>
    <div class="site-shell">
        <nav class="site-nav">
            <a href="/" class="nav-brand">
                <span class="brand-mark">AF</span>
                <span>Abdurrahman Al Farisy</span>
            </a>
            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Profile</a>
                <a href="/projects" class="{{ request()->is('projects') ? 'active' : '' }}">Projects</a>
                <a href="/certificates" class="{{ request()->is('certificates') ? 'active' : '' }}">Certs</a>
            </div>
        </nav>

        <main class="page-content">
            @yield('content')
        </main>
    </div>

    <script>
    (function() {
        function initParallax() {
            document.querySelectorAll('.inner-card').forEach((card) => {
                if (card.dataset.parallaxReady) return;
                card.dataset.parallaxReady = 'true';
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;
                    this.style.transform = `perspective(1100px) rotateX(${y * -5}deg) rotateY(${x * 5}deg)`;
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'perspective(1100px) rotateX(0deg) rotateY(0deg)';
                });
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            initParallax();
        });
    })();
    </script>
</body>
</html>
