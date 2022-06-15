<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />
            <div
                class="admins-container"
                :class="{ show_content: showContent }"
            >
                <users-header
                    :admins="admins"
                    @openSaveDialog="openSaveDialog"
                >
                </users-header>
                <users-table
                    :headers="headers"
                    :admins="admins"
                    @showDeleteSnackbar="showDeleteSnackbar"
                   @updateStatus="updateStatus"
                    @editItem="editItem"
                ></users-table>
                <delete-data-snackbar
                    :deleteSnackbar="deleteSnackbar"
                    @closing="closeDeleteSnackbar()"
                    @deleteData="destroy()"
                    :useDefault="!admins.length"
                    customParagraph="are you sure you want to delete the Admin ? all related data will deleted also"
                ></delete-data-snackbar>
                <users-save-dialog> </users-save-dialog>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./users.js"></script>

