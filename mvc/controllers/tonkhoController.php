<?php 
/**
 * 
 */
class tonkhoController extends controller
{
	
	function index(){
		$this->view('index',['template'=>'tonkho\tonkho_list']);
	}


	function getLastID()
	{
		$model = $this->model("tonkho");
		$result = $model->getLastID();
		echo $result;
	}

	function report($MaKho){
		$model = $this->model('tonkho');
		if(method_exists($model,"report")){
			echo $model->report($MaKho);
		}	
	}


	function getProductsQuantity(){
		$model = $this->model('tonkho');
		if(method_exists($model,"getProductsQuantity")){
			echo $model->getProductsQuantity();
		}
	}



	// lấy những hàng hóa còn tồn trong kho có MaKho = $MaKho
	function getInventory($MaKho=null,$MaLHH=null,$MaNSX=null){
		$model = $this->model('tonkho');
		if(method_exists($model,"getInventory")){
			echo $model->getInventory($MaKho,$MaLHH,$MaNSX);
		}
	}

	// lấy ID hàng hóa còn tồn trong kho (nhaphang)
	function getIDPrdInventory($MaKho){
		$model = $this->model('tonkho');
		if(method_exists($model,"getIDPrdInventory")){
			echo $model->getIDPrdInventory($MaKho);
		}
	}


	function getByKey($key)
	{
		$model = $this->model("tonkho");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("tonkho");
		$result = $model->listAll();
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTiettonkho = json_decode($postdata,true);			
		$model = $this->model("tonkho");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTiettonkho);
		}
	}


	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietTonKho = json_decode($postdata,true);	
		print_r($ChiTietTonKho);
		$model = $this->model("tonkho");	
		foreach ($ChiTietTonKho as $value) {
			$result = $model->getSLT($value['MaKho'],$value['MaHH']);  // lấy số lượng tồn của hàng hóa x trong kho y
			$update['MaKho'] = $value['MaKho'];
			$update['MaHH'] = $value['MaHH'];	
			// nếu kho y có tồn hàng hóa x
			if(!empty($result)){		
				// cập nhật thêm số lượng nhập
				if(isset($value['SoLuongBan'])){// nếu tạo đơn hàng, chỉ tạo đơn hàng với những hàng còn trong kho
					$update['SoLuongTon'] =  (float)$result['SoLuongTon'] - (float)$value['SoLuongBan'];
				}else if (isset($value['SoLuongNhap'])){ // nếu nhập hàng
					$update['SoLuongTon'] =  (float)$result['SoLuongTon'] + (float)$value['SoLuongNhap'];
				}
				echo $model->updateSTL($update);
			}else{				
				// thêm mới hàng hóa x vào kho y
				$update['SoLuongTon'] = (float)$value['SoLuongNhap'];
				echo $model->add($update);
			}
		}
	}
}
?>
