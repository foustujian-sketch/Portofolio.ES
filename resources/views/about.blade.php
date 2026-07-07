@extends('layouts.app')

@section('content')
    <!-- Hero Bento -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
        
        <div class="bento-card" style="display: flex; flex-direction: column; justify-content: center; padding: 3rem 2rem; background: linear-gradient(to right bottom, rgba(39,39,42,0.5), transparent);">
            <div style="display: flex; gap: 2rem; align-items: center; flex-wrap: wrap;">
                
                <!-- The Real Photo -->
                <img src="https://avatars.githubusercontent.com/foustujian-sketch" alt="Abdurrahman Al Farisy" style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid var(--border); box-shadow: 0 4px 20px rgba(0,0,0,0.5); object-fit: cover;">
                
                <div>
                    <h1 style="margin-bottom: 0.5rem;">Abdurrahman Al Farisy</h1>
                    <p style="color: var(--foreground); font-size: 1.1rem; max-width: 600px;">
                        Backend Developer &amp; Information Systems Student. 
                    </p>
                    <p style="margin-top: 0.25rem;">Samarinda, Kalimantan Timur, Indonesia</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Bento Grid -->
    <div class="bento-grid">
        
        <!-- Summary Card -->
        <div class="bento-card" style="grid-column: 1 / -1;">
            <h2>Ringkasan (Summary)</h2>
            <p style="margin-bottom: 1rem; line-height: 1.8;">
                I am a Software Engineer and Information Systems student specializing in Backend Development and Database Optimization. I don't just study theory—I actively build full-scale web architectures and mobile applications that solve real-world problems.
            </p>
            <p style="margin-bottom: 1.5rem; line-height: 1.8;">
                <strong>What I Do:</strong> I handle the complexities of system automation, design optimized relational databases, and build seamless integrations between Laravel backends and Flutter mobile apps. I am actively open to technical discussions, development collaborations, and Software Engineering internships.
            </p>
            
            <div class="terminal-block" style="max-width: 400px;">
                <span>$ github.com/foustujian-sketch</span>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14L14 1M14 1H5M14 1V10" stroke="currentColor" stroke-linecap="square"/></svg>
            </div>
        </div>

        <!-- Tech Stack Card -->
        <div class="bento-card">
            <h2 style="margin-bottom: 1.5rem;">Technical Arsenal</h2>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <span class="font-mono text-muted text-sm uppercase block mb-1">Backend</span>
                    <span style="color: var(--foreground); font-weight: 500;">Laravel, API Integration, Relational Schema Design</span>
                </div>
                <div>
                    <span class="font-mono text-muted text-sm uppercase block mb-1">Database</span>
                    <span style="color: var(--foreground); font-weight: 500;">PostgreSQL, MySQL, Supabase</span>
                </div>
                <div>
                    <span class="font-mono text-muted text-sm uppercase block mb-1">Mobile & Frontend</span>
                    <span style="color: var(--foreground); font-weight: 500;">Flutter, Full-Stack Development</span>
                </div>
                <div>
                    <span class="font-mono text-muted text-sm uppercase block mb-1">Top Skills</span>
                    <span style="color: var(--foreground); font-weight: 500;">API Development, PostgreSQL</span>
                </div>
            </div>
        </div>

        <!-- Education & Contact Card -->
        <div class="bento-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h2 style="margin-bottom: 1.5rem;">Pendidikan</h2>
                <div style="margin-bottom: 1.5rem;">
                    <div style="color: var(--foreground); font-weight: 500; font-size: 1.1rem;">Universitas Mulawarman</div>
                    <div class="text-muted">Information System</div>
                    <div class="font-mono text-muted text-sm mt-1">Sep 2024 - 2028</div>
                </div>
            </div>

            <div>
                <h2 style="margin-bottom: 1rem; font-size: 1rem;">Hubungi</h2>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.9rem;">
                    <span class="text-muted">Jl Pulau Panjang GG . awa Bakti</span>
                    <span class="text-muted">foustujian@gmail.com</span>
                    <span class="text-muted">+6285828237918</span>
                </div>
            </div>
        </div>

        <!-- Experience Card -->
        <div class="bento-card" style="grid-column: 1 / -1;">
            <h2>Pengalaman (Experience)</h2>
            
            <div style="margin-top: 2rem; display: flex; flex-direction: column; gap: 2rem;">
                <!-- INSEVENT -->
                <div style="border-left: 1px solid var(--border); padding-left: 1.5rem; position: relative;">
                    <div style="position: absolute; left: -4px; top: 0; width: 7px; height: 7px; border-radius: 50%; background: var(--foreground);"></div>
                    <div style="color: var(--foreground); font-weight: 600; font-size: 1.1rem;">Relations and Sponsorship Committee (INSEVENT 2025)</div>
                    <div class="font-mono text-muted text-sm mt-1 mb-3">Maret 2025 - Desember 2025 (10 bulan)</div>
                    <p style="line-height: 1.7; max-width: 800px;">
                        Served on the Public Relations and Sponsorship (Humdan) committee for INSEVENT 2025, a major organizational event spanning a 9-month preparation and execution phase. Managed external communications, secured financial sponsorships, and established media partnerships. Successfully negotiated with external stakeholders to ensure the event's promotional reach and financial target were met.
                    </p>
                </div>

                <!-- INFORSA -->
                <div style="border-left: 1px solid var(--border); padding-left: 1.5rem; position: relative;">
                    <div style="position: absolute; left: -4px; top: 0; width: 7px; height: 7px; border-radius: 50%; background: var(--muted-foreground);"></div>
                    <div style="color: var(--foreground); font-weight: 600; font-size: 1.1rem;">Staff of Advocacy and Student Welfare (INFORSA)</div>
                    <div class="font-mono text-muted text-sm mt-1 mb-3">Februari 2025 - Desember 2025 (11 bulan)</div>
                    <p style="line-height: 1.7; max-width: 800px;">
                        Acted as the primary liaison between the Information Systems student body and university administration, ensuring students' academic rights and welfare were prioritized. Managed grievance resolution, facilitated open dialogue forums, and coordinated welfare initiatives. Collaborated across divisions to maintain a supportive, inclusive, and communicative academic environment.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
