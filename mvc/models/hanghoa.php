<?php 
/**
 * 
 */
class hanghoa extends data
{
	

	public function add($post_request){		
		echo $this->InsertObject("hanghoa",$post_request);
	}

	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE hanghoa SET `$column` = '$value' WHERE MaHH = $key");
		// echo "UPDATE hanghoa SET `$column` = '$value' WHERE MaHH = $key";
		if($result){
			$result = $this->execute("SELECT * FROM hanghoa WHERE MaHH = '$key'");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	function update($hanghoaPostData)
	{
		$key = $hanghoaPostData["MaHH"];
		return $this->updateObject('hanghoa',$hanghoaPostData,'MaHH',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM hanghoa WHERE MaHH = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM hanghoa");
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
		$result = $this->execute("SELECT * FROM hanghoa JOIN donvido ON(hanghoa.ma_donvi = donvido.ma_donvi) WHERE MaHH = '$key'");
		if($result){
			$hanghoa = $result->fetch_assoc();
			return json_encode($hanghoa);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `MaHH` FROM hanghoa ORDER BY `MaHH` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			if($lastID != null){
				return json_encode($lastID);	
			}
		}
		return 0;
	}

	public function getListSensorsByStation($ma_tram)
	{
		$query  = "SELECT * FROM hanghoa WHERE `ma_tram` = '$ma_tram'";		
		$result = $this->execute($query);	
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc())  {
				$sensorKey = $row['MaHH'];
				array_push($list,json_decode($this->getByKey($sensorKey),true));
			}
			return $list;
		}		
		return 0;
	}
	
}
 ?>