@extends('layout')
@section('module')
Acreditadoras
@stop
@section('base_url')
<base href="{{URL::to('/')}}/acreditadoras"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="acreditadoras">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/acreditadoras/app.js"></script>
    <script src="/js/app/acreditadoras/controllers.js"></script>
@stop
 
@stop