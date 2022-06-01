<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <!-- Styles -->
    <link rel="icon" href="{{ asset('images/main/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/customers.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Styles -->


    <style>
        .preloader {
            background-color: rgb(235, 241, 247);
            height: 100vh !important;
            width: 100% !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999999 !important;
            transition: 0.6s 0.6s all ease-in-out;
            margin: 0 auto;
            overflow: hidden;
            display: flex;
            justify-content: center !important;
            align-items: center !important;
        }

        .preloader .loader-holder {
            height: 120px !important;
        }

        .preloader p {
            font-weight: 500 !important;
            color: #3a3636;
        }

        .preloader .loader3 {
            width: 50px;
            height: 50px;
            display: inline-block;
            padding: 0px;
            text-align: left;
            margin-left: 12px;
        }

        .preloader .loader3 span {
            position: absolute;
            display: inline-block;
            width: 80px;
            height: 80px;
            border-radius: 100%;
            background: #ffafaf;
            -webkit-animation: loader3 1.5s linear infinite;
            animation: loader3 1.5s linear infinite;
        }

        .preloader .loader3 span:last-child {
            animation-delay: -0.9s;
            -webkit-animation-delay: -0.9s;
        }

        @keyframes loader3 {
            0% {
                transform: scale(0, 0);
                opacity: 0.8;
            }

            100% {
                transform: scale(1, 1);
                opacity: 0;
            }
        }

        @-webkit-keyframes loader3 {
            0% {
                -webkit-transform: scale(0, 0);
                opacity: 0.8;
            }

            100% {
                -webkit-transform: scale(1, 1);
                opacity: 0;
            }
        }

        @media (max-width: 550px) {
            .preloader .loader3 {
                margin-left: 0px;
            }
        }

    </style>
</head>

<body>
    <!-- get all categories for navbar -->
    <?php
    use App\Models\Category;
    $categories = Category::where('status', '!=', 0)->get();
    ?>
    <!-- get all categories for navbar -->
    <div id="app">
        <div id="main_content">

            <div class="preloader" id="preloader">
                <div class="loader-holder">
                    <p>istanbuliat</p>
                    <div class="loader3">
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

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
            <main>
                @yield('content')
            </main>
        </div>

        @include('components.footer.main')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-1.10.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
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

        // product details section 
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






        // product details section 


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

            el.innerHTML = filteredProducts.length > 9 ? pagesLinksData : ``;



        }

        let timer = window.location.pathname.trim() == '/shop' ? 1000 : 500;

        setTimeout(hideLoader, timer);

        function hideLoader() {
            document.getElementById('preloader').classList.add('d-none')
        }
    </script>
    <!-- custom js files  -->
    <script src="{{ asset('js/custom/designing.js') }}"></script>
    <script src="{{ asset('js/custom/filter-functions.js') }}"></script>
    <script src="{{ asset('js/custom/queries-filter.js') }}"></script>
    <script src="{{ asset('js/custom/pagination.js') }}"></script>
    <script src="{{ asset('js/custom/event-filter.js') }}"></script>
    <!-- custom js files  -->

</body>

</html>
