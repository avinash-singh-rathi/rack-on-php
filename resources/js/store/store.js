import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import actions from './actions'
import mutations from './mutations'
import getters from './getters'

export const store = new Vuex.Store({
    strict: true,
    state: {
        loading:true,
        pages:[],
        configs:{
            apiUrl:'/api/admin/'
        }
    },
    getters,
    mutations,
    actions
});
