
import axios from "axios";
export default{
    methods:{
        getAuthUser(){
            axios.get('/api/user').then(response => {
                return response.data;
            })
             .catch(error => {
                    if(error.response.status === 401){
                        console.log("401 (Unauthorized) error caught!");
                    }
                    return null;
                });
            }
    }
}

