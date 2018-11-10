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
				<div class="row">
					<div class="col-md-3" v-for="i in post.images">
						<img :src="'/images/posts/' + i" width="auto" height="150px" alt="">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				 <input type="file" v-on:change="onFileChange" class="form-control">
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
				post:{user:'',post:'',images:[]},
				users:[],
				image:'',
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
		      	axios.post('api/admin/post/uploadImage',{image:vm.image}).then(response =>{
		      		vm.post.images.push(response.data.image);
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      },
		},
		created() {
			const vm = this;
			vm.installUser();
		}
	}
</script>