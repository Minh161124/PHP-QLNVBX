-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 01, 2025 lúc 03:02 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbxbus`
--
CREATE DATABASE IF NOT EXISTS `qlbxbus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `qlbxbus`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cham_cong`
--

CREATE TABLE `cham_cong` (
  `id` int(6) UNSIGNED NOT NULL,
  `mcc` varchar(30) NOT NULL,
  `mns` varchar(30) NOT NULL,
  `ngay_cham` date NOT NULL,
  `ca_lam` int(11) NOT NULL,
  `tinh_trang` varchar(50) NOT NULL,
  `luong_cb` decimal(10,2) NOT NULL,
  `so_ngay_cong` int(11) NOT NULL,
  `phu_cap` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cham_cong`
--

INSERT INTO `cham_cong` (`id`, `mcc`, `mns`, `ngay_cham`, `ca_lam`, `tinh_trang`, `luong_cb`, `so_ngay_cong`, `phu_cap`) VALUES
(2, '54646', '5464', '0064-05-04', 5, 'Đang làm', 99999999.99, 45, 'Có'),
(4, '123123', '213123', '0123-03-12', 1, 'Đang làm', 12312.00, 1231, 'Có');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hop_dong`
--

CREATE TABLE `hop_dong` (
  `id` int(6) UNSIGNED NOT NULL,
  `mhd` varchar(50) NOT NULL,
  `mns` varchar(50) NOT NULL,
  `loai_hop_dong` varchar(50) NOT NULL,
  `vi_tri` varchar(50) NOT NULL,
  `ngay_ky` date NOT NULL,
  `ngay_kt` date NOT NULL,
  `thoi_han_hd` varchar(50) NOT NULL,
  `luongcb` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hop_dong`
--

INSERT INTO `hop_dong` (`id`, `mhd`, `mns`, `loai_hop_dong`, `vi_tri`, `ngay_ky`, `ngay_kt`, `thoi_han_hd`, `luongcb`) VALUES
(9, '32432', '34534', 'sadas', 'Giám đốc', '0213-03-21', '3123-03-12', '1', 99999999.99),
(10, '78768', '67867', 'lao động', 'Giám đốc', '0000-00-00', '0123-03-12', '32', 99999999.99);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_su`
--

CREATE TABLE `nhan_su` (
  `id` int(11) NOT NULL,
  `ma_nhan_su` varchar(100) DEFAULT NULL,
  `ten_dang_nhap` varchar(100) DEFAULT NULL,
  `ho_va_ten` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` varchar(10) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phong_ban` varchar(100) DEFAULT NULL,
  `luong` decimal(10,2) DEFAULT NULL,
  `thuong` decimal(10,2) DEFAULT NULL,
  `trinh_do_hoc_van` varchar(50) DEFAULT NULL,
  `quan_ly` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_su`
--

INSERT INTO `nhan_su` (`id`, `ma_nhan_su`, `ten_dang_nhap`, `ho_va_ten`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `so_dien_thoai`, `email`, `phong_ban`, `luong`, `thuong`, `trinh_do_hoc_van`, `quan_ly`) VALUES
(6, '452004', 'huy2004', 'Hoàng Tiến Huydada', '2004-06-21', 'Nam', 'Bắc Giang', '0921264842', 'Huyboyz2040@gmail.com', 'Hồ sơ nhân sự', 99999999.99, 1.25, 'Đại học', 'Không'),
(7, '345435', 'vuongchill', 'Vương', '2004-05-21', 'Nam', 'Hưng Yên', '23213123', 'Vuong@gmail.com', 'Hồ sơ nhân sự', 1.00, 1.00, 'Đại học', 'huy'),
(8, '54654', 'sadad', 'dfdsf', '1123-03-12', 'Nam', 'BG', '123123213', 'Huyboyz2040@gmail.com', 'Hồ sơ nhân sự', 13131.00, 123.00, 'Cao đẳng', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_cong`
--

CREATE TABLE `phan_cong` (
  `id` int(6) UNSIGNED NOT NULL,
  `mpc` varchar(30) NOT NULL,
  `mns` varchar(30) NOT NULL,
  `ten_nhan_su` varchar(50) NOT NULL,
  `nam_sinh` date NOT NULL,
  `vi_tri` varchar(50) NOT NULL,
  `tuyen_xe` varchar(50) NOT NULL,
  `ca_lam` varchar(50) NOT NULL,
  `ngay_lam` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_cong`
--

INSERT INTO `phan_cong` (`id`, `mpc`, `mns`, `ten_nhan_su`, `nam_sinh`, `vi_tri`, `tuyen_xe`, `ca_lam`, `ngay_lam`) VALUES
(5, '546', '45645', 'dsf', '1212-03-21', 'Giám đốc', 'KHÔNG', '1', '0021-03-12'),
(6, '213123', '123123', '123123', '0123-03-12', 'Giám đốc', 'KHÔNG', '1', '0123-03-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ung_vien`
--

CREATE TABLE `ung_vien` (
  `id` int(11) NOT NULL,
  `muv` varchar(50) NOT NULL,
  `mns` varchar(50) NOT NULL,
  `ho_ten_uv` varchar(100) NOT NULL,
  `gioi_tinh_uv` varchar(10) NOT NULL,
  `sdt_uv` varchar(15) NOT NULL,
  `vi_tri_uv` varchar(50) NOT NULL,
  `trinh_do` varchar(50) NOT NULL,
  `trang_thai_td` varchar(50) NOT NULL,
  `ngay_lam` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ung_vien`
--

INSERT INTO `ung_vien` (`id`, `muv`, `mns`, `ho_ten_uv`, `gioi_tinh_uv`, `sdt_uv`, `vi_tri_uv`, `trinh_do`, `trang_thai_td`, `ngay_lam`) VALUES
(4, '12345', '45678', 'Vương', 'Nam', '546546', 'lao công', 'Đại học', 'đá', '2004-05-21'),
(5, '65756', '6575', 'huy', 'Nam', '6575675', 'giám đốc', 'Đại học', '34', '1231-03-12'),
(6, '32131', '12312', '123123', 'Nam', '123123', '123123', 'Lớp 12', '12312', '0000-00-00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `role` enum('admin','nvcc','nvpc','nvhd','nvuv','nvns') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `ten_dang_nhap`, `mat_khau`, `role`) VALUES
(1, 'admin', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa', 'admin'),
(2, 'nvcc', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa', 'nvcc'),
(3, 'nvpc', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa', 'nvpc'),
(4, 'nvhd', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa', 'nvhd'),
(5, 'nvuv', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa\r\n', 'nvuv'),
(6, 'nvns', '$2y$10$.DVeZCzAFUeneDwKnTSaP.DptcVcDEg08L.us43rk/M6yoCdeiYfa', 'nvns');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hop_dong`
--
ALTER TABLE `hop_dong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhan_su`
--
ALTER TABLE `nhan_su`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ung_vien`
--
ALTER TABLE `ung_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hop_dong`
--
ALTER TABLE `hop_dong`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhan_su`
--
ALTER TABLE `nhan_su`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `ung_vien`
--
ALTER TABLE `ung_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
