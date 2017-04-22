@extends('layout')
@section('module')
Compras
@stop
@section('base_url')
<base href="{{URL::to('/')}}/compras"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="compras">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/compras/app.js"></script>
    <script src="/js/app/compras/controllers.js"></script>
@stop

@stop