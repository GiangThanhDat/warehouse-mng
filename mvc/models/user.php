<?php 
/**
 * 
 */
class user extends data
{
	public function add($post_request){		
		echo $this->InsertObject("user",$post_request);
	}


	function update($userPostData)
	{
		$key = $userPostData["username"];
		return $this->updateObject('user',$userPostData,'username',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM user WHERE username = '$key'");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM user");
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc()) {
				array_push($list,$row);
			}			
			return json_encode($list);
		}
		return 0;
	}

	public function getByKey($key){
		$result = $this->execute("SELECT * FROM user WHERE username = '$key'");
		if($result){
			$user = $result->fetch_assoc();
			return json_encode($user);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `username` FROM user ORDER BY `username` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	public function isDuplicateAccount($username)
	{
		$result = $this->execute("SELECT `username` FROM user WHERE `username`='$username' LIMIT 1");
		if($result->num_rows > 0){
			return 1;
		}
		return 0;
	}	

	public function getListAccount()
	{
		$result = $this->execute("SELECT * FROM user");
		$list = [];
		if($result->num_rows > 0){
			while($user = $result->fetch_assoc()){
				unset($user['password_hash']);	
				array_push($list,$user);
			}
			return json_encode($list);
		}
		return 0;
	}
	
	public function getAccountInfor($username)
	{
		$result = $this->execute("SELECT * FROM user WHERE `username`='$username' LIMIT 1");
		if($result->num_rows > 0){
			$user = $result->fetch_assoc();
			unset($user['password_hash']);
			return json_encode($user);
		}
		return 0;
	}

	
	public function checkLogin($loginInfor)
	{
		$username = $loginInfor['username'];
		$password = $loginInfor['password'];

		$result = $this->execute("SELECT * FROM user WHERE `username`='$username' LIMIT 1");
		// select ra coi c?? trong csdl ko
		if($result->num_rows > 0){
			$user = $result->fetch_assoc();
			$password_hash = $user['password_hash'];			
			// n???u c?? th?? ki???m tra m???t kh???u gi???ng ko
			if ( password_verify ( $password , $password_hash )) {
				/* future proof the password */

				//n???u gi??ng l?? coi nh??? cho ph??p s??i h??? th???ng
				//t???o session ????? bi???t l?? ??ng n??y ???????c ph??p d??ng h??? th???ng
				$_SESSION['username'] = $username; // pass ???? ????ng cho user v??o h??? th???ng
				unset($user['password_hash']);

				if ( password_needs_rehash($password_hash , PASSWORD_DEFAULT)) {
					/* recreate the hash */
					$rehashed_password = password_hash($password, PASSWORD_DEFAULT );
					/* store the rehashed password in MySQL */
					$this->update(['username'=>$username,'password_hash'=>$rehashed_password]);			
				}				
				return $username;
				/* password verified, let the user in */
			}
			else {
				return null;
			}
		}
		return null;
	}
}
 ?>