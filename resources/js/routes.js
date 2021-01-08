import PostIndex from './posts/Index.vue';
import PostCreate from './posts/PostCreate.vue';


const routes =  [
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

export default router;