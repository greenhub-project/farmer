<template>
    <div class="doughnut-chart">
        <div class="flex-center" v-show="isLoading">
            <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <canvas v-show="!isLoading"></canvas>
    </div>
</template>

<script>
    import axios from 'axios';
    import Chart from 'chart.js';

    export default {
        props: ['action', 'labels'],
        data() {
            return {
                count: [],
                isLoading: false,
                color: ''
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
                        this.initChart();
                    });
            },
            initChart() {
                new Chart(this.$el.querySelector('canvas').getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: this.count,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)'
                            ]
                        }],
                        labels: this.labels
                    }
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../../sass/variables";
    .fa {
        color: $brand-primary;
    }
    .flex-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>