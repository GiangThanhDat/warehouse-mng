<?php 
/**
 * 
 */
class phieuxuat extends data
{
	public function add($post_request){		
		echo $this->InsertObject("phieuxuat",$post_request);
	}
	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE phieuxuat SET `$column` = '$value' WHERE MaPX = $key");
		// echo "UPDATE phieuxuat SET `column` = '$value' WHERE MaPX = $key";
		if($result){
			$result = $this->execute("SELECT * FROM phieuxuat WHERE MaPX = $key");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM phieuxuat WHERE MaPX = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}	

	public function getLastId()
	{
		$result = $this->execute("SELECT `MaPX` FROM phieuxuat ORDER BY `MaPX` DESC LIMIT 1");
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	function update($phieuxuatPostData)
	{
		$key = $phieuxuatPostData["MaPX"];
		return $this->updateObject('phieuxuat',$phieuxuatPostData,'MaPX',$key);
	}


	public function listAll($ngayDau, $ngayCuoi){
		$SqlCommand = "SELECT * FROM phieuxuat";
		if($ngayDau != null && $ngayCuoi != null){			
			$SqlCommand = "SELECT * FROM phieuxuat WHERE DATE(`NgayXuat`) BETWEEN '$ngayDau'AND '$ngayCuoi'";
		}
		// echo $SqlCommand;
		$SqlCommand .= " ORDER BY MaPX DESC";
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

	public function report($NgayDau,$NgayCuoi,$MaKho)
	{
		$SqlCommand = "SELECT COUNT(MaPX) AS SoDonHang,SUM(DaTra) AS TongThanhTien FROM `phieuxuat` WHERE 1"; 		
		if($NgayDau != '-1' && $NgayCuoi != '-1'){			
			$SqlCommand .= " AND DATE(`NgayXuat`) BETWEEN '$NgayDau' AND '$NgayCuoi'";
		}
		if($MaKho !== '-1'){
			$SqlCommand .= " AND MaKho = '$MaKho'";
		}

		$SqlCommand .= " ORDER BY MaPX DESC";
		
		$result = $this->execute($SqlCommand);		
		if($result){
			$row = $result->fetch_assoc();			
			return json_encode($row);
		}
		return 0;
	}

	public function baoCaoDoanhThuTheoNgayTungKho($NgayDau,$NgayCuoi,$MaKho)
	{
		$SqlCommand = "SELECT MaKho,Date(NgayXuat) AS NgayXuat,SUM(DaTra) AS DoanhThu FROM `phieuxuat` WHERE 1 "; 	

		if($NgayDau != '-1' && $NgayCuoi != '-1'){			
			$SqlCommand .= " AND Date(NgayXuat) BETWEEN Date('$NgayDau') AND Date('$NgayCuoi')";
		}

		if($MaKho !== '-1'){
			$SqlCommand .= " AND MaKho = '$MaKho'";
		}

		$SqlCommand .= " GROUP BY MaKho,Date(NgayXuat)";
		
		$result = $this->execute($SqlCommand);
		$list = [];
		if($result){
			while($row = $result->fetch_assoc()){
				array_push($list,$row);
			}	
			return json_encode($list);
		}
		return 0;
	}

	public function getListByMaKH($MaKH)
	{
		$SqlCommand = "SELECT MaPX,`phieuxuat`.`MaKho`,`kho`.`TenKho`,NgayXuat,TongSoLuongBan,TongGiaBan,DaTra,ChiTietPhieuXuat
			FROM `phieuxuat` JOIN kho ON (`phieuxuat`.`MaKho` = `kho`.`MaKho`) 
			WHERE MaKH = '$MaKH'";	
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
		$result = $this->execute("SELECT * FROM phieuxuat WHERE MaPX = '$key'");		
		if($result){
			$phieuxuat = $result->fetch_assoc();
			// print_r($phieuxuat);
			return json_encode($phieuxuat);
		}
		return 0;
	}

}
 ?>