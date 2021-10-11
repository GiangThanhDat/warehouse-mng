
// đăng kí controller cho app chính
(function (app) {
	app.controller('DangNhapController', function($scope,$http,$window,accountmngService) {
		$scope.user = {};	
		accountmngService.clearCookieData();	
		$('#errorMessage').hide();	
		//khi mà nhấn dăng nahp65 là hàm này chạy liền nè
		$scope.DangNhap = ()=>{
			// gửi post request lên server nè User/DangNhap
		// dữ liệu kèm theo request là $scope.user
		// mà scope user nó chứa cái gì nó chứa fk
		// để debug cho m hiểu


		// làm giống v được rne2
	
			$http.post('User/DangNhap', $scope.user).then((response)=>{				
				if (response.data) {	
					let username = response.data.trim();
					if (username === "") 
						$('#errorMessage').show('slow/400/fast');				
					else{
						$http.get('User/getAccountInfor/'+username).then((response)=>{
							if (response) {
								$scope.accountInfor = response.data;
								accountmngService.setAccountInfor($scope.accountInfor);								
								// window.location.href = 'TongQuan';
								window.location.href = 'trangchu';
							}
						}, ()=>{
							console.debug("load fail");
						});
						
					}
				}
			}, ()=>{
				console.log('load fail');
			}); 
		}
	});
})(angular.module('wmws_app'));

