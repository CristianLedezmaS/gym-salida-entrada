@extends('layouts.app')

@section('content')
<style>
    body, .page-content, .container-home-dark {
        background: #181828 !important;
    }
    .card-home-dark {
        background: #23232e;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        padding: 2.5rem 2rem;
        color: #fff;
        max-width: 500px;
        margin: 2rem auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 0.7s;
    }
    .btn-qr-neon {
        background: linear-gradient(90deg, #00ff88 0%, #00aaff 100%) !important;
        color: #181828 !important;
        border: none !important;
        border-radius: 12px !important;
        font-size: 1.3rem !important;
        font-weight: bold !important;
        padding: 1rem 2.5rem !important;
        margin: 1.5rem 0 2rem 0 !important;
        box-shadow: 0 0 18px #00ff88, 0 2px 8px rgba(0,0,0,0.10) !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.7rem !important;
        transition: all 0.2s !important;
    }
    .btn-qr-neon:hover {
        background: linear-gradient(90deg, #00aaff 0%, #00ff88 100%) !important;
        box-shadow: 0 0 28px #00ff88, 0 2px 16px rgba(0,0,0,0.18) !important;
        transform: scale(1.04);
    }
    .qr-video-box {
        background: #23232e;
        border-radius: 16px;
        border: 2px solid #00ff88;
        box-shadow: 0 0 18px #00ff8833;
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
        background: #1a1a2e;
        box-shadow: 0 0 12px #00ff8844;
    }
    .home-title-neon {
        color: #00ff88;
        font-size: 2.2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.2rem;
        text-shadow: 0 0 10px #00ff88;
    }
    .home-info-box {
        background: #181828;
        border-radius: 12px;
        color: #fff;
        font-size: 1.1rem;
        padding: 0.7rem 1.2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        display: inline-block;
    }
</style>
<div class="container-home-dark">
    <div class="card-home-dark">
        <h1 class="home-title-neon">BIENVENIDO: {{ strtoupper(Auth::user()->nombre) }}</h1>
        <div class="home-info-box mb-4">Clases restantes: <b>{{ Auth::user()->DR }}</b></div>
        <button onclick="activarCamara()" class="btn-qr-neon mx-auto">
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
        Instascan.Camera.getCameras().then(function(cameras) {
            var backCamera = cameras.find(function(camera) {
                return camera.name && camera.name.indexOf('back') !== -1;
            });
            if (backCamera) {
                scanner.start(backCamera);
                activeCamera = cameras.indexOf(backCamera);
            } else if (cameras.length > 0) {
                scanner.start(cameras[0]);
                activeCamera = 0;
            } else {
                console.error('No se encontraron cámaras disponibles.');
            }
        }).catch(function(e) {
            console.error(e);
        });
        scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            mirror: false,
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
            window.location.href = content;
            document.getElementById("audio").play();
        });
    }
</script>
@endsection