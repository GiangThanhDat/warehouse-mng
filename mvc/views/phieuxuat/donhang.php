<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="donhangController">
    <!-- main content -->
    <section class="content">
        <!-- Chọn kho -->
        <div class="row">
            <div class="col-md-3 padd-0">
                <label>Chọn kho nhập</label>
                <select  class="form-control"
                    ng-options="kho.MaKho as kho.TenKho for kho in Kho_list" 
                    ng-model="Kho.MaKho" ng-change="loadHangHoaList()">                    
                </select> 
                <!-- select class="form-control search-option-3" id="search-option-1" ng-model='Kho.MaKho' ng-change="loadHangHoaList()" >                    
                    <optgroup label="Phân loại">                                  
                        <option  ng-value="{{kho.MaKho}}" ng-repeat="kho in Kho_list" >{{kho.TenKho}}</option>
                    </optgroup>
                </select> -->
            </div> 
        </div>
        <!-- default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Thời gian</b> : {{ clock | date:'dd/MM/yyyy HH:mm:ss'}} <b>- Nhân viên nhập hàng</b> : {{employeeDetail.HoTenNV}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body table-responsive p-0" style="height:320px;">
                                        <table class="table table-head-fixed text-nowrap table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tên hàng</th>
                                                    <th>Số lượng nhập</th>
                                                    <th>Đơn vị</th>
                                                    <th>Đơn giá</th>
                                                    <th>Thành tiền</th>
                                                    <th>Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                <tr ng-repeat="hangHoaXuat in ChiTietPhieuXuat" class="text-left">
                                                    <td>{{hangHoaXuat.TenHH}}</td>
                                                    <td>                   
                                                        <input type="number" ng-keyup="updateCTPX()"   ng-model="hangHoaXuat.SLB" class="text-center form-control" min="0"  />
                                                    </td>
                                                    <td>{{hangHoaXuat.TenDV}}</td>
                                                    <td>{{hangHoaXuat.GiaBan|number}} <u>đ</u></td>
                                                    <td>{{hangHoaXuat.ThanhTien|number}} <u>đ</u></td>
                                                    <td class="text-left">
                                                        <button ng-click="Xoa(hangHoaXuat)" class="btn btn-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-light"><i class="fa fa-align-justify"></i></button>
                                    <button type="button" class="btn btn-light"><i style="color:#007bff" class="fas icontren">&#xf122;</i></button>
                                    <button type="button" class="btn btn-light"><i style="color:#007bff" class="fas icontren">&#xf2f1;</i></button>
                                    <button type="button" class="btn btn-light"><i style="color:#007bff" class="fas icontren">&#xf02f;</i></button>
                                    <button ui-sref="trangchu" type="button" class="btn btn-light"> <i class="fa fa-home"></i></button>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-title text-primary text-center">Khách hàng</p>
                                        <!-- Search form -->
                                        <div class="md-form active-cyan-2 mb-3">
                                            <input class="form-control" type="text" ng-keyup="TimKH()" ng-model="KH_Search" placeholder="Tìm kiếm Khách hàng" aria-label="Search">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><b>Tên Khách hàng</b></td>
                                                    <td width="50%" >{{KH.TenKH}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Điện thoại</b></td>
                                                    <td>{{KH.stdKH}}</td>

                                                </tr>
                                                <tr>
                                                    <td><b>Địa chỉ</b></td>
                                                    <td>{{KH.DiaChiKH}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-primary">
                                            Danh sách sản phẩm
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-head-fixed text-nowrap table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tên hàng</th>
                                                    <th>Còn trong kho</th>
                                                    <th>Giá bán</th>
                                                    <th>Nhập</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="hanghoa in hanghoa_list" class="text-left">
                                                    <td>{{hanghoa.TenHH}}</td>
                                                    <td>
                                                        {{hanghoa.SoLuongTon|number}} {{hanghoa.TenDV}}
                                                    </td>
                                                    <td>{{hanghoa.GiaBan|number}} <u>đ</u> / {{hanghoa.TenDV}}</td>
                                                    <td class="text-left">
                                                        <button ng-click="XuatKho(hanghoa)" class="btn btn-info">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-title text-primary text-center">Thanh toán</p>
                                    </div>
                                    <div class="card-body">

                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Tổng số lượng</th>
                                                    <td>{{PhieuXuat.TongSoLuongBan}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng cộng</th>
                                                    <td>{{PhieuXuat.TongGiaBan  | number}} <u>đ</u></td>
                                                </tr>
                                                <tr>
                                                    <th>Thanh toán</th>
                                                    <td>
                                                        <input  ng-model="DaTra" ng-keyup="reformatPayment()" type="text" format="number" class="form-control text-right">
                                                        <!-- <input type="hidden"  ng-model="PhieuXuat.DaTra"  /> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Còn nợ</th>
                                                    <td>
                                                        {{PhieuXuat.TongGiaBan - PhieuXuat.DaTra | number}}<u>đ</u>
                                                    </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <th colspan="2">
                                                        <button class="btn btn-lg btn-primary" ng-click="ThanhToan()" id="thanh-toan">Thanh Toán</button>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>