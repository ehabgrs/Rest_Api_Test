<script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<button id ="get_main_categories" > get_main_categories </button>
<button id ="admin" > Admin </button>
<button id ="admin_login" > Admin login </button>
<button id ="admin_logout" > Admin logout </button>
<button id ="user_login" > User login </button>
<button id ="user" > User</button>
<button id ="user_logout" > User logout </button>

<script>
	$(document).on('click','#get_main_categories',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/get_main_categories',
			data : {
				'api_password' : '123456789',
				'lang'         : 'ar'
			},
			success : function(data){
				console.log(data);
			}
		});
	})
	var api_token = '';
	$(document).on('click','#admin_login',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/admin/login',
			data : {
				'api_password' : '123456789',
				'lang'         : 'ar',
				'email'        : 'h@h.com',
				'password'     : '123456789'
			},
			success : function(data){
				console.log(data);
				api_token = data.admin.api_token; 
			}
		});
	});
	
	$(document).on('click','#admin',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/admin',
			headers: { 
				'auth-token': api_token, 
			}, 
			data : {
				'api_password' : '123456789',
				'lang'         : 'ar'
			},
			success : function(data){
				console.log(data);
			}
		});
	});
	
	
	
	$(document).on('click','#admin_logout',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/admin/logout',
			headers: { 
				'auth-token': api_token, 
			},
			data : {
				'api_password' : '123456789',
				'lang'         : 'ar',
			},
			success : function(data){
				console.log(data);
			}
		});
	});
	

	var user_api_token ='';
	
	$(document).on('click','#user_login',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/user/login',
			data : {
				'email': 'user@h.com',
				'password' : '123456789',
			},
			success : function(data) {
				console.log(data);
				user_api_token = data.user.api_token;
			},
		});
	});
	
	$(document).on('click','#user',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/user',
			headers: { 
				'auth-token': user_api_token, 
			},
			data : {
				 
			},
			success : function(data) {
				console.log(data);
			},
		});
	});
	
	$(document).on('click','#user_logout',function(){
		$.ajax({
			type : 'post',
			url  : 'http://143.244.154.92/api/user/logout',
			headers: { 
				'auth-token': user_api_token, 
			},
			data : {
				
			},
			success : function(data) {
				console.log(data);
			},
		});
	});
	
	
</script>