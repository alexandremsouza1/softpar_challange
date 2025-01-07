import type { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: "/login",
    component: () => import("layouts/MainLayout.vue"),
    children: [{ path: "", component: () => import("pages/LoginPage.vue") }],
  },
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    // children: [
    //   {
    //     path: "",
    //     component: () => import("pages/TaskList.vue"),
    //   },
    // ],
    beforeEnter: (to, from, next) => {
      if (!localStorage.getItem("token")) {
        next("/login");
      } else {
        next();
      }
    },
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
