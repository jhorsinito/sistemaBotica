@extends('layout')
@section('module')
Farmacias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/tiendas"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="tiendas">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/tiendas/app.js"></script>
    <script src="/js/app/tiendas/controllers.js"></script>
@stop

@stop