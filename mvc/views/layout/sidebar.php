
<!-- Main Sidebar Container -->
<!--  -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" ng-controller="PhanQuyenNguoiDungController" > 

  <!-- Brand Logo -->
  <a href="TongQuan" class="brand-link">
    <img src="./public/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Quản Lý Hệ Thống</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="./public/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="NhanSu/CaNhan" class="d-block">{{accountInfor.display_name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- <li class="nav-item" ng-show="checkRoles('Tổng Quan')"> -->
        <li class="nav-item" >
          <a href="trangchu" class="nav-link" ng-class="{ 'active': controllerName=='trangchu'}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Trang Chủ
           </p>
         </a>
       </li>
       
       <li class="nav-item" >
        <a href="phieuxuat" class="nav-link" ng-class="{ 'active': controllerName=='phieuxuat' || controllerName=='donhang' }">          
        <i class="nav-icon  fas fa-shopping-cart"></i>
          <p>
            Đơn hàng
          </p>
        </a>
      </li>      
      <li class="nav-item" >
        <a href="hanghoa" class="nav-link" ng-class="{ 'active': controllerName=='hanghoa'}">
        <i class="nav-icon  fab fa-product-hunt"></i>
          <p>
            Hàng hóa
          </p>
        </a>
      </li>
      
      <li class="nav-item" >
        <a href="doitac" class="nav-link" ng-class="{ 'active': controllerName=='doitac'}">
          <i class="nav-icon fas fa-users"></i>
          <p>
          Đối tác
          </p>
        </a>
      </li> 
      
      <li class="nav-item" >
        <a href="phieunhap" class="nav-link" ng-class="{ 'active': controllerName=='phieunhap' || controllerName=='nhaphang'}">
        <i class="nav-icon fas fa-truck"></i>
          <p>
          Nhập kho
          </p>
        </a>
      </li> 
       
      <li class="nav-item" >
        <a href="tonkho" class="nav-link" ng-class="{ 'active': controllerName=='tonkho'}">
          <i class="nav-icon fas fa-warehouse"></i>
          <p>
          Tồn kho
          </p>
        </a>
      </li> 
      <!-- 
      <li class="nav-item" >
        <a href="hanghoa" class="nav-link">
        <i class="nav-icon fab fa-connectdevelop"></i>
          <p>
          Doanh số
          </p>
        </a>
      </li>   -->         
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>

<!-- /.sidebar -->
</aside>

</li>

 <!-- Divider -->
 <hr class="sidebar-divider d-none d-md-block">

 <!-- Sidebar Toggler (Sidebar) -->
 <div class="text-center d-none d-md-inline">
     <button class="rounded-circle border-0" id="sidebarToggle"></button>
 </div>

</ul>
    <!-- End of Sidebar -->