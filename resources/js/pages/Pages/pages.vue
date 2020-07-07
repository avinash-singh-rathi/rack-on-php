<template>
	<div class="">
		<div class="row">
	        <div class="col">
	          <div class="card shadow">
	            <div class="card-header border-0">
	              <h3 class="mb-0">Pages</h3>
								<div class="row">
									<div class="col-md-6">
										<router-link :class="'btn btn-primary rounded-0'" :to="{name:'addpage'}"><i class="fa fa-plus"></i> Add Page</router-link>
									</div>
									<div class="col-md-6">
										<div class="float-right">
											<form @submit.prevent="GoPages()" class="form-inline" method="post">
												<div class="form-group mx-sm-3 mb-2">
													<label for="searchinput" class="sr-only">Search Term</label>
													<input type="text" class="form-control" v-model="search" id="search" placeholder="What are you looking?">
												</div>
												<button type="submit" class="btn btn-primary mb-2 rounded-0">Search</button>
											</form>
										</div>
									</div>
								</div>

	            </div>
	            <div v-if="pagesdata != undefined && pagesdata.length > 0" class="table-responsive">
	              <table class="table align-items-center table-flush">
	                <thead class="thead-light">
	                  <tr>
	                    <th scope="col">Name</th>
	                    <th scope="col">slug</th>
	                    <th scope="col">Status</th>
	                    <th scope="col">Created at</th>
	                    <th scope="col">Updated at</th>
	                    <th scope="col"></th>
	                  </tr>
	                </thead>
	                <tbody>
	                  <tr v-for="page in pagesdata">
	                    <th class="avi-th" title="page.title" scope="row">
	                      {{page.title}}
	                    </th>
	                    <td class="avi-th" title="page.slug">
	                      {{page.slug}}
	                    </td>
	                    <td>
	                      <span class="badge badge-dot mr-4">
	                        <i :class="{'bg-warning':!page.status,'bg-success':page.status}"></i> {{ page.status | checkStatus}}
	                      </span>
	                    </td>
	                    <td>
	                     {{page.created_at}}
	                    </td>
	                    <td>
												{{page.updated_at}}
	                    </td>
	                    <td class="text-right">
	                      <div class="dropdown">
	                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          <i class="fas fa-ellipsis-v"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
														<router-link class="dropdown-item" :to="{ name: 'EditPage', params: { id: page.id }}">Edit</router-link>
														<a class="dropdown-item" href="#">View on Front</a>
	                          <a class="dropdown-item" @click.prevent="DeleteIt(page.id)" href="#">Delete</a>
	                        </div>
	                      </div>
	                    </td>
	                  </tr>
	                </tbody>
	              </table>
	            </div>

							<div v-else class="card-body">
								<div class="row">
									<div class="">
										You have not created any<span> such</span> page. Create <router-link :to="{ name: 'addpage'}">One</router-link>
									</div>
								</div>
							</div>

	          	<Pagination :pagedata="pages" @clicked="GoPages"></Pagination>

	          </div>
	        </div>
	      </div>
				<footer-container></footer-container>
	</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Pagination from '../../components/pagination';
import FooterContainer from '../../components/footerContainer';
export default {
	data(){
		return {
			//pagedata:{},
			search:'',
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
		'footer-container':FooterContainer,
	},
	filters: {
	  checkStatus: function (value) {
	    if (!value) return 'Draft'
	    return 'Published'
	  }
	},
	methods:{
    ...mapActions(["GetPages","DeletePage"]),
		GoPages(pagenumber=null){
			//Action will go here
			this.GetPages({search:this.search,page:pagenumber});
		},
		async DeleteIt(id){
				this.$swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  //confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					console.log(result);
				  if (result.value) {
						this.DeletePage(id).then(response =>{
							this.$swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
							);
						},error => {
							this.$swal.fire(
					      'Unsuccessful!',
					      'Unable to delete this page.',
					      'error'
					    )
						});
				  }
				})
		},

	},
	created(){
    this.GetPages();
	}
}
</script>
