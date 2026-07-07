@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 4rem; background: var(--accent-red); color: #fff; display: inline-block; padding: 1rem 2rem; border: var(--border-thick); box-shadow: var(--shadow-brutal);">Verified_Certs</h1>

    <div class="grid-layout">
        <div class="card" style="background: var(--accent-cyan);">
            <h3 style="margin-bottom: 1.5rem;">INFORSA Certification</h3>
            <div style="border: var(--border-thick); box-shadow: 6px 6px 0px #000; background: #fff; padding: 0.5rem;">
                <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="width: 100%; height: auto; display: block; border: 2px solid #000; filter: contrast(1.2) grayscale(20%);">
            </div>
        </div>

        <div class="card" style="background: var(--accent-yellow);">
            <h3 style="margin-bottom: 1.5rem;">Professional Achievement</h3>
            <div style="border: var(--border-thick); box-shadow: 6px 6px 0px #000; background: #fff; padding: 0.5rem;">
                <img src="/images/certs/download.png" alt="Certificate" style="width: 100%; height: auto; display: block; border: 2px solid #000; filter: contrast(1.2) grayscale(20%);">
            </div>
        </div>
    </div>
@endsection
