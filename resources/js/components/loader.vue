<template>
<div v-if="showLoader">
  <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog" role="document">
            <div class="">
              <div class="">
                <rotate-square2></rotate-square2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
</div>
</template>

<script>
import {RotateSquare2} from 'vue-loading-spinner'
export default {
  props: {
    showLoader: {
      default: true
    }
  },
  data(){
		return {
      showModal:false,
		}
	},
  components: {
      RotateSquare2
  }
}
</script>
