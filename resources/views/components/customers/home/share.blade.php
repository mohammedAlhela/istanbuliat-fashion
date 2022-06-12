<div class=" share-section">

    {{-- <div class="mega-header"> #istanbuliat </div>

    <div class="text">show us what istanbuliat styles you're loving and how
        you're wearing it. </div> --}}

        <?php $share = array ( '/images/share/insta-1.jpg'  ,'/images/share/insta-2.jpg' ,'/images/share/insta-3.jpg' ,'/images/share/insta-4.jpg' ,'/images/share/insta-5.jpg' ,'/images/share/insta-6.jpg'  ) ?>

    <div class="demo-gallery images-holder" id="share_gallery">
        @foreach ($share as $key => $product)
        <div class="image-block" data-src="{{  $product }}" 
    >
            <img class="img-responsive" style = "max-width:500px !important" src="{{  $product }}">
            <div class="icon-holder">
                <i class="fa fa-instagram"></i>

            </div>
        </div>
        @endforeach
    </div>

</div>



