export default {
    index() {
        return axios.get('/users')
    },
    destroy(id) {
        return axios.delete(`/users/${id}`)
    }
}
