<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Creative Portfolio</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap');
        :root { --bg: #050505; --text: #f0f0f0; --accent: #00ff41; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Space Grotesk', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; }
        
        .noise { position: fixed; inset: 0; background: url('https://grainy-gradients.vercel.app/noise.svg'); opacity: 0.05; pointer-events: none; z-index: 999; }
        
        nav { padding: 2rem 5vw; display: flex; justify-content: space-between; position: fixed; top: 0; width: 100%; z-index: 100; mix-blend-mode: difference; }
        nav a { color: #fff; text-decoration: none; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; transition: color 0.3s; margin-left: 2rem; }
        nav a:hover, nav a.active { color: var(--accent); }
        .nav-links { display: flex; }
        
        .page-wrapper { min-height: 100vh; padding: 8rem 5vw 4rem 5vw; }
        h1 { font-size: clamp(2rem, 5vw, 6rem); font-weight: 700; line-height: 1; text-transform: uppercase; margin-bottom: 2rem; }
        
        /* Shared styling */
        .card { border: 1px solid rgba(255,255,255,0.1); padding: 2rem; margin-bottom: 2rem; transition: border-color 0.3s; background: rgba(255,255,255,0.02); }
        .card:hover { border-color: var(--accent); }
        .card h3 { color: var(--accent); margin-bottom: 0.5rem; font-size: 1.5rem;}
        .card a { color: var(--accent); text-decoration: none; border-bottom: 1px solid var(--accent); }
        .card p { opacity: 0.8; line-height: 1.6; }
        
        .transition-layer { position: fixed; inset: 0; background: var(--accent); transform: scaleY(0); transform-origin: top; z-index: 1000; pointer-events: none; }
    </style>
</head>
<body data-barba="wrapper">
    <div class="noise"></div>
    <div class="transition-layer"></div>
    
    <nav>
        <a href="/" style="margin-left: 0;">[ Hub ]</a>
        <div class="nav-links">
            <a href="/creative" class="{{ request()->is('creative') ? 'active' : '' }}">About</a>
            <a href="/creative/projects" class="{{ request()->is('creative/projects') ? 'active' : '' }}">Projects</a>
            <a href="/creative/certificates" class="{{ request()->is('creative/certificates') ? 'active' : '' }}">Certs</a>
        </div>
    </nav>
    
    <main data-barba="container" data-barba-namespace="{{ request()->path() }}">
        <div class="page-wrapper">
            @yield('content')
        </div>
    </main>

    <script>
        // Efficient Barba + GSAP Transitions
        barba.init({
            transitions: [{
                name: 'slide-transition',
                leave(data) {
                    return gsap.to('.transition-layer', {
                        scaleY: 1,
                        transformOrigin: 'bottom',
                        duration: 0.4,
                        ease: 'power2.inOut'
                    });
                },
                enter(data) {
                    // Update active nav link
                    document.querySelectorAll('.nav-links a').forEach(a => {
                        a.classList.remove('active');
                        if(a.getAttribute('href') === window.location.pathname) {
                            a.classList.add('active');
                        }
                    });

                    // Slide out transition layer
                    gsap.to('.transition-layer', {
                        scaleY: 0,
                        transformOrigin: 'top',
                        duration: 0.4,
                        ease: 'power2.inOut'
                    });
                    
                    // Reveal content efficiently via CSS transforms
                    return gsap.from(data.next.container, {
                        y: 30,
                        opacity: 0,
                        duration: 0.5,
                        delay: 0.2,
                        ease: 'power2.out'
                    });
                }
            }]
        });
    </script>
</body>
</html>
