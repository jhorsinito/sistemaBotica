@extends('layout')
@section('module')
Categorias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/categories"/>
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
<section ng-app="categories">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/categories/app.js"></script>
    <script src="/js/app/categories/controllers.js"></script>
@stop

@stop