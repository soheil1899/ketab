
require('./bootstrap');

window.Vue = require('vue');
window.axios=require('axios');


Vue.component('menu-compo', require('./components/client/Menucompo').default);
Vue.component('slider-compo', require('./components/client/Slider.vue').default);
Vue.component('leftside-compo', require('./components/client/Leftside.vue').default);
Vue.component('lastbook-compo', require('./components/client/Lastbook.vue').default);
Vue.component('personinfo-combo', require('./components/client/Personinfo.vue').default);
Vue.component('about-compo', require('./components/client/About.vue').default);
Vue.component('contact-compo', require('./components/client/Contact.vue').default);
Vue.component('bookinfo', require('./components/client/Bookinfo.vue').default);
Vue.component('search_compo', require('./components/client/Search.vue').default);
Vue.component('show-search', require('./components/client/ShowSearch.vue').default);















const app = new Vue({
    el: '#client',
});





/* npms

npm install verte --save


*/
