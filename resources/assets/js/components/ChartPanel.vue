<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ label }}</div>
        <div class="panel-body">
            <line-chart
                :label="label"
                :action="action"/>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart.vue';
    export default {
        props: ['action', 'label'],
        components: {
            LineChart
        }
    }
</script>

<style lang="scss" scoped>
</style>