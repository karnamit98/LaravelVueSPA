import Home from './components/Home';
import About from './components/About';
import NotFound from './components/NotFound';
 import Dashboard from './components/Dashboard';
 import Register from './components/Register';
 import Login from './components/Login';
 import Users from './components/Users';
 import EditUser from './components/EditUser';
 import ProductsTable from './components/ProductsTable';
 import EditProduct from './components/EditProduct';
 import AddProduct from './components/AddProduct';
 import ShowProduct from './components/ShowProduct';
 import Profile from './components/Profile';


import VueRouter from 'vue-router';

//export default{
var router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active-link',
    routes: [
     
        {
            path: '/',
            component:Home,
            name: 'Home'
        },
        {
            path:'/about',
            component: About,
            name: 'About'
        },
        {
            path:'/login',
            component: Login,
            name: 'Login',
            meta: { guestOnly: true }
        },
        {
            path:'/register',
            component: Register,
            name: 'Register',
            meta: { guestOnly: true }
        },
        {
            path:'/dashboard',
            component: Dashboard,
            name: 'Dashboard',
            meta: { adminOrVendor: true }
        },
        {
          path:'/users',
          component: Users,
          name: 'Users',
          meta: { adminOnly: true }
        },
        {
          path:'/user/edit/:id',
          component: EditUser,
          name: 'EditUser',
          meta: { adminOnly: true }
        },
        {
          path:'/productslist',
          component: ProductsTable,
          name: 'ProductsTable',
          meta: { adminOrVendor: true }
        },
        {
          path:'/product/edit/:id',
          component: EditProduct,
          name: 'EditProduct',
          meta: { vendorOnly: true }
        },
        {
          path:'/product/create',
          component: AddProduct,
          name: 'AddProduct',
          meta: { vendorOnly: true }
        },{
          path:'/product/show/:id',
          component: ShowProduct,
          name: 'ShowProduct'
      },{
        path:'/user/profile',
        component: Profile,
        name: 'Profile',
        meta: { requiresAuth:true }
      },
      {
        path: '*',
        component:NotFound,
        name: 'NotFound'
      },
    ]
});



router.beforeEach((to, from, next) => {
    console.log("IsLogedIn method called!");
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!isLoggedIn()) {
        next({
          path: "/login",
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } 
    else if (to.matched.some(record => record.meta.guestOnly)) {
        // this route requires auth, check if logged in
        // if yes, redirect to home page.
        if (isLoggedIn()) {
            next({
              path: "/",
              query: { redirect: to.fullPath }
            })
        } else {
          next()
        }
      }
      else if (to.matched.some(record => record.meta.adminOrVendor)) {
        // checks if the user is admin or vendor
        if (!isLoggedIn()) {
          next({
            path: "/login",
            query: { redirect: to.fullPath }
          })
        }else if(!(isAdmin() || isVendor())) {
            next({
              path: "/",
              query: { redirect: to.fullPath }
            })
          } else {
            next()
          }
       
      }
      else if (to.matched.some(record => record.meta.adminOnly)) {
        // checks if the request is from an  admin
        if (!isLoggedIn()) {
          next({
            path: "/login",
            query: { redirect: to.fullPath }
          })
        }else if(!isAdmin()){
          next({
            path: "/",
            query: { redirect: to.fullPath }
          })
        } else {
          next ()
        }
        
      }
      else if (to.matched.some(record => record.meta.vendorOnly)) {
        // checks if the request is from an  admin
        if (!isLoggedIn()) {
          next({
            path: "/login",
            query: { redirect: to.fullPath }
          })
        }else if(!isVendor()){
          next({
            path: "/",
            query: { redirect: to.fullPath }
          })
        } else {
          next ()
        }
        
      }
    else {
      next() // make sure to always call next()!
    }
  }) ;



 function isLoggedIn(){
    console.log("IsLogedIn method called!");
    return localStorage.getItem("auth");
}

function isAdmin(){                               //If the user role recieved from the response data of sanctum authorization is 2, it means it is an admin
  console.log("IsAdmin method called!");
  let r = localStorage.getItem("role");
  if(r==2) return true; else return false;
}

function isVendor(){
  console.log("IsVendor method called!");
  let r = localStorage.getItem("role");
  if(r==1) return true; else return false;
}


 
export default router;



















  // function getAuthorizationLevel(){
  //   axios.get('/api/user').then(response => {
  //     console.log("GetAuthorizationLevel Role Returned: "+response.data.role);
  //     return response.data.role.toString();
  //     //this.role = this.setRole(this.user.role);
  
  //   })
  //   .catch(error => {
  //         console.log("GetAuthorizationLevel Exception Thrown :"+error.response.status);
  //         return "1000";
  //     });
  // }
  