-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 9 月 30 日 12:22
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `voyage_data`
--

CREATE TABLE `voyage_data` (
  `id` int(11) NOT NULL,
  `shipName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `input_date` datetime NOT NULL,
  `dep_date` date DEFAULT NULL,
  `departure` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `arrival` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `voyage_data`
--

INSERT INTO `voyage_data` (`id`, `shipName`, `input_date`, `dep_date`, `departure`, `arrival`, `cargo`) VALUES
(1, 'ASUKA', '2021-09-28 09:14:33', '2021-09-16', 'nagoya', 'osaka', 'coal'),
(5, 'MS ASUKA II', '2021-09-28 10:28:05', '2021-09-16', 'london', 'tokyo', 'ore'),
(6, 'MS ASUKA II', '2021-09-28 10:28:15', '2021-09-16', 'nagoya', 'fukuoka', 'ore'),
(7, 'MS ASUKA II', '2021-09-28 10:29:09', '2021-09-16', 'london', 'osaka', 'ore'),
(9, 'MS ASUKA II', '2021-09-28 10:51:55', '2021-09-16', 'london', 'osaka', 'coal'),
(10, 'MS ASUKA II', '2021-09-28 10:52:06', '2021-09-16', '名古屋', 'osaka', '石炭'),
(11, 'MS ASUKA II', '2021-09-28 10:54:19', '2021-09-16', 'naogya', 'tokyo', 'coal'),
(12, 'MS ASUKA II', '2021-09-28 13:12:47', '2021-09-16', 'nagoya', 'sapporo', 'rice bag'),
(13, 'MS ASUKA II', '2021-09-28 13:12:55', '2021-09-16', 'nagoya', 'tokyo', 'coal'),
(15, 'MS ASUKA II', '2021-09-28 13:17:41', '2021-09-16', 'nagoya', 'tokyo', 'stone'),
(16, 'MS ASUKA II', '2021-09-28 13:27:17', '2021-09-30', 'nagoya', 'tokyo', 'coal'),
(18, 'NIPPON MARU', '2021-09-28 18:02:34', '2021-09-30', 'nagoya', 'osaka', 'ore'),
(19, 'PACIFIC VENUS', '2021-09-28 20:40:35', '2021-09-29', 'nagoya', 'sapporo', 'ore'),
(20, 'PACIFIC VENUS', '2021-09-28 20:44:06', '2021-10-27', 'nagoya', 'osaka', 'ore'),
(21, 'NIPPON MARU', '2021-09-28 20:47:16', '2021-10-08', 'nagoya', 'tokyo', 'car and others'),
(22, 'PACIFIC VENUS', '2021-09-28 20:50:25', '2021-09-23', 'nagoya', 'tokyo', 'coal'),
(23, 'PACIFIC VENUS', '2021-09-30 15:21:01', '2021-10-01', 'ishikawa', 'okinawa', 'cars');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `voyage_data`
--
ALTER TABLE `voyage_data`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `voyage_data`
--
ALTER TABLE `voyage_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
