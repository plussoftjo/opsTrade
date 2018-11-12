<template>
	<div class="editUser">
		<div class="container">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" v-model="user.name">
			</div>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input type="text" class="form-control" v-model="user.phone">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" v-model="user.email">
			</div>
			<div class="row">
				<div class="col-md-6">
					<button class="btn btn-success btn-block" @click="update">
					Update
					</button>
				</div>
				<div class="col-md-6">
					<button class="btn btn-info btn-block" @click="$router.push({name:'Users'})">
						close 
					</button>
				</div>
			</div>
			<div class="but">
				
			</div>
		</div>
	</div>
</template>
<script>
	export default { 
		data() {
			return {
				user:{}
			}
		},
		created() {
			const vm = this;
			vm.install();
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/user/show/' + vm.$route.params.id).then(response => {
					vm.user = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			update() {
				const vm = this;
				axios.post('api/admin/user/update/' + vm.$route.params.id,vm.user).then(response => {
					vm.$router.push({name:'Users'})
				}).catch(err => {
					console.log(err)
				})
			},
			
		}
	}
</script>