// đăng kí controller cho app chính
(function(app) {
    app.controller('trangchuController', function($scope, $http) {
        //Date range as a button
        //mặc định là tuần hiện tại
        $scope.timeFilter = {
            start :moment().startOf('week').format("YYYY-MM-DD"),
            end   :moment().endOf('week').format("YYYY-MM-DD")
        }

        $scope.fill = false;
        $scope.fillChartShow = true;


        $scope.Kho = {}; // kho object

        $scope.BoxBaoCao = {
            TonKho:{
                SoSanPham:0,
                SoLuongSanPham:0
            },
            BanHang :{
                SoDonHang:0,
                TongThanhTien:0
            },
            NhapHang :{
                SoPhieuNhap:0,
                TongThanhTien:0
            }
        };

        $scope.Kho_list = [];

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

            $scope.timeFilter = {
                start :start.format("YYYY-MM-DD"),
                end   :end.format('YYYY-MM-DD')
            }

            boxBaoCaoDataLoad();
            chartDataLoad();
        });
        // Get context with jQuery - using jQuery's .get() method.
        var bieuDoBaoCaoDoanhThuCanvas = $('#bieuDoBaoCaoDoanhThu').get(0).getContext('2d')

        var bieuDoBaoCaoDoanhThuData = {
            labels  : ['Thứ hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'],             
        }

        var bieuDoBaoCaoDoanhThuOptions = {
            maintainAspectRatio : false,
            responsive : true,
            // legend: {
            //     display: true
            // },
            // scales: {
            //     xAxes: [{
            //         gridLines : {
            //             display : true,
            //         }
            //     }],
            //     yAxes: [{
            //         gridLines : {
            //             display : true,
            //         }
            //     }]
            // }
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var bieuDoBaoCaoDoanhThu = new Chart(bieuDoBaoCaoDoanhThuCanvas, { 
            type: 'line', 
            data: bieuDoBaoCaoDoanhThuData, 
            options: bieuDoBaoCaoDoanhThuOptions
        });

        $scope.fillChart = function () {
            angular.forEach(bieuDoBaoCaoDoanhThu.data.datasets, function(value){
                value.fill = $scope.fill;
            });
            bieuDoBaoCaoDoanhThu.update();
        }



        $scope.changeTypeChart = function (_type) {
            if(bieuDoBaoCaoDoanhThu != undefined)
                bieuDoBaoCaoDoanhThu.destroy();
            bieuDoBaoCaoDoanhThu = new Chart(bieuDoBaoCaoDoanhThuCanvas, { 
                type: _type, 
                data: bieuDoBaoCaoDoanhThuData, 
                options: bieuDoBaoCaoDoanhThuOptions
            });
        }

       function loadKhoList(reload = false) {
            if ($scope.Kho_list.length === 0 || reload === true) {
                $http.get('kho/getList').then((Response) => {
                    $scope.Kho_list = Response.data;
                    $scope.Kho = $scope.Kho_list[0];
                });
            }
        }


          //Gọi API 
          $scope.doanhThuTheoKho = (ngayDau=null,ngayCuoi=null)=>{
           

            bieuDoBaoCaoDoanhThu.data.datasets = [];
            bieuDoBaoCaoDoanhThu.data.labels = [];
            bieuDoBaoCaoDoanhThu.update();

            let requestUrl = "giatri/getDataSetFromTo/"+ma_tram;
            if (ngayDau && ngayCuoi) {
                requestUrl += "/" + ngayDau + "/" + ngayCuoi;
            }
            $http.get(requestUrl).then(function(result){
                if (result.data!= undefined) {
                    $scope.dataByStation = groupBy(result.data,"ma_cambien");
                    $scope.camBienList = [];
                    angular.forEach($scope.dataByStation,function (item,key) {
                        $http.get('cambien/getByKey/'+key).then((camBien)=>{
                            if (camBien.data != undefined) {
                                    let avgData = processDataset(item);// nhóm lại rồi tính trung bình theo ngày
                                    //fill data into chart
                                   
                                    //fill data into tables
                                    avgData = processDataset(result.data,"DD/MM/YYYY");
                                    for (var i = 0; i < avgData.data.length; i++) {
                                        // let ten_donvi = value.DaiLuong.ten_donvi;
                                        let thoigian = avgData.labels[i];
                                        let giatri = avgData.data[i];
                                        avgData.data[i] = {
                                            thoigian  : thoigian,
                                            giatri    : giatri,
                                            bgColor   : backgroundColor[i%backgroundColor.length]
                                        }
                                    }
                                    let temp = {
                                        CamBien:camBien.data,
                                        data:avgData.data
                                    };
                                    $scope.DanhSachThongKeCacDaiLuong.push(temp);
                                }
                            });
                    })
                }
            });
        }


        function generateRandomColor()
        {
            var randomColor = '#'+Math.floor(Math.random()*16777215).toString(16);
            return randomColor;
        }

        //gom nhóm
        const groupBy = (xs, key) => {
            return xs.reduce(function(rv, x) {
                (rv[x[key]] = rv[x[key]] || []).push(x);
                return rv;
            }, {});
        };

        // tính tổng
        const sum = (array) => array.reduce((a, b) => parseFloat(a) + parseFloat(b));

        function chartDataLoad(){

            bieuDoBaoCaoDoanhThu.data.datasets = [];
            bieuDoBaoCaoDoanhThu.data.labels = [];
            bieuDoBaoCaoDoanhThu.update();
            
            let chartDataLoadRequestApi = 'phieuxuat/baoCaoDoanhThuTheoNgayTungKho';
            if($scope.timeFilter !== null && $scope.timeFilter !== undefined){
                chartDataLoadRequestApi += "/" + $scope.timeFilter.start + "/" + $scope.timeFilter.end;                
            }else{
                chartDataLoadRequestApi += '/-1/-1';                
            }

            if($scope.Kho.MaKho !== undefined){
                chartDataLoadRequestApi += "/" + $scope.Kho.MaKho;
            }else{
                 chartDataLoadRequestApi += '/-1';
            }

            $http.get(chartDataLoadRequestApi).then((Response)=>{
                if(Response.data){
                    let DoanhThuTheoTungKho = groupBy(Response.data,'MaKho');
                    
                    angular.forEach(DoanhThuTheoTungKho, function(DoanhThuTheoNgay, key){
                        let dataChart = [];
                        let labelChart = [];
                        angular.forEach(DoanhThuTheoNgay, function(value, key){
                            dataChart.push(value.DoanhThu);
                            labelChart.push(value.NgayXuat);
                        });

                        var dataset = {     
                            label               : $scope.Kho_list.find(x=>x.MaKho===DoanhThuTheoNgay[0].MaKho).TenKho,                 
                            backgroundColor     : generateRandomColor(),
                            borderColor         : generateRandomColor(),
                            pointRadius         : 1,
                            pointHoverRadius    : 5,
                            pointColor          : generateRandomColor(),
                            pointStrokeColor    : generateRandomColor(),
                            pointHighlightFill  : generateRandomColor(),
                            pointHighlightStroke: generateRandomColor(),
                            fill                : false,
                            data                : dataChart
                        };
                        bieuDoBaoCaoDoanhThu.data.datasets.push(dataset);
                        bieuDoBaoCaoDoanhThu.data.labels = labelChart;
                        bieuDoBaoCaoDoanhThu.update();  
                    });

                }
            });
        }

        function boxBaoCaoDataLoad(){
            let banHangRequestApi = 'phieuxuat/report';
            let nhapHangRequestApi = 'phieunhap/report';
            let tonkhoRequestApi = 'tonkho/report';    

            if($scope.timeFilter !== null && $scope.timeFilter !== undefined){
                banHangRequestApi += "/" + $scope.timeFilter.start + "/" + $scope.timeFilter.end;
                nhapHangRequestApi += "/" + $scope.timeFilter.start + "/" + $scope.timeFilter.end;
                // tonkhoRequestApi += "/" + timeFilter.start + "/" + timeFilter.end;
            }else{
                banHangRequestApi += '/-1/-1';
                nhapHangRequestApi += '/-1/-1';
                // tonkhoRequestApi += '/-1/-1';
            }

            if($scope.Kho.MaKho !== undefined){
                banHangRequestApi += "/" + $scope.Kho.MaKho;
                nhapHangRequestApi += "/" + $scope.Kho.MaKho;
                tonkhoRequestApi += "/" + $scope.Kho.MaKho;
            }else{
                 banHangRequestApi += '/-1';
                 nhapHangRequestApi += '/-1';
                 tonkhoRequestApi += '/-1'; 
            }
            $http.get(banHangRequestApi).then((Response)=>{
                if(Response.data)
                {
                    $scope.BoxBaoCao.BanHang = Response.data;                    
                }
            });
            $http.get(nhapHangRequestApi).then((Response)=>{
                if(Response.data){
                    $scope.BoxBaoCao.NhapHang = Response.data;
                }
            });
            $http.get(tonkhoRequestApi).then((Response)=>{
                if(Response.data){
                    $scope.BoxBaoCao.TonKho = Response.data;
                }
            });
        }

        $scope.chonKho = ()=>{
            boxBaoCaoDataLoad();
            chartDataLoad();
        }

        window.onload = () => {
            
        };
        loadKhoList();
        boxBaoCaoDataLoad();
        chartDataLoad();
      });
})(angular.module('wmws_app'));