// đăng kí controller cho app chính
(function (app) {
    app.controller('doitacController', function ($scope, $http) {

        $scope.PN = {};
        $scope.PN_List = [];
        $scope.Kho_List = [];
        $scope.hanghoa_list = [];
        $scope.NCC_List = [];
        $scope.KH_List = [];
        $scope.PGD_List = [];

        $scope.NCC = {};
        $scope.KH = {};
        $scope.PGD = {};

        $scope.TongTien = 0;
        $scope.TongNo = 0; // tổng nợ

        function loadPhieuNhapList(timeFilter = null) {
            $http.get('nhacungcap/getList').then((NCCResponse) => {
                if (NCCResponse.data) {
                    $scope.NCC_List = NCCResponse.data;
                    $http.get('kho/getList').then((KhoResponse) => {
                        if (KhoResponse.data) {
                            $scope.Kho_list = KhoResponse.data;
                            let requestUrl = "phieunhap/getList";
                            if (timeFilter !== null && timeFilter !== undefined) {
                                requestUrl += "/" + timeFilter.start + "/" + timeFilter.end;
                            }
                            $http.post(requestUrl).then((Response) => {
                                if (Response.data) {
                                    $scope.PN_List = Response.data;
                                    angular.forEach($scope.PN_List, (PN) => {
                                        let NccTemp = $scope.NCC_List.find((ncc) => ncc.MaNCC === PN.MaNCC);
                                        let KhoTemp = $scope.Kho_list.find((kho) => kho.MaKho === PN.MaKho);
                                        PN.TenNCC = (NccTemp != undefined) ? NccTemp['TenNCC'] : "";
                                        PN.TenKho = (KhoTemp != undefined) ? KhoTemp['TenKho'] : "";
                                    });
                                }
                            });
                        }

                    });
                }
            });
        }


        $scope.xemChiTietPhieuNhap = (PhieuNhap) => {
            $scope.PN = PhieuNhap;
            $scope.PN.ChiTietPhieuNhap = $.parseJSON(PhieuNhap.ChiTietPhieuNhap);
            angular.forEach($scope.PN.ChiTietPhieuNhap, (item) => {
                let hangHoa = $scope.hanghoa_list.find((hh) => hh.MaHH === item.MaHH);
                item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
            });
            $http.get('nhacungcap/getByKey/' + $scope.PN.MaNCC).then((Response) => {
                if (Response.data) {
                    $scope.PN.NCC = Response.data;
                }
            });
        }

        $scope.chonTab = (doiTac) => {
            switch (doiTac) {
                case "KH": {
                    loadKHList();
                    break;
                }
                case "NCC": {
                    loadNCCList();
                    break;
                }
            }
        }

        function loadKHList(reload = false) {
            if ($scope.KH_List.length === 0 || reload === true) {
                $http.get('khachhang/listAllCalc').then((KHResponse) => {
                    if (KHResponse.data) {
                        $scope.KH_List = KHResponse.data;
                        $scope.TongTien = 0;
                        $scope.TongNo = 0;
                        angular.forEach($scope.KH_List, (item) => {
                            $scope.TongTien += (item.TongGiaBanCacPhieu !== null) ? parseFloat(item.TongGiaBanCacPhieu) : 0;
                            $scope.TongNo += (item.TongNoCacPhieu !== null) ? parseFloat(item.TongNoCacPhieu) : 0;
                        });
                    }
                });
            }

        }

        function loadNCCList(reload = false) {
            if ($scope.NCC_List.length === 0 || reload === true) {
                $http.get('nhacungcap/listAllCalc').then((NCCResponse) => {
                    if (NCCResponse.data) {
                        $scope.NCC_List = NCCResponse.data;
                        $scope.TongTien = 0;
                        $scope.TongNo = 0;
                        angular.forEach($scope.NCC_List, (item) => {
                            $scope.TongTien += (item.TongGiaNhapCacPhieu !== null) ? parseFloat(item.TongGiaNhapCacPhieu) : 0;
                            $scope.TongNo += (item.TongNoCacPhieu !== null) ? parseFloat(item.TongNoCacPhieu) : 0;
                        });
                    }
                });
            }
        }

        $scope.themDoiTac = (doiTac) => {
            postData = (doiTac === "khachhang") ? $scope.KH : $scope.NCC;
            delete postData['TongNoCacPhieu'];
            delete postData['TongGiaBanCacPhieu'];
            delete postData['TongGiaNhapCacPhieu'];
            $http.post(doiTac + '/add', postData).then((Response) => {
                if (Response.data) {
                    console.log("success");
                    if (doiTac === "khachhang") {
                        loadKHList(true);
                    } else {
                        loadNCCList(true);
                    }
                }
            });
        }


        $scope.suaDoiTac = (doiTac) => {
            postData = (doiTac === "khachhang") ? $scope.KH : $scope.NCC;
            delete postData['TongGiaNhapCacPhieu'];
            delete postData['TongGiaBanCacPhieu'];
            delete postData['TongNoCacPhieu'];
            var json = JSON.stringify(postData, function(key, value) {
                if (key === "$$hashKey") {
                    return undefined;
                }
                return value;
            });
            $http.post(doiTac + '/update', json).then((Response) => {
                if (Response.data) {
                    if (typeof Response.data === 'object') {
                        console.log("success");
                        if (doiTac === "khachhang") {
                            loadKHList(true);
                        } else {
                            loadNCCList(true);
                        }
                    }

                }
            });
        }


        $scope.taoDoiTac = (doiTac) => {
            switch (doiTac) {
                case "KH": {
                    $scope.title = "Tạo khách hàng";
                    $scope.TaoKH = true;
                    $scope.doiTac = "khách hàng";
                    break;
                }
                case "NCC": {
                    $scope.title = "Tạo nhà cung cấp";
                    $scope.TaoKH = false;
                    $scope.doiTac = "nhà cung cấp";
                    break;
                }
            }
            $scope.NCC = {};
            $scope.KH = {};
            $('#tao-doi-tac').modal('show');
        }


        $scope.xemChiTiet = (typeDoiTac, doiTac) => {
            $scope.view = true;
            switch (typeDoiTac) {
                case "KH": {
                    $scope.title = "XEM CHI TIẾT KHÁCH HÀNG";
                    $scope.XemKH = true;
                    $scope.doiTac = "khách hàng";
                    $scope.KH = doiTac;
                    $scope.LoaiGiaoDich = "Xuất"
                    $http.get('phieuxuat/getListByMaKH/' + doiTac.MaKH).then((Response) => {
                        if (Response.data) {
                            $scope.PGD_List = Response.data;
                        }
                    });
                    break;
                }
                case "NCC": {
                    $scope.title = "XEM CHI TIẾT NHÀ CUNG CẤP";
                    $scope.XemKH = false;
                    $scope.doiTac = "nhà cung cấp";
                    $scope.LoaiGiaoDich = "Nhập"
                    $scope.NCC = doiTac;
                    $http.get('phieunhap/getListByMaNCC/' + doiTac.MaNCC).then((Response) => {
                        if (Response.data) {
                            $scope.PGD_List = Response.data;
                        }
                    });

                    break;
                }
            }
            $('#xem-chi-tiet-doi-tac').modal('show');
        }

        // PGD : Phiếu Giao Dịch
        $scope.xemChiTietPGD = (PGD) => {

            $scope.PGD = PGD;
            if ($scope.XemKH) {
                if (typeof $scope.PGD.ChiTietPhieuXuat === 'string') {
                    $scope.PGD.ChiTietPhieuXuat = $.parseJSON(PGD.ChiTietPhieuXuat);
                }
                angular.forEach($scope.PGD.ChiTietPhieuXuat, (item) => {
                    let hangHoa = $scope.hanghoa_list.find((hh) => hh.MaHH === item.MaHH);
                    item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
                });
            } else {
                if (typeof $scope.PGD.ChiTietPhieuNhap === 'string') {
                    $scope.PGD.ChiTietPhieuNhap = $.parseJSON(PGD.ChiTietPhieuNhap);
                }
                angular.forEach($scope.PGD.ChiTietPhieuNhap, (item) => {
                    let hangHoa = $scope.hanghoa_list.find((hh) => hh.MaHH === item.MaHH);
                    item.TenHH = (hangHoa != undefined) ? hangHoa['TenHH'] : "";
                });
            }

            $('#CTPN').modal('show');
        }


        function loadHangHoa() {
            if ($scope.hanghoa_list.length === 0) {
                $http.get('hanghoa/getList').then((Response) => {
                    $scope.hanghoa_list = Response.data;
                });
            }
        }


        loadHangHoa();
        $scope.chonTab('KH');

    });

})(angular.module('wmws_app'));