<template>
    <div>
       <form >
           Post Title:
           <br >
           <input type="text" class="form-control">
           <br>
           Post Text:
           <br>
           <textarea class="form-control" rows="10"></textarea>
           <br>
            Category:
            <select class="form-control">
                <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" value="Save post"> 
       </form>
    </div>
    
</template>


<script>
export default {
    data(){
        return {
            categories: [],

        }
    },
    mounted:{
        axios.get('http://crudapp.test/api/categories')
            
    }
}
</script>

<style >

</style>