import VueRouter from 'vue-router';
import PostIndex from './posts/Index.vue';
import PostCreate from './posts/PostCreate.vue';


let routes =  [
    {
        path:'/',
        component: PostIndex,
        name: 'posts.index'
    },
    {
        path: '/posts/create',
        component: PostCreate,
        name: 'posts.create'
    }
]

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});