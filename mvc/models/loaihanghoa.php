<?php 
/**
 * 
 */
class loaihanghoa extends data
{
	

	public function add($post_request){		
		echo $this->InsertObject("loaihanghoa",$post_request);
	}

	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE loaihanghoa SET `$column` = '$value' WHERE MaLHH = $key");
		// echo "UPDATE loaihanghoa SET `$column` = '$value' WHERE MaLHH = $key";
		if($result){
			$result = $this->execute("SELECT * FROM loaihanghoa WHERE MaLHH = '$key'");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	function update($loaihanghoaPostData)
	{
		$key = $loaihanghoaPostData["MaLHH"];
		return $this->updateObject('loaihanghoa',$loaihanghoaPostData,'MaLHH',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM loaihanghoa WHERE MaLHH = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM loaihanghoa");
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
		$result = $this->execute("SELECT * FROM loaihanghoa JOIN donvido ON(loaihanghoa.ma_donvi = donvido.ma_donvi) WHERE MaLHH = '$key'");
		if($result){
			$loaihanghoa = $result->fetch_assoc();
			return json_encode($loaihanghoa);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `MaLHH` FROM loaihanghoa ORDER BY `MaLHH` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	
}
 ?>