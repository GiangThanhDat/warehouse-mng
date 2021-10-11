<?php 
/**
 * 
 */
class app
{

	protected $controller = "BaoMatController";
	protected $action = "index";
	protected $params = [];

	//setter
	public function setController($controller){
	//  CONTROLLERS.$controller."Controller.php";	

		if(file_exists(CONTROLLERS.$controller."Controller.php")){ // kiểm tra xem controller request có tồn tại trong project hay không?
			$this->controller = $controller."Controller"; 
			/* quy ước đặt tên controller là ten controller + Controller 
			VD: homeController*/	
		}				
	}

	public function setAction($action){
	//  $action;		
		$this->controller."</br>";
		if(method_exists($this->controller, $action)){	//kiểm tra xem action request có tồn tại trong controller vừa chọn hay không?
			$this->action = $action;			
		}
	}

	public function setParams($params=[]){
		if(isset($params)){
			$this->params = array_values($params);	
		}else 
			$this->params = [];			
	}

	//getter
	public function getController(){
		return $this->controller;
	}

	public function getAction(){
		return $this->action;
	}

	public function getParams(){
		return $this->params;
	}

	//method

	function urlProcess($url){
		$arr_url = explode("/",trim($url));			
		if(isset($arr_url[0])){		
			$this->setController($arr_url[0]);
		}	
		require_once CONTROLLERS.$this->controller.".php";
		if(isset($arr_url[1])){			
			$this->setAction($arr_url[1]);
		}
		unset($arr_url[0],$arr_url[1]);
		if(isset($arr_url)){
			$this->setParams($arr_url);
		}
	}	

	function __construct(){			
		// print_r($_SESSION);

		if(isset($_GET['url'])){			
			$url = $_GET['url'];
				
			// if (!(isset($_SESSION['username'])) // cái này là đã đăng nhập rồi thì cho qua
			// 	|| ($url==="User/DangNhap") // chặn đường này thì thua luôn :)))
			// 	|| ($url==="User/DangKy") // đường này để lưu tài khoản mới vô Database
			// 	|| (strpos($url,"User/isDuplicateAccount") !== false) // đường này check tên tài khoản trùng
			// 	|| ($url==="BaoMat/DangKy") // đường này để điều hướng đến trang đăng ký
			// 	|| ($url==="giatri/thuthap")) // đường này là cho con ESP32 gửi lên, mắc công bị chặn
			// { 
				$this->urlProcess($url);
			// }
			// $this->urlProcess($url);
		}
		// echo $this->controller."</br>".$this->action."</br>";
		require_once CONTROLLERS.$this->controller.".php";// đề phòng trường hợp đường dẫn tầm bậy
		$this->controller = new $this->controller;	
		// $this->controller = new home();
		call_user_func_array([$this->controller,$this->action], $this->params);


	}

	
}
 ?>
