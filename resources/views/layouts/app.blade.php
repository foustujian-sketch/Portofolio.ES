<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Inter for display/body, IBM Plex Mono for utility -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>

    <style>
        :root {
            --bg-base: #FFFFFF;
            --text-primary: #111111;
            --accent-blue: #0000FF;
            --text-muted: #888888;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-base); 
            color: var(--text-primary); 
            overflow-x: hidden;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* Strict Grid Structure */
        .site-grid {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        nav { 
            padding: 4rem 2rem;
            position: fixed;
            width: 250px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo { 
            font-weight: 900; 
            font-size: 1.2rem; 
            text-decoration: none; 
            color: var(--text-primary); 
            letter-spacing: -0.05em;
            text-transform: uppercase;
        }

        .nav-links { 
            display: flex; 
            flex-direction: column; 
            gap: 1rem; 
        }
        
        .nav-links a { 
            color: var(--text-muted); 
            text-decoration: none; 
            font-weight: 400; 
            font-size: 1.1rem; 
            letter-spacing: -0.03em;
            transition: color 0s; /* No smooth fades, instant feedback */
        }
        
        .nav-links a:hover { color: var(--text-primary); }
        .nav-links a.active { color: var(--accent-blue); font-weight: 700; }

        .nav-footer {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        /* Main Content Area */
        main {
            grid-column: 2;
            padding: 4rem 4rem 8rem 4rem;
            max-width: 1200px;
        }
        
        h1 { 
            font-size: clamp(4rem, 8vw, 8rem); 
            font-weight: 900; 
            line-height: 0.9; 
            letter-spacing: -0.06em;
            margin-bottom: 4rem; 
            text-transform: uppercase;
        }
        
        h2 { 
            font-size: 1.5rem; 
            font-weight: 700; 
            letter-spacing: -0.04em;
            margin-bottom: 2rem; 
            text-transform: uppercase;
            color: var(--accent-blue);
        }

        p { 
            font-weight: 300; 
            font-size: 1.25rem;
            max-width: 700px;
            margin-bottom: 1.5rem;
        }

        /* Utility/Data Classes */
        .mono-data {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* Transition Layer (Ultra Minimalist) */
        .transition-sweep { 
            position: fixed; inset: 0; background: var(--accent-blue); 
            transform: scaleX(0); transform-origin: left; 
            z-index: 9999; pointer-events: none; 
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .site-grid { grid-template-columns: 1fr; }
            nav { position: relative; width: 100%; height: auto; padding: 2rem; border-bottom: 1px solid #eee; }
            main { grid-column: 1; padding: 2rem; }
        }
    </style>
</head>
<body data-barba="wrapper">
    <div class="transition-sweep"></div>
    
    <div class="site-grid">
        <nav>
            <div>
                <a href="/" class="logo">Al Farisy</a>
                <div class="nav-links" style="margin-top: 4rem;">
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Profile</a>
                    <a href="/projects" class="{{ request()->is('projects') ? 'active' : '' }}">Architecture</a>
                    <a href="/certificates" class="{{ request()->is('certificates') ? 'active' : '' }}">Credentials</a>
                </div>
            </div>
            <div class="nav-footer">
                SYS.V.2.0<br>
                SAMARINDA, ID
            </div>
        </nav>
        
        <main data-barba="container" data-barba-namespace="{{ request()->path() }}">
            @yield('content')
        </main>
    </div>

    <script>
        // Minimalist Barba Transition (Sharp Blue Cut)
        barba.init({
            transitions: [{
                name: 'sharp-cut',
                async leave(data) {
                    const done = this.async();
                    
                    // Instant sharp sweep across the screen
                    await gsap.fromTo('.transition-sweep', 
                        { scaleX: 0, transformOrigin: 'left' },
                        { scaleX: 1, duration: 0.3, ease: 'expo.inOut' }
                    );
                    
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

                    // Instantly disappear to the right
                    gsap.fromTo('.transition-sweep', 
                        { scaleX: 1, transformOrigin: 'right' },
                        { scaleX: 0, duration: 0.3, ease: 'expo.inOut' }
                    );
                    
                    // Simple stark fade in for content
                    return gsap.from(data.next.container, {
                        opacity: 0, duration: 0.4, delay: 0.1
                    });
                }
            }]
        });
    </script>
</body>
</html>
