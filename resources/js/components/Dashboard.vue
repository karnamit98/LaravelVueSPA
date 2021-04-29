<style scoped>
    .header{display: flex;align-self: center;align-items: center;justify-content: center;flex-direction: column;}
    .header h1{font-weight: 800;font-size:2rem;color:#f6f6f6;filter: drop-shadow(0 2px 5px  #000); }
</style>

<template>
    <div class="main-body">
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <div class="header">
                <h1><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</h1>
                <!-- <span v-if="user">Hello There, {{ user.name }}!</span> -->
            </div>

            <div class="dashboard">
                <div class="box-columns">
                    <div class="box box-1">
                        <div v-if="userrole == 1">Total Products <br> <span class="count">{{ totalProducts }} </span> </div>
                        <div v-else>Total Users <br> <span class="count">{{ totalUsers }} </span></div>
                    </div>
                    <div class="box box-2">
                        <div v-if="userrole == 1">Total CDs <br><span class="count"> {{ totalCds }}  </span></div>
                    <div v-else>Total CDs <br><span class="count"> {{ totalCds }}  </span></div>
                    </div>
                </div>
                <div class="box-columns">
                    <div class="box box-3">
                        <div v-if="userrole == 1">Total Books <br> <span class="count">{{ totalBooks }}  </span> </div>
                        <div v-else>Total Products <br> <span class="count">{{ totalProducts }}   </span> </div>
                    </div>
                    <div class="box box-4" >
                        <div v-if="userrole == 1"> Total Sold <br> <span class="count"> 0 </span> </div>
                        <div v-if="userrole == 2">Total Books <br> <span class="count">{{ totalBooks }}   </span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: null,
            products:[],
            users:[],
            totalUsers:0,
            totalVendors:0,
            totalProducts:0,
            totalBooks:0,
            totalCds:0,
            userrole:1
        };
    },
    mounted() {
        this.userrole = localStorage.getItem("role");
        console.log("Dashboard userrole:"+this.userrole);
        axios.get("/api/user") .then(response => {
                this.user = response.data;
                // localStorage.setItem("role",response.data.role );
                if(this.userrole == 1)   //If logged in user is a vendor , calculate dashboard totals products for vendor else calculate all products
                {
                    console.log("Dashboard inside first if userrole:"+this.userrole);
                    axios.get(`/api/vendorproducts/${this.user.id}`).then(res => {           //Gets all products data in the database through eloquent
                        console.log("Vendor Products:"+res.data);
                        this.products = res.data;
                        this.totalProducts = this.products.length;
                        this.products.forEach(value => {
                            if(value.type=="book") this.totalBooks++;
                            else this.totalCds++;
                        });
                    })
                    .catch(error => {  console.log(error.response+" error caught while request products array!"); });
                }
                 else{
                      axios.get('/api/allproducts').then(response => {           //Gets all products data in the database through eloquent
                        console.log(response.data);
                        this.products = response.data;
                         this.totalProducts = this.products.length;
                           this.products.forEach(value => {
                            if(value.type=="book") this.totalBooks++;
                            else this.totalCds++;
                        });
                    })
                    .catch(error => {console.log(error.response+" error caught while request products array!");  });

                     axios.get('/api/allusers').then(res => {           //Gets all users data in the database through eloquent
                        console.log(res.data);
                        this.users = res.data;
                         this.totalUsers = this.users.length;
                    })
                    .catch(error => { console.log(error.response+" error caught while request user array!"); });
                 }
            })
            .catch(error => {  console.log(error.response+" error caught while request auth user !");   });
            
            
    },
    methods: {}
};
</script>
