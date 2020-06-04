<template>
	<div class="">
		<div class="row">
	        <div class="col">
	          <div class="card shadow">
	            <div class="card-header border-0">
	              <h3 class="mb-0">File Manager</h3>
	            </div>
              <file-manager></file-manager>

							<div class="card-body">
								<div class="row">
									<div class="">
										You have not created any<span> such</span> page. Create <router-link :to="{ name: 'addpage'}">One</router-link>
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
  import FooterContainer from '../../components/footerContainer';
  export default{
    components:{
      'footer-container':FooterContainer
    }
  }
</script>
