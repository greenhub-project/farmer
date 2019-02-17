export default {
    index(model) {
        return axios.get('/stats', {
            params: {
                model
            }
        });
    }
};
