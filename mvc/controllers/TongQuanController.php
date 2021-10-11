<?php 
/**
 * 
 */
class TongQuanController extends controller
{
	function index()
	{		
		$data = [
			// "component" => "TongQuanComponent",
			// "pages" 	 => "TongQuanView",
			"template" => "TongQuanComponent/TongQuanView"
		];		
		$this->view("index",$data);
	}

	// Api viết ở đây
	
}
?>
