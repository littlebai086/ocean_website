-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-27 18:35:25
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `ocean_website`
--

-- --------------------------------------------------------

--
-- 資料表結構 `area`
--

CREATE TABLE `area` (
  `area_id` int(255) NOT NULL,
  `city_id` int(255) NOT NULL,
  `area_chinese` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `area`
--

INSERT INTO `area` (`area_id`, `city_id`, `area_chinese`) VALUES
(1, 1, '中正區'),
(2, 1, '大同區'),
(3, 1, '中山區'),
(4, 1, '松山區'),
(5, 1, '大安區'),
(6, 1, '萬華區'),
(7, 1, '信義區'),
(8, 1, '士林區'),
(9, 1, '北投區'),
(10, 1, '內湖區'),
(11, 1, '南港區'),
(12, 1, '文山區'),
(13, 2, '仁愛區'),
(14, 2, '安樂區'),
(15, 2, '暖暖區'),
(16, 2, '七堵區'),
(17, 3, '萬里區'),
(18, 3, '金山區'),
(23, 3, '板橋區'),
(24, 3, '汐止區'),
(25, 3, '深坑區'),
(26, 3, '石碇區'),
(27, 3, '瑞芳區'),
(28, 3, '平溪區'),
(29, 3, '雙溪區'),
(30, 3, '貢寮區'),
(31, 3, '新店區'),
(32, 3, '坪林區'),
(33, 3, '烏來區'),
(34, 3, '永和區'),
(35, 3, '中和區'),
(36, 3, '土城區'),
(37, 3, '三峽區'),
(38, 3, '樹林區'),
(39, 3, '鶯歌區'),
(40, 3, '三重區'),
(41, 3, '新莊區'),
(42, 3, '泰山區'),
(43, 3, '林口區'),
(44, 3, '蘆洲區'),
(45, 3, '五股區'),
(46, 3, '八里區'),
(47, 3, '淡水區'),
(48, 3, '三芝區'),
(49, 3, '石門區'),
(50, 5, '宜蘭市'),
(51, 5, '頭城鎮'),
(52, 5, '礁溪鄉'),
(53, 5, '壯圍鄉'),
(54, 5, '員山鄉'),
(55, 5, '羅東鎮'),
(56, 5, '三星鄉'),
(57, 5, '大同鄉'),
(58, 5, '五結鄉'),
(59, 5, '冬山鄉'),
(60, 5, '蘇澳鎮'),
(61, 5, '南澳鄉'),
(63, 7, '東區'),
(64, 7, '北區'),
(65, 7, '香山區'),
(66, 8, '竹北市'),
(67, 8, '湖口鄉'),
(68, 8, '新豐鄉'),
(69, 8, '新埔鎮'),
(70, 8, '關西鎮'),
(71, 8, '芎林鄉'),
(72, 8, '寶山鄉'),
(73, 8, '竹東鎮'),
(74, 8, '五峰鄉'),
(75, 8, '橫山鄉'),
(76, 8, '尖石鄉'),
(77, 8, '北埔鄉'),
(78, 8, '峨眉鄉'),
(79, 9, '中壢區'),
(80, 9, '平鎮區'),
(81, 9, '龍潭區'),
(82, 9, '楊梅區'),
(83, 9, '新屋區'),
(84, 9, '觀音區'),
(85, 9, '桃園區'),
(86, 9, '龜山區'),
(87, 9, '八德區'),
(88, 9, '大溪區'),
(89, 9, '復興區'),
(90, 9, '大園區'),
(91, 9, '蘆竹區'),
(92, 10, '竹南鎮'),
(93, 10, '頭份市'),
(94, 10, '三灣鄉'),
(95, 10, '南庄鄉'),
(96, 10, '獅潭鄉'),
(97, 10, '後龍鎮'),
(98, 10, '通霄鎮'),
(99, 10, '苑裡鎮'),
(100, 10, '苗栗市'),
(101, 10, '造橋鄉'),
(102, 10, '頭屋鄉'),
(103, 10, '公館鄉'),
(104, 10, '大湖鄉'),
(105, 10, '泰安鄉'),
(106, 10, '銅鑼鄉'),
(107, 10, '三義鄉'),
(108, 10, '西湖鄉'),
(109, 10, '卓蘭鎮'),
(110, 11, '中區'),
(111, 11, '南區'),
(112, 11, '西區'),
(113, 11, '北屯區'),
(114, 11, '西屯區'),
(115, 11, '南屯區'),
(116, 11, '太平區'),
(117, 11, '大里區'),
(118, 11, '霧峰區'),
(119, 11, '烏日區'),
(120, 11, '豐原區'),
(121, 11, '后里區'),
(122, 11, '石岡區'),
(123, 11, '東勢區'),
(124, 11, '和平區'),
(125, 11, '新社區'),
(126, 11, '潭子區'),
(127, 11, '大雅區'),
(128, 11, '神岡區'),
(129, 11, '大肚區'),
(130, 11, '沙鹿區'),
(131, 11, '龍井區'),
(132, 11, '梧棲區'),
(133, 11, '清水區'),
(134, 11, '大甲區'),
(135, 11, '外埔區'),
(136, 12, '彰化市'),
(137, 12, '芬園鄉'),
(138, 12, '花壇鄉'),
(139, 12, '秀水鄉'),
(140, 12, '鹿港鎮'),
(141, 12, '福興鄉'),
(142, 12, '線西鄉'),
(143, 12, '和美鎮'),
(144, 12, '伸港鄉'),
(145, 12, '員林市'),
(146, 12, '社頭鄉'),
(147, 12, '永靖鄉'),
(148, 12, '埔心鄉'),
(149, 12, '溪湖鎮'),
(150, 12, '大村鄉'),
(151, 12, '埔鹽鄉'),
(152, 12, '田中鎮'),
(153, 12, '北斗鎮'),
(154, 12, '田尾鄉'),
(155, 12, '埤頭鄉'),
(156, 12, '溪州鄉'),
(157, 12, '竹塘鄉'),
(158, 12, '二林鎮'),
(159, 12, '大城鄉'),
(160, 12, '芳苑鄉'),
(161, 12, '二水鄉'),
(162, 13, '南投市'),
(163, 13, '中寮鄉'),
(164, 13, '草屯鎮'),
(165, 13, '國姓鄉'),
(166, 13, '埔里鎮'),
(167, 13, '仁愛鄉'),
(168, 13, '名間鄉'),
(169, 13, '集集鎮'),
(170, 13, '水里鄉'),
(171, 13, '魚池鄉'),
(172, 13, '信義鄉'),
(173, 13, '竹山鎮'),
(174, 13, '鹿谷鄉'),
(175, 15, '番路鄉'),
(176, 15, '梅山鄉'),
(177, 15, '竹崎鄉'),
(178, 15, '阿里山鄉'),
(179, 15, '中埔鄉'),
(180, 15, '大埔鄉'),
(181, 15, '水上鄉'),
(182, 15, '鹿草鄉'),
(183, 15, '太保市'),
(184, 15, '朴子市'),
(185, 15, '東石鄉'),
(186, 15, '六腳鄉'),
(187, 15, '新港鄉'),
(188, 15, '民雄鄉'),
(189, 15, '大林鎮'),
(190, 15, '溪口鄉'),
(191, 15, '義竹鄉'),
(192, 15, '布袋鎮'),
(193, 16, '斗南鎮'),
(194, 16, '大埤鄉'),
(195, 16, '虎尾鎮'),
(196, 16, '土庫鎮'),
(197, 16, '褒忠鄉'),
(198, 16, '東勢鄉'),
(199, 16, '臺西鄉'),
(200, 16, '崙背鄉'),
(201, 16, '麥寮鄉'),
(202, 16, '斗六市'),
(203, 16, '林內鄉'),
(204, 16, '古坑鄉'),
(205, 16, '莿桐鄉'),
(206, 16, '西螺鎮'),
(207, 16, '二崙鄉'),
(208, 16, '北港鎮'),
(209, 16, '水林鄉'),
(210, 16, '口湖鄉'),
(211, 16, '四湖鄉'),
(212, 16, '元長鄉'),
(213, 17, '中西區'),
(214, 17, '安平區'),
(215, 17, '安南區'),
(216, 17, '永康區'),
(217, 17, '歸仁區'),
(218, 17, '新化區'),
(219, 17, '左鎮區'),
(220, 17, '玉井區'),
(221, 17, '楠西區'),
(222, 17, '南化區'),
(223, 17, '仁德區'),
(224, 17, '關廟區'),
(225, 17, '龍崎區'),
(226, 17, '官田區'),
(227, 17, '麻豆區'),
(228, 17, '佳里區'),
(229, 17, '西港區'),
(230, 17, '七股區'),
(231, 17, '將軍區'),
(232, 17, '學甲區'),
(233, 17, '北門區'),
(234, 17, '新營區'),
(235, 17, '後壁區'),
(236, 17, '白河區'),
(237, 17, '東山區'),
(238, 17, '六甲區'),
(239, 17, '下營區'),
(240, 17, '柳營區'),
(241, 17, '鹽水區'),
(242, 17, '善化區'),
(243, 17, '大內區'),
(244, 17, '山上區'),
(245, 17, '新市區'),
(246, 17, '安定區'),
(247, 18, '新興區'),
(248, 18, '前金區'),
(249, 18, '苓雅區'),
(250, 18, '鹽埕區'),
(251, 18, '鼓山區'),
(252, 18, '旗津區'),
(253, 18, '前鎮區'),
(254, 18, '三民區'),
(255, 18, '楠梓區'),
(256, 18, '小港區'),
(257, 18, '左營區'),
(258, 18, '仁武區'),
(259, 18, '大社區'),
(260, 18, '東沙群島'),
(261, 18, '南沙群島'),
(262, 18, '岡山區'),
(263, 18, '路竹區'),
(264, 18, '阿蓮區'),
(265, 18, '田寮區'),
(266, 18, '燕巢區'),
(267, 18, '橋頭區'),
(268, 18, '梓官區'),
(269, 18, '彌陀區'),
(270, 18, '永安區'),
(271, 18, '湖內區'),
(272, 18, '鳳山區'),
(273, 18, '大寮區'),
(274, 18, '林園區'),
(275, 18, '鳥松區'),
(276, 18, '大樹區'),
(277, 18, '旗山區'),
(278, 18, '美濃區'),
(279, 18, '六龜區'),
(280, 18, '內門區'),
(281, 18, '杉林區'),
(282, 18, '甲仙區'),
(283, 18, '桃源區'),
(284, 18, '那瑪夏區'),
(285, 18, '茂林區'),
(286, 18, '茄萣區'),
(287, 19, '馬公市'),
(288, 19, '西嶼鄉'),
(289, 19, '望安鄉'),
(290, 19, '七美鄉'),
(291, 19, '白沙鄉'),
(292, 19, '湖西鄉'),
(293, 20, '金沙鎮'),
(294, 20, '金湖鎮'),
(295, 20, '金寧鄉'),
(296, 20, '金城鎮'),
(297, 20, '烈嶼鄉'),
(298, 20, '烏坵鄉'),
(299, 21, '屏東市'),
(300, 21, '三地門鄉'),
(301, 21, '霧臺鄉'),
(302, 21, '瑪家鄉'),
(303, 21, '九如鄉'),
(304, 21, '里港鄉'),
(305, 21, '高樹鄉'),
(306, 21, '鹽埔鄉'),
(307, 21, '長治鄉'),
(308, 21, '麟洛鄉'),
(309, 21, '竹田鄉'),
(310, 21, '內埔鄉'),
(311, 21, '萬丹鄉'),
(312, 21, '潮州鎮'),
(313, 21, '泰武鄉'),
(314, 21, '來義鄉'),
(315, 21, '萬巒鄉'),
(316, 21, '崁頂鄉'),
(317, 21, '新埤鄉'),
(318, 21, '南州鄉'),
(319, 21, '林邊鄉'),
(320, 21, '東港鎮'),
(321, 21, '琉球鄉'),
(322, 21, '佳冬鄉'),
(323, 21, '新園鄉'),
(324, 21, '枋寮鄉'),
(325, 21, '枋山鄉'),
(326, 21, '春日鄉'),
(327, 21, '獅子鄉'),
(328, 21, '車城鄉'),
(329, 21, '牡丹鄉'),
(330, 21, '恆春鎮'),
(331, 21, '滿州鄉'),
(332, 22, '臺東市'),
(333, 22, '綠島鄉'),
(334, 22, '蘭嶼鄉'),
(335, 22, '延平鄉'),
(336, 22, '卑南鄉'),
(337, 22, '鹿野鄉'),
(338, 22, '關山鎮'),
(339, 22, '海端鄉'),
(340, 22, '池上鄉'),
(341, 22, '東河鄉'),
(342, 22, '成功鎮'),
(343, 22, '長濱鄉'),
(344, 22, '太麻里鄉'),
(345, 22, '金峰鄉'),
(346, 22, '大武鄉'),
(347, 22, '達仁鄉'),
(348, 23, '花蓮市'),
(349, 23, '新城鄉'),
(350, 23, '秀林鄉'),
(351, 23, '吉安鄉'),
(352, 23, '壽豐鄉'),
(353, 23, '鳳林鎮'),
(354, 23, '光復鄉'),
(355, 23, '豐濱鄉'),
(356, 23, '瑞穗鄉'),
(357, 23, '萬榮鄉'),
(358, 23, '玉里鎮'),
(359, 23, '卓溪鄉'),
(360, 23, '富里鄉');

-- --------------------------------------------------------

--
-- 資料表結構 `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_order_id` int(255) NOT NULL,
  `serial_head` varchar(10) NOT NULL,
  `serial_number` int(20) NOT NULL,
  `shipment_type` varchar(10) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `company_chinese` varchar(255) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `contact_company_phone` varchar(20) NOT NULL,
  `contact_company_extension` varchar(20) NOT NULL,
  `contact_company_fax` varchar(20) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `purchase_order_no` varchar(255) NOT NULL,
  `lc_no` varchar(50) NOT NULL,
  `hs_code` varchar(20) NOT NULL,
  `cargo_weight` varchar(20) NOT NULL,
  `dangerous_goods` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `un_no` varchar(10) NOT NULL,
  `volume` int(11) DEFAULT NULL,
  `cabinet_volume` varchar(255) NOT NULL,
  `cfs_quantity_unit_id` int(11) DEFAULT NULL,
  `terms_of_trade` varchar(20) NOT NULL,
  `terms_of_trade_remark` varchar(255) NOT NULL,
  `cut_off_place_id` int(11) NOT NULL,
  `goods_date` date NOT NULL,
  `cut_off_date` date DEFAULT NULL,
  `onboard_date` date DEFAULT NULL,
  `destination_id` int(11) NOT NULL,
  `ocean_export_price_data` varchar(50) NOT NULL,
  `attachments` text NOT NULL,
  `remark` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cs_staff_id` int(11) NOT NULL DEFAULT 0,
  `cs_staff_date` date DEFAULT NULL,
  `cs_staff_attachment` text NOT NULL,
  `so_attachment` varchar(255) NOT NULL,
  `doc_staff_id` int(11) NOT NULL DEFAULT 0,
  `doc_staff_date` date DEFAULT NULL,
  `doc_staff_attachment` varchar(255) NOT NULL,
  `bill_of_lading_attachment` varchar(255) NOT NULL,
  `receive_bill_attachment` varchar(255) NOT NULL,
  `financial_staff_id` int(11) NOT NULL DEFAULT 0,
  `financial_staff_date` date DEFAULT NULL,
  `financial_staff_attachment` varchar(255) NOT NULL,
  `case_closed_staff_id` int(255) NOT NULL,
  `case_closed_date` date DEFAULT NULL,
  `trading` varchar(20) NOT NULL,
  `schedule` int(11) NOT NULL,
  `cancel_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `cabinet_volume`
--

CREATE TABLE `cabinet_volume` (
  `cabinet_volume_id` int(255) NOT NULL,
  `show_name` varchar(20) NOT NULL,
  `sql_name` varchar(20) NOT NULL,
  `table_name` varchar(20) NOT NULL,
  `cabinet_volume_del` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cabinet_volume`
--

INSERT INTO `cabinet_volume` (`cabinet_volume_id`, `show_name`, `sql_name`, `table_name`, `cabinet_volume_del`, `create_time`) VALUES
(1, 'X 20\'CNTR', '20_cntr', '20\'CNTR', 0, '2022-08-08 16:45:26'),
(2, 'X 40\'CNTR', '40_cntr', '40\'CNTR', 0, '2022-08-08 16:45:26'),
(3, 'X 40\'HQ', '40_hq', '40\'HQ', 0, '2022-08-08 16:45:47');

-- --------------------------------------------------------

--
-- 資料表結構 `cfs_ocean_price`
--

CREATE TABLE `cfs_ocean_price` (
  `cfs_ocean_price_id` int(255) NOT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `destination_port_id` int(11) NOT NULL,
  `cut_off_place_id` int(11) NOT NULL,
  `cfs_ocean_price` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cfs_ocean_price`
--

INSERT INTO `cfs_ocean_price` (`cfs_ocean_price_id`, `ocean_export_id`, `destination_port_id`, `cut_off_place_id`, `cfs_ocean_price`, `create_time`) VALUES
(97, 9, 2, 1, 10, '2023-02-28 00:06:44'),
(98, 9, 2, 2, 20, '2023-02-28 00:06:44'),
(99, 9, 2, 3, 30, '2023-02-28 00:06:44'),
(100, 9, 2, 4, 40, '2023-02-28 00:06:44'),
(101, 10, 20, 1, 20, '2023-02-28 00:06:44'),
(102, 10, 20, 2, 30, '2023-02-28 00:06:44'),
(103, 10, 20, 3, 40, '2023-02-28 00:06:44'),
(104, 10, 20, 4, 50, '2023-02-28 00:06:44'),
(105, 11, 39, 1, 15, '2023-02-28 00:06:20'),
(106, 11, 39, 2, 25, '2023-02-28 00:06:20'),
(107, 11, 39, 3, 35, '2023-02-28 00:06:44'),
(108, 11, 39, 4, 45, '2023-02-28 00:06:44'),
(109, 13, 75, 1, 13, '2023-02-28 00:06:44'),
(110, 13, 75, 2, 14, '2023-02-28 00:06:44'),
(111, 13, 75, 3, 15, '2023-02-28 00:06:44'),
(127, 13, 75, 4, 16, '2023-02-28 00:06:44');

-- --------------------------------------------------------

--
-- 資料表結構 `cfs_quantity_unit`
--

CREATE TABLE `cfs_quantity_unit` (
  `cfs_quantity_unit_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `cfs_quantity_unit_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cfs_quantity_unit`
--

INSERT INTO `cfs_quantity_unit` (`cfs_quantity_unit_id`, `unit`, `cfs_quantity_unit_del`) VALUES
(1, 'PLT', 0),
(2, 'CTN', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `city`
--

CREATE TABLE `city` (
  `city_id` int(255) NOT NULL,
  `country_id` int(255) NOT NULL,
  `city_english` varchar(50) NOT NULL,
  `city_chinese` varchar(50) NOT NULL,
  `city_abbreviation` varchar(50) NOT NULL,
  `city_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `city_english`, `city_chinese`, `city_abbreviation`, `city_del`) VALUES
(1, 1, '', '台北市', '', 0),
(2, 1, 'KEELUNG', '基隆市', 'TWKEL', 0),
(3, 1, '', '新北市', '', 0),
(5, 1, '', '宜蘭縣', '', 0),
(7, 1, '', '新竹市', '', 0),
(8, 1, '', '新竹縣', '', 0),
(9, 1, '', '桃園市', 'TWTAO', 0),
(10, 1, '', '苗栗縣', '', 0),
(11, 1, '', '台中市', 'TWTXG', 0),
(12, 1, '', '彰化縣', '', 0),
(13, 1, '', '南投縣', '', 0),
(14, 1, '', '嘉義市', '', 0),
(15, 1, '', '嘉義縣', '', 0),
(16, 1, '', '雲林縣', '', 0),
(17, 1, '', '台南市', '', 0),
(18, 1, '', '高雄市', 'TWKHH', 0),
(19, 1, '', '澎湖縣', '', 0),
(20, 1, '', '金門縣', '', 0),
(21, 1, '', '屏東縣', '', 0),
(22, 1, '', '臺東縣', '', 0),
(23, 1, '', '花蓮縣', '', 0),
(24, 28, 'Ahmedabad', '', '', 0),
(25, 28, 'Ankleshwar', '', '', 0),
(26, 28, 'Aurangabad', '', '', 0),
(27, 28, 'Bangalore', '', '', 0),
(28, 28, 'Vadodara/Baroda', '', '', 0),
(29, 28, 'Bhusawal', '', '', 0),
(30, 28, 'Dadri', '', '', 0),
(31, 28, 'Durgapur', '', '', 0),
(32, 28, 'Faridabad', '', '', 0),
(33, 28, 'Gurgaon', '', '', 0),
(34, 28, 'Hyderabad', '', '', 0),
(35, 28, 'Jaipur', '', '', 0),
(36, 28, 'Jodhpur', '', '', 0),
(37, 28, 'Kanpur', '', '', 0),
(38, 28, 'Ludhiana', '', '', 0),
(39, 28, 'Mandideep', '', '', 0),
(40, 28, 'Moradabad', '', '', 0),
(41, 28, 'Mulund', '', '', 0),
(42, 28, 'Nagpur', '', '', 0),
(43, 28, 'New Delhi', '', '', 0),
(44, 28, 'Patparganj', '', '', 0),
(45, 28, 'Tihi', '', '', 0),
(46, 28, 'Pune', '', '', 0),
(47, 28, 'Ratlam', '', '', 0),
(48, 28, 'Sanand', '', '', 0),
(49, 28, 'Surat', '', '', 0),
(50, 28, 'Nagpur', '', '', 0),
(51, 28, 'Tarapur', '', '', 0),
(52, 28, 'Kanpur', '', '', 0),
(53, 28, 'Sonipat', '', '', 0),
(54, 28, 'Bawal', '', '', 0),
(55, 28, 'Faridabad', '', '', 0),
(56, 28, 'Sahnewal', '', '', 0),
(57, 28, 'Tumb', '', '', 0),
(58, 28, 'Panipat', '', '', 0),
(59, 28, 'Samrala', '', '', 0),
(60, 28, 'Birgunj', '', '', 0),
(61, 28, 'Ghaziabad', '', '', 0),
(62, 28, 'Rajasthan', '', '', 0),
(63, 28, 'Verna', '', '', 0),
(65, 28, 'Palwal', '', '', 0),
(66, 28, 'Biratnagar', '', '', 0),
(67, 28, 'Bhairawaha', '', '', 0),
(68, 28, 'KILA RAIPUR', '', '', 0),
(69, 28, 'Powarkheda', '', '', 0),
(70, 28, 'Wardha', '', '', 0),
(71, 28, 'Agra', '', '', 0),
(72, 28, 'Barhi', '', '', 0),
(73, 28, 'Rewari', '', '', 0),
(74, 28, 'Rudrapur', '', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `tax_id_number` int(10) NOT NULL,
  `company_chinese` varchar(20) NOT NULL,
  `company_english` varchar(50) NOT NULL,
  `company_abbreviation` varchar(20) NOT NULL,
  `type` int(20) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `company`
--

INSERT INTO `company` (`company_id`, `tax_id_number`, `company_chinese`, `company_english`, `company_abbreviation`, `type`, `create_time`) VALUES
(6, 11337775, '長榮海運股份有限公司', 'EVERGREEN MARINE CORPORATION (TAIWAN) LTD.', 'EMC', 1, '2022-08-26 11:49:35');

-- --------------------------------------------------------

--
-- 資料表結構 `company_fee_basis`
--

CREATE TABLE `company_fee_basis` (
  `company_fee_basis_id` int(11) NOT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `b_l` int(11) NOT NULL,
  `seal` int(11) NOT NULL,
  `telex_release` int(11) NOT NULL,
  `company_fee_basis_create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `company_fee_basis_thc`
--

CREATE TABLE `company_fee_basis_thc` (
  `company_fee_basis_thc_id` int(11) NOT NULL,
  `company_fee_basis_id` int(11) NOT NULL,
  `cabinet_volume_id` int(11) NOT NULL,
  `thc` int(11) NOT NULL,
  `company_fee_basis_thc_create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `contact_information`
--

CREATE TABLE `contact_information` (
  `contact_information_id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `contact_state` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `contact_text_prohibited`
--

CREATE TABLE `contact_text_prohibited` (
  `contact_text_prohibited_id` int(11) NOT NULL,
  `text_prohibited` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `contact_text_prohibited_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `contact_text_prohibited`
--

INSERT INTO `contact_text_prohibited` (`contact_text_prohibited_id`, `text_prohibited`, `reason`, `contact_text_prohibited_create`) VALUES
(1, 'www.tinyurl.com', '禁止原因惡意攻擊聯絡訊息', '2023-01-31 10:03:02'),
(2, 'fqxtzbiyr.com', '禁止原因惡意攻擊聯絡訊息', '2023-01-31 10:03:02'),
(3, 'iujxnsp.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-02 11:53:58'),
(4, 'jumboleadmagnet.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-02 11:53:58'),
(5, 'tinyurl.com', '禁止原因惡意攻擊聯絡訊息', '2023-01-31 10:03:02'),
(6, 'boostleadgeneration.com', '禁止原因惡意攻擊聯絡訊息', '2023-01-31 10:03:02'),
(7, 'bit.ly', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:24:11'),
(8, 'digital-x-press.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:26:15'),
(9, 'hilkom-digital.de', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:31:48'),
(10, 'tinyurl.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:33:06'),
(11, 'boostleadgeneration.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:34:24'),
(12, 'advanceleadgeneration.com', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:37:01'),
(13, 'strictlydigital.net', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:37:01'),
(14, 'www.monkeydigital', '禁止原因惡意攻擊聯絡訊息', '2023-02-17 16:37:01');

-- --------------------------------------------------------

--
-- 資料表結構 `country`
--

CREATE TABLE `country` (
  `country_id` int(255) NOT NULL,
  `ocean_export_id` int(11) DEFAULT NULL,
  `country_english` varchar(50) NOT NULL,
  `country_chinese` varchar(50) NOT NULL,
  `country_abbreviation` varchar(50) NOT NULL,
  `country_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `country`
--

INSERT INTO `country` (`country_id`, `ocean_export_id`, `country_english`, `country_chinese`, `country_abbreviation`, `country_del`) VALUES
(1, 0, 'TAIWAN', '台灣', 'TW', 0),
(2, 9, 'VIET NAM', '越南', '', 0),
(3, 9, 'PHILIPPINES', '菲律賓', '', 0),
(4, 11, 'BELGIUM', '比利時', '', 0),
(5, 11, 'GERMANY', '德國', '', 0),
(6, 11, 'DENMARK', '丹麥', '', 0),
(7, 11, 'ESTONIA', '愛沙尼亞', '', 0),
(8, 11, 'SPAIN', '西班牙', '', 0),
(9, 11, 'FINLAND', '芬蘭', '', 0),
(10, 11, 'UNITED KINGDOM', '英國', '', 0),
(11, 11, 'IRELAND', '愛爾蘭', '', 0),
(12, 11, 'LITHUANIA', '立陶宛', '', 0),
(13, 11, 'LATVIA', '拉脫維亞', '', 0),
(14, 11, 'NETHERLANDS', '荷蘭', '', 0),
(15, 11, 'NORWAY', '挪威', '', 0),
(16, 11, 'POLAND', '波蘭', '', 0),
(17, 11, 'PORTUGAL', '葡萄牙', '', 0),
(18, 0, 'RUSSIA', '俄羅斯', '', 0),
(19, 11, 'SWEDEN', '瑞典', '', 0),
(20, 13, 'UNITED ARAB EMIRATES', '阿拉伯聯合大公國', '', 0),
(21, 13, 'BAHRAIN', '巴林', '', 0),
(22, 13, 'IRAN', '伊朗', '', 0),
(23, 13, 'IRAQ', '伊拉克', '', 0),
(24, 13, 'KUWAIT', '科威特', '', 0),
(25, 13, 'OMAN', '阿曼', '', 0),
(26, 13, 'TESTAR', '卡達', '', 0),
(27, 13, 'SAUDI ARABIA', '沙烏地阿拉伯', '', 0),
(28, 10, 'INDIA', '印度', '', 0),
(29, 10, 'BANGLADESH', '孟加拉', '', 0),
(30, 10, 'PAKISTAN', '巴基斯坦', '', 0),
(31, 11, 'GREECE', '希臘', '', 0),
(32, 0, 'MOROCCO', '摩洛哥', '', 0),
(33, 9, 'CAMBODIA', '', '', 0),
(34, 13, 'EGYPT', '', '', 0),
(35, 9, 'HONG KONG', '', '', 0),
(36, 9, 'INDONESIA', '印尼', '', 0),
(37, 9, 'JAPAN', '', '', 0),
(38, 13, 'JORDAN', '', '', 0),
(39, 9, 'KOREA', '', '', 0),
(40, 9, 'MALAYSIA', '', '', 0),
(41, 9, 'MYANMAR', '', '', 0),
(42, 9, 'SINGAPORE', '', '', 0),
(43, 10, 'SRI LANKA', '', '', 0),
(44, 9, 'THAILAND', '', '', 0),
(45, 11, 'FRANCE', '法國', '', 0),
(46, 13, 'YEMEN', '葉門', '', 0),
(47, 9, 'CHINA', '中國', '', 0),
(48, 10, 'NEPAL', '尼泊爾', '', 0),
(49, 13, 'DJIBOUTI', '吉布地', '', 0),
(50, 13, 'SUDAN', '蘇丹', '', 0),
(51, 9, 'BRUNEI', '汶萊', '', 0),
(52, 11, 'ITALY', '義大利', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `customer_type`
--

CREATE TABLE `customer_type` (
  `customer_type_id` int(11) NOT NULL,
  `customer_type` varchar(20) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customer_type`
--

INSERT INTO `customer_type` (`customer_type_id`, `customer_type`, `create_time`) VALUES
(1, 'shipper', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `cut_off_place`
--

CREATE TABLE `cut_off_place` (
  `cut_off_place_id` int(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `cut_off_place` varchar(20) NOT NULL,
  `cut_off_place_english_abbreviation` varchar(50) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cut_off_place`
--

INSERT INTO `cut_off_place` (`cut_off_place_id`, `city_id`, `cut_off_place`, `cut_off_place_english_abbreviation`, `create_time`) VALUES
(1, 2, '基隆', 'KEL', '2022-08-08 16:58:02'),
(2, 9, '桃園', 'TYN', '2022-08-08 16:58:02'),
(3, 11, '台中', 'TXG', '2022-08-08 16:58:34'),
(4, 18, '高雄', 'KHH', '2022-08-08 16:58:34');

-- --------------------------------------------------------

--
-- 資料表結構 `department`
--

CREATE TABLE `department` (
  `department_id` int(255) NOT NULL,
  `department` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `department`
--

INSERT INTO `department` (`department_id`, `department`) VALUES
(1, '管理部'),
(2, '財務部'),
(3, '文件部'),
(4, 'TANK營業部'),
(5, '貨櫃管理部'),
(6, '客服部'),
(7, '客服部(台塑專案小組)'),
(8, '船務代理部'),
(9, '資訊部'),
(10, '業務部'),
(11, '人力資源部');

-- --------------------------------------------------------

--
-- 資料表結構 `destination`
--

CREATE TABLE `destination` (
  `destination_id` int(11) NOT NULL,
  `destination_port_id` int(11) DEFAULT NULL,
  `destination_container_depot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `destination`
--

INSERT INTO `destination` (`destination_id`, `destination_port_id`, `destination_container_depot_id`) VALUES
(194, NULL, 1),
(195, NULL, 2),
(196, NULL, 3),
(197, NULL, 4),
(198, NULL, 5),
(199, NULL, 6),
(200, NULL, 7),
(201, NULL, 8),
(202, NULL, 9),
(203, NULL, 10),
(204, NULL, 11),
(205, NULL, 12),
(206, NULL, 13),
(207, NULL, 14),
(208, NULL, 15),
(209, NULL, 16),
(210, NULL, 17),
(211, NULL, 18),
(212, NULL, 19),
(213, NULL, 20),
(214, NULL, 21),
(215, NULL, 22),
(216, NULL, 23),
(217, NULL, 24),
(218, NULL, 25),
(219, NULL, 26),
(220, NULL, 27),
(221, NULL, 28),
(222, NULL, 29),
(223, NULL, 30),
(224, NULL, 31),
(225, NULL, 32),
(226, NULL, 33),
(227, NULL, 34),
(228, NULL, 35),
(229, NULL, 36),
(230, NULL, 37),
(231, NULL, 38),
(232, NULL, 39),
(233, NULL, 40),
(234, NULL, 41),
(235, NULL, 42),
(236, NULL, 43),
(237, NULL, 44),
(238, NULL, 45),
(239, NULL, 46),
(240, NULL, 47),
(241, NULL, 48),
(242, NULL, 49),
(243, NULL, 50),
(244, NULL, 51),
(245, NULL, 52),
(246, NULL, 53),
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 7, NULL),
(15, 15, NULL),
(16, 16, NULL),
(17, 17, NULL),
(18, 18, NULL),
(19, 19, NULL),
(20, 20, NULL),
(21, 21, NULL),
(22, 22, NULL),
(23, 23, NULL),
(24, 24, NULL),
(25, 25, NULL),
(26, 26, NULL),
(27, 27, NULL),
(28, 28, NULL),
(29, 29, NULL),
(30, 30, NULL),
(31, 31, NULL),
(32, 32, NULL),
(33, 33, NULL),
(34, 34, NULL),
(35, 35, NULL),
(36, 36, NULL),
(37, 37, NULL),
(38, 38, NULL),
(39, 39, NULL),
(40, 40, NULL),
(41, 41, NULL),
(42, 42, NULL),
(43, 43, NULL),
(44, 44, NULL),
(45, 45, NULL),
(46, 46, NULL),
(47, 47, NULL),
(48, 48, NULL),
(49, 49, NULL),
(50, 50, NULL),
(51, 51, NULL),
(52, 52, NULL),
(53, 53, NULL),
(54, 54, NULL),
(55, 55, NULL),
(56, 56, NULL),
(57, 57, NULL),
(58, 58, NULL),
(59, 59, NULL),
(60, 60, NULL),
(61, 61, NULL),
(62, 62, NULL),
(63, 63, NULL),
(64, 64, NULL),
(65, 65, NULL),
(66, 66, NULL),
(67, 67, NULL),
(68, 69, NULL),
(69, 70, NULL),
(70, 71, NULL),
(71, 72, NULL),
(72, 73, NULL),
(73, 74, NULL),
(74, 75, NULL),
(75, 76, NULL),
(76, 77, NULL),
(77, 78, NULL),
(78, 81, NULL),
(79, 82, NULL),
(80, 83, NULL),
(81, 85, NULL),
(82, 86, NULL),
(83, 87, NULL),
(84, 88, NULL),
(85, 89, NULL),
(86, 90, NULL),
(87, 91, NULL),
(88, 92, NULL),
(89, 93, NULL),
(90, 94, NULL),
(91, 95, NULL),
(92, 96, NULL),
(93, 97, NULL),
(94, 98, NULL),
(95, 99, NULL),
(96, 100, NULL),
(97, 101, NULL),
(98, 102, NULL),
(99, 103, NULL),
(100, 104, NULL),
(101, 105, NULL),
(102, 106, NULL),
(103, 107, NULL),
(104, 108, NULL),
(105, 109, NULL),
(106, 110, NULL),
(107, 111, NULL),
(108, 112, NULL),
(109, 113, NULL),
(110, 114, NULL),
(111, 115, NULL),
(112, 116, NULL),
(113, 117, NULL),
(114, 118, NULL),
(115, 119, NULL),
(116, 120, NULL),
(117, 121, NULL),
(118, 122, NULL),
(119, 123, NULL),
(120, 124, NULL),
(121, 125, NULL),
(122, 126, NULL),
(123, 127, NULL),
(124, 128, NULL),
(125, 129, NULL),
(126, 130, NULL),
(127, 131, NULL),
(128, 132, NULL),
(129, 133, NULL),
(130, 134, NULL),
(131, 135, NULL),
(132, 136, NULL),
(133, 137, NULL),
(134, 140, NULL),
(135, 141, NULL),
(136, 142, NULL),
(137, 143, NULL),
(138, 144, NULL),
(139, 145, NULL),
(140, 146, NULL),
(141, 148, NULL),
(142, 149, NULL),
(143, 150, NULL),
(144, 151, NULL),
(145, 152, NULL),
(146, 153, NULL),
(147, 154, NULL),
(148, 155, NULL),
(149, 157, NULL),
(150, 158, NULL),
(151, 159, NULL),
(152, 160, NULL),
(153, 161, NULL),
(154, 162, NULL),
(155, 163, NULL),
(156, 164, NULL),
(157, 165, NULL),
(158, 166, NULL),
(159, 167, NULL),
(160, 168, NULL),
(161, 169, NULL),
(162, 170, NULL),
(163, 171, NULL),
(164, 172, NULL),
(165, 173, NULL),
(166, 180, NULL),
(167, 181, NULL),
(168, 182, NULL),
(169, 183, NULL),
(170, 184, NULL),
(171, 185, NULL),
(172, 186, NULL),
(173, 188, NULL),
(174, 189, NULL),
(175, 190, NULL),
(176, 191, NULL),
(177, 192, NULL),
(178, 193, NULL),
(179, 194, NULL),
(180, 195, NULL),
(181, 196, NULL),
(182, 197, NULL),
(183, 198, NULL),
(184, 199, NULL),
(185, 200, NULL),
(186, 201, NULL),
(187, 202, NULL),
(188, 203, NULL),
(189, 204, NULL),
(190, 205, NULL),
(191, 206, NULL),
(192, 208, NULL),
(193, 209, NULL),
(247, 210, NULL),
(248, 211, NULL),
(249, 212, NULL),
(250, 213, NULL),
(251, 214, NULL),
(252, 215, NULL),
(253, 216, NULL),
(254, 217, NULL),
(255, 218, NULL),
(256, 219, NULL),
(257, 220, NULL),
(258, 221, NULL),
(259, 222, NULL),
(260, 223, NULL),
(261, 224, NULL),
(262, 225, NULL),
(263, 226, NULL),
(264, 227, NULL),
(265, 228, NULL),
(266, 229, NULL),
(267, 230, NULL),
(268, 231, NULL),
(269, 232, NULL),
(270, 233, NULL),
(271, 234, NULL),
(272, 235, NULL),
(273, 236, NULL),
(274, 237, NULL),
(275, 238, NULL),
(276, 239, NULL),
(277, 240, NULL),
(278, 241, NULL),
(279, 242, NULL),
(280, 243, NULL),
(281, 244, NULL),
(282, 245, NULL),
(283, 246, NULL),
(284, 247, NULL),
(285, 248, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `destination_area`
--

CREATE TABLE `destination_area` (
  `destination_area_id` int(255) NOT NULL,
  `destination_area_english` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `destination_area`
--

INSERT INTO `destination_area` (`destination_area_id`, `destination_area_english`) VALUES
(1, 'ASIA'),
(2, 'CHENNAI'),
(3, 'EUROPE'),
(4, 'EUROPE ADD ON'),
(5, 'MIDDLE EAST'),
(6, 'MUNDRA'),
(7, 'NHAVA SHEVA'),
(8, 'PAKISTAN');

-- --------------------------------------------------------

--
-- 資料表結構 `destination_city`
--

CREATE TABLE `destination_city` (
  `destination_city_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `destination_city_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `destination_city`
--

INSERT INTO `destination_city` (`destination_city_id`, `city_id`, `destination_city_del`) VALUES
(1, 24, 0),
(2, 25, 0),
(3, 26, 0),
(4, 27, 0),
(5, 28, 0),
(6, 29, 0),
(7, 30, 0),
(8, 31, 0),
(9, 32, 0),
(10, 33, 0),
(11, 34, 0),
(12, 35, 0),
(13, 36, 0),
(14, 37, 0),
(15, 38, 0),
(16, 39, 0),
(17, 40, 0),
(18, 41, 0),
(19, 42, 0),
(20, 43, 0),
(21, 44, 0),
(22, 45, 0),
(23, 46, 0),
(24, 47, 0),
(25, 48, 0),
(26, 49, 0),
(27, 50, 0),
(28, 51, 0),
(29, 52, 0),
(30, 53, 0),
(31, 54, 0),
(32, 55, 0),
(33, 56, 0),
(34, 57, 0),
(35, 58, 0),
(36, 59, 0),
(37, 60, 0),
(38, 61, 0),
(39, 62, 0),
(40, 63, 0),
(41, 65, 0),
(42, 66, 0),
(43, 67, 0),
(44, 68, 0),
(45, 69, 0),
(46, 70, 0),
(47, 71, 0),
(48, 72, 0),
(49, 73, 0),
(50, 74, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `destination_container_depot`
--

CREATE TABLE `destination_container_depot` (
  `destination_container_depot_id` int(11) NOT NULL,
  `destination_city_id` int(11) NOT NULL,
  `container_depot_english` varchar(50) NOT NULL,
  `destination_container_depot_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `destination_container_depot`
--

INSERT INTO `destination_container_depot` (`destination_container_depot_id`, `destination_city_id`, `container_depot_english`, `destination_container_depot_del`) VALUES
(1, 1, 'ICD KHODIYAR', 0),
(2, 2, 'ICD ANKLESHWAR', 0),
(3, 3, 'ICD MALIWADA', 0),
(4, 4, 'ICD BANGALORE', 0),
(5, 5, 'ICD DASHRATH', 0),
(6, 6, 'ICD BHUSAWAL', 0),
(7, 7, 'ICD DADRI', 0),
(8, 8, 'ICD DURAGAPUR', 0),
(9, 9, 'ICD FARIDABAD', 0),
(10, 10, 'ICD GARHI HASRU', 0),
(11, 10, 'ICD PATLI', 0),
(12, 11, 'ICD SANATHNAGAR', 0),
(13, 12, 'ICD KANAKPURA', 0),
(14, 13, 'ICD BHAGAT KI KOTHI', 0),
(15, 13, 'ICD PAL(THAR)', 0),
(16, 14, 'ICD JRY KANPUR', 0),
(17, 15, 'ICD LUDHIANA', 0),
(18, 16, 'ICD MANDIDEEP', 0),
(19, 17, 'ICD MORADABAD', 0),
(20, 18, 'ICD MULUND', 1),
(21, 19, 'ICD NAGPUR', 0),
(22, 20, 'ICD TUGHLAKABAD', 0),
(23, 21, 'ICD PATPARGANJ', 1),
(24, 22, 'ICD TIHI', 0),
(25, 23, 'ICD TALEGAON', 0),
(26, 23, 'ICD CHAKEN', 0),
(27, 24, 'ICD RATLAM', 1),
(28, 25, 'ICD SANAND', 0),
(29, 26, 'ICD SACHIN', 0),
(30, 27, 'ICD BORKHEDI', 0),
(31, 28, 'ICD TARAPUR', 0),
(32, 29, 'ICD PANKI', 0),
(33, 30, 'ICD SONIPAT', 0),
(34, 31, 'ICD BAWAL', 0),
(35, 32, 'ICD PIYALA', 0),
(36, 33, 'ICD SAHNEWAL', 0),
(37, 34, 'ICD TUMB', 0),
(38, 35, 'ICD JATTIPUR PANINAPT', 0),
(39, 36, 'ICD CHAWA PALI', 0),
(40, 37, 'ICD BIRGUNJ', 0),
(41, 38, 'ICD LONI', 0),
(42, 39, 'ICD KHATUWAS', 0),
(43, 40, 'ICD VERNA', 0),
(44, 41, 'ICD PALWAL', 0),
(45, 42, 'ICD BIRATNAGAR', 0),
(46, 43, 'ICD BHAIRAWAHA', 0),
(47, 44, 'ICD KILA RAIPUR', 0),
(48, 45, 'ICD POWARKHEDA', 0),
(49, 46, 'ICD WARDHA', 0),
(50, 47, 'ICD AGRA', 0),
(51, 48, 'ICD BARHI', 0),
(52, 49, 'ICD REWARI', 0),
(53, 50, 'ICD PANT NAGAR', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `destination_port`
--

CREATE TABLE `destination_port` (
  `destination_port_id` int(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `destination_port_english` varchar(100) NOT NULL,
  `port_code` varchar(20) NOT NULL,
  `port_code_1` varchar(20) NOT NULL,
  `destination_port_del` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `destination_port`
--

INSERT INTO `destination_port` (`destination_port_id`, `country_id`, `destination_port_english`, `port_code`, `port_code_1`, `destination_port_del`) VALUES
(1, 2, 'CAT LAI', 'VNCLI', 'VNSGN', 0),
(2, 3, 'MANILA NORTH', 'PHMNN', 'PHMNL', 0),
(3, 3, 'MANILA SOUTH', 'PHMNS', '', 0),
(4, 4, 'ANTWERP', 'BEANR', '', 0),
(5, 5, 'HAMBURG', 'DEHAM', '', 0),
(6, 14, 'ROTTERDAM', 'NLRTM', '', 0),
(7, 10, 'SOUTHAMPTON', 'GBSOU', '', 0),
(15, 22, 'BANDAR ABBAS', 'IRBND', '', 0),
(16, 22, 'BUSHEHR', '', '', 1),
(17, 22, 'KHORRAMSHAHR', '', '', 1),
(18, 22, 'IMAM KHOMEINI', '', '', 1),
(19, 20, 'JEBEL ALI', 'AEJEA', '', 0),
(20, 30, 'KARACHI', 'PKKHI', '', 0),
(21, 30, 'PORT QASIM', '', '', 1),
(22, 28, 'CHENNAI', 'INMAA', 'IN003', 0),
(23, 6, 'AARHUS', 'DKAAR', '', 0),
(24, 6, 'COPENHAGEN', 'DKCPH', '', 0),
(25, 6, 'FREDERICIA', 'DKFRC', '', 0),
(26, 7, 'TALLIN', 'EETLL', '', 0),
(27, 8, 'BILBAO', 'ESBIO', '', 0),
(28, 8, 'VIGO', 'ESVGO', '', 0),
(29, 9, 'HELSINKI', 'FIHEL', '', 0),
(30, 9, 'KOTKA', 'FIKTK', '', 0),
(31, 9, 'OULU', 'FIOUL', '', 0),
(32, 9, 'RAUMA', 'FIRAU', '', 0),
(33, 10, 'BELFAST', 'GBBEL', '', 0),
(34, 10, 'GRANGEMOUTH CY', 'GBGRG', '', 0),
(35, 11, 'DUBLIN', 'IEDUB', '', 0),
(36, 11, 'CORK', 'IEORK', '', 0),
(37, 12, 'KLAIPEDA', 'LTKLJ', '', 0),
(38, 13, 'RIGA', 'LVRIX', '', 0),
(39, 15, 'ALESUND', 'NOAES', '', 0),
(40, 15, 'BERGEN', 'NOBGO', '', 0),
(41, 15, 'BREVIK', 'NOBVK', '', 0),
(42, 15, 'DRAMMEN', 'NODRM', '', 0),
(43, 15, 'FREDRIKSTAD', 'NOFRK', '', 0),
(44, 15, 'KRISTIANSAND', 'NOKRS', '', 0),
(45, 15, 'LARVIK', 'NOLAR', '', 0),
(46, 15, 'MALOY', 'NOMAY', '', 0),
(47, 15, 'MOSS', 'NOMSS', '', 0),
(48, 15, 'OSLO', 'NOOSL', '', 0),
(49, 15, 'TANANGER', 'NOTAE', '', 0),
(50, 16, 'GDANSK', 'PLGDN', '', 0),
(51, 16, 'GDYNIA', 'PLGDY', '', 0),
(52, 17, 'LEIXIOES', '', '', 1),
(53, 17, 'LISBON', 'PTLIS', '', 0),
(54, 18, 'ST. PETERSBURG', '', '', 1),
(55, 19, 'GOTHENBURG', 'SEGOT', '', 0),
(56, 19, 'GAVLE', 'SEGVX', '', 0),
(57, 19, 'HALMSTAD', 'SEHAD', '', 0),
(58, 19, 'HELSINGBORG', 'SEHEL', '', 0),
(59, 19, 'NORRKOPING', 'SENRK', '', 0),
(60, 19, 'SODERTALJE', 'SESOE', '', 0),
(61, 19, 'STOCKHOLM', 'SESTO', '', 0),
(62, 20, 'ABU DHABI', 'AEAUH', '', 0),
(63, 20, 'AJMAN', 'AEAJM', '', 0),
(64, 20, 'RAS AL KHAIMAH', 'AERKT', '', 0),
(65, 20, 'SHARJAH', 'AESHJ', '', 0),
(66, 20, 'UMM AL QUWAIN', 'AEQIW', '', 0),
(67, 21, 'BAHRAIN', 'BHRAH', '', 0),
(69, 23, 'UMM QASR 北港 PIER #. 11', 'IQUQR', '', 0),
(70, 23, 'UMM QASR 北港 PIER #. 20', 'IQBGT', '', 0),
(71, 23, 'UMM QASR 北港 PIER #. 25 & 26', 'IQAAT', '', 0),
(72, 24, 'SHUAIBA', 'KWSAA', '', 0),
(73, 24, 'SHUWAIKH', 'KWSWK', '', 0),
(74, 25, 'SOHAR', 'OMSOH', '', 0),
(75, 26, 'HAMAD', 'QAHMD', '', 0),
(76, 27, 'DAMMAM', 'SADMM', '', 0),
(77, 27, 'JUBAIL', 'SAJUB', '', 0),
(78, 27, 'RIYADH', 'SARUH', '', 0),
(81, 29, 'CHATTOGRAM', 'BDCGP', '', 0),
(82, 28, 'MUNDRA', 'INMUN', '', 0),
(83, 28, 'NHAVA SHEVA', 'INNSA', '', 0),
(85, 31, 'THESSALONIKI', '', '', 1),
(86, 32, 'CASABLANCA', '', '', 1),
(87, 29, 'DHAKA', 'BDDAC', '', 0),
(88, 33, 'PHNOM PENH', 'KHPNH', '', 0),
(89, 33, 'SIHANOUKVILLE', '', '', 1),
(90, 34, 'SOKHNA', 'EGSOK', '', 0),
(91, 35, 'HONG KONG', 'HKHKG', '', 0),
(92, 36, 'BELAWAN', 'IDBLW', '', 0),
(93, 36, 'JAKARTA', 'IDJKT', '', 0),
(94, 36, 'SEMARANG', 'IDSRG', '', 0),
(95, 36, 'SURABAYA', 'IDSUB', '', 0),
(96, 37, 'CHIBA', 'JPCHB', '', 0),
(97, 37, 'FUKUYAMA', 'JPFKY', '', 0),
(98, 37, 'HAKATA', 'JPHKT', '', 0),
(99, 37, 'HIROSHIMA', 'JPHIJ', '', 0),
(100, 37, 'KAWASAKI', 'JPKWS', '', 0),
(101, 37, 'KOBE', 'JPUKB', '', 0),
(102, 37, 'MATSUYAMA', 'JPMYJ', '', 0),
(103, 37, 'MISHIMA, KAWANOE ( IYOMISHIMA )', '', '', 1),
(104, 37, 'MIZUSHIMA', 'JPMIZ', '', 0),
(105, 37, 'MOJI', 'JPMOJ', '', 0),
(106, 37, 'NAGOYA', 'JPNGO', '', 0),
(107, 37, 'NAHA OKINAWA', '', '', 1),
(108, 37, 'OSAKA', 'JPOSA', '', 0),
(109, 37, 'SENDAI', 'JPSDJ', '', 0),
(110, 37, 'SHIBUSHI, KAGOSHIMA', '', '', 1),
(111, 37, 'SHIMIZU', 'JPSMZ', '', 0),
(112, 37, 'TOKUYAMA', 'JPTKY', '', 0),
(113, 37, 'TOKYO', 'JPTYO', '', 0),
(114, 37, 'YOKKAICHI', 'JPYKK', '', 0),
(115, 37, 'YOKOHAMA', 'JPYOK', '', 0),
(116, 38, 'AQABA', 'JOAQB', '', 0),
(117, 39, 'BUSAN', 'KRPUS', '', 0),
(118, 39, 'INCHEON', 'KRINC', '', 0),
(119, 39, 'KWANGYANG', 'KRKWA', '', 0),
(120, 39, 'PUSAN', '', '', 1),
(121, 39, 'ULSAN', 'KRUSN', '', 0),
(122, 40, 'BINTULU, SARAWAK', '', '', 1),
(123, 40, 'KOTA KINABALU', 'MYBKI', '', 0),
(124, 40, 'KUANTAN', 'MYKUA', '', 0),
(125, 40, 'KUCHING', 'MYKCH', '', 0),
(126, 40, 'MIRI', 'MYMYY', '', 0),
(127, 40, 'PASIR GUDANG', 'MYPGU', '', 0),
(128, 40, 'PENANG', 'MYNTL', '', 0),
(129, 40, 'PORT KLANG(N)', 'MYPKG', '', 0),
(130, 40, 'PORT KLANG(W)', 'MYWSP', '', 0),
(131, 40, 'SANDAKAN', 'MYSDK', '', 0),
(132, 40, 'SIBU', 'MYSBW', '', 0),
(133, 40, 'TAWAU', 'MYTWU', '', 0),
(134, 41, 'YANGON(RANGOON)', 'MMRGN', '', 0),
(135, 3, 'BATANGAS, LUZON', '', '', 1),
(136, 3, 'CEBU', 'PHCEB', '', 0),
(137, 3, 'DAVAO', 'PHDVO', '', 0),
(140, 3, 'SUBIC BAY', 'PHSFS', '', 0),
(141, 27, 'JEDDAH', 'SAJED', '', 0),
(142, 42, 'SINGAPORE', 'SGSIN', '', 0),
(143, 43, 'COLOMBO', 'LKCMB', '', 0),
(144, 44, 'BANGKOK', 'THBKK', '', 0),
(145, 44, 'LAEM CHABANG', 'THLCH', '', 0),
(146, 44, 'LAT KRABANG', 'THLKR', '', 0),
(148, 2, 'DA NANG', 'VNDAD', '', 0),
(149, 2, 'HAIPHONG', 'VNHPH', '', 0),
(150, 45, 'DUNKERQUE', 'FRDKK', '', 0),
(151, 45, 'LE HAVRE', 'FRLEH', '', 0),
(152, 10, 'FELIXSTOWE', 'GBFXT', '', 0),
(153, 10, 'LIVERPOOL', 'GBLIB', '', 0),
(154, 16, 'SZCZECIN', 'PLSZZ', '', 0),
(155, 46, 'ADEN', 'YEADE', '', 0),
(157, 47, 'DALIAN', 'CNDAL', '', 0),
(158, 47, 'NINGBO', 'CNNBO', '', 0),
(159, 47, 'QINGDAO', 'CNTAO', '', 0),
(160, 47, 'SHANGHAI', 'CNSHA', '', 0),
(161, 47, 'XINGANG', 'CNXGA', '', 0),
(162, 5, 'WILHELMSHAVEN', 'DEWVN', '', 0),
(163, 28, 'KOLKATA', 'INCCU', '', 0),
(164, 28, 'COCHIN', 'INCOK', '', 0),
(165, 28, 'KATTUPALLI', 'INKTP', '', 0),
(166, 28, 'PIPAVA', 'INPPV', '', 0),
(167, 28, 'TUTICORIN', 'INTUT', '', 0),
(168, 28, 'VIZAG', 'INVIZ', '', 0),
(169, 36, 'BATAM', 'IDBTM', '', 0),
(170, 37, 'HACHINOHE', 'JPHHE', '', 0),
(171, 37, 'HITACHINAKA', 'JPHIC', '', 0),
(172, 37, 'NIIGATA', 'JPKIJ', '', 0),
(173, 37, 'TOMAKOMAI', 'JPTMK', '', 0),
(180, 48, 'BIRGUNJ', 'NPBRG', '', 0),
(181, 2, 'SP-ITC', 'VNITC', '', 0),
(182, 2, 'CAI MEP', 'VNTOT', '', 0),
(183, 25, 'DUQM', 'OMDQM', '', 0),
(184, 25, 'SALALAH', 'OMSLL', '', 0),
(185, 20, 'UMM AL QUWAIN', '', '', 1),
(186, 33, 'KAMPONG SAOM', 'KHKOS', '', 0),
(188, 4, 'ZEEBRUGGE', 'BEZEE', '', 0),
(189, 17, 'LEIXOES', 'PTLEI', '', 0),
(190, 49, 'DJIBOUTI', 'DJJIB', '', 0),
(191, 50, 'PORT SUDAN', 'SDPZU', '', 0),
(192, 28, 'HALDIA', 'INHAL', '', 0),
(193, 28, 'VISAKHAPATNAM', 'INVTZ', '', 0),
(194, 28, 'MUNDRA ICD', 'INMUN-ICD', '', 0),
(195, 28, 'NHAVA SHEVA ICD', 'INNSA-ICD', '', 0),
(196, 23, 'UMM QASR 北港 PIER #. 27', 'IQUQS', '', 0),
(197, 51, 'MUARA', 'BNMUA', '', 0),
(198, 3, 'BATANGAS', 'PHBTG', '', 0),
(199, 3, 'CAGAYAN DE ORO', 'PHCGY', '', 0),
(200, 3, 'GENERAL SANTOS', 'PHGES', '', 0),
(201, 8, 'BARCELONA', 'ESBCN', '', 0),
(202, 45, 'FOS SUR MER', 'FRFOS', '', 0),
(203, 31, 'PIRAEUS', 'GRPIR', '', 0),
(204, 52, 'GENOA', 'ITGOA', '', 0),
(205, 52, 'LA SPEZIA', 'ITSPE', '', 0),
(206, 28, 'KATTUPALLI-ICD', 'INKTP-ICD', '', 0),
(208, 28, 'PIPAVA ICD', 'INPPV-ICD', '', 0),
(209, 28, 'KOLKATA ICD', 'INCCU-ICD', '', 0),
(210, 33, 'KAMPONG SAOM (SIHANOUKVILLE)', '', '', 1),
(211, 40, 'BINTULU', 'MYBTU', '', 0),
(212, 40, 'TANJUNG PELEPAS', 'MYTPP', '', 0),
(213, 28, 'CHENNAI ICD', 'INMAA-ICD', '', 0),
(214, 8, 'VALENCIA', 'ESVLC', '', 0),
(215, 28, 'AHMEDABAD', 'INAMD', '', 0),
(216, 28, 'BANGALORE', 'INBLR', '', 0),
(217, 28, 'HYDERABAD', 'INHYD', '', 0),
(218, 28, 'NEW DELHI', 'INICD', '', 0),
(219, 28, 'CHENNAI ( KATTUPALLI )', 'INMAA', '', 0),
(220, 37, 'HIBIKI', 'JPHBK', '', 0),
(221, 37, 'HOSOSHIMA', 'JPHSM', '', 0),
(222, 37, 'IMABARI', 'JPIMB', '', 0),
(223, 37, 'IWAKUNI', 'JPIWK', '', 0),
(224, 37, 'IYOMISHIMA', 'JPIYM', '', 0),
(225, 37, 'KAMAISHI', 'JPKIS', '', 0),
(226, 37, 'KASHIMA', 'JPKSM', '', 0),
(227, 37, 'NAKANOSEKI', 'JPNAN', '', 0),
(228, 37, 'NAGASAKI', 'JPNGS', '', 0),
(229, 37, 'NICHINAN', 'JPNIC', '', 0),
(230, 37, 'OITA', 'JPOIT', '', 0),
(231, 37, 'OMAEZAKI', 'JPOMZ', '', 0),
(232, 37, 'SHIBUSHI', 'JPSBS', '', 0),
(233, 37, 'SATSUMASENDAI', 'JPSEN', '', 0),
(234, 37, 'TAKAMATSU', 'JPTAK', '', 0),
(235, 37, 'TOYOHASHI', 'JPTHS', '', 0),
(236, 37, 'TOKUSHIMA', 'JPTKS', '', 0),
(237, 37, 'UBE', 'JPUBJ', '', 0),
(238, 37, 'WAKAYAMA', 'JPWAK', '', 0),
(239, 37, 'YATSUSHIRO', 'JPYAT', '', 0),
(240, 37, 'AKITA', 'JPAXT', '', 0),
(241, 37, 'IMARI', 'JPIMI', '', 0),
(242, 37, 'ISHIKARI', 'JPISI', '', 0),
(243, 37, 'KANAZAWA', 'JPKNZ', '', 0),
(244, 37, 'KUSHIRO', 'JPKUH', '', 0),
(245, 37, 'ONAHAMA', 'JPONA', '', 0),
(246, 37, 'OTARU', 'JPOTR', '', 0),
(247, 37, 'SAKATA', 'JPSKT', '', 0),
(248, 37, 'TOYAMA', 'JPTOY', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `dg_ocean_price`
--

CREATE TABLE `dg_ocean_price` (
  `dg_ocean_price_id` int(11) NOT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `cut_off_place_id` int(11) NOT NULL,
  `cabinet_volume_id` int(11) NOT NULL,
  `dg_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `email_address_book`
--

CREATE TABLE `email_address_book` (
  `email_address_book_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `email_notification_message`
--

CREATE TABLE `email_notification_message` (
  `email_notification_message_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `filename` text NOT NULL,
  `member_id_array` text NOT NULL,
  `email_notification_message_pass` int(11) NOT NULL DEFAULT 0,
  `send_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `ip_black_list`
--

CREATE TABLE `ip_black_list` (
  `ip_black_list_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `ip_black_list_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `ip_log`
--

CREATE TABLE `ip_log` (
  `ip_id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `action` varchar(20) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `ocean_export_id` int(11) DEFAULT NULL,
  `destination_port_id` int(11) DEFAULT NULL,
  `shipment_type` varchar(10) DEFAULT NULL,
  `ip_create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ip_log`
--

INSERT INTO `ip_log` (`ip_id`, `ip`, `action`, `member_id`, `ocean_export_id`, `destination_port_id`, `shipment_type`, `ip_create_time`) VALUES
(1, '::1', NULL, NULL, NULL, NULL, NULL, '2023-02-26 02:06:24'),
(2, '::1', NULL, NULL, NULL, NULL, NULL, '2023-02-27 23:25:46'),
(3, '::1', NULL, NULL, NULL, NULL, NULL, '2023-02-27 23:48:14'),
(4, '::1', NULL, 1, NULL, NULL, NULL, '2023-02-28 00:02:01'),
(5, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:06:52'),
(6, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:07:04'),
(7, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:07:05'),
(8, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:07:06'),
(9, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:07:08'),
(10, '::1', NULL, 1, 9, 2, 'CY', '2023-02-28 00:08:59'),
(11, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:09:00'),
(12, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:09:10'),
(13, '::1', NULL, 1, 9, 2, 'CY', '2023-02-28 00:09:11'),
(14, '::1', NULL, 1, 9, 1, 'CY', '2023-02-28 00:09:12'),
(15, '::1', 'BookingOrder', 1, NULL, NULL, 'CY', '2023-02-28 00:10:44'),
(16, '::1', NULL, 1, NULL, NULL, NULL, '2023-02-28 00:32:26'),
(17, '::1', NULL, 1, 10, 22, 'CY', '2023-02-28 00:32:30'),
(18, '::1', NULL, 1, 10, 20, 'CY', '2023-02-28 00:32:31'),
(19, '::1', NULL, 1, 10, 22, 'CY', '2023-02-28 00:32:32'),
(20, '::1', NULL, 1, 13, 190, 'CY', '2023-02-28 00:32:34'),
(21, '::1', NULL, 1, 13, 75, 'CY', '2023-02-28 00:32:35'),
(22, '::1', NULL, 1, 13, 190, 'CY', '2023-02-28 00:32:37'),
(23, '::1', NULL, 1, 9, 2, 'CFS', '2023-02-28 00:40:22'),
(24, '::1', NULL, 1, 9, 1, 'CFS', '2023-02-28 00:40:42'),
(25, '::1', NULL, 1, 10, 22, 'CFS', '2023-02-28 00:40:44'),
(26, '::1', NULL, 1, 10, 22, 'CFS', '2023-02-28 00:41:02'),
(27, '::1', NULL, 1, 10, 22, 'CFS', '2023-02-28 00:41:06'),
(28, '::1', NULL, 1, 10, 22, 'CFS', '2023-02-28 00:41:07'),
(29, '::1', NULL, 1, 10, 22, 'CFS', '2023-02-28 00:41:10'),
(30, '::1', NULL, 1, 11, 204, 'CFS', '2023-02-28 00:41:14'),
(31, '::1', NULL, 1, 9, 2, 'CFS', '2023-02-28 00:50:08'),
(32, '::1', NULL, 1, 10, 20, 'CFS', '2023-02-28 00:50:14'),
(33, '::1', NULL, 1, 9, 2, 'CFS', '2023-02-28 00:51:36'),
(34, '::1', NULL, 1, 9, 2, 'CFS', '2023-02-28 00:51:39'),
(35, '::1', NULL, 1, 10, 20, 'CFS', '2023-02-28 00:51:42'),
(36, '::1', NULL, 1, 10, 20, 'CFS', '2023-02-28 00:51:44'),
(37, '::1', NULL, 1, 9, 2, 'CFS', '2023-02-28 00:51:47');

-- --------------------------------------------------------

--
-- 資料表結構 `marquee`
--

CREATE TABLE `marquee` (
  `marquee_id` int(255) NOT NULL,
  `marquee_content` text NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `default_select` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `marquee`
--

INSERT INTO `marquee` (`marquee_id`, `marquee_content`, `create_time`, `default_select`) VALUES
(1, '歡迎光臨測試海運網，我們提供專業、快速、優質的服務。歡迎註冊會員使用服務。', '2022-07-19 15:33:39', 1),
(14, '慶祝測試公司18周年慶，即日起加入測試海運網會員，首次配合費用打折 !', '2022-08-24 11:41:43', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `member_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tax_id_number` varchar(20) NOT NULL,
  `company_chinese` varchar(255) NOT NULL,
  `company_english` varchar(255) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_cellphone` varchar(20) NOT NULL,
  `contact_company_phone` varchar(20) NOT NULL,
  `contact_company_extension` varchar(20) NOT NULL,
  `contact_company_fax` varchar(20) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `area_id` int(255) NOT NULL,
  `company_address` varchar(50) NOT NULL,
  `register_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `pass` int(1) NOT NULL,
  `pass_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_id`, `username`, `password`, `tax_id_number`, `company_chinese`, `company_english`, `contact_name`, `gender`, `contact_cellphone`, `contact_company_phone`, `contact_company_extension`, `contact_company_fax`, `contact_email`, `area_id`, `company_address`, `register_time`, `pass`, `pass_message`) VALUES
(1, 'peter777200067@gmail.com', '$2y$10$obJTgnyu3Gau/F6onxNvq.dSRvpPwchXh7ZDU4SG8kJf5ibaldTFq', '12345678', '測試股份有限公司', 'TEST CO., LTD.', '章汶霖', 'male', '', '(02) 1234-5678', '127', '', 'peter777200067@gmail.com', 0, '', '2023-02-27 16:01:44', 1, '通過會員');

-- --------------------------------------------------------

--
-- 資料表結構 `member_log`
--

CREATE TABLE `member_log` (
  `member_log_id` int(255) NOT NULL,
  `register_username` varchar(50) NOT NULL,
  `member_id` int(20) DEFAULT NULL,
  `verification_code` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `frequency` int(11) NOT NULL,
  `pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `member_login_log`
--

CREATE TABLE `member_login_log` (
  `member_loging_log_id` int(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_login_log`
--

INSERT INTO `member_login_log` (`member_loging_log_id`, `member_id`, `login_time`) VALUES
(1, 1, '2023-02-28 00:02:01');

-- --------------------------------------------------------

--
-- 資料表結構 `ocean_export`
--

CREATE TABLE `ocean_export` (
  `ocean_export_id` int(255) NOT NULL,
  `quote_route` varchar(50) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `ocean_export_additional_href` text NOT NULL,
  `ocean_export_additional_link` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ocean_quote_sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ocean_export`
--

INSERT INTO `ocean_export` (`ocean_export_id`, `quote_route`, `attachment`, `ocean_export_additional_href`, `ocean_export_additional_link`, `create_time`, `ocean_quote_sort`) VALUES
(9, '亞洲地區', 'ASIA ( Export ) _0831.pdf', '', 0, '2022-05-20 16:27:41', 1),
(10, '印巴地區', 'INDIA & PAKISTAN & BANGLADESH ( Export )_0831.pdf', '印巴內陸費用.XLSX', 1, '2022-05-20 16:45:38', 4),
(11, '歐洲地區', 'EUROPE ( Export )_0831.pdf', '', 0, '2022-05-20 16:46:00', 2),
(13, '中東紅海地區', 'MIDDLE EAST ( Export )_0831.pdf', '', 0, '2022-05-20 16:46:27', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `ocean_export_date_deadline`
--

CREATE TABLE `ocean_export_date_deadline` (
  `ocean_export_date_deadline_id` int(11) NOT NULL,
  `shipment_type` varchar(10) DEFAULT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `b_l` varchar(50) NOT NULL,
  `b_l_per` varchar(20) NOT NULL,
  `b_l_remark` varchar(50) NOT NULL,
  `cfs` varchar(50) NOT NULL,
  `thc` varchar(50) NOT NULL,
  `thc_per` varchar(50) NOT NULL,
  `thc_remark` varchar(50) NOT NULL,
  `seal` varchar(50) NOT NULL,
  `seal_per` varchar(20) NOT NULL,
  `seal_remark` varchar(2) NOT NULL,
  `telex_release` varchar(50) NOT NULL,
  `telex_release_per` varchar(20) NOT NULL,
  `telex_release_remark` varchar(50) NOT NULL,
  `transfer_fee` varchar(50) NOT NULL,
  `transfer_fee_per` varchar(20) NOT NULL,
  `transfer_fee_remark` varchar(50) NOT NULL,
  `transfer_fee_country` varchar(20) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ocean_export_date_deadline`
--

INSERT INTO `ocean_export_date_deadline` (`ocean_export_date_deadline_id`, `shipment_type`, `ocean_export_id`, `attachment`, `start_date`, `end_date`, `b_l`, `b_l_per`, `b_l_remark`, `cfs`, `thc`, `thc_per`, `thc_remark`, `seal`, `seal_per`, `seal_remark`, `telex_release`, `telex_release_per`, `telex_release_remark`, `transfer_fee`, `transfer_fee_per`, `transfer_fee_remark`, `transfer_fee_country`, `create_time`) VALUES
(286, 'CFS', 11, 'QSF0131 併櫃海運費比價表 A1 歐洲地區 - FEB 28, 2023 - 6.xlsx', '2023-02-18', '2023-02-28', 'NTD 2,000', '', '', 'NTD 380', '', '', '', '', '', '', 'NTD 1,000', '', '', '', '', '', '', '2023-02-18 16:06:08'),
(287, 'CY', 10, 'QSF0130 整櫃海運費比價表 A2 印巴地區 - MAR 13,  2023 - 32.xlsx', '2023-02-18', '2023-03-13', 'NTD 2,000', '', '', '', 'NTD 5,600|NTD 7,000|NTD 7,000', '', '', 'NTD 250', '', '', 'NTD 1,000', '', '', '', '', '', '', '2023-02-18 16:41:26'),
(289, 'CY', 13, 'QSF0130 整櫃海運費比價表 A2 中東紅海地區 - FEB 28, 2023 - 30.xlsx', '2023-02-18', '2023-02-28', 'NTD 2,000', '', '', '', 'NTD 5,600|NTD 7,000|NTD 7,000', '', '', 'NTD 250', '', '', 'NTD 1,000', '', '', '', '', '', '', '2023-02-18 17:02:01'),
(292, 'CY', 9, 'QSF0130 整櫃海運費比價表 A2 亞洲地區 - Mar 15, 2023 - 26.xlsx', '2023-02-23', '2023-03-15', 'NTD 2,000', '', '', '', 'NTD 5,600|NTD 7,000|NTD 7,000', '', '', 'NTD 250', '', '', 'NTD 1,000', '', '', 'AFR:NTD 1,000', '', 'For CHINA & JAPAN', '47;37', '2023-02-23 16:59:09');

-- --------------------------------------------------------

--
-- 資料表結構 `ocean_export_price`
--

CREATE TABLE `ocean_export_price` (
  `ocean_export_price_id` int(255) NOT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `destination_port_id` int(11) NOT NULL,
  `cabinet_volume_id` int(11) NOT NULL,
  `cut_off_place_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ocean_export_price` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ocean_export_price`
--

INSERT INTO `ocean_export_price` (`ocean_export_price_id`, `ocean_export_id`, `destination_port_id`, `cabinet_volume_id`, `cut_off_place_id`, `company_id`, `ocean_export_price`, `create_time`) VALUES
(1, 9, 1, 1, 1, 6, 1500, '2023-02-28 00:05:26'),
(2, 9, 1, 2, 1, 6, 1700, '2023-02-28 00:05:26'),
(3, 9, 1, 3, 1, 6, 1700, '2023-02-28 00:05:26'),
(4, 9, 1, 1, 2, 6, 1400, '2023-02-28 00:06:04'),
(5, 9, 1, 2, 2, 6, 1500, '2023-02-28 00:06:04'),
(6, 9, 1, 3, 2, 6, 1500, '2023-02-28 00:06:04'),
(7, 9, 1, 1, 3, 6, 1100, '2023-02-28 00:06:20'),
(8, 9, 1, 2, 3, 6, 1800, '2023-02-28 00:06:20'),
(9, 9, 1, 3, 3, 6, 1800, '2023-02-28 00:06:20'),
(10, 9, 1, 1, 4, 6, 1000, '2023-02-28 00:06:44'),
(11, 9, 1, 2, 4, 6, 2000, '2023-02-28 00:06:44'),
(12, 9, 1, 3, 4, 6, 2000, '2023-02-28 00:06:44'),
(13, 9, 2, 1, 1, 6, 1500, '2023-02-28 00:05:26'),
(14, 9, 2, 2, 1, 6, 1700, '2023-02-28 00:05:26'),
(15, 9, 2, 3, 1, 6, 1700, '2023-02-28 00:05:26'),
(16, 9, 2, 1, 2, 6, 1400, '2023-02-28 00:06:04'),
(17, 9, 2, 2, 2, 6, 1500, '2023-02-28 00:06:04'),
(18, 9, 2, 3, 2, 6, 1500, '2023-02-28 00:06:04'),
(19, 9, 2, 1, 3, 6, 1100, '2023-02-28 00:06:20'),
(20, 9, 2, 2, 3, 6, 1800, '2023-02-28 00:06:20'),
(21, 9, 2, 3, 3, 6, 1800, '2023-02-28 00:06:20'),
(22, 9, 2, 1, 4, 6, 1000, '2023-02-28 00:06:44'),
(23, 9, 2, 2, 4, 6, 2000, '2023-02-28 00:06:44'),
(24, 9, 2, 3, 4, 6, 2000, '2023-02-28 00:06:44'),
(25, 10, 22, 1, 1, 6, 1000, '2023-02-28 00:05:26'),
(26, 10, 22, 2, 1, 6, 1800, '2023-02-28 00:05:26'),
(27, 10, 22, 3, 1, 6, 1800, '2023-02-28 00:05:26'),
(28, 10, 22, 1, 2, 6, 1200, '2023-02-28 00:06:04'),
(29, 10, 22, 2, 2, 6, 1600, '2023-02-28 00:06:04'),
(30, 10, 22, 3, 2, 6, 1600, '2023-02-28 00:06:04'),
(31, 10, 22, 1, 3, 6, 1000, '2023-02-28 00:06:20'),
(32, 10, 22, 2, 3, 6, 1900, '2023-02-28 00:06:20'),
(33, 10, 22, 3, 3, 6, 1900, '2023-02-28 00:06:20'),
(34, 10, 22, 1, 4, 6, 900, '2023-02-28 00:06:44'),
(35, 10, 22, 2, 4, 6, 1000, '2023-02-28 00:06:44'),
(36, 10, 22, 3, 4, 6, 1000, '2023-02-28 00:06:44'),
(37, 11, 204, 1, 1, 6, 1400, '2023-02-28 00:05:26'),
(38, 11, 204, 2, 1, 6, 1600, '2023-02-28 00:05:26'),
(39, 11, 204, 3, 1, 6, 1600, '2023-02-28 00:05:26'),
(40, 11, 204, 1, 2, 6, 1500, '2023-02-28 00:06:04'),
(41, 11, 204, 2, 2, 6, 1800, '2023-02-28 00:06:04'),
(42, 11, 204, 3, 2, 6, 1800, '2023-02-28 00:06:04'),
(43, 11, 204, 1, 3, 6, 1250, '2023-02-28 00:06:20'),
(44, 11, 204, 2, 3, 6, 1500, '2023-02-28 00:06:20'),
(45, 11, 204, 3, 3, 6, 1500, '2023-02-28 00:06:20'),
(46, 11, 204, 1, 4, 6, 1150, '2023-02-28 00:06:44'),
(47, 11, 204, 2, 4, 6, 1900, '2023-02-28 00:06:44'),
(48, 11, 204, 3, 4, 6, 1900, '2023-02-28 00:06:44'),
(49, 10, 20, 1, 1, 6, 2000, '2023-02-28 00:05:26'),
(50, 10, 20, 2, 1, 6, 2500, '2023-02-28 00:05:26'),
(51, 10, 20, 3, 1, 6, 2500, '2023-02-28 00:05:26'),
(52, 10, 20, 1, 2, 6, 2100, '2023-02-28 00:06:04'),
(53, 10, 20, 2, 2, 6, 2600, '2023-02-28 00:06:04'),
(54, 10, 20, 3, 2, 6, 2600, '2023-02-28 00:06:04'),
(55, 10, 20, 1, 3, 6, 2200, '2023-02-28 00:06:20'),
(56, 10, 20, 2, 3, 6, 2700, '2023-02-28 00:06:20'),
(57, 10, 20, 3, 3, 6, 2700, '2023-02-28 00:06:20'),
(58, 10, 20, 1, 4, 6, 2300, '2023-02-28 00:06:44'),
(59, 10, 20, 2, 4, 6, 2900, '2023-02-28 00:06:44'),
(60, 10, 20, 3, 4, 6, 2900, '2023-02-28 00:06:44'),
(61, 11, 39, 1, 1, 6, 1000, '2023-02-28 00:05:26'),
(62, 11, 39, 2, 1, 6, 2000, '2023-02-28 00:05:26'),
(63, 11, 39, 3, 1, 6, 2000, '2023-02-28 00:05:26'),
(64, 11, 39, 1, 2, 6, 1120, '2023-02-28 00:06:04'),
(65, 11, 39, 2, 2, 6, 1920, '2023-02-28 00:06:04'),
(66, 11, 39, 3, 2, 6, 1920, '2023-02-28 00:06:04'),
(67, 11, 39, 1, 3, 6, 1200, '2023-02-28 00:06:20'),
(68, 11, 39, 2, 3, 6, 1750, '2023-02-28 00:06:20'),
(69, 11, 39, 3, 3, 6, 1750, '2023-02-28 00:06:20'),
(70, 11, 39, 1, 4, 6, 1300, '2023-02-28 00:06:44'),
(71, 11, 39, 2, 4, 6, 1650, '2023-02-28 00:06:44'),
(72, 11, 39, 3, 4, 6, 1650, '2023-02-28 00:06:44'),
(73, 13, 190, 1, 1, 6, 500, '2023-02-28 00:05:26'),
(74, 13, 190, 2, 1, 6, 1000, '2023-02-28 00:05:26'),
(75, 13, 190, 3, 1, 6, 1000, '2023-02-28 00:05:26'),
(76, 13, 190, 1, 2, 6, 700, '2023-02-28 00:06:04'),
(77, 13, 190, 2, 2, 6, 900, '2023-02-28 00:06:04'),
(78, 13, 190, 3, 2, 6, 900, '2023-02-28 00:06:04'),
(79, 13, 190, 1, 3, 6, 800, '2023-02-28 00:06:20'),
(80, 13, 190, 2, 3, 6, 850, '2023-02-28 00:06:20'),
(81, 13, 190, 3, 3, 6, 850, '2023-02-28 00:06:20'),
(82, 13, 190, 1, 4, 6, 600, '2023-02-28 00:06:44'),
(83, 13, 190, 2, 4, 6, 950, '2023-02-28 00:06:44'),
(84, 13, 190, 3, 4, 6, 950, '2023-02-28 00:06:44'),
(85, 13, 75, 1, 1, 6, 450, '2023-02-28 00:05:26'),
(86, 13, 75, 2, 1, 6, 950, '2023-02-28 00:05:26'),
(87, 13, 75, 3, 1, 6, 950, '2023-02-28 00:05:26'),
(88, 13, 75, 1, 2, 6, 650, '2023-02-28 00:06:04'),
(89, 13, 75, 2, 2, 6, 850, '2023-02-28 00:06:04'),
(90, 13, 75, 3, 2, 6, 850, '2023-02-28 00:06:04'),
(91, 13, 75, 1, 3, 6, 700, '2023-02-28 00:06:20'),
(92, 13, 75, 2, 3, 6, 750, '2023-02-28 00:06:20'),
(93, 13, 75, 3, 3, 6, 750, '2023-02-28 00:06:20'),
(94, 13, 75, 1, 4, 6, 850, '2023-02-28 00:06:44'),
(95, 13, 75, 2, 4, 6, 960, '2023-02-28 00:06:44'),
(96, 13, 75, 3, 4, 6, 960, '2023-02-28 00:06:44');

-- --------------------------------------------------------

--
-- 資料表結構 `position`
--

CREATE TABLE `position` (
  `position_id` int(255) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `position`
--

INSERT INTO `position` (`position_id`, `position`) VALUES
(1, '試用期職員'),
(2, '職員'),
(3, '儲備幹部'),
(4, '副理'),
(5, '經理'),
(6, '協理'),
(7, '副總經理'),
(8, '總經理');

-- --------------------------------------------------------

--
-- 資料表結構 `shipping_company_fees`
--

CREATE TABLE `shipping_company_fees` (
  `shipping_company_fees_id` int(11) NOT NULL,
  `ocean_export_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `b_l` int(11) NOT NULL,
  `seal` int(11) NOT NULL,
  `telex_release` int(11) NOT NULL,
  `shipping_company_fees_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `shipping_company_fees_afr`
--

CREATE TABLE `shipping_company_fees_afr` (
  `shipping_company_fees_afr_id` int(11) NOT NULL,
  `shipping_company_fees_id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `afr` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `ocean_export_id` int(11) DEFAULT NULL,
  `shipping_company_fees_afr_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `shipping_company_fees_thc`
--

CREATE TABLE `shipping_company_fees_thc` (
  `shipping_company_fees_thc_id` int(11) NOT NULL,
  `shipping_company_fees_id` int(11) NOT NULL,
  `cabinet_volume_id` int(11) NOT NULL,
  `thc` int(11) NOT NULL,
  `shipping_company_fees_thc_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `staff_account_list`
--

CREATE TABLE `staff_account_list` (
  `staff_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `staff_account_list`
--

INSERT INTO `staff_account_list` (`staff_id`, `username`, `password`) VALUES
(1, 'peter', '$2y$10$G0NGUG9kj5w2rieb2D2Yv.H5X8yguaFVt72Ho8.6ZzKRZsks9lvE6');

-- --------------------------------------------------------

--
-- 資料表結構 `staff_list`
--

CREATE TABLE `staff_list` (
  `staff_id` int(255) NOT NULL,
  `cname` varchar(5) NOT NULL,
  `ename` varchar(10) NOT NULL,
  `elastname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `extension` int(3) NOT NULL,
  `position_id` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `staff_state_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `staff_list`
--

INSERT INTO `staff_list` (`staff_id`, `cname`, `ename`, `elastname`, `gender`, `email`, `extension`, `position_id`, `birthday`, `staff_state_id`, `create_time`) VALUES
(1, '章汶霖', 'Peter', 'Chang', 'male', 'peter@test.com', 127, 4, '1997-07-04', 1, '2022-04-20 06:11:22');

-- --------------------------------------------------------

--
-- 資料表結構 `staff_list_department`
--

CREATE TABLE `staff_list_department` (
  `staff_list_department_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `staff_list_department`
--

INSERT INTO `staff_list_department` (`staff_list_department_id`, `staff_id`, `department_id`) VALUES
(31, 1, 9);

-- --------------------------------------------------------

--
-- 資料表結構 `staff_state`
--

CREATE TABLE `staff_state` (
  `staff_state_id` int(255) NOT NULL,
  `state` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `staff_state`
--

INSERT INTO `staff_state` (`staff_state_id`, `state`) VALUES
(1, '在職'),
(2, '離職'),
(3, '留職停薪');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `city_id` (`city_id`);

--
-- 資料表索引 `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_order_id`);

--
-- 資料表索引 `cabinet_volume`
--
ALTER TABLE `cabinet_volume`
  ADD PRIMARY KEY (`cabinet_volume_id`),
  ADD KEY `cabinet_volume_id` (`cabinet_volume_id`);

--
-- 資料表索引 `cfs_ocean_price`
--
ALTER TABLE `cfs_ocean_price`
  ADD PRIMARY KEY (`cfs_ocean_price_id`);

--
-- 資料表索引 `cfs_quantity_unit`
--
ALTER TABLE `cfs_quantity_unit`
  ADD PRIMARY KEY (`cfs_quantity_unit_id`);

--
-- 資料表索引 `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city_id` (`city_id`,`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- 資料表索引 `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `company_id` (`company_id`);

--
-- 資料表索引 `company_fee_basis`
--
ALTER TABLE `company_fee_basis`
  ADD PRIMARY KEY (`company_fee_basis_id`);

--
-- 資料表索引 `company_fee_basis_thc`
--
ALTER TABLE `company_fee_basis_thc`
  ADD PRIMARY KEY (`company_fee_basis_thc_id`);

--
-- 資料表索引 `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`contact_information_id`);

--
-- 資料表索引 `contact_text_prohibited`
--
ALTER TABLE `contact_text_prohibited`
  ADD PRIMARY KEY (`contact_text_prohibited_id`);

--
-- 資料表索引 `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- 資料表索引 `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`customer_type_id`);

--
-- 資料表索引 `cut_off_place`
--
ALTER TABLE `cut_off_place`
  ADD PRIMARY KEY (`cut_off_place_id`),
  ADD KEY `cut_off_place_id` (`cut_off_place_id`,`city_id`),
  ADD KEY `city_id` (`city_id`);

--
-- 資料表索引 `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_id` (`department_id`);

--
-- 資料表索引 `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `destination_port_id` (`destination_port_id`,`destination_container_depot_id`),
  ADD KEY `destination_container_depot_id` (`destination_container_depot_id`);

--
-- 資料表索引 `destination_area`
--
ALTER TABLE `destination_area`
  ADD PRIMARY KEY (`destination_area_id`);

--
-- 資料表索引 `destination_city`
--
ALTER TABLE `destination_city`
  ADD PRIMARY KEY (`destination_city_id`),
  ADD KEY `destination_city_id` (`destination_city_id`,`city_id`),
  ADD KEY `city_id` (`city_id`);

--
-- 資料表索引 `destination_container_depot`
--
ALTER TABLE `destination_container_depot`
  ADD PRIMARY KEY (`destination_container_depot_id`),
  ADD KEY `destination_container_depot_id` (`destination_container_depot_id`,`destination_city_id`),
  ADD KEY `destination_city_id` (`destination_city_id`);

--
-- 資料表索引 `destination_port`
--
ALTER TABLE `destination_port`
  ADD PRIMARY KEY (`destination_port_id`),
  ADD KEY `destination_port_id` (`destination_port_id`,`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- 資料表索引 `dg_ocean_price`
--
ALTER TABLE `dg_ocean_price`
  ADD PRIMARY KEY (`dg_ocean_price_id`);

--
-- 資料表索引 `email_address_book`
--
ALTER TABLE `email_address_book`
  ADD PRIMARY KEY (`email_address_book_id`);

--
-- 資料表索引 `email_notification_message`
--
ALTER TABLE `email_notification_message`
  ADD PRIMARY KEY (`email_notification_message_id`);

--
-- 資料表索引 `ip_black_list`
--
ALTER TABLE `ip_black_list`
  ADD PRIMARY KEY (`ip_black_list_id`);

--
-- 資料表索引 `ip_log`
--
ALTER TABLE `ip_log`
  ADD PRIMARY KEY (`ip_id`),
  ADD KEY `member_id` (`member_id`,`ocean_export_id`,`destination_port_id`),
  ADD KEY `ocean_export_id` (`ocean_export_id`),
  ADD KEY `destination_port_id` (`destination_port_id`);

--
-- 資料表索引 `marquee`
--
ALTER TABLE `marquee`
  ADD PRIMARY KEY (`marquee_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `member_log`
--
ALTER TABLE `member_log`
  ADD PRIMARY KEY (`member_log_id`);

--
-- 資料表索引 `member_login_log`
--
ALTER TABLE `member_login_log`
  ADD PRIMARY KEY (`member_loging_log_id`);

--
-- 資料表索引 `ocean_export`
--
ALTER TABLE `ocean_export`
  ADD PRIMARY KEY (`ocean_export_id`),
  ADD KEY `ocean_export_id` (`ocean_export_id`);

--
-- 資料表索引 `ocean_export_date_deadline`
--
ALTER TABLE `ocean_export_date_deadline`
  ADD PRIMARY KEY (`ocean_export_date_deadline_id`);

--
-- 資料表索引 `ocean_export_price`
--
ALTER TABLE `ocean_export_price`
  ADD PRIMARY KEY (`ocean_export_price_id`),
  ADD KEY `ocean_export_id` (`ocean_export_id`,`destination_port_id`,`cabinet_volume_id`,`cut_off_place_id`,`company_id`),
  ADD KEY `destination_port_id` (`destination_port_id`),
  ADD KEY `cabinet_volume_id` (`cabinet_volume_id`),
  ADD KEY `cut_off_place_id` (`cut_off_place_id`),
  ADD KEY `company_id` (`company_id`);

--
-- 資料表索引 `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `position_id` (`position_id`);

--
-- 資料表索引 `shipping_company_fees`
--
ALTER TABLE `shipping_company_fees`
  ADD PRIMARY KEY (`shipping_company_fees_id`);

--
-- 資料表索引 `shipping_company_fees_afr`
--
ALTER TABLE `shipping_company_fees_afr`
  ADD PRIMARY KEY (`shipping_company_fees_afr_id`);

--
-- 資料表索引 `shipping_company_fees_thc`
--
ALTER TABLE `shipping_company_fees_thc`
  ADD PRIMARY KEY (`shipping_company_fees_thc_id`);

--
-- 資料表索引 `staff_account_list`
--
ALTER TABLE `staff_account_list`
  ADD PRIMARY KEY (`staff_id`);

--
-- 資料表索引 `staff_list`
--
ALTER TABLE `staff_list`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `staff_state_id` (`staff_state_id`);

--
-- 資料表索引 `staff_list_department`
--
ALTER TABLE `staff_list_department`
  ADD PRIMARY KEY (`staff_list_department_id`);

--
-- 資料表索引 `staff_state`
--
ALTER TABLE `staff_state`
  ADD PRIMARY KEY (`staff_state_id`),
  ADD KEY `staff_state_id` (`staff_state_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cabinet_volume`
--
ALTER TABLE `cabinet_volume`
  MODIFY `cabinet_volume_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cfs_ocean_price`
--
ALTER TABLE `cfs_ocean_price`
  MODIFY `cfs_ocean_price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cfs_quantity_unit`
--
ALTER TABLE `cfs_quantity_unit`
  MODIFY `cfs_quantity_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `company_fee_basis`
--
ALTER TABLE `company_fee_basis`
  MODIFY `company_fee_basis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `company_fee_basis_thc`
--
ALTER TABLE `company_fee_basis_thc`
  MODIFY `company_fee_basis_thc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `contact_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_text_prohibited`
--
ALTER TABLE `contact_text_prohibited`
  MODIFY `contact_text_prohibited_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `customer_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cut_off_place`
--
ALTER TABLE `cut_off_place`
  MODIFY `cut_off_place_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `destination`
--
ALTER TABLE `destination`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `destination_area`
--
ALTER TABLE `destination_area`
  MODIFY `destination_area_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `destination_city`
--
ALTER TABLE `destination_city`
  MODIFY `destination_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `destination_container_depot`
--
ALTER TABLE `destination_container_depot`
  MODIFY `destination_container_depot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `destination_port`
--
ALTER TABLE `destination_port`
  MODIFY `destination_port_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dg_ocean_price`
--
ALTER TABLE `dg_ocean_price`
  MODIFY `dg_ocean_price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `email_address_book`
--
ALTER TABLE `email_address_book`
  MODIFY `email_address_book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `email_notification_message`
--
ALTER TABLE `email_notification_message`
  MODIFY `email_notification_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ip_black_list`
--
ALTER TABLE `ip_black_list`
  MODIFY `ip_black_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ip_log`
--
ALTER TABLE `ip_log`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `marquee`
--
ALTER TABLE `marquee`
  MODIFY `marquee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_log`
--
ALTER TABLE `member_log`
  MODIFY `member_log_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_login_log`
--
ALTER TABLE `member_login_log`
  MODIFY `member_loging_log_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ocean_export`
--
ALTER TABLE `ocean_export`
  MODIFY `ocean_export_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ocean_export_date_deadline`
--
ALTER TABLE `ocean_export_date_deadline`
  MODIFY `ocean_export_date_deadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ocean_export_price`
--
ALTER TABLE `ocean_export_price`
  MODIFY `ocean_export_price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shipping_company_fees`
--
ALTER TABLE `shipping_company_fees`
  MODIFY `shipping_company_fees_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shipping_company_fees_afr`
--
ALTER TABLE `shipping_company_fees_afr`
  MODIFY `shipping_company_fees_afr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shipping_company_fees_thc`
--
ALTER TABLE `shipping_company_fees_thc`
  MODIFY `shipping_company_fees_thc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `staff_list`
--
ALTER TABLE `staff_list`
  MODIFY `staff_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `staff_list_department`
--
ALTER TABLE `staff_list_department`
  MODIFY `staff_list_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `staff_state`
--
ALTER TABLE `staff_state`
  MODIFY `staff_state_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- 資料表的限制式 `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- 資料表的限制式 `cut_off_place`
--
ALTER TABLE `cut_off_place`
  ADD CONSTRAINT `cut_off_place_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- 資料表的限制式 `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`destination_container_depot_id`) REFERENCES `destination_container_depot` (`destination_container_depot_id`),
  ADD CONSTRAINT `destination_ibfk_2` FOREIGN KEY (`destination_port_id`) REFERENCES `destination_port` (`destination_port_id`);

--
-- 資料表的限制式 `destination_city`
--
ALTER TABLE `destination_city`
  ADD CONSTRAINT `destination_city_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- 資料表的限制式 `destination_container_depot`
--
ALTER TABLE `destination_container_depot`
  ADD CONSTRAINT `destination_container_depot_ibfk_1` FOREIGN KEY (`destination_city_id`) REFERENCES `destination_city` (`destination_city_id`);

--
-- 資料表的限制式 `destination_port`
--
ALTER TABLE `destination_port`
  ADD CONSTRAINT `destination_port_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- 資料表的限制式 `ip_log`
--
ALTER TABLE `ip_log`
  ADD CONSTRAINT `ip_log_ibfk_1` FOREIGN KEY (`ocean_export_id`) REFERENCES `ocean_export` (`ocean_export_id`),
  ADD CONSTRAINT `ip_log_ibfk_2` FOREIGN KEY (`destination_port_id`) REFERENCES `destination_port` (`destination_port_id`),
  ADD CONSTRAINT `ip_log_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- 資料表的限制式 `ocean_export_price`
--
ALTER TABLE `ocean_export_price`
  ADD CONSTRAINT `ocean_export_price_ibfk_1` FOREIGN KEY (`ocean_export_id`) REFERENCES `ocean_export` (`ocean_export_id`),
  ADD CONSTRAINT `ocean_export_price_ibfk_2` FOREIGN KEY (`destination_port_id`) REFERENCES `destination_port` (`destination_port_id`),
  ADD CONSTRAINT `ocean_export_price_ibfk_3` FOREIGN KEY (`cabinet_volume_id`) REFERENCES `cabinet_volume` (`cabinet_volume_id`),
  ADD CONSTRAINT `ocean_export_price_ibfk_4` FOREIGN KEY (`cut_off_place_id`) REFERENCES `cut_off_place` (`cut_off_place_id`),
  ADD CONSTRAINT `ocean_export_price_ibfk_5` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`);

--
-- 資料表的限制式 `staff_list`
--
ALTER TABLE `staff_list`
  ADD CONSTRAINT `staff_list_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`),
  ADD CONSTRAINT `staff_list_ibfk_3` FOREIGN KEY (`staff_state_id`) REFERENCES `staff_state` (`staff_state_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
