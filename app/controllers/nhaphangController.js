// đăng kí controller cho app chính
(function(app) {
    app.controller('nhaphangController', function($scope, $http) {
        $scope.hanghoa = {}; // hàng hóa object
        $scope.LHH = { MaNhomCha: -1, CapDo: 0 }; // loại hàng hóa object
        $scope.NSX = {}; // nhà sản xuất object
        $scope.DV = {}; // đơn vị object
        $scope.Kho = {}; // kho object
        $scope.TonKho = {}; // tồn kho object
        $scope.NCC = {};

        $scope.PhieuNhap = {
            TongGiaNhap: 0,
            TongSoLuongNhap: 0
        }

        $scope.currentMinute = new Date();


        $scope.hanghoa_list = [];
        $scope.LHH_list = [];
        $scope.NSX_list = [];
        $scope.DV_list = [];
        $scope.NCC_list = [];
        $scope.Kho_list = [];
        $scope.invt_data = [];
        $scope.invt_update = [];
        $scope.ChiTietPhieuNhap = [];
        
        $scope.DaTra = "";

        $scope.reformatPayment = () => {
            $scope.PhieuNhap.DaTra = $scope.DaTra.replace(/\đ\s?|(\,*)/g, "");
        }

        window.onload = () => {
          
        };

        function loadKhoList(reload = false) {
            if ($scope.Kho_list.length === 0 || reload === true) {
                $http.get('kho/getList').then((Response) => {
                    $scope.Kho_list = Response.data;
                    $scope.Kho = $scope.Kho_list[0];
                });
            }
        }

        function loadNhaCungCap(){
            $http.get('nhacungcap/getList').then((Response)=>{
                if (Response.data) {
                  $scope.NCC_list = Response.data;  
                }
            });
        }

        $scope.TimNCC = () => {
            let searchKey = $scope.NCC_Search;
            let temp = $scope.NCC_list.find( (item)=>(
                (item.MaNCC===searchKey) ||(item.TenNCC.includes(searchKey))
            ));
            $scope.NCC = (temp !== undefined) ? temp : {};
        }

        /*
            $$hashKey: "object:8"
            GiaNhap: "5000000"            
            MaHH: "2"
            SLN: 1
            
        */
        $scope.ThanhToan = () => {
            let CTPN_temp = angular.copy($scope.ChiTietPhieuNhap);
            $scope.PhieuNhap.MaKho = $scope.Kho.MaKho;
            $scope.PhieuNhap.MaNCC = $scope.NCC.MaNCC;
            $scope.invt_update = [];
            $scope.PhieuNhap.ChiTietPhieuNhap = CTPN_temp.map(function(elem) {
                delete elem['MaDV'];                
                delete elem['MaLHH'];
                delete elem['MaNSX'];
                delete elem['TenDV'];
                delete elem['TenHH'];
                delete elem['TenLHH'];
                delete elem['TenNSX'];
                delete elem['TonKho'];
                delete elem['GiaBan'];
                delete elem['SLT'];
                $scope.invt_update.push({
                        MaKho:$scope.PhieuNhap['MaKho'],
                        MaHH:elem['MaHH'],
                        SoLuongNhap:elem['SLN']
                    });
                return elem;
            });


            $http.post('phieunhap/add', $scope.PhieuNhap).then((Response)=>{
                if(Response.data){
                    console.log("nhập thành công");
                    $http.post('tonkho/update',$scope.invt_update).then((Response)=>{
                        if(Response.data){
                            console.log(Response.data);
                        }
                    });
                }
            });


            $scope.loadHangHoaList();
            $scope.PhieuNhap = {
                TongGiaNhap: 0,
                TongSoLuongNhap: 0
            }
            $scope.ChiTietPhieuNhap = [];
        }

        // SLN sẽ lưu dô chi tiết lẫn tồn kho
        $scope.nhapKho = (hanghoa) => {
            const index = $scope.ChiTietPhieuNhap.indexOf(hanghoa);
            if (index != -1) {
                hanghoa = $scope.ChiTietPhieuNhap[index];
                hanghoa.SLN++;
                hanghoa.ThanhTien = (hanghoa.GiaNhap * hanghoa.SLN);
                $scope.PhieuNhap.TongGiaNhap += parseFloat(hanghoa.GiaNhap);
            } else {
                hanghoa.SLN = 1;
                hanghoa.ThanhTien = (hanghoa.GiaNhap * hanghoa.SLN);
                $scope.ChiTietPhieuNhap.push(hanghoa);
                $scope.PhieuNhap.TongGiaNhap += parseFloat(hanghoa.ThanhTien);
            }
            $scope.PhieuNhap.TongSoLuongNhap += 1;
        }

        $scope.updateCTPN = () => {
            $scope.PhieuNhap.TongSoLuongNhap = 0;
            $scope.PhieuNhap.TongGiaNhap = 0;
            angular.forEach($scope.ChiTietPhieuNhap, (hh) => {
                hh.ThanhTien = hh.GiaNhap * hh.SLN;
                $scope.PhieuNhap.TongGiaNhap += hh.ThanhTien;
                $scope.PhieuNhap.TongSoLuongNhap += hh.SLN;
            });
        }

        $scope.Xoa = function(hanghoa) {
            const index = $scope.ChiTietPhieuNhap.indexOf(hanghoa);
            if (index != -1) {
                const hanghoa = $scope.ChiTietPhieuNhap[index];
                $scope.PhieuNhap.TongGiaNhap -= hanghoa.ThanhTien;
                $scope.PhieuNhap.TongSoLuongNhap -= hanghoa.SLN;
                $scope.ChiTietPhieuNhap.splice(index, 1); // tạm biệt
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
                                    $http.get('tonkho/getIdPrdInventory/' + $scope.Kho.MaKho).then((invtResponse) => {
                                        if (invtResponse.data) {
                                            $scope.invt_data = invtResponse.data;
                                            $http.get('hanghoa/getList').then((Response) => {
                                                $scope.hanghoa_list = Response.data;
                                                $scope.hanghoa_list.forEach((hangHoa) => {
                                                    let LHH_temp = $scope.LHH_list.find((LHH) => LHH.MaLHH === hangHoa.MaLHH);
                                                    let NSX_temp = $scope.NSX_list.find((NSX) => NSX.MaNSX === hangHoa.MaNSX);
                                                    let DV_temp = $scope.DV_list.find((DV) => DV.MaDV === hangHoa.MaDV);
                                                    let SLT_temp = $scope.invt_data.find((invt) => invt.MaHH === hangHoa.MaHH);
                                                    hangHoa.TenLHH = (LHH_temp != undefined) ? LHH_temp.TenLHH : "";
                                                    hangHoa.TenNSX = (NSX_temp != undefined) ? NSX_temp.TenNSX : "";
                                                    hangHoa.TenDV = (DV_temp != undefined) ? DV_temp.TenDV : "";
                                                    hangHoa.SLT = (SLT_temp != undefined) ? SLT_temp.SoLuongTon : 0;
                                                });
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
        loadKhoList();
        loadNhaCungCap();
        $scope.loadHangHoaList();


        // load nhà cung cấp 
        // thanh toán
    });
})(angular.module('wmws_app'));