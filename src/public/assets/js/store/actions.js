import axios from 'axios';

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
    createOrder({commit}, {order}) {
        axios.post('/orders/store', order)
            .then(res => {
                commit('CREATE_ORDER', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteOrder({commit}, {order}) {
        axios.delete(`/orders/delete/${order.id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_ORDER', order)
            }).catch(err => {
            console.log(err)
        })
    }
};

export default actions;