require('./bootstrap');
window.Vue = require('vue');

Vue.component('charge-payments', require('./components/ChargePayment.vue').default);

const app = new Vue({
    el: '#app',
});