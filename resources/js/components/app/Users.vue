<template>
	<div class="users">

		<!-- SEARCH SECTION  -->
<!-- 		<div class="caxrd">
			<div class="form-group">
			    <label for="Search">Search</label>
			    <select class="form-control" id="search=" v-model="type">
			      <option value="0">By Name</option>
			      <option value="1">By Country</option>
			      <option value="2">By Catgoray</option>
			    </select>
			  </div>
		</div>
		
		<div v-if="type == '0'">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						 <input type="email" class="form-control" id="name" placeholder="Search With Name">
					</div>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-secondary btn-block">Seach</button>
				</div>
			</div>
			
		</div> -->

		<!-- Serch Section End -->
		

		<!-- USER TABLE TO GET  -->
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Phone</th>
		      <th scope="col">created at</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(d,index) in data" @click="$router.push({name:'Profile',params:{id:d.id}})">
		      <th scope="row">{{d.id}}</th>
		      <td>{{d.name}}</td>
		      <td>{{d.email}}</td>
		      <td>{{d.phone}}</td>
		      <td>{{d.created_at}}</td>
		    </tr>
		  </tbody>
		</table>
		<!-- END USER TAPLE -->

		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item" :class="{disabled: first}"><a class="page-link">Previous</a></li>
		    <li class="page-item" v-if="!first" @click="prev"><a class="page-link" >{{this_page - 1}}</a></li>
		    <li class="page-item active"><a class="page-link" >{{this_page}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link" >{{this_page + 1}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link">Next</a></li>
		  </ul>
		</nav>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				page:1,
				first:true,
				last_page:0,
				this_page:0,
				data:[],
				type:null

			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('/api/admin/user/index?page=' + vm.page).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					vm.page = vm.page + 1;

					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;


				}).catch(err => {
					console.log(err)
				})
			},
			prev() {
				const vm = this;
				vm.page = vm.page - 2;
				axios.get('/api/admin/user/index?page=' + vm.page).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					
					vm.page = vm.page + 1;
					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;



				}).catch(err => {
					console.log(err)
				})
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>