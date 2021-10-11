-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 04:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tieuluan_quanlykho`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctpn`
--

CREATE TABLE `ctpn` (
  `MaCTPN` int(11) NOT NULL,
  `MaPN` int(11) NOT NULL,
  `MaHH` int(11) NOT NULL,
  `SLN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ctpn`
--

INSERT INTO `ctpn` (`MaCTPN`, `MaPN`, `MaHH`, `SLN`) VALUES
(1, 1, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ctpx`
--

CREATE TABLE `ctpx` (
  `MaCTPX` int(11) NOT NULL,
  `MaPX` int(11) NOT NULL,
  `MaHH` int(11) NOT NULL,
  `SLX` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ctpx`
--

INSERT INTO `ctpx` (`MaCTPX`, `MaPX`, `MaHH`, `SLX`) VALUES
(1, 1, 2, 3),
(2, 2, 1, 10),
(3, 1, 1, 5);

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
(1, 'Lon'),
(2, 'Thùng');

-- --------------------------------------------------------

--
-- Table structure for table `giu`
--

CREATE TABLE `giu` (
  `MaGiuHH` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `MaHH` int(11) NOT NULL,
  `SoLuongTon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giu`
--

INSERT INTO `giu` (`MaGiuHH`, `MaKho`, `MaHH`, `SoLuongTon`) VALUES
(1, 1, 2, 500),
(2, 2, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MaHH` int(11) NOT NULL,
  `MaLHH` int(11) NOT NULL,
  `MaDV` int(11) NOT NULL,
  `TenHH` varchar(255) NOT NULL,
  `DonGia` double NOT NULL,
  `GiaBan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MaHH`, `MaLHH`, `MaDV`, `TenHH`, `DonGia`, `GiaBan`) VALUES
(1, 1, 1, 'CoCaCoLa', 5000, 10000),
(2, 2, 2, 'Tiger Nâu', 300000, 360000);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(255) NOT NULL,
  `DiaChiKH` varchar(255) NOT NULL,
  `stdKH` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `DiaChiKH`, `stdKH`) VALUES
(1, 'Phù Cơ Bản', 'Minh Lương', '123456789'),
(2, 'Giang Thành Đạt', 'Minh Lương', '12345678');

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
(1, 'Kho Hàng Rạch Giá', 'Rạch Giá', 3),
(2, 'Kho Hàng Giồng Riềng', 'Giồng Riềng', 4);

-- --------------------------------------------------------

--
-- Table structure for table `loaihh`
--

CREATE TABLE `loaihh` (
  `MaLHH` int(11) NOT NULL,
  `TenLHH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihh`
--

INSERT INTO `loaihh` (`MaLHH`, `TenLHH`) VALUES
(1, 'Nước Ngọt'),
(2, 'Bia');

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(255) NOT NULL,
  `DiaChiNCC` varchar(255) NOT NULL,
  `sdtNCC` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChiNCC`, `sdtNCC`) VALUES
(1, 'Công Ty Bia Sải Gòn', 'Thạnh Lọc', '98765432'),
(2, 'CoCaCoLa Việt Nam', 'Sài Gòn', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPN` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `NgayNhap` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`MaPN`, `MaNCC`, `MaKho`, `NgayNhap`) VALUES
(1, 1, 2, '2021-01-30 10:15:13'),
(2, 1, 1, '2021-01-31 10:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `phieuxuat`
--

CREATE TABLE `phieuxuat` (
  `MaPX` int(11) NOT NULL,
  `MaKho` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayXuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieuxuat`
--

INSERT INTO `phieuxuat` (`MaPX`, `MaKho`, `MaKH`, `NgayXuat`) VALUES
(1, 1, 1, '2021-01-31 10:08:11'),
(2, 1, 2, '2021-01-31 10:08:11');

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ctpn`
--
ALTER TABLE `ctpn`
  ADD PRIMARY KEY (`MaCTPN`);

--
-- Indexes for table `ctpx`
--
ALTER TABLE `ctpx`
  ADD PRIMARY KEY (`MaCTPX`);

--
-- Indexes for table `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`MaDV`);

--
-- Indexes for table `giu`
--
ALTER TABLE `giu`
  ADD PRIMARY KEY (`MaGiuHH`);

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
-- Indexes for table `loaihh`
--
ALTER TABLE `loaihh`
  ADD PRIMARY KEY (`MaLHH`);

--
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ctpn`
--
ALTER TABLE `ctpn`
  MODIFY `MaCTPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctpx`
--
ALTER TABLE `ctpx`
  MODIFY `MaCTPX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donvi`
--
ALTER TABLE `donvi`
  MODIFY `MaDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `giu`
--
ALTER TABLE `giu`
  MODIFY `MaGiuHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MaHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kho`
--
ALTER TABLE `kho`
  MODIFY `MaKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaihh`
--
ALTER TABLE `loaihh`
  MODIFY `MaLHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phieuxuat`
--
ALTER TABLE `phieuxuat`
  MODIFY `MaPX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thukho`
--
ALTER TABLE `thukho`
  MODIFY `MaThuKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
