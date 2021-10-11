<?php 
/**
 * 
 */
class donviController extends controller
{
	

	function getLastID()
	{
		$model = $this->model("donvi");
		$result = $model->getLastID();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("donvi");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("donvi");
		$result = $model->listAll();
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietdonvi = json_decode($postdata,true);			
		$model = $this->model("donvi");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietdonvi);
		}
	}

	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietdonvi = json_decode($postdata,true);			
		$model = $this->model("donvi");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietdonvi);
		}
	}

	function remove($MaDV){
		$model = $this->model("donvi");
		if (method_exists($model,"remove")) {
			echo $model->remove($MaDV);
		}
	}
}
?>
