  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="hanghoaController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Danh Sách hàng hóa</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="trangchu">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý hàng hóa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Action -->
        <div class="card">             
              <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Danh Sách hàng hóa</h4>
                    </div>
                    <div class="col-md-6">
                            <div class="right-action text-right">
                                <div class="btn-groups">                                
                                    <button type="button" class="btn btn-primary" ng-click="taoHangHoa()" ><i
                                            class="fa fa-plus"></i> Tạo sản phẩm
                                    </button>
                                    <button type="button" class="btn btn-danger"  ng-click="xoaHangHoa()"><i
                                            class="fa fa-trash"></i> Xoa sản phẩm
                                    </button>
                                    <!-- <button type="button" class="btn btn-success"><i class="fa fa-download"></i> Xuất Excel</button> -->
                                </div>
                            </div>
                        </div>        
                    </div>
              </div>
        </div>
        <!-- Tìm kiếm - lọc -->
        <div class="row">
            <div class="form-group col-md-5 padd-0">
                <input type="text" class="form-control" ng-model="filterPrd.TenHH" placeholder="Nhập Tên sản phẩm"
                        id="product-search">                        
            </div>
            <div class="form-group col-md-7 ">
                <div class="row">
                    <div class="col-md-3 padd-0" style="margin-right: 10px;">
                            <select class="form-control" id="search-option-1">
                                <option value="0">Đang kinh doanh</option>
                                <option value="1">Đã ngừng kinh doanh</option>
                                <option value="2">Đã xóa</option>
                            </select>
                    </div>
                    <div class="col-md-3 padd-0" style="margin-right: 10px;">
                        <select class="form-control search-option-2" ng-model="filterPrd.MaLHH" id="prd_group_id">
                            <option value="" selected="selected">loại hàng</option>
                            <optgroup label="Chọn loại hàng">
                              <option ng-value="{{LoaiHangHoa.MaLHH}}" ng-repeat="LoaiHangHoa in LHH_list">
                                    {{LoaiHangHoa.TenLHH}} - {{LoaiHangHoa.MaLHH}} 
                                    </option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-3 padd-0" style="margin-right: 10px;">
                        <select class="form-control search-option-3"  ng-model="filterPrd.MaNSX"  id="prd_manufacture_id">
                            <option value="" selected="selected">Nhà sản xuất</option>                            
                                 <optgroup label="Chọn nhà sản xuất">    
                                  <option ng-value="{{NhaSanXuat.MaNSX}}" ng-repeat="NhaSanXuat in NSX_list">
                                  {{NhaSanXuat.TenNSX}}
                                  </option>     
                            </optgroup>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-large btn-ssup"  onclick="cms_paging_product(1)"><i
                            class="fa fa-search"></i> Tìm kiếm
                    </button> 
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
                        <th class="text-center">
                            <label class="checkbox" style="margin: 0;">
                                <input type="checkbox" 
                                  ng-click="toggleAll()" ng-model="isAllSelected"
                                >
                                
                                <span style="width: 15px; height: 15px;"></span>
                            </label>
                        </th>
                        <th class="text-center">Mã sản phẩm</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Tổng tồn kho</th>
                        <th class="text-center" style="background-color: #fff;">Giá bán</th>
                        <th class="text-center">loại hàng</th>
                        <th class="text-center">Nhà sản xuất</th>
                <!--        <th class="text-center">Hình</th>-->
                        <th class="text-center">Xử lý</th>
                    </tr>
                </thead>
                  <tbody>
                    <tr ng-repeat="hangHoa in hanghoa_list | filter:filterPrd ">
                      <td class="text-center">
                          <label class="checkbox" name="chk" style="margin: 0;">
                          <input type="checkbox"
                            ng-model="hangHoa.selected" ng-change="optionToggled()" 
                            value="{{hangHoa.MaHH}}"
                            class="checkbox chk">
                            <span style="width: 15px; height: 15px;"></span>
                          </label>
                      </td>
                      <td class="text-center">{{hangHoa.MaHH}}</td>
                      <td class="text-center">{{hangHoa.TenHH}}</td>
                      <td class="text-center"  ng-if="hangHoa.SLT!=''" ><b>{{hangHoa.SLT}}</b> {{hangHoa.TenDV}}</td>
                      <td class="text-center" ng-if="hangHoa.SLT==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center"><b>{{hangHoa.GiaBan|number}}</b></td>
                      <td class="text-center" ng-if="hangHoa.TenLHH!=''">{{hangHoa.TenLHH}}</td>
                      <td class="text-center" ng-if="hangHoa.TenLHH==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center" ng-if="hangHoa.TenNSX!=''">{{hangHoa.TenNSX}}</td>
                      <td class="text-center" ng-if="hangHoa.TenNSX==''">
                        <p style="color:red;"><b> <i>Chưa thiết lập</i></b></p>
                      </td>
                      <td class="text-center">
                        <button ng-click="thietLapHangHoa(hangHoa.MaHH)" class="btn-success btn-sm">Thiết lập</button>
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
      </div><!-- /.container-fluid -->

      <!-- Các modal - box -->
      <!-- Tạo sản phẩm -->
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="tao-san-pham">
            <div class="modal-dialog modal-lg" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">{{title}}</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                  <div class="row">                      
                      <div class="col-md-6">
                          <label>Tên sản phẩm</label>
                          <input type="text" id="prd_name" ng-model="hanghoa.TenHH" value="" class="form-control" placeholder="Nhập tên sản phẩm"/>
                      </div>                                        
                      <div class="col-md-6">
                          <label>Mã sản phẩm</label>
                          <input type="text" id="prd_code" disabled ng-model="hanghoa.MaHH" value="" class="form-control" />
                      </div>              
                  </div>
                  <div class="form-group clearfix"></div>

                  <!-- only create -->
                  <div class="row" ng-show="create" >   
                      <div class="col-md-2">
                        <label for="" class="form-control">Nhập</label>
                      </div>
                      <div class="col-md-4">
                          <input type="text" ng-model="TonKho.SoLuongTon" placeholder="số lượng"
                                           class="form-control text-right txtNumber"/>
                      </div>  
                      <div class="col-md-6">                             
                          <div class="row">
                            <div class="col-md-11">
                              <select class="form-control" ng-model="hanghoa.MaDV">
                                  <option value="" selected="selected">Đơn vị</option>
                                  <optgroup label="Chọn đơn vị">
                                    <option ng-selected="DonVi.MaDV===hanghoa.MaDV" ng-value="{{DonVi.MaDV}}" ng-repeat="DonVi in DV_list">
                                    {{DonVi.TenDV}}
                                    </option>
                                  </optgroup>
                              </select>
                            </div>  
                            <button class="col-md-1 btn-primary " data-toggle="modal"
                                              data-target="#tao-don-vi">+</button>
                          </div>
                      </div>                             
                  </div>


                  <div class="form-group clearfix"></div>
                  <div class="row" ng-show="create" >
                      <div class="col-md-2">
                        <label for="" class="form-control">Vào</label>
                      </div>
                      <div class="col-md-10">                        
                        <select class="form-control" ng-model="TonKho.MaKho">
                            <option value="" selected="selected">Kho nhập</option>
                            <optgroup label="Chọn kho nhập">
                              <option ng-selected="$index==0" ng-value="{{kho.MaKho}}" ng-repeat="kho in Kho_list">
                              {{kho.TenKho}}
                              </option>
                            </optgroup>
                        </select>
                      </div>     
                  </div>
                  <!-- only create -->

                  <!-- only edit -->
                  <div class="form-group clearfix"></div>
                  <div class="row" ng-show="!create">
                    <div class="col-md-12">
                      <label for="donvi-txt">Đơn vị</label>
                      <div class="row">
                        <div class="col-md-11">
                          <select class="form-control" id="donvi-txt" ng-model="hanghoa.MaDV">
                              <option value="" selected="selected">Đơn vị</option>
                              <optgroup label="Chọn đơn vị">
                                <option ng-selected="DonVi.MaDV===hanghoa.MaDV" ng-value="{{DonVi.MaDV}}" ng-repeat="DonVi in DV_list">
                                {{DonVi.TenDV}}
                                </option>
                              </optgroup>
                          </select>
                        </div>  
                        <button class="col-md-1 btn-primary btn-sm" data-toggle="modal"
                                          data-target="#tao-don-vi">+</button>
                      </div>
                    </div>
                  </div>
                    
                  <!-- only edit -->

                  <div class="form-group clearfix"></div>
                  <div class="row">                      
                      <div class="col-md-6">
                          <label>Giá vốn</label>                          
                          <input type="text" id="prd_price" format="number" ng-model="giaVon" value="" placeholder="0" ng-keyup="nhapGiaVon()"
                                           class="form-control text-right txtNumber"/>
                      </div>
                      <div class="col-md-6">
                          <label>Giá bán </label>                          
                          <input type="text" id="prd_sell" format="number" ng-model="giaBan" value="" placeholder="0" ng-keyup="nhapGiaBan()"
                                           class="form-control text-right txtNumber"/>
                      </div>
                  </div>
                  <div class="form-group clearfix"></div>
                  <div class="row">        
                                
                      <div class="col-md-6">
                          <label>loại hàng</label>   
                          <div class="row">
                            <div class="col-md-11">
                              <select class="form-control" ng-model="hanghoa.MaLHH">
                                  <option value="" selected="selected">Loại hàng hóa</option>
                                  <optgroup label="Chọn loại hàng">
                                  <option ng-selected="LoaiHangHoa.MaLHH===hanghoa.MaLHH" ng-value="{{LoaiHangHoa.MaLHH}}" ng-repeat="LoaiHangHoa in LHH_list">
                                  {{LoaiHangHoa.TenLHH}}
                                  </option>
                                  </optgroup>
                              </select>
                            </div>  
                            <button class="col-md-1 btn-primary btn-sm" data-toggle="modal"
                                              data-target="#tao-loai-hang">+</button>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <label>Nhà sản xuất</label>   
                          <div class="row">
                            <div class="col-md-11">
                              <select class="form-control" ng-model="hanghoa.MaNSX">
                                  <option value="" selected="selected">Nhà sản xuất</option>
                                  <optgroup label="Chọn nhà sản xuất">    
                                  <option ng-selected="NhaSanXuat.MaNSX===hanghoa.MaNSX" ng-value="{{NhaSanXuat.MaNSX}}" ng-repeat="NhaSanXuat in NSX_list">
                                  {{NhaSanXuat.TenNSX}}
                                  </option>           
                                  </optgroup>
                              </select>
                            </div>
                            <button class="col-md-1 btn-primary btn-sm" data-toggle="modal"
                                              data-target="#tao-nha-san-xuat">+</button>
                          </div>
                      </div>                        
                  </div>
                  
                </div>
                <!-- body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-10"></div>                      
                      <button class="col-md-2 btn btn-info pull-right" ng-show="create"  ng-click="themHangHoa()">Lưu</button>
                      <button class="col-md-2 btn btn-info pull-right" ng-show="!create"  ng-click="suaHangHoa()">Cập nhật</button>                                      
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Tạo loại hàng -->
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="tao-loai-hang">
            <div class="modal-dialog modal-md" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">TẠO LOẠI HÀNG</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                  <div class="row">                      
                    <table class="table table-bordered">
                      <tr>
                        <th class="text-center">Tên loại hàng</th>
                        <th colspan="2" class="text-center">Thiết lập</th>                        
                      </tr>
                      <tbody>
                        <tr ng-repeat="item in LHH_list">
                          <td class="text-center" ng-show="!editLHH[$index]">{{item.TenLHH}}</td>
                          <td width="50%" class="text-center" ng-show="editLHH[$index]">
                            <input type="text" id="TenLHH" ng-model="item.TenLHH" ng-value="item.TenLHH" class="form-control text-center"/>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-primary" ng-disabled="LHHDisableEdit" ng-show="!editLHH[$index]" ng-click="editLHH[$index]=true;LHHDisableEditFunc(true)">Sửa</button>
                            <button class="btn-sm btn-primary" ng-show="editLHH[$index]" ng-click="suaLoaiHangHoa(item);editLHH[$index]=false;LHHDisableEditFunc(false)">Lưu</button>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-danger"  ng-disabled="LHHDisableEdit" ng-click="xoaLoaiHangHoa(item.MaLHH)" >Xóa</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group clearfix"></div>
                  <div class="row">                      
                    <div class="col-md-10">                          
                      <input type="text" id="TenLHH" ng-model="LHH.TenLHH" value="" class="form-control" placeholder="Nhập tên loại hàng hóa mới"/>
                    </div>                                        
                    <button class="col-md-2 btn-primary btn-sm"  ng-click="themLoaiHangHoa()">Lưu</button>  
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
      <!-- Tạo nhà sản xuất -->
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="tao-nha-san-xuat">
            <div class="modal-dialog modal-md" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">TẠO NHÀ SẢN XUẤT</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                  <div class="row">                      
                    <table class="table table-bordered">
                      <tr>
                        <th class="text-center">Tên nhà sản xuất</th>
                        <th colspan="2" class="text-center">Thiết lập</th>                        
                      </tr>
                      <tbody>
                        <tr ng-repeat="item in NSX_list">
                          <td class="text-center" ng-show="!editNSX[$index]">{{item.TenNSX}}</td>
                          <td width="50%" class="text-center" ng-show="editNSX[$index]">
                            <input type="text" id="TenNSX" ng-model="item.TenNSX" ng-value="item.TenNSX" class="form-control text-center"/>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-primary" ng-disabled="NSXDisableEdit" ng-show="!editNSX[$index]" ng-click="editNSX[$index]=true;NSXDisableEditFunc(true)">Sửa</button>
                            <button class="btn-sm btn-primary" ng-show="editNSX[$index]" ng-click="suaNhaSanXuat(item);editNSX[$index]=false;NSXDisableEditFunc(false)">Lưu</button>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-danger"  ng-disabled="NSXDisableEdit" ng-click="xoaNhaSanXuat(item.MaNSX)" >Xóa</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group clearfix"></div>
                  <div class="row">                      
                      <div class="col-md-10">                          
                          <input type="text" id="TenNSX" ng-model="NSX.TenNSX" value="" class="form-control" placeholder="Nhập tên nhà sản xuất mới"/>
                      </div>                                        
                      <button class="col-md-2 btn-primary btn-sm"  ng-click="themNhaSanXuat()">Lưu</button>  
                  </div>
                </div>
                <!-- body -->
                <div class="card-footer">
                                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- tạo đơn vị -->
      <div class="row">
        <div class="col-md-12">
          <div class="modal fade" id="tao-don-vi">
            <div class="modal-dialog modal-md" >
              <div class="modal-content">
                <div class="modal-header" >
                  <h7 class="modal-title text-primary">TẠO ĐƠN VỊ</h7>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- body -->
                <div class="modal-body">
                  <div class="row">                      
                    <table class="table table-bordered">
                      <tr>
                        <th class="text-center">Tên đơn vị</th>
                        <th colspan="2" class="text-center">Thiết lập</th>                        
                      </tr>
                      <tbody>
                        <tr ng-repeat="item in DV_list">
                          <td class="text-center" ng-show="!editDV[$index]">{{item.TenDV}}</td>
                          <td width="50%" class="text-center" ng-show="editDV[$index]">
                            <input type="text" id="TenDV" ng-model="item.TenDV" ng-value="item.TenDV" class="form-control text-center"/>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-primary" ng-disabled="DVDisableEdit" ng-show="!editDV[$index]" ng-click="editDV[$index]=true;DVDisableEditFunc(true)">Sửa</button>
                            <button class="btn-sm btn-primary" ng-show="editDV[$index]" ng-click="suaDonVi(item);editDV[$index]=false;DVDisableEditFunc(false)">Lưu</button>
                          </td>
                          <td class="text-center">
                            <button class="btn-sm btn-danger" ng-disabled="DVDisableEdit" ng-click="xoaDonVi(item.MaDV)" >Xóa</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group clearfix"></div>
                  <div class="row">                      
                      <div class="col-md-10">                          
                          <input type="text" id="TenDV" ng-model="DV.TenDV" value="" class="form-control" placeholder="Nhập tên đơn vị tính mới"/>
                      </div>                                        
                      <button class="col-md-2 btn-primary btn-sm"  ng-click="themDonVi()">Lưu</button>  
                  </div>
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