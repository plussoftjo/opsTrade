<template>
	<div class="dashboard">
		<div class="title">
			DashBoard
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card border-success mb-3" style="max-width: 18rem;">
				  <div class="card-body text-success">
				    <h5 class="card-title">User Register</h5>
				    <p class="card-text">{{item.user}} User</p>
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3" style="max-width: 18rem;">
				  <div class="card-body text-primary">
				    <h5 class="card-title">Posts</h5>
				    <p class="card-text">{{item.post}} Post</p>
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-info mb-3" style="max-width: 18rem;">
				  <div class="card-body text-info">
				    <h5 class="card-title">Comments</h5>
				    <p class="card-text">{{item.comment}} Comment</p>
				  </div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				item:{}
			}
		},
		created() {
			const vm = this;
			axios.get('/api/admin/dashboard').then(response => {
				vm.item = response.data;
			}).catch(err => {
				console.log(err)
			});
		}
	}
</script>
<style>
	.title{font-size: 20px; font-weight: 700; padding:5px;}
</style>