<div class="deals-section ">
    <div class="mega-header"> Hot deals</div>

    <div class="text">Shop our stylish trending collections with offers up to 50% off do not waste the chance</div>
    <div class="  deals-owl-carousel owl-carousel owl-theme" >
        @foreach ($deals as $key => $product)
            <a href="/product/{{ $product->slug }}" class="product-block">
                <div class="image-container"> <img src="{{ $product->image }}" alt="no image">
                </div>
                <div class="product-content">
                    <div class="category "> {{ $product->category->name }} </div>
                    <div class="name">{{ $product->name }}</div>
                    @if ($product->discount_price)
                        <div class="price"> DHs {{ $product->discount_price }} <span class="old-price"> DHs
                                {{ $product->selling_price }}</div> </span>
                    @else
                        <div class="price"> DHs {{ $product->selling_price }}</div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</div>
