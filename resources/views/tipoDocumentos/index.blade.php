@extends('layout')
@section('module')
Tipo de Documentos
@stop
@section('base_url')
<base href="{{URL::to('/')}}/tipoDocumentos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="tipoDocumentos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/tipoDocumentos/app.js"></script>
    <script src="/js/app/tipoDocumentos/controllers.js"></script>
@stop

@stop