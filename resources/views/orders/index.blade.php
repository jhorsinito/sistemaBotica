@extends('layout')
@section('module')
Compras
@stop
@section('base_url')
<base href="{{URL::to('/')}}/orders"/>
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
<section ng-app="orders">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/orders/app.js"></script>
    <script src="/js/app/orders/controllers.js"></script>
    <script src="/js/app/orders/servicesglobalOrders.js"></script>
@stop

@stop