<template>
	<div>
		<navSidebar></navSidebar>
		<div class="main-content">
			<navHeader></navHeader>
			<headerCard></headerCard>
			<div class="container-fluid mt--7">
				<router-view></router-view>
			</div>
		</div>	
	</div>
</template>
<script type="text/javascript">
	import navSidebar from "./components/navsidebar";
	import navHeader from "./components/navheader";
	import headerCard from "./components/headercard";	
	export default{
		components:{
			navSidebar,
			navHeader,
			headerCard
		}
	}
</script>