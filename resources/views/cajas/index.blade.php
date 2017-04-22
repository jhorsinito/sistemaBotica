@extends('layout')
@section('module')
Cajas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cajas"/>

@stop
@section('css-customize')
@stop
@section('content')

<section ng-app="cajas">
<link rel="icon" href="/usr/share/nginx/html/sistemaBotica/imagen/favicon.ico" sizes="32x32" />

    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cajas/app.js"></script>
    <script src="/js/app/cajas/controllers.js"></script>

@stop

@stop