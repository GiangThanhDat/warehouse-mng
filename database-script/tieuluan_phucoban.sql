-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 09:08 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tieuluan_phucoban`
--

-- --------------------------------------------------------

--
-- Table structure for table `donvi`
--

CREATE TABLE `donvi` (
  `MaDV` int(11) NOT NULL,
  `TenDV` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donvi`
--

INSERT INTO `donvi` (`MaDV`, `TenDV`) VALUES
(1, 'Chiếc'),
(2, 'Thùng');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MaHH` int(11) NOT NULL,
  `MaLHH` int(11) NOT NULL,
  `MaDV` int(11) NOT NULL,
  `MaNSX` int(10) NOT NULL,
  `TenHH` varchar(255) NOT NULL,
  `GiaNhap` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `TonKho` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MaHH`, `MaLHH`, `MaDV`, `MaNSX`, `TenHH`, `GiaNhap`, `GiaBan`, `TonKho`) VALUES
(1, 1, 1, 6, 'IPhone 12', 15000000, 30000000, 0),
(2, 2, 2, 7, 'Bia Tiger', 3500000, 4000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(255) NOT NULL,
  `DiaChiKH` varchar(255) NOT NULL,
  `stdKH` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `DiaChiKH`, `stdKH`, `email`) VALUES
(1, 'Phù Cơ Bản', 'Minh Lương', '123456789', ''),
(2, 'Giang Thành Đạt', 'Minh Lương', '12345678', ''),
(5, 'Trần Hồng Nhung', 'U Minh', '1234567', '');

-- --------------------------------------------------------

--
-- Table structure for table `kho`
--

CREATE TABLE `kho` (
  `MaKho` int(11) NOT NULL,
  `TenKho` varchar(255) NOT NULL,
  `DiaChiKho` varchar(255) NOT NULL,
  `MaThuKho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kho`
--

INSERT INTO `kho` (`MaKho`, `TenKho`, `DiaChiKho`, `MaThuKho`) VALUES
(1, 'Kho Hàng Cái Răng', 'Cân Thơ', 3),
(2, 'Kho Hàng Ninh Kiều', 'Cân Thơ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLHH` int(11) NOT NULL,
  `TenLHH` varchar(255) NOT NULL,
  `MaNhomCha` int(11) NOT NULL DEFAULT -1,
  `CapDo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLHH`, `TenLHH`, `MaNhomCha`, `CapDo`) VALUES
(1, 'Điện thoại', -1, 0),
(2, 'Bia', -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(255) NOT NULL,
  `DiaChiNCC` varchar(255) NOT NULL,
  `STDNCC` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChiNCC`, `STDNCC`, `email`) VALUES
(1, 'Công Ty Bia Sải Gòn', 'Thạnh Lọc', '98765432', ''),
(2, 'CoCaCoLa Việt Nam', 'Sài Gòn', '1234567890', ''),
(5, 'Apple Sài Gòn', 'Sài Gòn', '123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `MaNSX` int(10) NOT NULL,
  `TenNSX` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`MaNSX`, `TenNSX`) VALUES
(1, 'OPPO'),
(6, 'IPHONE'),
(7, 'Heneiken Việt Namm');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPN` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `NgayNhap` datetime NOT NULL,
  `TongSoLuongNhap` int(9) NOT NULL,
  `TongGiaNhap` int(11) NOT NULL,
  `DaTra` int(11) NOT NULL,
  `ChiTietPhieuNhap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`MaPN`, `MaNCC`, `MaKho`, `NgayNhap`, `TongSoLuongNhap`, `TongGiaNhap`, `DaTra`, `ChiTietPhieuNhap`) VALUES
(61, 1, 2, '2021-03-16 14:48:00', 6, 55500000, 55500000, '[{\"MaHH\":\"1\",\"GiaNhap\":\"15000000\",\"SLN\":3,\"ThanhTien\":45000000},{\"MaHH\":\"2\",\"GiaNhap\":\"3500000\",\"SLN\":3,\"ThanhTien\":10500000}]');

-- --------------------------------------------------------

--
-- Table structure for table `phieuxuat`
--

CREATE TABLE `phieuxuat` (
  `MaPX` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayXuat` datetime NOT NULL,
  `TongSoLuongBan` int(11) NOT NULL,
  `TongGiaBan` int(11) NOT NULL,
  `DaTra` int(11) NOT NULL,
  `ChiTietPhieuXuat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieuxuat`
--

INSERT INTO `phieuxuat` (`MaPX`, `MaKho`, `MaKH`, `NgayXuat`, `TongSoLuongBan`, `TongGiaBan`, `DaTra`, `ChiTietPhieuXuat`) VALUES
(30, 1, 0, '2021-03-16 14:45:29', 4, 68000000, 50000000, '[{\"MaTonKho\":\"30\",\"MaKho\":\"1\",\"MaHH\":\"1\",\"SoLuongTon\":\"10\",\"GiaBan\":\"30000000\",\"TongSoLuongTon\":\"10\",\"VonTonKho\":\"150000000\",\"GiaTriTon\":\"300000000\",\"SLB\":2,\"ThanhTien\":60000000},{\"MaTonKho\":\"31\",\"MaKho\":\"1\",\"MaHH\":\"2\",\"SoLuongTon\":\"10\",\"GiaBan\":\"4000000\",\"TongSoLuongTon\":\"10\",\"VonTonKho\":\"35000000\",\"GiaTriTon\":\"40000000\",\"SLB\":2,\"ThanhTien\":8000000}]'),
(31, 2, 1, '2021-03-16 14:50:29', 3, 90000000, 90000000, '[{\"MaTonKho\":\"32\",\"MaKho\":\"2\",\"MaHH\":\"1\",\"SoLuongTon\":\"3\",\"GiaBan\":\"30000000\",\"TongSoLuongTon\":\"3\",\"VonTonKho\":\"45000000\",\"GiaTriTon\":\"90000000\",\"SLB\":3,\"ThanhTien\":90000000}]');

-- --------------------------------------------------------

--
-- Table structure for table `thukho`
--

CREATE TABLE `thukho` (
  `MaThuKho` int(11) NOT NULL,
  `TenThuKho` varchar(255) NOT NULL,
  `sdtThuKho` varchar(11) NOT NULL,
  `DiaChiThuKho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thukho`
--

INSERT INTO `thukho` (`MaThuKho`, `TenThuKho`, `sdtThuKho`, `DiaChiThuKho`) VALUES
(3, 'Dương Hồng Danh', '1234567890', 'Cầu Quay'),
(4, 'Danh Quý', '123456789', 'Thành Sương');

-- --------------------------------------------------------

--
-- Table structure for table `tonkho`
--

CREATE TABLE `tonkho` (
  `MaTonKho` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `MaHH` int(11) NOT NULL,
  `SoLuongTon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tonkho`
--

INSERT INTO `tonkho` (`MaTonKho`, `MaKho`, `MaHH`, `SoLuongTon`) VALUES
(30, 1, 1, 8),
(31, 1, 2, 8),
(32, 2, 1, 0),
(33, 2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `display_name` varchar(120) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password_hash`, `email`, `display_name`, `create_date`) VALUES
(1, 'admin', '$2y$10$78Q3CHHohq0PX4usK54kF.tye0wJS5Ubgq6TP.rEvZ7oxr2PoU3uS', 'cobanphu@gmail.com', 'Phù Cơ Bản', '2021-02-21'),
(4, 'thanhdat', '$2y$10$N/mujjDrabqi3xlDVkmkxebz2nYl1LPjZipsGC2iMVhES602iBKzi', 'gthanhdatpro@gmail.com', 'Giang Thành Đạt', '2021-03-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`MaDV`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MaHH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`MaKho`);

--
-- Indexes for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLHH`);

--
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Indexes for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`MaNSX`);

--
-- Indexes for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`MaPN`);

--
-- Indexes for table `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD PRIMARY KEY (`MaPX`);

--
-- Indexes for table `thukho`
--
ALTER TABLE `thukho`
  ADD PRIMARY KEY (`MaThuKho`);

--
-- Indexes for table `tonkho`
--
ALTER TABLE `tonkho`
  ADD PRIMARY KEY (`MaTonKho`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donvi`
--
ALTER TABLE `donvi`
  MODIFY `MaDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MaHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kho`
--
ALTER TABLE `kho`
  MODIFY `MaKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  MODIFY `MaNSX` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `phieuxuat`
--
ALTER TABLE `phieuxuat`
  MODIFY `MaPX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `thukho`
--
ALTER TABLE `thukho`
  MODIFY `MaThuKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tonkho`
--
ALTER TABLE `tonkho`
  MODIFY `MaTonKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
