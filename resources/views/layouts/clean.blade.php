<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdurrahman Al Farisy | Clean Portfolio</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
        :root { --bg: #fafafa; --text: #111; --gray: #666; --border: #eaeaea; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }
        .container { max-width: 800px; margin: 0 auto; padding: 4rem 2rem; }
        header { margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 2rem; }
        h1 { font-size: 2.5rem; font-weight: 600; letter-spacing: -0.5px; margin-bottom: 0.5rem; }
        .subtitle { color: var(--gray); font-size: 1.1rem; }
        
        nav { display: flex; gap: 1.5rem; margin-bottom: 3rem; flex-wrap: wrap; }
        nav a { color: var(--gray); text-decoration: none; font-weight: 600; padding-bottom: 2px; border-bottom: 2px solid transparent; transition: all 0.2s; }
        nav a:hover, nav a.active { color: var(--text); border-bottom-color: var(--text); }
        .back-link { margin-right: auto; }
        
        main { min-height: 50vh; }
        
        /* Shared components */
        h2 { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; }
        .card { background: #fff; border: 1px solid var(--border); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; }
        .card-title { font-weight: 600; font-size: 1.2rem; }
        .card-meta { color: var(--gray); font-size: 0.9rem; margin-top: 0.2rem; margin-bottom: 0.8rem;}
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/" class="back-link">&larr; Hub</a>
            <a href="/clean" class="{{ request()->is('clean') ? 'active' : '' }}">About</a>
            <a href="/clean/projects" class="{{ request()->is('clean/projects') ? 'active' : '' }}">Projects</a>
            <a href="/clean/certificates" class="{{ request()->is('clean/certificates') ? 'active' : '' }}">Certificates</a>
        </nav>
        
        <header>
            <h1>Abdurrahman Al Farisy</h1>
            <p class="subtitle">Information Systems Student & Backend Developer</p>
        </header>
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
