<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link :to="{name: 'posts.login'}" class="navbar-brand" exact>CrudApi</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav" v-if="currentPath === '/index' || currentPath === '/posts/create'">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{name: 'posts.index'}" class="nav-link" exact>Posts list</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name: 'posts.create'}" class="nav-link" exact>Add New Post</router-link>
                </li>
            </ul>
            <ul class="navbar-nav mr-5" >
                <li class="nav-item"><span role="link" tabindex="0" style="cursor:pointer; color:blue;" @click.prevent="logout">Logout</span></li>
                <li class="ml-4 nav-item">Wail Bld</li>
            </ul>
            
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            <router-view ></router-view>
        </div>
    </main>
  </div>  
</template>




<script>
export default {
    data(){
        return {
            currentPath:'',
        
        }
    },
    methods:{
        logout(){
            axios.post('/logout').then(response =>{
                localStorage.removeItem('isLoggedIn');
                this.$router.push('/');
            });
        },
       
    },
    watch:{
        $route(to,from){
            console.log(this.$route.path);
            this.currentPath = this.$route.path;
        },
       
    },
    mounted(){
        this.currentPath = this.$route.path;
    }
}
</script>