<template>
    <div class=" login-form">
       

        <div class="form">
             <h1 class="center-text">{{ $route.name }} to your account</h1>
            <span class="error-text" v-if="errors.email">
                <span v-if="errors.email[0]==='Login Failed! Invalid Credentials!'"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                {{ errors.email[0] }}</span>
            </span>
            <br>
            <input type="email" v-model="form.email" placeholder="Email" name="email" class="input-field" :class="errors.email? 'border-red':''" >
            <span class="error-text" v-if="errors.email">
                <span v-if="errors.email[0] !='Login Failed! Invalid Credentials!'"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                {{ errors.email[0] }}</span>
            </span>

            <input type="password" v-model="form.password" placeholder="Password" name="password" class="input-field" :class="errors.email? 'border-red':''" >
            <span class="error-text" v-if="errors.password"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
            {{ errors.password[0] }}</span>


            <button type="submit" name="loginBtn" @click.prevent="login">Login</button>

        </div>
    </div>
</template>

<script>
    export default {
       data(){
           return{
               form:{
                   email: '',
                   password:'',
               },
               errors:[]
           }
       },
       methods:{
           login(){
           
           axios.get('/csrf-cookie').then(response => {
            // Login...
               //console.log("csrf-cokkie recieved!");
                 axios.post('/api/login',this.form).then((res) => { 
                  //  console.log("user login successfull! "+res.data)
                    this.$root.$emit("login",true);
                    localStorage.setItem("auth", "true");
                    this.$router.push({ name: "Home" });
                })
                .catch(error => {
                    if(error.response.status === 422){
                        //console.log("validation errors encountered!");
                        this.errors = error.response.data.errors;
                    }
                });
            });
           }
       }
    }
</script>

<style scoped>
    .login-form{
        z-index:999;
    }
</style>