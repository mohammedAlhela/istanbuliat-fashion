<div class="images-section">
    <span class="wishlist">
        <img src="/images/svg/heart.svg" alt="">
    </span>
    <div id="product_details_preview_image_slider" class="owl-carousel owl-theme product-details-preview-image-carousel">

        @foreach ($productDetailsImagesSliders as $image)
            <div class="zoom zomm-image image-holder">
                <img class="item" src="{{ $image->image }}" alt="">
            </div>
        @endforeach

    </div>

    <div id="product_details_thumb_image_slider" class="owl-carousel owl-theme  product-details-thumb-image-carousel">
        @foreach ($productDetailsImagesSliders as $image)
            <img class="item" src="{{ $image->image }}" alt="">
        @endforeach
    </div> 
</div>

