
require('./bootstrap');

window.Vue = require('vue');
window.axios=require('axios');

import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);


Vue.component('dashboard-component', require('./components/admin/DashboardComponent.vue').default);
Vue.component('myinfo-component', require('./components/admin/users/MyinfoComponent.vue').default);
Vue.component('user-component', require('./components/admin/users/UserComponent.vue').default);

Vue.component('category-component', require('./components/admin/CategoryComponent.vue').default);
Vue.component('writer-component', require('./components/admin/WriterComponent.vue').default);
Vue.component('slider-component', require('./components/admin/SliderComponent.vue').default);
Vue.component('setting-component', require('./components/admin/SettingComponent.vue').default);

Vue.component('nasher-component', require('./components/admin/NasherComponent.vue').default);
Vue.component('book-component', require('./components/admin/BookComponent.vue').default);









Vue.component('error', require('./components/custom/error.vue').default);






const app = new Vue({
    el: '#app',
});





/* npms

npm install verte --save


*/
