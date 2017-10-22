<template>
    <div class="stats__item">
        <div v-if="isLoading">
            <i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <div v-else>{{ count }}</div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['action'],
        data() {
            return {
                count: 0,
                isLoading: false
            }
        },
        mounted() {
            this.fetchData();
            this.$on('refresh', () => this.getData());
        },
        methods: {
            fetchData() {
                this.isLoading = true;
                axios.get(this.action)
                    .then(response => {
                        this.count = response.data;
                        this.isLoading = false;
                    })
                    .catch(error => console.error(error));
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../../sass/variables";
    .fa {
        color: $brand-primary;
    }
</style>