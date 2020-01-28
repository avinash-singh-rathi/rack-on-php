import _ from 'lodash';
export default {
    setApiUrl(state, url) {
        state.configs.apiUrl = url;
    },
    setPages(state,data){
      state.pages=data;
    }

};
