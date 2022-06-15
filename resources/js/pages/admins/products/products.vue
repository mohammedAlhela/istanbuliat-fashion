<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />

            <div
                class="products-container"
                :class="{ show_content: showContent }"
            >
                <products-header
                    :filteredProducts="filteredProducts"
                    :tags="tags"
                    :colors="colors"
                    :sizes="sizes"
                    @openSaveDialog="openSaveDialog"
                >
                </products-header>

                <products-table></products-table>

                <delete-data-snackbar
                    :deleteSnackbar="deleteSnackbar"
                    @closing="closeDeleteSnackbar()"
                    @deleteData="destroy()"
                    :useDefault="!products.length"
                    customParagraph="are you sure you want to delete the product ? deleting the product will remove all the related data including images and size guide data and variations"
                ></delete-data-snackbar>

          

                <products-save-dialog> </products-save-dialog>
              <variations-main-dialog
                    :editedIndex="editedIndex"
                    :products="products"
                    :datatableIndex="datatableIndex"
                ></variations-main-dialog> 


                 <size-guides-main-dialog
                    :editedIndex="editedIndex"
                    :products="products"
                    :datatableIndex="datatableIndex"
                ></size-guides-main-dialog>  

                
<product-colors-main-dialog    :editedIndex="editedIndex"
                    :products="products"
                    :datatableIndex="datatableIndex">

</product-colors-main-dialog>


            </div>
        </v-main>
    </v-app>
</template>

<script src="./products.js"></script>
