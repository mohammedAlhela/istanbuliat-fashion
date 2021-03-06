 <div class="informations-section">
     <div class="name">
         {{ $product->name }}
         {{-- {{  $product->name  }} --}}

     </div>

     <div class="sku">
         SKU :          {{ $product->sku }}
     </div>
     <div class="price">
         @if ($product->offer)
             DHS {{ $product->price }}
             <span class="old-price">
                 DHS {{ $product->selling_price }}
             </span>
         @else
             DHS {{ $product->price }}
         @endif
     </div>
     <div class="category">
         <a href="{{ route('customers-shop', ['category' => getQueryString($product->category->name)]) }}"> shop all
             {{ $product->category->name }}</a>
     </div>

     <hr>

     <div class="options">
         <div class="colors">
             <div class="head"> color : background</div>

             <div class="color-blocks-holder" id = "product_details_colors_holder">
                 @foreach ($colors as $color)
                     <div class="holder" >
                        <span class = "key">{{ $color->id }}</span>
                         <div class="color-block" style="background : {{ $color->hex }} ">
                             <div class="strock">
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
         <div class="sizes">
             <div class="head"> size*</div>

             <div class="size-blocks-holder"  id = "product_details_sizes_holder">
                 @foreach ($sizes as $size)
                     <div class="holder" >
                        <span class = "key">{{ $size->id }}</span>
                         <div class="size-block">
                             {{ $size->name }}
                             <div class="strock">

                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
             <div class="size-guide">
                 <a href="#" data-toggle="modal" data-target="#sizeGuideModel"> Size Guide</a>   <a href="#">add to wishlist</a>
             </div>
         </div>
     </div>
     <div class="availability-report" id = "product_details_availability_report">
         <div class="holder">
             <button>
                 color and size not available
             </button>
         </div>

     </div>

     <div class="cart">
         <button>
             add to bag
         </button>
     </div>


     <div class = "share"> share on :
        <a href = "https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}">  <i class  = 'fa fa-facebook-f facebook-bg mx-2'> </i>       </a>
    
            <a href = 'https://twitter.com/intent/tweet?text=Shop+new+dresses+products&url=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}' >
                <i class  = 'fa fa-twitter twitter-bg mx-2'> </i> </a>
                <a href = 'https://www.instagram.com/?url=http://127.0.0.1:8000/product/{{ getQueryString($product->name) }}'>
                    <i class  = 'fa fa-instagram instagram-bg mx-2 fa-big'> </i> </a>

    </div>

     @include(
         'components.customers.product-details.size-guide-model'
     )

     @include('components.customers.product-details.accordion')

 </div>


 <!-- Button trigger modal -->
