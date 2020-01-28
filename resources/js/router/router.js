import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

let routes = [
    {
        path: '/',
        name: 'home',
        component: require('../pages/home.vue').default
    },
    {
        path: '/users',
        name: 'users',
        component: require('../pages/users.vue').default
    },
    {
        path: '/pages',
        name: 'pages',
        component: require('../pages/Pages/pages.vue').default
    },
    {
        path: '/pages/add',
        name: 'addpage',
        component: require('../pages/Pages/addPage.vue').default
    },
];

export const router = new VueRouter({
    //mode: 'history',
    routes
});
