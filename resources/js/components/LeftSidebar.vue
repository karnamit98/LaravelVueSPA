<template>
    <div class="left-sidebar">
         
        <div class="sidebar-links">
            <!--Display profile-->
             <router-link v-if="user" :to="{name: 'Profile'}"  class="link" >Profile &nbsp;&nbsp; <i class="fas fa-chevron-circle-right"></i></router-link>  

            <!-- dashboard for vendors and admins -->
          <router-link to="/dashboard" class="link" v-if="user && (user.role==1 || user.role==2)">Dashboard &nbsp;&nbsp; <i class="fas fa-chevron-circle-right"></i></router-link>  

            <!-- Manage Users and Vendors availble for admins -->
              <router-link to="/users"  class="link" v-if="user && user.role==2">Users  &nbsp;&nbsp; <i class="fas fa-chevron-circle-right"></i></router-link>  

            <!-- Manage Products availble for vendor and admins(admin can only view) -->
            <router-link to="/productslist"  class="link" v-if="user && (user.role==2 || user.role==1)">Products  &nbsp;&nbsp; <i class="fas fa-chevron-circle-right"></i></router-link>  

             <!-- Add new product for vendors only -->
              <router-link to="/product/create"  class="link" v-if="user && user.role==1">Add Product &nbsp;&nbsp; <i class="fas fa-chevron-circle-right"></i></router-link>  

        </div> 
        
        <div class="user-details" v-if="user">
            <hr style="border:1px solid #f4f4f2;min-width:100%">
            <!--User Role-->
            {{user.role | userRole}}
            <img :src="user.avatar" alt="" class="avatar-img">
            <div> {{ user.name }} </div>
            <div>  {{ user.email }} </div>
            <div> Member since {{ user.created_at | trimDate }} </div>
        </div>
        <div class="user-details" v-else>
             <hr style="border:1px solid #f4f4f2;min-width:100%">
             <div>Guest</div>
        </div>
        
    </div><!--Left Sidebar-->
</template>

<script>
console.log("Left sidebar");
//import functions from '../functions';
    export default {
         data(){
            return {
                user:null,
              //  role:"Guest"
            }
        },
        mounted(){
            axios.get('/api/user').then(response => {
                // localStorage.setItem("role",response.data.role );
                this.user = response.data;
            })
             .catch(error => {
                    if(error.response.status === 401){
                        console.log("401 (Unauthorized) error caught!");
                    }
                });
          //  this.user = functions.getAuthUser;
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
