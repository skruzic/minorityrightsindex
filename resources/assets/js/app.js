require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue'
import VueRouter from 'vue-router'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

// Komponente
import {FormWizard, TabContent} from 'vue-form-wizard'
import Question from './components/Question'
import PanelQuestion from './components/PanelQuestion'

Vue.use(VueRouter);
Vue.use(VueFormWizard)

import App from './views/App'
import Campaign from './views/Campaign'

//Vue.component('tab-content', TabContent);
Vue.component('question', Question);
//Vue.component('checkbox-question', CheckboxQuestion);
Vue.component('panel-question', PanelQuestion);


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