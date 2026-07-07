<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy - Portfolio</title>
    
    <!-- Geist Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>

    <style>
        :root {
            /* Vercel / shadcn Dark Mode Tokens */
            --background: #09090b; /* zinc-950 */
            --foreground: #fafafa; /* zinc-50 */
            --card: #09090b;
            --card-foreground: #fafafa;
            --popover: #09090b;
            --popover-foreground: #fafafa;
            --primary: #fafafa;
            --primary-foreground: #18181b;
            --secondary: #27272a; /* zinc-800 */
            --secondary-foreground: #fafafa;
            --muted: #27272a;
            --muted-foreground: #a1a1aa; /* zinc-400 */
            --accent: #27272a;
            --accent-foreground: #fafafa;
            --border: #27272a;
            --input: #27272a;
            --ring: #d4d4d8;
            --radius: 0.5rem;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Geist', sans-serif; 
            background-color: var(--background); 
            color: var(--foreground); 
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .font-mono { font-family: 'Geist Mono', monospace; }

        /* Sticky Header (Blurred) */
        header { 
            position: fixed; 
            top: 0; 
            width: 100%; 
            height: 3.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            background-color: rgba(9, 9, 11, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 50;
        }

        .logo { 
            font-weight: 500; 
            font-size: 1rem; 
            text-decoration: none; 
            color: var(--foreground); 
            letter-spacing: -0.02em;
        }

        .nav-links { 
            display: flex; 
            gap: 1.5rem; 
        }
        
        .nav-links a { 
            color: var(--muted-foreground); 
            text-decoration: none; 
            font-size: 0.875rem; 
            font-weight: 400;
            transition: color 0.2s ease;
        }
        
        .nav-links a:hover, .nav-links a.active { color: var(--foreground); }

        /* Main Content Area */
        main {
            padding: 6rem 2rem 4rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
            min-height: 100vh;
        }
        
        h1 { 
            font-size: clamp(2rem, 5vw, 3.5rem); 
            font-weight: 600; 
            line-height: 1.1; 
            letter-spacing: -0.03em;
            margin-bottom: 1rem; 
            color: var(--foreground);
        }
        
        h2 { 
            font-size: 1.25rem; 
            font-weight: 500; 
            letter-spacing: -0.02em;
            margin-bottom: 1rem; 
            color: var(--foreground);
        }

        p { 
            color: var(--muted-foreground);
            font-size: 1rem;
            font-weight: 400;
        }

        /* Bento Box Cards */
        .bento-card {
            background-color: var(--background);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .bento-card:hover {
            border-color: #3f3f46;
            background-color: rgba(39, 39, 42, 0.3);
        }

        .text-muted { color: var(--muted-foreground); }

        /* Terminal Sweep Transition Layer */
        .transition-sweep { 
            position: fixed; inset: 0; background: var(--foreground); 
            transform: scaleY(0); transform-origin: top; 
            z-index: 9999; pointer-events: none; 
        }

        /* Grid Utilities */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        /* Terminal Block */
        .terminal-block {
            background: rgba(39, 39, 42, 0.5);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'Geist Mono', monospace;
            font-size: 0.875rem;
            color: var(--foreground);
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            header { padding: 0 1rem; }
            main { padding: 5rem 1rem 3rem 1rem; }
        }
    </style>
</head>
<body data-barba="wrapper">
    <div class="transition-sweep"></div>
    
    <header>
        <a href="/" class="logo">Al Farisy</a>
        <div class="nav-links">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Profile</a>
            <a href="/projects" class="{{ request()->is('projects') ? 'active' : '' }}">Deployments</a>
            <a href="/certificates" class="{{ request()->is('certificates') ? 'active' : '' }}">Credentials</a>
        </div>
    </header>
    
    <main data-barba="container" data-barba-namespace="{{ request()->path() }}">
        <div style="opacity: 0; transform: translateY(10px);" class="page-content">
            @yield('content')
        </div>
    </main>

    <script>
        // Smooth Fade transition
        barba.init({
            transitions: [{
                name: 'fade',
                async leave(data) {
                    const done = this.async();
                    await gsap.to('.page-content', { opacity: 0, y: -10, duration: 0.2, ease: 'power2.inOut' });
                    done();
                },
                enter(data) {
                    // Update active nav link
                    document.querySelectorAll('.nav-links a').forEach(a => {
                        a.classList.remove('active');
                        let href = a.getAttribute('href');
                        let current = '/' + window.location.pathname.replace(/^\/|\/$/g, '');
                        if (href === current || (href === '/' && current === '/')) {
                            a.classList.add('active');
                        }
                    });

                    // Fade in new content
                    return gsap.to('.page-content', { opacity: 1, y: 0, duration: 0.3, delay: 0.1, ease: 'power2.out' });
                }
            }],
            views: [{
                namespace: 'home',
                beforeEnter() { gsap.set('.page-content', {opacity: 1, y: 0}); }
            }]
        });

        // Initial load animation
        window.addEventListener('DOMContentLoaded', () => {
            gsap.to('.page-content', { opacity: 1, y: 0, duration: 0.4, ease: 'power2.out' });
        });
    </script>
</body>
</html>
