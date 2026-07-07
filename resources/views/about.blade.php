@extends('layouts.app')

@section('content')
    <div style="display: flex; gap: 4rem; margin-bottom: 6rem; flex-wrap: wrap; align-items: flex-start;">
        
        <!-- Dual Avatar Section -->
        <div style="display: flex; flex-direction: column; gap: 2rem; min-width: 280px;">
            <!-- Primary Real Photo -->
            <div style="border: var(--border-thick); box-shadow: var(--shadow-brutal); background: var(--accent-red); padding: 1rem; transform: rotate(-2deg);">
                <img src="https://avatars.githubusercontent.com/foustujian-sketch" alt="Real Photo" style="width: 100%; height: auto; border: var(--border-thick); display: block; filter: grayscale(100%) contrast(1.2);">
                <div style="margin-top: 1rem; font-weight: 800; text-align: center; font-size: 1.2rem; background: #fff; border: var(--border-thick); padding: 0.5rem;">[ ROOT_USER ]</div>
            </div>

            <!-- Secondary Generated Avatar -->
            <div style="border: var(--border-thick); box-shadow: var(--shadow-brutal); background: var(--accent-yellow); padding: 1rem; transform: rotate(3deg);">
                <img src="/images/avatar-generated.png" alt="Generated Avatar" style="width: 100%; height: auto; border: var(--border-thick); display: block;">
                <div style="margin-top: 1rem; font-weight: 800; text-align: center; font-size: 1.2rem; background: #fff; border: var(--border-thick); padding: 0.5rem;">[ VECTOR_SYNC ]</div>
            </div>
        </div>

        <!-- Bio Details -->
        <div style="flex: 1; min-width: 300px;">
            <div style="display: inline-block; padding: 0.5rem 1rem; background: #fff; border: var(--border-thick); box-shadow: 4px 4px 0px #000; font-weight: 800; font-size: 1rem; margin-bottom: 2rem;">
                SYSTEM.STATUS = ONLINE
            </div>
            
            <h1>Software Engineer</h1>
            
            <div class="card" style="margin-bottom: 2rem; background: var(--accent-yellow);">
                <p style="font-size: 1.2rem; font-weight: 600; line-height: 1.6;">
                    Backend Developer &amp; Information Systems Student. Specializing in Laravel, Flutter, and PostgreSQL. Building scalable web architectures, APIs, and brutalist terminal applications.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="card" style="padding: 1.5rem;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; font-weight: 800;">LOCATION</div>
                    <div style="font-weight: 800; font-size: 1.2rem; font-family: 'Space Grotesk', sans-serif;">Samarinda,<br>Indonesia</div>
                </div>
                <div class="card" style="padding: 1.5rem; background: var(--accent-red); color: #fff;">
                    <div style="font-size: 0.9rem; margin-bottom: 0.5rem; font-weight: 800; color: #000;">EDUCATION</div>
                    <div style="font-weight: 800; font-size: 1.2rem; font-family: 'Space Grotesk', sans-serif;">Universitas<br>Mulawarman</div>
                    <div style="margin-top: 1rem; background: #000; color: #fff; padding: 0.2rem 0.5rem; display: inline-block; font-weight: bold; border: 2px solid #fff;">GPA: 3.98</div>
                </div>
            </div>
        </div>
    </div>

    <h2>System.Experience</h2>
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <div class="card">
            <h3>Relations & Sponsorship Committee</h3>
            <p style="font-weight: 800; color: var(--accent-red); margin-bottom: 1rem; border-bottom: 2px solid #000; padding-bottom: 0.5rem; display: inline-block;">INSEVENT 2025 (Mar 2025 - Dec 2025)</p>
            <p style="font-size: 1.1rem; font-weight: 500;">Served on the Public Relations and Sponsorship committee. Managed external communications, secured financial sponsorships, and established critical media partnerships.</p>
        </div>
        
        <div class="card">
            <h3>Advocacy & Student Welfare</h3>
            <p style="font-weight: 800; color: var(--accent-red); margin-bottom: 1rem; border-bottom: 2px solid #000; padding-bottom: 0.5rem; display: inline-block;">INFORSA (Feb 2025 - Dec 2025)</p>
            <p style="font-size: 1.1rem; font-weight: 500;">Acted as the primary liaison between the Information Systems student body and university administration, ensuring students' academic rights and welfare were heavily prioritized.</p>
        </div>
    </div>
@endsection
