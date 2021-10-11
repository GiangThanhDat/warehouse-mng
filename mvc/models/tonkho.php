<?php 
/**
 * 
 */
class tonkho extends data
{
	public function add($post_request){		
		echo $this->InsertObject("TonKho",$post_request);
	}
	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE TonKho SET `$column` = '$value' WHERE MaTonKho = $key");
		// echo "UPDATE TonKho SET `column` = '$value' WHERE MaTonKho = $key";
		if($result){
			$result = $this->execute("SELECT * FROM TonKho WHERE MaTonKho = $key");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM TonKho WHERE MaTonKho = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}	

	public function getLastId()
	{
		$result = $this->execute("SELECT `MaTonKho` FROM TonKho ORDER BY `MaTonKho` DESC LIMIT 1");
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	function update($TonKhoPostData)
	{
		$key = $TonKhoPostData["MaTonKho"];
		return $this->updateObject('TonKho',$TonKhoPostData,'MaTonKho',$key);
	}

	function updateSTL($TonKhoPostData)
	{
		$update = "UPDATE tonkho SET 
			SoLuongTon={$TonKhoPostData['SoLuongTon']}
			WHERE MaKho={$TonKhoPostData['MaKho']} and MaHH={$TonKhoPostData['MaHH']} ";			
		$result = $this->execute($update);
		echo $result;
	}

	
	public function getIDPrdInventory($MaKho){
		$result = $this->execute("SELECT MaHH,SoLuongTon FROM `tonkho` WHERE MaKho = '{$MaKho}'");
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc()) {				
				array_push($list,$row);
			}			
			return json_encode($list);
		}
		return 0;
	}

	public function report($MaKho){
		$SQLCommand = "SELECT SUM(SoLuongTon) AS SoLuongSanPham,COUNT(MaHH) AS SoSanPham FROM `tonkho` WHERE 1";
		if($MaKho != '-1'){
			$SQLCommand .= " AND MaKho = '$MaKho'";
		}		
		$result = $this->execute($SQLCommand);
		$list = [];
		if($result){
			$row = $result->fetch_assoc();							
			return json_encode($row);
		}
		return 0;
	}



	public function getInventory($MaKho=null,$MaLHH=null,$MaNSX=null){
		$query = "SELECT *,SUM(SoLuongTon) AS TongSoLuongTon, SUM((`hanghoa`.GiaNhap * `tonkho`.SoLuongTon )) AS VonTonKho ,SUM((`hanghoa`.GiaBan * `tonkho`.SoLuongTon)) AS GiaTriTon  FROM `tonkho` join `hanghoa` ON(`tonkho`.`MaHH` = `hanghoa`.`MaHH`) WHERE 1";

		$query .= ($MaKho != '-1' && !empty($MaKho) && $MaKho != null) ? " AND MaKho = '{$MaKho}'" : "";
		$query .= ($MaLHH != '-1' && !empty($MaLHH) && $MaLHH != null) ? " AND MaLHH = '{$MaLHH}'" : "";
		$query .= ($MaNSX != '-1' && !empty($MaNSX) && $MaLHH != null) ? " AND MaNSX = '{$MaNSX}'" : "";	

		$query .= " GROUP BY `tonkho`.MaHH";

		$result = $this->execute($query);
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc()) {
				array_push($list,$row);
			}			
			return json_encode($list);
		}
		return 0;
	}



	public function getProductsQuantity(){
		$result = $this->execute("SELECT MaHH,SUM(SoLuongTon) as SoLuongTon FROM tonkho GROUP BY MaHH");
		$list = [];
		if($result){
			while ($row = $result->fetch_assoc()) {
				array_push($list,$row);
			}			
			return json_encode($list);
		}
		return 0;
	}


	public function getSLT($MaKho,$MaHH)
	{
		$result = $this->execute("SELECT (SoLuongTon) FROM tonkho WHERE MaKho={$MaKho} and MaHH={$MaHH}");		
		if($result){
			$row = $result->fetch_assoc();
			return $row;
		}
		return 0;
	}

	public function listAll(){
		$result = $this->execute("SELECT * FROM TonKho");
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
		$result = $this->execute("SELECT * FROM TonKho WHERE MaTonKho = '$key'");		
		if($result){
			$TonKho = $result->fetch_assoc();
			// print_r($TonKho);
			return json_encode($TonKho);
		}
		return 0;
	}
}
 ?>