  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="tonkhoController">
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
              <li class="breadcrumb-item active">Quản lý tồn kho</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Tìm kiếm - lọc -->
        <div class="row">
            <div class="form-group col-md-3 padd-0">
                <input type="text" class="form-control"  ng-model="filterPrd.TenHH" placeholder="Nhập Tên sản phẩm"
                        id="product-search">                        
            </div>
            <div class="form-group col-md-9 ">
                <div class="row">
                  <!-- {{filterPrd.MaLHH}} -->
                    <div class="col-md-3 padd-0" >
                        <select class="form-control search-option-2" ng-change="loadHangHoaList()" ng-model="filterPrd.MaLHH" id="prd_group_id">
                            <option value="" selected="selected">loại hàng</option>
                            <optgroup label="Chọn loại hàng">                            
                              <option ng-value="{{LoaiHangHoa.MaLHH}}" ng-repeat="LoaiHangHoa in LHH_list">
                                    {{LoaiHangHoa.TenLHH}}
                                    </option>
                            </optgroup>
                        </select>
                    </div>
                    <!-- {{filterPrd.MaNSX}} -->
                    <div class="col-md-3 padd-0" >
                        <select class="form-control search-option-3" ng-change="loadHangHoaList()"  ng-model="filterPrd.MaNSX"  id="prd_manufacture_id">
                            <option value="" selected="selected">Nhà sản xuất</option>                            
                              <optgroup label="Chọn nhà sản xuất">    
                                <option ng-value="{{NhaSanXuat.MaNSX}}" ng-repeat="NhaSanXuat in NSX_list">
                                {{NhaSanXuat.TenNSX}}
                                </option>     
                              </optgroup>
                        </select>
                    </div>
                    <div class="col-md-2 padd-0" >
                            <select class="form-control" id="search-option-1">
                                <optgroup label="Phân loại">
                                  <option  selected="selected">Tất cả</option>
                                  <option >Hàng tồn</option>
                                  <option >Đã hết hàng</option>
                                </optgroup>
                                
                            </select>
                    </div> 
                    <div class="col-md-3 padd-0">
                            <select class="form-control search-option-3" id="search-option-1" ng-model='Kho.MaKho' ng-change="loadHangHoaList()" >                                
                                <optgroup label="Kho hàng">   
                                  <option value="">Tất cả</option>                               
                                  <option  ng-value="{{kho.MaKho}}" ng-repeat="kho in Kho_list" >{{kho.TenKho}}</option>                                  
                                </optgroup>                                
                            </select>
                    </div>
                    <button type="button" class="col-md-1 btn btn-primary" ng-click="danhSachKho()"><i class="fa fa-plus"></i></button>  
                </div>
            </div>
          </div> 

        <!-- Báo cáo nhanh -->          
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ngày lập</span>
                <span class="info-box-number">
                  {{currentMinute| date:'dd-MM-yyyy'}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sort-numeric-down-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng số lượng tồn</span>
                <span class="info-box-number">{{TongSoLuongTon}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-sync"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng vốn tồn kho</span>
                <span class="info-box-number">{{TongVonTonKho| number}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng giá trị tồn kho</span>
                <span class="info-box-number">{{TongGiaTriTon}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- end Báo cáo nhanh -->     
        <!-- Table -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">             
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th class="text-center">Mã sản phẩm</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Loại hàng hóa</th>
                        <th class="text-center">Nhà sản xuất</th>
                        <th class="text-center">Số lượng tồn</th>
                        <th class="text-center" style="background-color: #fff;">Vốn tồn</th>
                        <th class="text-center" style="background-color: #fff;">Giá trị tồn</th>
                    </tr>
                </thead>
                  <tbody>
                    <tr ng-repeat="hangHoa in hanghoa_list ">                     
                      <td class="text-center">{{hangHoa.MaHH}}</td>
                      <td class="text-center">{{hangHoa.TenHH}}</td>
                      <td class="text-center" ng-if="hangHoa.TenLHH!=''">{{hangHoa.TenLHH}}</td>
                      <td class="text-center" ng-if="hangHoa.TenLHH==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center" ng-if="hangHoa.TenNSX!=''">{{hangHoa.TenNSX}}</td>
                      <td class="text-center" ng-if="hangHoa.TenNSX==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center"  ng-if="hangHoa.SoLuongTon!=''" >{{hangHoa.TongSoLuongTon}} {{hangHoa.TenDV}}</td>
                      <td class="text-center" ng-if="hangHoa.SoLuongTon==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center">{{hangHoa.VonTonKho|number}}</td>
                      <td class="text-center">{{hangHoa.GiaTriTon|number}}</td>
                        
                    </tr>  
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>


      </div><!-- /.container-fluid -->

      <!-- Các modal - box -->
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="kho-list">
            <div class="modal-dialog modal-md" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">Danh sách kho hàng</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                  <div class="row">                      
                    <table class="table table-bordered">
                      <tr>
                        <th class="text-center">Tên kho</th>
                        <th colspan="2" class="text-center">Thiết lập</th>                        
                      </tr>
                      <tbody>
                        <tr ng-repeat="item in Kho_list">
                          <td class="text-center" ng-show="!editKho[$index]">{{item.TenKho}}</td>
                          <td width="50%" class="text-center" ng-show="editKho[$index]">
                            <input type="text" id="TenKho" ng-model="item.TenKho" ng-value="item.TenKho" class="form-control text-center"/>
                          </td>
                          <td class="text-center">                            
                            <button class="btn-sm btn-primary" ng-disabled="disableEdit" ng-show="!editKho[$index]" ng-click="editKho[$index]=true;disableEditFunc(true)">Sửa</button>

                            <button class="btn-sm btn-primary"  ng-show="editKho[$index]" ng-click="suaKho(item);editKho[$index]=false;disableEditFunc(false)">Lưu</button>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-danger" ng-disabled="disableEdit" ng-click="xoaKho(item.MaKho)" >Xóa</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group clearfix"></div>
                  <div class="row">                      
                    <div class="col-md-10">                          
                      <input type="text" id="TenKho" ng-model="Kho.TenKho" value="" class="form-control" placeholder="Nhập tên kho hàng mới"/>
                    </div>                                        
                    <button class="col-md-2 btn-primary btn-sm"  ng-click="themKho()">Lưu</button>  
                  </div>
                  <div class="form-group clearfix"></div>
                </div>
                <!-- body -->
                <div class="card-footer">                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>