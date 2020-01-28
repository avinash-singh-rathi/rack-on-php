<template>
	<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Pages</h3>
							<router-link :class="'btn btn-primary'" :to="{name:'addpage'}"><i class="fa fa-plus"></i> Add Page</router-link>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">slug</th>
                    <th scope="col">Status</th>
                    <th scope="col">Role</th>
                    <th scope="col">Last Login</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="page in pagesdata">
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="/img/theme/bootstrap.jpg">
                        </a>
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ page.firstname }} {{ page.lastname }}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{page.email}}
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

          	<Pagination :pagedata="pages"></Pagination>

          </div>
        </div>
      </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Pagination from '../../components/pagination';
export default {
	data(){
		return {
			//pagedata:{},
		}
	},
	computed:{
    ...mapGetters(["pages"]),
    pagesdata(){
      return this.pages.data;
    }
	},
	components:{
		Pagination,
	},
	methods:{
    ...mapActions(["getPages"]),
	},
	created(){
    this.getPages();
	}
}
</script>
