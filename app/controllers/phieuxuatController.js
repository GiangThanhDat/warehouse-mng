// đăng kí controller cho app chính
(function(app) {
    app.controller('phieuxuatController', function($scope, $http, Excel) {
        //Date range as a button
        //mặc định là tuần hiện tại
        $scope.ngayDau = moment().startOf('week').format("YYYY-MM-DD");
        $scope.ngayCuoi = moment().endOf('week').format("YYYY-MM-DD");
        $scope.fill = false;
        $scope.fillChartShow = true;

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
            loadPhieuXuatList(timeFilter);
        });

        $scope.PX = {};
        $scope.PX_List = [];
        $scope.Kho_List = [];
        $scope.hanghoa_list = [];
        $scope.KH_List = [];

        function loadPhieuXuatList(timeFilter=null)
        {
            $http.get('khachhang/getList').then((KHResponse)=>{
                if(KHResponse.data){
                    $scope.KH_List = KHResponse.data;
                    $http.get('kho/getList').then((KhoResponse) => {
                        if(KhoResponse.data){
                            $scope.Kho_list = KhoResponse.data;
                            let requestUrl = "PhieuXuat/getList";
                            if(timeFilter !== null && timeFilter !== undefined){
                                requestUrl += "/" + timeFilter.start + "/" + timeFilter.end;
                            }
                            $http.post(requestUrl).then((Response)=>{
                                if(Response.data){
                                    $scope.PX_List = Response.data;
                                    angular.forEach($scope.PX_List, (PX)=>{
                                        let khTemp = $scope.KH_List.find((kh)=>kh.MaKH===PX.MaKH);
                                        let KhoTemp = $scope.Kho_list.find((kho)=>kho.MaKho===PX.MaKho);
                                        PX.TenKH = (khTemp != undefined) ? khTemp['TenKH'] : "";
                                        PX.TenKho = (KhoTemp != undefined) ? KhoTemp['TenKho'] : "";                                        
                                    });
                                    taoDuLieuXuatExcel();
                                }
                            });
                        }
                        
                    });
                }
            });
        }        

        taoDuLieuXuatExcel = () => {
            let pxListTemp = [];
            angular.copy($scope.PX_List, pxListTemp);
            $scope.exportData = pxListTemp.map(PhieuXuat => {
                if(typeof PhieuXuat.ChiTietPhieuXuat === 'string' ){
                    PhieuXuat.ChiTietPhieuXuat = $.parseJSON(PhieuXuat.ChiTietPhieuXuat);    
                }
                angular.forEach(PhieuXuat.ChiTietPhieuXuat,(item)=>{
                    let hangHoa = $scope.hanghoa_list.find((hh)=>hh.MaHH===item.MaHH);
                    item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
                });
                return PhieuXuat;
            })
        }

        

        $scope.xuatExcel = () => { // ex: '0'	
            taoDuLieuXuatExcel();
            // console.log("[exportData]", $scope.exportData);
            var exportHref=Excel.tableToExcel("#danh-sach-phieu-xuat","Danh sach phieu xuat");				
            // location.href=exportHref; // trigger download
        }	


        $scope.xemChiTietPhieuXuat = (PhieuXuat)=>{
            $scope.PX = PhieuXuat;      
            if(typeof PhieuXuat.ChiTietPhieuXuat === 'string' ){
                $scope.PX.ChiTietPhieuXuat = $.parseJSON(PhieuXuat.ChiTietPhieuXuat);    
            }
            angular.forEach($scope.PX.ChiTietPhieuXuat,(item)=>{
                let hangHoa = $scope.hanghoa_list.find((hh)=>hh.MaHH===item.MaHH);
                item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
            });
            $http.get('khachhang/getByKey/'+$scope.PX.MaKH).then((Response)=>{
                if(Response.data){
                    $scope.PX.KH = Response.data;
                }
            });
        }



        function loadHangHoa(){
            $http.get('hanghoa/getList').then((Response) => {
                $scope.hanghoa_list = Response.data;            
            });
        }

        window.onload = () => {

        }

        loadHangHoa();
        loadPhieuXuatList();
    });

})(angular.module('wmws_app'));