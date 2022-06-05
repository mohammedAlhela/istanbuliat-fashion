<div class="search-brand-user-wishlist-cart-section">
    <div class="holder">


    <div class="bars-image-holder">
        <img class="bars-image" src=" {{ asset('/images/svg/bars.svg') }} " alt="" data-toggle="modal"
            id="bars_image" data-target="#drawerModal">
    </div>

    <div class="search-holder">
        <div class="search">


            <form  onsubmit="return triggerShopFilterMainSearch(event , 'shop_filter_big_screen_main_search_field' )">
                <button type="submit"> <img class="search-image" src="/images/svg/magnify.svg" alt="no image " />
                </button>


                <input type="text" id="shop_filter_big_screen_main_search_field" class="form-control" placeholder="Search our store" />

            </form>
        </div>

    </div>



    <div class="brand">
        <a href="/">
            <img class="image" src="/images/main/brand.webp" alt="no brand image">
        </a>
    </div>
    <div class="user-wishlist-cart">

        <div class="user">
            @guest
                <a href="/login" class="menu-trigger">
                    <img class="user-image" src=" {{ asset('/images/svg/user.svg') }} " alt="">


                </a>


            @endguest
            @auth
                <a href="/account" class="menu-trigger">
                    <img class="user-image" src=" {{ asset('/images/svg/user.svg') }} " alt="">


                </a>


            @endauth

        </div>


        <div class="cart">


            <a href="/cart">
                <img class="cart-image" src=" /images/svg/cart.svg " alt="" />

            </a>
        </div>

        <div class="cart">


            <a href="/wishlist">
                <img class="heart-image" src=" /images/svg/heart.svg " alt="" />

            </a>
        </div>

    </div>

</div>
        
</div>