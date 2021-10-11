<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="doitacController">
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
            <!-- tabs -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="tabs-khach-hang-tab" data-toggle="pill" href="#tabs-khach-hang" role="tab" aria-controls="tabs-khach-hang" aria-selected="true"  ng-click="chonTab('KH')">Khách hàng</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="tabs-nha-cung-cap-tab" data-toggle="pill" href="#tabs-nha-cung-cap" role="tab" aria-controls="tabs-nha-cung-cap" aria-selected="false" ng-click="chonTab('NCC')" >Nhà cung cấp</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          <div class="tab-pane fade show active" id="tabs-khach-hang" role="tabpanel" aria-labelledby="tabs-khach-hang-tab">
                            <!-- khách hàng -->
                            <!-- Tìm kiếm - lọc -->
                                <div class="row">
                                    <div class="form-group col-md-4 padd-0">
                                        <input type="text" class="form-control" ng-model="KHSearch" placeholder="tìm kiếm" id="product-search">
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
                                                        <button type="button"  ng-click="taoDoiTac('KH')" class="btn btn-info" ><i
                                                            class="fa fa-plus"></i> Tạo khách hàng
                                                        </button>                                                        
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
                                                            <th class="text-center">Mã khách hàng</th>
                                                            <th class="text-center">Tên khách hàng</th>
                                                            <th class="text-center">Số điện thoại</th>
                                                            <th class="text-center">Địa chỉ</th>
                                                            <th class="text-center" style="background-color: #fff;">Tổng tiền hàng</th>
                                                            <th class="text-center" style="background-color: #fff;">Nợ</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="KH in KH_List|filter:KHSearch">
                                                            <td class="text-center">{{$index+1}}</td>
                                                            <td class="text-center">{{KH.MaKH}}</td>
                                                            <td class="text-center" >
                                                                <a href=""   ng-click="xemChiTiet('KH',KH)">{{KH.TenKH}}</a>
                                                            </td>
                                                            <td class="text-center">{{KH.stdKH}}</td>
                                                            <td class="text-center">{{KH.DiaChiKH}}</td>
                                                            <td class="text-center"><b>{{KH.TongGiaBanCacPhieu|number}}</b></td>
                                                            <td class="text-center"><b>{{KH.TongNoCacPhieu|number}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <b>Số khách hàng : {{KH_List.length|number}}</b>
                                                            </td>
                                                            <td colspan="3"></td>
                                                            <td >
                                                                <b>Tổng tiền : {{TongTien|number}}</b> 
                                                            </td>
                                                            <td >
                                                                <b>Tổng nợ : {{TongNo|number}}</b> 
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
                          <div class="tab-pane fade" id="tabs-nha-cung-cap" role="tabpanel" aria-labelledby="tabs-nha-cung-cap-tab">
                            <!-- Nhà cung cap -->
                            <!-- Tìm kiếm - lọc -->
                            <div class="row">
                                <div class="form-group col-md-4 padd-0">
                                    <input type="text" class="form-control" ng-model="NCCSearch" placeholder="Tìm kiếm" id="provider-search">
                                </div>
                                <div class="form-group col-md-8 ">
                                    <div class="row mb-2">
                                        <div class="col-md-4 padd-0">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="right-action text-right">
                                                <div class="btn-groups">                                                    
                                                    <button type="button" class="btn btn-info" ng-click="taoDoiTac('NCC')" ><i
                                                        class="fa fa-plus"></i>Tạo nhà cung cấp
                                                    </button>
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
                                                        <th class="text-center">Mã nhà cung cấp</th>
                                                        <th class="text-center">Tên nhà cung cấp</th>
                                                        <th class="text-center">Số điện thoại</th>
                                                        <th class="text-center">Địa chỉ</th>
                                                        <th class="text-center">Địa chỉ Email</th>
                                                        <th class="text-center" style="background-color: #fff;">Tổng tiền hàng</th>
                                                        <th class="text-center" style="background-color: #fff;">Nợ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="NCC in NCC_List|filter:NCCSearch">
                                                        <td class="text-center">{{$index+1}}</td>
                                                        <td class="text-center">{{NCC.MaNCC}}</td>
                                                        <td class="text-center" >
                                                            <a href="" ng-click="xemChiTiet('NCC',NCC)" > {{NCC.TenNCC}}</a>
                                                       </td>
                                                        <td class="text-center">{{NCC.STDNCC}}</td>
                                                        <td class="text-center">{{NCC.DiaChiNCC}}</td>                                                        
                                                        <td class="text-center">{{NCC.email}}</td>  
                                                        <td class="text-center"><b>{{NCC.TongGiaNhapCacPhieu|number}}</b></td>
                                                        <td class="text-center"><b>{{NCC.TongNoCacPhieu|number}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <b>Số nhà cung cấp : {{NCC_List.length|number}}</b>
                                                        </td>
                                                        <td colspan="4"></td>
                                                        <td >
                                                            <b>Tổng tiền : {{TongTien|number}}</b> 
                                                        </td>
                                                        <td >
                                                            <b>Tổng nợ : {{TongNo|number}}</b> 
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
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
            </div>  
            <!-- end tabs -->
        </div>
        <!-- /.container-fluid -->

        <!-- Modal tạo đối tác -->
        <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="tao-doi-tac">
            <div class="modal-dialog modal-lg" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title text-primary">{{title}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                    <div class="row">                      
                      <div class="col-md-4">
                          <label>Tên {{doiTac}}</label>
                      </div>     
                      <div class="col-md-8">
                        <input type="text" ng-show="TaoKH" ng-model="KH.TenKH" value="" class="form-control" placeholder="Nhập tên {{doiTac}}"/>
                        <input type="text"  ng-show="!TaoKH" ng-model="NCC.TenNCC" value="" class="form-control" placeholder="Nhập tên {{doiTac}}"/>
                      </div>
                    </div>
                      <div class="form-group clearfix"></div>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Địa chỉ {{doiTac}}</label>
                          </div>                                        
                          <div class="col-md-8">
                              <input type="text" ng-show="TaoKH" ng-model="KH.DiaChiKH" value="" class="form-control" placeholder="Nhập địa chỉ {{doiTac}}"/>
                              <input type="text"  ng-show="!TaoKH" ng-model="NCC.DiaChiNCC" value="" class="form-control" placeholder="Nhập địa chỉ {{doiTac}}"/>
                          </div>    
                      </div>
                      <div class="form-group clearfix"></div>     
                      <div class="row">
                          <div class="col-md-4">
                              <label>Số điện thoại {{doiTac}}</label>
                          </div>
                          <div class="col-md-8">
                         
                                <input type="text" ng-show="TaoKH" ng-model="KH.stdKH" value="" class="form-control" placeholder="Nhập số điện thoại {{doiTac}}"/>
                                <input type="text"  ng-show="!TaoKH" ng-model="NCC.STDNCC" value="" class="form-control" placeholder="Nhập số điện thoại {{doiTac}}"/>
                          </div>
                      </div>
                      <div class="form-group clearfix"></div>     
                      <div class="row">
                          <div class="col-md-4">
                              <label>Địa chỉ email {{doiTac}}</label>
                          </div>
                          <div class="col-md-8">
                            <input type="text"  ng-show="TaoKH" ng-model="KH.email" value="" class="form-control" placeholder="Nhập email {{doiTac}}"/>
                            <input type="text"   ng-show="!TaoKH" ng-model="NCC.email" value="" class="form-control" placeholder="Nhập email {{doiTac}}"/>
                        </div>      
                      </div>       
                </div>
                <!-- body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-10"></div>  
                    <div class="col-md-2">
                      <button class="btn-primary btn-sm pull-right" ng-show="TaoKH" data-dismiss='modal' ng-click="themDoiTac('khachhang')">Lưu</button>
                      <button class="btn-primary btn-sm pull-right" ng-show="!TaoKH" data-dismiss='modal' ng-click="themDoiTac('nhacungcap')">Lưu</button>
                      <button class="btn-success btn-sm pull-right" data-dismiss='modal'>Đóng</button>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal tạo đối tác -->

        <!-- Modal chi tiết đối tác -->
        <div class="row">
            <div class="col-md-12">
              <div class="modal fade" id="xem-chi-tiet-doi-tac">
                <div class="modal-dialog modal-xl" >
                  <div class="modal-content">
                    <div class="modal-header" >
                      <h5 class="modal-title text-primary">{{title}}</h5>                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <!-- body -->
                    <div class="modal-body">
                        <div class="row">                      
                          <div class="col-md-6">
                              <label>Tên {{doiTac}}</label>
                                <input type="text" ng-disabled="view" ng-show="XemKH" ng-model="KH.TenKH" value="" class="form-control" placeholder="Nhập tên {{doiTac}}"/>
                                <input type="text" ng-disabled="view" ng-show="!XemKH" ng-model="NCC.TenNCC" value="" class="form-control" placeholder="Nhập tên {{doiTac}}"/>
                          </div>     
                          <div class="col-md-6">                            
                            <label>Mã {{doiTac}}</label>
                                <input type="text" ng-disabled="view" ng-show="XemKH" ng-model="KH.MaKH" value="" class="form-control"/>
                                <input type="text" ng-disabled="view" ng-show="!XemKH" ng-model="NCC.MaNCC" value="" class="form-control" />
                          </div>
                        </div>
                          <div class="form-group clearfix"></div>
                          <div class="row">           
                              <div class="col-md-12">
                                <label>Địa chỉ {{doiTac}}</label>
                                  <input type="text" ng-disabled="view" ng-show="XemKH" ng-model="KH.DiaChiKH" value="" class="form-control" placeholder="Nhập địa chỉ {{doiTac}}"/>
                                  <input type="text" ng-disabled="view" ng-show="!XemKH" ng-model="NCC.DiaChiNCC" value="" class="form-control" placeholder="Nhập địa chỉ {{doiTac}}"/>
                              </div>    
                          </div>
                          <div class="form-group clearfix"></div>     
                          <div class="row">
                              <div class="col-md-6">
                                <label>Số điện thoại {{doiTac}}</label>
                                    <input type="text" ng-disabled="view" ng-show="XemKH" ng-model="KH.stdKH" value="" class="form-control" placeholder="Nhập số điện thoại {{doiTac}}"/>
                                    <input type="text"  ng-disabled="view" ng-show="!XemKH"  ng-model="NCC.STDNCC" value="" class="form-control" placeholder="Nhập số điện thoại {{doiTac}}"/>
                              </div>
                              <div class="col-md-6">
                                 <label>Địa chỉ email {{doiTac}}</label>
                                 <input type="text" ng-disabled="view" ng-show="XemKH"  ng-model="KH.email" value="" class="form-control" placeholder="Nhập email {{doiTac}}"/>
                                 <input type="text"  ng-disabled="view" ng-show="!XemKH"  ng-model="NCC.email" value="" class="form-control" placeholder="Nhập email {{doiTac}}"/>
                              </div>
                          </div>      
                          <div class="form-group clearfix"></div>    
                          <div class="row">
                            <div class="col-md-11"></div>
                              
                              <button class="col-md-1 btn-info btn pull-right" ng-show="view" ng-click="view=false">Sửa</button>
                              <button class="col-md-1 btn-primary btn pull-right" ng-show="XemKH==true && view==false" data-dismiss='modal' ng-click="suaDoiTac('khachhang')">Lưu</button>
                              <button class="col-md-1 btn-primary btn pull-right" ng-show="XemKH==false && view==false" data-dismiss='modal' ng-click="suaDoiTac('nhacungcap')">Lưu</button>
                              
                          </div>
                          <div class="form-group clearfix"></div>    

                          <div class="row">
                            <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-primary ">LỊCH SỬ GIAO DỊCH</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-primary">STT</th>
                                                        <th class="text-center text-primary">Mã phiếu {{LoaiGiaoDich}}</th>
                                                        <th class="text-center text-primary">Kho {{LoaiGiaoDich}}</th>
                                                        <th class="text-center text-primary">Ngày {{LoaiGiaoDich}}</th>
                                                        <th class="text-center text-primary" style="background-color: #fff;">Tổng tiền hàng</th>
                                                        <th class="text-center text-primary" style="background-color: #fff;">Nợ</th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- PGD === PhieuGiaoDich -->
                                                    <tr ng-repeat="PGD in PGD_List|filter:MaPNSearch">
                                                        <td class="text-center">{{$index+1}}</td>
                                                        <td class="text-center" ng-show="XemKH">{{PGD.MaPX}}</td>
                                                        <td class="text-center" ng-show="!XemKH">{{PGD.MaPN}}</td>
                                                        <td class="text-center" >{{PGD.TenKho}}</td>
                                                        <td class="text-center" ng-show="XemKH">{{PGD.NgayXuat}}</td>
                                                        <td class="text-center" ng-show="!XemKH">{{PGD.NgayNhap}}</td>
                                                        <td class="text-center" ng-show="XemKH">{{PGD.TongGiaBan|number}}</td>
                                                        <td class="text-center" ng-show="!XemKH">{{PGD.TongGiaNhap|number}}</td>
                                                        <td class="text-center" ng-show="XemKH">{{PGD.TongGiaBan-PGD.DaTra|number}}</td>
                                                        <td class="text-center" ng-show="!XemKH">{{PGD.TongGiaNhap-PGD.DaTra|number}}</td>
                                                        <td class="text-center">
                                                             <input type="button" class="btn btn-primary" value="Xem chi tiết" ng-click="xemChiTietPGD(PGD)">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <b>Số phiếu {{LoaiGiaoDich}} : {{PGD_List.length}}</b>
                                                        </td>
                                                        <td colspan="2"></td>
                                                        <td >
                                                            <b ng-show="XemKH">{{KH.TongGiaBanCacPhieu|number}}</b> 
                                                            <b ng-show="!XemKH" >{{NCC.TongGiaNhapCacPhieu|number}}</b> 

                                                        </td>
                                                        <td >
                                                            <b ng-show="XemKH"> {{KH.TongNoCacPhieu|number}}</b> 
                                                            <b ng-show="!XemKH"> {{NCC.TongNoCacPhieu|number}}</b> 
                                                        </td>
                                                        <td></td>
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
                    <!-- body -->
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-11"></div>  
                        <button class="col-md-1 btn-success btn pull-right" data-dismiss='modal'>Trở về</button>
                      </div>                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal chi tiết đối tác -->

          <!-- Modal CHI TIẾT PHIẾU GIAO DỊCH -->
          <div class="row">
            <div class="col-md-12">
              <div class="modal fade" id="CTPN">
                <div class="modal-dialog modal-xl" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-primary">CHI TIẾT PHIẾU GIAO DỊCH</h5>
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
                                <b class="card-title text-primary text-center">{{doiTac}}</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th><b>Tên {{doiTac}}</b></th>
                                            <td ng-show="!XemKH"  width="50%">{{NCC.TenNCC}}</td>
                                            <td ng-show="XemKH"  width="50%">{{KH.TenKH}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Điện thoại {{doitac}}</b></th>                                            
                                            <td ng-show="!XemKH"  width="50%">{{NCC.STDNCC}}</td>
                                            <td ng-show="XemKH"  width="50%">{{KH.stdKH}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Địa chỉ {{doitac}}</b></th>
                                            <td ng-show="!XemKH"  width="50%">{{NCC.DiaChiNCC}}</td>
                                            <td ng-show="XemKH"  width="50%">{{KH.DiaChiKH}}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Email {{doitac}}</b></th>
                                            <td ng-show="!XemKH"  width="50%">{{NCC.email}}</td>
                                            <td ng-show="XemKH"  width="50%">{{KH.email}}</td>
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
                                        <td ng-show="!XemKH" width="50%">{{PGD.NgayNhap}}</td>
                                        <td ng-show="XemKH" width="50%">{{PGD.NgayXuat}}</td>
                                    </tr>                                        
                                    <tr>
                                        <th><b>Tổng cộng</b></th>
                                        <td ng-show="!XemKH" width="50%">{{PGD.TongGiaNhap|number}} đ</td>
                                        <td ng-show="XemKH" width="50%">{{PGD.TongGiaBan|number}} đ</td>
                                    </tr>
                                    <tr>
                                        <th><b>Thanh toán</b></th>
                                        <td  width="50%">{{PGD.DaTra|number}} đ</td>
                                    </tr>
                                    <tr>
                                        <th><b>Còn nợ</b></th>
                                         <td ng-show="!XemKH" width="50%">{{PGD.TongGiaNhap-PGD.DaTra | number}} đ</td>
                                         <td ng-show="XemKH" width="50%">{{PGD.TongGiaBan-PGD.DaTra | number}} đ</td>
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
                            <th class="text-center text-primary">Số lượng {{LoaiGiaoDich}}</th>
                            <th class="text-center text-primary" style="background-color: #fff;">Giá {{LoaiGiaoDich}}</th>
                            <th class="text-center text-primary" style="background-color: #fff;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody ng-show="XemKH">
                        <tr ng-repeat="hangHoaGiaoDich in PGD.ChiTietPhieuXuat">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.MaHH}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.TenHH}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.SLB}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.GiaBan}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.ThanhTien}}</td>
                        </tr>
                    </tbody>
                    <tbody ng-show="!XemKH">
                        <tr ng-show="!XemKH" ng-repeat="hangHoaGiaoDich in PGD.ChiTietPhieuNhap">
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.MaHH}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.TenHH}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.SLN}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.GiaNhap}}</td>
                            <td class="text-center">{{hangHoaGiaoDich.ThanhTien}}</td>
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
          <!-- End Modal chi tiết phiếu nhập -->

    </section>
    <!-- /.content -->
</div>