@extends('layouts.creative')

@section('content')
    <h1>Projects</h1>
    <p style="opacity: 0.7; margin-bottom: 2rem;">> Fetching from GitHub API...</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
        @if(empty($projects))
            <p>Error loading API data.</p>
        @else
            @foreach($projects as $project)
                <div class="card" style="margin-bottom: 0;">
                    <h3>{{ $project['name'] }}</h3>
                    <p style="color: #888; font-family: monospace; margin-bottom: 1rem;">
                        [{{ $project['language'] ?? 'N/A' }}] // Stars: {{ $project['stargazers_count'] }}
                    </p>
                    <p style="margin-bottom: 1.5rem;">{{ $project['description'] ?? 'No description.' }}</p>
                    <a href="{{ $project['html_url'] }}" target="_blank">View_Source</a>
                </div>
            @endforeach
        @endif
    </div>
@endsection
