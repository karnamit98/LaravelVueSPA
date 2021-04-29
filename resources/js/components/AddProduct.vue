<template>
    <div class="main-body">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            
            <div class="form" >
                <h2>Add new Product</h2>
                
                <!--------- TITLE -------->
                <input type="text " v-model="form.title" placeholder="Title" name="title" class="input-field" :class="errors.title? 'border-red':''" >
                <span class="error-text" v-if="errors.title"><i class="fas fa-exclamation-triangle"></i>
                {{ errors.title[0] }}</span>

                <!--------- TYPE -------->
                <select v-model="form.type" class="input-field" :class="errors.type? 'border-red':''">
                    <option disabled value=""  class="input-field">Select Type</option>
                    <option value="book"  class="input-field">BOOK</option>
                    <option value="cd"  class="input-field"> CD</option>
                </select>
                <span class="error-text" v-if="errors.type"><i class="fas fa-exclamation-triangle"></i>
                {{ errors.type[0] }}</span>
                
                 <!--------- FIRST NAME -------->
                <input type="text" v-model="form.firstname" placeholder="First Name" name="firstname" class="input-field"  :class="errors.firstname? 'border-red':''" >
                <span class="error-text" v-if="errors.firstname"><i class="fas fa-exclamation-triangle"></i>
                    {{ errors.firstname[0] }}</span>

                <!--------- MAIN NAME -------->
                <input type="text" v-model="form.mainname" placeholder="Main Name" name="mainname" class="input-field"  :class="errors.mainname? 'border-red':''" >
                <span class="error-text" v-if="errors.mainname"><i class="fas fa-exclamation-triangle"></i>
                    {{ errors.mainname[0] }}</span>

                 <!--------- PRICE -------->
                <input type="text"  v-model="form.price" placeholder="Price" name="price" class="input-field"  :class="errors.price? 'border-red':''">
                <span class="error-text" v-if="errors.price"><i class="fas fa-exclamation-triangle"></i>
                    {{ errors.price[0] }}</span>

                 <!--------- PAGES/PLAYLENGTH -------->
                <input type="text" v-model="form.pageslength" placeholder="Pages/Play Length" name="pageslength" class="input-field"  :class="errors.pageslength? 'border-red':''">
                <span class="error-text" v-if="errors.pageslength"><i class="fas fa-exclamation-triangle"></i>
                {{ errors.pageslength[0] }}</span>

                <button type="submit" name="addProductBtn" @click.prevent="addProduct">Add Product</button>

            </div>
    
        </div>  <!--Content Body-->
    </div>  <!--Main Body-->
</template>

<script>
    export default {
       data(){
           return{
               form:{
                   title:'',
                   type:'',
                   user_id:'',
                   firstname:'',
                   mainname:'',
                   price:'',
                   pageslength:''

               },
               errors:[],
               user:null
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
        },
       methods:{
           addProduct(){ 
               this.form.user_id = this.user.id
             axios.get('/csrf-cookie').then(response => 
             { axios.post('/api/product/store',this.form)
                .then((res) => { 
                    console.log(res.data+"product added!")
                    this.$router.push({ name: "ProductsTable" });
                })
                .catch(error => {
                    if(error.response.status === 422){this.errors = error.response.data.errors; }
                    else console.log("Error Caught: "+error.response.status);
                });
            });

           }
       }
    }
</script>
