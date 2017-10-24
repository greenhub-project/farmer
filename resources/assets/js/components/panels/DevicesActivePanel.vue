<template>
    <div class="panel panel-default">
        <div class="panel-body">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'action'],
        data() {
            return {
                count: {
                    active: 0,
                    total: 0,
                },
                isLoading: false
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.isLoading = true;
                axios.get(this.action)
                    .then(response => {
                        this.count = response.data;
                        this.isLoading = false;
                    })
            }
        }
    }
</script>