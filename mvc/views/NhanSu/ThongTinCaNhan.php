  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="ThongTinCaNhanController">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thông tin cá nhân</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="TongQuan">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thông tin cá nhân</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="title"></div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="ChinhSua">
                    <form class="form-horizontal" ng-submit="updateAccount()" >
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Tên đăng nhập</label>
                        <div class="col-sm-10">
                          <input type="email" readonly ng-model="accountInfor.username" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Họ và tên</label>
                        <div class="col-sm-10">
                          <input type="text" ng-disabled="!edit" ng-model="accountInfor.display_name" class="form-control" id="inputName" placeholder="Chỉnh họ tên">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" ng-model="accountInfor.email" ng-disabled="!edit" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Ngày tạo</label>
                        <div class="col-sm-10">
                          <span class="form-control" readonly ng-show="!edit">
                            {{accountInfor.create_date  | date:'dd/MM/yyyy' }}
                          </span>
                          <input type="date" class="form-control" ng-model="accountInfor.create_date" ng-show="edit" id="inputName2" value="{{accountInfor.ngaysinh | date:'dd/MM/yyyy' }}" placeholder="Ngày sinh"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" ng-show="!edit" ng-click="edit=true" class="btn btn-primary">Sửa</button>
                          <button type="button" ng-show="edit" ng-click="edit=false" class="btn btn-danger">Hủy</button>
                          <button type="submit" ng-show="edit" ng-click="edit=false" class="btn btn-success">Lưu</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>