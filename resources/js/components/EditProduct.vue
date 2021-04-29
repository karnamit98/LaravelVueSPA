<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>
<!-- {{user.name}} -->
        <div class="content-body">
            <div v-if="editproduct" class="form">
                <h3>Edit {{editproduct.title}}'s (product) Record </h3>
                
                <div class="form-group">
                <label for="title"> Title: </label>
                <input type="text " v-model="form.title" name="title" class="input-field" :class="errors.title? 'border-red':''" >
                <span class="error-text" v-if="errors.name"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                {{ errors.title[0] }}</span>
                </div>

                <div class="form-group">
                <label for="firstname"> First Name: </label>
                <input type="text" v-model="form.firstname" placeholder="First Name"  name="firstname" class="input-field"  :class="errors.firstname? 'border-red':''" >
                <span class="error-text" v-if="errors.firstname"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                    {{ errors.firstname[0] }}</span>
                </div>

                 <div class="form-group">
                <label for="mainname"> Main Name: </label>
                <input type="text" v-model="form.mainname" placeholder="Main Name"  name="firstname" class="input-field"  :class="errors.mainname? 'border-red':''" >
                <span class="error-text" v-if="errors.mainname"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                    {{ errors.mainname[0] }}</span>
                </div>

                  <div class="form-group">
                <label for="price">Price: </label>
                <input type="text" v-model="form.price" placeholder="Price"  name="price" class="input-field"  :class="errors.price? 'border-red':''" >
                <span class="error-text" v-if="errors.price"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                    {{ errors.price[0] }}</span>
                </div>

                  <div class="form-group">
                <label for="pageslength"> <span v-if="form.type=='book'">Pages:</span><span v-else>Play Length:</span> </label>
                <input type="text" v-model="form.pageslength" placeholder="Main Name"  name="pageslength" class="input-field"  :class="errors.pageslength? 'border-red':''" >
                <span class="error-text" v-if="errors.pageslength"><img :src="'./images/warning.png'" style="width:1rem;height:1rem" alt="warning logo"/>
                    {{ errors.pageslength[0] }}</span>
                </div>

                <!-- <select v-model="form.role" class="input-field">
                    <option disabled value=""  class="input-field">{{ edituser.role | userRole }}</option>
                    <option value="0"  class="input-field">User</option>
                    <option value="1"  class="input-field"> Vendor</option>
                    <option value="2"  class="input-field">Admin</option>
                </select> -->

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
                editproduct:[],
            }
        },
         created(){
                     let pid = this.$route.params.id;       //get the product id
                    axios.get(`/api/product/edit/${pid}`).then((response) => {
                        this.editproduct = response.data;
                        this.form = response.data;
                        console.log("Returned Product - ID:"+pid+" ---> "+response.data);
                    }).catch(error => {console.log(error.response.status+" error caught while request specific user!");});;
                },
        mounted(){
            axios.get('/api/user').then(response => {               //Gets Authenticated User
                this.user = response.data;
            })
            .catch(error => {if(error.response.status === 401){ console.log("401 (Unauthorized) error caught!"); } });

          //  axios.get('/api/allusers').then(response => {           //Gets all users data in the database through eloquent
               // console.log(response.data);
            //    this.users = response.data;
            //}).catch(error => {console.log(error.response.status+" error caught while request product array!");});

        },
       methods: {
           update(){
                axios.get('/csrf-cookie').then(response => {
                    console.log("Update Method Called: ID:"+this.form.id);
                    axios.put(`/api/product/update/${this.form.id}`,this.form)
                    .then((res) => { 
                        console.log("Update Product Response Data: "+res.data)
                        this.$router.push({ name: "ProductsTable" });
                    })
                    .catch(error => {
                        if(error.response.status === 422){
                            //console.log("validation errors encountered!");
                            this.errors = error.response.data.errors;
                        }
                        else{ console.log("Exception caught while updating product data!" + error.response); }
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
