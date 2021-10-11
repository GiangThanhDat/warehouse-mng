<?php 
/**
 * 
 */
class phieuxuatController extends controller
{
	
	function index(){
		$this->view('index',['template'=>'phieuxuat\phieuxuat_list']);
	}

	function donhang(){
		$this->view('index',['template'=>'phieuxuat\donhang']);
	}

	function getLastID()
	{
		$model = $this->model("phieuxuat");
		$result = $model->getLastID();
		echo $result;
	}


	function getListByMaKH($MaKH){
		$model = $this->model('phieuxuat');
		if(method_exists($model,"getListByMaKH")){
			echo $model->getListByMaKH($MaKH);
		}	
	}

	function getByKey($key)
	{
		$model = $this->model("phieuxuat");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList($ngayDau=null, $ngayCuoi=null)
	{
		$model = $this->model("phieuxuat");		
		$result = $model->listAll($ngayDau,$ngayCuoi);
		echo $result;
	}

	function report($NgayDau,$NgayCuoi,$MaKho){
		$model = $this->model('phieuxuat');
		if(method_exists($model,"report")){
			echo $model->report($NgayDau,$NgayCuoi,$MaKho);
		}	
	}

	function baoCaoDoanhThuTheoNgayTungKho($NgayDau,$NgayCuoi,$MaKho)
	{
		$model = $this->model('phieuxuat');
		if(method_exists($model,"baoCaoDoanhThuTheoNgayTungKho")){
			echo $model->baoCaoDoanhThuTheoNgayTungKho($NgayDau,$NgayCuoi,$MaKho);
		}		
	}

	function add()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$now = date('Y-m-d H:i:s');
		
		$postdata = file_get_contents("php://input");		
		$ChiTietphieuxuat = json_decode($postdata,true);		
		$ChiTietphieuxuat['ChiTietPhieuXuat'] = json_encode($ChiTietphieuxuat['ChiTietPhieuXuat']);
		$ChiTietphieuxuat['NgayXuat'] = $now;
		$model = $this->model("phieuxuat");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietphieuxuat);
		}
	}

	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietphieuxuat = json_decode($postdata,true);			
		$model = $this->model("phieuxuat");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietphieuxuat);
		}
	}
}
?>
