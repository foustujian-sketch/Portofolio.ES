@extends('layouts.app')

@section('content')

    <section class="reveal" style="margin-bottom: 3rem;">
        <h1 class="heading-xl">
            <span class="heading-gradient">Projects</span>
        </h1>
        <p class="text-muted mt-2" style="max-width: 500px;">
            Open-source work and recent deployments pulled from GitHub.
        </p>
    </section>

    <div class="grid-2">
        @if(empty($projects))
            <div class="inner-card reveal grid-span-full" style="text-align: center; padding: 4rem 2rem;">
                <div class="card-content">
                    <p class="text-muted">Unable to load projects from GitHub.</p>
                </div>
            </div>
        @else
            @foreach($projects as $project)
                <div class="inner-card reveal" style="display: flex; flex-direction: column;">
                    <div class="card-content" style="flex: 1; display: flex; flex-direction: column;">

                        <div style="margin-bottom: 1rem;">
                            <div class="flex items-center gap-2" style="flex-wrap: wrap; margin-bottom: 0.75rem;">
                                <h3 style="color: #fff; font-weight: 600; font-size: 1.1rem; line-height: 1.3;">
                                    {{ str_replace(['-', '_'], ' ', $project['name']) }}
                                </h3>
                                @if($project['language'] ?? false)
                                    <span class="pill">{{ $project['language'] }}</span>
                                @endif
                            </div>

                            <p class="text-muted text-sm" style="line-height: 1.6;">
                                {{ $project['description'] ?? 'No description provided.' }}
                            </p>
                        </div>

                        <div style="margin-top: auto; padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.06);">
                            <div class="flex items-center" style="justify-content: space-between;">
                                @if(($project['stargazers_count'] ?? 0) > 0)
                                    <span class="font-mono text-xs text-muted flex items-center gap-1">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        {{ $project['stargazers_count'] }}
                                    </span>
                                @else
                                    <span></span>
                                @endif

                                <a href="{{ $project['html_url'] }}" target="_blank" class="btn-ghost" style="padding: 0.4rem 1rem; font-size: 0.8rem;">
                                    View
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
