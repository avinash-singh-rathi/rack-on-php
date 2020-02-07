import _ from 'lodash';
export default {
    setApiUrl(state, url) {
        state.configs.apiUrl = url;
    },
    setPages(state,data){
      state.pages=data;
    },
    RemovePage(state,id){
      state.pages.data.forEach((obj1,key) => {
          if(obj1.id == id){
            state.pages.data.splice(key,1);
          }
      });
    }

};
