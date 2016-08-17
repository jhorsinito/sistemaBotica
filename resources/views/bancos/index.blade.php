@extends('layout')
@section('module')
Bancos
@stop
@section('base_url')
<base href="{{URL::to('/')}}/bancos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="bancos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/bancos/app.js"></script>
    <script src="/js/app/bancos/controllers.js"></script>
@stop

@stop