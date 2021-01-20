<template>
    <form @submit.prevent="login">
        <div class="alert alert-danger" role="alert" v-if="errorMessage">
            {{errorMessage}}
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" v-model="loginData.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" v-model="loginData.password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button  type="submit" class="btn btn-primary" :disabled="submitted">Submit</button>
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
            submitted: false,
            errorMessage:'',
        }
    },
    methods:{
        login(){
            this.submitted = true;
            axios.get('/sanctum/csrf-cookie').then(response => {
                
                console.log(response);
                //Cookies.set("X-XSRF-TOKEN", Cookies.get("XSRF-TOKEN"))
                axios.post('/login', this.loginData)
                .then(response2 => {
                    this.isLogin = true;
                    this.submitted = false;
                    console.log(response2);
                    localStorage.setItem('isLoggedIn', 'true');
                    this.$router.push('/index');

                }).catch(error => { 
                    console.log(error);
                    this.submitted = false;
                    const key = Object.keys(error.response.data.errors)[0];
                    this.errorMessage = error.response.data.errors[key][0];
                    
                });
            });
        }
    },
    
}
</script>