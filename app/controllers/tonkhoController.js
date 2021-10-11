// đăng kí controller cho app chính
(function(app) {
    app.controller('tonkhoController', function($scope, $http) {

        $scope.hanghoa = {}; // hàng hóa object
        $scope.LHH = { MaNhomCha: -1, CapDo: 0 }; // loại hàng hóa object
        $scope.NSX = {}; // nhà sản xuất object
        $scope.DV = {}; // đơn vị object
        $scope.Kho = {MaKho:""}; // kho object
        $scope.TonKho = {} // tồn kho object
        $scope.filterPrd = {MaLHH:"",MaNSX:""};
        $scope.currentMinute = new Date();


        $scope.hanghoa_list = [];
        $scope.LHH_list = [];
        $scope.NSX_list = [];
        $scope.DV_list = [];
        $scope.Kho_list = [];

        $scope.editKho = [];



        $scope.disableEdit = false;

        $scope.disableEditFunc = (status)=>{
            $scope.disableEdit = status;
        }
        window.onload = () => {
            
        };
      

        function loadKhoList(reload = false) {
            if ($scope.Kho_list.length === 0 || reload === true) {
                $http.get('kho/getList').then((Response) => {
                    $scope.Kho_list = Response.data;                    
                    $scope.editKho = Array.from({length:  $scope.Kho_list.length}, (_, id) => (false));
                });
            }
        }


        $scope.loadHangHoaList = () => {
            $http.get('loaihanghoa/getList').then((LHHResponse) => {
                if (LHHResponse.data) {
                    $scope.LHH_list = LHHResponse.data;
                    $http.get('nhasanxuat/getList').then((NSXResponse) => {
                        if (NSXResponse.data) {
                            $scope.NSX_list = NSXResponse.data;
                            $http.get('donvi/getList').then((DVResponse) => {
                                if (DVResponse.data) {
                                    $scope.DV_list = DVResponse.data;
                                    let requestApi = 'tonkho/getInventory';
                                    // cột nào không muốn lọc thì gán giá trị -1
                                    requestApi += ( $scope.Kho.MaKho !== ""  ) ? "/" + $scope.Kho.MaKho : "/-1";
                                    requestApi += ($scope.filterPrd.MaLHH !== "") ? "/" + $scope.filterPrd.MaLHH : "/-1";
                                    requestApi += ($scope.filterPrd.MaNSX !== "") ? "/" + $scope.filterPrd.MaNSX : "/-1";                                    
                                    $http.get(requestApi).then((Response) => {
                                        $scope.hanghoa_list = Response.data;
                                        let TongSoLuongTon_temp = 0;
                                        let TongVonTonKho_temp = 0;
                                        let TongGiaTriTon_temp = 0;
                                        $scope.hanghoa_list.forEach((hangHoa) => {
                                            let LHH_temp = $scope.LHH_list.find((LHH) => LHH.MaLHH === hangHoa.MaLHH);
                                            let NSX_temp = $scope.NSX_list.find((NSX) => NSX.MaNSX === hangHoa.MaNSX);
                                            let DV_temp = $scope.DV_list.find((DV) => DV.MaDV === hangHoa.MaDV);
                                            hangHoa.TenLHH = (LHH_temp != undefined) ? LHH_temp.TenLHH : "";
                                            hangHoa.TenNSX = (NSX_temp != undefined) ? NSX_temp.TenNSX : "";
                                            hangHoa.TenDV = (DV_temp != undefined) ? DV_temp.TenDV : "";
                                            TongSoLuongTon_temp += parseInt(hangHoa.TongSoLuongTon);
                                            TongVonTonKho_temp += parseInt(hangHoa.VonTonKho);
                                            TongGiaTriTon_temp += parseInt(hangHoa.GiaTriTon);
                                        });
                                        $scope.TongSoLuongTon = TongSoLuongTon_temp;
                                        $scope.TongVonTonKho = TongVonTonKho_temp;
                                        $scope.TongGiaTriTon = TongGiaTriTon_temp;
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }



        $scope.danhSachKho = ()=>{
            $('#kho-list').modal('show');
        }




        $scope.themKho = () => {
            delete $scope.Kho['MaKho'];
            $http.post('Kho/add', $scope.Kho).then((response) => {
                // console.log(response);
                $('#kho-list').modal('hide');
                alert('Thao tát hoàn tất');
                loadKhoList(true); // allow reload
            });
        }


        $scope.suaKho = (LHHEdit)=>{
            var editJson = JSON.stringify(LHHEdit, function( key, value ) {
                if( key === "$$hashKey" ) {
                    return undefined;
                }
                return value;
            });
            $http.post('Kho/update', editJson).then((Response)=>{
                if(Response.data){
                    loadKhoList(true); // allow reload
                }
            });
        }


        $scope.xoaKho = (MaLHH) =>{
            if(confirm("Bạn thật sự muốn thực hiện thao tác này?")){
                $http.get('Kho/remove/'+MaLHH ).then((Response)=>{
                    if(Response.data){
                        loadKhoList(true);
                    }
                });
            }
        }
        loadKhoList();
        $scope.loadHangHoaList();

    });

})(angular.module('wmws_app'));