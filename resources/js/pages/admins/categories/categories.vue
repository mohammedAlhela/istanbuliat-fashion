<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />
            <div class="categories-container" :class="{ show_content: showContent }">
                <categories-header :categories="categories" @openSaveDialog="openSaveDialog">
                </categories-header>

                <categories-table :headers="headers" :categories="categories" @showDeleteSnackbar="showDeleteSnackbar"
                    @updateStatus="updateStatus" @editItem="editItem"></categories-table>

                <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()"
                    @deleteData="destroy()" :useDefault="!categories.length"
                    customParagraph="are you sure you want to delete the category ?">
                </delete-data-snackbar>



                <delete-data-snackbar :deleteSnackbar="blockDeleteSnackbar" @closing="closeBlockDeleteSnackbar()"
                    :useDefault="!categories.length" :customParagraph="blockDeleteReport" type="blockDelete">
                </delete-data-snackbar>

                <categories-save-dialog> </categories-save-dialog>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./categories.js"></script>
