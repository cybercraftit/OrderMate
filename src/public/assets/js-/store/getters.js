let getters = {
    errors: state => {
        return state.errors
    },
    msg: state => {
        return state.msg
    },
    order_statuses: state => {
        return state.order_statuses
    },
    orders: state => {
        return state.orders
    },
    order: state => {
        return state.order
    },
    customers: state => {
        return state.customers
    },
    customer: state => {
        return state.customer
    },
}

export default  getters