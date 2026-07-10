<section id="projects" class="page-section landing-section" data-nav-section="projects">
    <header class="landing-section-header reveal">
        <div>
            <span class="section-number font-mono">02 / Selected work</span>
            <h2 class="section-heading">Projects</h2>
        </div>
        <p class="text-muted">
            A live selection of open-source experiments, Laravel systems, and application work pulled from GitHub.
        </p>
    </header>

    <div class="grid-2 project-grid">
        @if(empty($projects))
            <div class="inner-card reveal grid-span-full empty-state">
                <div class="card-content">
                    <span class="font-mono text-xs">GitHub is taking a moment</span>
                    <p class="text-muted mt-1">The project feed could not be loaded right now.</p>
                </div>
            </div>
        @else
            @foreach($projects as $project)
                <article class="inner-card project-card reveal">
                    <div class="card-content project-card-content">
                        <div>
                            <div class="project-card-header">
                                <h3>{{ str_replace(['-', '_'], ' ', $project['name']) }}</h3>
                                @if($project['language'] ?? false)
                                    <span class="pill">{{ $project['language'] }}</span>
                                @endif
                            </div>
                            <p class="text-muted text-sm project-description">
                                {{ $project['description'] ?? 'A practical build focused on learning, architecture, and useful implementation.' }}
                            </p>
                        </div>

                        <div class="project-card-footer">
                            <span class="font-mono text-xs text-muted">
                                @if(($project['stargazers_count'] ?? 0) > 0)
                                    {{ $project['stargazers_count'] }} GitHub star{{ $project['stargazers_count'] === 1 ? '' : 's' }}
                                @else
                                    Open source
                                @endif
                            </span>
                            <a href="{{ $project['html_url'] }}" target="_blank" rel="noreferrer" class="btn-ghost project-link">
                                View project <span aria-hidden="true">&nearr;</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        @endif
    </div>
</section>
