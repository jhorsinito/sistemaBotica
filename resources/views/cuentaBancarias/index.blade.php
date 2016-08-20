@extends('layout')
@section('module')
Cuentas Bancarias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cuentaBancarias"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="cuentaBancarias">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cuentaBancarias/app.js"></script>
    <script src="/js/app/cuentaBancarias/controllers.js"></script>
@stop
 
@stop