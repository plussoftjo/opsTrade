<template>
	<div class="users">

		<!-- USER TABLE TO GET  -->
		<table class="table table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">post</th>
		      <th scope="col">catg</th>
		      <th scope="col">User</th>
		      <th scope="col">created at</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(d,index) in data" @click="$router.push({name:'post',params:{id:d.id}})">
		      <th scope="row">{{d.id}}</th>
		      <td>{{d.content}}</td>
		      <td>{{d.catg}}</td>
		      <td>{{d.user.name}}</td>
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
				axios.get('/api/admin/post/index?page=' + vm.page).then(response => {
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
				axios.get('/api/admin/post/index?page=' + vm.page).then(response => {
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