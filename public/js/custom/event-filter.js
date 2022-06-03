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
