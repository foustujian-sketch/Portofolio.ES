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
            --bg-base: #070B19; /* Deep Navy */
            --bg-panel: rgba(18, 28, 56, 0.6);
            --text-primary: #ffffff;
            --text-muted: #94A3B8;
            --accent-cyan: #00E5FF;
            --accent-blue: #42A5F5; /* Flutter Blue */
            --border-color: rgba(66, 165, 245, 0.2);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-base); 
            color: var(--text-primary); 
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Abstract Tech Grid Background */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            pointer-events: none;
        }
        
        .bg-glow {
            position: fixed;
            top: -20vh; right: -10vw; width: 60vw; height: 60vw;
            background: radial-gradient(circle, rgba(0, 229, 255, 0.08) 0%, transparent 60%);
            z-index: -2;
            pointer-events: none;
        }

        nav { 
            padding: 2rem 6vw; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 100;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .logo { font-weight: 700; font-size: 1.4rem; text-decoration: none; color: #fff; letter-spacing: 1px; }
        .logo span { color: var(--accent-cyan); }

        .nav-links { display: flex; gap: 2.5rem; }
        .nav-links a { 
            color: var(--text-muted); text-decoration: none; font-weight: 500; 
            font-size: 0.95rem; letter-spacing: 1px; transition: color 0.3s;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--accent-cyan); }

        .page-wrapper { 
            min-height: 100vh; padding: 10rem 6vw 5rem 6vw; max-width: 1400px; margin: 0 auto;
        }
        
        h1 { font-size: clamp(3rem, 6vw, 4.5rem); font-weight: 700; line-height: 1.1; margin-bottom: 1rem; }
        h2 { font-size: 2rem; font-weight: 500; margin-bottom: 2rem; color: #fff; }
        p { color: var(--text-muted); font-size: 1.1rem; }

        /* Tech Panels */
        .card { 
            background: var(--bg-panel);
            border: 1px solid var(--border-color); 
            border-radius: 12px;
            padding: 2rem; 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: border-color 0.4s ease, box-shadow 0.4s ease;
            transform-style: preserve-3d;
        }
        
        .card:hover { 
            border-color: var(--accent-cyan); 
            box-shadow: 0 10px 30px rgba(0, 229, 255, 0.1);
        }

        .card-inner { transform: translateZ(30px); }
        .card h3 { color: #fff; margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 500; }

        /* Sweep Transition Layer */
        .transition-sweep { 
            position: fixed; inset: 0; background: var(--accent-cyan); 
            transform: scaleX(0); transform-origin: right; 
            z-index: 9999; pointer-events: none; 
        }
        
        /* Grid Layouts */
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; }

        /* Interactive Tracking Avatar */
        #interactive-avatar-wrapper {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid var(--accent-cyan);
            overflow: hidden;
            box-shadow: 0 0 25px rgba(0, 229, 255, 0.4);
            z-index: 1000;
            background: #000;
        }
        
        #interactive-avatar-img {
            width: 140%;
            height: 140%;
            object-fit: cover;
            position: absolute;
            top: -20%;
            left: -20%;
            transition: transform 0.1s ease-out;
        }
    </style>
</head>
<body data-barba="wrapper">
    <div class="bg-grid"></div>
    <div class="bg-glow"></div>
    <div class="transition-sweep"></div>
    
    <nav>
        <a href="/" class="logo">AF<span>_</span>Dev</a>
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

    <!-- Tracking Avatar Widget -->
    <div id="interactive-avatar-wrapper" title="I'm watching your cursor!">
        <img src="/images/avatar.png" id="interactive-avatar-img" alt="Tracking Avatar">
    </div>

    <script>
        // Avatar Tracking Logic
        const avatarImg = document.getElementById('interactive-avatar-img');
        const wrapper = document.getElementById('interactive-avatar-wrapper');
        
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX;
            const mouseY = e.clientY;
            const rect = wrapper.getBoundingClientRect();
            
            // Center of the avatar wrapper
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            // Calculate angle and distance to cursor
            const deltaX = mouseX - centerX;
            const deltaY = mouseY - centerY;
            
            // Max distance the image can translate within the circle
            const maxTranslation = 20; 
            
            // Calculate movement (normalize based on screen size so it doesn't snap instantly)
            const moveX = (deltaX / window.innerWidth) * maxTranslation * 2;
            const moveY = (deltaY / window.innerHeight) * maxTranslation * 2;
            
            // Clamp values
            const clampedX = Math.max(-maxTranslation, Math.min(maxTranslation, moveX));
            const clampedY = Math.max(-maxTranslation, Math.min(maxTranslation, moveY));
            
            avatarImg.style.transform = `translate(${clampedX}px, ${clampedY}px)`;
        });

        // Initialize Vanilla Tilt
        function initTilt() {
            VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
                max: 6, speed: 400, glare: true, "max-glare": 0.15, scale: 1.02
            });
        }
        document.addEventListener("DOMContentLoaded", initTilt);

        // Barba + GSAP Asynchronous Transitions
        barba.init({
            transitions: [{
                name: 'async-sweep-transition',
                async leave(data) {
                    const done = this.async();
                    
                    // Sweep in from right to fully cover the screen
                    await gsap.fromTo('.transition-sweep', 
                        { scaleX: 0, transformOrigin: 'right' },
                        { scaleX: 1, duration: 0.6, ease: 'power4.inOut' }
                    );
                    
                    // Tell Barba we are done animating, safe to swap DOM
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
                    
                    initTilt();

                    // Sweep out to left revealing new page
                    gsap.fromTo('.transition-sweep', 
                        { scaleX: 1, transformOrigin: 'left' },
                        { scaleX: 0, duration: 0.6, ease: 'power4.inOut' }
                    );
                    
                    // Fade in content
                    return gsap.from(data.next.container.querySelector('.page-wrapper'), {
                        x: 40, opacity: 0, duration: 0.8, delay: 0.1, ease: 'power3.out'
                    });
                }
            }]
        });
    </script>
</body>
</html>
