<template>
    <form @submit.prevent="login">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" v-model="loginData.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
           
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" v-model="loginData.password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button  type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>

export default {
    
    data(){
        return {
            loginData:{
                email:'',
                password:''
            },
            isLogin: false,
        }
    },
    methods:{
        login(){
            
            axios.get('/sanctum/csrf-cookie').then(response => {
                
                console.log(response);
                //Cookies.set("X-XSRF-TOKEN", Cookies.get("XSRF-TOKEN"))
                axios.post('/login', this.loginData)
                .then(response2 => {
                    this.isLogin = true;
                    console.log(response2);
                }).catch(error => console.log(error));
            });
        }
    }
}
</script>