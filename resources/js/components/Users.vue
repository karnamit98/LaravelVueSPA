<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <h2>Users Record</h2>
            
            <!-- <ol>
            <li v-for="userdata in users" :key="userdata.name">
               {{userdata.name}}
               {{userdata.email}}
               {{ userdata.role | userRole}}
            </li>
            </ol> -->

            <!--Users Table-->
            <table class="table table-striped  table-hover " id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>

                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Manage</th>
                    </tr>
                </thead>      
                <tbody>
                    <tr v-for="userdata in users" :key="userdata.name">
                        <td>{{userdata.id}}</td>

                        <td> {{userdata.name}}</td>
                        <td><img :src="userdata.avatar" class="avatar-img"/></td>
                        <td>{{userdata.email}}</td>
                        <td v-bind:class="{'user':(userdata.role === 0), 'vendor':(userdata.role === 1), 'admin':(userdata.role === 2)}"
                        > {{ userdata.role | userRole}}</td>
                        <td>{{ userdata.created_at | trimDate}}</td>
                        <td class="table-btn-row">
                             <router-link :to="{name: 'EditUser', params: { id: userdata.id }}" class="table-btn edit-btn">Edit</router-link>
                            <!-- <a href="#" @click.prevent="editUser" class="table-btn edit-btn" >Edit</a>    -->
                            <a href="#" @click.prevent="deleteUser(userdata.id)"  class="table-btn delete-btn" >Delete</a>   
                        </td>
                     </tr>
                </tbody>
            </table>
             <!--Users Table-->



        </div>  <!--Content Body-->
    </div>  <!--Main Body-->
</template>

<script>


//import AdminDashboard from './AdminDashboard.vue';
    export default {
  //components: { AdminDashboard },
        data(){
            return {
                user:null,
                users:[],
            }
        },
        mounted(){
            axios.get('/api/user').then(response => {               //Gets Authenticated User
                this.user = response.data;
            })
            .catch(error => {
                if(error.response.status === 401){
                    console.log("401 (Unauthorized) error caught!");
                }
            });
            axios.get('/api/allusers').then(response => {           //Gets all users data in the database through eloquent
                console.log(response.data);
                this.users = response.data;
            })
            .catch(error => {
                        console.log(error.response.status+" error caught while request user array!");
                    
            });
        },
       methods: {
           deleteUser(id){
               axios.get('/csrf-cookie').then(response => {
                    console.log("Delete Method Called: ID:"+id);
                    axios.delete(`/api/user/delete/${id}`)
                    .then((res) => { 
                        console.log("Delete Response Data: "+res.data)
                        this.$router.push({ name: "Dashboard" });
                    })
                    .catch(error => {
                        if(error.response.status === 422){
                            //console.log("validation errors encountered!");
                            this.errors = error.response.data.errors;
                        }
                        else{ console.log("Exception caught while deleting user data!" + error.response); }
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
