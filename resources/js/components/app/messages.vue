<template>
	<div class="messages">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Add Users" v-model="message.users">
					</div>
				</div>
				<div class="col-md-4">
					<button class="btn btn-block btn-info white-text text-white" data-toggle="modal" data-target=".bd-example-modal-lg">+ Add</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<textarea class="form-control" placeholder="Message" v-model="message.message" rows="5"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-success btn-block" @click="store">Send Message</button>
				</div>
			</div>
		</div>






		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div id='Users'>
		      	<div class="card">
		      		<div class="card-header">
		      			<div class="card-title">
		      				Select Users
		      			</div>
		      		</div>
		      		<div class="card-body">
		      				<button class="btn btn-sm btn-info white-text text-white" @click="all">Select All</button>

		      			<div class="card">
		      				<div class="users">
		      					<div class="form-group form-check" v-for="user in users">
		      						<input type="checkbox" v-model="checkedNames" :value="user.id">
		      						<label for="userName">{{user.name}}</label>
		      					</div>
		      				</div>
		      			</div>
		      		</div>
		      	</div>
				  <br>
					<button class="btn btn-block btn-success" @click="() => {message.users = checkedNames; }" data-dismiss="modal">Save User</button>
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
				message:{users:[],message:''},
				users:[],
				checkedNames:[]
			}
		},
		created() {
			const vm = this;
			vm.install();

		},
		methods:{
			install() {
				const vm = this;
				axios.get('/api/admin/user/all').then(response => {
					vm.users = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			all() {
				const vm = this;
				vm.checkedNames = [];
				vm.users.forEach(trg => {
					vm.checkedNames.push(trg.id);
				});
			},
			store() {
				const vm = this
				axios.post('/api/admin/message/store',vm.message).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			}
		}
	}
</script>
<style>
	.users{max-height: 350px; overflow-x: scroll; }
</style>