<template>
    <div class="row">
        <div class="col-12 col-md-6  left-header-section">
            <span class="main-header">
                {{ filteredAdmins.length }} Admins
            </span>

            <span class="ml-3" >
                <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            class="no-focus add-button"
                            color="success"
                            fab
                            v-bind="attrs"
                            v-on="on"
                            x-small
                            dark
                            @click="$emit('openSaveDialog')"
                        >
                            <v-icon> mdi-plus </v-icon>
                        </v-btn>
                    </template>
                    <span> Add new admin </span>
                </v-tooltip>
            </span>
        </div>

        <div class="col-6 col-md-6 right-header-section">
            <v-text-field
                class="search-input"
                solo
                dense
                :value="search"
                rounded
                append-icon="mdi-magnify"
                label="search"
                @input="$emit('setSearchValue', $event)"
            >
            </v-text-field>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UsersHeader',
    props: {
        filteredAdmins: {
            required: true,
            type: Array
        },

        search: {
            required: true,
            type: String
        }
    }
}
</script>
