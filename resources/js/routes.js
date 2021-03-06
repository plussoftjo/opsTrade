import dashboard from './components/app/dashboard.vue'
import Users from './components/app/Users.vue'
import posts from './components/app/posts.vue'
import profile from './components/app/profile';
import searchUser from './components/app/searchUser'
import searchPost from './components/app/searchPost'
import post from './components/app/post'
import fakerUser from './components/app/fakerUser'
import fakerPost from './components/app/fakerPost'
import messages from './components/app/messages'
import getMessage from './components/app/getMessage'
import message from './components/app/message'
import editPost from './components/app/editPost'
import editUser from './components/app/editUser'

export const routes = [
	{
		path:'/',
		name:'dashboard',
		component:dashboard
	},
	{
		path:'/Users',
		name:'Users',
		component:Users
	},
	{
		path:'/Users/profile/:id',
		name:'Profile',
		component:profile
	},
	{
		path:'/search/user',
		name:'SearchUser',
		component:searchUser
	},
	{
		path:'/search/post',
		name:'SearchPost',
		component:searchPost
	},
	{
		path:'/post/:id',
		name:'post',
		component:post
	},
	{
		path:'/faker/user',
		name:'fakerUser',
		component:fakerUser
	},
	{
		path:'/faker/post',
		name:'fakerPost',
		component:fakerPost
	},
	{
		path:'/posts',
		name:'posts',
		component:posts
	},
	{
		path:'/messages',
		name:"newMessage",
		component:messages
	},
	{
		path:'/getMessage',
		name:'messages',
		component:getMessage
	},
	{
		path:'/message/:id',
		name:'message',
		component:message
	},
	{
		path:'/post/edit/:id',
		name:'editPost',
		component:editPost
	},
	{
		path:'/user/edit/:id',
		name:'editUser',
		component:editUser
	}
]