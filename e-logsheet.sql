-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2023 at 08:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-logsheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `control_number`
--

CREATE TABLE `control_number` (
  `risNoDate` text NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position_designation` varchar(50) NOT NULL,
  `agency_school_office` varchar(50) NOT NULL,
  `scheduledate` varchar(200) NOT NULL,
  `purpose_of_visit` varchar(200) NOT NULL,
  `yearRequested` int(4) NOT NULL,
  `seriesNumber` int(255) NOT NULL,
  `reference_no` varchar(200) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `control_number`
--

INSERT INTO `control_number` (`risNoDate`, `fullname`, `position_designation`, `agency_school_office`, `scheduledate`, `purpose_of_visit`, `yearRequested`, `seriesNumber`, `reference_no`, `timeStamp`) VALUES
('CA-2023-11-000001', 'Lenny Deogracia', 'TEACHER VII', 'DEPED CSJDM', '11/29/2023', 'Take the hassle out of icons in your project. Font Awesome is the Internet\'s icon library and toolkit, used by millions of designers, developers.', 2023, 1, '', '2023-11-29 15:49:10'),
('CA-2023-12-000002', 'Kenny Wise', 'Teacher V', 'DEPED CSJDM ', '12/04/2023', 'for purposes ', 2023, 2, '', '2023-12-04 08:31:39'),
('CA-2023-12-000003', 'Asdh', 'ahsd', 'jasgdj', '12/07/2023', 'jashdg', 2023, 3, 'JV0P549D', '2023-12-07 11:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `e_logsheetaccounts`
--

CREATE TABLE `e_logsheetaccounts` (
  `accountType` varchar(200) NOT NULL,
  `accountName` varchar(200) NOT NULL,
  `userPosition` varchar(200) NOT NULL,
  `userOffice` varchar(200) NOT NULL,
  `depedEmail` varchar(200) NOT NULL,
  `accountPass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_logsheetaccounts`
--

INSERT INTO `e_logsheetaccounts` (`accountType`, `accountName`, `userPosition`, `userOffice`, `depedEmail`, `accountPass`) VALUES
('Admin', 'Arthur Francisco', 'ICT Head', 'Information Communication Technology', 'arthur.francisco@deped.gov.ph', 'deped123'),
('Admin', 'Dennis Garcia', 'SGOD Head', 'School Governance Operations Division', 'dennis.garcia@deped.gov.ph', 'deped1234'),
('Security', 'Security Guard', 'Security Head', 'Security', 'Securityguard@deped.gov.ph', 'Security123'),
('Admin', 'Jeanny G. Roldan', 'Cashier Personel', 'Cashier Section', ' jeanny.roldan001@deped.gov.ph', 'deped123'),
('Admin', 'Jomel Policarpio', 'Administrative Assistant II', 'Accounting Section', 'jomel.policarpio@deped.gov.ph\r\n', 'deped123'),
('Admin', 'Gina E. Cape', 'Administrative Assistant III', 'Accounting Section', 'gina.cape@deped.gov.ph', 'deped123'),
('Admin', 'Jonie-May S. Francisco', 'Administrative Aide VI', 'Cash Section', 'joniemay.francisco@deped.gov.ph', 'deped123'),
('Admin', 'Ma. Beverlie J. Nolasco', 'Accounting Section', 'Accounting Section', 'mabeverlie.jabat@deped.gov.ph', 'deped123'),
('Admin', 'Catherine A. Flores', 'Cashier', 'Cashier Section', 'catherine.flores010@deped.gov.ph', 'deped123'),
('Admin', 'Sherylyn M. Robes', 'Payroll', 'Payroll Section', 'sherylyn.robes@deped.gov.ph', 'deped123'),
('Admin', 'Esperanza D. Cruz', 'Payroll', 'Payroll Section', 'esperanza.cruz@deped.gov.ph', 'deped123'),
('Admin', 'Rodelio D. Jimenez', 'SDS', ' Schools Division Superintendent', 'rodelio.jimenez001@deped.gov.ph', 'deped123'),
('Admin', 'Ann Melfei P. Casas', 'Accounting', 'Accounting Section', 'annmelfei.casas@deped.gov.ph', 'deped123'),
('Admin', 'Donn Uriel Buenaventura', 'Sgod', 'School Governance Operations Division', 'donnuriel.buenaventura@deped.gov.ph', 'deped123'),
('Admin', 'Teresita S. Padilla', 'PSDS', 'Curriculum Implementation Division', 'teresita.padilla001@deped.gov.ph', 'deped123'),
('Admin', 'Conrado O. Abraham', 'Sgod', 'School Governance Operations Division', 'conrado.abraham@deped.gov.ph', 'deped`123'),
('Admin', 'Noel B. Burce', 'Sgod', 'School Governance Operations Division', 'noel.burce@deped.gov.ph', 'deped123'),
('Admin', 'Faith Arky C. De Ausen', 'Sgod', 'School Governance Operations Division', 'faitharky.deausen@deped.gov.ph', 'deped123'),
('Admin', 'Alma Lynn M. Santos', 'Sgod', 'School Governance Operations Division', 'almalynn.santos@deped.gov.ph', 'deped123'),
('Admin', 'Thelma C. Bajar', 'Accounting', 'Accounting Section', 'thelma.bajar@deped.gov.ph', 'deped123'),
('Admin', 'Darlan R. Grageda', 'Cid', 'Curriculum Implementation Division', 'darlan.grageda001@deped.gov.ph', 'deped123'),
('Admin', 'Benedict John C. Aure', 'Atty', 'Legal Services', 'benedictjohn.aure@deped.gov.ph', 'deped123'),
('Admin', 'Manuel N. Payumo Jr.', 'Sgod', 'School Governance Operations Division', 'manuel.payumojr@deped.gov.ph', 'deped123'),
('Admin', 'Laarnie I. Catahan', 'Accounting', 'Accounting Section', 'laarnie.catahan@deped.gov.ph', 'deped123'),
('Admin', 'Maria Mercedez M. Bijasa', 'Accounting', 'Accounting Section', 'mariamercedez.bijasa@deped.gov.ph', 'deped123'),
('Admin', 'Maria Socorro M. De Guzman', 'Sgod', 'School Governance Operations Division', 'masocorro.deguzman@deped.gov.ph', 'deped123'),
('Admin', 'Adelynne Joie B. San Diego', 'Sgod', 'School Governance Operations Division', 'adeynnejie.sandiego@deped.gov.ph', 'deped123'),
('Admin', 'Nenette M. Gomez', 'Accounting', 'Accounting Section', 'nenette.gomez@deped.gov.ph', 'deped123'),
('Admin', 'Mary Ann L. Soriano', 'Sgod', 'School Governance Operations Division', 'maryann.soriano004@deped.gov.ph', 'deped123'),
('Admin', 'Melsan R. Daza', 'Sgod', 'School Governance Operations Division', 'melsan.daza@deped.gov.ph', 'deped123'),
('Admin', 'Manuel P. Delacruz', 'Sgod', 'School Governance Operations Division', 'manuel.delacruz008@deped.gov.ph', 'deped123'),
('Admin', 'Baby Ruth D. Pablo', 'Accounting', 'Accounting Section', 'babyruth.pablo@deped.gov.ph', 'deped123'),
('Admin', 'Jennifer F. Fuentes', 'Sgod', 'School Governance Operations Division', 'jennifer.fuentes004@deped.gov.ph', 'deped123'),
('Admin', 'Lalaine S. Bartolome', 'Budget', 'Budget Section', 'lalaine.mendoza003@deped.gov.ph', 'deped123'),
('Admin', 'Orlando D. Gonzales', 'Budget', 'Budget Section', 'orlando.gonzales@deped.gov.ph', 'deped123'),
('Admin', 'Rechie O. Labandria', 'Accounting', 'Accounting Section', 'rechie.labandria@deped.gov.ph', 'deped123'),
('Admin', 'Merlita D. Ynciong', 'Sgod', 'School Governance Operations Division', 'merlita.ynciong@deped.gov.ph', 'deped123'),
('Admin', 'Adelynne Joie B. Sandiego', 'Sgod', 'School Governance Operations Division', 'adylnnejoie.sandiego@deped.gov.ph', 'deped123'),
('Admin', 'Randhell C. Ruzgal', 'Sgod', 'School Governance Operations Division', 'randhell.ruzgal@deped.gov.ph', 'deped123'),
('Super Admin', 'Super Admin', 'ADMIN', 'BABY KO SI KULOT', 'Superadmin@deped.gov.ph', 'superadmin'),
('Admin', 'Ivan Policarpio', 'OJT', 'BABY KO SI KULOT', 'ivanpolicarpio@deped.gov.ph', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `e_logshistory`
--

CREATE TABLE `e_logshistory` (
  `id` int(11) NOT NULL,
  `yearRequested` int(5) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `sex` varchar(200) NOT NULL,
  `priority` varchar(200) NOT NULL,
  `phonenumber` varchar(200) DEFAULT NULL,
  `scheduledate` varchar(200) DEFAULT NULL,
  `position_designation` varchar(50) NOT NULL,
  `agency_school_office` varchar(50) NOT NULL,
  `appointment` varchar(200) DEFAULT NULL,
  `purpose_of_visit` text DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `reference_no` varchar(200) NOT NULL,
  `time_in` varchar(200) NOT NULL,
  `time_out` varchar(200) DEFAULT NULL,
  `assisted_by` varchar(50) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_logshistory`
--

INSERT INTO `e_logshistory` (`id`, `yearRequested`, `fullname`, `sex`, `priority`, `phonenumber`, `scheduledate`, `position_designation`, `agency_school_office`, `appointment`, `purpose_of_visit`, `department`, `reference_no`, `time_in`, `time_out`, `assisted_by`, `timeStamp`) VALUES
(0, 2023, 'Ivan Policarpio', 'Male', '', '09120391029', '12/12/2023', 'ajsh', 'kajd', 'Walk-in', 'In the bustling city, where skyscrapers touched the sky and the hustle and bustle of daily life never seemed to cease, lived a diverse community of people from all walks of life. From the busy professionals rushing to their offices, to the street vendors selling their wares on crowded corners, the city thrived with energy and activity. Amidst the urban chaos, pockets of tranquility could be found in quaint parks and hidden alleys, providing a respite for those seeking a moment of solace. Despite the challenges, the city pulsated with life, each person contributing to its vibrant tapestry.', 'Information Communication Technology', 'T4383SQN', '09:13 AM', '09:13 AM', 'Arthur Francisco', '2023-12-12 01:13:42'),
(0, 2023, 'Ivan E. Policarpio', 'Male', '', '01293019230', '12/12/2023', 'jashd', 'jahsd', 'Walk-in', 'In the quiet woods, a fox leapt over fallen leaves, its russet coat blending with autumn hues. A distant owl hooted as the moon cast a gentle glow, nature\\\'s nocturnal symphony echoing in peaceful serenity.', 'Information Communication Technology', 'SD087JUB', '11:07 AM', '11:07 AM', 'Arthur Francisco', '2023-12-12 03:07:47'),
(0, 2023, 'Ivan Policarpio', 'Male', 'Senior Citizen', '01920391203', '12/14/2023', 'NA', 'NA', 'Online', 'adasdsad', 'Information Communication Technology', 'WIWUEWS1', '03:57 PM', '03:57 PM', 'Arthur Francisco', '2023-12-14 07:57:37'),
(0, 2023, 'Asd', 'Male', 'Senior Citizen', '12312312312', '12/14/2023', 'asd', 'asd', 'Walk-in', 'asd', 'Information Communication Technology', 'ANZSPUGW', '03:57 PM', '03:57 PM', 'Arthur Francisco', '2023-12-14 07:57:40'),
(0, 2023, 'Jsksjsj', 'Male', 'Senior Citizen', '66464646464', '12/14/2023', 'hdjj', 'jsjsjsjsj', 'Walk-in', 'bhsjsj', 'Information Communication Technology', 'HMV8JGOG', '04:02 PM', '04:02 PM', 'Arthur Francisco', '2023-12-14 08:02:27'),
(0, 2023, 'Asd', 'Male', 'Pregnant', '12312312312', '12/14/2023', 'sad', 'asd', 'Walk-in', 'asd', 'Information Communication Technology', '17QP92FF', '04:02 PM', '04:02 PM', 'Arthur Francisco', '2023-12-14 08:02:35'),
(0, 2023, 'Jsjsjsjsjsj', 'Female', 'Pregnant', '61646464666', '12/14/2023', 'hjjdjdjdj', 'hjsjsjdjdj', 'Walk-in', 'jsjdjdjdjdje', 'Information Communication Technology', '3B33T3RM', '04:02 PM', '04:02 PM', 'Arthur Francisco', '2023-12-14 08:02:41'),
(0, 2023, 'Aaaaa', 'Male', '', '12312312312', '12/14/2023', 'asd', 'asd', 'with Appointment', 'asd', 'Information Communication Technology', '6UDPNC15', '04:02 PM', '04:02 PM', 'Arthur Francisco', '2023-12-14 08:02:48'),
(0, 2023, 'Jsjsksksksjsj', 'Female', '', '65646565656', '12/14/2023', 'jjejdjdjdjdjdjdj', 'jdjdjsjsjdjdjdjdjdjdjdjdjdj', 'Walk-in', 'jsjsjsjsj', 'Information Communication Technology', 'U6KR9MU6', '04:03 PM', '04:03 PM', 'Arthur Francisco', '2023-12-14 08:03:01'),
(0, 2023, 'Hsjsjsjsjsjsjsj', 'Male', '', '64646465656', '12/14/2023', 'g', 'h', 'Walk-in', 'h', 'Information Communication Technology', 'XL1F0BCM', '04:03 PM', '04:03 PM', 'Arthur Francisco', '2023-12-14 08:03:08'),
(0, 2023, 'U', 'Female', '', '96666666666', '12/14/2023', 'h', 'h', 'Walk-in', 'h', 'Information Communication Technology', 'K6RHXRX3', '04:03 PM', '04:03 PM', 'Arthur Francisco', '2023-12-14 08:03:18'),
(0, 2023, 'H', 'Male', '', '66666666666', '12/14/2023', 'j', 'n', 'Walk-in', 'h', 'Information Communication Technology', 'OOIOULYC', '04:03 PM', '04:03 PM', 'Arthur Francisco', '2023-12-14 08:03:25'),
(0, 2023, 'J', 'Male', '', '66663333333', '12/14/2023', 'h', 'jf', 'Walk-in', 'g', 'Information Communication Technology', 'I8M4R53O', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:10'),
(0, 2023, 'U', 'Male', '', '66613131313', '12/14/2023', 'hh', 'hhjj', 'Walk-in', 'jjjjj', 'Information Communication Technology', 'ZUS6GPS7', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:17'),
(0, 2023, 'Dasdasd', 'Male', '', '12312312312', '12/14/2023', 'asd', 'asd', 'Walk-in', 'asd', 'Information Communication Technology', 'ACPX4JC1', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:24'),
(0, 2023, 'Hjj', 'Female', '', '69664646464', '12/14/2023', 'jj', 'hh', 'Walk-in', 'hh', 'Information Communication Technology', 'M6198WFQ', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:44'),
(0, 2023, 'Asd', 'Female', '', '12312312312', '12/14/2023', 'asdasd', 'asdasd', 'Walk-in', 'asdasd', 'Information Communication Technology', 'U5PIN8AN', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:51'),
(0, 2023, 'Uh', 'Male', '', '66663333333', '12/14/2023', 'nj', 'h', 'Walk-in', 'b', 'Information Communication Technology', 'ZZH33NIT', '04:04 PM', '04:04 PM', 'Arthur Francisco', '2023-12-14 08:04:58'),
(0, 2023, 'Ivan Policarpio', 'Male', '', '09454619467', '12/15/2023', 'NA', 'NA', 'Online', 'Wala lang', 'Information Communication Technology', 'IE0OKVS0', '03:00 PM', '03:00 PM', 'Arthur Francisco', '2023-12-15 07:00:20'),
(0, 2023, 'Ivan Polcarpio', 'Male', '', '01923091239', '12/15/2023', 'NA', 'NA', 'Walk-in', 'asd', 'Information Communication Technology', 'YUZBI6O9', '03:00 PM', '03:00 PM', 'Arthur Francisco', '2023-12-15 07:00:28'),
(0, 2023, 'Angelo Capa', 'Male', '', '01923019230', '12/15/2023', 'NA', 'NA', 'Walk-in', 'asd', 'School Governance Operations Division', 'SKPJAPUC', '03:02 PM', '03:02 PM', 'Dennis Garcia', '2023-12-15 07:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `e_monitoringlogsheet`
--

CREATE TABLE `e_monitoringlogsheet` (
  `id` int(11) NOT NULL DEFAULT 0,
  `yearRequested` int(5) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `sex` varchar(200) NOT NULL,
  `priority` varchar(200) NOT NULL,
  `phonenumber` varchar(200) DEFAULT NULL,
  `scheduledate` varchar(200) DEFAULT NULL,
  `appointment` varchar(200) DEFAULT NULL,
  `purpose_of_visit` text DEFAULT NULL,
  `position_designation` varchar(200) NOT NULL,
  `agency_school_office` varchar(200) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `reference_no` varchar(20) DEFAULT NULL,
  `time_in` varchar(200) DEFAULT NULL,
  `time_out` varchar(200) NOT NULL,
  `action` varchar(20) DEFAULT NULL,
  `cancel` varchar(20) DEFAULT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_monitoringlogsheet`
--

INSERT INTO `e_monitoringlogsheet` (`id`, `yearRequested`, `fullname`, `sex`, `priority`, `phonenumber`, `scheduledate`, `appointment`, `purpose_of_visit`, `position_designation`, `agency_school_office`, `department`, `reference_no`, `time_in`, `time_out`, `action`, `cancel`, `timeStamp`) VALUES
(0, 2023, 'Reymi Angelo Dela Cruz', 'Male', '', '09120390192', '12/12/2023', 'Walk-in', 'ajshdg', 'aushd', 'asjhd', 'Information Communication Technology', 'EON1J1MO', NULL, '', NULL, NULL, '2023-12-12 01:15:46'),
(0, 2023, 'Reymi Angelo Dela Cruz', 'Male', '', '09120391293', '12/15/2023', 'Walk-in', 'asd', 'sad', 'asd', 'Curriculum Implementation Division', '9AFX5M31', NULL, '', NULL, NULL, '2023-12-15 05:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `unsuccessful_appointment`
--

CREATE TABLE `unsuccessful_appointment` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `sex` varchar(200) NOT NULL,
  `priority` varchar(200) NOT NULL,
  `phonenumber` varchar(200) DEFAULT NULL,
  `scheduledate` varchar(200) DEFAULT NULL,
  `appointment` varchar(200) DEFAULT NULL,
  `purpose_of_visit` varchar(200) DEFAULT NULL,
  `position_designation` varchar(200) NOT NULL,
  `agency_school_office` varchar(200) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `reference_no` varchar(200) NOT NULL,
  `time_in` varchar(200) NOT NULL,
  `time_out` varchar(200) DEFAULT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unsuccessful_appointment`
--

INSERT INTO `unsuccessful_appointment` (`id`, `fullname`, `sex`, `priority`, `phonenumber`, `scheduledate`, `appointment`, `purpose_of_visit`, `position_designation`, `agency_school_office`, `department`, `reference_no`, `time_in`, `time_out`, `timeStamp`) VALUES
(0, 'Ivan', 'Male', '', '09123012930', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'DFP0D5YM', '01:46 PM', NULL, '2023-11-17 05:46:53'),
(0, 'Policarpio', 'Male', '', '91829182398', '11/16/2023', 'Online', ' asd', 'asd', 'asd', 'Information Communication Technology', 'FMBKAN0Z', '', NULL, '2023-11-17 05:46:53'),
(0, 'Reymi', 'Male', '', '01293012930', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'CJP693RF', '01:48 PM', NULL, '2023-11-17 05:48:38'),
(0, 'Capa', 'Male', '', '01293012930', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'GX0HA865', '', NULL, '2023-11-17 05:48:38'),
(0, 'Ruth', 'Female', 'Senior Citizen', '91283912839', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'FYD1SH9L', '', NULL, '2023-11-17 05:49:57'),
(0, 'Jane', 'Male', '', '01923091203', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '7LPODALX', '01:49 PM', NULL, '2023-11-17 05:49:57'),
(0, 'Imee', 'Female', '', '01293012930', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'S5H31U9R', '', NULL, '2023-11-17 05:55:08'),
(0, 'Irish', 'Female', '', '01923091239', '11/16/2023', 'Online', 'asd ', 'asd', 'asd', 'Information Communication Technology', 'GD8BNC5A', '01:55 PM', NULL, '2023-11-17 05:55:08'),
(0, 'asd', 'Female', '', '12039102391', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'QX49DU2N', '', NULL, '2023-11-17 05:55:41'),
(0, 'James', 'Male', '', '01293091239', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'E1KRSW71', '', NULL, '2023-11-17 05:59:22'),
(0, 'Jessica', 'Male', '', '01293012930', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'O2MD2OWG', '01:59 PM', NULL, '2023-11-17 05:59:22'),
(0, 'Ivan', 'Male', '', '01293091231', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '9E17OR9N', '02:01 PM', NULL, '2023-11-17 06:01:13'),
(0, 'Policarpio', 'Male', '', '01293091203', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'U8UMZ86W', '02:01 PM', NULL, '2023-11-17 06:01:13'),
(0, 'Imee', 'Male', '', '01920930129', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'XNSIVXKB', '02:01 PM', NULL, '2023-11-17 06:01:13'),
(0, 'Reymi', 'Male', '', '01920391203', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '2MI9U4J0', '', NULL, '2023-11-17 06:01:13'),
(0, 'asd', 'Male', '', '09120391293', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'KOXF8LFX', '', NULL, '2023-11-17 06:01:13'),
(0, 'Capa', 'Male', '', '01923091239', '11/16/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '8GOY4R6E', '', NULL, '2023-11-17 06:01:14'),
(0, 'Ivan', 'Male', '', '01920310293', '11/20/2023', 'Online', 'asd', 'sa', 'asd', 'Information Communication Technology', 'TWNC02RT', '04:21 PM', NULL, '2023-11-21 08:21:04'),
(0, 'POLI', 'Male', '', '01923091203', '11/20/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '0Z58K0O1', '', NULL, '2023-11-21 08:21:46'),
(0, 'asd', 'Male', '', '12312321321', '11/21/2023', 'Walk-in', 'asd', 'as', 'asd', 'Information Communication Technology', '2P1410YA', '', NULL, '2023-11-22 03:58:50'),
(0, 'TRY II', 'Male', '', '01930129301', '11/21/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'PEESIJZ1', '', NULL, '2023-11-22 04:00:34'),
(0, 'TRY', 'Male', '', '12312312312', '11/21/2023', 'Online', 'asdasd', 'asd', 'asd', 'Information Communication Technology', 'QH627447', '', NULL, '2023-11-22 04:00:34'),
(0, 'POLIKAT', 'Male', '', '01290193012', '11/21/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'L7OMLDTW', '12:01 PM', NULL, '2023-11-22 04:01:19'),
(0, 'POLI', 'Male', '', '01293019230', '11/21/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '9Q0ID3RL', '', NULL, '2023-11-22 04:05:06'),
(0, 'IVAN', 'Male', '', '01293010293', '11/21/2023', 'Online', 'asd', 'qsd', 'asd', 'Curriculum Implementation Division', 'JJ6H7ENU', '', NULL, '2023-11-22 04:39:22'),
(0, 'ivan', 'Male', '', '01920391203', '11/22/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', 'RTO0E2B0', '', NULL, '2023-11-23 08:37:37'),
(0, 'CApa', 'Male', '', '12312312312', '11/23/2023', 'Walk-in', 'asd', 'asd', 'asd', 'Curriculum Implementation Division', 'ZTQ0088L', '', NULL, '2023-11-24 06:43:33'),
(0, 'TRY', 'Male', '', '01923091203', '11/23/2023', 'Walk-in', 'asd ', 'ad', 'asd', 'School Governance Operations Division', '4LX4GASN', '', NULL, '2023-11-24 06:43:33'),
(0, 'ASD', 'Male', '', '12312312312', '11/23/2023', 'Walk-in', 'asd', 'asd', 'asd', 'Budget Section', 'NG4PBPNU', '', NULL, '2023-11-24 06:43:33'),
(0, 'Dela Cruz', 'Male', '', '01923091203', '11/23/2023', 'Walk-in', 'asd', 'asd', 'asd', 'Curriculum Implementation Division', 'KBNCB53E', '', NULL, '2023-11-24 06:43:33'),
(0, 'sadsadsadaas', 'Female', '', '92131212938', '11/28/2023', 'Walk-in', 'nsdkamdmsa', 'sakdas', 'msaklmdksad', 'Information Communication Technology', 'SQVVHFOP', '', NULL, '2023-11-29 05:31:43'),
(0, 'Reymi', 'Male', '', '01920391029', '12/10/2023', 'Online', 'kajsd', 'kjhaskd', 'khasdkjh', 'Information Communication Technology', '97D1YG1S', '', NULL, '2023-12-11 07:54:45'),
(0, 'Poli', 'Male', '', '01920390129', '12/10/2023', 'Online', 'asd', 'asd', 'asd', 'Information Communication Technology', '8IZGKNTP', '', NULL, '2023-12-11 07:54:45'),
(0, 'Jayson', 'Male', '', '01923091293', '12/10/2023', 'Online', 'asd', 'kjahsd', 'khaskd', 'Information Communication Technology', '9TN59QDC', '03:55 PM', NULL, '2023-12-11 07:55:08'),
(0, 'Ivan Policarpio', 'Male', '', '09129381293', '12/11/2023', 'Walk-in', 'asdhasgdjhasgd', 'asjhdg', 'ajshdg', 'Information Communication Technology', 'EDZPPS39', '', NULL, '2023-12-12 01:02:41'),
(0, 'Asd', 'Male', '', '12312312312', '12/11/2023', 'Walk-in', 'ASD', '312312', 'ASD', 'Information Communication Technology', '21AVJ6VF', '', NULL, '2023-12-12 01:02:41'),
(0, 'Angelo Capa', 'Male', '', '09120310231', '12/11/2023', 'Online', 'asdasd', 'jahsgd', 'asdas', 'Information Communication Technology', 'D66PLFKT', '', NULL, '2023-12-12 01:02:41'),
(0, 'Ruth', 'Female', 'Pregnant', '09120310293', '12/14/2023', 'Walk-in', 'asdasd', 'Na', 'Na', 'BABY KO SI KULOT', 'TNGODNEZ', '', NULL, '2023-12-15 00:47:41'),
(0, 'Iwiaisksjsjsj', 'Male', 'Pregnant', '34346465656', '12/14/2023', 'Walk-in', 'jsjsjsjsjsjsj', 'jhhh', 'hsjjsjssjsjdjsjdj', 'BABY KO SI KULOT', '26EMGW34', '', NULL, '2023-12-15 00:47:41'),
(0, 'U', 'Male', '', '66131313131', '12/14/2023', 'Walk-in', 'hj', 'h', 'h', 'Information Communication Technology', 'GHSS5942', '', NULL, '2023-12-15 00:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `location`) VALUES
(120, 'bday.mp4', 'videos/bday.mp4'),
(121, 'LUFFY.mp4', 'videos/LUFFY.mp4'),
(122, 'elijah woods - 24_7, 365 (official lyric video).mp4', 'videos/elijah woods - 24_7, 365 (official lyric video).mp4'),
(123, 'We Dont Die We Multiply WDDWM   187 MOBSTAZ MUSIC VIDEO W Lyrics.mp4', 'videos/We Dont Die We Multiply WDDWM   187 MOBSTAZ MUSIC VIDEO W Lyrics.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `videos_displayer`
--

CREATE TABLE `videos_displayer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos_displayer`
--

INSERT INTO `videos_displayer` (`id`, `name`, `location`) VALUES
(1, 'We Dont Die We Multiply WDDWM   187 MOBSTAZ MUSIC VIDEO W Lyrics.mp4', 'videos/We Dont Die We Multiply WDDWM   187 MOBSTAZ MUSIC VIDEO W Lyrics.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_data`
--

CREATE TABLE `visitor_data` (
  `id` int(11) NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_data`
--

INSERT INTO `visitor_data` (`id`, `visitor_name`, `department`, `time_stamp`) VALUES
(5, 'Ivan Policarpio', 'Information Communication Technology', '2023-12-15 07:00:17'),
(6, 'Ivan Polcarpio', 'Information Communication Technology', '2023-12-15 07:00:25'),
(7, 'Angelo Capa', 'School Governance Operations Division', '2023-12-15 07:02:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos_displayer`
--
ALTER TABLE `videos_displayer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_data`
--
ALTER TABLE `visitor_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `videos_displayer`
--
ALTER TABLE `videos_displayer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_data`
--
ALTER TABLE `visitor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
