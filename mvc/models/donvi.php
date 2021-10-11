<?php 
/**
 * 
 */
class donvi extends data
{
	public function add($post_request){		
		echo $this->InsertObject("donvi",$post_request);
	}
	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE donvi SET `$column` = '$value' WHERE MaDV = $key");
		// echo "UPDATE donvi SET `column` = '$value' WHERE MaDV = $key";
		if($result){
			$result = $this->execute("SELECT * FROM donvi WHERE MaDV = $key");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM donvi WHERE MaDV = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}	

	public function getLastId()
	{
		$result = $this->execute("SELECT `MaDV` FROM donvi ORDER BY `MaDV` DESC LIMIT 1");
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	function update($DonViPostData)
	{
		$key = $DonViPostData["MaDV"];
		return $this->updateObject('donvi',$DonViPostData,'MaDV',$key);
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM donvi");
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
		$result = $this->execute("SELECT * FROM donvi WHERE MaDV = '$key'");		
		if($result){
			$donvi = $result->fetch_assoc();
			// print_r($donvi);
			return json_encode($donvi);
		}
		return 0;
	}
}
 ?>