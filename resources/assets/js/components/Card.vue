<template>
    <div class="panel panel-default">
        <div class="panel-body">
            I'm an example component!
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style lang="scss" scoped>
    .panel {
        height: 200px;
    }
</style>