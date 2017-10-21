<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="data">
                <h4>{{ title }}</h4>
                <div class="data__loader" v-if="isLoading">
                    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="counter" v-else>{{ count }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['action', 'title'],
        data() {
            return {
                count: 0,
                isLoading: false
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData() {
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

<style lang="scss" scoped>
    @import "../../sass/variables";

    .fa {
        color: $brand-primary;
    }
    .data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 48px;

        .counter {
            font-size: 2.4rem;
            font-weight: 700;
        }
    }
</style>