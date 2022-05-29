<!-- the drawer -->
<!-- Modal -->
<div class="modal left fade" id="filtersModal" tabindex="-1" role="dialog" aria-labelledby=" filtersModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="header-section">
                    <div class="clear-all paragraph">
                        <span class="shop-reset-all-filters"> Clear all</span>
                    </div>

                    <div class="filter-products">
                        Filter Products
                    </div>

                    <div class="close-button">
                        <button type="button" class="btn close no-focus" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>

                -
                <div id="accordion" class="modal-links">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <div class="collapsed link-header" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <span class="head  ">
                                    Category </span>

                                <i class="fa" aria-hidden="true"></i>
                                <div class="clearing"></div>
                            </div>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                            <div class="card-body accordion-menu">
                                <div id="categories_filter_blocks_father_holder" class="filters-blocks">


                                    @foreach ($categories as $key => $category)
                                        <div class="filter-block">

                                            <div class="shop-filter-icon-holder shop-filter-category-trigger">
                                                <i class="icon fa fa-check"></i>
                                            </div>

                                            <span class="hidden-category-id">{{ $category->id }}</span>
                                            <div class="paragraph">
                                                {{ $category->name }}
                                            </div>




                                            {{-- <span class="items-number">
                                                {{ count($category->products) }}
                                            </span> --}}

                                            <div class="clearing"></div>



                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="card-header" id="headingThree">
                            <div class="collapsed link-header" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                <span class="head  ">
                                    Price </span>

                                <i class="fa" aria-hidden="true"></i>
                                <div class="clearing"></div>
                            </div>
                        </div>




                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                            <div class="card-body accordion-menu ">

                                <div class="mall-property">


                                    <div class="mall-slider-handles" id="small_price_slider_handler" data-target="price"
                                        style="width: 100%; height:7px !important">
                                    </div>
                                    <span class="min "> 100 </span> <span class="max "> 800 </span>
                                    <div class="clearing"></div>


                                    <div class="price-report">
                                        price range : <input data-min="price" name="price-min" value="100"
                                            class="" id="shop_page_filter_min_price"> => <input
                                            data-max="price" name="price-max" value="400" class=""
                                            id="shop_page_filter_max_price"><span class="currency"> AED </span>

                                    </div>

                                    <button class='price-filter-button ' id="shop-price-filter-trigger">
                                        Filters
                                    </button>



                                </div>



                            </div>

                        </div> -->


                        <div class="card-header" id="headingFour">
                            <div class="collapsed link-header" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">
                                <span class="head  ">
                                    Size </span>

                                <i class="fa" aria-hidden="true"></i>
                                <div class="clearing"></div>
                            </div>
                        </div>




                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                            <div class="card-body accordion-menu">
                                @foreach ($sizes as $key => $size)
                                    <div class="filters-blocks">
                                        <div class="filter-block">

                                            <div class="shop-filter-icon-holder shop-filter-size-trigger">
                                                <i class="icon fa fa-check"></i>
                                            </div>


                                            <div class="paragraph ml-3">

                                                {{ $size->name }}

                                            </div>



                                            <div class="clearing"></div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>




                        <div class="card-header" id="headingFive">
                            <div class="collapsed link-header" data-toggle="collapse" data-target="#collapseFive"
                                aria-expanded="false" aria-controls="collapseFive">
                                <span class="head  ">
                                    Color </span>

                                <i class="fa" aria-hidden="true"></i>
                                <div class="clearing"></div>
                            </div>
                        </div>


                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive">
                            <div class="card-body accordion-menu">
                                @foreach ($colors as $key => $color)
                                    <div class="filters-blocks">
                                        <div class="filter-block  ">

                                            <div class="shop-filter-icon-holder shop-filter-color-trigger ">
                                                <i class="icon fa fa-check"></i>
                                            </div>



                                            <div class="paragraph ml-3">

                                                {{ $color->name }}

                                            </div>


                                            <div class="color-preview" style="background : {{ $color->hex }} ">

                                            </div>




                                            <div class="clearing"></div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="sort-section">
                            <span class="sort-paragraph">
                                Sort by :
                            </span>
                            <select class="sort-select " onchange="sortData(event)">
                                @foreach (getSorts() as $key => $item)
                                    <option value='{{ array_search($item, getSorts()) }}'>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- the drawer -->




        {{-- <button class='filter-button' data-target="#filtersModal" data-toggle="modal">
    Filters <i class="fa fa-filter"></i>
</button> --}}
