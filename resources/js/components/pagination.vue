<template>
	<div v-if="isPagination" class="card-footer py-4">
        <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item" :class="{disabled: isPrevious == false}">
                    <a class="page-link" @click.prevent="GoToPage(FirstPageLink)" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li v-for="link in PageNumbers" class="page-item" :class="{active:link.number == CurrentPage}">
                    <a class="page-link" @click.prevent="GoToPage(link.url,link.number)" href="#">{{link.number}}</a>
                  </li>
                  <!-- <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li> -->
                  <!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                  <li class="page-item" :class="{disabled: isNext == false}">
                    <a class="page-link" @click.prevent="GoToPage(LastPageLink)" href="#">
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
			ChangeUriParam(url,param,value){
				let newurl = new URL(url);
				newurl.searchParams.set(param, value);
				return newurl.toString();
			},

			//Go To Pages
			GoToPage(url,page=null){
				if(page!=null && page === this.CurrentPage){
					return;
				}
				this.$emit('clicked', page);
			}
		},
		computed:{
			//check for pagination to show or not
			isPagination(){
				if(this.pagedata.meta != undefined && (this.pagedata.links.prev != null || this.pagedata.links.next != null)){
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
			},
			CurrentPage(){
				return this.pagedata.meta.current_page;
			},
			lastPage(){
				return this.pagedata.meta.last_page;
			},
			FirstPageLink(){
				return this.pagedata.links.first;
			},
			LastPageLink(){
				return this.pagedata.links.last;
			},
			PageNumbers(){
				let current=this.CurrentPage;
				let links = [];
				if(current != undefined && current!= null){
					if(current !=1){
							links.push({'number':current-1,'url':this.ChangeUriParam(this.pagedata.links.first,'page',current -1)});
					}
							links.push({'number':current,'url':this.ChangeUriParam(this.pagedata.links.first,'page',current)});
					if( this.lastPage > current){
							links.push({'number':current+1,'url':this.ChangeUriParam(this.pagedata.links.first,'page',current + 1)});
					}
				}
				return links;
				// var text = 'http://localhost/mysite/includes/phpThumb.php?src=http://media2.jupix.co.uk/v3/clients/4/properties/795/IMG_795_1_large.jpg&w=592&aoe=1&q=100';
				// var newSrc = 'www.google.com';
				// var newText = text.replace(/(src=).*?(&)/,'$1' + newSrc + '$2');
			},

		}
	}
</script>
