<template>
    <form class="form-inline" :action="action" role="search">
        <div class="form-group">
            <input type="text" class="form-control" name="q" autofocus autocomplete="off" @keyup.esc="reset">
        </div>
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search fa-fw"></i>
            </button>
            <button type="button" class="btn btn-default" @click="reset">
                <i class="fa fa-trash-o fa-fw"></i>
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['action'],
        data() {
            return {
                textField: null
            }
        },
        mounted() {
          this.textField = this.$el.querySelector('input');
        },
        methods: {
            reset() {
                this.textField.value = '';
                this.$el.submit();
            }
        }
    }
</script>