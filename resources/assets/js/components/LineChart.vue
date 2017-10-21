<template>
    <div class="line-chart">
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

    const colors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)'
    };

    const randomProperty = () => {
        const keys = Object.keys(colors);
        return colors[keys[ keys.length * Math.random() << 0]];
    };

    const toRgba = (rgb, alpha = '0.4') => rgb.replace(/rgb/i, 'rgba').replace(/\)/i,`, ${alpha})`);

    export default {
        props: ['action', 'label'],
        data() {
            return {
                feed: [],
                isLoading: false,
                color: ''
            }
        },
        computed: {
            labels() {
                return this.feed.length > 0 ? this.feed.map(el => el.day) : [];
            },
            totals() {
                return this.feed.length > 0 ? this.feed.map(el => el.total) : [];
            }
        },
        mounted() {
            this.color = randomProperty();
            this.getData();
        },
        methods: {
            getData() {
                this.isLoading = true;
                axios.get(this.action)
                    .then(response => {
                        this.feed = response.data;
                        this.initChart();
                        this.isLoading = false;
                    })
                    .catch(error => console.error(error));
            },
            initChart() {
                new Chart(this.$el.querySelector('canvas').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: this.label,
                            backgroundColor: toRgba(this.color),
                            borderColor: this.color,
                            data: this.totals
                        }]
                    }
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/variables";
    .fa {
        color: $brand-primary;
    }
    canvas {
        width: auto;
        height: 400px;
    }
    .flex-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>