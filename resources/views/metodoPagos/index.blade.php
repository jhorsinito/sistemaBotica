@extends('layout')
@section('module')
Metodos de Pago
@stop
@section('base_url')
<base href="{{URL::to('/')}}/metodoPagos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="metodoPagos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/metodoPagos/app.js"></script>
    <script src="/js/app/metodoPagos/controllers.js"></script>
@stop

@stop