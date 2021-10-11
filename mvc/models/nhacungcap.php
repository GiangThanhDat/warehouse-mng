<?php 
/**
 * 
 */
class nhacungcap extends data
{
	

	public function add($post_request){		
		echo $this->InsertObject("nhacungcap",$post_request);
	}

	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE nhacungcap SET `$column` = '$value' WHERE MaNCC = $key");
		// echo "UPDATE nhacungcap SET `$column` = '$value' WHERE MaNCC = $key";
		if($result){
			$result = $this->execute("SELECT * FROM nhacungcap WHERE MaNCC = '$key'");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	function update($nhacungcapPostData)
	{
		$key = $nhacungcapPostData["MaNCC"];
		return $this->updateObject('nhacungcap',$nhacungcapPostData,'MaNCC',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM nhacungcap WHERE MaNCC = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll() {
		$SqlCommand = "SELECT * FROM `nhacungcap`";		
		$result = $this->execute($SqlCommand);
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc()) {
				array_push($list,$row);
			}			
			return json_encode($list);
		}
		return 0;
	}

	public function listAllCalc(){
		$SqlCommand = "
		SELECT `nhacungcap`.MaNCC,TenNCC,DiaChiNCC,STDNCC,email,SUM(TongGiaNhap) AS TongGiaNhapCacPhieu,SUM(TongGiaNhap) - SUM(DaTra) AS 'TongNoCacPhieu' FROM nhacungcap LEFT JOIN phieunhap ON(`nhacungcap`.MaNCC = `phieunhap`.MaNCC) GROUP BY `nhacungcap`.MaNCC";		
		// echo $SqlCommand;
		$result = $this->execute($SqlCommand);
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
		$result = $this->execute("SELECT * FROM nhacungcap WHERE MaNCC = '$key'");
		if($result){
			$nhacungcap = $result->fetch_assoc();
			return json_encode($nhacungcap);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `MaNCC` FROM nhacungcap ORDER BY `MaNCC` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}


	
}
 ?>