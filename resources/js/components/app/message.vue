<template>
	<div class="message">
				<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Type Message" v-model="message">
				</div>
			</div>
			<div class="col-md-4">
				<button class="btn btn-primary btn-block" @click="store">Send Message</button>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row" v-for="message in messages">
							<div class="col-md-12">
								<div class="card    titMessage" v-if="!message.user" style="float: left; min-width: 400px; margin-top: 10px;">
									<div class="card-header">
										<div class="row">
										<div class="col-md-3">
											<div class="name">
												
											</div>
										</div>
										<div class="col-md-9">
											<div class="pad" style="padding: 5px;">
												ADMIN
											</div>
										</div>
									</div>
									
									</div>
									<div class="card-body">
										<div class="row ">
										<div class="col-md-12">
											<div class="pad" style="padding: 5px;">
											{{message.message}}
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="card  titMessage" v-else style="float: right; min-width: 400px; margin-top: 10px;">
									<div class="card-header">
										<div class="row">
										<div class="col-md-9">
											<div class="name" style="padding-top:10px;">
												{{message.user.name}}
											</div>
										</div>
										<div class="col-md-3 ">
											<div class="pad" style="padding: 5px;">
												<img :src="'/images/profile/orginal/' + message.user.avatar" height="50px" width="50px" alt="">
											</div>
										</div>
									</div>
									</div>
									<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="pad" style="padding: 5px;">
											{{message.message}}
											</div>
										</div>
									</div>
									</div>
								</div>
								<div style="clear: both;"></div>
							</div>
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
				messages:[],
				message:''
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/message/show/' + vm.$route.params.id).then(response => {
					vm.messages = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			store() {
				const vm = this;
				axios.post('api/admin/message/store/'+ vm.$route.params.id,{message:vm.message}).then(response => {
					location.reload();
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
	.titMessage{font-size: 18px; font-weight: 800;}
</style>