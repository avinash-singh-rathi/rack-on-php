<template>
	<div v-if="isPagination" class="card-footer py-4">
        <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item" :class="{disabled: isPrevious == false}">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item" :class="{disabled: isNext == false}">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
        </nav>
    </div>
</template>

<script type="text/javascript">
	export default {
		props:['pagedata'],
		data(){
		    return {
		      current:[]
		    }
		},	
		methods:{

		},
		computed:{
			//check for pagination to show or not
			isPagination(){
				if(this.pagedata.meta != undefined){
					return true;
				}
				return false;
			},

			isPrevious(){
				if(this.pagedata.meta.current_page != 1){
					return true;
				}
				return false;
			},

			isNext(){
				if(this.pagedata.meta.last_page != this.pagedata.meta.current_page){
					return true;
				}
				return false;
			}

			

		}
	}
</script>