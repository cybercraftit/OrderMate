import axios from 'axios';
import router from '../router';

let actions = {
    getOrders({commit}, {page}) {
        axios.get('/orders?page=' + page)
            .then(res => {
                commit('GET_ORDERS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    getOrder({commit}, {id}) {
        axios.get('/orders/show/' + id)
            .then(res => {
                commit('GET_ORDER', res.data.item)
            }).catch(err => {
            console.log(err)
        })
    },
    editOrder({commit}, {id}) {
        axios.get('/orders/edit/' + id)
            .then(res => {
                commit('EDIT_ORDER', res.data.item)
                commit('GET_ORDER_STATUSES', res.data.order_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    storeOrder({commit}, {order}) {
        axios.post('/orders/store',order)
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
        axios.post('/orders/update/' + order.id, order)
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
    createOrder({commit}) {
        axios.get('/orders/create')
            .then(res => {
                commit('CREATE_ORDER', res.data.item)
                commit('GET_ORDER_STATUSES', res.data.order_statuses)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteOrder({commit}, {order}) {
        axios.delete(`/orders/delete/${order.id}`)
            .then(res => {
                if (res.data.success)
                    commit('DELETE_ORDER', order)
            }).catch(err => {
            console.log(err)
        })
    }
};

export default actions;