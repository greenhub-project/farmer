<template>
    <div id="api-form">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    API token
                    <transition name="fade">
                        <span class="label label-success" v-if="isCopied">Copied!</span>
                    </transition>
                </th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><code>{{ key }}</code></td>
                <td>
                    <div class="btn-group" role="group">
                        <button id="clipboard" type="button" class="btn btn-default" aria-label="Hello"
                                title="Copy to clipboard" :data-clipboard-text="key">
                            <i class="fa fa-clipboard"></i>
                        </button>
                        <button type="button" class="btn btn-default" :title="title" @click="generate">
                            <i class="fa fa-refresh fa-spin" v-if="isLoading"></i>
                            <span class="sr-only" v-if="isLoading">Loading...</span>
                            <i class="fa fa-refresh" v-else></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import Clipboard from 'clipboard';
    export default {
        props: ['action', 'title', 'token'],
        data() {
            return {
                key: this.token,
                isLoading: false,
                isCopied: false
            }
        },
        mounted() {
             new Clipboard('#clipboard').on('success', () => {
                this.isCopied = true;
                setTimeout(() => this.isCopied = false, 1500);
             });
        },
        methods: {
            generate() {
                this.isLoading = true;
                axios.post(this.action)
                    .then(response => {
                        this.key = response.data;
                        this.isLoading = false;
                    })
                    .catch(error => console.error(error));
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>