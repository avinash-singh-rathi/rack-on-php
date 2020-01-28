<template>
  <div class="">
    <div class="row">
          <div class="col">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row">
                  <div class="col-md-6">
                    <h3 class="mb-0">Create New Page</h3>
                  </div>
                  <div class="col-md-6 text-right">
                    <button class="btn btn-primary rounded-0"><i class="fa fa-plus"></i> Save Page</button>
                  </div>
                </div>
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <form class="" method="post">

                      <div class="row">
                         <div class="col-md-12">
                           <div class="form-group">
                             <label class="form-control-label" for="pagename">Page Name</label>
                             <input type="text" id="pagename" class="form-control" placeholder="Enter Page Name">
                           </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label" for="pageurl">Url</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend">http://wwww.google.com/</span>
                                </div>
                                <input type="text" id="pageurl" class="form-control" placeholder="slug">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="pagecontent">Content</label>
                               <textarea id="pagecontent" class="form-control" placeholder="Enter your content here"></textarea>
                             </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="metatitle">Meta Title</label>
                               <input type="text" id="metatitle" class="form-control" placeholder="Enter meta title">
                             </div>
                           </div>
                         </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="metadescription">Meta Description</label>
                               <textarea id="metadescription" class="form-control" placeholder="Enter meta description"></textarea>
                             </div>
                           </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary rounded-0"><i class="fa fa-plus"></i> Save Page</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>

              </div>

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
	methods:{
    ...mapActions(["getPages"]),
	},
	created(){
    this.getPages();
	}
}
</script>
