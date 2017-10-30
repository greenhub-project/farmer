<template>
    <div class="panel panel-default">
        <ul class="list-group list-group--spaced">
            <li class="list-group-item">
                <h3 class="list-group-item-heading">{{ title }}</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-xs btn-info" title="Refresh" @click="refreshData">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </li>
            <stats-item title="Today's" :action="setInterval('today')"></stats-item>
            <stats-item title="This week" :action="setInterval('week')"></stats-item>
            <stats-item title="This month" :action="setInterval('month')"></stats-item>
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