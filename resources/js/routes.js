import Home from './components/HomeComponent.vue'
import Login from './components/LoginComponent.vue'
import List from './components/ListComponent.vue'

export const routes = [
    {
        path:'/',
        redirect: '/home'
    },
    {
        path:'/home',
        component:Home
    },
    {
        path:'/login',
        component:Login
    },
    { 
        path:'/list',
        component:List
    },
 
 
];