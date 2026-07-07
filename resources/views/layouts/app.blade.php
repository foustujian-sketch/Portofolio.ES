<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Portfolio</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>

    <style>
        :root {
            --bg-color: #050508;
            --text-primary: #ffffff;
            --text-secondary: #8b8b9f;
            --accent: #5e6ad2;
            --accent-glow: rgba(94, 106, 210, 0.4);
            --card-bg: rgba(25, 25, 35, 0.4);
            --card-border: rgba(255, 255, 255, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-color); 
            color: var(--text-primary); 
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Ambient Background Glow */
        .ambient-glow {
            position: fixed;
            top: -20vh;
            left: -10vw;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 60%);
            filter: blur(100px);
            opacity: 0.5;
            z-index: -1;
            pointer-events: none;
            border-radius: 50%;
            animation: float 20s ease-in-out infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(10vw, 10vh) scale(1.1); }
        }

        /* Navigation */
        nav { 
            padding: 2.5rem 6vw; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 100;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.02);
        }
        
        .logo { font-weight: 700; font-size: 1.2rem; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; color: #fff;}
        .logo span { color: var(--accent); }

        .nav-links { display: flex; gap: 2.5rem; }
        .nav-links a { 
            color: var(--text-secondary); 
            text-decoration: none; 
            font-weight: 500; 
            font-size: 0.95rem;
            letter-spacing: 1px; 
            transition: color 0.3s; 
        }
        .nav-links a:hover, .nav-links a.active { color: #fff; }

        /* Main Content */
        .page-wrapper { 
            min-height: 100vh; 
            padding: 10rem 6vw 5rem 6vw; 
            max-width: 1400px;
            margin: 0 auto;
        }
        
        h1 { 
            font-size: clamp(3rem, 7vw, 5rem); 
            font-weight: 700; 
            line-height: 1.1; 
            letter-spacing: -1px;
            margin-bottom: 1.5rem; 
        }
        
        h2 {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 2rem;
            color: var(--text-primary);
        }

        p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Premium Glassmorphism Cards */
        .card { 
            background: var(--card-bg);
            border: 1px solid var(--card-border); 
            border-radius: 16px;
            padding: 2.5rem; 
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: border-color 0.4s ease, transform 0.4s ease;
            transform-style: preserve-3d;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .card:hover { 
            border-color: rgba(255,255,255,0.2); 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .card-inner {
            transform: translateZ(30px); /* Pushes content out for 3D effect */
        }

        .card h3 { 
            color: #fff; 
            margin-bottom: 0.5rem; 
            font-size: 1.5rem;
            font-weight: 500;
        }

        /* Transition Layer */
        .transition-layer { 
            position: fixed; 
            inset: 0; 
            background: #0f0f13; 
            transform: scaleY(0); 
            transform-origin: top; 
            z-index: 1000; 
            pointer-events: none; 
        }
        
        /* Grid Layouts */
        .grid-layout {
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
            gap: 2.5rem;
        }
    </style>
</head>
<body data-barba="wrapper">
    <div class="ambient-glow"></div>
    <div class="transition-layer"></div>
    
    <nav>
        <a href="/" class="logo">A<span>.</span> Al Farisy</a>
        <div class="nav-links">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">About</a>
            <a href="/projects" class="{{ request()->is('projects') ? 'active' : '' }}">Projects</a>
            <a href="/certificates" class="{{ request()->is('certificates') ? 'active' : '' }}">Certificates</a>
        </div>
    </nav>
    
    <main data-barba="container" data-barba-namespace="{{ request()->path() }}">
        <div class="page-wrapper">
            @yield('content')
        </div>
    </main>

    <script>
        // Initialize Vanilla Tilt on elements with data-tilt
        function initTilt() {
            VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
                max: 5,
                speed: 400,
                glare: true,
                "max-glare": 0.1,
                scale: 1.02
            });
        }

        // Run on first load
        document.addEventListener("DOMContentLoaded", initTilt);

        // Elegant Barba + GSAP Transitions
        barba.init({
            transitions: [{
                name: 'elegant-transition',
                leave(data) {
                    return gsap.to('.transition-layer', {
                        scaleY: 1,
                        transformOrigin: 'bottom',
                        duration: 0.6,
                        ease: 'power4.inOut'
                    });
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

                    // Re-init tilt after transition
                    initTilt();

                    // Slide out transition layer
                    gsap.to('.transition-layer', {
                        scaleY: 0,
                        transformOrigin: 'top',
                        duration: 0.6,
                        ease: 'power4.inOut'
                    });
                    
                    // Reveal content elegantly
                    return gsap.from(data.next.container.querySelector('.page-wrapper'), {
                        y: 40,
                        opacity: 0,
                        duration: 0.8,
                        delay: 0.3,
                        ease: 'power3.out'
                    });
                }
            }]
        });
    </script>
</body>
</html>
