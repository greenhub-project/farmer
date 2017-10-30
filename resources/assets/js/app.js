
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('api-form', require('./components/forms/ApiForm.vue'));
Vue.component('search-box', require('./components/forms/SearchBox.vue'));
Vue.component('stats-panel', require('./components/panels/StatsPanel.vue'));
Vue.component('role-toggler', require('./components/forms/RoleToggler.vue'));
Vue.component('about-dialog', require('./components/dialogs/AboutDialog.vue'));
Vue.component('line-chart-panel', require('./components/panels/LineChartPanel.vue'));
Vue.component('live-counter-panel', require('./components/panels/LiveCounterPanel.vue'));
Vue.component('doughnut-chart-panel', require('./components/panels/DoughnutChartPanel.vue'));

new Vue({
    el: '#app',
    data: {
        showAboutDialog: false
    }
});