import Home from './components/HomeComponent.vue'
import Login from './components/LoginComponent.vue'
import Register from './components/RegisterComponent.vue'
import List from './components/ListComponent.vue'

export const routes = [
    {
        path:'/',
        redirect: '/home'
    },
    {
        path:'/home',
        name:'home',
        component:Home
    },
    {
        path:'/login',
        name:'login',
        component:Login
    },
    {
        path:'/register',
        name:'home',
        component:Register
    },
    { 
        path:'/list',
        component:List
    },
 
 
];