<template>
    <div class="panel panel-default">
        <ul class="list-group stats__list">
            <li class="list-group-item">
                <h3 class="list-group-item-heading">{{ title }}</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-xs btn-info" title="Refresh" @click="refreshData">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </li>
            <li class="list-group-item">
                Today's
                <stats-item :action="setInterval('today')"/>
            </li>
            <li class="list-group-item">
                This week
                <stats-item :action="setInterval('week')"/>
            </li>
            <li class="list-group-item">
                This month
                <stats-item :action="setInterval('month')"/>
            </li>
        </ul>
    </div>
</template>

<script>
    import StatsItem from './StatsItem.vue';
    export default {
        props: ['title', 'action'],
        components: {
            StatsItem
        },
        methods: {
            setInterval(name) {
                return this.action + '?interval=' + name
            },
            refreshData() {
                this.$children.filter(child => child.$emit('refresh'));
            }
        }
    }
</script>

<style lang="scss" scoped>
    .stats__list > .list-group-item {
        display: flex;
        justify-content: space-between;
    }
</style>