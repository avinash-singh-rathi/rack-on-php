<template>
  <div class="">
    <div class="row">
          <div class="col">
            <div class="card shadow">
              <div class="card-header border-0">
                <h3 class="mb-0">Posts</h3>
                <div class="row">
                  <div class="col-md-6">
                    <router-link :class="'btn btn-primary rounded-0'" :to="{name:'AddPost'}"><i class="fa fa-plus"></i> Add Post</router-link>
                  </div>
                  <div class="col-md-6">
                    <div class="float-right">
                      <form @submit.prevent="search()" class="form-inline" method="post">
                        <div class="form-group mx-sm-3 mb-2">
                          <label for="searchinput" class="sr-only">Search Term</label>
                          <input type="text" class="form-control" v-model="searchinput" id="searchinput" placeholder="What are you looking?">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 rounded-0">Search</button>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
              <div v-if="PostsData != undefined && PostsData.length > 0" class="table-responsive">
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
                    <tr v-for="post in PostsData">
                      <th scope="row">
                        {{post.title}}
                      </th>
                      <td>
                        {{post.slug}}
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <i :class="{'bg-warning':!post.status,'bg-success':post.status}"></i> {{ post.status | checkStatus}}
                        </span>
                      </td>
                      <td>
                       {{post.created_at}}
                      </td>
                      <td>
                        {{post.updated_at}}
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <router-link class="dropdown-item" :to="{ name: 'EditPage', params: { id: page.id }}">Edit</router-link>
                            <a class="dropdown-item" href="#">View on Front</a>
                            <!-- <a class="dropdown-item" @click.prevent="DeleteIt(page.id)" href="#">Delete</a> -->
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
                    You have not created any<span> such</span> post. Create <router-link :to="{ name: 'addpage'}">One</router-link>
                  </div>
                </div>
              </div>

              <Pagination :pagedata="posts" @clicked="GetPosts"></Pagination>

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
			searchinput:'',
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
  computed:{
    ...mapGetters(["FileManagerSettings","posts"]),
    PostsData(){
      return this.posts.data
    }
  },
  methods:{
      //
      ...mapActions(["GetPosts"]),
  },
  created(){
    this.GetPosts();
  }
}
</script>

<style lang="css" scoped>
</style>
