
<style>
    .product-container{flex:1;height: 100% ;width:fit-content;}
    .product-content{display: flex;justify-content: center;align-items: center ;margin:auto;}
    .product-card{margin:auto;}
    .home-btn{margin-top:1rem;}
</style>


<template>
    
    <div class="main-body" v-if="user">
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body product-content">
            <div class="products-container product-container"> 
                <div v-if="product" class="card product-card">
                    <div class="card-body" v-if="product.type=='book'" >   
                        <h4>{{ product.title }} </h4>       
                        <span>Type: BOOK </span>
                        <span>Author: {{ product.firstname }} &nbsp; {{ product.mainname }}  </span>
                        <span>Price: ${{ product.price }} </span>
                        <span>Pages: {{ product.pageslength }}</span> 
                        <span >Vendor: {{ vendor}}</span> 
                        <router-link :to="{name: 'Home'}" class="view-btn home-btn"><i class="fas fa-home"></i> &nbsp;Back to Home</router-link>    
                    </div>  
                    <div class="card-body" v-else >   
                        <h4>{{ product.title }} </h4>       
                        <span>Type: CD </span>
                        <span>Composer: {{ product.firstname }} &nbsp; {{ product.mainname }}  </span>
                        <span>Price: ${{ product.price }} </span>
                        <span>Play Length: {{ product.pageslength }}</span> 
                        <span>Pages: {{ product.pageslength }}</span> 
                        <span>Vendor: {{ vendor}}</span> 
                        <router-link :to="{name: 'Home'}" class="view-btn home-btn"><i class="fas fa-home"></i> &nbsp; Back to Home</router-link>    
                    </div>  
                    
                    <!-- <a class="card-btn" href="products/{{$product->getId()}}/update">Select</a> -->
                </div>              
            </div>  <!--End of Products Container-->

        </div><!--End of Content Body--->
    </div>  <!--End of Main Body--->
            
</template>

<script>
export default {
    data() {
        return {
            user: null,
            product:[],
            vendor:''
        };
    },
    mounted() {
        this.userrole = localStorage.getItem("role");
        console.log("Dashboard userrole:"+this.userrole);
        axios.get("/api/user") .then(response => {
                this.user = response.data;
            })
        .catch(error => {  console.log(error.response+" error caught while request auth user !");   });
        
        axios.get(`/api/product/show/${this.$route.params.id}`).then(response => {           //Gets the requested product data in the database through eloquent
            console.log(response.data);
            this.product = response.data;
           axios.get(`/api/user/show/${this.product.user_id}`).then((response) => { this.vendor = response.data.name;
               }).catch(error => {console.log(error.response.status+" error caught while request specific user!"+$vid);});;
        })
        .catch(error => {console.log(error.response+" error caught while request products array!");  });
            
    },
    methods: {
        
    }
};
</script>
