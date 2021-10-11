
// đăng kí controller cho app chính
(function (app) {
	app.controller('PhanQuyenNguoiDungController', function($scope,$http,accountmngService) {
		$scope.accountInfor = accountmngService.getAccountInfor();
		// tìm cách xử lý tick chức năng
		var getListTasksByRole = (ma_vaitro)=>{
			$http.get('ChucNang/getListTasksByRole/'+ma_vaitro).then((response)=>{
				if (response.data) {
					$scope.roles = response.data;
					accountmngService.setRoles($scope.roles);
				}
			});
		} 

		function getController(){
			let url = window.location.href;
			let urlSplit = url.split('/');
			$scope.controllerName = urlSplit[urlSplit.length-1];
			
		}

		 
		getController();
		console.log($scope.controllerName);
		
		
		// getListTasksByRole($scope.accountInfor.ma_vaitro);

		$scope.checkRoles = (taskName)=>{
			return (taskName && ($scope.roles!=undefined)) ? ($scope.roles.find(task=>task.ten_chucnang===taskName)) : null;
		}

	});
})(angular.module('wmws_app'));

