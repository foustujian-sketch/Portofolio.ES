@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <span class="mono-data">Backend Engineer &bull; Information Systems</span>
    </div>
    
    <h1>Abdurrahman</h1>
    <h1 style="color: var(--accent-blue);">Al Farisy</h1>

    <!-- Dossier Header: Strict alignment, real photo, pure typography -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 4rem; margin-top: 6rem; margin-bottom: 8rem; align-items: start;">
        
        <!-- The Real Photo: Zero styling, sits directly on the grid -->
        <div>
            <img src="https://avatars.githubusercontent.com/foustujian-sketch" alt="Abdurrahman Al Farisy" style="width: 100%; max-width: 400px; display: block;">
        </div>

        <!-- Structural Data -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <div>
                <span class="mono-data">Focus</span>
                <p style="margin-top: 0.5rem; font-weight: 400;">Engineering scalable web architectures and robust APIs. Bridging server-side logic (Laravel, PostgreSQL) with fluid client-side interfaces (Flutter, Dart).</p>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <span class="mono-data">Education</span>
                    <div style="margin-top: 0.5rem; font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em;">Universitas Mulawarman</div>
                    <div style="color: var(--text-muted); font-size: 0.95rem;">Information System</div>
                    <div class="mono-data" style="margin-top: 0.25rem;">(2024 - 2028)</div>
                </div>
                
                <div>
                    <span class="mono-data">Location</span>
                    <div style="margin-top: 0.5rem; font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em;">Samarinda</div>
                    <div style="color: var(--text-muted); font-size: 0.95rem;">East Kalimantan</div>
                    <div class="mono-data" style="margin-top: 0.25rem;">Indonesia</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Experience List (No Cards, strict tabular format) -->
    <h2>Institutional Roles</h2>
    
    <div style="display: flex; flex-direction: column; border-top: 1px solid #eee;">
        
        <div style="display: grid; grid-template-columns: 150px 1fr; padding: 2rem 0; border-bottom: 1px solid #eee; align-items: baseline;">
            <div class="mono-data">2025</div>
            <div>
                <div style="font-weight: 700; font-size: 1.25rem; letter-spacing: -0.03em; margin-bottom: 0.5rem;">Relations & Sponsorship Committee (INSEVENT)</div>
                <p style="font-size: 1.1rem; color: var(--text-muted); margin: 0;">Managed external communications, secured financial sponsorships, and established critical media partnerships for large-scale organizational events.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 150px 1fr; padding: 2rem 0; border-bottom: 1px solid #eee; align-items: baseline;">
            <div class="mono-data">2025</div>
            <div>
                <div style="font-weight: 700; font-size: 1.25rem; letter-spacing: -0.03em; margin-bottom: 0.5rem;">Advocacy & Student Welfare (INFORSA)</div>
                <p style="font-size: 1.1rem; color: var(--text-muted); margin: 0;">Acted as the primary liaison between the Information Systems student body and university administration, prioritizing academic rights and welfare.</p>
            </div>
        </div>
        
    </div>
@endsection
