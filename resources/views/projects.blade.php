@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 3rem;">Featured Work</h1>

    <div class="grid-layout">
        @if(empty($projects))
            <p>Error loading API data.</p>
        @else
            @foreach($projects as $project)
                <div class="card" data-tilt style="display: flex; flex-direction: column;">
                    <div class="card-inner" style="display: flex; flex-direction: column; flex-grow: 1;">
                        <h3 style="overflow-wrap: break-word; word-break: break-word; line-height: 1.2; margin-bottom: 0.5rem;">{{ str_replace(['-', '_'], ' ', $project['name']) }}</h3>
                        <p style="color: var(--accent); font-family: monospace; font-size: 0.85rem; margin-bottom: 1.5rem;">
                            Language: {{ $project['language'] ?? 'N/A' }} | Stars: {{ $project['stargazers_count'] }}
                        </p>
                        <p style="margin-bottom: 2rem; flex-grow: 1;">{{ $project['description'] ?? 'No description provided for this repository.' }}</p>
                        
                        <div style="margin-top: auto;">
                            <a href="{{ $project['html_url'] }}" target="_blank" style="display: inline-block; padding: 0.8rem 1.5rem; background: rgba(255,255,255,0.05); color: #fff; text-decoration: none; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                                View Source &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
