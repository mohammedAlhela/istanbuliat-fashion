<template>
    <div class="row">
        <div class=" col-6 ">
            <span class="main-header">
                {{ admins.length }} Admins
            </span>
            <v-chip class="ma-2 p-2" small label color="#ebebeb">
                <a href="/admins/excel/export" class="t">
                    <span class=""> Export Excel </span>
                </a>
            </v-chip>
        </div>

        <div class=" col-6  text-right">
            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn class="no-focus add-button" color="success" fab v-bind="attrs" v-on="on" x-small dark
                        @click="$emit('openSaveDialog')">
                        <v-icon> mdi-plus </v-icon>
                    </v-btn>
                </template>
                <span> Add new record </span>
            </v-tooltip>

        </div>
    </div>
</template>

<script>
export default {
    name: 'UsersHeader',
    props: {
        admins: {
            required: true,
            type: Array
        },

    }
}
</script>
