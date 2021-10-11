<?php 
/**
 * 
 */
class NhanSuController extends controller
{
	function index()
	{		
		$data = [
			"component" => "NhanSuComponent",
			"pages" 	 => "NhanSuView",
		];
		$this->view("baseView",$data);
	}

	function donhang(){
		$this->view('index',['template'=>'phieuxuat\donhang']);
	}

	function CaNhan()
	{		
		$data = [
			"component" => "NhanSuComponent",
			"pages" 	 => "ThongTinCaNhanView",
		];
		$this->view("index",['template'=>'NhanSu\ThongTinCaNhan']);
	}
	
	function PhanQuyen()
	{		
		$data = [
			"component" => "NhanSuComponent",
			"pages" 	 => "PhanQuyenView",
		];
		$this->view("baseView",$data);
	}
	
}
?>
