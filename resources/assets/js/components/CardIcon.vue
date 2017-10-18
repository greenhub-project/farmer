<template>
    <div class="panel panel-default" :class="{ loading: isLoading }">
        <div class="panel-body">
            <div class="row">
                <div class="flex" v-if="isLoading">
                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="card" v-else>
                    <div class="col-md-6">
                        <i class="fa fa-4x" :class="icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-6">
                        <div class="details">
                            <div class="count">{{ count }}</div>
                            <div class="title">{{ title }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['title', 'icon', 'action'],
        data() {
            return {
                count: 0,
                isLoading: true
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
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .loading {
        opacity: 0.4;
    }
    .row > div {
        min-height: 65px;
    }
    .flex {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .details {
        float: right;
        text-align: right;

        .title {
            font-weight: 700;
        }
        .count {
            font-size: 3rem;
            color: black;
        }
    }
    .fa {
        color: #ddd;
    }
</style>