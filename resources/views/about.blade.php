@extends('layouts.app')

@section('content')
    <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 4rem;">
        <div style="display: inline-block; padding: 0.5rem 1rem; background: rgba(66, 165, 245, 0.1); border: 1px solid var(--accent-blue); color: var(--accent-cyan); border-radius: 20px; font-weight: 500; font-size: 0.9rem; width: fit-content; margin-bottom: 1rem; letter-spacing: 1px;">
            DART &amp; FLUTTER SPECIALIST
        </div>
        <h1>Software Engineer</h1>
        <p style="font-size: 1.25rem; max-width: 800px; color: var(--text-primary);">I engineer highly fluid, cross-platform applications and robust backend systems. Based in Indonesia, specializing in Dart, Flutter, Laravel, and scalable API architecture.</p>
    </div>

    <h2>Professional Experience</h2>
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <div class="card" data-tilt>
            <div class="card-inner">
                <h3 style="color: var(--text-primary);">Relations & Sponsorship Committee</h3>
                <p style="font-family: monospace; color: var(--accent-cyan); margin-bottom: 1rem;">INSEVENT 2025 &bull; Mar 2025 - Dec 2025</p>
                <p>Served on the Public Relations and Sponsorship committee. Managed external communications, secured financial sponsorships, and established critical media partnerships.</p>
            </div>
        </div>
        
        <div class="card" data-tilt>
            <div class="card-inner">
                <h3 style="color: var(--text-primary);">Advocacy & Student Welfare</h3>
                <p style="font-family: monospace; color: var(--accent-cyan); margin-bottom: 1rem;">INFORSA &bull; Feb 2025 - Dec 2025</p>
                <p>Acted as the primary liaison between the Information Systems student body and university administration, ensuring students' academic rights and welfare were heavily prioritized.</p>
            </div>
        </div>
    </div>
@endsection
