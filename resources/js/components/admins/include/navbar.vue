<template>
    <nav
        class="navbar navbar-light navbar-expand-lg"
        style="background-color: #ffff"
    >
        <div class="row">
            <div class="col-12">
                <div class="admins-navbar-container">
                    <div class="navbar-brand">
                        <a href="/admins/dashboard">
                            <img
                                class="brand-image"
                                src="/images/main/brand.webp"
                                alt="no image"
                        /></a>
                        <p class="bread-crumb">
                            <a href="/admins/dashboard">Home </a>
                            <span v-if="handleBreadCrumb()">
                                /
                                <a href="#" @click.prevent="reloadPage()">
                                    {{ getUrlParagraph() }}
                                </a>
                            </span>
                        </p>

                        <ul class="account-menu-holder">
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle paragraph"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <v-icon> mdi-account </v-icon>
                                    {{ $user.username }}
                                </a>
                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdown-menu"
                                    id="account-menu"
                                >
                                    <li>
                                        <form
                                            id="big_screen_logout_form"
                                            method="post"
                                            action="/logout"
                                        >
                                            <input
                                                type="hidden"
                                                name="_token"
                                                :value="csrf"
                                            />
                                            <a
                                                href="javascript:{}"
                                                a
                                                class="dropdown-item"
                                                onclick="document.getElementById('big_screen_logout_form').submit();"
                                                >Logout</a
                                            >
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>


                    <button
                      
                       class="navbar-toggler no-focus float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon no-focus"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-dashboard'),
                                    }"
                                    aria-current="page"
                                    href="/admins/dashboard"
                                    >Dashboard</a
                                >
                            </li>

                            <li class="nav-item" v-if="$user.role === 2">
                                <a
                                    class="nav-link"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-users'),
                                    }"
                                    aria-current="page"
                                    href="/admins/users"
                                    >Admins</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-sliders'),
                                    }"
                                    aria-current="page"
                                    href="/admins/sliders"
                                    >Sliders</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-categories'),
                                    }"
                                    aria-current="page"
                                    href="/admins/categories"
                                    >Categories</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-options'),
                                    }"
                                    aria-current="page"
                                    href="/admins/options"
                                    >Options</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    href="/admins/products"
                                    :class="{
                                        active_navbar_link:
                                            linkIsActive('admins-products'),
                                    }"
                                    class="nav-link"
                                    >Products</a
                                >
                            </li>
                            <ul class="small-screen-menu">
                                <li class="nav-item dropdown">
                                    <a
                                 

                                           class="nav-link dropdown-toggle paragraph"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >
                                        <v-icon> mdi-account </v-icon>
                                        {{ $user.username }}
                                    </a>
                                    <ul
                                        class="dropdown-menu"
                                        aria-labelledby="navbarDropdown"
                                        id="account-menu"
                                    >
                          
                                       <form
                                            id="big_screen_logout_form"
                                            method="post"
                                            action="/logout"
                                        >
                                            <input
                                                type="hidden"
                                                name="_token"
                                                :value="csrf"
                                            />
                                            <a
                                                href="javascript:{}"
                                                a
                                                class="dropdown-item"
                                                onclick="document.getElementById('big_screen_logout_form').submit();"
                                                >Logout</a
                                            >
                                        </form>
                                    </ul>
                                </li>
                            </ul>
                        </ul>
                        <div class="search-input-holder">
                            <div class="digital-clock">
                                <span> 00:00:00 </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>




</template>

<script>
$(document).ready(function () {
    clockUpdate();
    setInterval(clockUpdate, 1000);
});

function clockUpdate() {
    var date = new Date();
    $(".digital-clock").css({
        color: "#fff",
    });

    function addZero(x) {
        if (x < 10) {
            return (x = "0" + x);
        } else {
            return x;
        }
    }

    function twelveHour(x) {
        if (x > 12) {
            return (x = x - 12);
        } else if (x == 0) {
            return (x = 12);
        } else {
            return x;
        }
    }

    var h = addZero(twelveHour(date.getHours()));
    var m = addZero(date.getMinutes());
    var s = addZero(date.getSeconds());

    $(".digital-clock").text(h + ":" + m + ":" + s);
}

export default {
    data: () => ({
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    }),
    methods: {
        linkIsActive(link) {
            return this.$route.name == link;
        },

        handleBreadCrumb() {
            return this.$route.name == "admins-dashboard" ? false : true;
        },

        reloadPage() {
            location.reload();
        },

        getUrlParagraph() {
            let name = this.$route.name;
            let paragraph = "";
            let index = name.indexOf("-");
            paragraph = name.substring(index + 1);

            return paragraph.charAt(0).toUpperCase() + paragraph.slice(1);
        },
    },
};
</script>
