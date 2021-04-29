<template>
    <div class=" register-form">
        

        <div class="form" >
            <h1 class="center-text">{{ $route.name }} a new user</h1>
            
            <input type="text " v-model="form.name" placeholder="Name" name="name" class="input-field" :class="errors.name? 'border-red':''" >
            <span class="error-text" v-if="errors.name"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
            {{ errors.name[0] }}</span>

            
            <input type="email" v-model="form.email" placeholder="Email" name="email" class="input-field"  :class="errors.email? 'border-red':''" >
            <span class="error-text" v-if="errors.email"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                {{ errors.email[0] }}</span>

            
            <input type="password" v-model="form.password" placeholder="Password" name="password" class="input-field"  :class="errors.password? 'border-red':''">
            <span class="error-text" v-if="errors.password"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                {{ errors.password[0] }}</span>

            
            <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" name="password_confirmation" class="input-field"  :class="errors.password_confirmation? 'border-red':''">
            <span class="error-text" v-if="errors.password_confirmation"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
            {{ errors.password_confirmation[0] }}</span>

            <button type="submit" name="registerBtn" @click.prevent="register">Register</button>

        </div>
    </div>
</template>

<script>
    export default {
       data(){
           return{
               form:{
                   name: '',
                   email: '',
                   password:'',
                   password_confirmation:''
               },
               errors:[]
           }
       },
       methods:{
           register(){ 
            //    axios.post('/api/register', this.form).then(() => {
            //        alert('New User Registered!');
            //    }).catch((error) => {
            //        console.log(error);
            //        this.errors = error.response.data.errors;
            //    })
            // axios.post('/api/register',this.form)
            // .then((res) => console.log(res.data+"saved"))
            // .catch((err) => console.log(err));

             axios.get('/csrf-cookie').then(response => {
                    //console.log("csrf-cokkie recieved!");
                 axios.post('/api/register',this.form)
                .then(() => { 
                    //console.log(res.data+"user registered!")
                    this.$router.push({ name: "Login" });
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
