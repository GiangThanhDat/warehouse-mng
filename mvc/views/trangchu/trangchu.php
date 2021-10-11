  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="trangchuController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Danh Sách tồn kho</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="trangchu">Trang chủ</a></li>              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">        
        <h3>Báo cáo doanh thu từ <span class="text-primary">{{timeFilter.start|date:'dd-MM-yyyy'}}</span> đến <span class="text-primary">{{timeFilter.end|date:'dd-MM-yyyy'}}</span></h3>                          
        <!-- Báo cáo nhanh -->                         
        <div class="row">
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5>{{BoxBaoCao.TonKho.SoSanPham}} mặt hàng</h5>             
                <h3>Số lượng tồn {{BoxBaoCao.TonKho.SoLuongSanPham}}</h3>
                <p>Tồn kho</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div> 
               <a href="tonkho" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>{{BoxBaoCao.BanHang.SoDonHang}} đơn hàng</h5>
                <h3>Tổng thu {{BoxBaoCao.BanHang.TongThanhTien|number}}đ</h3>
                <p>Bán hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="phieuxuat" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5>{{BoxBaoCao.NhapHang.SoPhieuNhap}} phiếu nhập</h5>
                <h3>Đã chi {{BoxBaoCao.NhapHang.TongThanhTien|number}}đ</h3>
                <p>Nhập hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="phieunhap" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- end Báo cáo nhanh -->     

        <!-- Biểu đồ báo cáo  -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-primary">Báo cáo doanh thu</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                   <div class="card">
                    <div class="card-header border-transparent">
                      <h3 class="card-title " >
                        Thời gian :  <span class="text-primary">{{timeFilter.start|date:'dd-MM-yyyy'}}</span> đến <span class="text-primary">{{timeFilter.end|date:'dd-MM-yyyy'}}</span> tại <span class="text-primary">{{Kho.TenKho}}</span>
                      </h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0"> 
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="bieuDoBaoCaoDoanhThu" height="310" style="height: 310px;"></canvas>
                      </div>
                      <!-- /.chart-responsive -->                         
                      <div class="form-check form-check-inline">
                        <label class="form-check-label" >Các dạng hiển thị :</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" ng-model="chartTypes" value="line" ng-change="changeTypeChart(chartTypes);fillChartShow=true" id="line" name="chartTypes" checked="true" >     
                        <label class="form-check-label" for="line">Line</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" ng-model="chartTypes" value="radar" ng-change="changeTypeChart(chartTypes);fillChartShow=true" id="radar" name="chartTypes" >     
                        <label class="form-check-label" for="radar">Radar</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" ng-model="chartTypes" value="bar" ng-change="changeTypeChart(chartTypes);fillChartShow=false" id="bar" name="chartTypes"  >     
                        <label class="form-check-label" for="bar">Bar</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" ng-model="chartTypes" value="pie" ng-change="changeTypeChart(chartTypes);fillChartShow=false" id="pie" name="chartTypes" >     
                        <label class="form-check-label" for="pie">Pie</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" ng-model="chartTypes" value="doughnut" ng-change="changeTypeChart(chartTypes);fillChartShow=false" id="doughnut" name="doughnut" checked="true" >     
                        <label class="form-check-label" for="doughnut">Doughnut</label>
                      </div>
                    </div>
                  </div> 
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Kho</label>
                    <div class="input-group">
                      <select class="form-control float-left"  ng-model="Kho" ng-change="chonKho()" >
                          <option value="All">Tất cả kho hàng</option>
                          <option ng-value="kho" ng-repeat="kho in Kho_list">{{kho.TenKho}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Móc thời gian</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="button" class="form-control float-right" id="daterange-btn">
                    </div>  
                    <!-- /.input group -->
                  </div>    
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <!-- end Biểu đồ báo cáo  -->

      </div><!-- /.container-fluid -->
      <!-- Các modal - box -->
    </section>
    <!-- /.content -->
  </div>