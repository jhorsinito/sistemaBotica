@extends('layout')
@section('module')
Cursos
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cursos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="cursos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cursos/app.js"></script>
    <script src="/js/app/cursos/controllers.js"></script>
@stop

@stop