let getters = {
    orders: state => {
        return state.orders
    },
    order: state => {
        return state.order
    },
    order_statuses: state => {
        return state.order_statuses
    }
}

export default  getters