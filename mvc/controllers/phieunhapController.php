<?php 
/**
 * 
 */
class phieunhapController extends controller
{
	
	function index(){
		$this->view('index',['template'=>'phieunhap\phieunhap_list']);
	}

	function nhaphang(){
		$this->view('index',['template'=>'phieunhap\nhaphang']);
	}

	function getLastID()
	{
		$model = $this->model("phieunhap");
		$result = $model->getLastID();
		echo $result;
	}


	function getListByMaNCC($MaNCC){
		$model = $this->model('phieunhap');
		if(method_exists($model,"getListByMaNCC")){
			echo $model->getListByMaNCC($MaNCC);
		}	
	}

	function getByKey($key)
	{
		$model = $this->model("phieunhap");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList($ngayDau=null, $ngayCuoi=null)
	{
		$model = $this->model("phieunhap");		
		$result = $model->listAll($ngayDau,$ngayCuoi);
		echo $result;
	}


	function report($NgayDau,$NgayCuoi,$MaKho){
		$model = $this->model('phieunhap');
		if(method_exists($model,"report")){
			echo $model->report($NgayDau,$NgayCuoi,$MaKho);
		}	
	}

	function add()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$now = date('Y-m-d H:i:s');
		
		$postdata = file_get_contents("php://input");		
		$ChiTietphieunhap = json_decode($postdata,true);		
		$ChiTietphieunhap['ChiTietPhieuNhap'] = json_encode($ChiTietphieunhap['ChiTietPhieuNhap']);
		$ChiTietphieunhap['NgayNhap'] = $now;
		$model = $this->model("phieunhap");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietphieunhap);
		}
	}

	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietphieunhap = json_decode($postdata,true);			
		$model = $this->model("phieunhap");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietphieunhap);
		}
	}
}
?>
