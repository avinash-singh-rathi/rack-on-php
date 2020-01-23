export default {

    //Get the logged In user
    getUser({ commit, state }, {vm}){
            vm.$http.get('api/admin/user').then(
                        function (response) {
                            console.log(response);

                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
    },

};
