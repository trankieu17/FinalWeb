-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 06, 2022 at 02:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlynhanvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `giamdoc`
--

CREATE TABLE `giamdoc` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giamdoc`
--

INSERT INTO `giamdoc` (`id`, `name`, `username`, `password`, `image`) VALUES
(1, 'Giam doc', 'admin', '$2y$10$qziuZ1g9j4utqEOm2Q3M.OaUO5lywnw1EoYmM7ZkdzMhKJ68gqRtm', 'images/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nghiphep`
--

CREATE TABLE `nghiphep` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `fromDay` date NOT NULL,
  `toDay` date NOT NULL,
  `songay` int(11) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nghiphep`
--

INSERT INTO `nghiphep` (`id`, `name`, `reason`, `fromDay`, `toDay`, `songay`, `maPB`, `status`) VALUES
(27, 'Nguyễn Hưng Hoài Nam', 'Nay t muốn xin nghỉ phép ở nhà dưỡng bệnh. vì sáng nay t đo nhiệt độ à 38 độ.', '2022-01-06', '2022-01-07', 1, 'software', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `chucvu` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `tongngaynghi` int(11) NOT NULL,
  `duocnghi` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `cmnd` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `name`, `username`, `password`, `maPB`, `chucvu`, `image`, `tongngaynghi`, `duocnghi`, `status`, `cmnd`, `email`, `sdt`, `diachi`) VALUES
(17, 'Nguyễn Hưng Hoài Nam', 'nvhoainam', '$2y$10$YvUaFF43UfYDM9Y6SoIKnum8IvPcxg3rdosbHH2mW1S3VMReTC8Xm', 'software', 'nhân viên', 'images/8c7e9fa06948d3b136dabfba06b33bac.JPG', 11, 12, 1, '12345678', 'nam@example.com', 1234567890, '12 đường Đồng Tiền'),
(18, 'Mai Nguyễn Thái Học', 'nvhoc', '$2y$10$KcOe5S0KPn5wDPvUJjLcV.l6FAMwtdvIAgtYF55qS1kHWzd0Hr8O2', 'software', 'nhân viên', 'images/352d89f4f9a4c98aeb6c51823f1ad7c1.JPG', 0, 12, 1, '1234567890', 'hoc@example.com', 1234567890, '12 đường Vĩnh Lộc'),
(19, 'Lê Ngọc Trân', 'nvngoctran', '$2y$10$3Ion6FIjGMG1rR/XYTp59uraGTSQ9WOXhb9uL/MywCY/2PUmNqJKu', 'LeTan', 'trưởng phòng', 'images/830ee79eae81efe027418e3ee6b0112b.JPG', 0, 15, 1, '1234567890', 'tran@example.com', 1234567890, '12 đường Nguyễn Đình Cẩn'),
(20, 'Trần Thị Kiều', 'nvkieu', '$2y$10$DfyQyuei4p04iPw/3K3pR.Yb89z7XXrE52LvQ9sknBK0lAi/cNjEm', 'software', 'trưởng phòng', 'images/2.png', 15, 15, 1, '1234567890', 'kieu@example.com', 1234567890, '123 đường Vĩnh Tiến'),
(21, 'Trần Thái Bảo', 'nvbao', '$2y$10$nwvFU0vGZANS0rz30KZLDOuoHT7mZaVc93ywIGHhlwMQ9UwUNmYW.', 'software', 'nhân viên', 'images/bb091898092f7d5451e38a3f5f2104c3.JPG', 0, 12, 1, '1234567890', 'bao@example.com', 1234567890, '12 đường Bảo Lộc'),
(22, 'Lê Thị Tí', 'nvti', '$2y$10$M3LQzO99diqs/JuL2EbEQeAOTHjyRIF1BYuEOqppqV.DehFbSKSYC', 'KeToan', 'trưởng phòng', 'images/9ca1b65808cdffb8d9a04c83bea4125c.JPG', 0, 15, 0, '1234567890', 'ti@example.com', 1234567890, '12 đường Cà Mau'),
(24, 'Nguyễn Huỳnh Như', 'nvnhu', '$2y$10$O2L558iimsras1OgyTZezO1E5lmjId6cpf00n653EJTQ77Osawlni', 'LeTan', 'nhân viên', 'images/352d89f4f9a4c98aeb6c51823f1ad7c1.JPG', 0, 12, 1, '1234567890', 'nhu@example.com', 1234567890, '45 đường Tình Yêu'),
(25, 'Nguyễn Văn A', 'nvA', '$2y$10$q6xXeMLQhlzHQmK89rZlne5Dd9u6UTbbIdI113HzsPrEKQu1ATuDe', 'KEHOACH', 'trưởng phòng', 'images/eifiel.jpeg', 1, 15, 1, '0012001919', 'A@example.com', 123456789, '123 đường Trần Hưng Đạo'),
(26, 'Nguyễn Văn B', 'nvB', '$2y$10$DPZGl1depJBLreZJPVxnz.4.OTUd9fAWNKIYl6o0du4/pA2xOSHEy', 'KEHOACH', 'nhân viên', 'images/4f8a244cb43a8ee3188a981bfedbeb68.JPG', 0, 12, 1, '0012001918', 'B@example.com', 123456789, '124 đường Hoà Bình'),
(27, 'Trần Văn C', 'nvc', '$2y$10$k8NbI0bxbe31h/RQx9nmTOdxsvzJQImD4c/uo3/eJYQC5dxCNrDn6', 'LeTan', 'nhân viên', 'images/23fccca97b345a30f87ffb4c9c978d2b.JPG', 0, 12, 1, '0012001918', 'c@example.com', 123456789, '72/10 đường Lê Đình Cẩn'),
(28, 'Nguyễn Văn D', 'nvD', '$2y$10$qgZz9jSjZGkR4i7GjLNQqeV5RdZKhW1nFe6MJfQLSiz7HPy6uVh3u', 'software', 'nhân viên', 'images/52717c3bd2d94e8059f52600f95140db.JPG', 0, 12, 0, '0012001919', 'D@example.com', 123456789, '310 lê văn thứu'),
(29, 'Nguyên Văn E', 'nvE', '$2y$10$cD6MdCTTQQ5P/NxjFws3w.g0s6/SmLNw6BhiWq/kpXZJJt6I8i58C', 'KeToan', 'nhân viên', 'images/45ee696fcf45598b661fca2d4dace4d9.JPG', 0, 12, 0, '0139312939', 'E@example.com', 123231232, '741/31 hương lộ 2'),
(30, 'Lê A', 'nvLEA', '$2y$10$y9bZbDl8jw7u2Tx5tKDMRuF61SF1nfex5qlswQA.bTVmHeptGDcMq', 'LeTan', 'nhân viên', 'images/815e1c9330e5a37e631e5b31bffbd33a.JPG', 0, 12, 0, '0139312939', 'LEA@example.com', 1232312321, '741/31 hương lộ 2'),
(31, 'Nguyễn A', 'nvNA', '$2y$10$8Gt/rG.Hjb2A.bM8Km20euyChxRyV2CgI6vjl0CTDRhofgtVlt/di', 'KEHOACH', 'nhân viên', 'images/815e1c9330e5a37e631e5b31bffbd33a.JPG', 0, 12, 0, '0012001919', 'nguyenhunghoain@gmail.com', 773762943, '741/31 hương lộ 2');

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `namePB` varchar(50) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `sophong` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`id`, `maPB`, `namePB`, `mota`, `sophong`) VALUES
(7, 'KeToan', 'Phòng kế toán', 'phòng tính toán thống kê thu chi', 'D101'),
(8, 'software', 'Phòng phát triển', 'phòng phát triển các hạng mục của công ty', 'A101'),
(9, 'LeTan', 'Phòng lễ tân', 'phòng của các lễ tân hướng dẫn khách', 'B201'),
(10, 'KEHOACH', 'Phòng kế hoạch', 'Phòng đưa ra các kế hoạch cho các phòng', 'C301');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tenTask` varchar(100) NOT NULL,
  `descTask` varchar(100) NOT NULL,
  `nhanvien` varchar(100) NOT NULL,
  `maPB` varchar(50) NOT NULL,
  `deadline` date NOT NULL,
  `fileTask` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tenTask`, `descTask`, `nhanvien`, `maPB`, `deadline`, `fileTask`, `status`, `quality`) VALUES
(8, 'thiết kế giao diện web bán hàng', 'nhớ làm', 'Nguyễn Hưng Hoài Nam', 'software', '2021-12-23', 'uploadTask/Copyright protection scheme for color images using extended visual cryptography.pdf', 'Completed', 'Good'),
(10, 'làm web', 'design background', 'Mai Nguyễn Thái Học', 'software', '2021-12-23', 'uploadTask/Clustering - Kmean.ipynb', 'Completed', 'Bad'),
(11, 'làm web 1', 'dsasad', 'Trần Thái Bảo', 'software', '2021-12-21', 'uploadTask/manager.png', 'Completed', 'Bad'),
(12, 'lab2', 'lab2', 'Nguyễn Hưng Hoài Nam', 'software', '2021-12-23', 'uploadTask/51900763_lab4_3.docx', 'Completed', 'Bad'),
(14, 'Kiểm tra các cuộc gọi KH', 'yêu cầu kiểm tra các cuộc gọi và báo cáo lại', 'Nguyễn Huỳnh Như', 'LeTan', '2021-12-27', 'uploadTask/Copyright protection scheme for color images using extended visual cryptography.pdf', 'Completed', 'OK'),
(16, 'làm web 1', 'ádasdas', 'Trần Thái Bảo', 'software', '2022-01-14', 'uploadTask/manager.png', 'Completed', 'Bad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giamdoc`
--
ALTER TABLE `giamdoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nghiphep`
--
ALTER TABLE `nghiphep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giamdoc`
--
ALTER TABLE `giamdoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nghiphep`
--
ALTER TABLE `nghiphep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
