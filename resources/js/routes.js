import Home from './components/HomeComponent.vue'
import Albums from './components/AlbumsComponent.vue'
import List from './components/ListComponent.vue'

export const routes = [
    {
        path:'/home',
        component:Home
    },
    {
        path:'/albums',
        component:Albums
    },
    { 
        path:'/list',
        component:List
    },
 
 
];