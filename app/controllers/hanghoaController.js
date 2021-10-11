// đăng kí controller cho app chính
(function (app) {
    app.controller('hanghoaController', function ($scope, $http) {

        $scope.hanghoa = {}; // hàng hóa object
        $scope.LHH = {}; // loại hàng hóa object
        $scope.NSX = {}; // nhà sản xuất object
        $scope.DV = {}; // đơn vị object
        $scope.Kho = {}; // kho object
        $scope.TonKho = {} // tồn kho object


        $scope.hanghoa_list = [];
        $scope.LHH_list = [];
        $scope.NSX_list = [];
        $scope.DV_list = [];
        $scope.Kho_list = [];
        $scope.productsQuantity = [];

        $scope.editLHH = [];
        $scope.editNSX = [];
        $scope.editDV = [];


        $scope.LHHDisableEdit = false;
        $scope.NSXDisableEdit = false;
        $scope.DVDisableEdit = false;

        $scope.giaBan = "";
        $scope.giaVon = "";

        $scope.nhapGiaVon = () => {
            $scope.hanghoa.GiaNhap = $scope.giaVon.replace(/\đ\s?|(\,*)/g, "");
        }

        $scope.nhapGiaBan = () => {
            $scope.hanghoa.GiaBan = $scope.giaBan.replace(/\đ\s?|(\,*)/g, "");
        }

        loadKhoList();
        loadHangHoaList();

        function loadLoaiHangHoaList(reload = false) {
            if ($scope.LHH_list.length === 0 || reload === true) {
                $http.get('loaihanghoa/getList').then((Response) => {
                    $scope.LHH_list = Response.data;
                    $scope.editLHH = Array.from({ length: $scope.LHH_list.length }, (_, id) => (false));
                });
            }
        }






        function loadNhaSanXuatList(reload = false) {
            if ($scope.NSX_list.length === 0 || reload === true) {
                $http.get('nhasanxuat/getList').then((Response) => {
                    $scope.NSX_list = Response.data;
                    $scope.editNSX = Array.from({ length: $scope.NSX_list.length }, (_, id) => (false));
                });
            }
        }

        function loadDonViList(reload = false) {
            if ($scope.DV_list.length === 0 || reload === true) {
                $http.get('donvi/getList').then((Response) => {
                    $scope.DV_list = Response.data;
                    $scope.editDV = Array.from({ length: $scope.DV_list.length }, (_, id) => (false));
                });
            }
        }

        function loadKhoList(reload = false) {
            if ($scope.Kho_list.length === 0 || reload === true) {
                $http.get('kho/getList').then((Response) => {
                    $scope.Kho_list = Response.data;
                });
            }
        }

        function getSoLuongTonKhoTungSanPham() {
            $http.get('tonkho/getProductsQuantity').then((Response) => {
                if (Response.data) {
                    $scope.productsQuantity = Response.data;
                }
            });
        }

        function loadHangHoaList() {
            $http.get('loaihanghoa/getList').then((LHHResponse) => {
                if (LHHResponse.data) {
                    $scope.LHH_list = LHHResponse.data;
                    $scope.editLHH = Array.from({ length: $scope.LHH_list.length }, (_, id) => (false));
                    console.log($scope.editLHH);
                    $http.get('nhasanxuat/getList').then((NSXResponse) => {
                        if (NSXResponse.data) {
                            $scope.NSX_list = NSXResponse.data;
                            $scope.editNSX = Array.from({ length: $scope.NSX_list.length }, (_, id) => (false));
                            $http.get('donvi/getList').then((DVResponse) => {
                                if (DVResponse.data) {
                                    $scope.DV_list = DVResponse.data;
                                    $scope.editDV = Array.from({ length: $scope.DV_list.length }, (_, id) => (false));
                                    $http.get('tonkho/getProductsQuantity').then((PQResponse) => {
                                        if (PQResponse.data) {
                                            $scope.productsQuantity = PQResponse.data;
                                            $http.get('hanghoa/getList').then((Response) => {
                                                $scope.hanghoa_list = Response.data;
                                                $scope.hanghoa_list.forEach((hangHoa) => {
                                                    let LHH_temp = $scope.LHH_list.find((LHH) => LHH.MaLHH === hangHoa.MaLHH);
                                                    let NSX_temp = $scope.NSX_list.find((NSX) => NSX.MaNSX === hangHoa.MaNSX);
                                                    let DV_temp = $scope.DV_list.find((DV) => DV.MaDV === hangHoa.MaDV);
                                                    let SLT_temp = $scope.productsQuantity.find((SLT) => SLT.MaHH === hangHoa.MaHH);
                                                    hangHoa.TenLHH = (LHH_temp != undefined) ? LHH_temp.TenLHH : "";
                                                    hangHoa.TenNSX = (NSX_temp != undefined) ? NSX_temp.TenNSX : "";
                                                    hangHoa.TenDV = (DV_temp != undefined) ? DV_temp.TenDV : "";
                                                    hangHoa.SLT = (SLT_temp != undefined) ? SLT_temp.SoLuongTon : "";
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

        $scope.toggleAll = function () {
            var toggleStatus = !$scope.isAllSelected;
            angular.forEach($scope.hanghoa_list, function (itm) { itm.selected = toggleStatus; });
        }

        $scope.optionToggled = function () {
            $scope.isAllSelected = $scope.hanghoa_list.every(function (itm) { return itm.selected; })
        }


        //
        $scope.taoHangHoa = () => {
            $scope.title = "TẠO SẢN PHẨM";
            $scope.create = true;
            $http.get('hanghoa/getLastID').then((Response) => {
                let newMaHH = 1;
                if (typeof Response.data === 'object' && Response.data !== null) {
                    newMaHH = parseInt(Response.data.MaHH) + 1;
                }
                $scope.hanghoa = { MaHH: newMaHH };
                $scope.TonKho.MaHH = newMaHH;

            }, (error) => {
                $scope.hanghoa = { MaHH: 1 };
            });

            $('#tao-san-pham').modal('show');
        }



        $scope.thietLapHangHoa = (MaHH) => {
            $scope.title = "THIẾT LẬP SẢN PHẨM";
            $scope.create = false;
            $scope.hanghoa = $scope.hanghoa_list.find(hangHoa => hangHoa.MaHH === MaHH);
            $scope.giaVon = $scope.hanghoa.GiaNhap;
            $scope.giaBan = $scope.hanghoa.GiaBan;
            $('#tao-san-pham').modal('show');
        }


        $scope.themHangHoa = () => {
            $http.post('hanghoa/add', $scope.hanghoa).then((response) => {
                if (response.data) {
                    $http.post('tonkho/add', $scope.TonKho).then((tonKhoResponse) => {
                        if (tonKhoResponse.data) {
                            $('#tao-san-pham').modal('hide');
                            alert("Tạo sản phẩm hoàn tất");
                            loadHangHoaList();
                        }
                    });
                }
            });
        }

        $scope.suaHangHoa = () => {
            let temp = angular.copy($scope.hanghoa);
            delete temp['TenLHH'];
            delete temp['TenNSX'];
            delete temp['TenDV'];
            delete temp['SLT'];
            var json = JSON.stringify(temp, function (key, value) {
                if (key === "$$hashKey") {
                    return undefined;
                }
                return value;
            });

            $http.post('hanghoa/update', json).then(function (response) {
                if (response.data) {
                    $('#tao-san-pham').modal('hide');
                    // alert("Thiết lập hoàn tất");
                    loadHangHoaList();
                }
            });
        }

        $scope.xoaHangHoa = () => {
            if (confirm("Xác nhận thực hiện thao tác")) {
                angular.forEach($scope.hanghoa_list, (hangHoa) => {
                    if (hangHoa.selected === true) {
                        $http.put('hanghoa/remove/' + hangHoa.MaHH).then((Response) => {
                            console.log(Response);
                        });
                    }
                });
                loadHangHoaList();
            }
        }



        $scope.themLoaiHangHoa = () => {
            $http.post('loaihanghoa/add', $scope.LHH).then((response) => {
                // console.log(response);
                $('#tao-loai-hang').modal('hide');
                alert('Thao tát hoàn tất');
                loadLoaiHangHoaList(true); // allow reload
            });
        }


        $scope.LHHDisableEditFunc = (status) => {
            $scope.LHHDisableEdit = status;
        }

        $scope.suaLoaiHangHoa = (LHHEdit) => {
            var editJson = JSON.stringify(LHHEdit, function (key, value) {
                if (key === "$$hashKey") {
                    return undefined;
                }
                return value;
            });
            $http.post('loaihanghoa/update', editJson).then((Response) => {
                if (Response.data) {
                    loadLoaiHangHoaList(true); // allow reload
                }
            });
        }



        $scope.xoaLoaiHangHoa = (MaLHH) => {
            let dongYXoa = confirm("Bạn có đồng ý xóa loại hàng hóa này?");
            if (dongYXoa === true) {
                $http.get('loaihanghoa/remove/' + MaLHH).then((Response) => {
                    if (Response.data) {
                        loadLoaiHangHoaList(true);
                    }
                });
            }

        }




        $scope.themNhaSanXuat = () => {
            $http.post('nhasanxuat/add', $scope.NSX).then((response) => {
                $('#tao-nha-san-xuat').modal('hide');
                alert('Thao tát hoàn tất');
                loadNhaSanXuatList(true);
            });
        }


        $scope.NSXDisableEditFunc = (status) => {
            $scope.NSXDisableEdit = status;
        }

        $scope.suaNhaSanXuat = (NSXEdit) => {
            var editJson = JSON.stringify(NSXEdit, function (key, value) {
                if (key === "$$hashKey") {
                    return undefined;
                }
                return value;
            });
            $http.post('nhasanxuat/update', editJson).then((Response) => {
                if (Response.data) {
                    loadNhaSanXuatList(true);
                }
            });
        }



        $scope.xoaNhaSanXuat = (MaNSX) => {
            $http.get('nhasanxuat/remove/' + MaNSX).then((Response) => {
                if (Response.data) {
                    loadNhaSanXuatList(true);
                }
            });
        }



        $scope.themDonVi = () => {
            $http.post('donvi/add', $scope.DV).then((Response) => {
                $('#tao-don-vi').modal('hide');
                alert("Thao tát hoàn tất");
                loadDonViList(true);
            });
        }

        $scope.DVDisableEditFunc = (status) => {
            $scope.DVDisableEdit = status;
        }

        $scope.suaDonVi = (DVEdit) => {
            var editJson = JSON.stringify(DVEdit, function (key, value) {
                if (key === "$$hashKey") {
                    return undefined;
                }
                return value;
            });
            $http.post('donvi/update', editJson).then((Response) => {
                if (Response.data) {
                    loadDonViList(true);
                }
            });
        }



        $scope.xoaDonVi = (MaDV) => {
            $http.get('donvi/remove/' + MaDV).then((Response) => {
                if (Response.data) {
                    loadDonViList(true);
                }
            });
        }

    });
})(angular.module('wmws_app'));