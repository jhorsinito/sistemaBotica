@extends('layout')
@section('module')
Comprobantes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/comprobantes"/>
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
<section ng-app="comprobantes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/comprobantes/app.js"></script>
    <script src="/js/app/comprobantes/controllers.js"></script>
@stop

@stop