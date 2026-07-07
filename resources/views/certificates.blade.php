@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 4rem;">
        <span class="mono-data">Verification Logs</span>
        <h1 style="margin-bottom: 0;">Credentials</h1>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 4rem; border-top: 1px solid #eee; padding-top: 4rem;">
        
        <div>
            <span class="mono-data">Issuer: INFORSA</span>
            <div style="font-weight: 700; font-size: 1.5rem; letter-spacing: -0.04em; margin-bottom: 1.5rem; margin-top: 0.5rem;">Committee Certification</div>
            <img src="/images/certs/cert-inforsa.png" alt="INFORSA Certificate" style="width: 100%; height: auto; display: block;">
        </div>

        <div>
            <span class="mono-data">Issuer: Independent</span>
            <div style="font-weight: 700; font-size: 1.5rem; letter-spacing: -0.04em; margin-bottom: 1.5rem; margin-top: 0.5rem;">Professional Achievement</div>
            <img src="/images/certs/download.png" alt="Certificate" style="width: 100%; height: auto; display: block;">
        </div>

    </div>
@endsection
