<?php 
/**
 * 
 */
class kho extends data
{
	public function add($post_request){		
		echo $this->InsertObject("kho",$post_request);
	}
	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE kho SET `$column` = '$value' WHERE MaKho = $key");
		// echo "UPDATE kho SET `column` = '$value' WHERE MaKho = $key";
		if($result){
			$result = $this->execute("SELECT * FROM kho WHERE MaKho = $key");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM kho WHERE MaKho = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}	

	public function getLastId()
	{
		$result = $this->execute("SELECT `MaKho` FROM kho ORDER BY `MaKho` DESC LIMIT 1");
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	function update($khoPostData)
	{
		$key = $khoPostData["MaKho"];
		return $this->updateObject('kho',$khoPostData,'MaKho',$key);
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM kho");
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
		$result = $this->execute("SELECT * FROM kho WHERE MaKho = '$key'");		
		if($result){
			$kho = $result->fetch_assoc();
			// print_r($kho);
			return json_encode($kho);
		}
		return 0;
	}
}
 ?>