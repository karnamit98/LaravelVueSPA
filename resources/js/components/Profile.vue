<style scoped>

</style>

<style>
.profile-body{display: flex;justify-content: center;align-items: center ;margin:auto;}
.display-none{position: absolute; visibility:hidden;  display:none;}

</style>
<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body profile-body">
            <div class="user-profile">
                <div class="card" v-if="user" id="pView">
                    <!-- show user profile data -->
                    <img class="card-img-top" :src="user.avatar" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{user.name}}</h5>
                        <p class="card-text">Email: {{user.email}}</p>
                        <p class="card-text">Authorization: {{user.role | userRole}}</p>
                        <p class="card-text">Email Verified At: {{user.email_verified_at | trimDate}}</p>
                        <p class="card-text">Member Since: {{user.created_at | trimDate}}</p>
                         <button  class="view-btn pbtn"  @click.prevent="profileBtnClick"><i class="fas fa-user-edit"></i> &nbsp; Edit Profile</button>
                    </div>
                </div>
                <div v-if="edituser" class="form display-none profile-edit-form" id="pEdit">
                    <h3>Edit Profile </h3>

                    <input type="text " v-model="form.name" name="name" class="input-field" :class="errors.name? 'border-red':''" >
                    <span class="error-text" v-if="errors.name"><i class="fas fa-exclamation-triangle"></i>
                    {{ errors.name[0] }}</span>

                    
                    <input type="email" v-model="form.email" placeholder="Email"  name="email" class="input-field"  :class="errors.email? 'border-red':''" >
                    <span class="error-text" v-if="errors.email"><i class="fas fa-exclamation-triangle"></i>
                        {{ errors.email[0] }}</span>

                    <select disabled v-model="form.role" class="input-field">
                        <option disabled value=""  class="input-field">{{ edituser.role | userRole }}</option>
                        <option value="0"  class="input-field">User</option>
                        <option value="1"  class="input-field"> Vendor</option>
                        <option value="2"  class="input-field">Admin</option>
                    </select>

                    <!-- <input type="email" v-model="form.email" :placeholder="Email" name="email" class="input-field"  :class="errors.email? 'border-red':''" >
                    <span class="error-text" v-if="errors.email"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                        {{ errors.email[0] }}</span> -->
                
                    <div class="btns">
                        <button type="submit" name="updateBtn" @click.prevent="update"><i class="fas fa-edit"></i> &nbsp;Update</button>
                        <button  type="submit" @click.prevent="profileBtnClick" id="back-btn"><i class="fas fa-arrow-left"></i> &nbsp; Back</button>
                    </div>

                </div>
            </div><!--End ofUser Profile-->

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
                     
                },
        mounted(){
            axios.get('/api/user').then(response => {               //Gets Authenticated User
                this.user = response.data;
                let uid = this.user.id;
                    axios.get(`/api/user/edit/${uid}`).then((response) => {
                        this.edituser = response.data;
                        this.form = response.data;
                        console.log("Returned User - ID:"+uid+" *** "+response.data);
                    }).catch(error => {console.log(error.response.status+" error caught while request specific user!");});;
            })
            .catch(error => {if(error.response.status === 401){ console.log("401 (Unauthorized) error caught!"); } });



        },
       methods: {
           update(){
                axios.get('/csrf-cookie').then(response => {
                    console.log("Update Method Called: ID:"+this.form.id);
                    axios.put(`/api/user/update/${this.form.id}`,this.form)
                    .then((res) => { 
                        console.log("Update Response Data: "+res.data)
                        this.$router.push({ name: "Home" });
                    })
                    .catch(error => {
                        if(error.response.status === 422){
                            //console.log("validation errors encountered!");
                            this.errors = error.response.data.errors;
                        }
                        else{ console.log("Exception caught while updating user data!" + error.response); }
                    });
                });
           },
            profileBtnClick(){
            
            var pView = document.getElementById("pView");
            var pEdit = document.getElementById("pEdit");

            pView.classList.toggle("display-none");
            pEdit.classList.toggle("display-none");
        },
       },
        filters:{
            trimDate: function (value){
                 if (!value) return 'Not Verified';
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
