<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Portfolio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>

    <style>
        :root {
            --bg-base: #171a21;
            --bg-panel: #1b2838;
            --bg-nav: #171a21;
            --text-primary: #c6d4df;
            --text-muted: #8f98a0;
            --accent-blue: #66c0f4;
            --panel-accent: #2a475e;
            --steam-green: #5c7e10;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-base); 
            color: var(--text-primary); 
            overflow-x: hidden;
            line-height: 1.5;
        }

        nav { 
            background-color: var(--bg-nav);
            padding: 1.5rem 6vw; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 100;
            border-bottom: 1px solid #000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        .logo { 
            font-weight: 700; font-size: 1.4rem; text-transform: uppercase; 
            text-decoration: none; color: #fff; letter-spacing: 1px;
        }

        .nav-links { display: flex; gap: 2rem; }
        .nav-links a { 
            color: var(--text-primary); text-decoration: none; font-weight: 500; 
            font-size: 1rem; text-transform: uppercase; padding-bottom: 5px;
            border-bottom: 3px solid transparent; transition: color 0.2s, border-color 0.2s; 
        }
        .nav-links a:hover { color: #fff; }
        .nav-links a.active { color: var(--accent-blue); border-bottom-color: var(--accent-blue); }

        .page-wrapper { 
            min-height: 100vh; padding: 8rem 6vw 5rem 6vw; max-width: 1400px; margin: 0 auto;
        }
        
        h1, h2, h3 { color: #fff; }
        h1 { 
            font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; margin-bottom: 1.5rem; border-left: 4px solid var(--accent-blue); padding-left: 1rem;
        }
        h2 { font-size: 1.8rem; margin-bottom: 1.5rem; }
        p { color: var(--text-muted); font-size: 1.05rem; }

        .card { 
            background: var(--bg-panel); border-radius: 2px; padding: 1.5rem; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); border: 1px solid #000;
            transition: background 0.3s ease; position: relative; transform-style: preserve-3d;
        }
        .card:hover { background: linear-gradient(135deg, var(--bg-panel) 0%, var(--panel-accent) 100%); }
        .card h3 { font-size: 1.3rem; margin-bottom: 0.5rem; color: var(--accent-blue); }
        .card-inner { transform: translateZ(20px); }

        .btn-steam {
            display: inline-block; background: linear-gradient(to right, #799905 5%, #536904 95%);
            color: #d2efa9; text-decoration: none; padding: 0.5rem 1.5rem; border-radius: 2px;
            font-weight: 400; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px;
            transition: filter 0.2s; border: none; cursor: pointer;
        }
        .btn-steam:hover { filter: brightness(1.2); color: #fff; }

        .transition-layer { 
            position: fixed; inset: 0; background: var(--bg-base); 
            transform: scaleX(0); transform-origin: right; 
            z-index: 1000; pointer-events: none; 
        }
        
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }

        /* Interactive Easter Egg */
        #avatar-easter-egg {
            position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; 
            border-radius: 50%; overflow: hidden; border: 2px solid var(--accent-blue); 
            z-index: 999; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            background: #000;
        }
        #avatar-easter-egg img {
            width: 100%; height: 100%; transition: transform 0.1s ease-out; transform-origin: center;
        }
    </style>
</head>
<body data-barba="wrapper">
    <div class="transition-layer"></div>
    
    <nav>
        <a href="/" class="logo">A. Al Farisy</a>
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

    <div id="avatar-easter-egg" title="Click me!">
        <img src="https://avatars.githubusercontent.com/foustujian-sketch" id="avatar-eye" alt="Avatar">
    </div>

    <script>
        // Avatar Eye Tracking Logic
        const avatar = document.getElementById('avatar-eye');
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX;
            const mouseY = e.clientY;
            const rect = document.getElementById('avatar-easter-egg').getBoundingClientRect();
            const avatarX = rect.left + rect.width / 2;
            const avatarY = rect.top + rect.height / 2;
            
            const angle = Math.atan2(mouseY - avatarY, mouseX - avatarX);
            const distance = 6; 
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;
            
            avatar.style.transform = `translate(${x}px, ${y}px)`;
        });

        document.getElementById('avatar-easter-egg').addEventListener('click', () => {
            gsap.to('#avatar-easter-egg', { rotation: "+=360", duration: 0.6, ease: 'back.out(1.7)' });
        });

        // Initialize Vanilla Tilt
        function initTilt() {
            VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
                max: 8, speed: 400, glare: true, "max-glare": 0.2, scale: 1.02
            });
        }
        document.addEventListener("DOMContentLoaded", initTilt);

        // Barba + GSAP Transitions (Right to Left)
        barba.init({
            transitions: [{
                name: 'slide-right-to-left',
                leave(data) {
                    return gsap.fromTo('.transition-layer', 
                        { scaleX: 0, transformOrigin: 'right' },
                        { scaleX: 1, duration: 0.4, ease: 'power2.inOut' }
                    );
                },
                enter(data) {
                    document.querySelectorAll('.nav-links a').forEach(a => {
                        a.classList.remove('active');
                        let href = a.getAttribute('href');
                        let current = '/' + window.location.pathname.replace(/^\/|\/$/g, '');
                        if (href === current || (href === '/' && current === '/')) {
                            a.classList.add('active');
                        }
                    });
                    initTilt();

                    gsap.fromTo('.transition-layer', 
                        { scaleX: 1, transformOrigin: 'left' },
                        { scaleX: 0, duration: 0.4, ease: 'power2.inOut' }
                    );
                    
                    return gsap.from(data.next.container.querySelector('.page-wrapper'), {
                        x: 50, opacity: 0, duration: 0.5, delay: 0.2
                    });
                }
            }]
        });
    </script>
</body>
</html>
