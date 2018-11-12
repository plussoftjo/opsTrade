<template>
	<div class="editPost">
		<div class="container" v-if="post">
			<div class="form-group">
				<label for="post">Post Content</label>
				<textarea id="post" rows="10" class="form-control" v-model="post.content"></textarea>
			</div>
			<div class="row">
				<div class="col-md-6">
					<button class="btn btn-success btn-block"  @click="update">Edit</button>
				</div>
				<div class="col-md-6">
					<button class="btn btn-info btn-block white-text text-white" @click="$router.push({name:'post',params:{id:post.id}})">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				post:{}
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('/api/admin/post/show/' + vm.$route.params.id).then(response => {
					vm.post = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			update() {
				const vm = this;
				axios.post('/api/admin/post/update/' + vm.$route.params.id,{post:vm.post.content}).then(response => {
					vm.$router.push({name:'post',params:{id:vm.post.id}});
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created(){
			const vm = this;
			vm.install();
		}
	}
</script>