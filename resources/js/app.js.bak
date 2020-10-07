import Home from "./components/Home";

require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue/dist/vue.js'
import VueRouter from 'vue-router'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import BootstrapVue from 'bootstrap-vue'

// Komponente
/*import {FormWizard, TabContent} from 'vue-form-wizard'
import Question from './components/Question'*/

Vue.use(VueRouter);
Vue.use(VueFormWizard);
Vue.use(BootstrapVue);

import App from './views/App'
import Campaign from './views/Campaign'
import Homepage from './components/Home'
import CampaignFinish from './components/CampaignFinish'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Homepage
        },
        {
            path: '/campaign/:id',
            name: 'campaign',
            component: Campaign,
        },
        {
            path: '/campaign/finish',
            name: 'campaign-finish',
            component: CampaignFinish
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    router
});