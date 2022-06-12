@extends('layouts.customers')

@section('content')
    <div class="authentication-container ">
        <div class="account-section-container apply-transition">
            @include('auth.account.navigation')
            <div class="form-section">
                <section class="heading-authentication-navigation text-left">
                    My Wishlist
                </section>

                <div class="wishlists-section mt-3">
                    <div class="wishlists-items" id="wishlists_items_holder">

                        @if (count($wishlists))
                            @foreach ($wishlists as $key => $product)
                                <div class="wishlist-block">
                                    <div class="image-container"> <img src="{{ $product->image }}" alt="no image">
                                    </div>
                                    <div class="product-content">
                                        <div class="category "> {{ $product->category->name }} </div>
                                        <div class="name">{{ $product->name }}</div>
                                        @if ($product->discount_price)
                                            <div class="price"> DHs {{ $product->discount_price }} <span
                                                    class="old-price"> DHs
                                                    {{ $product->selling_price }}</div> </span>
                                        @else
                                            <div class="price"> DHs {{ $product->selling_price }}</div>
                                        @endif
                                    </div>

                                    <button>
                                        Add To Cart
                                    </button>

                                    <div class="link-paragraph" onclick="deleteWishlistItem('{{ $product->id }}')">
                                        delete
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="authentication-font  designing-div">
                                You dont have any wishlist item yet
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
