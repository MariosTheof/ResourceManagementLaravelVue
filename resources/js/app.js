require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

Vue.component('admin-dashboard', require('./components/AdminDashboard.vue').default);
Vue.component('links-table', require('./components/LinksTable.vue').default);
Vue.component('html-snippets-table', require('./components/HtmlSnippetsTable.vue').default);

const app = new Vue({
    el: '#app',
});
