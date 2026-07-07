@extends('layouts.clean')

@section('content')
    <h2>Top Projects</h2>
    <p class="subtitle" style="margin-bottom: 2rem;">Dynamically fetched from my GitHub repositories.</p>

    @if(empty($projects))
        <p>No projects found or API limit reached.</p>
    @else
        @foreach($projects as $project)
            <div class="card">
                <div class="card-title">
                    <a href="{{ $project['html_url'] }}" target="_blank" style="color: inherit; text-decoration: none;">
                        {{ str_replace('-', ' ', $project['name']) }}
                    </a>
                </div>
                <div class="card-meta">
                    Language: {{ $project['language'] ?? 'N/A' }} &bull; Stars: {{ $project['stargazers_count'] }}
                </div>
                <p style="color: var(--gray);">{{ $project['description'] ?? 'No description provided.' }}</p>
                <div style="margin-top: 1rem;">
                    <a href="{{ $project['html_url'] }}" target="_blank" style="color: var(--text); font-weight: 600; text-decoration: underline;">View Repository</a>
                </div>
            </div>
        @endforeach
    @endif
@endsection
