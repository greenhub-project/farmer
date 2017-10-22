<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="data">
                <i class="fa fa-3x fa-fw" :class="icon" @click="getData"></i>
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
        props: ['action', 'icon', 'title'],
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
        transition: all .2s ease-in-out;
    }
    .fa:hover {
        transform: scale(1.2);
        cursor: pointer;
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