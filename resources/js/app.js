require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'
import VueAxios from 'vue-axios'
import VModal from 'vue-js-modal'
import VueToastr from "vue-toastr";

Vue.use(VueAxios, axios)
Vue.use(VModal)
Vue.use(VueToastr)

Vue.component('visitor-dashboard', require('./pages/VisitorDashboard.vue').default);
Vue.component('admin-dashboard', require('./pages/AdminDashboard.vue').default);
Vue.component('links-table', require('./components/LinksTable.vue').default);
Vue.component('html-snippets-table', require('./components/HtmlSnippetsTable.vue').default);
Vue.component('pdf-file-table', require('./components/PdfFileTable.vue').default);
Vue.component('Label', require('./components/Label.vue').default);
Vue.component('edit-button', require('./components/EditButton.vue').default);
Vue.component('delete-button', require('./components/DeleteButton.vue').default);


const app = new Vue({
    el: '#app',
});
