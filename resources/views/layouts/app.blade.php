<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Abdurrahman Al Farisy - Backend Developer')</title>
    <meta name="description" content="Portfolio of Abdurrahman Al Farisy, an Information Systems student building Laravel APIs, PostgreSQL schemas, and Flutter apps.">

    @php
        $manifestPath = public_path('build/manifest.json');
        $assetEntry = null;

        if (is_file($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true) ?: [];
            foreach ($manifest as $key => $entry) {
                if (str_ends_with(str_replace('\\', '/', $key), 'resources/js/app.js')) {
                    $assetEntry = $entry;
                    break;
                }
            }
        }
    @endphp

    @if($assetEntry)
        <script type="module" src="{{ asset('build/'.$assetEntry['file']) }}"></script>
    @endif

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

        html { min-height: 100%; background: var(--bg); scroll-behavior: smooth; }
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
        a:focus-visible { outline: 2px solid var(--mint); outline-offset: 3px; }
        img { max-width: 100%; }
        ::selection { color: #07110c; background: var(--mint); }

        @view-transition { navigation: auto; }
        ::view-transition-old(root) { animation: page-out 0.22s ease both; }
        ::view-transition-new(root) { animation: page-in 0.42s ease both; }
        @keyframes page-out { to { opacity: 0; transform: translateY(-5px); } }
        @keyframes page-in { from { opacity: 0; transform: translateY(9px); } }

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
            box-shadow: 0 14px 50px rgba(0, 0, 0, 0.22);
            transition: border-color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
        }
        .site-nav.is-scrolled {
            background: rgba(7, 8, 7, 0.92);
            border-color: var(--line-strong);
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.36);
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
            box-shadow: 0 0 0 1px rgba(255,255,255,0.15), 0 8px 24px rgba(126,224,178,0.12);
        }

        .brand-name { white-space: nowrap; }

        .nav-links { display: flex; gap: 0.25rem; }
        .nav-links a {
            position: relative;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            padding: 0 0.9rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            border-radius: var(--radius);
            transition: color 0.2s ease, background 0.2s ease, transform 0.2s ease;
        }
        .nav-links a:hover { color: var(--text); transform: translateY(-1px); }
        .nav-links a.active { color: var(--text); background: rgba(255,255,255,0.08); }
        .nav-links a.active::after {
            content: "";
            position: absolute;
            left: 0.9rem;
            right: 0.9rem;
            bottom: 4px;
            height: 2px;
            background: var(--mint);
        }

        .page-content { padding-bottom: 5rem; }
        .reveal {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.72s ease, transform 0.72s cubic-bezier(.2,.75,.2,1);
        }
        .js .reveal:not(.is-visible) {
            opacity: 0;
            transform: translateY(24px);
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(340px, 0.78fr);
            gap: clamp(1.5rem, 3vw, 3.2rem);
            align-items: center;
            min-height: min(760px, calc(100vh - 108px));
            padding: 1rem 0 3.5rem;
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
            font-size: clamp(3.15rem, 5.6vw, 5rem);
            line-height: 0.96;
            font-weight: 900;
            letter-spacing: 0;
            overflow-wrap: normal;
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
            font-size: 1rem;
            line-height: 1.7;
        }

        .page-header {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(280px, 0.55fr);
            align-items: end;
            gap: 2rem;
            padding: clamp(2.5rem, 7vw, 6rem) 0 clamp(2rem, 5vw, 4rem);
            border-bottom: 1px solid var(--line);
            margin-bottom: 2rem;
        }
        .page-header .heading-xl { font-size: clamp(3.4rem, 7vw, 6.5rem); }
        .page-header p { max-width: 430px; line-height: 1.7; justify-self: end; }

        .page-section { scroll-margin-top: 108px; }
        .profile-section { padding-bottom: clamp(4.5rem, 8vw, 7rem); }
        .landing-section {
            position: relative;
            padding: clamp(5rem, 10vw, 9rem) 0;
            border-top: 1px solid var(--line);
        }
        .landing-section::before {
            content: "";
            position: absolute;
            top: -1px;
            left: 0;
            width: 84px;
            height: 2px;
            background: var(--mint);
        }
        #credentials::before { background: var(--amber); }
        .landing-section-header {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(280px, 0.55fr);
            align-items: end;
            gap: clamp(2rem, 6vw, 6rem);
            margin-bottom: clamp(2.5rem, 5vw, 4.5rem);
        }
        .landing-section-header > p {
            max-width: 470px;
            justify-self: end;
            font-size: 1rem;
            line-height: 1.75;
        }
        .section-number {
            display: block;
            margin-bottom: 0.8rem;
            color: var(--mint);
            text-transform: uppercase;
        }
        #credentials .section-number { color: var(--amber); }
        .section-heading {
            color: var(--text);
            font-size: clamp(3.5rem, 8vw, 7rem);
            line-height: 0.9;
            font-weight: 900;
        }
        .section-arrival .section-heading { animation: section-arrival 0.7s cubic-bezier(.2,.75,.2,1); }
        @keyframes section-arrival {
            from { opacity: 0.45; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-intro {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 2rem;
            padding: 5rem 0 1.5rem;
        }
        .section-kicker { color: var(--mint); text-transform: uppercase; }

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
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary { color: #06100b; background: var(--mint); }
        .btn-ghost { color: var(--text); background: rgba(255,255,255,0.04); border-color: var(--line); }
        .btn-primary:hover, .btn-ghost:hover { transform: translateY(-2px); }
        .btn-primary:hover { box-shadow: 0 10px 30px rgba(126, 224, 178, 0.2); }
        .btn-ghost:hover { border-color: var(--line-strong); background: rgba(255,255,255,0.08); }

        .avatar-3d-container {
            position: relative;
            min-height: 500px;
            height: min(64vh, 620px);
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid var(--line);
            background:
                radial-gradient(circle at 50% 94%, rgba(90, 202, 218, 0.16), transparent 13rem),
                linear-gradient(180deg, #11143d 0%, #0a0e2b 48%, #050817 100%);
            box-shadow: inset 0 0 70px rgba(0, 0, 0, 0.38);
            isolation: isolate;
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
            height: 24%;
            background: linear-gradient(180deg, transparent 0%, rgba(8, 9, 21, 0.52) 100%);
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
            gap: 1.35rem;
            color: var(--muted);
            z-index: 3;
            background: rgba(6, 8, 24, 0.96);
            transition: opacity 0.32s ease, visibility 0.32s ease;
        }
        .avatar-3d-fallback.is-complete {
            opacity: 0;
            visibility: hidden;
        }
        .avatar-loader {
            position: relative;
            width: 126px;
            height: 126px;
            display: grid;
            place-items: center;
        }
        .loader-orbit {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(212, 237, 255, 0.18);
        }
        .loader-orbit::after {
            content: "";
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--mint);
            box-shadow: 0 0 14px rgba(126, 224, 178, 0.9);
        }
        .loader-orbit-outer {
            inset: 0;
            border-top-color: rgba(126, 224, 178, 0.75);
            animation: loader-spin 4.6s linear infinite;
        }
        .loader-orbit-outer::after { top: 13px; right: 13px; }
        .loader-orbit-inner {
            inset: 17px;
            border-right-color: rgba(127, 180, 255, 0.78);
            transform: rotate(38deg);
            animation: loader-spin-reverse 3.2s linear infinite;
        }
        .loader-orbit-inner::after {
            left: 5px;
            bottom: 17px;
            width: 6px;
            height: 6px;
            background: var(--blue);
            box-shadow: 0 0 12px rgba(127, 180, 255, 0.9);
        }
        .loader-core {
            display: grid;
            place-items: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            color: #07110c;
            background: var(--mint);
            font-family: "JetBrains Mono", monospace;
            font-size: 0.9rem;
            font-weight: 900;
            box-shadow: 0 0 32px rgba(126, 224, 178, 0.2);
            animation: loader-pulse 1.8s ease-in-out infinite;
        }
        .loader-meta {
            width: min(230px, calc(100% - 48px));
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .loader-title { color: var(--soft); font-size: 0.82rem; font-weight: 800; }
        .loader-progress {
            width: min(230px, calc(100% - 48px));
            height: 3px;
            overflow: hidden;
            background: rgba(255,255,255,0.1);
        }
        .loader-progress span {
            display: block;
            width: 18%;
            height: 100%;
            background: linear-gradient(90deg, var(--mint), var(--blue));
            transform-origin: left center;
            animation: loader-indeterminate 1.35s ease-in-out infinite;
            transition: width 0.2s ease;
        }
        .avatar-3d-fallback.is-measured .loader-progress span { animation: none; }
        @keyframes loader-spin { to { transform: rotate(360deg); } }
        @keyframes loader-spin-reverse { to { transform: rotate(-322deg); } }
        @keyframes loader-pulse {
            0%, 100% { transform: scale(0.96); }
            50% { transform: scale(1.04); }
        }
        @keyframes loader-indeterminate {
            0% { transform: translateX(-120%) scaleX(0.5); }
            55% { transform: translateX(220%) scaleX(1.35); }
            100% { transform: translateX(620%) scaleX(0.6); }
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
            --pointer-x: 50%;
            --pointer-y: 50%;
            position: relative;
            min-height: 180px;
            padding: 1.35rem;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--panel);
            backdrop-filter: blur(18px);
            transform-style: preserve-3d;
            transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }
        .inner-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            pointer-events: none;
            opacity: 0;
            background: radial-gradient(360px circle at var(--pointer-x) var(--pointer-y), rgba(126,224,178,0.1), transparent 58%);
            transition: opacity 0.25s ease;
        }
        .inner-card:hover {
            border-color: var(--line-strong);
            background: var(--panel-strong);
            box-shadow: 0 18px 50px rgba(0,0,0,0.18);
        }
        .inner-card:hover::before { opacity: 1; }
        .inner-card .card-content { position: relative; z-index: 1; transform: translateZ(24px); }

        .project-grid, .credential-grid { align-items: stretch; }
        .project-card { min-height: 260px; display: flex; }
        .project-card-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 2rem;
        }
        .project-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .project-card-header h3, .credential-header h3 {
            color: var(--text);
            font-size: 1.15rem;
            line-height: 1.35;
            font-weight: 800;
        }
        .project-description { line-height: 1.7; }
        .project-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding-top: 1.2rem;
            border-top: 1px solid var(--line);
        }
        .project-card .project-link { align-self: flex-end; }
        .project-link { min-height: 38px; padding: 0 0.8rem; font-size: 0.78rem; }
        .empty-state { min-height: 220px; display: grid; place-items: center; text-align: center; }
        .credential-card { min-height: 100%; }
        .credential-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        .certificate-frame {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: #fff;
        }
        .certificate-frame img {
            width: 100%;
            display: block;
            transition: transform 0.5s cubic-bezier(.2,.75,.2,1);
        }
        .inner-card:hover .certificate-frame img { transform: scale(1.018); }

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

        .site-footer {
            position: relative;
            padding: clamp(4.5rem, 9vw, 8rem) 0 2rem;
            border-top: 1px solid var(--line);
            color: var(--muted);
        }
        .site-footer::before {
            content: "";
            position: absolute;
            top: -1px;
            left: 0;
            width: min(360px, 55%);
            height: 3px;
            background: linear-gradient(90deg, var(--mint), var(--amber), var(--coral));
        }
        .footer-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 0.68fr);
            align-items: end;
            gap: clamp(2.5rem, 8vw, 8rem);
        }
        .footer-heading {
            max-width: 760px;
            margin-top: 1.2rem;
            color: var(--text);
            font-size: clamp(3rem, 7vw, 6.2rem);
            line-height: 0.94;
            font-weight: 900;
        }
        .footer-copy { max-width: 580px; margin-top: 1.4rem; line-height: 1.75; }
        .availability { display: inline-flex; align-items: center; gap: 0.55rem; }
        .availability::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--mint);
            box-shadow: 0 0 0 5px rgba(126,224,178,0.09);
        }
        .footer-email {
            position: relative;
            display: grid;
            gap: 0.55rem;
            padding: 1rem 3.2rem 1.3rem 0;
            color: var(--text);
            text-decoration: none;
            border-bottom: 1px solid var(--line-strong);
            transition: border-color 0.25s ease, color 0.25s ease;
        }
        .footer-email strong { font-size: clamp(1rem, 2vw, 1.35rem); overflow-wrap: anywhere; }
        .footer-email:hover { color: var(--mint); border-color: var(--mint); }
        .footer-arrow {
            position: absolute;
            right: 0;
            bottom: 1.05rem;
            font-size: 1.7rem;
            transition: transform 0.25s ease;
        }
        .footer-email:hover .footer-arrow { transform: translate(3px, -3px); }
        .footer-bottom {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            align-items: center;
            gap: 2rem;
            margin-top: clamp(4rem, 8vw, 7rem);
            padding-top: 1.5rem;
            border-top: 1px solid var(--line);
        }
        .footer-signature { display: inline-flex; align-items: center; gap: 0.75rem; }
        .footer-signature .brand-mark { width: 34px; height: 34px; }
        .footer-links { display: flex; align-items: center; gap: 1.25rem; }
        .footer-links a { color: var(--muted); text-decoration: none; font-size: 0.84rem; font-weight: 700; }
        .footer-links a:hover { color: var(--text); }
        .back-to-top {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border: 1px solid var(--line);
            border-radius: 50%;
            color: var(--text);
            text-decoration: none;
            background: rgba(255,255,255,0.04);
            font-size: 1.1rem;
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }
        .back-to-top:hover { transform: translateY(-3px); border-color: var(--line-strong); background: rgba(255,255,255,0.08); }

        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; min-height: auto; padding-top: 2rem; }
            .avatar-3d-container { min-height: 460px; height: 58vh; }
            .grid-2 { grid-template-columns: 1fr; }
            .status-strip { grid-template-columns: 1fr; }
            .page-header { grid-template-columns: 1fr; }
            .page-header p { justify-self: start; }
            .landing-section-header, .footer-main { grid-template-columns: 1fr; }
            .landing-section-header > p { justify-self: start; }
        }
        @media (max-width: 640px) {
            .site-shell { width: min(100% - 24px, 1180px); }
            .site-nav { top: 8px; gap: 0.5rem; min-height: 56px; margin-top: 8px; padding: 0.5rem; }
            .brand-name { display: none; }
            .brand-mark { width: 36px; height: 36px; }
            .nav-links { flex: 1; justify-content: flex-end; min-width: 0; }
            .nav-links a { min-height: 36px; padding: 0 0.62rem; font-size: 0.78rem; }
            .nav-links a.active::after { left: 0.62rem; right: 0.62rem; }
            .hero { gap: 2rem; padding: 1.25rem 0 3rem; }
            .heading-xl { font-size: clamp(2.65rem, 13vw, 3.45rem); line-height: 0.98; }
            .lead { font-size: 0.95rem; line-height: 1.65; }
            .action-row { display: grid; grid-template-columns: 1fr 1fr; }
            .action-row a { justify-content: center; }
            .action-row a:first-child { grid-column: 1 / -1; }
            .avatar-3d-container { min-height: 420px; height: 58vh; }
            .inner-card { padding: 1.1rem; }
            .page-header { gap: 1rem; padding: 2.75rem 0 2rem; }
            .page-header .heading-xl { font-size: clamp(3rem, 16vw, 4.2rem); }
            .section-intro { padding-top: 3.5rem; }
            .landing-section { padding: 4.5rem 0; }
            .section-heading { font-size: clamp(3.2rem, 17vw, 4.8rem); }
            .project-card-footer, .credential-header { align-items: flex-start; flex-direction: column; }
            .project-card .project-link { align-self: stretch; justify-content: center; }
            .footer-heading { font-size: clamp(3rem, 15vw, 4.3rem); }
            .footer-bottom { grid-template-columns: 1fr auto; }
            .footer-links { grid-column: 1 / -1; grid-row: 2; flex-wrap: wrap; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
            .js .reveal:not(.is-visible) { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>
    <div class="site-shell">
        <nav class="site-nav">
            <a href="#profile" class="nav-brand">
                <span class="brand-mark">AF</span>
                <span class="brand-name">Abdurrahman Al Farisy</span>
            </a>
            <div class="nav-links">
                <a href="#profile" class="active" data-section-link="profile" aria-current="page">Profile</a>
                <a href="#projects" data-section-link="projects">Projects</a>
                <a href="#credentials" data-section-link="credentials">Certs</a>
            </div>
        </nav>

        <main class="page-content">
            @yield('content')
        </main>

        <footer class="site-footer" id="contact">
            <div class="footer-main">
                <div class="reveal">
                    <span class="availability font-mono">Available for collaborations</span>
                    <h2 class="footer-heading">Let&rsquo;s build something useful.</h2>
                    <p class="footer-copy">
                        Have a product idea, backend problem, or system that needs clearer structure? I am always open to thoughtful projects and good conversations.
                    </p>
                </div>

                <a class="footer-email reveal" href="mailto:foustujian@gmail.com">
                    <span class="font-mono text-xs text-muted">Start a conversation</span>
                    <strong>foustujian@gmail.com</strong>
                    <span class="footer-arrow" aria-hidden="true">&nearr;</span>
                </a>
            </div>

            <div class="footer-bottom">
                <div class="footer-signature">
                    <span class="brand-mark">AF</span>
                    <span class="font-mono text-xs">Samarinda, Indonesia &middot; UTC+8</span>
                </div>
                <nav class="footer-links" aria-label="Social links">
                    <a href="https://github.com/foustujian-sketch" target="_blank" rel="noreferrer">GitHub</a>
                    <a href="https://www.linkedin.com/in/abdurrahman-al-farisy-580885328" target="_blank" rel="noreferrer">LinkedIn</a>
                    <a href="#projects">Projects</a>
                    <a href="#credentials">Credentials</a>
                </nav>
                <a class="back-to-top" href="#profile" aria-label="Back to top" title="Back to top">&uarr;</a>
            </div>
        </footer>
    </div>

    <script>
    (function() {
        document.documentElement.classList.add('js');

        function initParallax() {
            if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
            document.querySelectorAll('.inner-card').forEach((card) => {
                if (card.dataset.parallaxReady) return;
                card.dataset.parallaxReady = 'true';
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;
                    this.style.setProperty('--pointer-x', `${(x + 0.5) * 100}%`);
                    this.style.setProperty('--pointer-y', `${(y + 0.5) * 100}%`);
                    this.style.transform = `perspective(1100px) rotateX(${y * -2.5}deg) rotateY(${x * 2.5}deg) translateY(-2px)`;
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'perspective(1100px) rotateX(0deg) rotateY(0deg)';
                });
            });
        }

        function initReveals() {
            const items = document.querySelectorAll('.reveal');
            if (!('IntersectionObserver' in window)) {
                items.forEach((item) => item.classList.add('is-visible'));
                return;
            }
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -40px' });
            items.forEach((item, index) => {
                item.style.transitionDelay = `${Math.min(index % 3, 2) * 70}ms`;
                observer.observe(item);
            });
        }

        function initNav() {
            const nav = document.querySelector('.site-nav');
            const links = Array.from(document.querySelectorAll('[data-section-link]'));
            const sections = links
                .map((link) => document.getElementById(link.dataset.sectionLink))
                .filter(Boolean);
            let ticking = false;

            const update = () => {
                nav.classList.toggle('is-scrolled', window.scrollY > 20);

                const marker = window.scrollY + window.innerHeight * 0.34;
                let activeId = sections[0]?.id;
                sections.forEach((section) => {
                    if (section.offsetTop <= marker) activeId = section.id;
                });

                links.forEach((link) => {
                    const active = link.dataset.sectionLink === activeId;
                    link.classList.toggle('active', active);
                    if (active) link.setAttribute('aria-current', 'page');
                    else link.removeAttribute('aria-current');
                });
                ticking = false;
            };

            const requestUpdate = () => {
                if (ticking) return;
                ticking = true;
                window.requestAnimationFrame(update);
            };

            document.querySelectorAll('a[href^="#"]').forEach((link) => {
                link.addEventListener('click', (event) => {
                    const target = document.querySelector(link.getAttribute('href'));
                    if (!target) return;
                    event.preventDefault();
                    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                    target.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
                    window.history.pushState(null, '', link.getAttribute('href'));
                    target.classList.remove('section-arrival');
                    window.requestAnimationFrame(() => target.classList.add('section-arrival'));
                    window.setTimeout(() => target.classList.remove('section-arrival'), 750);
                });
            });

            update();
            window.addEventListener('scroll', requestUpdate, { passive: true });
            window.addEventListener('resize', requestUpdate, { passive: true });
        }

        window.addEventListener('DOMContentLoaded', () => {
            initParallax();
            initReveals();
            initNav();
        });
    })();
    </script>
</body>
</html>
