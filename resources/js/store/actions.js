export default {

    //Get the logged In user
    getUser({ commit, getters }){
            Vue.http.get(getters.apiUrl+'/user').then(
                        function (response) {
                            console.log(response);
                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
    },
    //Function to get All pages and search query for pages too
    GetPages({ commit, getters },value=''){
        return new Promise((resolve, reject) => {
            Vue.http.get(getters.apiUrl+'pages'+value).then(
                        function (response) {
                            commit('setPages', response.data)
                            resolve(response);
                        }, function (error) {
                            reject(error);
                        });
            });
    },

    //Function to Delete the Page
    DeletePage({commit,getters},id){
      return new Promise((resolve, reject) => {
          Vue.http.delete(getters.apiUrl+'pages/'+id).then(
            function(response){
              commit('RemovePage',id);
              resolve(response);
            },function(error){
              reject(error);
          });
      });
    }

};
