@extends('layout')
@section('module')
Almacenes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/almacenes"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="almacenes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/almacenes/app.js"></script>
    <script src="/js/app/almacenes/controllers.js"></script>
@stop

@stop