let mutations = {
    GET_ORDERS(state, orders) {
        return state.orders = orders
    },
    CREATE_ORDER(state, order) {
        //state.orders.unshift(order)
        let o = {
            name: '',
            customer_id: '',
            shipping_address: '',
            delivery_date: '',
            product_id: '',
            payment_option: '',
            amount: '',
            order_status: '',
            customer: {
                first_name: '',
                last_name: '',
                phone: '',
                email: '',
                address: ''
            },
            can: order.can
        };
        return state.order = o;
    },
    STORE_ORDER(state, order) {
        state.orders.items.data.unshift(order)
    },
    GET_ORDER(state, order) {
        return state.order = order;
    },
    EDIT_ORDER(state, order) {
        state.msg = ''
        return state.order = order
    },
    SET_MESSAGE(state, msg) {
        state.msg = msg;
    },
    GET_ORDER_STATUSES(state, order_statuses) {
        return state.order_statuses = order_statuses
    },
    DELETE_ORDER(state, order) {
        let item = state.orders.items.data.forEach((item,index) => {
            if( item.id === order.id ) {
                state.orders.items.data.splice(index, 1)
                return item;
            }
        } );
    },
    SET_ERRORS(state, errors) {
        state.errors = errors;
    }
}
export default mutations;