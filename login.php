<!DOCTYPE html>
<html ng-app="mylogin">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Remember</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/angular.min.js" type="text/javascript"></script>
	<script src="https://code.angularjs.org/1.6.4/angular-cookies.js"></script>
	<script>
		var app = angular.module('mylogin',['ngCookies']);
		app.controller('loginController', ['$scope','$http','$cookies', function($scope,$http,$cookies){
			//khởi tạo ban đầu 
			//nếu có cookie sẵn chúng ta sẽ lấy ra và đưa vào ô textbox username và password nhé
			$scope.info = {
				remember:true, //chúng ta để mặc định là true nhé,tùy các các bạn nhé
				username:$cookies.get('user'),//lấy cookie có tên là user
				password:$cookies.get('key') // lấy cookie có tên là key
			}
			//đăng nhập
			$scope.login =  function(){
				$http.post('http://localhost/php_angular/xuly_login.php',{"username":$scope.info.username,"password":$scope.info.password},{'Content-Type': 'application/json'}).then(function(response){
					$scope.kq = response.data;
					console.log(response.data);
					if($scope.kq.success==1){
						alert("Bạn đăng nhập thành công!");
						//nếu đăng nhập thành công chúng ta xét người dùng có chọn remember hay không nhé
						//nếu người dùng remember thì ta tạo cookies nhé
						if($scope.info.remember==true){

							$cookies.put('user', $scope.info.username);//put cookie tên user
							$cookies.put('key', $scope.info.password);// put cookie tên key
						}
					}
					else if($scope.kq.success==2){
						alert("Bạn đang cố gắng đăng nhập!");
					}
					else if($scope.kq.success==3){
						alert("Đăng nhập không thành công!");
					}
					else{
						alert("Đăng nhập không thành công!");
					}
					location.reload();//reload lại trang 
				},function(response){});
			}
		}]);

	</script>
</head>
<body>
	<header></header>
	<div class="login" ng-controller="loginController">
		<div class="box_login">
			<h2 class="title_login">Login Remember</h2>
			<div class="col_login">
				<input type="text" name="username" ng-model="info.username"  class="txt_input"/>
				<span class="for_username">Username</span>
			</div>
			<div class="tt"></div>
			<div class="col_login">
				<input type="password" name="password" ng-model="info.password"  class="txt_input"/>
				<span class="for_password">Password</span>
			</div>
			<div class="col_login">
				<button class="login_aut" ng-click="login()">Login</button>
				<input type="checkbox" ng-model="info.remember"/>
				<label for="remember_aut">Remember me on this computer</label>
				
			</div>
		</div>
	</div>
</body>
</html>