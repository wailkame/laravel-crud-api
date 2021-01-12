<template>
    <div class="row justify-content-between pb-4">
        <select v-model="params.category_id"  class="form-control col-md-3 my-2">
            <option value="" >-- choose category --</option>
            <option  v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
        </select>
        <input type="text" class="form-control col-md-3" placeholder="Search(min 4 letter)" v-model="search">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <a href="#" @click.prevent="changeSort('title')">Title</a>
                        <span v-if="this.params.sort_field === 'title' && this.params.sort_direction === 'asc'">&uarr;</span>
                        <span v-if="this.params.sort_field === 'title' && this.params.sort_direction === 'desc'">&darr;</span>
                    </th>
                    <th>
                        <a href="#" @click.prevent="changeSort('post_text')">Post Text</a>
                        <span v-if="this.params.sort_field === 'post_text' && this.params.sort_direction === 'asc'">&uarr;</span>
                        <span v-if="this.params.sort_field === 'post_text' && this.params.sort_direction === 'desc'">&darr;</span>
                    </th>
                    <th>
                        <a href="#" @click.prevent="changeSort('created_at')">Created At</a>
                        <span v-if="this.params.sort_field === 'created_at' && this.params.sort_direction === 'asc'">&uarr;</span>
                        <span v-if="this.params.sort_field === 'created_at' && this.params.sort_direction === 'desc'">&darr;</span>
                    </th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <input type="text" class="form-control w-100" v-model="params.title">
                    </th>
                    <th>
                        <input type="text" class="form-control w-100" v-model="params.post_text">
                    </th>
                    <th>
                        <input type="text" class="form-control w-100" v-model="params.created_at">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.data" :key="post.id">
                    <td>{{post.title}}</td>
                    <td>{{post.post_text}}</td>
                    <td>{{post.created_at}}</td>
                    <td>
                        <router-link class="btn btn-info btn-sm" :to="{name:'posts.edit' , params: {id: post.id} }">Edit</router-link>
                        <button @click="delete_post(post.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>
    
</template>


<script>
export default {
    data(){
        return {
            posts: {},
            categories: [],
            params:{
                category_id: '',
                sort_field: 'created_at',
                sort_direction: 'desc',
                title: '',
                post_text: '',
                created_at: ''
            },
            search: ''
        } 
    },
    mounted(){

        axios.get('http://crudapp.test/api/categories')
        .then(response => this.categories = response.data.data);
        this.getResults();
        
    },
    watch:{
        params:{
            handler(){
                this.getResults();
            },
            deep: true
        },
        search(val, old){
            if(val.length >= 4 || old.length >= 4){
                this.getResults(); 
            }
        }
    },
    methods: {
        // Our method change data sorting
        changeSort(field){
            if(this.sort_field === field){
                this.sort_direction = this.sort_direction === 'asc' ? 'desc': 'asc';
            }else{
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
            this.getResults();
        },
		// Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
            axios.get('http://crudapp.test/api/posts?page=' , {
                params:{
                    page,
                    search:this.search.length >= 4 ? this.search: '',
                    ...this.params
                }
            })
            .then(response => {
                this.posts = response.data;
                
            });
        },
        delete_post(post_id){
            this.$swal({
                title:'Are you sure ?',
                text: "you won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtomColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if(result.isConfirmed){
                    axios.delete('http://crudapp.test/api/posts/'+post_id)
                    .then(response => {
                        this.$swal('Post Deleted Successfully');
                        this.getResults();
                    })
                    .catch(error => {
                        if(error.response.status === 422 || error.response.status === 404){
                            this.$swal({icon:'error', title:'Error Happened'});
                        }
                    });
                }
            });
        }
	}
}
</script>

<style >

</style>