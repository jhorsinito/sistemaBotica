@extends('layout')
@section('module')
Laboratorios
@stop
@section('base_url')
<base href="{{URL::to('/')}}/laboratorios"/>
@stop
@section('css-customize')
@stop
@section('content')
<!--<section class="content-header">
    <h1>
        CLIENTES
        <small>Panel de Control</small>
    </h1>
</section>-->

<!-- Main content -->
<section ng-app="laboratorios">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/laboratorios/app.js"></script>
    <script src="/js/app/laboratorios/controllers.js"></script>
@stop

@stop