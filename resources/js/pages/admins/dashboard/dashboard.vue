<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />

   
            <div
                class="dashboard-container" 
                :class="{ show_content: showContent }"
            >
                <informations-cards :products = "products" :customers = "customers"  :admins = "admins"></informations-cards>
                <data-charts></data-charts>
                <orders-and-subscribers :subscribers = "subscribers"></orders-and-subscribers>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./dashboard.js"></script>
