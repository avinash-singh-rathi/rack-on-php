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
                    <button class="btn btn-primary rounded-0" @click.prevent="CreatePage"><i class="fa fa-plus"></i> Save Page</button>
                  </div>
                </div>
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <form class="" @submit.prevent="CreatePage" method="post">
                      <div class="row">
                         <div class="col-md-12">
                           <div class="form-group">
                             <label class="form-control-label" for="pagetitle">Page Title</label>
                             <div class="" :class="{ 'has-danger': submitted && errors.has('title') }">
                               <input type="text" id="pagetitle" v-model="page.title" name="title" v-validate="'required'" class="form-control" :class="{ 'is-invalid': submitted && errors.has('title') }" placeholder="Enter Page title">
                             </div>
                             <div v-if="submitted && errors.has('title')" class="invalid-feedback">{{ errors.first('title') }}</div>
                           </div>
                         </div>
                       </div>

                       <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label" for="pageurl">Url</label>
                              <div class="input-group" :class="{ 'has-danger': submitted && errors.has('slug') }">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend">http://wwww.google.com/</span>
                                </div>
                                <input type="text" id="pageurl" v-model="page.slug" name="slug" class="form-control" :class="{ 'is-invalid': submitted && errors.has('slug') }" placeholder="slug">
                              </div>
                              <div v-if="submitted && errors.has('slug')" class="invalid-feedback">{{ errors.first('slug') }}</div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="pagecontent">Content</label>
                                //use editor here
                                <editor v-bind:value.sync="page.content" />
                             </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="metatitle">Meta Title</label>
                               <input type="text" id="metatitle" v-model="page.metatitle" class="form-control" placeholder="Enter meta title">
                             </div>
                           </div>
                         </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="metadescription">Meta Description</label>
                               <textarea id="metadescription" class="form-control" v-model="page.metadescription" placeholder="Enter meta description"></textarea>
                             </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                               <label class="form-control-label" for="status">Status</label>
                               <div class="" :class="{ 'has-danger': submitted && errors.has('status') }">
                                 <select class="form-control" id="status" name="status" v-model="page.status" v-validate="'required'" :class="{ 'is-invalid': submitted && errors.has('status') }">
                                   <option value="">Select Status</option>
                                   <option value="1">Published</option>
                                   <option value="0">Draft</option>
                                 </select>
                               </div>
                               <div v-if="submitted && errors.has('status')" class="invalid-feedback">{{ errors.first('status') }}</div>
                             </div>
                           </div>
                         </div>

                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button type="submit" @keyup.enter="flagsubmit=true" @click="flagsubmit=true" class="btn btn-primary rounded-0"><i class="fa fa-plus"></i> Save Page</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        <loader :showLoader="loading"></loader>
        <footer-container></footer-container>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import FooterContainer from '../../components/footerContainer';
import loader from '../../components/loader';
import CommonMixin from '../../mixins/common';
import Editor from '../../components/contentEditor';

//CKEDITOR.replace('editor-id', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
export default {
  mixins: [CommonMixin],
	data(){
		return {
      page:{
        title:null,
        slug:null,
        content:null,
        metatitle:null,
        metadescription:null,
        status:1,
      },
      submitted:false,
      loading:false,
      flagsubmit:false,
      //pagedata:{},
		}
	},
	computed:{
    ...mapGetters({apiUrl:"apiUrl",fmselectedItems:"fm/selectedItems"}),
	},
	components:{
		'footer-container':FooterContainer,
    loader,
    'editor': Editor
	},
	methods:{
    ...mapActions(["GetPages","AddPage"]),
    CreatePage(e){
      if(!this.flagsubmit){
        return false
      }
      this.loading=true;
      this.submitted = true;
      this.$validator.validate().then(valid => {
        if (valid) {
            this.$http.post(this.apiUrl+'pages',this.page).then(
              function (response) {
                  this.loading=false;
                  this.page={};
                  this.page.status=1;
                  this.$swal.fire(
                      'Successful!',
                      'Page created successfully!',
                      'success'
                  );
                  this.$validator.errors.clear();
                  this.submitted=false;
              }, function (error) {
                this.loading=false;
                this.$setLaravelValidationErrorsFromResponse(error.data);
                this.handleValidationErrorAdvanced();
              }
            );
          }else{
            this.loading=false;
            this.handleValidationErrorAdvanced();
          }
      });
    },
	},
	created(){
    //
	},
  mounted(){
    // tinymce.init({
    //     selector: 'textarea#mytextarea'
    // });
  }
}
</script>

<style>

</style>
