@extends('layouts.customers')

@section('title')
 istanbuliat fashion {{ $product->name }}
@endsection

@section('content')
<div class="product-details-section">
  
    @include('components.customers.product-details.images')
    @include('components.customers.product-details.informations')
    <div class="clearing"></div>
     @include('components.customers.product-details.related-products') 
</div>

@endsection
