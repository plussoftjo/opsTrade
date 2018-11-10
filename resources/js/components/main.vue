<template>
    <div class="app">
    	<div class="container-fluid">
     	<div class="row">
    		<div class="col-md-3">
    			<ul class="list-group">
				  <li class="list-group-item active">ADMIN PANEL</li>
				  <li class="list-group-item" @click="$router.push({name:'dashboard'})">Dashboard</li>
				  <li class="list-group-item" @click="$router.push({name:'Users'})">Users</li>
				  <li class="list-group-item" @click="$router.push({name:'posts'})">Posts</li>
				  <li class="list-group-item" @click="$router.push({name:'SearchUser'})">Search User</li>
				  <li class="list-group-item"  @click="$router.push({name:'SearchPost'})">Search Post</li>
				  <li class="list-group-item"  @click="$router.push({name:'fakerUser'})">Faker User</li>
				  <li class="list-group-item"  @click="$router.push({name:'fakerPost'})">Faker Post</li>
				  <li class="list-group-item"  @click="$router.push({name:'newMessage'})">newMessage</li>
				  <li class="list-group-item"  @click="$router.push({name:'messages'})">messages</li>
				</ul>
    		</div>
    		<div class="col-md-9">
					<div class="card">
						<div class="card-header">
							<div class="ctitle">
								{{$route.name}}
							</div>
						</div>
						<div class="card-body">
						 <router-view></router-view>
						</div>
					</div>
    		</div>
    	</div>   		
    	</div>

       
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
        	return {
        
        	}
        }
    }
</script>

<style>
	.ctitle{font-size: 20px; font-weight: 900; }
	.list-group-item{cursor: pointer; transition: all 0.3s;}
	.list-group-item:hover { background-color: rgba(0,0,0,0.09); color: white;}
</style>