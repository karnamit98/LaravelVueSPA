<style scoped>
    .content-width{
        max-width:fit-content !important;
    }
</style>

<template>
    <div>
        <div class="tabs">
            <button @click.prevent="productTabClick" id="book_tab" class="tab-active"><i class="fas fa-book-open"></i> &nbsp; Books</button>
            <button @click.prevent="productTabClick" id="cd_tab"><i class="fas fa-compact-disc"></i> &nbsp; CDs</button>
        </div>
        <div class="products-container " id="books"> 
            <div v-for="book in books" :key="book.title" class="card">
                <div class="card-body"  >   
                     <!-- <h5 >BOOK</h5> -->
                     <h4>{{ book.title }} </h4>       
                    <span>Author: {{ book.firstname }} &nbsp; {{ book.mainname }}  </span>
                    <span>Price: ${{ book.price }} </span>
                    <span>Pages: {{ book.pageslength }}</span> 
                    <router-link :to="{name: 'ShowProduct', params: { id: book.id }}" class="view-btn"><i class="far fa-eye"></i> &nbsp; View</router-link>    
                </div>  
                
                <!-- <a class="card-btn" href="products/{{$product->getId()}}/update">Select</a> -->
            </div>              
        </div>  <!--End of Products Container-->

         <div class="products-container display-none" id="cds"> 
            <div v-for="cd in cds" :key="cd.title"  class="card">
                <div class="card-body" >       
                    <!-- <h5 >CD</h5> -->
                    <h4> {{ cd.title }} </h4>   
                    <span> Composer: {{ cd.firstname }} &nbsp; {{ cd.mainname }}  </span>
                    <span>Price: ${{ cd.price }} </span>
                    <span>Play Length: {{ cd.pageslength }}</span>
                    <router-link :to="{name: 'ShowProduct', params: { id: cd.id }}" class="view-btn"><i class="far fa-eye"></i> &nbsp; View</router-link>  
                </div>    
                
                <!-- <a class="card-btn" href="products/{{$product->getId()}}/update">Select</a> -->
            </div>              
        </div>  <!--End of Products Container-->
       
    </div>
            
</template>

<script>
export default {
    data() {
        return {
            user: null,
            products:[],
            books:[],
            cds:[],            
            userrole:1
        };
    },
    mounted() {
        this.userrole = localStorage.getItem("role");
        console.log("Dashboard userrole:"+this.userrole);
        axios.get("/api/user") .then(response => {
                this.user = response.data;
            })
        .catch(error => {  console.log(error.response+" error caught while request auth user !");   });
            

        axios.get('/api/allproducts').then(response => {           //Gets all products data in the database through eloquent
            console.log(response.data);
            this.products = response.data;
        })
        .catch(error => {console.log(error.response+" error caught while request products array!");  });

        axios.get('/api/specificproducts/book').then(response => {           //Gets all books products data in the database through eloquent
            console.log(response.data);
            this.books = response.data;
        })
        .catch(error => {console.log(error.response+" error caught while request products array!");  });

        axios.get('/api/specificproducts/cd').then(response => {           //Gets all cds products data in the database through eloquent
            console.log(response.data);
            this.cds = response.data;
        })
        .catch(error => {console.log(error.response+" error caught while request products array!");  });
            
    },
    methods: {
        productTabClick(){
            var bookTab = document.getElementById("book_tab");
            var cdTab = document.getElementById("cd_tab");
            
            var books = document.getElementById("books");
            var cds = document.getElementById("cds");

            books.classList.toggle("display-none");
            cds.classList.toggle("display-none");
            bookTab.classList.toggle("tab-active");
            cdTab.classList.toggle("tab-active");
        }
        
    }
};
</script>

<style>
    /* .home-body{
        width:100vh;
    }
    .products-container{
        width:100%; 
    }*/
</style>
