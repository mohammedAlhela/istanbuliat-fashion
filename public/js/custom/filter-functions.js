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
        filterValuesArray[
            priceObjectIndex
        ].value = `${minPrice ? minPrice : 0}-${maxPrice ? maxPrice : max_price } AED`;
    } else {
        mainDataObject.shopFilter.filterValuesArray.push(
            (priceObject = {
                key: "price",
                value: `${minPrice ? minPrice : 0}-${maxPrice ? maxPrice : max_price} AED`,
            })
        );
    }
    shopFilterProducts();
}

function triggerShopFilterMainSearch(e, idKey) {
    e.preventDefault();

    let data = document
        .getElementById(idKey)
        .value.toLowerCase()
        .trim()
        .replace(" ", "-");

    window.location.replace(`/shop?name=${data}`);
}

function checkIfColorIsExist(item) {
    let exist = false;
    activeColorsNames.forEach((color) => {
        item.colors.search(color) > -1
            ? (exist = true)
            : console.log("not exist");
    });

    return exist;
}

function checkIfSizeIsExist(item) {
    let exist = false;
    activeSizesNames.forEach((size) => {
        item.sizes.search(size) > -1
            ? (exist = true)
            : console.log("not exist");
    });

    return exist;
}

function filterPrice(item) {
    if(maxPrice && minPrice) { 
    return item.price >= minPrice && item.price <= maxPrice ;
    }else if (!maxPrice && minPrice) { 
        return item.price >= minPrice ;
    }else if (maxPrice && !minPrice) { 
        return item.price <= maxPrice ;
    }else if (!maxPrice && !minPrice) { 
        return true ;
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
                  item.colors
                      .split(",")
                      .indexOf(name.toLowerCase().replace("-", " ")) !== -1 ||
                  item.sizes
                      .split(",")
                      .indexOf(name.toLowerCase().replace("-", " ")) !== -1
                : true) &&
            (offer ? item.offer != null && item.offer <= offer : true) &&
            (activeColorsNames.length ? checkIfColorIsExist(item) : true) &&
            (activeSizesNames.length ? checkIfSizeIsExist(item) : true) &&
            (filterPrice(item))
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

function shopAppendProductsData(filteredData, itemsPerPage = 9, page = 1) {
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
            shopProductsData += ` <div class = 'category' > ${filteredData[index].category.name}   ${filteredData[index].category_id}  `;
            shopProductsData += ` </div> `;

            shopProductsData += ` <div class = 'name ' > ${filteredData[index].name} `;
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
        shopProductsData += `<div class = 'filter-results-holder'> No Related products with the search results `;

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
    setTimeout(() => {
        $(".shop-products-section .product-block").addClass("add-transation");
    }, 50);
    setTimeout(() => {
        !$(".shop-products-section").hasClass("add-transation") &&
        !filteredProducts.length
            ? $(".shop-products-section").addClass("add-transation")
            : $(".shop-products-section").removeClass("add-transation");

        $(".shop-products-section").empty().append(shopProductsData);
    }, 500);
    // append products data with transition

    if (activeCategoryName) {
        shopAppendHeading("category");
    }
    if (type) {
        shopAppendHeading("type");
    }

    if (offer) {
        shopAppendHeading("offer");
    }

    if (!activeCategoryName && !offer && !type) {
        shopAppendHeading("main");
    }

    shopAppendFilterKeysValues();
    shopAppendProductsNumber();

    shopAppendSelectedItemsNumber();

    if (filteredProducts.length < 10) {
        document
            .getElementById("pagination_prev_link")
            .classList.add("d-none");
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
    let des = "";
    let headingData = ``;

    if (key == "category") {
        head = activeCategoryName;
        des =
            activeCategory.description ||
            "The golden hour glow at sunset, the smell of sea salt in the air, the gentle cool breeze of summer wind against our";
    } else if (key == "type") {
        if (type == "new-for-you") {
            head = "new for you";

            des =
                "The golden hour glow at sunset, the smell of sea salt in the air, the gentle cool breeze of summer wind against our f";
        } else {
            head = "back in stuck";
            des =
                "The golden hour glow at sunset, the smell of sea salt in the air, the gentle cool breeze of summer wind against our ";
        }
    } else if (key == "offer") {
        head = `offers up to ${offer} %`;

        des =
            "Shop our great stylish fashion collections with offers up to 60 % off";
    } else if (key == "main") {
        head = `all collections`;

        des =
            "Shop our great stylish fashion collections with new trending products";
    }

    headingData += `<div class = 'header'> ${head} `;
    headingData += `</div>`;

    headingData += `<div class = 'text'> ${des}  `;
    headingData += `</div>`;

    $("#shop_filter_main_heading").empty().append(headingData);
}

function clearShopFilterKeyValue(key, value) {
    filterValuesArray = filterValuesArray.filter((item) => {
        return item.value != value;
    });

    if (key == "category") {
        let categoryBlocks = document.getElementById(
            "shop_filter_categories_menu_blocks_father"
        ).children;

        categoryBlocks = Array.from(categoryBlocks);

        categoryBlocks.forEach((item) => {
            if (item.children.item(1).innerText.trim() == activeCategoryName) {
                item.children
                    .item(0)
                    .children.item(0)
                    .classList.remove("opacityTrue");
            }
        });

        activeCategoryName = null;
        activeCategory = {};
    }

    if (key == "color") {
        let colorsBlocks = document.getElementById(
            "shop_filter_colors_menu_blocks_father"
        ).children;

        colorsBlocks = Array.from(colorsBlocks);

        colorsBlocks.forEach((item) => {
            if (item.children.item(1).innerText.trim() == value) {
                item.children
                    .item(0)
                    .children.item(0)
                    .classList.remove("opacityTrue");
            }
        });

        activeColorsNames = activeColorsNames.filter((color) => {
            return color != value;
        });
    }

    if (key == "size") {
        let sizesBlocks = document.getElementById(
            "shop_filter_sizes_menu_blocks_father"
        ).children;

        sizesBlocks = Array.from(sizesBlocks);

        sizesBlocks.forEach((item) => {
            if (item.children.item(1).innerText.trim() == value) {
                item.children
                    .item(0)
                    .children.item(0)
                    .classList.remove("opacityTrue");
            }
        });

        activeSizesNames = activeSizesNames.filter((size) => {
            return size != value;
        });
    }

    if (key == "price") {
        filterValuesArray = filterValuesArray.filter((item) => {
            return item.key != "price";
        });
        $("#shop_filter_menus_min_price").val(100);
        $("#shop_filter_menus_max_price").val(1000);
        minPrice = 100;
        maxPrice = 1000;
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


// product details section +++++++++++++++++++++++




// product details section +++++++++++++++++++++++