@extends('layout')
@section('module')
Proveedores
@stop
@section('base_url')
<base href="{{URL::to('/')}}/proveedores"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="proveedores">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/proveedores/app.js"></script>
    <script src="/js/app/proveedores/controllers.js"></script>
@stop

@stop