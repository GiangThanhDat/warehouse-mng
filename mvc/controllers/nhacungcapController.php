<?php 
/**
 * 
 */
class nhacungcapController extends controller
{
	

	function index(){
		// $this->view('index',['template'=>'nhacungcap\nhacungcap_list']);
	}
		
	function getLastID()
	{
		$model = $this->model("nhacungcap");
		$result = $model->getLastID();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("nhacungcap");
		$result = $model->getByKey($key);
		echo $result;
	}

	function getList()
	{
		$model = $this->model("nhacungcap");
		$result = $model->listAll();
		echo $result;
	}

	function listAllCalc(){
		$model = $this->model("nhacungcap");
		$result = $model->listAllCalc();
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietnhacungcap = json_decode($postdata,true);			
		$model = $this->model("nhacungcap");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietnhacungcap);
		}
	}
	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietnhacungcap = json_decode($postdata,true);			
		$model = $this->model("nhacungcap");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietnhacungcap);
		}		
	}

	function remove($ma_nhacungcap){
		$model = $this->model("nhacungcap");
		if (method_exists($model,"remove")) {
			echo $model->remove($ma_nhacungcap);
		}
	}
}
?>
