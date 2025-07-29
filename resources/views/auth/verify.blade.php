@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar tu dirección de email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo enlace de verificación ha sido enviado a tu dirección de email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifica tu email con el enlace que te enviamos.') }}
                    {{ __('Si no recibiste el email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            {{ __('haz clic aquí para solicitar otro') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 