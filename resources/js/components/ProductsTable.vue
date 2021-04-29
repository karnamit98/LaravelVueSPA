<style scoped>
    .header{display: flex;align-self: center;align-items: center;justify-content: center;flex-direction: column;}
    .header h1{font-weight: 800;font-size:2rem;color:#f6f6f6;filter: drop-shadow(0 2px 5px  #000);margin-bottom:1.3rem; }
</style>
<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <div class="header">
            <h1>Products Record</h1>
            </div>
          

            <!--Products Table-- table table-striped  table-hover-->
           <table class="products-table" v-if="user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Pages/Play Length</th>
                        <th>Date Created</th>
                        <th v-if="user.role==1">Manage</th>
                        <th v-else>Vendor ID</th>
                    </tr>
                </thead>      
                <tbody>
                    <tr v-for="productdata in products" :key="productdata.name">
                        <td>{{productdata.id}}</td>

                        <td> {{ productdata.title }} </td>
                        <td> {{ productdata.type  }}</td>
                        <td> {{ productdata.firstname }} {{ productdata.mainname  }}</td>
                        <td> {{ productdata.price }} </td>
                        <td> {{ productdata.pageslength  }} </td>
                        <td>{{ productdata.created_at | trimDate}}</td>
                        <td class="table-btn-row"  v-if="user.role==1">
                            <router-link :to="{name: 'EditProduct', params: { id: productdata.id }}" class="table-btn edit-btn">Edit</router-link>    
                            <a href="#" @click.prevent="deleteProduct(productdata.id)"  class="table-btn delete-btn" >Delete</a>   
                        </td> 
                        <td v-else>{{ productdata.user_id }}</td>
                    </tr>
                </tbody>
            </table>
             <!--Products Table-->



        </div>  <!--Content Body-->
    </div>  <!--Main Body-->
</template>

<script>

    export default {
        data(){
            return {
                user:null,
                products:[],
            }
        },
        mounted(){
            axios.get('/api/user').then(response => {               //Gets Authenticated User
                this.user = response.data;
                 let uid =  response.data.id; 
                 if(this.user.role==1) { //Gets all products data in the database through eloquent
                    axios.get(`/api/vendorproducts/${uid}`).then(res => { this.products = res.data; })
                    .catch(error => {  console.log(error.response+" error caught while request products array!"); });
                 } else {
                      axios.get(`/api/allproducts`).then(res => { this.products = res.data; })
                    .catch(error => {  console.log(error.response+" error caught while request products array!"); });
                 }
             })
            .catch(error => {  console.log(error.response+" error caught while getting auth user!"); });
           
        },
       methods: {
           deleteProduct(id){
               axios.get('/csrf-cookie').then(response => {
                    console.log("Delete Method Called: ID:"+id);
                    axios.delete(`/api/product/delete/${id}`)
                    .then((res) => { 
                        this.$router.push({ name: "Dashboard" });
                    })
                     .catch(error => {  console.log(error.response+" error caught while deleting product data!"); });
                });
           }
       },
        filters:{
            trimDate: function (value){
                 if(value==null) return "-";
                value = value.toString()
                return value.split("T")[0];
            },
            userRole: function (value){
                if(value===0) return "User";
                else if(value===1) return "Vendor";
                else if(value===2) return "Admin";
                else return "Guest";
            },
            emptyField: function (value){
                if(value==null) return "-";
            }
        }
    }
</script>
