import Vue from "vue";
import VueRouter from "vue-router";

// admins routes
import adminsDashboard from "../pages/admins/dashboard/dashboard.vue";
import adminsUsers from "../pages/admins/admins/users.vue";
import adminsSliders from "../pages/admins/sliders/sliders.vue";
import adminsCategories from "../pages/admins/categories/categories.vue";
import adminsOptions from "../pages/admins/options/options.vue";
import adminsProducts from "../pages/admins/products/products.vue";
// admins routes



Vue.use(VueRouter);
const routes = [
  

    {
        path: "/admins/dashboard",
        name: "admins-dashboard",
        component: adminsDashboard,
    },

    {
        path: "/admins/users",
        name: "admins-users",
        component: adminsUsers,
    },

    {
        path: "/admins/sliders",
        name: "admins-sliders",
        component: adminsSliders,
    },

    {
        path: "/admins/categories",
        name: "admins-categories",
        component: adminsCategories,
    },

    {
        path: "/admins/options",
        name: "admins-options",
        component: adminsOptions,
    },

    {
        path: "/admins/products",
        name: "admins-products",
        component: adminsProducts,
    },
    // admins routes
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
