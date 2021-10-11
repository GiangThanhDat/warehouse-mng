
// đăng kí controller cho app chính
(function (app) {
	app.controller('ThongTinCaNhanController', function($scope,$http,accountmngService) {
		$scope.accountInfor = accountmngService.getAccountInfor();
		$scope.accountInfor.create_date = new Date($scope.accountInfor.create_date);
		// Load Data

		$scope.updateAccount = ()=>{
			delete $scope.accountInfor['ID'];
			// delete $scope.accountInfor['ten_vaitro'];
		 	var json = JSON.stringify($scope.accountInfor, function( key, value ) {
		 		if( key === "$$hashKey" ) {
		 			return undefined;
		 		}
		 		return value;
		 	});
			 
			$http.post('User/update',$scope.accountInfor).then((response)=>{
				if (response) {
					
					$http.get('User/getAccountInfor/'+$scope.accountInfor.username).then((GetAccountResponse)=>{
						if (GetAccountResponse) {
							$scope.accountInfor = GetAccountResponse.data;
							accountmngService.setAccountInfor($scope.accountInfor);															
						}
					}, ()=>{
						console.debug("load fail");
					});					
				}
			},()=>{
				console.log("load fail");
			})
		}


	});
})(angular.module('wmws_app'));

