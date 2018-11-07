<template>
    <div class="app">
    	<div class="row">
    		<div class="col-md-3">
    			<ul class="list-group">
				  <li class="list-group-item active">ADMIN PANEL</li>
				  <li class="list-group-item" @click="$router.push({name:'dashboard'})">DASHBOARD</li>
				  <li class="list-group-item" @click="$router.push({name:'Users'})">USERS</li>
				  <li class="list-group-item" @click="$router.push({name:'SearchUser'})">Search User</li>
				  <li class="list-group-item"  @click="$router.push({name:'SearchPost'})">Search Post</li>
				  <li class="list-group-item"  @click="$router.push({name:'fakerUser'})">Faker User</li>
				  <li class="list-group-item"  @click="$router.push({name:'fakerPost'})">Faker Post</li>
				</ul>
    		</div>
    		<div class="col-md-9">
    			<nav class="navbar navbar-dark bg-dark">
				  <div class="navbar-brand">{{$route.name}}</div>
				</nav>
				<div class="container">
					<div class="card">
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
        }
    }
</script>
