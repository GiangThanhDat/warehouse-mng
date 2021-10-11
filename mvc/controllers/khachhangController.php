<?php 
/**
 * 
 */
class khachhangController extends controller
{
	

	function index(){
		// $this->view('index',['template'=>'khachhang\khachhang_list']);
	}
		
	function getLastID()
	{
		$model = $this->model("khachhang");
		$result = $model->getLastID();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("khachhang");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("khachhang");
		$result = $model->listAll();
		echo $result;
	}


	function listAllCalc(){
		$model = $this->model("khachhang");
		$result = $model->listAllCalc();
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietkhachhang = json_decode($postdata,true);			
		$model = $this->model("khachhang");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietkhachhang);
		}
	}
	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietkhachhang = json_decode($postdata,true);			
		$model = $this->model("khachhang");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietkhachhang);
		}		
	}

	function remove($ma_khachhang){
		$model = $this->model("khachhang");
		if (method_exists($model,"remove")) {
			echo $model->remove($ma_khachhang);
		}
	}
}
?>
