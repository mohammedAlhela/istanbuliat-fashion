<div class="fluid-container share-section">

    <div class="mega-header"> #istanbuliat </div>

    <div class="text">show us what istanbuliat styles you're loving and how
        you're wearing it. </div>

    <div class="demo-gallery images-holder" id="share_gallery">
        @foreach ($share as $key => $product)
        <div class="image-block" data-src="{{  $product->image }}" data-sub-html=" <div class = 'image-caption' style = 'position:relative; top:-30px' >  <h5 class = 'mb-3'  style = 'font-size:17px!important'> {{ $product->name }} </h5>
            <div class = 'icons-holder '> share on :
            <a href = 'https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}' style = 'color:white !important'
                <i class  = 'fa fa-facebook-f facebook-bg mx-2'> </i> </a>
                <a href = 'https://twitter.com/intent/tweet?text=Shop+new+dresses+products&url=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}' style = 'color:white !important'
                    <i class  = 'fa fa-twitter twitter-bg mx-2'> </i> </a>
                    <a href = 'https://www.instagram.com/?url=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}' style = 'color:white !important'
                        <i class  = 'fa fa-instagram instagram-bg mx-2 fa-big'> </i> </a>

        </div>  </div>">
            <img class="img-responsive" style = "max-width:500px !important" src="{{  $product->image }}">
            <div class="icon-holder">
                <i class="fa fa-instagram"></i>

            </div>
        </div>
        @endforeach
    </div>

</div>



