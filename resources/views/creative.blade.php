<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Creative Portfolio</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap');
        :root { --bg: #050505; --text: #f0f0f0; --accent: #ff3366; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Space Grotesk', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; cursor: crosshair; }
        
        .noise { position: fixed; inset: 0; background: url('https://grainy-gradients.vercel.app/noise.svg'); opacity: 0.05; pointer-events: none; z-index: 999; }
        
        nav { padding: 2rem; display: flex; justify-content: space-between; position: fixed; top: 0; width: 100%; z-index: 100; mix-blend-mode: difference; }
        nav a { color: #fff; text-decoration: none; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; transition: color 0.3s; }
        nav a:hover { color: var(--accent); }
        
        .hero { height: 100vh; display: flex; flex-direction: column; justify-content: center; padding: 0 5vw; position: relative; }
        .title-wrapper { overflow: hidden; }
        h1 { font-size: clamp(3rem, 8vw, 10rem); font-weight: 700; line-height: 1; text-transform: uppercase; margin-bottom: 1rem; }
        .hero p { font-size: clamp(1rem, 2vw, 1.5rem); max-width: 700px; font-weight: 300; opacity: 0.8; margin-top: 1rem; line-height: 1.5;}
        .contact { font-size: 1rem; opacity: 0.6; margin-top: 1rem;}
        
        .projects-marquee { margin-top: 2rem; white-space: nowrap; overflow: hidden; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 2rem 0; }
        .marquee-inner { display: inline-block; font-size: 4rem; font-weight: 700; text-transform: uppercase; padding-left: 2rem; color: transparent; -webkit-text-stroke: 1px var(--text); }
        .marquee-inner span { margin-right: 2rem; transition: color 0.3s; cursor: pointer; }
        .marquee-inner span:hover { color: var(--accent); -webkit-text-stroke: 0px; }
        
        .cursor-follower { position: fixed; width: 40px; height: 40px; border: 2px solid var(--accent); border-radius: 50%; pointer-events: none; transform: translate(-50%, -50%); z-index: 1000; transition: width 0.2s, height 0.2s; mix-blend-mode: difference; }
    </style>
</head>
<body>
    <div class="noise"></div>
    <div class="cursor-follower" id="cursor"></div>
    
    <nav>
        <a href="/">[ Home ]</a>
        <a href="/clean">[ Clean Mode ]</a>
    </nav>
    
    <section class="hero">
        <div class="title-wrapper"><h1 class="reveal-text">Abdurrahman</h1></div>
        <div class="title-wrapper"><h1 class="reveal-text">Al Farisy</h1></div>
        <div class="title-wrapper"><p class="reveal-text" style="color: var(--accent);">Backend Developer & System Analyst.</p></div>
        <div class="title-wrapper">
            <p class="reveal-text">Information Systems student focused on system analysis, API integration, and relational schema design. Experienced with Laravel, Flutter, PostgreSQL, and Supabase.</p>
        </div>
        <div class="title-wrapper">
            <p class="reveal-text contact">foustujian@gmail.com &mdash; Samarinda, Indonesia</p>
        </div>
    </section>
    
    <div class="projects-marquee">
        <div class="marquee-inner" id="marquee">
            <span>Laravel Architecture</span> &bull; 
            <span>System Automation</span> &bull; 
            <span>Flutter Apps</span> &bull; 
            <span>API Integration</span> &bull;
            <span>PostgreSQL</span> &bull; 
            <span>Supabase</span> &bull;
        </div>
    </div>
    
    <script>
        // Custom Cursor
        const cursor = document.getElementById('cursor');
        document.addEventListener('mousemove', (e) => {
            gsap.to(cursor, { x: e.clientX, y: e.clientY, duration: 0.1, ease: "power2.out" });
        });
        document.querySelectorAll('a, span').forEach(el => {
            el.addEventListener('mouseenter', () => gsap.to(cursor, { width: 80, height: 80, backgroundColor: 'rgba(255,51,102,0.2)' }));
            el.addEventListener('mouseleave', () => gsap.to(cursor, { width: 40, height: 40, backgroundColor: 'transparent' }));
        });

        // Entrance Animation
        gsap.from(".reveal-text", {
            y: 150,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power4.out",
            delay: 0.2
        });

        // Marquee Animation
        gsap.to("#marquee", {
            xPercent: -50,
            repeat: -1,
            duration: 15,
            ease: "linear"
        });
    </script>
</body>
</html>
