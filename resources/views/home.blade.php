@extends('layouts.main')

@section('title', 'Home')
@section('content')
    <div class="row">
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.graph_circle')
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.graph_circle')
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.graph_circle')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.dashboard_label', ['id' => 1, 'title' => 'Inbound Bandwidth', 'value' => '560+', 'label' => 'Successful transactions'])
            @include('components.dashboard_label', ['id' => 2, 'title' => 'Inbound Bandwidth', 'value' => '560+', 'label' => 'Successful transactions'])
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.activities')
        </div>
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            @include('components.notifications')
        </div>

    </div>
@endsection
