// đăng kí controller cho app chính
(function(app) {
    app.controller('donhangController', function($scope, $http) {
        $scope.hanghoa = {}; // hàng hóa object
        $scope.LHH = { MaNhomCha: -1, CapDo: 0 }; // loại hàng hóa object
        $scope.NSX = {}; // nhà sản xuất object
        $scope.DV = {}; // đơn vị object
        $scope.Kho = {}; // kho object
        $scope.TonKho = {}; // tồn kho object
        $scope.KH = {};

        $scope.PhieuXuat = {
            TongGiaBan: 0,
            TongSoLuongBan: 0
        }

        $scope.currentMinute = new Date();


        $scope.hanghoa_list = [];
        $scope.LHH_list = [];
        $scope.NSX_list = [];
        $scope.DV_list = [];
        $scope.KH_list = [];
        $scope.Kho_list = [];
        $scope.invt_data = [];
        $scope.invt_update = [];
        $scope.ChiTietPhieuXuat = [];

        $scope.DaTra = "";

        $scope.reformatPayment = () => {
            $scope.PhieuXuat.DaTra = $scope.DaTra.replace(/\đ\s?|(\,*)/g, "");
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
                                    $http.get('tonkho/getInventory/'+$scope.Kho.MaKho).then((Response) => {
                                        $scope.hanghoa_list = Response.data;
                                        $scope.hanghoa_list.forEach((hangHoa) => {
                                            let LHH_temp = $scope.LHH_list.find((LHH) => LHH.MaLHH === hangHoa.MaLHH);
                                            let NSX_temp = $scope.NSX_list.find((NSX) => NSX.MaNSX === hangHoa.MaNSX);
                                            let DV_temp = $scope.DV_list.find((DV) => DV.MaDV === hangHoa.MaDV);
                                            let SLT_temp = $scope.invt_data.find((invt) => invt.MaHH === hangHoa.MaHH);
                                            hangHoa.TenLHH = (LHH_temp != undefined) ? LHH_temp.TenLHH : "";
                                            hangHoa.TenNSX = (NSX_temp != undefined) ? NSX_temp.TenNSX : "";
                                            hangHoa.TenDV = (DV_temp != undefined) ? DV_temp.TenDV : "";                                            
                                        });
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }

        
        loadKhoList();
        loadKhachHangList();
        $scope.loadHangHoaList();

        
        function loadKhoList(reload = false) {
            if ($scope.Kho_list.length === 0 || reload === true) {
                $http.get('kho/getList').then((Response) => {
                    $scope.Kho_list = Response.data;
                    $scope.Kho = $scope.Kho_list[0];
                });
            }
        }

        function loadKhachHangList(){
            $http.get('khachhang/getList').then((Response)=>{
                if (Response.data) {
                  $scope.KH_list = Response.data;  
                }
            });
        }

        $scope.TimKH = () => {
            let searchKey = $scope.KH_Search;
            let temp = $scope.KH_list.find( (item)=>(
                (item.MaKH===searchKey) ||(item.TenKH.includes(searchKey))
            ));
            $scope.KH = (temp !== undefined) ? temp : {};
        }

        /*
            $$hashKey: "object:8"
            GiaBan: "5000000"            
            MaHH: "2"
            SLB: 1
            
        */
        $scope.ThanhToan = () => {
            let CTPN_temp = angular.copy($scope.ChiTietPhieuXuat);
            $scope.PhieuXuat.MaKho = $scope.Kho.MaKho;
            $scope.PhieuXuat.MaKH = $scope.KH.MaKH;
            $scope.invt_update = [];
            $scope.PhieuXuat.ChiTietPhieuXuat = CTPN_temp.map(function(elem) {
                delete elem['MaDV'];                
                delete elem['MaLHH'];
                delete elem['MaNSX'];
                delete elem['TenDV'];
                delete elem['TenHH'];
                delete elem['TenLHH'];
                delete elem['TenNSX'];
                delete elem['TonKho'];
                delete elem['GiaNhap'];
                delete elem['SLT'];
                $scope.invt_update.push({
                        MaKho:$scope.PhieuXuat['MaKho'],
                        MaHH:elem['MaHH'],
                        SoLuongBan:elem['SLB']
                    });
                return elem;
            });


            $http.post('PhieuXuat/add', $scope.PhieuXuat).then((Response)=>{
                if(Response.data){
                    console.log("nhập thành công");
                    $http.post('tonkho/update',$scope.invt_update).then((Response)=>{
                        if(Response.data){
                            console.log(Response.data);
                        }
                    });
                }
            });



            $scope.PhieuXuat = {
                TongGiaBan: 0,
                TongSoLuongBan: 0
            }
            $scope.ChiTietPhieuXuat = [];

        }

        // SLB sẽ lưu dô chi tiết lẫn tồn kho
        $scope.XuatKho = (hanghoa) => {
            const index = $scope.ChiTietPhieuXuat.indexOf(hanghoa);
            if (index != -1) {
                hanghoa = $scope.ChiTietPhieuXuat[index];
                if(( hanghoa.SoLuongTon - (hanghoa.SLB + 1)) >= 0){
                    hanghoa.SLB++;
                    hanghoa.ThanhTien = (hanghoa.GiaBan * hanghoa.SLB);
                    $scope.PhieuXuat.TongGiaBan += parseFloat(hanghoa.GiaBan);
                }
                else{
                    alert("Kho chỉ còn " + hanghoa.SoLuongTon + " sản phẩm này!");
                }
            } else {
                hanghoa.SLB = 1;
                if((hanghoa.SoLuongTon - (hanghoa.SLB)) >= 0){
                    hanghoa.ThanhTien = (hanghoa.GiaBan * hanghoa.SLB);
                    $scope.ChiTietPhieuXuat.push(hanghoa);
                    $scope.PhieuXuat.TongGiaBan += parseFloat(hanghoa.ThanhTien);
                }
                else{
                    alert("Kho chỉ còn " + hanghoa.SoLuongTon + " sản phẩm này!");   
                }
            }
            $scope.PhieuXuat.TongSoLuongBan += 1;
        }

        $scope.updateCTPX = () => {
            $scope.PhieuXuat.TongSoLuongBan = 0;
            $scope.PhieuXuat.TongGiaBan = 0;
            angular.forEach($scope.ChiTietPhieuXuat, (hh) => {
                hh.ThanhTien = hh.GiaBan * hh.SLB;
                $scope.PhieuXuat.TongGiaBan += hh.ThanhTien;
                $scope.PhieuXuat.TongSoLuongBan += hh.SLB;
            });
        }

        $scope.Xoa = function(hanghoa) {
            const index = $scope.ChiTietPhieuXuat.indexOf(hanghoa);
            if (index != -1) {
                const hanghoa = $scope.ChiTietPhieuXuat[index];
                $scope.PhieuXuat.TongGiaBan -= hanghoa.ThanhTien;
                $scope.PhieuXuat.TongSoLuongBan -= hanghoa.SLB;
                $scope.ChiTietPhieuXuat.splice(index, 1); // tạm biệt
            }
        }



        // load nhà cung cấp 
        // thanh toán
    });
})(angular.module('wmws_app'));