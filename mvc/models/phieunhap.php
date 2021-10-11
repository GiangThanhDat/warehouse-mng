<?php 
/**
 * 
 */
class phieunhap extends data
{
	public function add($post_request){		
		echo $this->InsertObject("phieunhap",$post_request);
	}
	public function edit($key,$column,$value){
		$result = $this->execute("UPDATE phieunhap SET `$column` = '$value' WHERE MaPN = $key");
		// echo "UPDATE phieunhap SET `column` = '$value' WHERE MaPN = $key";
		if($result){
			$result = $this->execute("SELECT * FROM phieunhap WHERE MaPN = $key");
			$result = $result->fetch_assoc();
			return json_encode($result);
		}
		return 0;
	}

	public function remove($key){		
		$result = $this->execute("DELETE FROM phieunhap WHERE MaPN = $key");		
		if($result){			
			return 1;	
		}
		return 0;
	}

	public function getLastId()
	{
		$result = $this->execute("SELECT `MaPN` FROM phieunhap ORDER BY `MaPN` DESC LIMIT 1");
		if($result){
			$lastID = $result->fetch_assoc();
			return json_encode($lastID);
		}
		return 0;
	}

	public function update($phieunhapPostData)
	{
		$key = $phieunhapPostData["MaPN"];
		return $this->updateObject('phieunhap',$phieunhapPostData,'MaPN',$key);
	}

	public function report($NgayDau,$NgayCuoi,$MaKho)
	{
		$SqlCommand = "SELECT COUNT(MaPN) AS SoPhieuNhap,SUM(DaTra) AS TongThanhTien FROM `phieunhap` WHERE 1"; 		
		if($NgayDau != '-1' && $NgayCuoi != '-1'){			
			$SqlCommand .= " AND DATE(`NgayNhap`) BETWEEN '$NgayDau' AND '$NgayCuoi'";
		}
		if($MaKho !== '-1'){
			$SqlCommand .= " AND MaKho = '$MaKho'";
		}

		$SqlCommand .= " ORDER BY MaPN DESC";

		// echo $SqlCommand;
		$result = $this->execute($SqlCommand);
		$list = [];
		if($result){
			$row = $result->fetch_assoc();			
			return json_encode($row);
		}
		return 0;
	}

	public function listAll($ngayDau, $ngayCuoi){
		$SqlCommand = "SELECT * FROM phieunhap";
		if($ngayDau != null && $ngayCuoi != null){			
			$SqlCommand = "SELECT * FROM phieunhap WHERE DATE(`NgayNhap`) BETWEEN '$ngayDau'AND '$ngayCuoi'";
		}
		$SqlCommand .= " ORDER BY MaPN DESC";
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



	public function getListByMaNCC($MaNCC)
	{
		$SqlCommand = "SELECT MaPN,`phieunhap`.`MaKho`,`kho`.`TenKho`,NgayNhap,TongSoLuongNhap,TongGiaNhap,DaTra,ChiTietPhieuNhap 
			FROM `phieunhap` JOIN kho ON (`phieunhap`.`MaKho` = `kho`.`MaKho`) 
			WHERE MaNCC = '$MaNCC'";	
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
		$result = $this->execute("SELECT * FROM phieunhap WHERE MaPN = '$key'");		
		if($result){
			$phieunhap = $result->fetch_assoc();
			// print_r($phieunhap);
			return json_encode($phieunhap);
		}
		return 0;
	}
}
?>