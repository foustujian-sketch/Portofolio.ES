@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 4rem;">
        <span class="mono-data">Repository Logs</span>
        <h1 style="margin-bottom: 0;">Architecture</h1>
    </div>

    <div style="display: flex; flex-direction: column; border-top: 1px solid #eee;">
        @if(empty($projects))
            <div style="padding: 2rem 0; color: var(--accent-blue);">
                <span class="mono-data">Error</span>
                <div>Failed to fetch repository data.</div>
            </div>
        @else
            <!-- Table Header -->
            <div style="display: grid; grid-template-columns: 1fr 2fr 100px 150px; padding: 1rem 0; border-bottom: 1px solid #111; gap: 2rem; display: none;">
                <!-- Hide header on mobile, handled by media queries if we added them, but keeping it simple for now -->
            </div>

            <!-- Table Rows -->
            @foreach($projects as $project)
                <div style="display: grid; grid-template-columns: 1fr 2fr 100px 150px; padding: 2rem 0; border-bottom: 1px solid #eee; gap: 2rem; align-items: baseline;">
                    
                    <div style="font-weight: 700; font-size: 1.2rem; letter-spacing: -0.03em;">
                        {{ str_replace(['-', '_'], ' ', $project['name']) }}
                    </div>
                    
                    <div style="font-weight: 300; font-size: 1.05rem; color: var(--text-muted); max-width: 500px;">
                        {{ $project['description'] ?? 'No description provided.' }}
                    </div>
                    
                    <div class="mono-data" style="color: var(--accent-blue);">
                        {{ $project['language'] ?? 'N/A' }}
                    </div>
                    
                    <div style="text-align: right;">
                        <a href="{{ $project['html_url'] }}" target="_blank" style="font-family: 'IBM Plex Mono', monospace; font-size: 0.85rem; color: #111; text-decoration: none; border-bottom: 1px solid #111; padding-bottom: 2px; text-transform: uppercase;">
                            View Source &rarr;
                        </a>
                    </div>
                    
                </div>
            @endforeach
        @endif
    </div>
@endsection
