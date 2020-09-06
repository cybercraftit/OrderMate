import Vue from 'vue';
import VueRouter from 'vue-router';
import OrderIndex from './components/orders/index.vue'
import OrderShow from './components/orders/show.vue'
import OrderEdit from './components/orders/edit.vue'
import OrderCreate from './components/orders/create.vue'

import CustomerIndex from './components/customers/index.vue'
import CustomerShow from './components/customers/show.vue'
import CustomerEdit from './components/customers/edit.vue'
import CustomerCreate from './components/customers/create.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/orders', redirect: '/orders/1' },
    { path: '/orders/(.*-)?:page(\\d+)', component: OrderIndex, name: 'OrderIndex' },
    { path: '/orders/show/:id', component: OrderShow,  name: 'OrderShow' },
    { path: '/orders/edit/:id', component: OrderEdit, name: 'OrderEdit' },
    { path: '/orders/create', component: OrderCreate, name: 'OrderCreate' },
    //customer
    { path: '/customers', redirect: '/customers/1' },
    { path: '/customers/(.*-)?:page(\\d+)', component: CustomerIndex, name: 'CustomerIndex' },
    { path: '/customers/show/:id', component: CustomerShow,  name: 'CustomerShow' },
    { path: '/customers/edit/:id', component: CustomerEdit, name: 'CustomerEdit' },
    { path: '/customers/create', component: CustomerCreate, name: 'CustomerCreate' },
];

const router = new VueRouter({routes});

export default router;