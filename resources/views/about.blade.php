@extends('layouts.app')

@section('title', 'Abdurrahman Al Farisy - Backend Developer')

@section('content')

    <section id="profile" class="page-section profile-section" data-nav-section="profile">
    <div class="hero">
        <div class="reveal">
            <span class="eyebrow">Samarinda based backend developer</span>
            <h1 class="heading-xl">
                Laravel APIs,
                <span class="heading-gradient">clean data</span>,
                Flutter-ready systems.
            </h1>
            <p class="lead">
                I am Abdurrahman Al Farisy, an Information Systems student at Universitas Mulawarman. I build practical web architectures, optimized relational databases, and integrations that connect Laravel backends with mobile products.
            </p>

            <div class="action-row">
                <a href="https://github.com/foustujian-sketch" target="_blank" rel="noreferrer" class="btn-primary">
                    <span>GitHub</span>
                </a>
                <a href="https://www.linkedin.com/in/abdurrahman-al-farisy-580885328" target="_blank" rel="noreferrer" class="btn-ghost">
                    <span>LinkedIn</span>
                </a>
                <a href="mailto:foustujian@gmail.com" class="btn-ghost">
                    <span>Contact</span>
                </a>
            </div>

            <div class="status-strip reveal">
                <div>
                    <strong>2024</strong>
                    <span>Information Systems student</span>
                </div>
                <div>
                    <strong>3</strong>
                    <span>Core stack: Laravel, PostgreSQL, Flutter</span>
                </div>
                <div>
                    <strong>2025</strong>
                    <span>INFORSA and INSEVENT committee work</span>
                </div>
            </div>
        </div>

        <div class="avatar-3d-container reveal" id="avatar-3d-canvas-container" aria-label="Interactive 3D avatar">
            <canvas id="avatar-canvas"></canvas>
            <div class="avatar-3d-fallback" role="status" aria-live="polite">
                <div class="avatar-loader" aria-hidden="true">
                    <span class="loader-orbit loader-orbit-outer"></span>
                    <span class="loader-orbit loader-orbit-inner"></span>
                    <span class="loader-core">AF</span>
                </div>
                <div class="loader-meta">
                    <span class="loader-title">Loading 3D scene</span>
                    <span class="font-mono text-xs" data-avatar-loading-text>Preparing</span>
                </div>
                <div class="loader-progress" aria-hidden="true">
                    <span data-avatar-loading-progress></span>
                </div>
            </div>
        </div>
    </div>

    <div class="section-intro reveal">
        <div>
            <span class="section-kicker font-mono">What I work on</span>
            <h2 class="heading-md mt-1">Systems built to stay understandable.</h2>
        </div>
        <p class="text-muted text-sm">From database structure to the interface consuming it.</p>
    </div>

    <div class="grid-2">
        <div class="inner-card reveal">
            <div class="card-content">
                <span class="pill">Backend</span>
                <h2 class="heading-md mt-2">API development and system automation</h2>
                <p class="text-muted mt-2 text-sm" style="line-height: 1.75;">
                    Laravel, REST API design, API integration, authentication flows, and backend logic for products that need to be stable before they look impressive.
                </p>
            </div>
        </div>

        <div class="inner-card reveal">
            <div class="card-content">
                <span class="pill">Database</span>
                <h2 class="heading-md mt-2">Relational schemas that stay readable</h2>
                <p class="text-muted mt-2 text-sm" style="line-height: 1.75;">
                    PostgreSQL, MySQL, Supabase, normalization, query structure, and database planning for applications that grow past the first prototype.
                </p>
            </div>
        </div>

        <div class="inner-card reveal">
            <div class="card-content">
                <span class="pill">Mobile</span>
                <h2 class="heading-md mt-2">Flutter frontends connected to real backends</h2>
                <p class="text-muted mt-2 text-sm" style="line-height: 1.75;">
                    Cross-platform mobile app work with Dart and Flutter, focused on clean data flow between screens, APIs, and user-facing features.
                </p>
            </div>
        </div>

        <div class="inner-card reveal">
            <div class="card-content">
                <span class="pill">Education</span>
                <h2 class="heading-md mt-2">Universitas Mulawarman</h2>
                <p class="text-muted mt-2 text-sm" style="line-height: 1.75;">
                    Information Systems, September 2024 to 2028. Based in Samarinda, East Kalimantan, Indonesia.
                </p>
            </div>
        </div>

        <div class="inner-card reveal grid-span-full">
            <div class="card-content">
                <span class="pill">Experience</span>
                <h2 class="heading-md mt-2">Information System Association (INFORSA)</h2>

                <div class="divider"></div>

                <div class="flex flex-col gap-4">
                    <div>
                        <div class="flex items-center gap-2" style="flex-wrap: wrap;">
                            <h3 class="heading-md">Relations and Sponsorship Committee</h3>
                            <span class="pill">INSEVENT 2025</span>
                        </div>
                        <p class="font-mono text-xs text-muted mt-1">March 2025 - December 2025</p>
                        <p class="text-muted mt-2 text-sm" style="line-height: 1.75; max-width: 820px;">
                            Managed external communication, sponsorship negotiation, and media partnerships for a major organizational event with a long preparation and execution phase.
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center gap-2" style="flex-wrap: wrap;">
                            <h3 class="heading-md">Staff of Advocacy and Student Welfare</h3>
                            <span class="pill">INFORSA</span>
                        </div>
                        <p class="font-mono text-xs text-muted mt-1">February 2025 - December 2025</p>
                        <p class="text-muted mt-2 text-sm" style="line-height: 1.75; max-width: 820px;">
                            Worked as a liaison between students and administration, supporting grievance resolution, dialogue forums, and student welfare initiatives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    @include('partials.projects', ['projects' => $projects ?? []])
    @include('partials.credentials')

@endsection
