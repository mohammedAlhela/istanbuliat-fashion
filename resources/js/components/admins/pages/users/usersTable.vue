<template>
    <v-data-table
        :headers="headers"
        :items="filteredAdmins"
        :items-per-page="15"
        item-key="item.id"
        mobile-breakpoint="1000"
        class="datatable"
    >
        <template v-slot:item.name="{ item }">
            <td class="p-3">
                {{ item.name }}
                <div class = "mt-2 primary-font">


                    <v-chip v-if="item.role === 2" small class="" color="primary">
          manager
        </v-chip>

        <v-chip v-else small class="" color="warning"> admin </v-chip>
                </div>

            </td>
        </template>

        <template v-slot:item.last_seen="{ item }">
            <td class="p-1">
             {{ new Date('December 12, 2020 18:30:01') }}
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
                                    :class="{
                                        disabled: buttonIsDisabled(
                                            item,
                                            'update'
                                        ),
                                    }"
                                >
                                    mdi-pencil
                                </v-icon>
                            </span>
                        </template>
                        <span>
                            {{
                                item.id != $user.id && item.role === "manager"
                                    ? "no permissions to do this action"
                                    : "Update record"
                            }}
                        </span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="$emit('showDeleteSnackbar', item)"
                                    class="mr-2 icon"
                                    :class="{
                                        disabled: buttonIsDisabled(
                                            item,
                                            'delete'
                                        ),
                                    }"
                                >
                                    mdi-delete
                                </v-icon>
                            </span>
                        </template>
                        <span>
                            {{
                                item.role === "manager"
                                    ? "no permissions to do this action"
                                    : "Delete record"
                            }}
                        </span>
                    </v-tooltip>
                </div>

                <!-- actions -->
            </td>
        </template>
    </v-data-table>
</template>

<script>
export default {
    name: "UsersTable",
    props: {
        filteredAdmins: {
            required: true,
            type: Array,
        },

        headers: {
            required: true,
            type: Array,
        },
    },

    methods: {
        buttonIsDisabled(item, action) {
            if (action === "update") {
                return item.role === "manager" && item.id != this.$user.id;
            } else {
                return item.role === "manager";
            }
        },
    },
};
</script>
