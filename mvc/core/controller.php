<?php 

/**
 * 
 */
class controller
{		
	
	function __construct()
	{
		
	}

	public function model($model){
		require_once MODElS.$model.".php";
		return new $model;
	}
	//Lưu ý: nên chuyển data về dạng JSON trước khi truyền vào view(chuyển trong models).
	public function view($layout, $data=[]){		
		require_once VIEWS.$layout.".php";
	}	
}
 ?>