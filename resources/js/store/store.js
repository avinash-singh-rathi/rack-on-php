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
        posts:[],
        configs:{
            apiUrl:'/api/admin/'
        },
        filemanager:{
          // axios headers
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            Authorization: document.head.querySelector('meta[name="csrf-token"]').content,
          },
          baseUrl: 'file-manager/',   // overwrite base url Axios
          windowsConfig: 2,                           // overwrite config
          lang: 'en',                                 // set language
        }
    },
    getters,
    mutations,
    actions
});
