import Vue from 'vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.min.css';
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import routes_data from './router';
import state_data from './store/state'
import getters_data from './store/getters'
import mutations_data from './store/mutations'
import actions_data from './store/actions'


Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});
routes = routes.concat(routes_data);
state = Object.assign(state,state_data);
getters = Object.assign(getters,getters_data);
mutations = Object.assign(mutations,mutations_data);
actions = Object.assign(actions,actions_data);