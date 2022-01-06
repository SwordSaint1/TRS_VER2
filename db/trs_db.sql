-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 10:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `trs_accounts`
--

CREATE TABLE `trs_accounts` (
  `id` int(255) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `esection` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trs_accounts`
--

INSERT INTO `trs_accounts` (`id`, `full_name`, `username`, `password`, `role`, `esection`, `date_created`) VALUES
(1, 'jj', 'jj_qualif', 'admin', 'qualificator', 'Qualificator', '2022-01-05'),
(2, 'jj', 'jj_sec1', 'admin', 'requestor', 'Section 1', '2022-01-06'),
(3, 'jj', 'jj_training', 'admin', 'training', 'Production Technical Training', '2022-01-06'),
(4, 'jj', 'jj_superior', 'admin', 'superior', 'Section 1', '2022-01-06'),
(5, 'Gonzales, Joel C.', 'G.JC', 'G.JEQ', 'requestor', 'EQ(Final)', '2022-01-06'),
(6, 'De La Roca, Kim Sahmil T.', 'DLR.KST', 'D.KEQ', 'requestor', 'EQ(Initial)', '2022-01-06'),
(7, 'Bansal, Donnabel', 'B.D', 'B.DS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(8, 'Punzalan, Jeanette M.', 'P.JM', 'P.JQA', 'requestor', 'QA-Initial', '2022-01-06'),
(9, 'Barredo, Shirley F.', 'B.SF', 'B.SS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(10, 'Pagdonsolan, Ivy Jeane', 'P.IJ', 'P.IQA', 'requestor', 'QA-Initial', '2022-01-06'),
(11, 'Carmona, Rose Ann	C.RQA', 'C.RA', 'C.RQA', 'requestor', 'QA-Initial', '2022-01-06'),
(12, 'De Guzman, Aiza', 'DG.A', 'D.AS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(13, 'Esquelera, Gladys', 'E.G', 'E.GS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(14, 'Baes, Jackielyn S.', 'B.JS', 'B.JQA', 'requestor', 'QA-Initial', '2022-01-06'),
(15, 'Sarol, Mikaela C.', 'S.MC', 'S.MQA', 'requestor', 'QA-FINAL', '2022-01-06'),
(16, 'Garcia, Lizee F.', 'G.LF', 'G.LS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(17, 'Gomez, Mary Grace B.', 'G.MGB', 'G.MQA', 'requestor', 'QA-FINAL', '2022-01-06'),
(18, 'Mojares, Lhea', 'M.L', 'M.LS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(19, 'Ciruelos, Sally', 'C.S', 'C.SQA', 'requestor', 'QA-FINAL', '2022-01-06'),
(20, 'Olarte, Myla S.', 'O.MS', 'O.MS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(21, 'De Mesa, Jessica A.', 'DM.JA', 'D.JQA', 'requestor', 'QA', '2022-01-06'),
(22, 'Cachuela, Armivel B.', 'C.AB', 'C.AQA', 'requestor', 'QA', '2022-01-06'),
(23, 'Reyes, Aubrey rose L.', 'R. ARL', 'R.AS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(24, 'Barrameda, Mary Grace A.', 'B.MGA', 'B.MQA', 'requestor', 'QA', '2022-01-06'),
(25, 'Albay, Lonah Jean G.', 'A.LJG', 'A.LQA', 'requestor', 'QA', '2022-01-06'),
(26, 'Sanchez, Princess', 'S. P', 'S.PS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(27, 'Macaraig, Hazel Mae', 'M.HM', 'M.HPE', 'requestor', 'PE(Initial)', '2022-01-06'),
(28, 'Sarmiento, Twinkle B.', 'S.TB', 'S.TS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(29, 'Valinado, Gladyliene Mae', 'V.GM', 'V.GPE', 'requestor', 'PE(Final)', '2022-01-06'),
(30, 'Soriano, Joanna Marie', 'S.JM', 'S.JS1', 'requestor', 'PD1 Section 1', '2022-01-06'),
(31, 'Cepillo, Kristine Mariel I.', 'C.KMI', 'C.KPE', 'requestor', 'PE(Final)', '2022-01-06'),
(32, 'Adan, Shiela Mae A.', 'A.SMA', 'A.SS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(33, 'Verana, Carla Jane L.', 'V.CJL', 'V.CS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(34, 'Ali, Lorraine Jane M.', 'A.LJM', 'A.LS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(35, 'Andal, May Ann C.', 'A.MAC', 'A.MS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(36, 'Macatangay, Irish V.', 'M.IV', 'M.IS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(37, 'Lumbaz, Lara Jean', 'L.LJ', 'L.LS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(38, 'Awat, Babylyn', 'A.B', 'A.BS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(39, 'Lopez, Roselyn N.', 'L.RN', 'L.RS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(40, 'Azarga, Elenith', 'A.E', 'A.ES2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(41, 'Ilagan, Margie D.', 'I.MD', 'I.MS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(42, 'Icaro, Gladies G.', 'I.GG', 'I.GS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(43, 'Gardiola, Carla Joy R.', 'G.CJR', 'G.CS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(44, 'Enriquez, Nelsie L.', 'E.NL', 'E.NS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(45, 'Carandang, Sherly V.', 'C.SV', 'C.SS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(46, 'Baguio, Roseanne B.', 'B.RB', 'B.RS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(47, 'Amada, Grace', 'A.G', 'A.GS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(48, 'Balhag, Marlene', 'B. M', 'B.MS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(49, 'Afable, Ana', 'A.A', 'A.AS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(50, 'Bolado, Alice B.', 'B. AB', 'B.AS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(51, 'Acibes, Roshiel', 'A.R', 'A.RS6', 'requestor', 'PD2 Section 6', '2022-01-06'),
(52, 'De Claro, Susan', 'DC. S', 'D.SS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(53, 'Linga, Czarina', 'L.C', 'L.CS5', 'requestor', 'PD2 Section 5', '2022-01-06'),
(54, 'Dela Rosa, Jeffel V.', 'DR.JV', 'D.JS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(55, 'Las, Ma. Niña', 'L.MN', 'L.MS5', 'requestor', 'PD2 Section 5', '2022-01-06'),
(56, 'Falamig, Shiena Rose F.', 'F.SRF', 'F.SS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(57, 'Falcon, Kimberly F.', 'F.KF', 'F.KS5', 'requestor', 'PD2 Section 5', '2022-01-06'),
(58, 'Magnaye, Cecilia R.', 'M.CR', 'M.CS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(59, 'Dipasupil, Marvic Joyce', 'D.MJ', 'D.MS5', 'requestor', 'PD2 Section 5', '2022-01-06'),
(60, 'Marañon, Kriza', 'M.K', 'M.KS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(61, 'Agdan, Lovely Grace C.', 'A.LGC', 'A.LS5', 'requestor', 'PD2 Section 5', '2022-01-06'),
(62, 'Mones, Mia S.', 'M.MS', 'M.MS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(63, 'Mora, Divina C.', 'M.DC', 'M.DS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(64, 'Reyes, Rose Ann B.', 'R.RAB', 'R.RS4', 'requestor', 'PD2 Section 4', '2022-01-06'),
(65, 'Onda, Rosell Elisa M.', 'O. REM', 'O.RS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(66, 'Ramos, Florence Ann A.', 'R.FAA', 'R.FS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(67, 'Seda, Julie Ann M.', 'S. JAM', 'S.JS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(68, 'De Guzman, Diana', 'DG.D', 'D.DS2', 'requestor', 'PD1 Section 2 (TOYOTA)', '2022-01-06'),
(69, 'Vidal, Sherryl', 'V. S', 'V.SS2', 'requestor', 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(70, 'Comia, Maricris', 'C.M', 'C.MS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(71, 'Ebreo, Regine P.', 'E.RP', 'E.RS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(72, 'Henteloro, Erwin B.', 'H.EB', 'H.ES4', 'requestor', 'PD2 Section 4', '2022-01-06'),
(73, 'De Rapete, Analiza', 'DR.A', 'D.AS4', 'requestor', 'PD2 Section 4', '2022-01-06'),
(74, 'Falogme, Mercedes A.', 'F.MA', 'F.MS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(75, 'Tiemsem, Manilyn P.', 'T.MP', 'T.MS3', 'requestor', 'PD2 Section 3', '2022-01-06'),
(76, 'Gobison, Kristine Lecille I.', 'G.KLI', 'G.KS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(77, 'Ramos, Jane', 'R.J', 'R.JS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(78, 'Habla, Wengerly M.', 'H.WM', 'H.WS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(79, 'Magnaye, Ma. Crishelle A.', 'M.MCA', 'M.MS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(80, 'Pastoral, Lady Lyn', 'P.LL', 'P.LS3', 'requestor', 'PD1 Section 3', '2022-01-06'),
(81, 'Marasigan, Kim Nova', 'M. KN', 'M.KS3', 'requestor', 'PD1 Section 3', '2022-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `trs_category`
--

CREATE TABLE `trs_category` (
  `id` int(255) NOT NULL,
  `curiculum` varchar(255) NOT NULL,
  `eprocess` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `ojt_period` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_category`
--

INSERT INTO `trs_category` (`id`, `curiculum`, `eprocess`, `training_type`, `ojt_period`) VALUES
(1, 'Initial_First_Process', 'Cutting and Crimping Process', 'Special Batch Training', '11'),
(2, 'Special_Process', 'Automatic Cutting Crimping and Twisting', 'Special Batch Training', '6'),
(3, 'Initial_First_Process', 'Material Handling Zaihai', 'Special Batch Training', '1'),
(4, 'Special_Process', 'Non-Stop Crimping', 'Special Batch Training', '8'),
(5, 'Special_Process', 'Aluminum Automatic Cutting and Crimping Process', 'Special Batch Training', '0'),
(6, 'Initial_First_Process', 'Material Handling Production Distributor', 'Special Batch Training', '4'),
(7, 'SAM_Process', 'Sub Assembly Machine NS IV', 'Special Batch Training', '7'),
(8, 'Initial_Secondary_Common_Process', 'Casting Shield Wire & Battery', 'Special Batch Training', '6'),
(9, 'Special_Process', 'Casting Battery', 'Special Batch Training', '6'),
(10, 'Initial_Secondary_Common_Process', 'Stripping Process include special wire', 'Special Batch Training', '4'),
(11, 'Initial_Secondary_Common_Process', 'Intermediate Stripping', 'Special Batch Training', '5'),
(12, 'Initial_Secondary_Common_Process', 'Manual Crimping', 'Special Batch Training', '5'),
(13, 'Initial_Secondary_Common_Process', 'Joint Crimping', 'Special Batch Training', '5'),
(14, 'Special_Process', 'Manual Crimping for Battery', 'Special Batch Training', '7'),
(15, 'Initial_Secondary_Common_Process', 'Twisting Primary / Secondary & Aluminum', 'Special Batch Training', '3'),
(16, 'Special_Process', 'Dip Soldering', 'Special Batch Training', '8'),
(17, 'Initial_Secondary_Common_Process', 'Joint Insulation Taping Normal & Shield Wire', 'Special Batch Training', '5'),
(18, 'Initial_Secondary_Common_Process', 'Joint Insulation Taping Joint', 'Special Batch Training', '5'),
(19, 'Initial_Secondary_Common_Process', 'Joint Insulation Taping Intermediate Welding Joint', 'Special Batch Training', '5'),
(20, 'Initial_Secondary_Common_Process', 'Point Marking', 'Special Batch Training', '3'),
(21, 'Special_Process', 'Ultrasonic Dip Soldering', 'Special Batch Training', '8'),
(22, 'Special_Process', 'Heat Shrink Raychem', 'Special Batch Training', '4'),
(23, 'Initial_Secondary_Special_Process_1', 'Heat Shrink Blower', 'Special Batch Training', '3'),
(24, 'Initial_Secondary_Special_Process_1', 'Heat Shrink Blower- Drain Wire', 'Special Batch Training', '3'),
(25, 'Initial_Secondary_Special_Process_1', 'Resistance Welding Joint', 'Special Batch Training', '10'),
(26, 'Special_Process', 'LA Molding', 'Special Batch Training', '9'),
(27, 'Special_Process', 'Silicon Injection', 'Special Batch Training', '5'),
(28, 'Special_Process', 'Aluminum Preparation', 'Special Batch Training', '11'),
(29, 'Special_Process', 'ST MAC', 'Special Batch Training', '4'),
(30, 'Initial_Secondary_Special_Process_1', 'Shield Wire', 'Special Batch Training', '4'),
(31, 'Initial_Secondary_Special_Process_1', 'Shield Wire with Joint', 'Special Batch Training', '3'),
(32, 'Initial_Secondary_Special_Process_1', 'Shield Wire Taping', 'Special Batch Training', '3'),
(33, 'Initial_Secondary_Special_Process_2', 'Shikakari Handling Wire Setting, Sorting & Picking', 'Special Batch Training', '3'),
(34, 'Initial_Secondary_Special_Process_2', 'Gomusen Insertion', 'Special Batch Training', '3'),
(35, 'Special_Process', 'UV-III Ultra violet', 'Special Batch Training', '0'),
(36, 'Special_Process', 'Lamp Connector Pressure Welding', 'Special Batch Training', '0'),
(38, 'Initial_Secondary_Special_Process_2', 'Terminal Crimping Inspection Automatic Crimping', 'Special Batch Training', '10'),
(39, 'Initial_Secondary_Special_Process_2', 'Terminal Crimping Inspection Manual Crimping', 'Special Batch Training', '10'),
(40, 'Initial_Secondary_Special_Process_2', 'Joint Crimping Inspection', 'Special Batch Training', '10'),
(41, 'Initial_Secondary_Special_Process_2', 'Resistance Welding Joint Inspection', 'Special Batch Training', '10'),
(42, 'Special_Process', 'AB Terminal Crimping', 'Special Batch Training', '10'),
(43, 'Initial_Process', 'In- Process Inspection', 'Special Batch Training', '5'),
(44, 'Initial_Process', 'COT Automatic Cutting', 'Special Batch Training', '6'),
(45, 'Initial_Process', 'VO Automatic Cutting', 'Special Batch Training', '6'),
(46, 'Initial_Process', 'VS Automatic Cutting', 'Special Batch Training', '6'),
(47, 'Initial_Process', 'COT Semi-Automatic Cutting', 'Special Batch Training', '6'),
(48, 'Initial_Process', 'Tube Cutting Inspection', 'Special Batch Training', '5'),
(50, 'Final_Sub_Assembly_Process', 'Sub Assembly Machine NS IV', 'Special Batch Training', '7'),
(51, 'Final_Sub_Assembly_Process', 'Sub Assembly Process with SUB PC', 'Special Batch Training', '3'),
(52, 'Final_Sub_Assembly_Process', 'Sub Assembly Process Manual insertion', 'Special Batch Training', '3'),
(53, 'Final_Sub_Assembly_Process', 'Layout Process', 'Special Batch Training', '3'),
(54, 'Final_Sub_Assembly_Process', 'Airbag Sub Assembly Process', 'Special Batch Training', '7'),
(55, 'Final_Assembly_Process', 'Material Handling Production Distributor', 'Special Batch Training', '4'),
(56, 'Final_Assembly_Process', 'Parts Distribution Process', 'Special Batch Training', '1'),
(57, 'Final_Assembly_Process', 'Taping Process', 'Special Batch Training', '1'),
(58, 'Final_Assembly_Process', 'Band Gun Process', 'Special Batch Training', '1'),
(59, 'Final_Assembly_Process', 'Assy + Parts Distribution', 'Special Batch Training', '3'),
(60, 'Final_Assembly_Process', 'Grommet Insertion Process', 'Special Batch Training', '3'),
(61, 'Final_Assembly_Process', 'Long Grommet Insertion Process', 'Special Batch Training', '0'),
(62, 'Final_Assembly_Process', 'Option Taping Process', 'Special Batch Training', '2'),
(63, 'Final_Inspection_Process', 'Dimension Inspection', 'Special Batch Training', '10'),
(64, 'Final_Inspection_Process', 'Electricity Inspection', 'Special Batch Training', '5'),
(65, 'Final_Inspection_Process', 'Appearance Inspection', 'Special Batch Training', '5'),
(66, 'Final_Inspection_Process', 'Arm Type Torque Fixing Process', 'Special Batch Training', '5'),
(67, 'Special_Process', 'Grease Injection Process', 'Special Batch Training', '4'),
(68, 'Special_Process', 'Fuse Image Inspection', 'Special Batch Training', '5'),
(69, 'Special_Process', 'One Liquid Silicon Injection/ Helium Leak Checker', 'Special Batch Training', '6'),
(70, 'Final_Inspection_Process', 'TBO Checking Process', 'Special Batch Training', '4'),
(71, 'Final_Process', 'Terminal Removing Person', 'Special Batch Training', '0'),
(72, 'Final_Process', 'Tsumesen Insertion', 'Special Batch Training', '3'),
(73, 'QA_Final_Process', 'Appearance Inspection', 'Special Batch Training', '15'),
(74, 'QA_Initial_Process', 'Terminal Crimping Inspection C& C and Manual', 'Special Batch Training', '5'),
(75, 'QA_Initial_Process', 'Battery Crimping Inspection', 'Special Batch Training', '5'),
(76, 'QA_Initial_Process', 'Joint Crimping Inspection', 'Special Batch Training', '5'),
(77, 'QA_Initial_Process', 'Resistance Welding Joint Inspection', 'Special Batch Training', '5'),
(78, 'QA_Initial_Process', 'Dip Solder Inspection', 'Special Batch Training', '5'),
(79, 'QA_Initial_Process', 'Ultrasonic Dip Solder Inspection', 'Special Batch Training', '5'),
(80, 'QA_Initial_Process', 'LA Mold Inspection', 'Special Batch Training', '5'),
(81, 'QA_Initial_Process', 'Shield Wire Inspection', 'Special Batch Training', '5'),
(82, 'QA_IQC', 'Raw Material Quality Assurance Inspection', 'Special Batch Training', '0'),
(83, 'QA_IQC', 'Plastic Tube Inspection', 'Special Batch Training', '0'),
(85, 'Cross And Refresh Training', '-', 'Cross And Refresh Training', '0');

-- --------------------------------------------------------

--
-- Table structure for table `trs_eval`
--

CREATE TABLE `trs_eval` (
  `id` int(20) NOT NULL,
  `eval_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_eval`
--

INSERT INTO `trs_eval` (`id`, `eval_status`) VALUES
(1, 'For Authorization'),
(2, 'OJT Extension'),
(3, 'Pending Approval'),
(4, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `trs_exam_status`
--

CREATE TABLE `trs_exam_status` (
  `id` int(20) NOT NULL,
  `exam_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_exam_status`
--

INSERT INTO `trs_exam_status` (`id`, `exam_status`) VALUES
(1, 'Passed'),
(2, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `trs_final_stat`
--

CREATE TABLE `trs_final_stat` (
  `id` int(10) NOT NULL,
  `final_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_final_stat`
--

INSERT INTO `trs_final_stat` (`id`, `final_status`) VALUES
(1, 'Retain'),
(2, 'Stop Processing'),
(3, 'Transfer to Other Process');

-- --------------------------------------------------------

--
-- Table structure for table `trs_for_training`
--

CREATE TABLE `trs_for_training` (
  `id` int(20) NOT NULL,
  `employee_num` varchar(255) NOT NULL,
  `training_code` varchar(255) NOT NULL,
  `confirmation` varchar(255) NOT NULL,
  `training_status` varchar(255) NOT NULL,
  `attend` varchar(255) NOT NULL,
  `did_not_attend` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `process` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `ojt_start` date NOT NULL,
  `ojt_end` date NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL,
  `ojt_status` varchar(255) NOT NULL,
  `eval_remarks` varchar(255) NOT NULL,
  `extend_days` varchar(255) NOT NULL,
  `ojt_period` varchar(255) NOT NULL,
  `training_start_date` date DEFAULT NULL,
  `training_end_date` date DEFAULT NULL,
  `eval_status` varchar(255) NOT NULL,
  `eval_submit` varchar(255) NOT NULL,
  `eval_submit_date` date DEFAULT NULL,
  `auth_date` datetime(6) DEFAULT NULL,
  `examiner` varchar(255) NOT NULL,
  `exam_remarks` varchar(255) NOT NULL,
  `attend_exam` varchar(255) NOT NULL,
  `did_not_attend_exam` varchar(255) NOT NULL,
  `exam_status` varchar(255) NOT NULL,
  `last_status` varchar(255) NOT NULL,
  `f_status` varchar(255) NOT NULL,
  `attempt` int(10) NOT NULL DEFAULT 1,
  `eval_cancel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trs_qualif`
--

CREATE TABLE `trs_qualif` (
  `id` int(20) NOT NULL,
  `employee_num` varchar(255) NOT NULL,
  `training_need` varchar(255) NOT NULL,
  `qualif_approve_date` date DEFAULT NULL,
  `qualif_remarks` varchar(255) NOT NULL,
  `qsection` varchar(255) NOT NULL,
  `batch_num` varchar(255) NOT NULL,
  `qualif_cancel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trs_qualif_status`
--

CREATE TABLE `trs_qualif_status` (
  `id` int(10) NOT NULL,
  `training_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_qualif_status`
--

INSERT INTO `trs_qualif_status` (`id`, `training_status`) VALUES
(1, 'Approve'),
(2, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `trs_request`
--

CREATE TABLE `trs_request` (
  `id` int(20) NOT NULL,
  `employee_num` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `emline` varchar(255) NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `training_reason` varchar(255) NOT NULL,
  `approval_status` varchar(255) NOT NULL,
  `request_date_time` datetime(6) NOT NULL,
  `approval_date` date DEFAULT NULL,
  `eprocess` varchar(255) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `esection` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `training_code` varchar(255) NOT NULL,
  `ft_status` varchar(255) NOT NULL,
  `ojt_period` varchar(255) NOT NULL,
  `training_need` varchar(255) DEFAULT NULL,
  `qualifapproval_date` date DEFAULT NULL,
  `qualifcancel_date` date DEFAULT NULL,
  `training_shift` varchar(255) NOT NULL,
  `confirm_date` datetime(6) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time(6) DEFAULT NULL,
  `end_time` time(6) DEFAULT NULL,
  `cancel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trs_section`
--

CREATE TABLE `trs_section` (
  `id` int(20) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_section`
--

INSERT INTO `trs_section` (`id`, `section`, `date_created`) VALUES
(1, 'Section 1', '2021-11-29'),
(2, 'Qualificator', '2021-11-29'),
(3, 'Training', '2021-12-02'),
(7, 'Production Technical Training', '2022-01-06'),
(8, 'EQ(Final)', '2022-01-06'),
(9, 'EQ(Initial)', '2022-01-06'),
(10, 'PD1 Section 1', '2022-01-06'),
(11, 'PD1 Section 2 (MAZDA)', '2022-01-06'),
(12, 'PD1 Section 2 (TOYOTA)', '2022-01-06'),
(13, 'PD2 Section 3', '2022-01-06'),
(14, 'PD2 Section 4', '2022-01-06'),
(15, 'PD2 Section 5', '2022-01-06'),
(16, 'PD2 Section 6', '2022-01-06'),
(17, 'PE(Final)', '2022-01-06'),
(18, 'PE(Initial)', '2022-01-06'),
(19, 'QA', '2022-01-06'),
(20, 'QA-FINAL', '2022-01-06'),
(21, 'QA-Initial', '2022-01-06'),
(22, 'PD1 Section 3', '2022-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `trs_training_categ`
--

CREATE TABLE `trs_training_categ` (
  `id` int(20) NOT NULL,
  `attendance_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_training_categ`
--

INSERT INTO `trs_training_categ` (`id`, `attendance_status`) VALUES
(1, 'Attend'),
(2, 'Did Not Attend');

-- --------------------------------------------------------

--
-- Table structure for table `trs_training_sched`
--

CREATE TABLE `trs_training_sched` (
  `id` int(20) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `slot` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL,
  `training_code` varchar(255) NOT NULL,
  `process` varchar(255) NOT NULL,
  `sched_stat` varchar(255) NOT NULL,
  `rtraining_type` varchar(255) NOT NULL,
  `trainer` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trs_training_status`
--

CREATE TABLE `trs_training_status` (
  `id` int(20) NOT NULL,
  `training_status` varchar(255) NOT NULL,
  `training_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_training_status`
--

INSERT INTO `trs_training_status` (`id`, `training_status`, `training_type`) VALUES
(1, 'Passed', 'Special Batch Training'),
(2, 'Failed', 'Special Batch Training'),
(3, 'Cancel', 'Special Batch Training'),
(4, 'Ongoing', 'Special Batch Training'),
(5, 'Done', 'Cross And Refresh Training'),
(6, 'Cancel.', 'Cross And Refresh Training');

-- --------------------------------------------------------

--
-- Table structure for table `trs_type`
--

CREATE TABLE `trs_type` (
  `id` int(20) NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `training_need` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trs_type`
--

INSERT INTO `trs_type` (`id`, `training_type`, `training_need`) VALUES
(1, 'Special Batch Training', 'Initial_All Process'),
(2, 'Special Batch Training', 'Initial_First Process'),
(3, 'Special Batch Training', 'Initial_Secondary Process'),
(4, 'Special Batch Training', 'Final_All Process'),
(5, 'Special Batch Training', 'Final_Assembly Process'),
(6, 'Special Batch Training', 'Final_Sub Assembly Process'),
(7, 'Special Batch Training', 'Final_Inspection Process'),
(8, 'Cross And Refresh Training', 'Cross And Refresh Training');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trs_accounts`
--
ALTER TABLE `trs_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_category`
--
ALTER TABLE `trs_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_eval`
--
ALTER TABLE `trs_eval`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `trs_exam_status`
--
ALTER TABLE `trs_exam_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_final_stat`
--
ALTER TABLE `trs_final_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_for_training`
--
ALTER TABLE `trs_for_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_qualif`
--
ALTER TABLE `trs_qualif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_qualif_status`
--
ALTER TABLE `trs_qualif_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_request`
--
ALTER TABLE `trs_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_section`
--
ALTER TABLE `trs_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_training_categ`
--
ALTER TABLE `trs_training_categ`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_training_sched`
--
ALTER TABLE `trs_training_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_training_status`
--
ALTER TABLE `trs_training_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trs_type`
--
ALTER TABLE `trs_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trs_accounts`
--
ALTER TABLE `trs_accounts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `trs_category`
--
ALTER TABLE `trs_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `trs_eval`
--
ALTER TABLE `trs_eval`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trs_exam_status`
--
ALTER TABLE `trs_exam_status`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trs_final_stat`
--
ALTER TABLE `trs_final_stat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trs_for_training`
--
ALTER TABLE `trs_for_training`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trs_qualif`
--
ALTER TABLE `trs_qualif`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trs_qualif_status`
--
ALTER TABLE `trs_qualif_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trs_request`
--
ALTER TABLE `trs_request`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trs_section`
--
ALTER TABLE `trs_section`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trs_training_categ`
--
ALTER TABLE `trs_training_categ`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trs_training_sched`
--
ALTER TABLE `trs_training_sched`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trs_training_status`
--
ALTER TABLE `trs_training_status`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trs_type`
--
ALTER TABLE `trs_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
