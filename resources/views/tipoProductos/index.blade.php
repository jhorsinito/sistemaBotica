@extends('layout')
@section('module')
Tipos de Productos
@stop
@section('base_url')
<base href="{{URL::to('/')}}/tipoProductos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="tipoProductos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/tipoProductos/app.js"></script>
    <script src="/js/app/tipoProductos/controllers.js"></script>
@stop

@stop