<?php 
/**
 * 
 */
class doitacController extends controller
{
	
	function index(){
		$this->view('index',['template'=>'doitac\doitac_list']);
	}
}
?>
