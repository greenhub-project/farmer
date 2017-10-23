<template>
    <div>
        <i class="fa fa-check-circle text-success" @click="toggle" v-if="hasRole"></i>
        <i class="fa fa-times-circle text-danger" @click="toggle" v-else></i>
    </div>
</template>

<script>
    import axios from 'axios';
    import Clipboard from 'clipboard';
    export default {
        props: ['action', 'role', 'has'],
        data() {
            return {
                hasRole: this.has === '1'
            }
        },
        methods: {
            toggle() {
                axios.put(this.action, {
                    role: this.role
                }).then(response => {
                    console.log(response.data);
                    this.hasRole = response.data.changed;
                })
                .catch(error => console.error(error));
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fa {
        transition: all .2s ease-in-out;
    }
    .fa:hover {
        transform: scale(1.2);
        cursor: pointer;
    }
</style>