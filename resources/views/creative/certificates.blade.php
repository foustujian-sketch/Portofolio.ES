@extends('layouts.creative')

@section('content')
    <h1>Certificates</h1>
    <p style="opacity: 0.7; margin-bottom: 2rem;">> Loading credentials...</p>

    <div class="card">
        <h3>INFORSA Certification</h3>
        <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="max-width: 100%; margin-top: 1rem; border: 1px solid rgba(255,255,255,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
    </div>

    <div class="card">
        <h3>Professional Achievement</h3>
        <img src="/images/certs/download.png" alt="Certificate" style="max-width: 100%; margin-top: 1rem; border: 1px solid rgba(255,255,255,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
    </div>
@endsection
