<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="phieunhapController">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Danh Sách tồn kho</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="trangchu">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý phiếu nhập</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Tìm kiếm - lọc -->
            <div class="row">
                <div class="form-group col-md-4 padd-0">
                    <input type="text" class="form-control" ng-model="MaPNSearch" placeholder="nhập từ khóa tìm kiếm" id="product-search">
                </div>
                <div class="form-group col-md-8 ">
                    <div class="row mb-2">
                        <div class="col-md-4 padd-0">
                            <div class="form-group">
                                <!-- <label>Móc thời gian</label> -->
                                <div class="input-group">                                    
                                    <input type="button" class="form-control float-right" id="daterange-btn">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="right-action text-right">
                                <div class="btn-groups">
                                <button type="button" class="btn btn-success" ng-click="xuatExcel()" >
                                            <i class="fas fa-file-export"></i> Xuất Excel
                                    </button>
                                    <a href="phieunhap/nhaphang">
                                        <button type="button" class="btn btn-info" ><i
                                            class="fa fa-plus"></i> nhập hàng
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th class="text-center">Mã phiếu nhập</th>
                                        <th class="text-center">Nhà cung cấp</th>
                                        <th class="text-center">Kho nhập</th>
                                        <th class="text-center">Ngày lặp</th>
                                        <th class="text-center" style="background-color: #fff;">Tổng tiền</th>
                                        <th class="text-center" style="background-color: #fff;">Nợ</th>
                                        <th class="text-center">Xử lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="PhieuNhap in PN_List|filter:MaPNSearch">
                                        <td class="text-center">{{$index+1}}</td>
                                        <td class="text-center">{{PhieuNhap.MaPN}}</td>
                                        <td class="text-center" ng-if="PhieuNhap.TenNCC!=''">{{PhieuNhap.TenNCC}}</td>
                                        <td class="text-center" ng-if="PhieuNhap.TenNCC==''">
                                            <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                                        </td>
                                        <td class="text-center"  ng-if="PhieuNhap.TenKho!=''">{{PhieuNhap.TenKho}}</td>
                                        <td class="text-center" ng-if="PhieuNhap.TenKho==''">
                                            <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                                        </td>
                                        <td class="text-center">{{PhieuNhap.NgayNhap|date:'dd-MM-yyyy'}}</td>
                                        <td class="text-center">{{PhieuNhap.TongGiaNhap|number}}</td>
                                        <td class="text-center">{{PhieuNhap.TongGiaNhap-PhieuNhap.DaTra|number}}</td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-primary" value="Xem chi tiết" 
                                             data-toggle="modal" data-target="#CTPN"
                                            ng-click="xemChiTietPhieuNhap(PhieuNhap)">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>


        </div>
        <!-- /.container-fluid -->


     <!-- Đây là bảng dùng để nhập ra file Excel -->    
     <div class="export-table" style="display: none !important" >
                <table class="table table-bordered" id="danh-sach-phieu-nhap">
                    <thead>
                        <tr class="table_row" >
                            <th class="text-center table_cell">STT</th>
                            <th class="text-center table_cell">Mã phiếu nhập</th>
                            <th class="text-center table_cell">Khách hàng</th>
                            <th class="text-center table_cell">Kho nhập</th>
                            <th class="text-center table_cell">Ngày nhập</th>
                            <th class="text-center table_cell">Tổng tiền</th>
                            <th class="text-center table_cell">Nợ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table_row" ng-repeat="PhieuNhap in exportData">
                            <td class="text-center table_cell">{{$index+1}}</td>
                            <td class="text-center table_cell">{{PhieuNhap.MaPX}}</td>
                            <td class="text-center table_cell" ng-if="PhieuNhap.TenKH!=''">{{PhieuNhap.TenKH}}</td>
                            <td class="text-center table_cell" ng-if="PhieuNhap.TenKH==''">
                                <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                            </td>
                            <td class="text-center table_cell"  ng-if="PhieuNhap.TenKho!=''">{{PhieuNhap.TenKho}}</td>
                            <td class="text-center table_cell" ng-if="PhieuNhap.TenKho==''">
                                <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                            </td>
                            <td class="text-center table_cell">{{PhieuNhap.NgayXuat|date:'dd-MM-yyyy'}}</td>
                            <td class="text-center table_cell">{{PhieuNhap.TongGiaBan|number}}</td>
                            <td class="text-center table_cell">{{PhieuNhap.TongGiaBan-PhieuNhap.DaTra|number}}</td>
                            <td class="text-center  expand">
                                <table class="table table-bordered">
                                    <thead >
                                        <tr class="table_row">
                                            <th class="text-center table_cell">Mã hàng hóa</th>
                                            <th class="text-center table_cell">Tên hàng hóa</th>
                                            <th class="text-center table_cell">Số lượng nhập</th>
                                            <th class="text-center table_cell">Giá nhập</th>
                                            <th class="text-center table_cell">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table_row" ng-repeat="hangHoaBan in PhieuNhap.ChiTietPhieuNhap">
                                            <td class="text-center table_cell">{{hangHoaBan.MaHH}}</td>
                                            <td class="text-center table_cell">{{hangHoaBan.TenHH}}</td>
                                            <td class="text-center table_cell">{{hangHoaBan.SLN | number}}</td>
                                            <td class="text-center table_cell">{{hangHoaBan.GiaNhap | number}}</td>
                                            <td class="text-center table_cell">{{hangHoaBan.ThanhTien | number}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>


           <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="CTPN">
            <div class="modal-dialog modal-xl" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">CHI TIẾT PHIẾU nhập</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                    <div class="row">
                        <!-- table -->
                        <div class="col-md-6">   
                           <div class="card">
                                <div class="card-header">
                                    <b class="card-title text-primary text-center">Nhà cung cấp</b>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-bordered">
                                        <tbody>
                                            <tr>
                                                <th><b>Tên Nhà cung cấp</b></th>
                                                <td width="50%">{{PN.NCC.TenNCC}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Điện thoại</b></th>
                                                <td>{{PN.NCC.STDNCC}}</td>

                                            </tr>
                                            <tr>
                                                <th><b>Địa chỉ</b></th>
                                                <td>{{PN.NCC.DiaChiNCC}}</td>
                                            </tr>
                                            <tr>
                                                <th><b>Email</b></th>
                                                <td>{{PN.NCC.email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                         
                        </div>
                        <!-- end table -->

                        <!-- infor -->
                        
                        <div class="col-md-6">
                         
                             <div class="card">
                                <div class="card-header">
                                    <b class="card-title text-primary text-center">Thông tin thanh toán</b>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-bordered">
                                        <tbody>
                                            <tr>
                                                <th><b>Ngày lặp phiếu</b></th>
                                                <td  width="50%">{{PN.NgayNhap}}</td>
                                            </tr>                                        
                                            <tr>
                                                <th><b>Tổng cộng</b></th>
                                                <td>{{PN.TongGiaNhap|number}} đ</td>
                                            </tr>
                                            <tr>
                                                <th><b>Thanh toán</b></th>
                                                <td>{{PN.DaTra|number}} đ</td>
                                            </tr>
                                            <tr>
                                                <th><b>Còn nợ</b></th>
                                                <td>{{PN.TongGiaNhap-PN.DaTra | number}} đ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                       <!-- end-infor -->
                        
                    </div>

                    <div class="row">
                        <div class="col">
                             <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-primary">STT</th>
                                        <th class="text-center text-primary">Mã hàng hóa</th>
                                        <th class="text-center text-primary">Tên hàng hóa</th>
                                        <th class="text-center text-primary">Số lượng nhập</th>
                                        <th class="text-center text-primary" style="background-color: #fff;">Giá nhập</th>
                                        <th class="text-center text-primary" style="background-color: #fff;">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="hangHoaNhap in PN.ChiTietPhieuNhap">
                                        <td class="text-center">{{$index+1}}</td>
                                        <td class="text-center">{{hangHoaNhap.MaHH}}</td>
                                        <td class="text-center">{{hangHoaNhap.TenHH}}</td>
                                        <td class="text-center">{{hangHoaNhap.SLN}}</td>
                                        <td class="text-center">{{hangHoaNhap.GiaNhap| number}}</td>
                                        <td class="text-center">{{hangHoaNhap.ThanhTien| number}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                <!-- body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-11"></div>  
                    <div class="col-md-1">
                      <button class="btn-success btn-sm pull-right" data-dismiss='modal'>Đóng</button>
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