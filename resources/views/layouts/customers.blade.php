<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/customers.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/main/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"
        integrity="sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,400;1,300&display=swap"
        rel="stylesheet">

    <!-- Styles -->

<body>

    @if (auth()->user() && auth()->user()->role != 0)
        <div class="customers-nav">
            <a href="/admins/dashboard"> Go to admins pages</a>
        </div>
    @endif


    <!-- get all categories for navbar -->
    <?php
    use App\Models\Category;
    
    $categories = Category::select('id', 'name', 'description', 'image')
        ->where('status', '!=', 0)
        ->get();
    ?>
    <!-- get all categories for navbar -->
    <div id="app" class = "opacityFalse">
        <div>

            <div id="snackbar"></div>

            @if (session()->has('message'))
                <div class=" alert alert-success alert-dismissible fade show success-alert" role="alert">
                    <div class="fluid-container">
                        {{ session()->get('message') }} <button type="button" class="close"
                            data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class=" alert alert-success alert-dismissible fade show success-alert" role="alert">
                    <div class="fluid-container">


                        {{ session('status') }} <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> </div>
                </div>
            @endif

            @include('components.navbar.main')
            <main id="main_content">
                @yield('content')
            </main>
        </div>

        @include('components.footer.main')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"
        integrity="sha512-eH6+OZuv+ndnPTxzVfin+li0PXKxbwi1gWWH2xqmljlTfO3JdBlccZkwWd0ZcWAtDTvsqntx1bbVSkWzHUtfQQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let shopDataObject = {
            products: {!! json_encode(isset($products) ? $products : []) !!},
            categories: {!! json_encode(isset($categories) ? $categories : []) !!},
            shopFilter: {
                filteredProducts: {!! json_encode(isset($products) ? $products : []) !!},
                activeCategoryName: null,
                activeCategory: {},
                activeColorsNames: [],
                activeSizesNames: [],
                offer: null,
                type: null,
                name: null,
                minPrice: null,
                maxPrice: null,
                filterValuesArray: [],
                max_price: {!! json_encode(isset($max_price) ? $max_price : null) !!}
            }

        }

        // define the filter variable
        let minPrice = shopDataObject.shopFilter.minPrice;
        let maxPrice = shopDataObject.shopFilter.maxPrice;
        let products = shopDataObject.products;
        let categories = shopDataObject.categories;
        let filteredProducts = shopDataObject.shopFilter.filteredProducts;
        let filterValuesArray = shopDataObject.shopFilter.filterValuesArray;
        let activeCategoryName = shopDataObject.shopFilter.activeCategoryName;
        let activeCategory = shopDataObject.shopFilter.activeCategory;
        let activeSizesNames = shopDataObject.shopFilter.activeSizesNames;
        let activeColorsNames = shopDataObject.shopFilter.activeColorsNames;
        let name = shopDataObject.shopFilter.name;
        let offer = shopDataObject.shopFilter.offer;
        let type = shopDataObject.shopFilter.type;
        let shopPaginationItemsPerPage = 12;
        let shopPaginationCurrentPage = 1;
        let max_price = shopDataObject.shopFilter.max_price
        // define the filter variable

        // convert data in products to use sort filter
        shopDataObject.shopFilter.filteredProducts.forEach(item => {
            item.updated_at = new Date(item.updated_at)
        })
        // convert data in products to use sort filter

        // // product details section 
        let productDetailsDataObject = {
            productDetailsImagesSliders: {!! json_encode(isset($productDetailsImagesSliders) ? $productDetailsImagesSliders : []) !!},
            filteredProductDetailsImagesSliders: {!! json_encode(isset($productDetailsImagesSliders) ? $productDetailsImagesSliders : []) !!},
            variations: {!! json_encode(isset($variations) ? $variations : []) !!},
            sizeGuides: {!! json_encode(isset($sizeGuides) ? $sizeGuides : []) !!},
            sizeGuideType: 'cm',
            filteredVariations: {!! json_encode(isset($variations) ? $variations : []) !!},
            activeVariation: {},
            colors: {!! json_encode(isset($colors) ? $colors : []) !!},
            sizes: {!! json_encode(isset($sizes) ? $sizes : []) !!},
            filter: {
                status: false,
                activeSize: {},
                activeColor: {},

            }
        }

        let variations = productDetailsDataObject.variations;
        let sizeGuides = productDetailsDataObject.sizeGuides;
        let sizeGuideType = productDetailsDataObject.sizeGuideType;



        let filteredProductDetailsImagesSliders = productDetailsDataObject.filteredProductDetailsImagesSliders;
        let productDetailsImagesSliders = productDetailsDataObject.productDetailsImagesSliders;


        let filteredVariations = productDetailsDataObject.filteredVariations;

        let activeVariation = productDetailsDataObject.activeVariation;

        let colors = productDetailsDataObject.colors;

        let sizes = productDetailsDataObject.sizes;

        let activeSize = productDetailsDataObject.filter.activeSize;

        let activeColor = productDetailsDataObject.filter.activeColor;

        // // product details section 


        let shopPaginationPagesLinksNumber = shopPaginationReturnPagesLinksNumber();

        function shopPaginationReturnPagesLinksNumber() {
            // returns the number of pages
            return Math.ceil(filteredProducts.length / shopPaginationItemsPerPage);
        }




        function shopPaginationAddPagesLinks() {
            // grab reference to containing element

            let el = document.getElementById("pagination_pages_links");
            let pagesLinksData = ``;
            // for each page



            for (let i = 1; i < Math.ceil(filteredProducts.length / shopPaginationItemsPerPage) + 1; i++) {
                // append a link with the respective page number


                pagesLinksData += `<li class = "${
      i == 1 ? "active" : ""
  }"><a  href="javascript:shopPaginationgoToPageLink(${i})">${i}</a></li>`;
            }

            el.innerHTML = filteredProducts.length > 12 ? pagesLinksData : ``;



        }


        let timer = window.location.pathname.trim() == '/shop' ? 1000 : 500;

         setTimeout(showPage, timer);

         document.getElementById('app').classList.add('opacityFalse')


        function showPage() {
           
            document.getElementById('app').classList.add('opacityTrue')
           
        }
    </script>


    <script src="{{ asset('js/custom/all.js') }}"></script>
    <script src="{{ asset('js/custom/ajax.js') }}"></script>

</body>

</html>
