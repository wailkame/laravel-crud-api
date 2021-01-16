import VueRouter from 'vue-router';
import PostIndex from './posts/Index.vue';
import PostCreate from './posts/PostCreate.vue';
import PostEdit from './posts/PostEdit.vue';
import PostLogin from './posts/Login.vue';
let routes =  [
    {
        path:'/',
        component:PostLogin,
        name:'posts.login'
    },  
    {
        path:'/index',
        component: PostIndex,
        name: 'posts.index'
    },
    {
        path: '/posts/create',
        component: PostCreate,
        name: 'posts.create'
    },
    {
        path: '/edit/:id',
        component: PostEdit,
        name: 'posts.edit'
    }
]

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});