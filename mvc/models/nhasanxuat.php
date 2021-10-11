<?php 
/**
 * 
 */
class nhasanxuat extends data
{
	

	public function add($post_request){		
		echo $this->InsertObject("nhasanxuat",$post_request);
	}

	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE nhasanxuat SET `$column` = '$value' WHERE MaNSX = $key");
		// echo "UPDATE nhasanxuat SET `$column` = '$value' WHERE MaNSX = $key";
		if($result){
			$result = $this->execute("SELECT * FROM nhasanxuat WHERE MaNSX = '$key'");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	function update($nhasanxuatPostData)
	{
		$key = $nhasanxuatPostData["MaNSX"];
		return $this->updateObject('nhasanxuat',$nhasanxuatPostData,'MaNSX',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM nhasanxuat WHERE MaNSX = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM nhasanxuat");
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
		$result = $this->execute("SELECT * FROM nhasanxuat WHERE MaNSX = {'$key'}");
		if($result){
			$nhasanxuat = $result->fetch_assoc();
			return json_encode($nhasanxuat);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `MaNSX` FROM nhasanxuat ORDER BY `MaNSX` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}


	
}
 ?>