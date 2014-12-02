-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Dez-2014 às 16:54
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisdma`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos_telefones`
--

CREATE TABLE IF NOT EXISTS `contatos_telefones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contato` int(11) NOT NULL,
  `tipo_fone` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `ramal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_contato` (`id_contato`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=719 ;

--
-- Extraindo dados da tabela `contatos_telefones`
--

INSERT INTO `contatos_telefones` (`id`, `id_contato`, `tipo_fone`, `telefone`, `ramal`) VALUES
(1, 198, 'Institucional', '(85)3105-1355', ''),
(2, 198, 'Celular', '(85)9927-5721', ''),
(3, 1, 'Geral', '(85)3236-0541', ''),
(4, 4, 'Geral', '(85)3105-1356', ''),
(5, 8, 'Geral', '(85)3452-4562', ''),
(6, 10, 'Geral', '(85)3452-4659', ''),
(7, 12, 'Geral', '(85)3105-1378', ''),
(8, 13, 'Geral', '(85)3131-7712', ''),
(9, 14, 'Geral', '(85)3131-7712', ''),
(10, 20, 'Geral', '(85)3253-1546', ''),
(11, 24, 'Geral', '(85)3244-1531', ''),
(12, 25, 'Geral', '(85)3433-2789', ''),
(13, 27, 'Geral', '(85)3488-5733', ''),
(14, 28, 'Geral', '(85)3488-5737', ''),
(15, 33, 'Geral', '(85)3105-1367', ''),
(16, 34, 'Geral', '(85)3452-6966', ''),
(17, 36, 'Geral', '(85)3276-7836', ''),
(18, 37, 'Geral', '(85)3276-7836', ''),
(19, 40, 'Geral', '(85)3251-7177', ''),
(20, 41, 'Geral', '(85)3268-3639', ''),
(21, 44, 'Geral', '(85)3105-1157', ''),
(22, 45, 'Geral', '(85)3452-3474', ''),
(23, 46, 'Geral', '(85)3105-1157', ''),
(24, 47, 'Geral', '(85)3452-3474', ''),
(25, 48, 'Geral', '(85)3452-4657', ''),
(26, 49, 'Geral', '(85)3452-6181', ''),
(27, 50, 'Geral', '(85)3452-6181', ''),
(28, 51, 'Geral', '(85)3452-6181', ''),
(29, 53, 'Geral', '(85)3452-3472', ''),
(30, 54, 'Geral', '(85)3433-3472', ''),
(31, 55, 'Geral', '(85)3452-3430', ''),
(32, 56, 'Geral', '(85)3433-3472', ''),
(33, 57, 'Geral', '(85)3433-3472', ''),
(34, 58, 'Geral', '(85)3433-3472', ''),
(35, 59, 'Geral', '(85)3452.3430', ''),
(36, 60, 'Geral', '(85)3433-3430', ''),
(37, 63, 'Geral', '(85)3452-3472', ''),
(38, 65, 'Geral', '(85)3452-2344', ''),
(39, 66, 'Geral', '(85)3254-5376', ''),
(40, 67, 'Geral', '(85)3452-5376', ''),
(41, 69, 'Geral', '(85)3105-1569', ''),
(42, 70, 'Geral', '(85)3452-2118', ''),
(43, 74, 'Geral', '(85)3105-1398', ''),
(44, 76, 'Geral', '(85)3452-2364', ''),
(45, 78, 'Geral', '(85)3105-1398', ''),
(46, 81, 'Geral', '(85)3105-1371', ''),
(47, 83, 'Geral', '(85)3105-1447', ''),
(48, 85, 'Geral', '(85)3452-1655', ''),
(49, 88, 'Geral', '(85)3252-3436', ''),
(50, 89, 'Geral', '(85)3452-7747', ''),
(51, 91, 'Geral', '(85)3433-3635', ''),
(52, 93, 'Geral', '(85)3452-7296', ''),
(53, 95, 'Geral', '(85)3105-1150', ''),
(54, 97, 'Geral', '(85)3452-3477', ''),
(55, 98, 'Geral', '(85)3452-3477', ''),
(56, 99, 'Geral', '(85)3452-3480', ''),
(57, 100, 'Geral', '(85)3452-3473', ''),
(58, 101, 'Geral', '(85)3452-3482', ''),
(59, 102, 'Geral', '(85)3452-6780', ''),
(60, 103, 'Geral', '(85)3452-6792', ''),
(61, 104, 'Geral', '(85)3433-9670', ''),
(62, 105, 'Geral', '(85)3433-9670', ''),
(63, 106, 'Geral', '(85)3433-9670', ''),
(64, 109, 'Geral', '(61)3426-9406', ''),
(65, 110, 'Geral', '(85)3452-4658', ''),
(66, 111, 'Geral', '(85)3105-1456', ''),
(67, 113, 'Geral', '(85)3105-1472', ''),
(68, 115, 'Geral', '(85)3253-3962', ''),
(69, 117, 'Geral', '(85)3391-5103', ''),
(70, 121, 'Geral', '(85)3452-9333', ''),
(71, 126, 'Geral', '(85)3105-1360', ''),
(72, 128, 'Geral', '(85)3105-1316', ''),
(73, 129, 'Geral', '(85)3105-1316', ''),
(74, 130, 'Geral', '(85)3105-1316', ''),
(75, 133, 'Geral', '(85)3452-1651', ''),
(76, 134, 'Geral', '(85)3452-7276', ''),
(77, 138, 'Geral', '(85)3105-1369', ''),
(78, 139, 'Geral', '(85)3105-1165', ''),
(79, 141, 'Geral', '(85)3105-1169', ''),
(80, 142, 'Geral', '(85)3105-1460', ''),
(81, 143, 'Geral', '(85)3105-1460', ''),
(82, 144, 'Geral', '(85)3105-1002', ''),
(83, 146, 'Geral', '(85)3105-1378', ''),
(84, 148, 'Geral', '(85)3452-6798', ''),
(85, 150, 'Geral', '(85)3105-1099', ''),
(86, 151, 'Geral', '(85)3105-1461', ''),
(87, 153, 'Geral', '(85)3105-1022', ''),
(88, 154, 'Geral', '(85)3105-1165', ''),
(89, 160, 'Geral', '(85)3488-3377', ''),
(90, 162, 'Geral', '(85)3455-9006', ''),
(91, 167, 'Geral', '(85)3253-1546', ''),
(92, 169, 'Geral', '(85)3467-6704', ''),
(93, 170, 'Geral', '(61)3426-9402', ''),
(94, 171, 'Geral', '(61)3041-9599', ''),
(95, 173, 'Geral', '(85)3101-3512', ''),
(96, 174, 'Geral', '(85)3101-3521', ''),
(97, 175, 'Geral', '(85)3101-3505', ''),
(98, 176, 'Geral', '(85)3105-3496', ''),
(99, 181, 'Geral', '(85)3253-2221', ''),
(100, 184, 'Geral', '(85)3105-1355', ''),
(101, 185, 'Geral', '(85)3105-1355', ''),
(102, 186, 'Geral', '(85)3105-1355', ''),
(103, 189, 'Geral', '(85)3105-1355', ''),
(104, 191, 'Geral', '(85)3105-1314', ''),
(105, 192, 'Geral', '(85)3105-1354', ''),
(106, 193, 'Geral', '(85)3105-1354', ''),
(107, 194, 'Geral', '(85)3105-1354', ''),
(108, 196, 'Geral', '(85)3105-1357', ''),
(109, 197, 'Geral', '(85)3105-1355', ''),
(110, 198, 'Geral', '(85)3105-1355', ''),
(111, 199, 'Geral', '(85)3105-1355', ''),
(112, 200, 'Geral', '(85)3105-1354', ''),
(113, 201, 'Geral', '(85)3105-1354', ''),
(114, 203, 'Geral', '(85)3105-1285', ''),
(115, 210, 'Geral', '(85)3195-2727', ''),
(116, 214, 'Geral', '(85)3105-1247', ''),
(117, 215, 'Geral', '(85)4009-5293', ''),
(118, 216, 'Geral', '(85)3433-3749', ''),
(119, 219, 'Geral', '(85)3455-2716', ''),
(120, 221, 'Geral', '(85)3105-1501', ''),
(121, 223, 'Geral', '(85)3226-9818', ''),
(122, 224, 'Geral', '(85)3226-9818', ''),
(123, 225, 'Geral', '(19)3246-0100', ''),
(124, 226, 'Geral', '(85)3246-0100', ''),
(125, 227, 'Geral', '(85)3234-5422', ''),
(126, 228, 'Geral', '(85)3265-2238', ''),
(127, 230, 'Geral', '(85)3265-5114', ''),
(128, 231, 'Geral', '(85)3452-6999', ''),
(129, 232, 'Geral', '(85)3105-1237', ''),
(130, 233, 'Geral', '(85)3105-1237', ''),
(131, 234, 'Geral', '(85)3452-7281', ''),
(132, 238, 'Geral', '(85)3452-1651', ''),
(133, 239, 'Geral', '(85)3287-4314', ''),
(134, 241, 'Geral', '(85)3452-2320', ''),
(135, 242, 'Geral', '(85)3272-4861', ''),
(136, 243, 'Geral', '(85)3261-6268', ''),
(137, 248, 'Geral', '(85)3452-7274', ''),
(138, 254, 'Geral', '(85)3254-5848', ''),
(139, 258, 'Geral', '(85)3105-2721', ''),
(140, 261, 'Geral', '(85)3452-6776', ''),
(141, 262, 'Geral', '(85)3452-6768', ''),
(142, 263, 'Geral', '(58)3452-6778', ''),
(143, 264, 'Geral', '(85)3105-1146', ''),
(144, 266, 'Geral', '(85)3105-1146', ''),
(145, 268, 'Geral', '(85)3101-6710', ''),
(146, 269, 'Geral', '(85)3101-3969', ''),
(147, 271, 'Geral', '(85)3101-3969', ''),
(148, 272, 'Geral', '(85)3101-9071', ''),
(149, 273, 'Geral', '(85)3101-9420', ''),
(150, 274, 'Geral', '(85)3452-5773', ''),
(151, 275, 'Geral', '(85)3452-3495', ''),
(152, 276, 'Geral', '(85)3452-3495', ''),
(153, 277, 'Geral', '(85)3105-1118', ''),
(154, 279, 'Geral', '(85)3105-1241', ''),
(155, 280, 'Geral', '(85)3452-3477', ''),
(156, 282, 'Geral', '(85)3105-2041', ''),
(157, 283, 'Geral', '(85)3105-1263', ''),
(158, 284, 'Geral', '(85)3105-1263', ''),
(159, 285, 'Geral', '(85)3105-1247', ''),
(160, 286, 'Geral', '(85)3105-1247', ''),
(161, 288, 'Geral', '(85)3105-1247', ''),
(162, 292, 'Geral', '(85)3105-1233', ''),
(163, 293, 'Geral', '(85)3218-6523', ''),
(164, 295, 'Geral', '(85)3452-3495', ''),
(165, 296, 'Geral', '(85)3131-2100', ''),
(166, 298, 'Geral', '(85)3105-1434', ''),
(167, 301, 'Geral', '(85)3105-1434', ''),
(168, 303, 'Geral', '(85)3105-1077', ''),
(169, 311, 'Geral', '(85)3105-1073', ''),
(170, 313, 'Geral', '(85)3105-1109', ''),
(171, 314, 'Geral', '(85)3452-5255', ''),
(172, 319, 'Geral', '(85)3433-3779', ''),
(173, 320, 'Geral', '(85)3433-3749', ''),
(174, 322, 'Geral', '(85)3433-4570', ''),
(175, 323, 'Geral', '(85)3433-1941', ''),
(176, 325, 'Geral', '(85)3101-4525', ''),
(177, 327, 'Geral', '(85)3433-3653', ''),
(178, 328, 'Geral', '(85)3433-3749', ''),
(179, 329, 'Geral', '(85)9956-0737', ''),
(180, 330, 'Geral', '(85)3433-4570', ''),
(181, 334, 'Geral', '(85)3433-3637', ''),
(182, 339, 'Geral', '(85)3101-2186', ''),
(183, 340, 'Geral', '(85)3433-3656', ''),
(184, 341, 'Geral', '(85)3433-3624', ''),
(185, 342, 'Geral', '(85)3433-36651', ''),
(186, 343, 'Geral', '(85)3433-3670', ''),
(187, 345, 'Geral', '(85)3433-2507', ''),
(188, 348, 'Geral', '(85)3488-3104', ''),
(189, 352, 'Geral', '(85)3433-6883', ''),
(190, 355, 'Geral', '(85)3241-4755', ''),
(191, 358, 'Geral', '(85)3105-1323', ''),
(192, 359, 'Geral', '(85)3433-6894', ''),
(193, 360, 'Geral', '(85)3433-6864', ''),
(194, 362, 'Geral', '(85)3241-4868', ''),
(195, 365, 'Geral', '(85)3433-2520', ''),
(196, 366, 'Geral', '(85)3433-2520', ''),
(197, 367, 'Geral', '(85)3433-2548', ''),
(198, 368, 'Geral', '(85)3433-2860', ''),
(199, 370, 'Geral', '(85)3433-2807', ''),
(200, 372, 'Geral', '(85)3433-2902', ''),
(201, 373, 'Geral', '(85)3488-3101', ''),
(202, 374, 'Geral', '(85)3452-1936', ''),
(203, 375, 'Geral', '(85)3242-3081', ''),
(204, 376, 'Geral', '(85)3252-3081', ''),
(205, 377, 'Geral', '(85)3281-8804', ''),
(206, 381, 'Geral', '(85)3281-8804', ''),
(207, 384, 'Geral', '(85)3281-2570', ''),
(208, 388, 'Geral', '(85)3105-3442', ''),
(209, 390, 'Geral', '(85)3105-3445', ''),
(210, 392, 'Geral', '(85)3105-3416', ''),
(211, 399, 'Geral', '(85)3459-5590', ''),
(212, 400, 'Geral', '(85)3459-5904', ''),
(213, 405, 'Geral', '(85)3454-5960', ''),
(214, 407, 'Geral', '(85)3454-5960', ''),
(215, 408, 'Geral', '(85)3459-6761', ''),
(216, 409, 'Geral', '(85)3433-3588', ''),
(217, 411, 'Geral', '(85)3459-5984', ''),
(218, 412, 'Geral', '(85)3459-5916', ''),
(219, 413, 'Geral', '(85)3459-5927', ''),
(220, 414, 'Geral', '(85)3452-6611', ''),
(221, 421, 'Geral', '(85)3452-6954', ''),
(222, 422, 'Geral', '(85)3452-2357', ''),
(223, 423, 'Geral', '(85)3452-2357', ''),
(224, 424, 'Geral', '(85)3452-6984', ''),
(225, 432, 'Geral', '(85)3452-3535', ''),
(226, 434, 'Geral', '(85)3255-5053', ''),
(227, 436, 'Geral', '(85)3255-5042', ''),
(228, 446, 'Geral', '(85)3101-6512', ''),
(229, 447, 'Geral', '(85)3101-6561', ''),
(230, 448, 'Geral', '(85)3101-6551', ''),
(231, 449, 'Geral', '(85)3101-6544', ''),
(232, 450, 'Geral', '(85)3101-6576', ''),
(233, 452, 'Geral', '(85)3105-1450', ''),
(234, 453, 'Geral', '(85)3452-1987', ''),
(235, 454, 'Geral', '(85)3105-1457', ''),
(236, 455, 'Geral', '(85)3452-1653', ''),
(237, 456, 'Geral', '(85)3452-1652', ''),
(238, 457, 'Geral', '(85)4009-5290', ''),
(239, 458, 'Geral', '(85)4009-5290', ''),
(240, 459, 'Geral', '(85)4009-5290', ''),
(241, 460, 'Geral', '(85)4009-5291', ''),
(242, 461, 'Geral', '(85)4009-5292', ''),
(243, 7, 'Geral', '(85)3466-4880', ''),
(244, 11, 'Geral', '(85)3105-1446', ''),
(245, 30, 'Geral', '(85)3433-9717', ''),
(246, 32, 'Geral', '(85)3433-9734', ''),
(247, 42, 'Geral', '(85)3105-1441', ''),
(248, 61, 'Geral', '(85)3452-3430', ''),
(249, 73, 'Geral', '(85)3452-5373', ''),
(250, 75, 'Geral', '(85)3281-7132', ''),
(251, 77, 'Geral', '(85)3452-2349', ''),
(252, 79, 'Geral', '(85)3105-1448', ''),
(253, 80, 'Geral', '(85)3105-1364', ''),
(254, 82, 'Geral', '(85)3105-1371', ''),
(255, 84, 'Geral', '(85)3105-1442', ''),
(256, 92, 'Geral', '(85)3452-7296', ''),
(257, 96, 'Geral', '(85)3252-1630', ''),
(258, 112, 'Geral', '(85)3105-1456', ''),
(259, 114, 'Geral', '(85)3281-7132', ''),
(260, 118, 'Geral', '(85)3131-7619', ''),
(261, 123, 'Geral', '(85)3452-9299', ''),
(262, 124, 'Geral', '(85)3452-9322', ''),
(263, 125, 'Geral', '(85)3433-3742', ''),
(264, 131, 'Geral', '(85)3452-1651', ''),
(265, 132, 'Geral', '(85)3452-1651', ''),
(266, 136, 'Geral', '(85)3105-1373', ''),
(267, 137, 'Geral', '(85)3105-1369', ''),
(268, 145, 'Geral', '(85)3105-1366', ''),
(269, 147, 'Geral', '(85)3105-1378', ''),
(270, 156, 'Geral', '(85)3281-8804', ''),
(271, 159, 'Geral', '(85)3488-3377', ''),
(272, 166, 'Geral', '(85)3255-5205', ''),
(273, 168, 'Geral', '(85)3243-2960', ''),
(274, 177, 'Geral', '(85)3101-3523', ''),
(275, 179, 'Geral', '(85)3256-7044', ''),
(276, 180, 'Geral', '(85)3256-7044', ''),
(277, 182, 'Geral', '(85)3105-1355', ''),
(278, 187, 'Geral', '(85)3105-1355', ''),
(279, 204, 'Geral', '(85)3105-1393', ''),
(280, 205, 'Geral', '(85)3256-7044', ''),
(281, 206, 'Geral', '(85)3252-1797', ''),
(282, 218, 'Geral', '(85)3455-2702', ''),
(283, 229, 'Geral', '(85)3265-5114', ''),
(284, 236, 'Geral', '(85)3105-1136', ''),
(285, 237, 'Geral', '(85)3105-1188', ''),
(286, 244, 'Geral', '(85)3452-7275', ''),
(287, 252, 'Geral', '(85)3105-1573', ''),
(288, 255, 'Geral', '(85)3105-1309', ''),
(289, 257, 'Geral', '(85)3105-1350', ''),
(290, 259, 'Geral', '(85)3105-2710', ''),
(291, 267, 'Geral', '(85)3105-1294', ''),
(292, 270, 'Geral', '(85)3101-3963', ''),
(293, 299, 'Geral', '(85)3105-1438', ''),
(294, 302, 'Geral', '(85)3105-1440', ''),
(295, 305, 'Geral', '(85)3105-1080 ', ''),
(296, 306, 'Geral', '(85)3105-1082', ''),
(297, 310, 'Geral', '(85)3105-1079', ''),
(298, 317, 'Geral', '(85)3101-4457', ''),
(299, 318, 'Geral', '(85)3272-5053', ''),
(300, 321, 'Geral', '(85)3433-4728', ''),
(301, 335, 'Geral', '(85)3433-3644', ''),
(302, 349, 'Geral', '(85)3433-2917', ''),
(303, 351, 'Geral', '(85)3232-6021', ''),
(304, 353, 'Geral', '(85)3433-2918', ''),
(305, 354, 'Geral', '(85)3488-3116', ''),
(306, 379, 'Geral', '(85)3281-8151', ''),
(307, 385, 'Geral', '(85)3105-1514', ''),
(308, 386, 'Geral', '(85)3105-1513', ''),
(309, 394, 'Geral', '(85)3105-3708', ''),
(310, 395, 'Geral', '(85)3105-3440', ''),
(311, 397, 'Geral', '(85)3253-3911', ''),
(312, 398, 'Geral', '(85)3452-6901', ''),
(313, 403, 'Geral', '(85)3459-5933', ''),
(314, 404, 'Geral', '(85)3454-5960', ''),
(315, 417, 'Geral', '(85)3452-6992', ''),
(316, 418, 'Geral', '(85)3452-6992', ''),
(317, 419, 'Geral', '(85)3452-6992', ''),
(318, 426, 'Geral', '(85)3452-6600', ''),
(319, 443, 'Geral', '(85)3452-6605', ''),
(320, 7, 'Geral', '(85)3466-4881', ''),
(321, 11, 'Geral', '(85)3105-1447', ''),
(322, 30, 'Geral', '(85)3433-9734', ''),
(323, 32, 'Geral', '(85)3433-9732', ''),
(324, 42, 'Geral', '(85)3105-1446', ''),
(325, 61, 'Geral', '(85)3452-3472', ''),
(326, 73, 'Geral', '(85)3452-5371', ''),
(327, 75, 'Geral', '(85)3281-6229', ''),
(328, 77, 'Geral', '(85)3452-2345', ''),
(329, 79, 'Geral', '(85)3452-7299', ''),
(330, 80, 'Geral', '(85)3105-1365', ''),
(331, 80, 'Geral', '(85)3105-1366', ''),
(332, 82, 'Geral', '(85)3105-1013', ''),
(333, 84, 'Geral', '(85)3105-1446', ''),
(334, 92, 'Geral', '(85)3452-7283', ''),
(335, 96, 'Geral', '(85)3452-3477', ''),
(336, 112, 'Geral', '(85)3105-1472', ''),
(337, 114, 'Geral', '(85)3281-6229', ''),
(338, 118, 'Geral', '(85)3131-7604', ''),
(339, 123, 'Geral', '(85)3452-9322', ''),
(340, 123, 'Geral', '(85)3452-9252', ''),
(341, 124, 'Geral', '(85)3452-9252', ''),
(342, 124, 'Geral', '(85)3452-9205', ''),
(343, 125, 'Geral', '(85)3433-3748', ''),
(344, 131, 'Geral', '(85)3452-2116', ''),
(345, 131, 'Geral', '(85)3452-2112', ''),
(346, 132, 'Geral', '(85)3452-1656', ''),
(347, 136, 'Geral', '(85)3105-1374', ''),
(348, 137, 'Geral', '(85)3105-1369', ''),
(349, 145, 'Geral', '(85)3105-1365', ''),
(350, 147, 'Geral', '(85)3105-1167', ''),
(351, 156, 'Geral', '(85)3281-8151', ''),
(352, 159, 'Geral', '(85)3488-3376', ''),
(353, 166, 'Geral', '(85)3255-5206', ''),
(354, 166, 'Geral', '(85)3255-3255', ''),
(355, 168, 'Geral', '(85)3243-2961', ''),
(356, 177, 'Geral', '(85)3101-3518', ''),
(357, 179, 'Geral', '(85)3256-2390', ''),
(358, 180, 'Geral', '(85)3256-2390', ''),
(359, 182, 'Geral', '(85)3232-0645', ''),
(360, 187, 'Geral', '(85)3105-1355', ''),
(361, 204, 'Geral', '(85)3252-1797', ''),
(362, 204, 'Geral', '(85)3252-1776', ''),
(363, 205, 'Geral', '(85)3256-2390', ''),
(364, 206, 'Geral', '(85)3252-1776', ''),
(365, 218, 'Geral', '(85)3455-2700', ''),
(366, 229, 'Geral', '(85)3265-5977', ''),
(367, 236, 'Geral', '(85)3105-1296', ''),
(368, 237, 'Geral', '(85)3105-1296', ''),
(369, 237, 'Geral', '(85)3105-1136', ''),
(370, 244, 'Geral', '(85)3261-6268', ''),
(371, 252, 'Geral', '(85)3105-1574', ''),
(372, 255, 'Geral', '(85)3254-5848', ''),
(373, 257, 'Geral', '(85)3105-1309', ''),
(374, 259, 'Geral', '(85)3105-2711', ''),
(375, 267, 'Geral', '(85)3105-1146', ''),
(376, 270, 'Geral', '(85)3101-3969', ''),
(377, 299, 'Geral', '(85)3105-1437', ''),
(378, 302, 'Geral', '(85)3105-1434', ''),
(379, 305, 'Geral', '(85)3105-1079', ''),
(380, 306, 'Geral', '(85)3105-1089', ''),
(381, 310, 'Geral', '(85)3105-1089', ''),
(382, 310, 'Geral', '(85)3105-1080', ''),
(383, 317, 'Geral', '(85)3101-4427', ''),
(384, 318, 'Geral', '(85)3433-3644', ''),
(385, 321, 'Geral', '(85)3433-1941', ''),
(386, 335, 'Geral', '(85)3433-3637', ''),
(387, 349, 'Geral', '(85)3433-2916', ''),
(388, 349, 'Geral', '(85)3433-2919', ''),
(389, 349, 'Geral', '(85)3433-7285', ''),
(390, 351, 'Geral', '(85)3433-2802', ''),
(391, 353, 'Geral', '(85)3433-2916', ''),
(392, 353, 'Geral', '(85)3433-2916', ''),
(393, 353, 'Geral', '(85)3433-2919', ''),
(394, 354, 'Geral', '(85)3488-3170', ''),
(395, 379, 'Geral', '(85)3281-8804', ''),
(396, 385, 'Geral', '(85)3105-1535', ''),
(397, 386, 'Geral', '(85)3105-1514', ''),
(398, 394, 'Geral', '(85)3105-3711', ''),
(399, 395, 'Geral', '(85)3105-3708', ''),
(400, 395, 'Geral', '(85)3105-3445', ''),
(401, 395, 'Geral', '(85)3105-3711', ''),
(402, 397, 'Geral', '(85)3452-6901', ''),
(403, 397, 'Geral', '(85)3452-6903', ''),
(404, 398, 'Geral', '(85)3452-6903', ''),
(405, 403, 'Geral', '(85)5993-5941', ''),
(406, 404, 'Geral', '(85)3454-5993', ''),
(407, 404, 'Geral', '(85)3454-5941', ''),
(408, 417, 'Geral', '(85)3452-6604', ''),
(409, 417, 'Geral', '(85)3452-6605', ''),
(410, 418, 'Geral', '(85)3452-6604', ''),
(411, 418, 'Geral', '(85)3452-6605', ''),
(412, 419, 'Geral', '(85)3452-6604', ''),
(413, 419, 'Geral', '(85)3452-6605', ''),
(414, 419, 'Geral', '(85)3452-6611', ''),
(415, 426, 'Geral', '(85)3452-6602', ''),
(416, 443, 'Geral', '(85)3452-6604', ''),
(417, 443, 'Geral', '(85)3452-1786', ''),
(418, 281, 'Geral', '(85)3105-1239', ''),
(419, 315, 'Geral', '(85)3452-6903', ''),
(420, 347, 'Geral', '(85)3433-6856', ''),
(421, 35, 'Geral', '(85)3216-7967', ''),
(422, 35, 'Geral', '(85)3216-7976', ''),
(423, 64, 'Geral', '(85)3452-6773', ''),
(424, 64, 'Geral', '(85)3452-6777', ''),
(425, 165, 'Geral', '(85)3255-5180', ''),
(426, 165, 'Geral', '(85)3255-5081 ', ''),
(427, 213, 'Geral', '(85)3305-4747', ''),
(428, 213, 'Geral', '(85)3305-4749', ''),
(429, 240, 'Geral', '(85)3488-9248', ''),
(430, 240, 'Geral', '(85)3105-1355', ''),
(431, 253, 'Geral', '(85)3452-2320', ''),
(432, 256, 'Geral', '(85)3105-1309', ''),
(433, 265, 'Geral', '(85)3105-1146', ''),
(434, 287, 'Geral', '(85)3452-3495', ''),
(435, 287, 'Geral', '(85)3105-1240', ''),
(436, 316, 'Geral', '(85)3105-3711', ''),
(437, 324, 'Geral', '(85)3433-3644 ', ''),
(438, 326, 'Geral', '(85)3433-3644 ', ''),
(439, 331, 'Geral', '(85)3252-4833', ''),
(440, 331, 'Geral', '(85)3101-2186', ''),
(441, 346, 'Geral', '(85)3433 -6883', ''),
(442, 378, 'Geral', '(85)3281-8151', ''),
(443, 420, 'Geral', '(85)3452-2357', ''),
(444, 420, 'Geral', '(85)3105-1493', ''),
(445, 444, 'Geral', '(85)3488-6966', ''),
(446, 444, 'Geral', '(85)3488-6973', ''),
(447, 1, 'Celular', '(85)9981-7163', ''),
(448, 2, 'Celular', '(85)8821-5525', ''),
(449, 4, 'Celular', '(85)8970-4549', ''),
(450, 5, 'Celular', '(85)9984-0577', ''),
(451, 8, 'Celular', '(85)8895-5682', ''),
(452, 15, 'Celular', '(85)9991-9718', ''),
(453, 16, 'Celular', '(85)8730-2148', ''),
(454, 17, 'Celular', '(85)9197-3602', ''),
(455, 18, 'Celular', '(85)8886-5132', ''),
(456, 19, 'Celular', '(85)9998-9893', ''),
(457, 19, 'Celular', '(85)8833-0682', ''),
(458, 23, 'Celular', '(85)9181-3223', ''),
(459, 24, 'Celular', '(85)9693-5300', ''),
(460, 24, 'Celular', '(85)9693-5300', ''),
(461, 26, 'Celular', '(85)9900-2688', ''),
(462, 35, 'Celular', '(85)9603-8001', ''),
(463, 36, 'Celular', '(85)8802-8529', ''),
(464, 37, 'Celular', '(85)8703-7831', ''),
(465, 38, 'Celular', '(85)8916-4876', ''),
(466, 39, 'Celular', '(85)8772-1419', ''),
(467, 40, 'Celular', '(85)8838-4420', ''),
(468, 43, 'Celular', '(85)9206-3297', ''),
(469, 44, 'Celular', '(85)9175-3703', ''),
(470, 45, 'Celular', '(85)9749-0401', ''),
(471, 46, 'Celular', '(85)3105-1157', ''),
(472, 47, 'Celular', '(85)9932-3876', ''),
(473, 48, 'Celular', '(85)8868-7070', ''),
(474, 49, 'Celular', '(85)8970-4864', ''),
(475, 50, 'Celular', '(85)9997-8951', ''),
(476, 52, 'Celular', '(85)9994-5287', ''),
(477, 53, 'Celular', '(85)8898-5353', ''),
(478, 54, 'Celular', '(85)8970-3033', ''),
(479, 55, 'Celular', '(85)8970-6139', ''),
(480, 56, 'Celular', '(85)8970-4071', ''),
(481, 56, 'Celular', '(85)9996-3221', ''),
(482, 57, 'Celular', '(85)8687-2577', ''),
(483, 58, 'Celular', '(85)9725-1730', ''),
(484, 59, 'Celular', '(85)8970-3494', ''),
(485, 60, 'Celular', '(85)8630-3442', ''),
(486, 62, 'Celular', '(85)8970-3726', ''),
(487, 64, 'Celular', '(85)9813-2814', ''),
(488, 66, 'Celular', '(85)8819-1153', ''),
(489, 67, 'Celular', '(85)8965-4460', ''),
(490, 71, 'Celular', '(85)8840-7777', ''),
(491, 86, 'Celular', '(85)8970-3031', ''),
(492, 87, 'Celular', '(85)8808-1158', ''),
(493, 90, 'Celular', '(85)8794-1119', ''),
(494, 91, 'Celular', '(85)8888-0103', ''),
(495, 95, 'Celular', '(85)8890-9945', ''),
(496, 100, 'Celular', '(85)8657-4243', ''),
(497, 103, 'Celular', '(85)8818-5791', ''),
(498, 109, 'Celular', '(61)9276-8364', ''),
(499, 110, 'Celular', '(85)8868-7070', ''),
(500, 114, 'Celular', '(85)8713-4300', ''),
(501, 133, 'Celular', '(85)8543-5484', ''),
(502, 134, 'Celular', '(85)8768-8997', ''),
(503, 135, 'Celular', '(85)8890-9944', ''),
(504, 140, 'Celular', '(85)8710-7196', ''),
(505, 140, 'Celular', '(85)8863-4308', ''),
(506, 140, 'Celular', '(85)9764-9333', ''),
(507, 152, 'Celular', '(85)8888-2601', ''),
(508, 154, 'Celular', '(85)8788-1927', ''),
(509, 157, 'Celular', '(85)8867-9277', ''),
(510, 158, 'Celular', '(85)8879-7623', ''),
(511, 161, 'Celular', '(85)8105-8070', ''),
(512, 162, 'Celular', '(85)8102-2854', ''),
(513, 163, 'Celular', '(85)9970-3890', ''),
(514, 163, 'Celular', '(85)8162-7874', ''),
(515, 164, 'Celular', '(85)8150-8070', ''),
(516, 165, 'Celular', '(85)9996-4447', ''),
(517, 167, 'Celular', '(85)8728-0863', ''),
(518, 170, 'Celular', '(61)8406-8667', ''),
(519, 171, 'Celular', '(61)9929-9701', ''),
(520, 172, 'Celular', '(61)9943-5472', ''),
(521, 172, 'Celular', '(61)9233-5472', ''),
(522, 172, 'Celular', '(85)8203-6161', ''),
(523, 178, 'Celular', '(85)9624-4608', ''),
(524, 181, 'Celular', '(85)9983-2400', ''),
(525, 181, 'Celular', '(85)8814-1229', ''),
(526, 182, 'Celular', '(85)9627-8697', ''),
(527, 184, 'Celular', '(85)9998-9438', ''),
(528, 185, 'Celular', '(85)9635-3556', ''),
(529, 186, 'Celular', '(85)9621-7016', ''),
(530, 187, 'Celular', '(85)8815-1976', ''),
(531, 188, 'Celular', '(85)8811-3338', ''),
(532, 189, 'Celular', '(85)8970-4354', ''),
(533, 191, 'Celular', '(85)9938-8369', ''),
(534, 194, 'Celular', '(85)9799-9991', ''),
(535, 194, 'Celular', '(85)9766-3119', ''),
(536, 195, 'Celular', '(85)9136-9382', ''),
(537, 195, 'Celular', '(85)8970-4618', ''),
(538, 196, 'Celular', '(85)8970-3818', ''),
(539, 197, 'Celular', '(85)9748-7345', ''),
(540, 198, 'Celular', '(85)9927-5721', ''),
(541, 199, 'Celular', '(85)8741-7219', ''),
(542, 199, 'Celular', '(85)9901-9793', ''),
(543, 201, 'Celular', '(85)8805-7378', ''),
(544, 201, 'Celular', '(85)8970-4619', ''),
(545, 202, 'Celular', '(85)8897-0581', ''),
(546, 207, 'Celular', '(85)8619-0958', ''),
(547, 207, 'Celular', '(85)9939-6881', ''),
(548, 208, 'Celular', '(85)8970-7740', ''),
(549, 208, 'Celular', '(85)8970-7780', ''),
(550, 209, 'Celular', '(85)8970-4074', ''),
(551, 209, 'Celular', '(85)8680-5901', ''),
(552, 211, 'Celular', '(85)8970-1892', ''),
(553, 212, 'Celular', '(85)8628-6016', ''),
(554, 213, 'Celular', '(85)9982-3893', ''),
(555, 215, 'Celular', '(85)8122-1100', ''),
(556, 216, 'Celular', '(85)8970-3492', ''),
(557, 217, 'Celular', '(85)8675-0182', ''),
(558, 218, 'Celular', '(85)8802-0175', ''),
(559, 219, 'Celular', '(85)8804-0876', ''),
(560, 220, 'Celular', '(85)8906-5957', ''),
(561, 220, 'Celular', '(85)9950-4273', ''),
(562, 222, 'Celular', '(85)8664-9574', ''),
(563, 222, 'Celular', '(85)9993-0222', ''),
(564, 223, 'Celular', '(85)8820-9278', ''),
(565, 223, 'Celular', '(19)99766-2513', ''),
(566, 224, 'Celular', '(19)9619-2051', ''),
(567, 224, 'Celular', '(85)9669-7302', ''),
(568, 225, 'Celular', '(19)99604-8446', ''),
(569, 231, 'Celular', '(85)8657-2291', ''),
(570, 232, 'Celular', '(85)8843-2409', ''),
(571, 235, 'Celular', '(85)9989-5091', ''),
(572, 242, 'Celular', '(85)8519-1386', ''),
(573, 242, 'Celular', '(85)8970-4079', ''),
(574, 245, 'Celular', '(85)8970-4079', ''),
(575, 246, 'Celular', '(85)8897-7182', ''),
(576, 247, 'Celular', '(85)9996-1805', ''),
(577, 247, 'Celular', '(85)8708-3004', ''),
(578, 248, 'Celular', '(85)8898-3494', ''),
(579, 249, 'Celular', '(85)8970-2062', ''),
(580, 249, 'Celular', '(85)9992-7295', ''),
(581, 251, 'Celular', '(85)8501-6618', ''),
(582, 253, 'Celular', '(85)8970-2222', ''),
(583, 256, 'Celular', '(85)8898-9922', ''),
(584, 259, 'Celular', '(85)9707-0033', ''),
(585, 260, 'Celular', '(85)8814-8208', ''),
(586, 263, 'Celular', '(85)8970-6144', ''),
(587, 265, 'Celular', '(85)8970-4530', ''),
(588, 265, 'Celular', '(85)9994-1963', ''),
(589, 266, 'Celular', '(85)8970-2020', ''),
(590, 274, 'Celular', '(85)8757-5057', ''),
(591, 276, 'Celular', '(85)9718-4400', ''),
(592, 277, 'Celular', '(85)8888-8669', ''),
(593, 280, 'Celular', '(85)9133-9580', ''),
(594, 281, 'Celular', '(85)8970-2892', ''),
(595, 287, 'Celular', '(85)9164-2994', ''),
(596, 289, 'Celular', '(85)9954-0186', ''),
(597, 289, 'Celular', '(85)3105-1267', ''),
(598, 290, 'Celular', '(85)3452-3495', ''),
(599, 291, 'Celular', '(85)9760-5069', ''),
(600, 292, 'Celular', '(85)9920-5555', ''),
(601, 292, 'Celular', '(85)8888-0076', ''),
(602, 293, 'Celular', '(85)9936-6587', ''),
(603, 294, 'Celular', '(85)9902-1532', ''),
(604, 295, 'Celular', '(85)8879-9097', ''),
(605, 297, 'Celular', '(85)8970-6138', ''),
(606, 297, 'Celular', '(85)8671-4000', ''),
(607, 300, 'Celular', '(85)8970-3039', ''),
(608, 304, 'Celular', '(85)8878-7781', ''),
(609, 307, 'Celular', '(85)9679-6000', ''),
(610, 308, 'Celular', '(85)9679-6000', ''),
(611, 309, 'Celular', '(85)8970-2956', ''),
(612, 312, 'Celular', '(85)9925-2332', ''),
(613, 313, 'Celular', '(85)9994-1200', ''),
(614, 314, 'Celular', '(85)8970-3804', ''),
(615, 315, 'Celular', '(85)8970-2424', ''),
(616, 316, 'Celular', '(85)8970-3032', ''),
(617, 319, 'Celular', '(85)8956-3779', ''),
(618, 321, 'Celular', '(85)8970-4060', ''),
(619, 321, 'Celular', '(85)8606-9677', ''),
(620, 323, 'Celular', '(85)8754-9950', ''),
(621, 326, 'Celular', '(85)8970-3033', ''),
(622, 330, 'Celular', '(85)8802-9144', ''),
(623, 332, 'Celular', '(85)8614-0440', ''),
(624, 333, 'Celular', '(85)8807-8003', ''),
(625, 333, 'Celular', '(85)9612-5917', ''),
(626, 336, 'Celular', '(85)8868-9784', ''),
(627, 337, 'Celular', '(85)8890-9943', ''),
(628, 338, 'Celular', '(85)8678-8115', ''),
(629, 339, 'Celular', '(85)8563-3726', ''),
(630, 340, 'Celular', '(85)8899-8084', ''),
(631, 342, 'Celular', '(85)8850-2154', ''),
(632, 343, 'Celular', '(85)8898-9747', ''),
(633, 344, 'Celular', '(85)8814-3430', ''),
(634, 346, 'Celular', '(85)8970-3024', ''),
(635, 347, 'Celular', '(85)8970-3025', ''),
(636, 350, 'Celular', '(85)8970-3019', ''),
(637, 357, 'Celular', '(85)8682-2164', ''),
(638, 358, 'Celular', '(85)8697-3100', ''),
(639, 359, 'Celular', '(85)8898-4499', ''),
(640, 360, 'Celular', '(85)9924-8901', ''),
(641, 361, 'Celular', '(85)8970-2068', ''),
(642, 361, 'Celular', '(85)9614-9038', ''),
(643, 362, 'Celular', '(85)8723-0810', ''),
(644, 363, 'Celular', '(85)9624-3512', ''),
(645, 364, 'Celular', '(85)8970-2065', ''),
(646, 365, 'Celular', '(85)9997-3143', ''),
(647, 366, 'Celular', '(85)8689-2878', ''),
(648, 367, 'Celular', '(85)9983-9755', ''),
(649, 369, 'Celular', '(85)9723-3068', ''),
(650, 370, 'Celular', '(85)8814-8058', ''),
(651, 371, 'Celular', '(85)9905-7591', ''),
(652, 372, 'Celular', '(85)8570-2709', ''),
(653, 373, 'Celular', '(85)8591-2150', ''),
(654, 374, 'Celular', '(85)8603-1020', ''),
(655, 374, 'Celular', '(85)8970-3486', ''),
(656, 377, 'Celular', '(85)8865-2007', ''),
(657, 378, 'Celular', '(85)8531-9363', ''),
(658, 382, 'Celular', '(85)8750-3556', ''),
(659, 384, 'Celular', '(85)8869-0679', ''),
(660, 387, 'Celular', '(85)8715-1197', ''),
(661, 388, 'Celular', '(85)8970-3506', ''),
(662, 389, 'Celular', '(85)8600-6059', ''),
(663, 390, 'Celular', '(85)8203-1510', ''),
(664, 391, 'Celular', '(85)9630-9342', ''),
(665, 391, 'Celular', '(85)8970-4614', ''),
(666, 392, 'Celular', '(85)8600-6059', ''),
(667, 393, 'Celular', '(85)8970-3548', ''),
(668, 396, 'Celular', '(85)8847-1120', ''),
(669, 402, 'Celular', '(85)8943-6146', ''),
(670, 402, 'Celular', '(85)8732-1286', ''),
(671, 402, 'Celular', '(85)9717-2632', ''),
(672, 404, 'Celular', '(85)8970-2045', ''),
(673, 405, 'Celular', '(85)8834-6934', ''),
(674, 407, 'Celular', '(85)8723-3280', ''),
(675, 408, 'Celular', '(85)9955-9120', ''),
(676, 409, 'Celular', '(85)8543-4787', ''),
(677, 411, 'Celular', '(85)8970 -2102', ''),
(678, 415, 'Celular', '(85)8970-3273', ''),
(679, 415, 'Celular', '(85)8970-3273', ''),
(680, 416, 'Celular', '(85)8690-7644', ''),
(681, 418, 'Celular', '(85)9989-8421', ''),
(682, 419, 'Celular', '(85)8807-8123', ''),
(683, 421, 'Celular', '(85)8623-4245', ''),
(684, 422, 'Celular', '(85)9925-9506', ''),
(685, 424, 'Celular', '(85)8970-4627', ''),
(686, 425, 'Celular', '(85)8699-7339', ''),
(687, 425, 'Celular', '(85)8970-3556', ''),
(688, 426, 'Celular', '(85)8859-5407', ''),
(689, 427, 'Celular', '(85)8864-6196', ''),
(690, 428, 'Celular', '(85)9969-7349', ''),
(691, 429, 'Celular', '(85)8844-1600', ''),
(692, 430, 'Celular', '(85)8800-5420', ''),
(693, 431, 'Celular', '(85)8970-4074', ''),
(694, 431, 'Celular', '(85)8680-5901', ''),
(695, 432, 'Celular', '(85)8822-7212', ''),
(696, 433, 'Celular', '(85)8563-2627', ''),
(697, 434, 'Celular', '(85)9611-9133', ''),
(698, 435, 'Celular', '(85)8789-1889', ''),
(699, 436, 'Celular', '(85)9954-1964', ''),
(700, 437, 'Celular', '(85)8906-2139', ''),
(701, 438, 'Celular', '(85)8771-7325', ''),
(702, 439, 'Celular', '(85)8588-8486', ''),
(703, 439, 'Celular', '(85)9731-7329', ''),
(704, 440, 'Celular', '(85)8537-0739', ''),
(705, 441, 'Celular', '(85)8652-8052', ''),
(706, 442, 'Celular', '(85)8827-2903', ''),
(707, 444, 'Celular', '(85)8827-2903', ''),
(708, 445, 'Celular', '(85)8841-0332', ''),
(709, 445, 'Celular', '(85)8749-0118', ''),
(710, 447, 'Celular', '(85)8841-0332', ''),
(711, 451, 'Celular', '(21)982588285', ''),
(712, 457, 'Celular', '(85)9728-8889', ''),
(713, 458, 'Celular', '(85)9728-8889', ''),
(714, 459, 'Celular', '(85)9728-9394', ''),
(715, 460, 'Celular', '(85)9986-8522', ''),
(716, 461, 'Celular', '(85)9943-2839', ''),
(717, 463, 'Celular', '(85)9998-9438', ''),
(718, 464, 'Celular', '(85)9757-6981', '');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contatos_telefones`
--
ALTER TABLE `contatos_telefones`
  ADD CONSTRAINT `contatos_telefones_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contatos` (`idcontatos`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
