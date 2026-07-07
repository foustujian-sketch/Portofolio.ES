@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 4rem; background: var(--accent-yellow); display: inline-block; padding: 1rem 2rem; border: var(--border-thick); box-shadow: var(--shadow-brutal);">Deployments</h1>

    <div class="grid-layout">
        @if(empty($projects))
            <div class="card" style="background: var(--accent-red); color: #fff;">
                <h3>System Error</h3>
                <p>Failed to initialize GitHub data stream.</p>
            </div>
        @else
            @foreach($projects as $project)
                <div class="card" style="display: flex; flex-direction: column;">
                    <h3 style="overflow-wrap: break-word; word-break: break-word; line-height: 1.2; margin-bottom: 1rem;">
                        {{ str_replace(['-', '_'], ' ', $project['name']) }}
                    </h3>
                    
                    <div style="background: #000; color: #fff; padding: 0.5rem 1rem; border: var(--border-thick); margin-bottom: 1.5rem; display: inline-block; font-weight: 800; text-transform: uppercase;">
                        Stack_> {{ $project['language'] ?? 'N/A' }}
                    </div>
                    
                    <p style="margin-bottom: 2.5rem; flex-grow: 1; font-size: 1.1rem; font-weight: 500;">
                        {{ $project['description'] ?? 'No data provided in repository.' }}
                    </p>
                    
                    <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; border-top: var(--border-thick); padding-top: 1.5rem;">
                        <span style="font-weight: 800; font-size: 1.2rem; display: flex; align-items: center; gap: 8px;">
                            ★ {{ $project['stargazers_count'] }}
                        </span>
                        <a href="{{ $project['html_url'] }}" target="_blank" style="display: inline-block; padding: 0.6rem 1.5rem; background: var(--accent-cyan); color: #000; text-decoration: none; border: var(--border-thick); box-shadow: 4px 4px 0px #000; font-weight: 800; font-size: 1rem; transition: all 0.1s;" onmouseover="this.style.transform='translate(2px,2px)'; this.style.boxShadow='2px 2px 0px #000';" onmouseout="this.style.transform='none'; this.style.boxShadow='4px 4px 0px #000';">
                            EXECUTE_>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
