@extends('layout')
@section('module')
Clientes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/brands"/>
@stop
@section('css-customize')
@stop
@section('content')
<!--<section class="content-header">
    <h1>
        CLIENTES
        <small>Panel de Control</small>
    </h1>
</section>-->

<!-- Main content -->
<section ng-app="brands">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/brands/app.js"></script>
    <script src="/js/app/brands/controllers.js"></script>
@stop

@stop