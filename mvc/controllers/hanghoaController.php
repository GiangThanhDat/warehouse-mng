<?php 
/**
 * 
 */
class hanghoaController extends controller
{
	

	function index(){
		$this->view('index',['template'=>'hanghoa\hanghoa_list']);
	}


	function getLastID()
	{
		$model = $this->model("hanghoa");
		$result = $model->getLastID();
		echo $result;
	}

	
	function getList()
	{
		$model = $this->model("hanghoa");
		$result = $model->listAll();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("hanghoa");
		$result = $model->getByKey($key);
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTiethanghoa = json_decode($postdata,true);			
		$model = $this->model("hanghoa");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTiethanghoa);
		}
	}

	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTiethanghoa = json_decode($postdata,true);			
		$model = $this->model("hanghoa");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTiethanghoa);
		}		
	}

	function remove($MaHH){
		$model = $this->model("hanghoa");
		if (method_exists($model,"remove")) {
			echo $model->remove($MaHH);
		}
	}

}
?>
