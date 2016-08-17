@extends('layout')
@section('module')
Motivo Venta
@stop
@section('base_url')
<base href="{{URL::to('/')}}/motivoVentas"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="motivoVentas">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/motivoVentas/app.js"></script>
    <script src="/js/app/motivoVentas/controllers.js"></script>
@stop

@stop