@extends('layout')
@section('module')
Docentes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/docentes"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="docentes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/docentes/app.js"></script>
    <script src="/js/app/docentes/controllers.js"></script>
@stop

@stop