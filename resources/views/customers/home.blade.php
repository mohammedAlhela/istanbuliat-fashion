
@extends('layouts.customers')

@section('title')
Welcome to istanbuliat fashion store
@endsection

@section('content')
<div class="home-section">
    @include('components.customers.home.sliders')
    @include('components.customers.home.categories')
    @include('components.customers.home.video')
    @include('components.customers.home.deals')
    @include('components.customers.home.share') 
</div>


@endsection 




