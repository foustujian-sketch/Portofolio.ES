@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 2rem;">Credentials</h1>
    <p style="margin-bottom: 3rem; max-width: 600px;">
        Verified certifications and institutional achievements.
    </p>

    <div class="bento-grid">
        
        <div class="bento-card" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                <div>
                    <h3 style="font-weight: 600; font-size: 1.1rem; color: var(--foreground);">INFORSA Certification</h3>
                    <span class="font-mono text-muted text-sm mt-1 block">Committee Achievement</span>
                </div>
            </div>
            
            <div style="border: 1px solid var(--border); border-radius: calc(var(--radius) - 2px); overflow: hidden; background: #fff; padding: 0.25rem;">
                <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="width: 100%; height: auto; display: block; border-radius: calc(var(--radius) - 4px);">
            </div>
        </div>

        <div class="bento-card" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                <div>
                    <h3 style="font-weight: 600; font-size: 1.1rem; color: var(--foreground);">Professional Achievement</h3>
                    <span class="font-mono text-muted text-sm mt-1 block">Independent Certification</span>
                </div>
            </div>
            
            <div style="border: 1px solid var(--border); border-radius: calc(var(--radius) - 2px); overflow: hidden; background: #fff; padding: 0.25rem;">
                <img src="/images/certs/download.png" alt="Certificate" style="width: 100%; height: auto; display: block; border-radius: calc(var(--radius) - 4px);">
            </div>
        </div>

    </div>
@endsection
