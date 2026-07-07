@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 3rem;">Certifications</h1>

    <div class="grid-layout">
        <div class="card" data-tilt>
            <div class="card-inner">
                <h3 style="margin-bottom: 1.5rem; color: #fff;">INFORSA Certification</h3>
                <div style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                    <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="width: 100%; height: auto; display: block; filter: contrast(1.1);">
                </div>
            </div>
        </div>

        <div class="card" data-tilt>
            <div class="card-inner">
                <h3 style="margin-bottom: 1.5rem; color: #fff;">Professional Achievement</h3>
                <div style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                    <img src="/images/certs/download.png" alt="Certificate" style="width: 100%; height: auto; display: block; filter: contrast(1.1);">
                </div>
            </div>
        </div>
    </div>
@endsection
