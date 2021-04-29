  
  <template>
<div>
    <div class="main-component">
        <section class="background-section"></section>
        <nav class="navbar">
            <div class="logo"> 
                
            </div>

            <div class="nav-links" > 
                <router-link to="/" exact class="link" >  Home</router-link>   

                <router-link to="/about"  class="link" >  About</router-link>  

                <router-link to="/login" v-if="!isLoggedIn"   class="link" > Login</router-link>   

                <router-link to="/register" v-if="!isLoggedIn"  class="link">Register</router-link>  


                <!-- <router-link to="/dashboard" v-if="isLoggedIn && (role==='admin' || role==='vendor')" class="link">Dashboard</router-link>    -->

                 <a href="#" @click.prevent="logout" v-if="isLoggedIn"  class="link" >Logout</a>   
            </div>
            
        </nav>
        
        <router-view>
        </router-view>

  </div>
  
    <footer-component></footer-component></div>
</template>

<script>
import LeftSidebar from './LeftSidebar.vue';

export default {
  components: { LeftSidebar },


        data(){
            return {
                isLoggedIn: false,
                user:null,
               // role:"Guest"
            }
        },

        mounted() {
              axios.get('/api/user').then(response => {
                this.user = response.data;
                //this.role = this.setRole(this.user.role);
            })
             .catch(error => {
                    if(error.response.status === 401){
                        //console.log("validation errors encountered!");
                        //this.errors = error.response.data.errors;
                        console.log("401 (Unauthorized) error caught!");
                    }
                });
           // this.isLoggedIn = !!localStorage.getItem("auth");
           this.$root.$on("login", () => {
               this.isLoggedIn = true;
           // this.role = this.setRole(this.user.role);
           })
           this.isLoggedIn = !!localStorage.getItem("auth");
        },
        methods:{
            logout() {
                console.log("Logout Method Reached!");
                axios.get('/csrf-cookie').then(response => {
                    axios.post('/api/logout',this.form).then(() => { 
                        localStorage.removeItem("auth");
                        this.isLoggedIn = false;
                      //  this.role = this.setRole(this.user.role);
                        //this.$router.push({ name: "Home" });
                        if (this.$route.path != '/') {
                            this.$router.push({ name: "Home" });
                        }
                        else  this.$router.push({ name: "Login" });
                    });
                });
           },
           setRole(urole){
               console.log("Role Setting..");
                if(urole==0) return "user";
                else if(urole.role==1) return "vendor";
                else if(urole==2) return "admin";
                else return "guest";
               console.log("Set Role = "+urole);
           }
 
        }

    }
</script>