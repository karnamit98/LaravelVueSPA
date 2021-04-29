<template>
     
    <div class="main-body" v-if="user" >
        
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <!-- <span>Welcome To {{ $route.name }}, </span>
            <span v-if="user">{{ user.name }}</span> -->
            <!-- <span v-else>Guest</span> -->
             <products-component></products-component>
        </div>
    </div>

    <div class="main-body" v-else  >
        <div class="content-body">
            <!-- Welcome To {{ $route.name }}, Guest! -->
            <products-component></products-component>
        </div>
    </div> 
</template>

<script>
    export default {
        data(){
            return {
                user:null,
            }
        },
        mounted(){
            axios.get('/api/user').then(response => {
                this.user = response.data;
                localStorage.setItem("role",response.data.role );
            })
             .catch(error => { if(error.response.status === 401){ console.log("401 (Unauthorized) error caught!");} });
        },
    }
</script>
