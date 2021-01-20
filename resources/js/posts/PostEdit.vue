<template>
    <div>
       <form @submit.prevent="submit_form">
           Post Title:
           <br >
           <input type="text" class="form-control" v-model="field.title">
           <div class="alert alert-danger" v-if="errors.title">{{errors.title[0]}}</div>
           <br>
           Post Text:
           <br>
           <textarea class="form-control" rows="10" v-model="field.post_text"></textarea>
           <div class="alert alert-danger" v-if="errors.post_text">{{errors.post_text[0]}}</div>
           <br>
            Category:
            <select class="form-control" v-model="field.category_id">
                <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
            </select>
            <div class="alert alert-danger" v-if="errors.category_id">{{errors.category_id[0]}}</div>
            <br>            
            <input type="submit" class="btn btn-primary" :value="form_submitted ? 'Saving post...': 'Save post'" :disabled="form_submitted"> 
            <br>
            
       </form>
    </div>
    
</template>


<script>
export default {
    data(){
        return {
            categories: {},
            field:{
                title: '',
                post_text: '',
                category_id: '',
                user_id:'',
                
            },
            errors: {},
            form_submitted:false

        }
    },
    mounted(){
        // get all user Data
        axios.get('/api/user').then(response =>{
            this.field.user_id = response.data.id;
        });
        // get all categories 
        axios.get('/api/categories')
        .then(response => this.categories = response.data.data);

        // get the actual post
        axios.get('/api/posts/'+ this.$route.params.id)
        .then(response => this.field = response.data.data);
        

    },
    methods:{
        submit_form(){
            this.form_submitted = true;
            
            axios.put('/api/posts/'+this.$route.params.id, this.field)
            .then(response => {
                this.$swal('Post Updated Successfully');
                this.$router.push('/index');
                this.form_submitted = false;
            })
            .catch(error => {
                if(error.response.status === 422 || error.response.status === 500){
                    this.$swal({icon:'error', title:'Error Happened'});
                    this.errors = error.response.data.errors;
                }
                this.form_submitted = false;
            });
        }
    }
}
</script>

<style >

</style>