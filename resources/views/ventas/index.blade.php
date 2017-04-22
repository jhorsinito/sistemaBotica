@extends('layout')
@section('module')
Ventas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/ventas"/>
@stop
@section('css-customize')
@stop
@section('content')
<!--<section class="content-header">
    <h1>
        Productos
        <small>Panel de Control</small>
    </h1>
</section>-->

<!-- Main content -->
<section ng-app="ventas">
    <div ng-view>

    </div>
</section>

@section('js-customize')

    <script src="/js/app/ventas/app.js"></script>
    <script src="/js/app/ventas/controllers.js"></script>
    
@stop

@stop