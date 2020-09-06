import axios from 'axios';
import router from '../router';

let actions = {

    getOrder({commit}, {id}) {
        axios.get('/api/orders/show/' + id)
            .then(res => {
                commit('GET_ORDER', res.data.item)
            }).catch(err => {
            console.log(err)
        })
    },
    createOrder({commit}) {
        axios.get('/api/orders/create')
            .then(res => {
                commit('CREATE_ORDER', res.data.item)
                commit('GET_ORDER_STATUSES', res.data.order_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    editOrder({commit}, {id}) {
        axios.get('/api/orders/edit/' + id)
            .then(res => {
                commit('EDIT_ORDER', res.data.item)
                commit('GET_ORDER_STATUSES', res.data.order_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    storeOrder({commit}, {order}) {
        axios.post('/api/orders/store',order)
            .then(res => {
                if( !res.data.success ) {
                    commit('SET_ERRORS', res.data.errors);
                } else {
                    commit('SET_ERRORS', []);
                    commit('STORE_ORDER', res.data.item)
                    router.push('/orders');
                }

                //commit('GET_ORDER_STATUSES', res.data.order_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    updateOrder({commit}, {order}) {
        axios.post('/api/orders/update/' + order.id, order)
            .then(res => {
                if( res.data.success ) {
                    commit('EDIT_ORDER', res.data.item);
                    //commit('GET_ORDER_STATUSES', res.data.order_statuses);
                    commit('SET_MESSAGE', res.data.flash_message);
                }
            }).catch(err => {
            console.log(err)
        })
    },
    deleteOrder({commit}, {order,callback}) {
        axios.delete(`/api/orders/delete/${order.id}`)
            .then(res => {
                if (res.data.success) {
                    commit('DELETE_ORDER', order)
                    if( callback ) {
                        callback();
                    }
                }

            }).catch(err => {
            console.log(err)
        })
    },
    getOrders({commit}, {page}) {
        axios.get('/api/orders?page=' + page)
            .then(res => {
                console.log('orders');
                console.log(res.data);
                commit('GET_ORDERS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    //customers
    getCustomers({commit}, {page}) {
        axios.get('/api/customers?page=' + page)
            .then(res => {
                commit('GET_CUSTOMERS', res.data);
            }).catch(err => {
            console.log(err)
        })
    },
    getCustomer({commit}, {id}) {
        axios.get('/api/customers/show/' + id)
            .then(res => {
                commit('GET_CUSTOMER', res.data.item)
            }).catch(err => {
            console.log(err)
        })
    },
    createCustomer({commit}) {
        axios.get('/api/customers/create')
            .then(res => {
                console.log(res);
                commit('CREATE_CUSTOMER', res.data.item)
                //commit('GET_CUSTOMER_STATUSES', res.data.customer_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    editCustomer({commit}, {id}) {
        axios.get('/api/customers/edit/' + id)
            .then(res => {
                commit('EDIT_CUSTOMER', res.data.item)
                //commit('GET_CUSTOMER_STATUSES', res.data.customer_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    storeCustomer({commit}, {customer}) {
        axios.post('/api/customers/store',customer)
            .then(res => {
                if( !res.data.success ) {
                    console.log(res);
                    commit('SET_ERRORS', res.data.errors);
                } else {
                    commit('SET_ERRORS', []);
                    commit('STORE_CUSTOMER', res.data.item)
                    router.push('/customers');
                }

                //commit('GET_CUSTOMER_STATUSES', res.data.customer_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    updateCustomer({commit}, {customer}) {
        axios.post('/api/customers/update/' + customer.id, customer)
            .then(res => {
                console.log(res);
                if( res.data.success ) {
                    commit('EDIT_CUSTOMER', res.data.item);
                    //commit('GET_CUSTOMER_STATUSES', res.data.customer_statuses);
                    commit('SET_MESSAGE', res.data.flash_message);
                }
            }).catch(err => {
            console.log(err)
        })
    },
    deleteCustomer({commit}, {customer,callback}) {
        axios.delete(`/api/customers/delete/${customer.id}`)
            .then(res => {
                console.log(res);
                if (res.data.success) {
                    commit('DELETE_CUSTOMER', customer)
                    if( callback ) {
                        callback();
                    }
                }

            }).catch(err => {
            console.log(err)
        })
    },
};

export default actions;