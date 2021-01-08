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
            <input type="file" @change="select_file">
            <br><br>
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
                thumbnail: null,
            },
            errors: {},
            form_submitted:false

        }
    },
    mounted(){
        axios.get('http://crudapp.test/api/categories')
        .then(response => this.categories = response.data.data);

    },
    methods:{
        select_file(event){
            this.field.thumbnail = event.target.files[0];
            console.log(event.target.files);
        },
        submit_form(){
            this.form_submitted = true;
            
            let field = new FormData();
            for(let key in this.field){
                field.append(key, this.field[key]);
            }
            
            axios.post('http://crudapp.test/api/posts', field)
            .then(response => {
                this.$router.push('/');
                this.form_submitted = false;
            })
            .catch(error => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                    this.form_submitted = false;
                }
            });
        }
    }
}
</script>

<style >

</style>