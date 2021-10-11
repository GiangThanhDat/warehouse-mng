// đăng kí controller cho app chính
(function(app) {
    app.controller('phieunhapController', function($scope, $http, Excel) {
        //Date range as a button
        //mặc định là tuần hiện tại
        $scope.ngayDau = moment().startOf('week').format("YYYY-MM-DD");
        $scope.ngayCuoi = moment().endOf('week').format("YYYY-MM-DD");

        $('#daterange-btn').daterangepicker({
            ranges: {
                'Hôm nay': [moment(), moment()],
                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Ngày qua': [moment().subtract(6, 'days'), moment()],
                '30 ngày qua': [moment().subtract(29, 'days'), moment()],
                'Tuần này': [moment().startOf('week'), moment().endOf('week')],
                'Tuần trước': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().startOf('week'),
            endDate: moment().endOf('week')
        }, function(start, end) {

            let timeFilter = {
                start :start.format("YYYY-MM-DD"),
                end   :end.format('YYYY-MM-DD')
             }
            loadPhieuNhapList(timeFilter);
        });

        $scope.PN = {};
        $scope.PN_List = [];
        $scope.Kho_List = [];
        $scope.hanghoa_list = [];
        $scope.NCC_List = [];

        function loadPhieuNhapList(timeFilter=null)
        {
            $http.get('nhacungcap/getList').then((NCCResponse)=>{
                if(NCCResponse.data){
                    $scope.NCC_List = NCCResponse.data;
                    $http.get('kho/getList').then((KhoResponse) => {
                        if(KhoResponse.data){
                            $scope.Kho_list = KhoResponse.data;
                            let requestUrl = "phieunhap/getList";
                            if(timeFilter !== null && timeFilter !== undefined){
                                requestUrl += "/" + timeFilter.start + "/" + timeFilter.end;
                            }
                            $http.post(requestUrl).then((Response)=>{
                                if(Response.data){
                                    $scope.PN_List = Response.data;
                                    angular.forEach($scope.PN_List, (PN)=>{
                                        let NccTemp = $scope.NCC_List.find((ncc)=>ncc.MaNCC===PN.MaNCC);
                                        let KhoTemp = $scope.Kho_list.find((kho)=>kho.MaKho===PN.MaKho);
                                        PN.TenNCC = (NccTemp != undefined) ? NccTemp['TenNCC'] : "";
                                        PN.TenKho = (KhoTemp != undefined) ? KhoTemp['TenKho'] : "";                                        
                                    });
                                     taoDuLieuXuatExcel();
                                }
                            });
                        }
                        
                    });
                }
            });
        }        


        $scope.xemChiTietPhieuNhap = (PhieuNhap)=>{
            $scope.PN = PhieuNhap;      
            if(typeof PhieuNhap.ChiTietPhieuNhap === 'string'){
                $scope.PN.ChiTietPhieuNhap = $.parseJSON(PhieuNhap.ChiTietPhieuNhap);    
            }            
            angular.forEach($scope.PN.ChiTietPhieuNhap,(item)=>{
                let hangHoa = $scope.hanghoa_list.find((hh)=>hh.MaHH===item.MaHH);
                item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
            });
            $http.get('nhacungcap/getByKey/'+$scope.PN.MaNCC).then((Response)=>{
                if(Response.data){
                    $scope.PN.NCC = Response.data;
                }
            });
        }


        taoDuLieuXuatExcel = () => {
            let pnListTemp = [];
            angular.copy($scope.PN_List, pnListTemp);
            $scope.exportData = pnListTemp.map(PhieuNhap => {
                if(typeof PhieuNhap.ChiTietPhieuNhap === 'string' ){
                    PhieuNhap.ChiTietPhieuNhap = $.parseJSON(PhieuNhap.ChiTietPhieuNhap);    
                }
                angular.forEach(PhieuNhap.ChiTietPhieuNhap,(item)=>{
                    let hangHoa = $scope.hanghoa_list.find((hh)=>hh.MaHH===item.MaHH);
                    item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
                });
                return PhieuNhap;
            })
        }

        

        $scope.xuatExcel = () => { // ex: '0'	
            taoDuLieuXuatExcel();
            // console.log("[exportData]", $scope.exportData);
            var exportHref=Excel.tableToExcel("#danh-sach-phieu-nhap","Danh sach phieu nhap");				
            // location.href=exportHref; // trigger download
        }	

        function loadHangHoa(){
            $http.get('hanghoa/getList').then((Response) => {
                $scope.hanghoa_list = Response.data;            
            });
        }

        window.onload = () => {

        }

        loadHangHoa();
        loadPhieuNhapList();

    });

})(angular.module('wmws_app'));