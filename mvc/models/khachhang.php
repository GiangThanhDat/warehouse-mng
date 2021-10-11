<?php 
/**
 * 
 */
class khachhang extends data
{
	

	public function add($post_request){		
		echo $this->InsertObject("khachhang",$post_request);
	}

	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE khachhang SET `$column` = '$value' WHERE MaKH = $key");
		// echo "UPDATE khachhang SET `$column` = '$value' WHERE MaKH = $key";
		if($result){
			$result = $this->execute("SELECT * FROM khachhang WHERE MaKH = '$key'");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	function update($khachhangPostData)
	{
		$key = $khachhangPostData["MaKH"];
		return $this->updateObject('khachhang',$khachhangPostData,'MaKH',$key);
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM khachhang WHERE MaKH = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM khachhang");
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
		$SqlCommand = "SELECT `khachhang`.`MaKH`,TenKH,DiaChiKH,stdKH,email,SUM(TongGiaBan) AS TongGiaBanCacPhieu,SUM(TongGiaBan) - SUM(DaTra) AS 'TongNoCacPhieu' FROM khachhang LEFT JOIN phieuxuat ON(`khachhang`.`MaKH` = `phieuxuat`.`MaKH`) GROUP BY `khachhang`.`MaKH`";
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
		$sqlCommand = "SELECT * FROM khachhang WHERE MaKH = '$key'";
		// echo $sqlCommand;
		$result = $this->execute($sqlCommand);
		if($result){
			$khachhang = $result->fetch_assoc();
			return json_encode($khachhang);
		}
		return 0;
	}

	public function getLastID()
	{
		$result = $this->execute("SELECT `MaKH` FROM khachhang ORDER BY `MaKH` DESC LIMIT 1");		
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}


	
}
 ?>