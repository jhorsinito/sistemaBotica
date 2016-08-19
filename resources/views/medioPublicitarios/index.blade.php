@extends('layout')
@section('module')
Medios Publicitarios
@stop
@section('base_url')
<base href="{{URL::to('/')}}/medioPublicitarios"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="medioPublicitarios">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/medioPublicitarios/app.js"></script>
    <script src="/js/app/medioPublicitarios/controllers.js"></script>
@stop

@stop