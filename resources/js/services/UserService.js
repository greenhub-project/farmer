export default {
    index() {
        return axios.get('/users')
    },
    update(id, role) {
        return axios.put(`/users/${id}`, {
            role
        })
    },
    destroy(id) {
        return axios.delete(`/users/${id}`)
    }
}
