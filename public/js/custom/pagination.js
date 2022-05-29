


if (filteredProducts.length) {


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




















