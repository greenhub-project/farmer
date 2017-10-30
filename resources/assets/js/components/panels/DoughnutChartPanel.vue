<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ label }}</div>
        <div class="panel-body">
            <doughnut-chart
                    :labels="labels"
                    :action="action"></doughnut-chart>
        </div>
    </div>
</template>

<script>
    import DoughnutChart from '../charts/DoughnutChart.vue';
    export default {
        props: ['action', 'label', 'labels'],
        components: {
            DoughnutChart
        }
    }
</script>