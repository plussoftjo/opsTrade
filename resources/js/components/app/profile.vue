<template>
	<div class="profile" v-if="user">
		<div class="card" style="width: 100%;">
			<div class="row">
				<div class="col-md-4">
					<img :src="'images/profile/orginal/' + user.avatar" style="width: 100%; height: auto;" alt="">
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<div class="card-title">
							Name : {{user.name}}
						</div>
						<div class="card-title">
							Phone : {{user.phone}}
						</div>
						<div class="card-title">
							Email : {{user.email}}
						</div>
						<div class="card-title">
							created_at : {{user.created_at}}
						</div>
						<div class="card-title">
							country : {{user.profile.location}}
						</div>
						<div class="card-title">
							whatsapp : {{user.profile.whatsapp_id}}
						</div>
						<div class="card-title">
							weChat : {{user.profile.wechat_id}}
						</div>
						<div class="card-title">
							About: {{user.profile.about}}
						</div>
						<div class="card-title">
							Catg : {{user.profile.catg}}
						</div>
						<div class="sendMessage">
							<button class="btn white--text text-white white-text btn-info "
							@click="$router.push({name:'message',params:{id:$route.params.id}})">
								Send Message
							</button>
							<button class="btn btn-primary" @click="$router.push({name:'editUser',params:{id:$route.params.id}})">Edit</button>
							<button class="btn btn-danger" @click="destroy_user(user.id)">Delete</button>
							<button class="btn btn-warning" @click="focs">Change Image</button>
							<div class="inputF">
								 <input type="file" v-on:change="onFileChange" class="form-control" ref="image">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card pd-2" style="padding-top: 10px;">
				<div class="container">
					<div class="card">
						<div class="card text-white bg-secondary mb-3" v-for="(post,index) in posts">
							<div class="card-title">
								<div>
									Post ID : {{post.id}} 
								</div>
								<div>
									Created_at : {{post.created_at}}
								</div>
								<div class="deleteBtn">
									<button type="button" class="btn btn-danger" @click="destroy(post.id)">Delete</button>
								</div>
							</div>
							<div class="card-body " @click="$router.push({name:'post',params:{id:post.id}})">
								{{post.content}}
							</div>
							<div class="row">
								<div class="col-md-3" v-for="(image,index) in post.images">
									<img class="card-img-top" :src="'images/posts/' +  image.image " width="100" height="100" alt="Card image cap">
								</div>
							</div>
							
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
				user:{},
				posts:[],
				image:''
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/user/show/' + vm.$route.params.id).then(response => {
					vm.user = response.data;
					vm.getPosts();
				}).catch(err => {
					console.log(err)
				});
			},
			getPosts() {
				const vm = this;
				axios.get('api/admin/user/posts/' + vm.user.id).then(response => {
					vm.posts =  response.data;
					console.log(response.data)
				}).catch(err => {
					console.log(err)
				});
			},
			destroy(id) {
				const vm = this;
				axios.get('api/admin/post/destroy/' + id).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			destroy_user(id) {
				const vm = this;
				confirm('Do you Want Delete ?') && axios.get('api/admin/user/destroy/' + id ).then(response => {
					vm.$router.push({name:'Users'})
				}).catch(err => {
					console.log(err)
				});
			},
			focs() {
				const vm = this;
				vm.$refs.image.click();
			},
			onFileChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.createImage(files[0]);
		      },
		      createImage(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		              vm.image = e.target.result;
		              vm.upload();
		          };
		          reader.readAsDataURL(file);
		      },
		      upload() {
		      	const vm = this;
		      	axios.post('/api/admin/user/update/image/' + vm.user.id,{image:vm.image}).then(response => {
		      		vm.user.avatar = response.data.image;
		      	}).catch(err => {
		      		console.log()
		      	});
		      },
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	.d-flex img{display: inline-block;}
	.deleteBtn{position: absolute; top:0px; right: 0px;}
	.sendMessage{position: absolute; right: 30px; bottom: 30px;}
	  .inputF {
        position: absolute;
        left: -99999px;
  		  }	
</style>