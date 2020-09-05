import Vue from 'vue';
import VueRouter from 'vue-router';
import OrderIndex from './components/orders/index.vue'
import OrderShow from './components/orders/show.vue'
import OrderEdit from './components/orders/edit.vue'
import OrderCreate from './components/orders/create.vue'
Vue.use(VueRouter)

const routes = [
    { path: '/orders', redirect: '/orders/1' },
    { path: '/orders/(.*-)?:page(\\d+)', component: OrderIndex, name: 'OrderIndex' },
    { path: '/orders/show/:id', component: OrderShow,  name: 'OrderShow' },
    { path: '/orders/edit/:id', component: OrderEdit, name: 'OrderEdit' },
    { path: '/orders/create', component: OrderCreate, name: 'OrderCreate' },
];

const router = new VueRouter({routes});

export default router;