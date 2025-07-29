@extends('layouts.app')

@section('content')
<style>
    body, .page-content, .container-home-light {
        background: #f8fafc !important;
    }
    .card-home-light {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem;
        color: #1e293b;
        max-width: 500px;
        margin: 2rem auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 0.7s;
        border: 1px solid #e2e8f0;
    }
    .btn-qr-modern {
        background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 12px !important;
        font-size: 1.3rem !important;
        font-weight: bold !important;
        padding: 1rem 2.5rem !important;
        margin: 1.5rem 0 2rem 0 !important;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25) !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.7rem !important;
        transition: all 0.2s !important;
    }
    .btn-qr-modern:hover {
        background: linear-gradient(90deg, #1d4ed8 0%, #3b82f6 100%) !important;
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.35) !important;
        transform: scale(1.04);
    }
    .qr-video-box {
        background: #ffffff;
        border-radius: 16px;
        border: 2px solid #3b82f6;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.15);
        padding: 1.5rem 1rem;
        margin: 0 auto;
        width: 350px;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #preview {
        width: 100%;
        height: 260px;
        border-radius: 10px;
        background: #f1f5f9;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .home-title-modern {
        color: #3b82f6;
        font-size: 2.2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.2rem;
        text-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);
    }
    .home-info-box {
        background: #f1f5f9;
        border-radius: 12px;
        color: #1e293b;
        font-size: 1.1rem;
        padding: 0.7rem 1.2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        display: inline-block;
        border: 1px solid #e2e8f0;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<div class="container-home-light">
    <div class="card-home-light">
        <h1 class="home-title-modern">BIENVENIDO: {{ strtoupper(Auth::user()->nombre) }}</h1>
        <div class="home-info-box mb-4">Clases restantes: <b>{{ Auth::user()->DR }}</b></div>
        <button onclick="activarCamara()" class="btn-qr-modern mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                <path d="M2 2h2V1H1v3h1V2Zm10-1v1h2v2h1V1h-3Zm2 13h-2v1h3v-3h-1v2ZM2 14v-2H1v3h3v-1H2ZM3 3h1V2H2v2h1V3Zm9 0h1V2h-2v1h1v1Zm1 9h-1v1h2v-2h-1v1ZM3 13H2v1h2v-2H3v1Zm2-9h6V3H5v1Zm0 8h6v-1H5v1Zm8-4v2h1V7h-1Zm-1 1v-2h-1v2h1Zm-2-2v2h1V7h-1Zm-1 1v-2h-1v2h1Zm-2-2v2h1V7h-1Zm-1 1v-2H5v2h1Zm-2 2v2h1v-2H4Zm1 1v-2H5v2h1Zm2 2v-2h-1v2h1Zm1-1v2h1v-2h-1Zm2 2v-2h-1v2h1Zm1-1v2h1v-2h-1Z"/>
            </svg>
            <span>ESCANEAR QR</span>
        </button>
        <audio controls src="{{ asset('mp3/pitido.mp3') }}" id="audio" style="display:none"></audio>
        <div class="qr-video-box mt-3">
            <video id="preview"></video>
        </div>
    </div>
</div>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner;
    let activeCamera = 1;
    function activarCamara() {
        if (scanner) {
            scanner.stop();
            scanner = null;
            document.getElementById('preview').style.display = 'none';
            return;
        }

        scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                if (activeCamera === 1) {
                    scanner.start(cameras[0]);
                } else {
                    scanner.start(cameras[1]);
                }
                document.getElementById('preview').style.display = 'block';
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (c) {
            document.getElementById('audio').play();
            window.location.href = c;
        });
    }

    // Cambiar cámara
    function cambiarCamara() {
        if (scanner) {
            activeCamera = activeCamera === 1 ? 2 : 1;
            activarCamara();
        }
    }
</script>
@endsection