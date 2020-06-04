<template>
	<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Users</h3>
              <button class="btn btn-primary"><i class="fa fa-plus"></i> Add User</button>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Role</th>
                    <th scope="col">Last Login</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users">
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="/img/theme/bootstrap.jpg">
                        </a>
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ user.firstname }} {{ user.lastname }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{user.email}}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i> pending
                      </span>
                    </td>
                    <td>
                     Admin
                    </td>
                    <td>

                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          	<Pagination :pagedata="pagedata"></Pagination>

          </div>
        </div>
      </div>
</template>

<script>
import Pagination from '../components/pagination';
export default {
	data(){
		return {
			pagedata:{},
		}
	},
	computed:{
		users(){
			return this.pagedata.data;
		}
	},
	components:{
		Pagination,
	},
	methods:{
		getUsers(){
			this.$http.get('api/admin/users').then(
                        function (response) {
                            this.pagedata = response.body;
                            console.log(response);

                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
		},
		getUser(){
			this.$http.get('api/user').then(
                        function (response) {
                            console.log(response);

                        }, function (error) {
                            // handle error
                            console.log(error);
                        });
		}
	},
	created(){
		//
		this.getUsers();
		this.getUser();
	}
}
</script>
