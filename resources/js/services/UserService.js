export default {
    index(page) {
        return axios.get(`/users?page=${page}`)
    },
    update(id, role) {
        return axios.put(`/users/${id}`, { role })
    },
    destroy(id) {
        return axios.delete(`/users/${id}`)
    }
}
