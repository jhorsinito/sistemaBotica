@extends('layout')
@section('module')
Categorías
@stop
@section('base_url')
<base href="{{URL::to('/')}}/types"/>
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
<section ng-app="types">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/types/app.js"></script>
    <script src="/js/app/types/controllers.js"></script>
@stop

@stop