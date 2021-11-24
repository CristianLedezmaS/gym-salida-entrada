@extends('layouts.app')

@section('content')


<!--.side-menu-->

<h2 class="text-center text-secondary pb-2">PANEL DE CONTROL</h2>

<div class="container-fluid text-center">
    <div class="row">

        <!--.col-->
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box red">
                        <div>
                            <div class="number text-light"></div>
                            <div class="caption">
                                <div>USUARIOS</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box purple">
                        <div>
                            <div class="number text-light"></div>
                            <div class="caption">
                                <div>CLIENTE</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box green">
                        <div>
                            <div class="number text-light">S/. </div>
                            <div class="caption">
                                <div>VENTAS DE HOY</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box yellow">
                        <div>
                            <div class="number text-light"></div>
                            <div class="caption">
                                <div>PRODUCTO</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
            </div>
            <!--.row-->
        </div>
        <!--.col-->

        <!--.col-->
        <div class="container" style="width: 100%;">
            <canvas id="grafica" height="90"></canvas>
        </div>
        <!--.row-->

    </div>
</div>

<!--.container-fluid-->
<!--.page-content-->
</body>





@endsection