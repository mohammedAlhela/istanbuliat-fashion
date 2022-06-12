<template>

        <v-app>
            <v-main>
                <div
                    class="wishlists-section"
      
                >
                        <!-- <transition name="fade">
                        <div v-if="showContent">
                            <div class="global-actions" v-if="wishlists.length">
                                <div class="header">
                                    Total Items : {{ wishlists.length }}
                                </div>
                        
                            </div>

                            <div
                                class="small-screen-items bordered"
                                v-if="wishlists.length"
                            >
                                <div class="small-screen-items">
                                    <div
                                        class="table-body"
                                        :class="{ no_border_top: i === 0 }"
                                        v-for="(wishlist, i) in wishlists"
                                        :key="i"
                                    >
                                        <div class="image-container">
                                            <img
                                                class="image"
                                                :src="wishlist.preview_image"
                                                alt=""
                                            />
                                        </div>

                                        <div class="content-container">
                                            <div class="contant">
                                                <a
                                                    class="name"
                                                    :href="`/product/${wishlist.slug}`"
                                                >
                                                    {{ wishlist.name }}
                                                </a>

                                                <span class="color">
                                                    <strong> Colors :</strong>
                                                    <span class="color-option">
                                                        <span
                                                            :style="{
                                                                backgroundColor:
                                                                    color.hex,
                                                            }"
                                                            class="color-block"
                                                            v-for="(
                                                                color, index
                                                            ) in wishlist.colors"
                                                            :key="index"
                                                        ></span>
                                                    </span>
                                                </span>

                                                <span class="size">
                                                    <strong> Sizes :</strong>
                                                    <span class="size-option">
                                                        <span
                                                            v-for="(
                                                                size, index
                                                            ) in filteredArray(
                                                                wishlist.sizes
                                                            )"
                                                            :key="index"
                                                        >
                                                            {{ size.name }}
                                                            <span
                                                                v-if="
                                                                    filteredArray(
                                                                        wishlist.sizes
                                                                    ).length >
                                                                        1 &&
                                                                    filteredArray(
                                                                        wishlist.sizes
                                                                    ).length -
                                                                        index !=
                                                                        1
                                                                "
                                                                v-html="
                                                                    `<span class = 'seperator'  > | </span>`
                                                                "
                                                            ></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="clearing"></div>
                                        </div>

                                        <span class="actions wishlist-actions">
                                            <span class="total">
                                                <strong> Price : </strong> ${{
                                                    wishlist.discount_price ||
                                                    wishlist.selling_price
                                                }}
                                            </span>
                                            <div class="links-holder">
                                                <span
                                                    class="link"
                                                    @click="
                                                        $store.dispatch(
                                                            'wishlists/delete',
                                                            wishlist
                                                        )
                                                    "
                                                    >Delete</span
                                                >
                                            </div>
                                        </span>

                                        <div class="clearing"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="no-records" v-else>
                                No items in the wishlist
                            </div>
                        </div>
                    </transition> -->
                </div>
            </v-main>
        </v-app>


</template>

<script src="./wishlists.js"></script>
