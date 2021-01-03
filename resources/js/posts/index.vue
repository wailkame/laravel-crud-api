<template>
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
            <tr v-for="post in posts" :key="post.id">
                <td>{{post.title}}</td>
                <td>{{post.post_text}}</td>
                <td>{{post.created_at}}</td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</template>


<script>
export default {
    data(){
        return {
            posts: [],
        }
            
        
    },
    mounted(){
        axios.get('http://crudapp.test/api/posts')
        .then(response => this.posts = response.data.data);
    }
}
</script>

<style >

</style>