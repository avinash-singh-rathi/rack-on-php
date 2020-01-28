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
    getPages({ commit, getters }){
            Vue.http.get(getters.apiUrl+'pages').then(
                        function (response) {
                            console.log(response);
                            commit('setPages', response.data)
                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
    },

};
