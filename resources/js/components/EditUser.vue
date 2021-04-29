<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <div v-if="edituser" class="form">
                <h3>Edit <span v-if="user">{{user.name}}</span><span v-else>{{edituser.name}}</span>'s Record </h3>

                 <input type="text " v-model="form.name" name="name" class="input-field" :class="errors.name? 'border-red':''" >
                <span class="error-text" v-if="errors.name"><i class="fas fa-exclamation-triangle"></i>
                {{ errors.name[0] }}</span>

                
                <input type="email" v-model="form.email" placeholder="Email"  name="email" class="input-field"  :class="errors.email? 'border-red':''" >
                <span class="error-text" v-if="errors.email"><i class="fas fa-exclamation-triangle"></i>
                    {{ errors.email[0] }}</span>

                <select v-model="form.role" class="input-field">
                    <option disabled value=""  class="input-field">{{ edituser.role | userRole }}</option>
                    <option value="0"  class="input-field">User</option>
                    <option value="1"  class="input-field"> Vendor</option>
                    <option value="2"  class="input-field">Admin</option>
                </select>

                <!-- <input type="email" v-model="form.email" :placeholder="Email" name="email" class="input-field"  :class="errors.email? 'border-red':''" >
                <span class="error-text" v-if="errors.email"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                    {{ errors.email[0] }}</span> -->
               

                <button type="submit" name="updateBtn" @click.prevent="update"><i class="fas fa-edit"></i> &nbsp;Update</button>

            </div>
            

        </div>  <!--Content Body-->
    </div>  <!--Main Body-->
</template>

<script>


//import AdminDashboard from './AdminDashboard.vue';
console.log();
    export default {
  //components: { AdminDashboard },
        data(){
            return {
                form:{},
               errors:[],
                user:null,
                edituser:[],
            }
        },
         created(){
                     let uid = this.$route.params.id;
                    axios.get(`/api/user/edit/${uid}`).then((response) => {
                        this.edituser = response.data;
                        this.form = response.data;
                        console.log("Returned User - ID:"+uid+" *** "+response.data);
                    }).catch(error => {console.log(error.response.status+" error caught while request specific user!");});;
                },
        mounted(){
            axios.get('/api/user').then(response => {               //Gets Authenticated User
                this.user = response.data;
            })
            .catch(error => {if(error.response.status === 401){ console.log("401 (Unauthorized) error caught!"); } });

            // axios.get('/api/allusers').then(response => {           //Gets all users data in the database through eloquent
            //    // console.log(response.data);
            //     this.users = response.data;
            // }).catch(error => {console.log(error.response.status+" error caught while request user array!");});

        },
       methods: {
           update(){
                axios.get('/csrf-cookie').then(response => {
                    console.log("Update Method Called: ID:"+this.form.id);
                    axios.put(`/api/user/update/${this.form.id}`,this.form)
                    .then((res) => { 
                        console.log("Update Response Data: "+res.data)
                        this.$router.push({ name: "Users" });
                    })
                    .catch(error => {
                        if(error.response.status === 422){
                            //console.log("validation errors encountered!");
                            this.errors = error.response.data.errors;
                        }
                        else{ console.log("Exception caught while updating user data!" + error.response); }
                    });
                });
           }
       },
        filters:{
            trimDate: function (value){
                 if (!value) return '';
                value = value.toString()
                return value.split("T")[0];
            },
            userRole: function (value){
                
                if(value===0) return "User";
                else if(value===1) return "Vendor";
                else if(value===2) return "Admin";
                else return "Guest";
            }
        }
    }
</script>
