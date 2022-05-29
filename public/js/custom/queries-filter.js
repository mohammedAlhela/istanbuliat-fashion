
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
