<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Portfolio</title>
    
    <!-- Premium Fonts for Neobrutalism -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Space Grotesk for chunky headers, JetBrains Mono for data/body -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>

    <style>
        :root {
            --bg-base: #F4F0E6; /* Raw Paper Beige */
            --border-main: #000000;
            --text-primary: #000000;
            --accent-yellow: #FFB800; /* Mustard Yellow from Jacket */
            --accent-red: #FF3333; /* Red from photo background */
            --accent-cyan: #00E5FF; 
            
            --border-thick: 4px solid var(--border-main);
            --shadow-brutal: 8px 8px 0px var(--border-main);
            --shadow-brutal-hover: 4px 4px 0px var(--border-main);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'JetBrains Mono', monospace; 
            background-color: var(--bg-base); 
            color: var(--text-primary); 
            overflow-x: hidden;
            line-height: 1.6;
            background-image: 
                linear-gradient(var(--border-main) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-main) 1px, transparent 1px);
            background-size: 100px 100px; /* Big raw grid */
            background-position: -1px -1px;
        }

        /* Top Navigation */
        nav { 
            padding: 1.5rem 4vw; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 100;
            background: var(--bg-base);
            border-bottom: var(--border-thick);
        }
        
        .logo { 
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700; 
            font-size: 1.8rem; 
            text-decoration: none; 
            color: var(--text-primary); 
            text-transform: uppercase;
            letter-spacing: -1px;
            background: var(--accent-yellow);
            padding: 0.2rem 1rem;
            border: var(--border-thick);
            box-shadow: 4px 4px 0px #000;
        }

        .nav-links { display: flex; gap: 1rem; }
        .nav-links a { 
            color: var(--text-primary); 
            text-decoration: none; 
            font-weight: 800; 
            font-size: 1rem; 
            text-transform: uppercase;
            padding: 0.6rem 1.2rem;
            border: var(--border-thick);
            background: #fff;
            box-shadow: var(--shadow-brutal);
            transition: all 0.1s ease-out;
        }
        
        .nav-links a:hover, .nav-links a.active { 
            transform: translate(4px, 4px);
            box-shadow: var(--shadow-brutal-hover);
        }
        
        .nav-links a.active {
            background: var(--accent-red);
            color: #fff;
        }

        .page-wrapper { 
            min-height: 100vh; padding: 10rem 4vw 5rem 4vw; max-width: 1200px; margin: 0 auto;
        }
        
        h1 { 
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3.5rem, 8vw, 6rem); 
            font-weight: 700; 
            line-height: 1; 
            margin-bottom: 2rem; 
            text-transform: uppercase;
            letter-spacing: -2px;
        }
        
        h2 { 
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem; 
            font-weight: 700; 
            margin-bottom: 2rem; 
            text-transform: uppercase;
            background: #fff;
            display: inline-block;
            padding: 0.5rem 1rem;
            border: var(--border-thick);
            box-shadow: 4px 4px 0px #000;
        }

        /* Neobrutalist Cards */
        .card { 
            background: #fff;
            border: var(--border-thick); 
            padding: 2rem; 
            box-shadow: var(--shadow-brutal);
            transition: all 0.1s ease-out;
            position: relative;
        }
        
        .card:hover { 
            transform: translate(4px, 4px);
            box-shadow: var(--shadow-brutal-hover);
        }

        .card h3 { 
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem; 
            font-weight: 700; 
            margin-bottom: 1rem; 
            text-transform: uppercase;
        }

        /* Sweep Transition Layer */
        .transition-sweep { 
            position: fixed; inset: 0; background: var(--border-main); 
            transform: scaleY(0); transform-origin: top; 
            z-index: 9999; pointer-events: none; 
        }
        
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 3rem; }
    </style>
</head>
<body data-barba="wrapper">
    <div class="transition-sweep"></div>
    
    <nav>
        <a href="/" class="logo">AL_FARISY</a>
        <div class="nav-links">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">INFO</a>
            <a href="/projects" class="{{ request()->is('projects') ? 'active' : '' }}">BUILD</a>
            <a href="/certificates" class="{{ request()->is('certificates') ? 'active' : '' }}">CERTS</a>
        </div>
    </nav>
    
    <main data-barba="container" data-barba-namespace="{{ request()->path() }}">
        <div class="page-wrapper">
            @yield('content')
        </div>
    </main>

    <script>
        // Brutalist Barba Transitions (Hard snaps)
        barba.init({
            transitions: [{
                name: 'brutal-transition',
                async leave(data) {
                    const done = this.async();
                    
                    // Slam down the black screen
                    await gsap.fromTo('.transition-sweep', 
                        { scaleY: 0, transformOrigin: 'top' },
                        { scaleY: 1, duration: 0.3, ease: 'power4.in' }
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

                    // Snap open
                    gsap.fromTo('.transition-sweep', 
                        { scaleY: 1, transformOrigin: 'bottom' },
                        { scaleY: 0, duration: 0.4, ease: 'power4.out', delay: 0.1 }
                    );
                }
            }]
        });
    </script>
</body>
</html>
