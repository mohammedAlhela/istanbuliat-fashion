<template>
    <v-data-table
        :headers="headers"
        :items="admins"
        :items-per-page="15"
        item-key="item.id"
        mobile-breakpoint="1000"
        class="datatable"
    >
        <template v-slot:item.username="{ item }">
            <td class="p-3">
                {{ item.username }}

                <div class="mt-1 paragraph">
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                {{ item.last_seen }}
                            </span>
                        </template>
                        <span> Last Seen </span>
                    </v-tooltip>
                </div>
                <div class="mt-2 primary-font">
                    <v-chip
                        small
                        :color="item.role == 2 ? 'primary' : 'warning'"
                    >
                        {{ item.role == 2 ? "manager" : "admin" }}
                    </v-chip>
                </div>
            </td>
        </template>
        <template v-slot:item.status="{ item }">
            <td>
                <v-chip small :color="item.status == 1 ? 'success' : 'error'">
                    {{ item.status == 1 ? "active" : "not active" }}
                </v-chip>
            </td>
        </template>

        <template v-slot:item.actions="{ item }">
            <!-- actions -->
            <td>
                <div>
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="$emit('editItem', item)"
                                    class="mr-2 icon"
                              
                                >
                                    mdi-pencil
                                </v-icon>
                            </span>
                        </template>
                        <span>
                        Update record
                        </span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="$emit('updateStatus', item)"
                                    class="mr-2 icon"
                                >
                                    mdi-swap-horizontal-bold
                                </v-icon>
                            </span>
                        </template>
                        <span> Change record status </span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                v-if = "item.role != 2"
                                    @click="$emit('showDeleteSnackbar', item)"
                                    class="mr-2 icon"
                                
                                >
                                    mdi-delete
                                </v-icon>
                            </span>
                        </template>
                        <span> Delete record </span>
                    </v-tooltip>
                </div>

                <!-- actions -->
            </td>
        </template>
    </v-data-table>
</template>

<script>
export default {
    username: "UsersTable",
    props: {
        admins: {
            required: true,
            type: Array,
        },

        headers: {
            required: true,
            type: Array,
        },
    },
};
</script>
