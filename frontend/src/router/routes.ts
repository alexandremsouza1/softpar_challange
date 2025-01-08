import { RouteRecordRaw } from "vue-router";
import { useStore } from "vuex";

const routes: RouteRecordRaw[] = [
    {
        path: "/login",
        component: () => import("layouts/MainLayout.vue"),
        children: [{ path: "", component: () => import("pages/LoginPage.vue") }],
    },
    {
        path: "/logout",
        component: () => import("layouts/MainLayout.vue"),
        children: [{ path: "", component: () => import("pages/LogoutPage.vue") }],
    },
    {
        path: "/register",
        component: () => import("layouts/MainLayout.vue"),
        children: [{ path: "", component: () => import("pages/RegisterPage.vue") }],
    },
    {
        path: "/",
        redirect: "/tasks",
        component: () => import("layouts/MainLayout.vue"),
        children: [
            {
                path: "/profile",
                component: () => import("pages/ProfilePage.vue"),
            },
            {
                path: "/tasks",
                component: () => import("pages/TaskList.vue")
            },
            {
                path: "/categories",
                component: () => import("pages/CategoryList.vue")
            },
            {
                path: "/alerts",
                component: () => import("pages/AlertList.vue")
            }
        ],
        beforeEnter: (to, from, next) => {
            const store = useStore();
            if (!store.getters["isAuthenticated"]) {
                next("/login");
            } else {
                next();
            }
        }
    },
    {
        path: "/:catchAll(.*)*",
        component: () => import("pages/ErrorNotFound.vue"),
    },
];

export default routes;