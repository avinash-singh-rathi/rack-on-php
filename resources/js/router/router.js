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
        path: '/filemanager',
        name: 'filemanager',
        component: require('../pages/FileManager/Index.vue').default
    },
    {
        path: '/pages',
        //name: 'pages',
        component: { render: h => h('router-view') },
        //component: require('../pages/Pages/pages.vue').default,
        children:[
          {
            path: '',
            name: 'pages',
            component: require('../pages/Pages/pages.vue').default,
          },
          {
              path: 'add',
              name: 'addpage',
              component: require('../pages/Pages/addPage.vue').default
          },
          {
              path: 'edit/:id',
              name: 'EditPage',
              component: require('../pages/Pages/EditPage.vue').default
          },
        ]
    },
    {
        path: '/posts',
        //name: 'pages',
        component: { render: h => h('router-view') },
        //component: require('../pages/Pages/pages.vue').default,
        children:[
          {
            path: '',
            name: 'posts',
            component: require('../pages/Posts/Index.vue').default,
          },
          {
              path: 'add',
              name: 'AddPost',
              component: require('../pages/Posts/Add.vue').default
          },
          {
              path: 'edit/:id',
              name: 'EditPost',
              component: require('../pages/Posts/Edit.vue').default
          },
        ]
    },
    // {
    //     path: '/pages/add',
    //     name: 'addpage',
    //     component: require('../pages/Pages/addPage.vue').default
    // },
    // {
    //     path: '/pages/edit',
    //     name: 'addpage',
    //     component: require('../pages/Pages/addPage.vue').default
    // },

];

export const router = new VueRouter({
    //mode: 'history',
    routes
});
