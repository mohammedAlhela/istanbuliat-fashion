<!-- the drawer -->
<!-- Modal -->
<div class="modal left fade" id="drawerModal" tabindex="-1" role="dialog" aria-labelledby="drawerModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">


                <div class="main">
                    <div class="search-holder">



                        <div class="search ">


                            <form id="small_screen_main_search"
                                onsubmit="return trigerMainSearch(event , 'smallShopSearchInput' )">
                                <button type="submit"> <img class="search-image" src="/images/svg/magnify.svg"
                                        alt="no image " /> </button>


                                <input type="text" id="smallShopSearchInput" class="form-control"
                                    placeholder="Search our store " />

                            </form>
                        </div>


                    </div>

                </div>





                <div class="links-blocks-holder" id="modal_links_holder">

                    @foreach ($categories as $key => $item)
                        <div class="link-block">
                            <img src="{{ $item->image }}" alt="">
                            <a class="link"
                                href="{{ route('customers-shop', ['category' => getQueryString($item->name)]) }}">
                                {{ $item->name }}
                            </a>

                            <div class="icon"> <a
                                    href="{{ route('customers-shop', ['category' => getQueryString($item->name)]) }}"><i
                                        class="fa fa-chevron-right"></i></a> </div>
                            <div class="clearing"></div>
                        </div>
                    @endforeach

                </div>



                <div class="social-media-holder">
                    <div class="social-media">
                        <a
                            href="https://www.facebook.com/pages/category/Shopping---Retail/Istanbuliat-UAE-112297630516968/"><i
                                class="fa fa-facebook-f facebook-bg"></i></a>
                        <a href="https://twitter.com/hashtag/%C4%B0stanbulAt?src=hash"><i
                                class="fa fa-twitter twitter-bg"></i></a>
                        <a href="https://www.instagram.com/istanbul_fashion_by_umufatih/?hl=en"><i
                                class="fa fa-instagram instagram-bg"></i></a>
                    </div>
                </div>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- the drawer -->
