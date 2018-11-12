<template>
	<div class="post">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-3">
						<img :src="'images/profile/orginal/' + post.user.avatar" width="75px" height="75px" alt="">
					</div>
					<div class="col-md-9">
						<div class="title">{{post.user.name}}</div>
						<div class="title">{{post.created_at}}</div>
						<div>
							<button class="btn btn-primary" @click="$router.push({name:'editPost',params:{id:post.id}})">Edit</button>
							<button class="btn btn-danger" @click="destroy(post.id)">Remove</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				{{post.content}}
			</div>
			<div class="images">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4" v-for="i in post.images">
							<img :src="'/images/posts/' + i.image" class="img-fluid" height="300px" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-title">
				<div class="title">
					Comments 
				</div>
			</div>
			<div class="card-body">
				<div class="card" v-for="(c,index) in post.comments">
					<div class="card-title">
						<div class="row">
							<div class="col-md-3">
								<img :src="'images/profile/orginal/' + c.user.avatar" width="50px" height="50px" alt="">
							</div>
							<div class="col-md-9">
								<div class="title">
									{{c.user.name}}
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						{{c.comment}}
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
			destroy(id) {
				const vm = this;
				confirm('Do you Want Delete ?') && axios.get('api/admin/post/destroy/' + id ).then(response => {
					vm.$router.push({name:'posts'})
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	.title{font-size: 24px; font-weight: 600;padding: 5px;}
</style>