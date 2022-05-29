<template>
    <v-app>
        <v-main>
            <admins-navbar></admins-navbar>
            <loader />
            <div
                class="options-container"
                :class="{ show_content: showContent }"
            >
                <div class="row">
                    <div class="col-md-5 col-12">
                        <colors />
                    </div>
                    <div class="col-md-5 col-12">
                        <sizes />
                    </div>
                </div>
            </div>
        </v-main>
    </v-app>
</template>

<script src="./options.js"></script>
