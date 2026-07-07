@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 2rem;">Deployments</h1>
    <p style="margin-bottom: 3rem; max-width: 600px;">
        A collection of my recent architecture, systems, and full-stack deployments extracted from GitHub.
    </p>

    <div class="bento-grid">
        @if(empty($projects))
            <div class="bento-card" style="grid-column: 1 / -1; display: flex; align-items: center; justify-content: center; padding: 4rem;">
                <p>Failed to initialize GitHub data stream.</p>
            </div>
        @else
            @foreach($projects as $project)
                <div class="bento-card" style="display: flex; flex-direction: column;">
                    
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; font-size: 1.25rem; color: var(--foreground); line-height: 1.2; word-break: break-word;">
                            {{ str_replace(['-', '_'], ' ', $project['name']) }}
                        </h3>
                        <a href="{{ $project['html_url'] }}" target="_blank" style="color: var(--muted-foreground); transition: color 0.2s;">
                            <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.64645 11.3536C3.45118 11.1583 3.45118 10.8417 3.64645 10.6465L10.2929 4L6 4C5.72386 4 5.5 3.77614 5.5 3.5C5.5 3.22386 5.72386 3 6 3L11.5 3C11.6326 3 11.7598 3.05268 11.8536 3.14645C11.9473 3.24021 12 3.36739 12 3.5L12 9C12 9.27614 11.7761 9.5 11.5 9.5C11.2239 9.5 11 9.27614 11 9L11 4.70711L4.35355 11.3536C4.15829 11.5488 3.84171 11.5488 3.64645 11.3536Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                    
                    <p style="margin-bottom: 2rem; flex-grow: 1; font-size: 0.95rem;">
                        {{ $project['description'] ?? 'No description provided.' }}
                    </p>
                    
                    <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 1rem;">
                        <span class="font-mono text-muted text-sm">
                            {{ $project['language'] ?? 'N/A' }}
                        </span>
                        <span style="font-weight: 500; font-size: 0.9rem; color: var(--foreground); display: flex; align-items: center; gap: 4px;">
                            <svg width="14" height="14" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.49992 1.34326C7.30907 1.34326 7.13523 1.45934 7.05436 1.63605L5.47466 5.09139L1.61906 5.48598C1.42159 5.50619 1.25368 5.64201 1.18738 5.83515C1.12108 6.0283 1.16856 6.2435 1.30944 6.38814L4.20986 9.36683L3.38573 13.1557C3.34351 13.3499 3.42171 13.5516 3.58661 13.6738C3.75151 13.7961 3.97401 13.817 4.15844 13.7277L7.49992 12.1121L10.8414 13.7277C11.0258 13.817 11.2483 13.7961 11.4132 13.6738C11.5781 13.5516 11.6563 13.3499 11.6141 13.1557L10.79 9.36683L13.6904 6.38814C13.8313 6.2435 13.8788 6.0283 13.8125 5.83515C13.7462 5.64201 13.5782 5.50619 13.3808 5.48598L9.52518 5.09139L7.94548 1.63605C7.86462 1.45934 7.69077 1.34326 7.49992 1.34326Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                            {{ $project['stargazers_count'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
