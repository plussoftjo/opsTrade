<template>
	<div class="fakerPost">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="user">User</label>
					<select id="user" v-model="post.user" class="form-control">
						<option v-for="user in users" :value="user.id">{{user.name}}</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="post">Post</label>
					<textarea class="form-control" v-model="post.post" cols="10" rows="10"></textarea>
				</div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success btn-block" @click="store">Store</button>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				post:{user:'',post:''},
				users:[]
			}
		},
		methods:{
			installUser() {
				const vm = this;
				axios.get('api/admin/faker/getUser').then(response => {
					vm.users = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			store(){
				const vm = this;
				axios.post('/api/admin/faker/post',vm.post).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err);
				});
			}
		},
		created() {
			const vm = this;
			vm.installUser();
		}
	}
</script>