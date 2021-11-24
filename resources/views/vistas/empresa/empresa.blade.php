@extends('layouts/app')
@section('titulo', 'empresa')
@section('content')


    {{-- notificaciones --}}


    @if (session('CORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "{{ session('CORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif



    @if (session('INCORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "{{ session('INCORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    <h4 class="text-center text-secondary">DATOS DE LA EMPRESA</h4>
    


    <div class="mb-0 col-12 bg-white p-5">
        @foreach ($sql as $item)
            <form action="{{ route('empresa.update', $item->id_empresa) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="fl-flex-label mb-4 col-12 col-lg-6">
                        <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre"
                            value="{{ $item->nombre }}">
                        
                    </div>
                    <div class="fl-flex-label mb-4 col-12 col-lg-6">
                        <input type="text" name="telefono" class="input input__text" id="telefono" placeholder="telefono"
                            value="{{ $item->telefono }}">
                    </div>
                    <div class="fl-flex-label mb-4 col-12 col-lg-6">
                        <input type="text" name="ubicacion" class="input input__text" placeholder="ubicacion *"
                            value="{{ old('ubicacion', $item->ubicacion) }}">
                        
                    </div>



                    <div class="fl-flex-label mb-4 col-12 col-lg-6">
                        <input type="text" name="ruc" class="input input__text" placeholder="ruc *"
                            value="{{ old('ruc', $item->ruc) }}">
                        
                    </div>

                    <div class="text-right mt-0">
                        <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
                    </div>
                </div>

            </form>
        @endforeach
    </div>

@endsection
