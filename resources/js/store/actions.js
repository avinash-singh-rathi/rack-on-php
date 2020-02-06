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
    GetPages({ commit, getters },value=''){
            Vue.http.get(getters.apiUrl+'pages'+value).then(
                        function (response) {
                            console.log(response);
                            commit('setPages', response.data)
                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
    },

};
