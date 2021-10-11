<?php 
/**
 * 
 */
class khoController extends controller
{
	

	function getLastID()
	{
		$model = $this->model("kho");
		$result = $model->getLastID();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("kho");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("kho");
		$result = $model->listAll();
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietkho = json_decode($postdata,true);			
		$model = $this->model("kho");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietkho);
		}
	}

	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietkho = json_decode($postdata,true);			
		$model = $this->model("kho");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietkho);
		}
	}

		function remove($MaKho){
		$model = $this->model("kho");
		if (method_exists($model,"remove")) {
			echo $model->remove($MaKho);
		}
	}
}
?>
