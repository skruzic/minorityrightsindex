require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue'
import VueRouter from 'vue-router'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import BootstrapVue from 'bootstrap-vue'
import VueObserveVisibility from 'vue-observe-visibility'
import inViewortDirective from 'vue-in-viewport-directive'

// Komponente
import {FormWizard, TabContent} from 'vue-form-wizard'
import Question from './components/Question'

Vue.use(VueRouter);
Vue.use(VueFormWizard);
Vue.use(BootstrapVue);
Vue.use(VueObserveVisibility);

// Direktive
Vue.directive('in-viewport', inViewortDirective);

import App from './views/App'
import Campaign from './views/Campaign'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/campaign/:id',
            name: 'home',
            component: Campaign,
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    router
});