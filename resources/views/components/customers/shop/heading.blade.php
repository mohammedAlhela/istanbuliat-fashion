 <!-- main heading -->
 <div class="heading-section" id="shop_filter_main_heading">
     <div class="header"> All collections </div>
     <div class="text">
         Shop all sections with stylish products
     </div>
 </div>
 <!-- main heading -->





 <!-- filter section  -->
 <div class="filter-section">
     <div class="toper-section" >
         <span class = "products-number" id = 'shop_filter_menus_products_number_top'>
           products 10 of 100
         </span>

         <span class = "clear-all shop-menus-clear-all">
             Clear all
         </span>
     </div>
     <div class="filter-left-section">
         <div class="filters-keys-menus">
             <div class="filter-header">
                 filter :
             </div>

             <div class="filters-menus">
                 <!-- category filter  -->
                 <div class="filter-block">
                     <button class='shop-filter-menus-dropdown-toggle '>
                         Categories  <i class="fa fa-chevron-down toggle-menu-icon"></i>
                     </button>
                     <ul class="shop-filter-menu">
                         <div class="categories-header-section">
                             <span class="slected" id = "shop_filter_selected_category"> no category selected  </span>
                             {{-- <span class="close-menu close-menu-span  "> Close</span> --}}
                             <span class="reset" id="shop_filter_categories_menu_reset"> clear</span>
                         </div>
                         <div class="clearing"></div>

                         <div class="menus-categories-filters-section" id="shop_filter_categories_menu_blocks_father">

                             @foreach ($categories as $key => $category)
                                 <div class="son-filter-block">

                                     <div class="shop-filter-icon-holder shop-filter-category-trigger">
                                         <i class="icon fa fa-check category-icon "></i>
                                     </div>

                                     <div class="name">
                                         {{ $category->name }}
                                     </div>

                                     <span class="items">
                                         ({{ count($category->products) }})
                                     </span>

                                     <span class="hidden-category-id">{{ $category->id }}</span>

                                     <div class="clearing"></div>

                                 </div>
                             @endforeach

                         </div>
                     </ul>
                 </div>
                 <!-- category filter  -->


                 <!-- price filter  -->
                 <div class="filter-block">
                     <button class='shop-filter-menus-dropdown-toggle '>
                         Price  <i class="fa fa-chevron-down toggle-menu-icon"></i>
                     </button>

                     <ul class="shop-filter-menu shop-price-menu">
                         <div class="categories-header-section">
                             <span class="slected">
                                 heights price :{{ $max_price }} 
                                </span>
                             {{-- <span class="close-menu close-menu-span  "> Close</span> --}}
                             <span class="reset" id="shop_filter_price_menu_reset"> clear</span>

                         </div>
                         <div class="clearing"></div>

                         <div class="menus-categories-filters-section price-section">
                             <div class="min">
                            <span class = "head"> AED </span>      <input type="text" class="form-control" placeholder="min" type="number"
                                     onchange='filterPriceRange(event , "min")'
                                     id='shop_filter_menus_min_price'>
                             </div>

                             <div class="max">
                                <span class = "head"> AED </span>  <input type="text" class="form-control" placeholder="max" type="number"
                                      id='shop_filter_menus_max_price'
                                     onchange='filterPriceRange(event , "max")'>
                             </div>
                             <div class="clearing"></div>

                         </div>
                     </ul>
                 </div>
                 <!-- price filter  -->
                 <!-- sizes filter  -->
                 <div class="filter-block">
                     <button class='shop-filter-menus-dropdown-toggle'>
                         Sizes

                         <i class="fa fa-chevron-down toggle-menu-icon"></i>
                     </button>

                     <ul class="shop-filter-menu shop-sizes-menu">
                         <div class="categories-header-section">
                             <span class="slected" id = "shop_filter_selected_sizes_number"> 0 selected </span>
                             {{-- <span class="close-menu close-menu-span  "> Close</span> --}}
                             <span class="reset" id="shop_filter_sizes_menu_reset"> clear</span>
                         </div>
                         <div class="clearing"></div>

                         <div class="menus-categories-filters-section" id="shop_filter_sizes_menu_blocks_father">

                             @foreach ($sizes as $key => $size)
                            @if($size->products_count  )
                                     <div class="son-filter-block">
                                         <div class="shop-filter-icon-holder shop-filter-size-trigger">
                                             <i class="icon fa fa-check toggle-menu-icon category-icon "></i>
                                         </div>

                                         <div class="name">
                                             {{ $size->name }}
                                         </div>

                                         <span class="items">
                                             ({{ $size->products_count }})
                                         </span>

                                         <div class="clearing"></div>
                                     </div>
                             @endif
                             @endforeach

                         </div>
                     </ul>
                 </div>
                 <!-- sizes filter  -->

                 <!-- colors filter  -->
                 <div class="filter-block">
                     <button class='shop-filter-menus-dropdown-toggle '>
                         Colors  <i class="fa fa-chevron-down toggle-menu-icon"></i>
                     </button>

                     <ul class="shop-filter-menu shop-colors-menu">
                         <div class="categories-header-section">
                             <span class="slected" id = "shop_filter_selected_colors_number"> 0 selected </span>
                             {{-- <span class="close-menu close-menu-span  "> Close</span> --}}
                             <span class="reset " id="shop_filter_colors_menu_reset"> clear</span>
                         </div>
                         <div class="clearing"></div>

                         <div class="menus-categories-filters-section " id="shop_filter_colors_menu_blocks_father">

                             @foreach ($colors as $key => $color)
                             @if($color->products_count  )
                                 <div class="son-filter-block">

                                     <div class="shop-filter-icon-holder shop-filter-color-trigger color-icon-holder"
                                         style="background : {{ $color->hex }} ">
                                         <i class="icon fa fa-check color"></i>
                                     </div>


                                     <div class="name">
                                         {{ $color->name }}
                                     </div>

                                     <span class="items">
                                         ({{ $color->products_count }})
                                     </span>

                                     <div class="clearing"></div>
                                 </div>
                                 @endif
                             @endforeach

                         </div>
                     </ul>
                 </div>

                 <!-- colors filter  -->


             </div>


             <span class=" clear-all shop-menus-clear-all">clear all</span>
             <div class="clearing"></div>

         </div>
     </div>


     <div class="filter-right-section">
         <div class="sort-by">
             <div class="filter-header">
                 sort :
             </div>

             <select class="sort-select" onchange="sortData(event)">
                 @foreach (getSorts() as $key => $item)
                     <option class="my-option" value='{{ array_search($item, getSorts()) }}'>
                         {{ $item }}</option>
                 @endforeach
             </select> <i class="fa fa-chevron-down"></i>

         </div>


                   
 
         <div class="products-number" id = 'shop_filter_menus_products_number_bottom'>
         
         </div>
     </div>
     <div class="clearing"></div>
     <div class="filter-keys-section">

     
        
         <div class="keys" id="shop_filter_menus_values_keys">
         </div>

  

         <div class="clearing"></div>
     </div>
 </div>
 <!-- filter section  -->
