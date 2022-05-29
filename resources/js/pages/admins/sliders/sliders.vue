<template>
    <v-app>
        <v-main>

                  <admins-navbar></admins-navbar>
            <loader />

            <div class="sliders-container" :class = "{show_content:showContent}">
                <sliders-header
                    :sliders="sliders"
                    @openSaveDialog="openSaveDialog"
                >
                </sliders-header>

                <sliders-table
                    :headers="headers"
                    :sliders="sliders"
                    @showDeleteSnackbar="showDeleteSnackbar"
                    @updateStatus="updateStatus"
                    @editItem="editItem"
                ></sliders-table>

                <delete-data-snackbar
                    :deleteSnackbar="deleteSnackbar"
                    @closing="closeDeleteSnackbar()"
                    @deleteData="destroy()"
                    :useDefault="!sliders.length"
                    customParagraph="are you sure you want to delete the slider ? all related data will deleted also"
                ></delete-data-snackbar>

                <sliders-save-dialog> </sliders-save-dialog>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./sliders.js"></script>
