@extends('layout')
@section('module')
Personas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/personas"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="personas">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/personas/app.js"></script>
    <script src="/js/app/personas/controllers.js"></script>
@stop

@stop