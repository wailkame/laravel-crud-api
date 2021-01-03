<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Post Text</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.data" :key="post.id">
                    <td>{{post.title}}</td>
                    <td>{{post.post_text}}</td>
                    <td>{{post.created_at}}</td>
                    <td></td>
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
        }
            
        
    },
    mounted(){
        this.getResults();
        // axios.get('http://crudapp.test/api/posts')
        // .then(response => this.posts = response.data.data);
    },
    methods: {
		// Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
			axios.get('http://crudapp.test/api/posts?page=' + page)
				.then(response => {
                    this.posts = response.data;
                    
				});
		}
	}
}
</script>

<style >

</style>