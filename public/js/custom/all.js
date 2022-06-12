

jQuery(document).ready(function ($) {
    $(".sliders-owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        smartSpeed: 1000,
        autoplay: false,
        navText: ["", ""],
        responsive: {
            0: {
                items: 1,
            },
        },
    });


    $(".categories-owl-carousel").owlCarousel({
        smartSpeed: 600,
        autoplay: false,
        loop: true,
        navText: [
            "<i class ='fa fa-chevron-left'> </i>",
            "<i class ='fa fa-chevron-right'> </i>",
        ],
        responsive: {
            0: {
                margin: 10,
                items: 2,
            },

            768: {
                margin: 20,
                items: 3,
            },

            992: {
                margin: 20,
                items: 4,
            },
        },
    });


    $(".deals-owl-carousel").owlCarousel({
        loop: true,


        navText: [
            "<i class ='fa fa-chevron-left'> </i>",
            "<i class ='fa fa-chevron-right'> </i>",
        ],
        nav: true,

        smartSpeed: 600,

        autoplay: false,

        responsive: {
            0: {
                margin: 10,
                items: 2,
            },

            700: {
                margin: 20,
                items: 3,
            },

            992: {
                margin: 20,
                items: 4,
            },
        },
    });



    // sticky navbar +++++++++++
    var stickyNavTop = $(".sticky-navbar").offset().top;
    var stickyNav = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > stickyNavTop) {
            $(".sticky-navbar").addClass("sticky");
        } else {
            $(".sticky-navbar").removeClass("sticky");
        }
    };
    stickyNav();
    $(window).scroll(function () {
        stickyNav();
    });
    // sticky navbar +++++++++++

    // light gallery  +++++++++++
    lightGallery(document.getElementById("share_gallery"), {
        download: false,
        share: false,
        mobileSettings: {
            controls: true,
            showCloseIcon: true,
            download: false,
        },
    });

    // light gallery  +++++++++++

    $(".shop-filter-menus-dropdown-toggle").click(function () {
        $(".shop-filter-menus-dropdown-toggle").removeClass('active')
       $(this).addClass('active')
        if ($(this).next(".shop-filter-menu").css("display") == "none") {
            $(".shop-filter-menu").fadeOut(10);
            $(this).next(".shop-filter-menu").fadeIn(300);
        } else {
            $(this).next(".shop-filter-menu").fadeOut(10);
        }
    });

    $(".close-menu-span").click(function () {
        $(this).parent().parent().fadeToggle(10);
    });

    $(document).click(function (e) {
        var target = e.target;

        let parentsBlocks = Array.from($(target).parents());

        let oneParentIsTheMenu = false;
        parentsBlocks.forEach((item) => {
            item.classList.contains("shop-filter-menu")
                ? (oneParentIsTheMenu = true)
                : false;
        });

        if (
            !$(target).hasClass("shop-filter-menu") &&
            !oneParentIsTheMenu &&
            !$(target).hasClass("shop-filter-menus-dropdown-toggle") &&
            !$(target).hasClass("toggle-menu-icon")
        ) {
            $(".shop-filter-menu").fadeOut(10);

            
    $(".shop-filter-menus-dropdown-toggle").removeClass('active')


            
        }
    });

    // product details slider

    var sync1 = $("#product_details_preview_image_slider");
    var sync2 = $("#product_details_thumb_image_slider");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;



        sync1
        .owlCarousel({
            items: 1,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoplay: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>',
            ],
        })
          .on("changed.owl.carousel", syncPosition);
  


    sync2
        .on("initialized.owl.carousel", function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: true,
       
            margin: 10,
            smartSpeed: 1000,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>',
            ],
        })
         .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();

        if (current > end) {
            sync2.data("owl.carousel").to(current, 300, true);
        }
        if (current < start) {
            sync2.data("owl.carousel").to(current - onscreen, 300, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 300, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
    });

    // product details section +++++++++++++++++++++++++++

    if(window.innerWidth >= 650) { 
        setTimeout(() => {
            $(".zomm-image").zoom({
                magnify: 1.5,
            });
        }, 100);
    }


    $("#product_details_toggle_details_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_details_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    $("#product_details_toggle_contents_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_contents_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    $("#product_details_toggle_return_button").on("click", function () {
        $element = $(this);
        $element.next().toggleClass("fa-plus").toggleClass("fa-minus");
        $element.toggleClass("main-color");

 
    });

    $("#product_details_toggle_return_icon").on("click", function () {
        $element = $(this);
        $element.toggleClass("fa-plus").toggleClass("fa-minus");
        $element.prev().toggleClass("main-color");
    });

    //  product details section +++++++++++++++++++++++++++
});

function triggerShopFilterMainSearch(e, idKey) {
    e.preventDefault();

    let data = document
        .getElementById(idKey)
        .value.toLowerCase()
        .trim()
        .replace(" ", "-");

    window.location.replace(`/shop?name=${data}`);
}
if(window.location.pathname  == '/shop') { 

function filterPriceRange(event, key) {
    if (key == "min") {
        minPrice = event.target.value;
    } else {
        maxPrice = event.target.value;
    }

    let priceObjectIndex = filterValuesArray.findIndex(function (item) {
        return item.key == "price";
    });

    if (priceObjectIndex > -1) {
        filterValuesArray[priceObjectIndex].value = `${
            minPrice != null ? minPrice : 0
        }-${maxPrice != null ? maxPrice : max_price} AED`;
    } else {
        filterValuesArray.push(
            (priceObject = {
                key: "price",
                value: `${minPrice != null ? minPrice : 0}-${
                    maxPrice != null ? maxPrice : max_price
                } AED`,
            })
        );
    }
    shopFilterProducts();
}



function checkIfColorIsExist(item) {
    let exist = false;
    activeColorsNames.forEach((color) => {
        item.colorsNamesString.search(color) > -1
            ? (exist = true)
            : console.log(item.colors);
    });

    return exist;
}

function checkIfSizeIsExist(item) {
    let exist = false;
    activeSizesNames.forEach((size) => {
        item.sizesNamesString.search(size) > -1
            ? (exist = true)
            : console.log("not exist");
    });

    return exist;
}

function filterPrice(item) {
    if (maxPrice && minPrice) {
        return item.price >= minPrice && item.price <= maxPrice;
    } else if (!maxPrice && minPrice) {
        return item.price >= minPrice;
    } else if (maxPrice && !minPrice) {
        return item.price <= maxPrice;
    } else if (!maxPrice && !minPrice) {
        return true;
    }
}

function shopFilterProducts() {
    let exactFilteredData = [];

    exactFilteredData = products.filter((item) => {
        return (
            (activeCategoryName
                ? item.category_id == activeCategory.id
                : true) &&
            (name
                ? item.name
                      .toLowerCase()
                      .includes(name.toLowerCase().replace("-", " ")) ||
                  item.colorsNamesString
                      .split(",")
                      .indexOf(name.toLowerCase().replace("-", " ")) !== -1 ||
                  item.sizesNamesString
                      .split(",")
                      .indexOf(name.toLowerCase().replace("-", " ")) !== -1
                : true) &&
            (offer ? item.offer != null && item.offer <= offer : true) &&
            (activeColorsNames.length ? checkIfColorIsExist(item) : true) &&
            (activeSizesNames.length ? checkIfSizeIsExist(item) : true) &&
            filterPrice(item)
        );
    });

    filteredProducts = exactFilteredData;

    shopAppendProductsData(exactFilteredData);

    shopPaginationAddPagesLinks(); // generate page navigation
    console.log(activeColorsNames);
}

function sortData(e) {
    let data = filteredProducts;
    if (e.target.value == "price-descending") {
        data = data.slice().sort(function (a, b) {
            return b.price - a.price;
        });
    } else if (e.target.value == "price-ascending") {
        data = data.slice().sort(function (a, b) {
            return a.price - b.price;
        });
    } else if (e.target.value == "date-ascending") {
        data = data.slice().sort(function (a, b) {
            return a.updated_at - b.updated_at;
        });
    } else if (e.target.value == "date-descending") {
        data = data.slice().sort(function (a, b) {
            return b.updated_at - a.updated_at;
        });
    } else if (e.target.value == "title-descending") {
        data.sort((a, b) => (a.name > b.name) - (a.name < b.name));
    } else if (e.target.value == "title-ascending") {
        data.sort((a, b) => (a.name < b.name) - (a.name > b.name));
    }

    shopAppendProductsData(data);
}

function shopAppendProductsData(filteredData, itemsPerPage = 12, page = 1) {
    let shopProductsData = ``;
    if (filteredData.length) {
        // for (var index = 0; index < filteredData.length; index++) {
        for (
            let index = (page - 1) * itemsPerPage;
            index < page * itemsPerPage && index < filteredData.length;
            index++
        ) {
            shopProductsData += `<a class = " product-block" href = "/product/${filteredData[index].slug}" > `;

            shopProductsData += `<div class = "image-container">`;
            shopProductsData += ` <img  src = '${filteredData[index].image}' > `;
            shopProductsData += ` </div> `;
            shopProductsData += ` <div class = 'product-content' >  `;
            shopProductsData += ` <div class = 'category' > ${filteredData[index].category.name}`;
            shopProductsData += ` </div> `;

            shopProductsData += ` <div class = 'name ' > ${filteredData[index].name}`;
            shopProductsData += ` </div> `;

            if (filteredData[index].discount_price) {
                shopProductsData += ` <div class = 'price' > DHs ${filteredData[index].discount_price} `;
                shopProductsData += ` <span class = 'old-price' > DHs ${filteredData[index].selling_price} `;
                shopProductsData += ` </span> `;
                shopProductsData += ` </div> `;
            } else {
                shopProductsData += ` <div class = 'price' > DHs ${filteredData[index].selling_price} `;

                shopProductsData += ` </div> `;
            }

            shopProductsData += `</div> `;

            shopProductsData += `</a> `;
        }
    } else {
        shopProductsData += `<div class = 'filter-results-holder header'> No Related products with the search results `;

        if (activeCategoryName) {
            shopProductsData += `<div class = 'shop-report-filter-header' > Categories : `;

            shopProductsData += `<span class = 'value'> ${activeCategoryName}`;
            shopProductsData += `</span> `;

            shopProductsData += `</div> `;
        }

        if (minPrice) {
            shopProductsData += `<div class = 'shop-report-filter-header'> Price Range : `;

            shopProductsData += `<span class  ='value'> ${minPrice}-`;
            shopProductsData += `</span> `;

            shopProductsData += `<span  class  ='value' >  ${maxPrice} AED`;
            shopProductsData += `</span> `;

            shopProductsData += `</div> `;
        }

        if (name) {
            shopProductsData += `<div class = 'shop-report-filter-header'> Search : `;

            shopProductsData += `<span class  ='value'> ${name}`;
            shopProductsData += `</span> `;

            shopProductsData += `</div> `;
        }

        if (activeColorsNames.length) {
            shopProductsData += `<div class = 'shop-report-filter-header'> Colors : `;

            activeColorsNames.forEach((element, index) => {
                shopProductsData += `<span class = 'value'>  ${element} ${
                    index == activeColorsNames.length - 1 ? "" : ","
                }`;
                shopProductsData += `</span> `;
            });

            shopProductsData += `</div> `;
        }

        if (activeSizesNames.length) {
            console.log(activeSizesNames);
            shopProductsData += `<div class = 'shop-report-filter-header'> Sizes : `;

            activeSizesNames.forEach((element, index) => {
                shopProductsData += `<span class = 'value'>  ${element} ${
                    index == activeSizesNames.length - 1 ? "" : ","
                }`;
                shopProductsData += `</span> `;
            });

            shopProductsData += `</div> `;
        }

        shopProductsData += `</div>`;
    }

    // append products data with transition

        $(".shop-products-section").addClass("add-transation");


    setTimeout(() => {
        $(".shop-products-section").empty().append(shopProductsData);
    }, 400);


    setTimeout(() => {
        $(".shop-products-section").removeClass("add-transation");
    }, 600);


    // append products data with transition

    if (activeCategoryName) {
        shopAppendHeading("category");
    }
    if (!activeCategoryName) {
        shopAppendHeading("main");
    }

    shopAppendFilterKeysValues();
    shopAppendProductsNumber();

    shopAppendSelectedItemsNumber();

    if (filteredProducts.length < 12) {
        document.getElementById("pagination_prev_link").classList.add("d-none");
        document.getElementById("pagination_next_link").classList.add("d-none");
    } else {
        document
            .getElementById("pagination_prev_link")
            .classList.remove("d-none");
        document
            .getElementById("pagination_next_link")
            .classList.remove("d-none");
    }

    if (shopPaginationCurrentPage == 1) {
        document
            .getElementById("pagination_prev_link")
            .classList.add("disabled");
    } else {
        document
            .getElementById("pagination_prev_link")
            .classList.remove("disabled");
    }

    if (shopPaginationPagesLinksNumber - shopPaginationCurrentPage == 0) {
        document
            .getElementById("pagination_next_link")
            .classList.add("disabled");
    } else {
        document
            .getElementById("pagination_next_link")
            .classList.remove("disabled");
    }
}

function shopAppendSelectedItemsNumber() {
    document.getElementById(
        "shop_filter_selected_sizes_number"
    ).innerText = `${activeSizesNames.length} selected`;

    document.getElementById(
        "shop_filter_selected_colors_number"
    ).innerText = `${activeColorsNames.length} selected`;

    document.getElementById("shop_filter_selected_category").innerText = `${
        activeCategory.name ? activeCategory.name : "no category"
    } selected`;
}
function shopAppendHeading(key) {
    let head = "";

    let headingData = ``;

    if (key == "category") {
        head = activeCategoryName;
    } else if (key == "main") {
        head = `all collections`;
    }

    headingData += `<div class = 'header'> ${head} `;
    headingData += `</div>`;

    $("#shop_filter_main_heading").empty().append(headingData);
}

function clearShopFilterKeyValue(key, value) {
    filterValuesArray = filterValuesArray.filter((item) => {
        return item.value != value;
    });

    if (key == "category") {
        $("#shop_filter_categories_menu_reset").trigger("click");
    }

    if (key == "color") {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.value != value;
        });

        activeColorsNames = activeColorsNames.filter((item) => {
            return item != value;
        });

        $(".shop-filter-color-trigger")
            .children(".icon")
            .removeClass("opacityTrue");

        let colorsBlocks = document.getElementById(
            "shop_filter_colors_menu_blocks_father"
        ).children;

        colorsBlocks = Array.from(colorsBlocks);

        colorsBlocks.forEach((item) => {
            if (
                activeColorsNames.indexOf(
                    item.children.item(1).innerText.trim()
                ) > -1
            ) {
                item.children
                    .item(0)
                    .children.item(0)
                    .classList.add("opacityTrue");
            }
        });

        shopFilterProducts();
    }

    if (key == "size") {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.value != value;
        });

        activeSizesNames = activeSizesNames.filter((item) => {
            return item != value;
        });

        $(".shop-filter-size-trigger")
            .children(".icon")
            .removeClass("opacityTrue");

        let sizesBlocks = document.getElementById(
            "shop_filter_sizes_menu_blocks_father"
        ).children;

        sizesBlocks = Array.from(sizesBlocks);

        sizesBlocks.forEach((item) => {
            if (
                activeSizesNames.indexOf(
                    item.children.item(1).innerText.trim()
                ) > -1
            ) {
                item.children
                    .item(0)
                    .children.item(0)
                    .classList.add("opacityTrue");
            }
        });

        shopFilterProducts();
    }

    if (key == "price") {
        $("#shop_filter_price_menu_reset").trigger("click");
    }

    if (key == "name") {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "name";
        });
        name = null;
    }

    if (key == "offer") {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "offer";
        });
        offer = null;
    }

    shopFilterProducts();
}

function shopAppendProductsNumber() {
    document.getElementById(
        "shop_filter_menus_products_number_top"
    ).textContent = `${filteredProducts.length} of ${products.length} products`;

    document.getElementById(
        "shop_filter_menus_products_number_bottom"
    ).textContent = `${filteredProducts.length} of ${products.length} products`;
}

function shopAppendFilterKeysValues() {
    let filterData = ``;

    filterValuesArray.forEach((item) => {
        filterData += `<span class = 'key' onclick = 'clearShopFilterKeyValue("${item.key}" , "${item.value}")'> ${item.value} `;
        filterData += `<i class="fa fa-close"></i>`;
        filterData += `</span>`;
    });

    $("#shop_filter_menus_values_keys").empty().append(filterData);
}
}
   
if(true) { 
    let url = window.location.href;
    let myHref = new URL(url) ;
    
    function shopFilterProductsFromCategoryQueryParam() {
       
        $urlHaveCategory = myHref.searchParams.has("category");
    
        if ($urlHaveCategory) {
            activeCategoryName = myHref.searchParams
                .get("category")
                .replace("-", " ");
    
            activeCategoryHolderArray = [];
            activeCategoryHolderArray = categories.filter((item) => {
                return item.name === activeCategoryName;
            });
    
            activeCategory = Object.assign({}, activeCategoryHolderArray[0]);
    
            filterValuesArray.push({
                key: "category",
                value: activeCategoryName,
            });
    
            shopFilterProducts();
    
            let shopMenuCategories =
                document.getElementById("shop_filter_categories_menu_blocks_father").children;
    
                shopMenuCategories = Array.from(shopMenuCategories);
                shopMenuCategories.forEach((item) => {
              
                if (item.children.item(1).innerText.trim() == activeCategoryName) {
                    item.children.item(0).children.item(0).classList.add("opacityTrue");
                }
            });
        }
    }
    
    function shopFilterProductsFromOfferQueryParam() {
    
        $urlHaveOffer = myHref.searchParams.has("offer");
    
        if ($urlHaveOffer) {
            offer = myHref.searchParams.get("offer");
    
            filterValuesArray.push({
                key: "offer",
                value: `offer ${offer}% off`,
            });
            shopFilterProducts();
        }
    }
    
    function shopFilterProductsFromNameQueryParam() {
    
        $urlHaveName = myHref.searchParams.has("name");
    
        if ($urlHaveName) {
            name = myHref.searchParams.get("name");
    
            filterValuesArray.push({
                key: "name",
                value: name,
            });
    
            shopFilterProducts();
        }
    }
    
    function shopFilterProductsFromTypeQueryParam() {
    
        $urlHaveType = myHref.searchParams.has("type");
    
        if ($urlHaveType) {
            type = myHref.searchParams.get("type");
    
            let paramSortedData = filteredProducts;
    
            if (type == "new-for-you") {
                paramSortedData = paramSortedData.slice().sort(function (a, b) {
                    return b.updated_at - a.updated_at;
                });
            } else {
                paramSortedData = paramSortedData.slice().sort(function (a, b) {
                    return a.price - b.price;
                });
            }
    
            shopAppendProductsData(paramSortedData);
        }
    }
    
    shopFilterProductsFromCategoryQueryParam();
    shopFilterProductsFromOfferQueryParam();
    shopFilterProductsFromNameQueryParam();
    shopFilterProductsFromTypeQueryParam();
    }
    


if(window.location.pathname  == '/shop') { 


    function shopFilterPaginationChangePageLink(page) {
        if (page < 1) page = 1;
        if (page > shopPaginationPagesLinksNumber)
            page = shopPaginationPagesLinksNumber;
        shopAppendProductsData(
            filteredProducts,
            shopPaginationItemsPerPage,
            page
        );
    }

    function shopPaginationNextPageLink() {

                if (shopPaginationCurrentPage < shopPaginationPagesLinksNumber) { 
                    let val = shopPaginationCurrentPage;
                    shopFilterPaginationChangePageLink(++shopPaginationCurrentPage);
        
        
        
                    let paginationLinks = Array.from(document.getElementById("pagination_pages_links").children);
                    paginationLinks.forEach((item) => {
                        item.classList.remove("active");
                    });
                    document
                        .getElementById("pagination_pages_links")
                         .children.item(val )
                        .classList.add("active");
                }

    }

    function shopPaginationPrevPageLink() {

       
        if (shopPaginationCurrentPage > 1) { 
            let val = shopPaginationCurrentPage;
            shopFilterPaginationChangePageLink(--shopPaginationCurrentPage);



            let paginationLinks = Array.from(document.getElementById("pagination_pages_links").children);
            paginationLinks.forEach((item) => {
                item.classList.remove("active");
            });
            document
                .getElementById("pagination_pages_links")
                 .children.item(val -2)
                .classList.add("active");
        }
    
    
    }

    // directly access a page by number
    function shopPaginationgoToPageLink(page) {
        // sets the current page to the selected page
        shopPaginationCurrentPage = page;
        // changes the page to the selected page
        shopFilterPaginationChangePageLink(page);
  
        let paginationLinks = Array.from(document.getElementById("pagination_pages_links").children);
        paginationLinks.forEach((item) => {
            item.classList.remove("active");
        });
        document
            .getElementById("pagination_pages_links")
            .children.item(page - 1)
            .classList.add("active");
    }

        shopFilterPaginationChangePageLink(1); // set default page
        shopPaginationAddPagesLinks(); // generate page navigation
   



}

function addActiveVariation(type) {
    if (activeColor.id && activeSize.id) {
        activeVariation = filteredVariations.filter((variation) => {
            return (
                variation.color_id == activeColor.id &&
                variation.size_id === activeSize.id
            );
        });

        activeVariation = activeVariation[0];
        if (activeVariation.stock_qty == 0) {
            $("#product_details_availability_report")
                .children(".holder")
                .addClass("active");
        } else {
            $("#product_details_availability_report")
                .children(".holder")
                .removeClass("active");
        }
    }

    changeProductDetailsSliderImages("add" , type);
}

function resetActiveVariation(type) {
    $("#product_details_availability_report")
        .children(".holder")
        .removeClass("active");

    changeProductDetailsSliderImages("reset" , type);
}


function changeProductDetailsSliderImages(key , type) {
    if(type == 'color') { 

  
    if (key == "reset") {
        filteredProductDetailsImagesSliders = productDetailsImagesSliders;
    } else {
        filteredProductDetailsImagesSliders =
            productDetailsImagesSliders.filter((item) => {
                return item.color_id == activeColor.id;
            });
    }

    let sliderData = ``;

    let sliderArray = [];

    let thumbSliderArray = [];

    filteredProductDetailsImagesSliders.forEach((item) => {
        sliderData += `<div class = 'zoom zomm-image image-holder'>`;
        sliderData += `<img class='item' src='${item.image}'>`;
        sliderData += `</div>`;

        sliderArray.push(sliderData);

        sliderData = ``;

        sliderData += `<img class='item' src='${item.image}'>`;

        thumbSliderArray.push(sliderData);

        sliderData = ``;
    });

    sliderArray = sliderArray.join();
    sliderArray = sliderArray.replace(",", "");

    thumbSliderArray = thumbSliderArray.join();
    thumbSliderArray = thumbSliderArray.replace(",", "");

    var sync1 = $("#product_details_preview_image_slider");
    sync1.fadeTo(400, 0.6);

    setTimeout(() => {
        sync1.trigger("replace.owl.carousel", sliderArray);
        sync1.trigger("to.owl.carousel", [0, 1]);
        sync1.trigger("refresh.owl.carousel");
    }, 600);

    setTimeout(() => {
        sync1.fadeTo(400, 1);
    }, 500);
    var sync2 = $("#product_details_thumb_image_slider");
    sync2.fadeTo(400, 0.6);

    setTimeout(() => {
        sync2.trigger("replace.owl.carousel", thumbSliderArray);
        sync2.trigger("refresh.owl.carousel");
        sync2.find(".owl-item").eq(0).addClass("current");
    }, 600);

    setTimeout(() => {
        sync2.fadeTo(400, 1);
    }, 500);


    if(window.innerWidth >= 650) { 

    setTimeout(() => {
        $(".zomm-image").zoom({
            magnify: 1.5,
        });
    }, 800);

    }
}
}

function convertToCm() {
    let guidesData = ``;
    sizeGuides.forEach((item) => {
        item.length =   Math.round(item.length * 2.54);
        item.hip = Math.round(item.hip * 2.54);
        item.wist = Math.round(item.wist * 2.54);
        item.bust = Math.round(item.bust * 2.54);
        item.shoulder = Math.round(item.shoulder * 2.54);

        guidesData += `<tr>`;
        guidesData += `<th scope = 'row'> ${item.size_name}  `;
        guidesData += `</th>`;
        guidesData += `<td > ${item.shoulder}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.bust}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.wist}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.hip}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.length}  `;
        guidesData += `</td>`;
        guidesData += `</tr>`;
    });

    $("#size_guide_records").empty().append(guidesData);
    $("#size_guide_headings span").text("cm");
    sizeGuideType = "cm";
}

function convertToIn() {
    let guidesData = ``;
    sizeGuides.forEach((item) => {
        item.length =  Math.round(item.length / 2.54);
        item.hip =  Math.round(item.hip / 2.54);
        item.wist =  Math.round(item.wist / 2.54);
        item.bust = Math.round(item.bust / 2.54);
        item.shoulder =   Math.round(item.shoulder / 2.54);

        guidesData += `<tr>`;
        guidesData += `<th scope = 'row'> ${item.size_name}  `;
        guidesData += `</th>`;
        guidesData += `<td > ${item.shoulder}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.bust}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.wist}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.hip}  `;
        guidesData += `</td>`;
        guidesData += `<td > ${item.length}  `;
        guidesData += `</td>`;
        guidesData += `</tr>`;
    });

    $("#size_guide_records").empty().append(guidesData);
    $("#size_guide_headings span").text("in");
    sizeGuideType = "in";
}

// product details append sizeguide data

jQuery(document).ready(function ($) {
    $("#shop_filter_categories_menu_blocks_father .son-filter-block").on(
        "click",
        function () {
            $categoryId = parseInt(
                $(this).children(".hidden-category-id").text()
            );

            if (
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .hasClass("opacityTrue")
            ) {
                filterValuesArray = filterValuesArray.filter((item) => {
                    item.name != activeCategoryName;
                });
                activeCategory = {};
                activeCategoryName = null;
                $(".shop-filter-category-trigger")
                    .children(".icon")
                    .removeClass("opacityTrue");
            } else {
                $(".shop-filter-category-trigger")
                    .children(".icon")
                    .removeClass("opacityTrue");
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .addClass("opacityTrue");

                activeCategory = categories.filter((item) => {
                    return item.id === $categoryId;
                });

                activeCategory = activeCategory[0];

                activeCategoryName = activeCategory.name;

                // add filter keys value

                let categoryObjectIndex = filterValuesArray.findIndex(function (
                    item
                ) {
                    return item.key == "category";
                });

                if (categoryObjectIndex > -1) {
                    filterValuesArray[categoryObjectIndex].value =
                        activeCategoryName;
                } else {
                    filterValuesArray.push({
                        value: activeCategoryName,
                        key: "category",
                    });
                }
                // add filter keys value
            }

            shopFilterProducts();
        }
    );

    $("#shop_filter_colors_menu_blocks_father .son-filter-block").on(
        "click",
        function () {
            $colorName = $(this).children(".name").text().trim();
            if (activeColorsNames.indexOf($colorName) !== -1) {
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .removeClass("opacityTrue");

                filterValuesArray = filterValuesArray.filter((item) => {
                    return item.value != $colorName;
                });

                activeColorsNames = activeColorsNames.filter((item) => {
                    return item != $colorName;
                });
            } else {
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .addClass("opacityTrue");
                activeColorsNames.push($colorName);

                let colorObjectIndex = filterValuesArray.findIndex(function (
                    item
                ) {
                    return item.key == "color" && item.value == $colorName;
                });

                if (colorObjectIndex > -1) {
                } else {
                    filterValuesArray.push({
                        value: $colorName,
                        key: "color",
                    });
                }
            }
            shopFilterProducts();
        }
    );

    $("#shop_filter_sizes_menu_blocks_father .son-filter-block").on(
        "click",
        function () {
            $sizeName = $(this).children(".name").text().trim();
            if (activeSizesNames.indexOf($sizeName) !== -1) {
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .removeClass("opacityTrue");

                filterValuesArray = filterValuesArray.filter((item) => {
                    return item.value != $sizeName;
                });

                activeSizesNames = activeSizesNames.filter((item) => {
                    return item != $sizeName;
                });
            } else {
                $(this)
                    .children(".shop-filter-icon-holder")
                    .children(".icon")
                    .addClass("opacityTrue");
                activeSizesNames.push($sizeName);

                let sizeObjectIndex = filterValuesArray.findIndex(function (
                    item
                ) {
                    return item.key == "size" && item.value == $sizeName;
                });

                if (sizeObjectIndex > -1) {
                    console.log("i add sizes  filter object ");
                } else {
                    filterValuesArray.push({
                        value: $sizeName,
                        key: "size",
                    });
                }
            }
            shopFilterProducts();
        }
    );

    $("#shop_filter_categories_menu_reset").on("click", function () {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "category";
        });
        $(".shop-filter-category-trigger")
            .children(".icon")
            .removeClass("opacityTrue");
        activeCategoryName = null;
        activeCategory = {};
        shopFilterProducts();
    });

    $("#shop_filter_sizes_menu_reset").on("click", function () {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "size";
        });
        $(".shop-filter-size-trigger")
            .children(".icon")
            .removeClass("opacityTrue");
        activeSizesNames = [];
        shopFilterProducts();
    });

    $("#shop_filter_colors_menu_reset").on("click", function () {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "color";
        });
        $(".shop-filter-color-trigger")
            .children(".icon")
            .removeClass("opacityTrue");
        activeColorsNames = [];
        shopFilterProducts();
    });

    $("#shop_filter_price_menu_reset").on("click", function () {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "price";
        });
        $("#shop_filter_menus_min_price").val(null);
        $("#shop_filter_menus_max_price").val(null);
        minPrice = null;
        maxPrice = null;
        shopFilterProducts();
    });

    $(".shop-menus-clear-all").on("click", function () {
        $("#shop_filter_categories_menu_reset").trigger("click");
        $("#shop_filter_price_menu_reset").trigger("click");
        $("#shop_filter_sizes_menu_reset").trigger("click");
        $("#shop_filter_colors_menu_reset").trigger("click");
        offer = null;
        type = null;
        name = null;
        filterValuesArray = [];
        shopFilterProducts();
    });

    $("#product_details_sizes_holder .holder").on("click", function () {
        if ($(this).hasClass("active")) {
            $("#product_details_sizes_holder .holder").removeClass("active");
            filteredVariations = variations.filter((item) => {
                return item.size_id;
            });
            activeSize = {};

            let colorsBlocks = document.getElementById(
                "product_details_colors_holder"
            ).children;

            colorsBlocks = Array.from(colorsBlocks);

            colorsBlocks.forEach((item) => {
                item.classList.remove("disabled");
            });
            resetActiveVariation('size');
        } else if ($(this).hasClass("disabled")) {
        } else {
            $("#product_details_sizes_holder .holder").removeClass("active");
            $(this).addClass("active");

            // assign active size
            let activeSizeId = $(this).children(".key").text().trim();
            let localActiveSize = sizes.filter((item) => {
                return item.id == activeSizeId;
            });
            localActiveSize = localActiveSize[0];

            activeSize = Object.assign({}, localActiveSize);
            addActiveVariation("size");
            // assign active size

            filteredVariations = variations.filter((item) => {
                return item.size_id == activeSize.id;
            });

            let filteredVariationsColorsIds = [];

            filteredVariations.forEach((item) => {
                filteredVariationsColorsIds.push(item.color_id);
            });

            let colorsBlocks = document.getElementById(
                "product_details_colors_holder"
            ).children;

            colorsBlocks = Array.from(colorsBlocks);

            colorsBlocks.forEach((item) => {
                item.classList.remove("disabled");
                if (
                    filteredVariationsColorsIds.indexOf(
                        parseInt(item.children.item(0).innerText.trim())
                    ) === -1
                ) {
                    item.classList.add("disabled");
                }
            });
        }
    });

    $("#product_details_colors_holder .holder").on("click", function () {
        if ($(this).hasClass("active")) {
            $("#product_details_colors_holder .holder").removeClass("active");
            filteredVariations = variations.filter((item) => {
                return item.color_id;
            });
            activeColor = {};

            let sizesBlocks = document.getElementById(
                "product_details_sizes_holder"
            ).children;

            sizesBlocks = Array.from(sizesBlocks);

            sizesBlocks.forEach((item) => {
                item.classList.remove("disabled");
            });

            resetActiveVariation('color');
        } else if ($(this).hasClass("disabled")) {
        } else {
            $("#product_details_colors_holder .holder").removeClass("active");
            $(this).addClass("active");

            // assign active color
            let activeColorId = $(this).children(".key").text().trim();
            let localActiveColor = colors.filter((item) => {
                return item.id == activeColorId;
            });
            localActiveColor = localActiveColor[0];

            activeColor = Object.assign({}, localActiveColor);
            addActiveVariation("color");
            // assign active color

            filteredVariations = variations.filter((item) => {
                return item.color_id == activeColor.id;
            });

            let filteredVariationsSizesIds = [];

            filteredVariations.forEach((item) => {
                filteredVariationsSizesIds.push(item.size_id);
            });

            let sizesBlocks = document.getElementById(
                "product_details_sizes_holder"
            ).children;

            sizesBlocks = Array.from(sizesBlocks);

            sizesBlocks.forEach((item) => {
                item.classList.remove("disabled");
                if (
                    filteredVariationsSizesIds.indexOf(
                        parseInt(item.children.item(0).innerText.trim())
                    ) === -1
                ) {
                    item.classList.add("disabled");
                }
            });
        }
    });

    $("#product_size_guide_switches .switch").on("click", function () {
        $("#product_size_guide_switches .switch").removeClass("active");
        $(this).addClass("active");
        $type = $(this).text().trim();

        if ($type == "centimeters" && sizeGuideType == "in") {
       
            convertToCm();
        } else if ($type == "inches" && sizeGuideType == "cm") {
     
            convertToIn();
        }
    });
});

// product details section



















