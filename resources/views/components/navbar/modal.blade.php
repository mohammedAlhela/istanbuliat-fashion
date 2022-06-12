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


                                <input required type="text" id="smallShopSearchInput" class="form-control"
                                    placeholder="Search our store " />

                            </form>
                        </div>


                    </div>

                </div>





                <div class="links-blocks-holder" id="modal_links_holder">


                    <div class="link-block">
                        <img src="/images/sliders/small/home.webp" alt="">
                        <a class="link"
                            href="/">
                          Home
                        </a>

                        <div class="icon"> <a
                                href="/"><i
                                    class="fa fa-chevron-right"></i></a> </div>
                        <div class="clearing"></div>
                    </div>


                    <div class="link-block">
                        <img src="/images/categories/all-collections.webp" alt="">
                        <a class="link"
                            href="/shop">
                         All collections
                        </a>

                        <div class="icon"> <a
                                href="/shop"><i
                                    class="fa fa-chevron-right"></i></a> </div>
                        <div class="clearing"></div>
                        </div>


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

                                            
            <a href="/shop?offer=60" class="offer"> offers up to 60% </a>

                </div>





            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- the drawer -->
