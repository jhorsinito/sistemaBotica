@extends('layout')
@section('module')
Ubigeos
@stop
@section('base_url')
<base href="{{URL::to('/')}}/ubigeos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="ubigeos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/ubigeos/app.js"></script>
    <script src="/js/app/ubigeos/controllers.js"></script>
@stop

@stop