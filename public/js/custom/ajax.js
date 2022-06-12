function deleteWishlistItem(id) {
    id = parseInt(id);
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "wishlist/" + id,
        type: "DELETE",
        data: {
            id: id,
            _token: token,
        },
        success: function () {
    updateWishlistsItems("wishlist item deleted");
        },
    });
}

function updateWishlistsItems(text) {
    $.ajax({
        url: "wishlists/getData",
        type: "GET",

        success: function (response) {
            fireCustomToast(text);
            appendWishlistsData(response["wishlists"]);
        },
    });
}

function appendWishlistsData(wishlists) {
    let wishlistsData = ``;
    wishlists.forEach((product) => {
        if (wishlists.length) {
            wishlistsData += `<div class = "wishlist-block"> `;
            wishlistsData += `<div class = "image-container">`;
            wishlistsData += ` <img  src = '${product.image}' > `;
            wishlistsData += ` </div> `;
            wishlistsData += ` <div class = 'product-content' >  `;
            wishlistsData += ` <div class = 'category' > ${product.category.name}`;
            wishlistsData += ` </div> `;

            wishlistsData += ` <div class = 'name ' > ${product.name} `;
            wishlistsData += ` </div> `;

            if (product.discount_price) {
                wishlistsData += ` <div class = 'price' > DHs ${product.discount_price} `;
                wishlistsData += ` <span class = 'old-price' > DHs ${product.selling_price} `;
                wishlistsData += ` </span> `;
                wishlistsData += ` </div> `;
            } else {
                wishlistsData += ` <div class = 'price' > DHs ${product.selling_price} `;

                wishlistsData += ` </div> `;
            }

            wishlistsData += `</div> `;

            wishlistsData += `<button> Add To Cart`;

            wishlistsData += `</button> `;

            wishlistsData += `<div class = "link-paragraph"  onclick = "deleteWishlistItem(${product.id})"> delete`;

            wishlistsData += `</div> `;

            wishlistsData += `</div> `;
        } else {
            wishlistsData += `<div class="authentication-font  designing-div"> You dont have any wishlist item yet`;

            wishlistsData += `</div> `;
        }
    });

    let wishlistsHolder = $("#wishlists_items_holder");

    wishlistsHolder.empty().append(wishlistsData);

    $("#wishlists_items_holder").addClass("add-transation");

    setTimeout(() => {
        $("#wishlists_items_holder").empty().append(wishlistsData);
    }, 250);

    setTimeout(() => {
        $("#wishlists_items_holder").removeClass("add-transation");
    }, 500);

    document.getElementById("wishlists_items_number").innerText =
        wishlists.length;
}

function fireCustomToast(text) {
    document.getElementById("snackbar").innerHTML = text;
    var x = document.getElementById("snackbar");
    x.classList.add("show-snackbar");

    setTimeout(function () {
        x.classList.remove("show-snackbar");
    }, 3000);
}
