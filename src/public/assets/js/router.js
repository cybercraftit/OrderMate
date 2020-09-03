import Vue from 'vue';
import VueRouter from 'vue-router';
import OrderIndex from './components/orders/index.vue'
import OrderShow from './components/orders/show.vue'
import OrderEdit from './components/orders/edit.vue'
Vue.use(VueRouter)

const routes = [
    { path: '/orders', component: OrderIndex },
    { path: '/orders/show/:id', component: OrderShow },
    { path: '/orders/edit/:id', component: OrderEdit },
];

const router = new VueRouter({routes});

export default router;