@extends('layout')
@section('module')
Profesiones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/profesiones"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="profesiones">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/profesiones/app.js"></script>
    <script src="/js/app/profesiones/controllers.js"></script>
@stop

@stop