@extends('layouts.customers')

@section('title')
istanbuliat fashion store Collections
@endsection

@section('content')
<div class="shop-section">


@include('components.customers.shop.heading')
@include('components.customers.shop.products')
@include('components.customers.shop.modal')</div>
@endsection
