import Vue from 'vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.min.css';
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import router from './router';
import store from './store/index'

//components
//import OrderList from './components/OrderList.vue';


Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

new Vue({
    el: '#coremate',
    store,
    router,
    components: coremate.components,
    data: coremate.data,
    methods: coremate.methods,
    i18n
});