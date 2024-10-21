@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permiso NFC requerido</div>

                <div class="card-body">
                    <p>Para poder utilizar la funcionalidad de NFC, necesitas habilitar el permiso en tu dispositivo.</p>
                    <button class="btn btn-primary" onclick="requestNFCPermission()">Solicitar permiso NFC</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function requestNFCPermission() {
    if ('NDEFReader' in window) {
        navigator.bluetooth.requestDevice({
            acceptAllDevices: true,
            optionalServices: ['0x0001']
        })
        .then(device => device.gatt.connect())
        .then(server => server.getPrimaryService('0x0001'))
        .then(service => service.getCharacteristic('0x0002'))
        .then(characteristic => characteristic.startNotifications())
        .then(characteristic => {
            characteristic.addEventListener('characteristicvaluechanged', event => {
                const nfcData = event.target.value.buffer;
                // Enviar los datos NFC al servidor
                sendNFCData(nfcData);
            });
        })
        .catch(error => {
            console.error('Error al solicitar permiso NFC:', error);
            alert('Error al solicitar permiso NFC. Inténtalo de nuevo.');
        });
    } else {
        alert('Tu navegador no es compatible con NFC.');
    }
}

function sendNFCData(nfcData) {
    // Enviar los datos NFC al servidor utilizando AJAX o Axios
    axios.post('/nfc/register', { nfcData: nfcData })
        .then(response => {
            console.log('Datos NFC enviados correctamente');
            // Mostrar mensaje de éxito o redirigir a otra página
        })
        .catch(error => {
            console.error('Error al enviar datos NFC:', error);
            // Mostrar mensaje de error
        });
}
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">NFC Functionality</div>

                <div class="card-body">
                    <button class="btn btn-primary" onclick="scanNFC()">Scan NFC Tag</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function scanNFC() {
    if ('NDEFReader' in window) {
        // Implement NFC scanning functionality here
    } else {
        alert('Your browser does not support NFC functionality.');
    }
}
</script>
@endsection

