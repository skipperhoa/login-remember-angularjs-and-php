<!DOCTYPE html>
<html ng-app="demoapp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh sách sinh viên</title>
	<script src="js/angular.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/style.css">
	<script>
	var app = angular.module('demoapp',[]);
	app.controller('myController',['$scope','$http',function($scope,$http){

		//dung $http để gọi phương thức nhé
		$http.get('http://localhost/php_angular/load_dssv.php').then(function(response){
			$scope.data = response.data;
			//test thử xem nó hoạt động chưa nhé
			console.log(response.data);//vậy là hoạt động xong rồi
		},function(response){});

	}]);

	</script>
</head>
<body>
	<header>	
	</header>
	<section ng-controller="myController">
			<table class="table" border="0" cellpadding="0" cellspacing="0">
				<caption>Danh sách sinh viên</caption>	
				<thead>
					<tr>
						<th>STT</th>
						<th>MASV</th>
						<th>Tên SV</th>
						<th>Phái</th>
						<th>Sửa</th>
						<th>Xóa</th>
					</tr>
				</thead>
				<tbody>
					
					<tr ng-repeat="rowsv in data.sv track by $index">
						<td>{{$index+1}}</td>
						<td>{{rowsv.masv}}</td>
						<td>{{rowsv.tensv}}</td>
						<td>{{((rowsv.gioitinh==1)?"Nam":"Nữ")}}</td>
						<td><a href="/sua_sv/{{rowsv.idsv}}">Sửa</a></td>
						<td><a href="/xoa_sv/{{rowsv.idsv}}">Xóa</td>
					</tr>
				</tbody>
			</table>
	</section>
</body>
</html>