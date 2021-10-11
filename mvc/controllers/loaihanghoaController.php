<?php 
/**
 * 
 */
class loaihanghoaController extends controller
{
	

	function index(){
		// $this->view('index',['template'=>'loaihanghoa\loaihanghoa_list']);
	}
		
	function getLastID()
	{
		$model = $this->model("loaihanghoa");
		$result = $model->getLastID();
		echo $result;
	}

	function getList(){
		$model = $this->model('loaihanghoa');
		$result = $model->listAll();
		echo $result;
	}

	function getByKey($key)
	{
		$model = $this->model("loaihanghoa");
		$result = $model->getByKey($key);
		echo $result;
	}

	function add()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietloaihanghoa = json_decode($postdata,true);			
		$model = $this->model("loaihanghoa");	
		if(method_exists($model,"add")){
			echo $model->add($ChiTietloaihanghoa);
		}
	}
	function update()
	{
		$postdata = file_get_contents("php://input");		
		$ChiTietloaihanghoa = json_decode($postdata,true);			
		$model = $this->model("loaihanghoa");	
		if(method_exists($model,"update")){
			echo $model->update($ChiTietloaihanghoa);
		}		
	}

	function remove($ma_loaihanghoa){
		$model = $this->model("loaihanghoa");
		if (method_exists($model,"remove")) {
			echo $model->remove($ma_loaihanghoa);
		}
	}
}
?>
