-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mybd1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `plan`
--

CREATE TABLE `plan` (
  `id` int(3) NOT NULL COMMENT '流水號',
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廠商名',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `target` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '目標',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '方案',
  `place` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廣告位置',
  `cost` int(11) DEFAULT NULL COMMENT '預算',
  `click` int(11) NOT NULL COMMENT '點擊數',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '狀態',
  `startTime` date NOT NULL,
  `dueTime` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updates_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `plan`
--

INSERT INTO `plan` (`id`, `username`, `name`, `target`, `type`, `place`, `cost`, `click`, `status`, `startTime`, `dueTime`, `created_at`, `updates_at`) VALUES
(42, 'test', '', '提升品牌知名度', '曝光天數', '商品首頁頭版', 0, 0, '審核', '2020-02-05', '2020-02-07', '2020-02-05 17:49:57', '2020-02-05 17:49:57');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
