-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3366
-- Generation Time: Mar 24, 2025 at 02:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `hoten`, `username`, `password`) VALUES
(1, 'Thành Quí', 'admin', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`idcart`, `tenmon`, `soluong`, `gia`, `iduser`) VALUES
(2, 'Phở gà', 2, 45.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatadmin`
--

CREATE TABLE `chatadmin` (
  `iduser` int(11) NOT NULL,
  `idmes` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatadmin`
--

INSERT INTO `chatadmin` (`iduser`, `idmes`, `hoten`, `message`) VALUES
(1, 1, 'Thành Quí', 'Khoảng 30p nữa nha bạn');

-- --------------------------------------------------------

--
-- Table structure for table `loaimon`
--

CREATE TABLE `loaimon` (
  `idloaimon` int(11) NOT NULL,
  `tenloai` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `dactrung` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaimon`
--

INSERT INTO `loaimon` (`idloaimon`, `tenloai`, `image`, `dactrung`, `active`) VALUES
(1, 'Bánh Mì', 'LoaiMonAn_181.jpg', 'Yes', 'Yes'),
(2, 'Kem tươi', 'LoaiMonAn_101.jpg', 'Yes', 'Yes'),
(3, 'Phở', 'LoaiMonAn_531.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `idmes` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `thongtin` varchar(500) NOT NULL,
  `trangthai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`idmes`, `iduser`, `hoten`, `email`, `sdt`, `thongtin`, `trangthai`) VALUES
(1, 1, 'Thanh', 'thanhqui@gmail.com', '0123456789', 'Đơn hàng của tôi khi nào có vậy?', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `monan`
--

CREATE TABLE `monan` (
  `idmonan` int(11) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `mota` varchar(500) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `image_monan` varchar(255) NOT NULL,
  `dactrung` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `idloaimon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monan`
--

INSERT INTO `monan` (`idmonan`, `tenmon`, `mota`, `gia`, `image_monan`, `dactrung`, `active`, `idloaimon`) VALUES
(1, 'Bánh mì Cop', 'Bánh mì thơm ngon', 25.00, 'MonAn-3998.jpg', 'Yes', 'Yes', 1),
(2, 'Kem dâu', 'kem mát lạnh', 25.00, 'MonAn-2955.jpg', 'Yes', 'Yes', 2),
(3, 'Phở gà', 'Thơm ngon', 45.00, 'MonAn-2514.jpg', 'Yes', 'Yes', 3),
(4, 'Phở bò', 'Thơm ngon', 45.00, 'MonAn-4674.jfif', 'Yes', 'Yes', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orderfood`
--

CREATE TABLE `orderfood` (
  `idorder` int(11) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongcong` int(11) NOT NULL,
  `ngaydat` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `tenkh` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `ptthanhtoan` varchar(255) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderfood`
--

INSERT INTO `orderfood` (`idorder`, `tenmon`, `gia`, `soluong`, `tongcong`, `ngaydat`, `status`, `tenkh`, `contact`, `email`, `diachi`, `ptthanhtoan`, `iduser`) VALUES
(1, 'Bánh mì Cop(1)', 25.00, 1, 25, '2024-12-16', 'đã đặt', 'Thành Quuis', '0123456789', 'thanhqui@gmail.com', 'Cần Thơ', 'tiền mặt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `diachi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `hoten`, `username`, `password`, `email`, `sdt`, `diachi`) VALUES
(1, 'Thanh', 'thanhqui', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'thanhqui@gmail.com', '0123456789', 'Cần Thơ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indexes for table `chatadmin`
--
ALTER TABLE `chatadmin`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `loaimon`
--
ALTER TABLE `loaimon`
  ADD PRIMARY KEY (`idloaimon`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmes`);

--
-- Indexes for table `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`idmonan`);

--
-- Indexes for table `orderfood`
--
ALTER TABLE `orderfood`
  ADD PRIMARY KEY (`idorder`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chatadmin`
--
ALTER TABLE `chatadmin`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loaimon`
--
ALTER TABLE `loaimon`
  MODIFY `idloaimon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `idmes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monan`
--
ALTER TABLE `monan`
  MODIFY `idmonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderfood`
--
ALTER TABLE `orderfood`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
