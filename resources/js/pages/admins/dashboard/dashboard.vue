<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />
            <div
                class="dashboard-container"
                :class="{ show_content: showContent }"
            >
                <informations-cards></informations-cards>
                <data-charts></data-charts>
                <orders-and-subscribers></orders-and-subscribers>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./dashboard.js"></script>
