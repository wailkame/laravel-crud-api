import VueRouter from 'vue-router';
import PostIndex from './posts/Index.vue';
import PostCreate from './posts/PostCreate.vue';
import PostEdit from './posts/PostEdit.vue';
import PostLogin from './posts/Login.vue';

let routes =  [
    {
        path:'/',
        component:PostLogin,
        name:'posts.login',
        meta: { requiresVisitor: true }
    },  
    {
        path:'/index',
        component: PostIndex,
        name: 'posts.index',
        meta: { requiresAuth: true }
    },
    {
        path: '/posts/create',
        component: PostCreate,
        name: 'posts.create',
        meta: { requiresAuth: true }
    },
    {
        path: '/edit/:id',
        component: PostEdit,
        name: 'posts.edit',
        meta: { requiresAuth: true }
    }
]

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});