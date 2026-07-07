@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 3rem;">Technical Portfolio</h1>

    <div class="grid-layout">
        @if(empty($projects))
            <p>Error loading GitHub data.</p>
        @else
            @foreach($projects as $project)
                <div class="card" data-tilt style="display: flex; flex-direction: column;">
                    <div class="card-inner" style="display: flex; flex-direction: column; flex-grow: 1;">
                        <h3 style="overflow-wrap: break-word; word-break: break-word; line-height: 1.2; margin-bottom: 0.5rem; color: #fff;">{{ str_replace(['-', '_'], ' ', $project['name']) }}</h3>
                        
                        <div style="background: rgba(0,0,0,0.4); padding: 5px 12px; border-radius: 4px; margin-bottom: 1.5rem; display: inline-block; border: 1px solid rgba(255,255,255,0.05);">
                            <span style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">Primary Stack: </span>
                            <span style="color: var(--accent-cyan); font-size: 0.85rem; font-weight: bold;">{{ $project['language'] ?? 'N/A' }}</span>
                        </div>
                        
                        <p style="margin-bottom: 2.5rem; flex-grow: 1; font-size: 1rem;">{{ $project['description'] ?? 'No description provided for this repository.' }}</p>
                        
                        <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--text-muted); font-size: 0.85rem; display: flex; align-items: center; gap: 5px;">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"></path></svg>
                                {{ $project['stargazers_count'] }}
                            </span>
                            <a href="{{ $project['html_url'] }}" target="_blank" style="display: inline-block; padding: 0.6rem 1.5rem; background: transparent; color: var(--accent-cyan); text-decoration: none; border-radius: 4px; border: 1px solid var(--accent-cyan); font-weight: 500; font-size: 0.9rem; transition: all 0.3s;" onmouseover="this.style.background='rgba(0,229,255,0.1)'" onmouseout="this.style.background='transparent'">
                                Source Code &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
