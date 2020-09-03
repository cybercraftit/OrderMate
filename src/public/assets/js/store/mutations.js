let mutations = {
    GET_ORDERS(state, orders) {
        return state.orders = orders
    },
    CREATE_ORDER(state, order) {
        state.orders.unshift(order)
    },
    GET_ORDER(state, order) {
        return state.order = order;
    },
    EDIT_ORDER(state, order) {
        return state.order = order
    },
    GET_ORDER_STATUSES(state, order_statuses) {
        return state.order_statuses = order_statuses
    },
    DELETE_ORDER(state, order) {
        let index = state.orders.findIndex(item => item.id === order.id)
        state.orders.splice(index, 1)
    }
}
export default mutations;