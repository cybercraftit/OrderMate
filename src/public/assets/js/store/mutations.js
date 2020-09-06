let mutations = {
    SET_ERRORS(state, errors) {
        state.errors = errors;
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
    GET_ORDERS(state, orders) {
        return state.orders = orders;
    },
    //cusomers
    GET_CUSTOMERS(state, customers) {
        return state.customers = customers
    },
    CREATE_CUSTOMER(state, customer) {
        //state.customers.unshift(customer)
        let o = {
            name: '',
            customer_id: '',
            shipping_address: '',
            delivery_date: '',
            product_id: '',
            payment_option: '',
            amount: '',
            customer_status: '',
            customer: {
                first_name: '',
                last_name: '',
                phone: '',
                email: '',
                address: ''
            },
            can: customer.can
        };
        return state.customer = o;
    },
    STORE_CUSTOMER(state, customer) {
        state.customers.items.data.unshift(customer)
    },
    GET_CUSTOMER(state, customer) {
        return state.customer = customer;
    },
    EDIT_CUSTOMER(state, customer) {
        state.msg = ''
        return state.customer = customer
    },
    SET_MESSAGE(state, msg) {
        state.msg = msg;
    },
    GET_CUSTOMER_STATUSES(state, customer_statuses) {
        return state.customer_statuses = customer_statuses
    },
    DELETE_CUSTOMER(state, customer) {
        let item = state.customers.items.data.forEach((item,index) => {
            if( item.id === customer.id ) {
                state.customers.items.data.splice(index, 1)
                return item;
            }
        } );
    },
}
export default mutations;