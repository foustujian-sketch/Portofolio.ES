@extends('layouts.clean')

@section('content')
    <h2>Certificates</h2>
    <p class="subtitle" style="margin-bottom: 2rem;">My recent certifications and achievements.</p>

    <div class="card">
        <div class="card-title">INFORSA Certification</div>
        <div class="card-meta">Information System Association</div>
        <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="max-width: 100%; margin-top: 1rem; border-radius: 4px; border: 1px solid var(--border);">
    </div>

    <div class="card">
        <div class="card-title">Professional Development Certificate</div>
        <div class="card-meta">Technical Achievement</div>
        <img src="/images/certs/download.png" alt="Certificate" style="max-width: 100%; margin-top: 1rem; border-radius: 4px; border: 1px solid var(--border);">
    </div>
@endsection
