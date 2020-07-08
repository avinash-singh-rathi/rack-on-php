<template>
  <div class="">
    <editor :init="initialize" v-model="content" @onKeyUp="updateValue" @onChange="updateValue"/>
    <loader :showLoader="loading"></loader>
    <div v-if="showModal" class="filemanager">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">File Browser</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <file-manager></file-manager>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                  <button type="button" @click="InsertFile" class="btn btn-primary">Select</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import loader from './loader';
import CommonMixin from '../mixins/common';
import tinymce from "tinymce";
import Editor from '@tinymce/tinymce-vue';

export default {
  props: ['value'],
  mixins: [CommonMixin],
  data(){
    return {
      content:this.value,
      showModal: false,
      selectedFile:false,
      loading:false,
      FileMime:'',
      initialize:{
        file_picker_callback:this.GetFileBrowser,
        height: 500,
        plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
        toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
      }
    }
  },
  computed:{
    ...mapGetters({apiUrl:"apiUrl",fmselectedItems:"fm/selectedItems"}),
	},
  components:{
		loader,
    'editor': Editor
	},
  methods:{
    updateValue: function (value, value2) {
      this.$emit('update:value', this.content);
    },
    GetFileBrowser(callback, value, meta){
      this.showModal = true;
      this.FileMime=meta.filetype
      this.GetFile().then(response => {
          if (meta.filetype == 'file') {
            //callback(response['link'], {text: response['text']});
            callback(response['link']);
          }

          // Provide image and alt text for the image dialog
          if (meta.filetype == 'image') {
            //callback(response['link'], {alt: response['text']});
            callback(response['link']);
          }

          // Provide alternative source and posted for the media dialog
          if (meta.filetype == 'media') {
            //callback(response['link'], {source2: response['link2'], poster: response['image']});
            callback(response['link']);
          }
      })
    },
    GetFile(){
      //This Function will check the selected file
      return new Promise((resolve, reject) => {
        var delay=200
        let vmi=this
        let process = function() {
          if (vmi.selectedFile == false) {
	           setTimeout(process, delay);
	        }else{
            vmi.showModal=false
            vmi.selectedFile = false
            var response={link:'/storage/'+vmi.fmselectedItems[0].path}
            resolve(response);
          }
        }
        setTimeout(process, delay);

      })
    },
    InsertFile(){
      if(this.fmselectedItems.length < 1){
        this.$swal.fire(
            'Warning!',
            'Select a file!',
            'info'
        );
        return;
      }

      if(this.fmselectedItems.length > 1){
        this.$swal.fire(
            'Warning!',
            'Select a single file only!',
            'info'
        );
        return;
      }

      //Need to work upon the file type check also
      
      this.selectedFile=true
    }
  }
}
</script>
