<?php 
/**
 * 
 */
class nhasanxuatController extends controller
{
	

	function index(){
		// $this->view('index',['template'=>'nhasanxuat\nhasanxuat_list']);
	}
		
	function getLastID()
	{
		$model = $this->model("nhasanxuat");
		$result = $model->getLastID();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("nhasanxuat");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("nhasanxuat");
		$result = $model->listAll();
		echo $result;
	}



	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietnhasanxuat = json_decode($postdata,true);			
		$model = $this->model("nhasanxuat");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietnhasanxuat);
		}
	}
	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietnhasanxuat = json_decode($postdata,true);			
		$model = $this->model("nhasanxuat");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietnhasanxuat);
		}		
	}

	function remove($ma_nhasanxuat){
		$model = $this->model("nhasanxuat");
		if (method_exists($model,"remove")) {
			echo $model->remove($ma_nhasanxuat);
		}
	}
}
?>
