import {createRouter, createWebHistory} from "vue-router";
import HomeView from "../views/HomeView.vue";
import store from "@/store";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            component: () => import("../layouts/layout.vue"),
            children: [
                {
                    path: "/",
                    name: "HomePage",
                    component: HomeView,
                    meta: {
                        title: "Home",
                        loadActions: ['post/getAll'],
                        requiresAuth: false
                    }
                },
                {
                    path: "/about",
                    name: "AboutPage",
                    component: () => import("../views/AboutView.vue"),
                    meta: {
                        title: "About",
                        loadActions: [],
                        requiresAuth: false
                    }
                },
                {
                    path: "/login",
                    name: "LoginPage",
                    component: () => import("../views/LoginView.vue"),
                    meta: {
                        title: "Login",
                        loadActions: [],
                        onlyGuest: true,
                        requiresAuth: false
                    }
                },
                {
                    path: "/my-posts",
                    name: "MyPostsPage",
                    component: () => import("../views/MyPostsView.vue"),
                    meta: {
                        title: "My Posts",
                        loadActions: ['post/getMyPosts'],
                        requiresAuth: true
                    }
                },
                {
                    path: "/post/:id",
                    name: "PostPage",
                    component: () => import("../views/PostView.vue"),
                    meta: {
                        loadActions: ['post/getMyPosts/:id'],
                        requiresAuth: false
                    }
                },

            ],
        },
        {
            // the 404 route, when none of the above matches
            path: "/404",
            name: "404",
            component: () => import("../views/error/Error404View.vue"),
        },
        {
            path: "/:pathMatch(.*)*",
            redirect: "/404",
        },
    ],
});



router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters['auth/isAuthenticated']) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.onlyGuest)) {
        if (store.getters['auth/isAuthenticated']) {
            next("/");
            return;
        }
        next();
    } else {
        next();
    }
});


router.beforeEach(async (to, from, next) => {
    try {
        if (to.meta.loadActions) {
            const loadings = [];
            for (const load of to.meta.loadActions) {
                loadings.push(store.dispatch(load))
            }
            await Promise.all(loadings)
        }
    } finally {
        next()
    }
})



export default router;
