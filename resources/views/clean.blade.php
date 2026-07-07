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
        header { margin-bottom: 4rem; border-bottom: 1px solid var(--border); padding-bottom: 2rem; }
        h1 { font-size: 2.5rem; font-weight: 600; letter-spacing: -0.5px; }
        h2 { font-size: 1.5rem; font-weight: 600; margin-top: 3rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; }
        .subtitle { color: var(--gray); font-size: 1.1rem; margin-top: 0.5rem; }
        .contact { color: var(--gray); font-size: 0.95rem; margin-top: 0.5rem; }
        .section-content { margin-bottom: 2rem; }
        .item { margin-bottom: 2rem; }
        .item-header { display: flex; justify-content: space-between; align-items: baseline; }
        .item-title { font-weight: 600; font-size: 1.2rem; }
        .item-date { color: var(--gray); font-size: 0.9rem; }
        .item-subtitle { color: var(--text); font-style: italic; margin-bottom: 0.5rem; font-size: 0.95rem; }
        .item-desc { color: var(--gray); margin-top: 0.5rem; }
        .skills-list { list-style: none; display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem; }
        .skills-list li { background: #fff; border: 1px solid var(--border); padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.9rem; }
        nav { display: flex; justify-content: space-between; margin-bottom: 3rem; }
        a { color: var(--text); text-decoration: none; border-bottom: 1px solid var(--text); }
        a:hover { color: var(--gray); border-color: var(--gray); }
        .back-link { border: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/" class="back-link">&larr; Back to Hub</a>
            <a href="/creative" class="back-link">View Creative &rarr;</a>
        </nav>
        <header>
            <h1>Abdurrahman Al Farisy</h1>
            <p class="subtitle">Information Systems Student & Backend Developer</p>
            <p class="contact">Samarinda, Indonesia | foustujian@gmail.com</p>
        </header>
        <main>
            <section>
                <h2>Profile</h2>
                <div class="section-content">
                    <p style="color: var(--gray);">Information Systems student focusing on System Analysis and Software Development, with a specialization in the Backend domain. Experienced in building web architectures based on Laravel and mobile applications using Flutter, supported by a strong understanding of database optimization (PostgreSQL, MySQL, Supabase).</p>
                    <br>
                    <p style="color: var(--gray);">I am accustomed to handling the complexities of API integration, relational schema design, and system automation. Currently, I am actively working on full-scale projects to solve real-world problems and am always open to technical discussions, development collaborations, and career opportunities in the field of Software Engineering.</p>
                </div>
            </section>

            <section>
                <h2>Work Experience</h2>
                <div class="item">
                    <div class="item-header">
                        <div class="item-title">Relations and Sponsorship Committee</div>
                        <div class="item-date">03/2025 &ndash; 12/2025</div>
                    </div>
                    <div class="item-subtitle">Information System Association (INFORSA) - INSEVENT 2025</div>
                    <p class="item-desc">Served on the Public Relations and Sponsorship (Humdan) committee for INSEVENT 2025, a major organizational event spanning a 9-month preparation and execution phase. Managed external communications, secured financial sponsorships, and established media partnerships. Successfully negotiated with external stakeholders to ensure the event's promotional reach and financial target were met.</p>
                </div>
                <div class="item">
                    <div class="item-header">
                        <div class="item-title">Staff of Advocacy and Student Welfare</div>
                        <div class="item-date">02/2025 &ndash; 12/2025</div>
                    </div>
                    <div class="item-subtitle">Information System Association (INFORSA) - Samarinda, Indonesia</div>
                    <p class="item-desc">Acted as the primary liaison between the Information Systems student body and university administration, ensuring students' academic rights and welfare were prioritized. Managed grievance resolution, facilitated open dialogue forums, and coordinated welfare initiatives. Collaborated across divisions to maintain a supportive, inclusive, and communicative academic environment for all members.</p>
                </div>
            </section>

            <section>
                <h2>Education</h2>
                <div class="item">
                    <div class="item-header">
                        <div class="item-title">Information System</div>
                        <div class="item-date">01/2024 &ndash; 01/2028</div>
                    </div>
                    <div class="item-subtitle">Universitas Mulawarman</div>
                </div>
            </section>

            <section>
                <h2>Core Skills</h2>
                <ul class="skills-list">
                    <li>Laravel</li>
                    <li>Flutter</li>
                    <li>PostgreSQL</li>
                    <li>MySQL</li>
                    <li>Supabase</li>
                    <li>API Integration</li>
                    <li>System Analysis</li>
                    <li>Backend Architecture</li>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>
