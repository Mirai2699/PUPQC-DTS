-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 04:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dts_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_document_type`
--

CREATE TABLE `r_document_type` (
  `docutype_ID` int(10) NOT NULL,
  `docutype_desc` varchar(50) NOT NULL,
  `docutype_stat` bit(1) NOT NULL DEFAULT b'1',
  `docutype_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_document_type`
--

INSERT INTO `r_document_type` (`docutype_ID`, `docutype_desc`, `docutype_stat`, `docutype_timestamp`) VALUES
(1, 'Requisition and Issue Slip', b'1', '2019-02-21 13:25:54'),
(2, 'Purchase Request', b'1', '2019-02-21 13:26:09'),
(3, 'Request Letter', b'1', '2019-02-21 13:26:37'),
(4, 'General Clearance', b'1', '2019-02-21 13:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `r_office`
--

CREATE TABLE `r_office` (
  `office_ID` int(10) NOT NULL,
  `office_name` varchar(200) NOT NULL,
  `office_stat` bit(1) NOT NULL DEFAULT b'1',
  `office_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_office`
--

INSERT INTO `r_office` (`office_ID`, `office_name`, `office_stat`, `office_timestamp`) VALUES
(1, 'Information Technology and Communications Office', b'1', '2019-02-21 13:21:25'),
(2, 'Office of Academic Affairs ', b'1', '2019-02-21 13:22:01'),
(3, 'Cashiers office', b'1', '2019-02-21 13:22:19'),
(4, 'Research Coordinating Office', b'1', '2019-02-21 13:22:38'),
(5, 'Office of the Student Affairs and Services', b'1', '2019-02-21 13:22:54'),
(6, 'Office of the Registrar', b'1', '2019-02-21 13:23:35'),
(7, 'SHS & Accreditation Coordinating Office', b'1', '2019-02-21 13:24:03'),
(8, 'Property and Supplies Office', b'1', '2019-02-21 13:24:21'),
(9, 'Learning Resource Center Office', b'1', '2019-02-21 13:24:39'),
(10, 'Office of the Director', b'1', '2019-02-21 13:28:06'),
(11, 'Records Office', b'1', '2019-02-27 13:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `r_priority_type`
--

CREATE TABLE `r_priority_type` (
  `priority_ID` int(10) NOT NULL,
  `priority_desc` varchar(50) NOT NULL,
  `priority_date_count` int(10) NOT NULL,
  `priority_stat` bit(1) NOT NULL DEFAULT b'1',
  `priority_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_priority_type`
--

INSERT INTO `r_priority_type` (`priority_ID`, `priority_desc`, `priority_date_count`, `priority_stat`, `priority_timestamp`) VALUES
(1, 'Simple', 5, b'1', '2019-02-21 13:25:12'),
(2, 'Complex', 10, b'1', '2019-02-21 13:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `r_source_type`
--

CREATE TABLE `r_source_type` (
  `source_ID` int(10) NOT NULL,
  `source_desc` varchar(50) NOT NULL,
  `source_stat` bit(1) NOT NULL DEFAULT b'1',
  `source_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_source_type`
--

INSERT INTO `r_source_type` (`source_ID`, `source_desc`, `source_stat`, `source_timestamp`) VALUES
(1, 'Internal', b'1', '2019-02-21 13:24:56'),
(2, 'External', b'1', '2019-02-21 13:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `r_user_role`
--

CREATE TABLE `r_user_role` (
  `usr_ID` int(10) NOT NULL,
  `usr_desc` varchar(50) NOT NULL,
  `usr_stat` bit(1) NOT NULL,
  `usr_timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_user_role`
--

INSERT INTO `r_user_role` (`usr_ID`, `usr_desc`, `usr_stat`, `usr_timestamp`) VALUES
(1, 'Administrator', b'1', '2019-01-10 14:12:00'),
(2, 'Department-OIC', b'1', '2019-01-11 11:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `t_accounts`
--

CREATE TABLE `t_accounts` (
  `acc_ID` int(10) NOT NULL,
  `acc_empID` int(10) NOT NULL,
  `acc_username` varchar(100) NOT NULL,
  `acc_password` varchar(100) NOT NULL,
  `acc_email` varchar(255) DEFAULT NULL,
  `acc_user_role` int(10) NOT NULL,
  `acc_active_flag` varchar(20) NOT NULL DEFAULT 'Active',
  `acc_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acc_mod_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_accounts`
--

INSERT INTO `t_accounts` (`acc_ID`, `acc_empID`, `acc_username`, `acc_password`, `acc_email`, `acc_user_role`, `acc_active_flag`, `acc_timestamp`, `acc_mod_date`) VALUES
(1, 1, 'admin', 'admin', NULL, 1, 'Active', '2019-02-27 14:24:32', '2019-02-27 14:24:32'),
(2, 2, 'edgardo_delmo', 'edgardo_delmo', NULL, 2, 'Active', '2019-02-27 14:35:51', '2019-02-27 14:35:51'),
(3, 3, 'doris_gatan', 'doris_gatan', NULL, 2, 'Active', '2019-02-27 14:37:08', '2019-02-27 14:37:08'),
(4, 4, 'irynne_gatchalian', 'irynne_gatchalian', NULL, 2, 'Active', '2019-02-27 14:39:10', '2019-02-27 14:39:10'),
(5, 5, 'marilyn_isip', 'marilyn_isip', NULL, 2, 'Active', '2019-02-27 14:40:48', '2019-02-27 14:40:48'),
(6, 6, 'demelyn_monzon', 'demelyn_monzon', NULL, 2, 'Active', '2019-02-27 14:41:41', '2019-02-27 14:41:41'),
(7, 7, 'cleotilde_servigon', 'cloetilde_servigon', NULL, 2, 'Active', '2019-02-27 14:42:46', '2019-02-27 14:42:46'),
(8, 8, 'caroline_sumande', 'caroline_sumande', NULL, 2, 'Active', '2019-02-27 14:43:47', '2019-02-27 14:43:47'),
(9, 9, 'roberto_doromal', 'roberto_doromal', NULL, 2, 'Active', '2019-02-27 14:44:48', '2019-02-27 14:44:48'),
(10, 10, 'cristina_abad', 'cristina_abad', NULL, 2, 'Active', '2019-02-27 14:46:02', '2019-02-27 14:46:02'),
(11, 11, 'merly_gonzalbo', 'merly_gonzalbo', 'mbgonzalbo@pup.edu.php', 2, 'Active', '2019-02-27 14:46:38', '2019-02-27 14:46:38'),
(12, 12, 'nandy_liberato', 'nandy_liberato', NULL, 2, 'Active', '2019-02-27 14:47:34', '2019-02-27 14:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `t_document_track`
--

CREATE TABLE `t_document_track` (
  `docu_tr_ID` int(10) NOT NULL,
  `docu_tr_ticket_no` varchar(255) NOT NULL,
  `docu_tr_doctype` int(10) NOT NULL,
  `docu_tr_sourcetype` int(10) NOT NULL,
  `docu_tr_ext_source_desc` varchar(255) DEFAULT NULL,
  `docu_tr_prioritytype` int(10) NOT NULL,
  `docu_tr_count_date_process` varchar(10) NOT NULL,
  `docu_tr_from_office` int(10) NOT NULL,
  `docu_tr_to_office` int(10) DEFAULT NULL,
  `docu_tr_subject` varchar(255) NOT NULL,
  `docu_tr_desc` varchar(255) NOT NULL,
  `docu_tr_closing_remarks` varchar(255) DEFAULT NULL,
  `docu_tr_remarks` varchar(255) DEFAULT NULL,
  `docu_tr_asignatory` varchar(255) NOT NULL,
  `docu_tr_createdby` int(10) NOT NULL,
  `docu_tr_receiver` int(10) DEFAULT NULL,
  `docu_tr_sender` int(10) DEFAULT NULL,
  `docu_tr_closedby` int(10) DEFAULT NULL,
  `docu_tr_reopenedby` int(10) DEFAULT NULL,
  `docu_tr_receiving_stat` varchar(30) DEFAULT NULL,
  `docu_tr_date_create` date NOT NULL,
  `docu_tr_time_create` time NOT NULL,
  `docu_tr_date_sent` date DEFAULT NULL,
  `docu_tr_time_sent` time DEFAULT NULL,
  `docu_tr_date_received` date DEFAULT NULL,
  `docu_tr_time_received` time DEFAULT NULL,
  `docu_tr_date_done` date DEFAULT NULL,
  `docu_tr_time_done` time DEFAULT NULL,
  `docu_tr_date_reopened` date DEFAULT NULL,
  `docu_tr_time_reopened` time DEFAULT NULL,
  `docu_tr_status` varchar(20) NOT NULL DEFAULT 'OPEN',
  `docu_tr_overdue_stat` varchar(10) NOT NULL DEFAULT 'NO',
  `docu_tr_action` varchar(30) NOT NULL,
  `docu_tr_notif_stat` bit(1) NOT NULL DEFAULT b'1',
  `docu_tr_disp_stat` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_document_track`
--

INSERT INTO `t_document_track` (`docu_tr_ID`, `docu_tr_ticket_no`, `docu_tr_doctype`, `docu_tr_sourcetype`, `docu_tr_ext_source_desc`, `docu_tr_prioritytype`, `docu_tr_count_date_process`, `docu_tr_from_office`, `docu_tr_to_office`, `docu_tr_subject`, `docu_tr_desc`, `docu_tr_closing_remarks`, `docu_tr_remarks`, `docu_tr_asignatory`, `docu_tr_createdby`, `docu_tr_receiver`, `docu_tr_sender`, `docu_tr_closedby`, `docu_tr_reopenedby`, `docu_tr_receiving_stat`, `docu_tr_date_create`, `docu_tr_time_create`, `docu_tr_date_sent`, `docu_tr_time_sent`, `docu_tr_date_received`, `docu_tr_time_received`, `docu_tr_date_done`, `docu_tr_time_done`, `docu_tr_date_reopened`, `docu_tr_time_reopened`, `docu_tr_status`, `docu_tr_overdue_stat`, `docu_tr_action`, `docu_tr_notif_stat`, `docu_tr_disp_stat`) VALUES
(1, '201900001', 1, 1, '', 1, '0', 3, 10, 'Application', 'Application for PUPCET', 'for filed', 'signed', 'Meg', 11, 2, 12, 2, NULL, '0', '2019-03-06', '14:34:03', '2019-03-06', '17:25:07', '2019-03-06', '17:28:43', '2019-03-06', '17:28:57', NULL, NULL, 'CLOSED', 'NO', 'Closed', b'0', b'1'),
(2, '201900002', 3, 2, 'CHED', 1, '0', 11, 3, 'Test application', 'Lakbay Aral 2019', NULL, 'Greetings of Peace to All!', 'Meg', 12, 11, 12, NULL, NULL, '0', '2019-03-06', '18:29:14', '2019-03-06', '18:29:53', '2019-03-11', '18:32:45', NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Received', b'0', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `t_document_track_history`
--

CREATE TABLE `t_document_track_history` (
  `docu_tr_his_ID` int(10) NOT NULL,
  `docu_tr_his_ticket_no` varchar(255) NOT NULL,
  `docu_tr_his_doctype` int(10) NOT NULL,
  `docu_tr_his_sourcetype` int(10) NOT NULL,
  `docu_tr_his_ext_source_desc` varchar(255) DEFAULT NULL,
  `docu_tr_his_prioritytype` int(10) NOT NULL,
  `docu_tr_his_count_date_process` varchar(10) NOT NULL,
  `docu_tr_his_from_office` int(10) NOT NULL,
  `docu_tr_his_to_office` int(10) DEFAULT NULL,
  `docu_tr_his_subject` varchar(255) NOT NULL,
  `docu_tr_his_desc` varchar(255) NOT NULL,
  `docu_tr_his_closing_remarks` varchar(255) DEFAULT NULL,
  `docu_tr_his_remarks` varchar(255) DEFAULT NULL,
  `docu_tr_his_asignatory` varchar(255) NOT NULL,
  `docu_tr_his_createdby` int(10) NOT NULL,
  `docu_tr_his_receiver` int(10) DEFAULT NULL,
  `docu_tr_his_sender` int(10) DEFAULT NULL,
  `docu_tr_his_closedby` int(10) DEFAULT NULL,
  `docu_tr_his_reopenedby` int(10) DEFAULT NULL,
  `docu_tr_his_receiving_stat` varchar(30) DEFAULT NULL,
  `docu_tr_his_date_create` date NOT NULL,
  `docu_tr_his_time_create` time NOT NULL,
  `docu_tr_his_date_sent` date DEFAULT NULL,
  `docu_tr_his_time_sent` time DEFAULT NULL,
  `docu_tr_his_date_received` date DEFAULT NULL,
  `docu_tr_his_time_received` time DEFAULT NULL,
  `docu_tr_his_date_done` date DEFAULT NULL,
  `docu_tr_his_time_done` time DEFAULT NULL,
  `docu_tr_his_date_reopened` date DEFAULT NULL,
  `docu_tr_his_time_reopened` time DEFAULT NULL,
  `docu_tr_his_status` varchar(20) NOT NULL DEFAULT 'OPEN',
  `docu_tr_his_overdue_stat` varchar(10) NOT NULL DEFAULT 'NO',
  `docu_tr_his_action` varchar(30) NOT NULL,
  `docu_tr_his_notif_stat` bit(1) NOT NULL DEFAULT b'1',
  `docu_tr_his_disp_stat` bit(1) NOT NULL DEFAULT b'1',
  `docu_tr_his_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_document_track_history`
--

INSERT INTO `t_document_track_history` (`docu_tr_his_ID`, `docu_tr_his_ticket_no`, `docu_tr_his_doctype`, `docu_tr_his_sourcetype`, `docu_tr_his_ext_source_desc`, `docu_tr_his_prioritytype`, `docu_tr_his_count_date_process`, `docu_tr_his_from_office`, `docu_tr_his_to_office`, `docu_tr_his_subject`, `docu_tr_his_desc`, `docu_tr_his_closing_remarks`, `docu_tr_his_remarks`, `docu_tr_his_asignatory`, `docu_tr_his_createdby`, `docu_tr_his_receiver`, `docu_tr_his_sender`, `docu_tr_his_closedby`, `docu_tr_his_reopenedby`, `docu_tr_his_receiving_stat`, `docu_tr_his_date_create`, `docu_tr_his_time_create`, `docu_tr_his_date_sent`, `docu_tr_his_time_sent`, `docu_tr_his_date_received`, `docu_tr_his_time_received`, `docu_tr_his_date_done`, `docu_tr_his_time_done`, `docu_tr_his_date_reopened`, `docu_tr_his_time_reopened`, `docu_tr_his_status`, `docu_tr_his_overdue_stat`, `docu_tr_his_action`, `docu_tr_his_notif_stat`, `docu_tr_his_disp_stat`, `docu_tr_his_timestamp`) VALUES
(1, '201900001', 1, 1, '', 1, '', 3, NULL, 'Application', 'Application for PUPCET', NULL, NULL, 'Meg', 11, NULL, NULL, NULL, NULL, NULL, '2019-03-06', '14:34:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Created', b'1', b'1', '2019-03-06 14:34:03'),
(2, '201900001', 1, 1, '', 1, '0', 3, 11, 'Application', 'Application for PUPCET', NULL, 'forwarded', 'Meg', 11, NULL, 11, NULL, NULL, '1', '2019-03-06', '14:34:03', '2019-03-06', '14:34:24', NULL, NULL, NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Reviewed and Transferred', b'1', b'1', '2019-03-06 14:34:24'),
(3, '201900001', 1, 1, '', 1, '0', 3, 11, 'Application', 'Application for PUPCET', NULL, 'forwarded', 'Meg', 11, 12, 11, NULL, NULL, '1', '2019-03-06', '14:34:03', '2019-03-06', '14:34:24', '2019-03-06', '14:42:15', NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Received', b'1', b'1', '2019-03-06 14:42:15'),
(4, '201900001', 1, 1, '', 1, '0', 3, 10, 'Application', 'Application for PUPCET', NULL, 'signed', 'Meg', 11, NULL, 12, NULL, NULL, '1', '2019-03-06', '14:34:03', '2019-03-06', '17:25:07', NULL, NULL, NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Reviewed and Transferred', b'1', b'1', '2019-03-06 17:25:07'),
(5, '201900001', 1, 1, '', 1, '0', 3, 10, 'Application', 'Application for PUPCET', NULL, 'signed', 'Meg', 11, 2, 12, NULL, NULL, '1', '2019-03-06', '14:34:03', '2019-03-06', '17:25:07', '2019-03-06', '17:28:43', NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Received', b'1', b'1', '2019-03-06 17:28:43'),
(6, '201900001', 1, 1, '', 1, '', 3, NULL, 'Application', 'Application for PUPCET', 'for filed', NULL, 'Meg', 11, NULL, NULL, 2, NULL, '0', '2019-03-06', '14:34:03', NULL, NULL, NULL, NULL, '2019-03-06', '17:28:57', NULL, NULL, 'CLOSED', 'NO', 'Closed', b'1', b'1', '2019-03-06 17:28:57'),
(7, '201900002', 3, 2, 'CHED', 1, '', 11, NULL, 'Test application', 'Lakbay Aral 2019', NULL, NULL, 'Meg', 12, NULL, NULL, NULL, NULL, NULL, '2019-03-06', '18:29:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Created', b'1', b'1', '2019-03-06 18:29:14'),
(8, '201900002', 3, 1, 'CHED', 2, '0', 11, 3, 'Test application', 'Lakbay Aral 2019', NULL, 'Greetings of Peace to All!', 'Meg', 12, NULL, 12, NULL, NULL, '1', '2019-03-06', '18:29:14', '2019-03-06', '18:29:53', NULL, NULL, NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Reviewed and Transferred', b'1', b'1', '2019-03-06 18:29:53'),
(9, '201900002', 3, 1, 'CHED', 2, '5', 11, 3, 'Test application', 'Lakbay Aral 2019', NULL, 'Greetings of Peace to All!', 'Meg', 12, 11, 12, NULL, NULL, '1', '2019-03-06', '18:29:14', '2019-03-06', '18:29:53', '2019-03-11', '18:32:45', NULL, NULL, NULL, NULL, 'OPEN', 'NO', 'Received', b'1', b'1', '2019-03-11 18:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_employees`
--

CREATE TABLE `t_employees` (
  `emp_ID` int(10) NOT NULL,
  `emp_lastname` varchar(100) NOT NULL,
  `emp_middlename` varchar(100) DEFAULT NULL,
  `emp_firstname` varchar(100) NOT NULL,
  `emp_office` int(10) NOT NULL,
  `emp_position` varchar(50) NOT NULL,
  `emp_picture` varchar(255) DEFAULT 'default.png',
  `emp_active_flag` bit(1) NOT NULL DEFAULT b'1',
  `emp_mod_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_employees`
--

INSERT INTO `t_employees` (`emp_ID`, `emp_lastname`, `emp_middlename`, `emp_firstname`, `emp_office`, `emp_position`, `emp_picture`, `emp_active_flag`, `emp_mod_date`) VALUES
(1, 'Balatbat', 'Oro', 'Cristian', 1, 'Member', 'default.png', b'1', '2019-02-27 14:23:44'),
(2, 'Delmo', 'S.', 'Edgardo', 10, 'Director', '', b'1', '2019-02-27 14:35:51'),
(3, 'Gatan', 'B.', 'Doris', 2, 'Head Officer', '', b'1', '2019-02-27 14:37:08'),
(4, 'Gatchalian', 'P. ', 'Irynne', 3, 'Collecting and Disbursing Officer', '', b'1', '2019-02-27 14:39:10'),
(5, 'Isip', 'F.', 'Marilyn', 4, 'Research Coordinator', '', b'1', '2019-02-27 14:40:48'),
(6, 'Monzon', 'E.', 'Demelyn', 5, 'Head Officer', '', b'1', '2019-02-27 14:41:41'),
(7, 'Servigon', 'B.', 'Cleotilde', 6, 'Branch Registrar', '', b'1', '2019-02-27 14:42:46'),
(8, 'Sumande', 'T.', 'Caroline', 7, 'Coordinating Officer', '', b'1', '2019-02-27 14:43:47'),
(9, 'Doromal', 'B.', 'Roberto', 8, 'OIC, Property and Supplies', '', b'1', '2019-02-27 14:44:48'),
(10, 'Abad', 'T.', 'Ma. Cristina', 9, 'OIC, Library', '', b'1', '2019-02-27 14:46:02'),
(11, 'Gonzalbo', 'B.', 'Merly', 3, 'Collecting Officer', '', b'1', '2019-02-27 14:46:38'),
(12, 'Liberta', 'D.R.', 'Hernandez', 11, 'Staff', '', b'1', '2019-02-27 14:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `t_report_bug`
--

CREATE TABLE `t_report_bug` (
  `rb_ID` int(10) NOT NULL,
  `rb_reporter` int(10) NOT NULL,
  `rb_desc` varchar(255) NOT NULL,
  `rb_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_report_bug`
--

INSERT INTO `t_report_bug` (`rb_ID`, `rb_reporter`, `rb_desc`, `rb_timestamp`) VALUES
(1, 12, 'Lakihan ung \"Search\" Box - ipwesto sa ilalim ng title na Trace Document Tickets', '2019-03-06 17:51:06'),
(2, 12, 'Kung cno nagclosed, sxa lang dapat ang pwedeng mag re-open', '2019-03-06 17:51:41'),
(3, 12, 'anong purpose ng \"View Open Ticket\" under Document Tracking?', '2019-03-06 18:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `t_users_log`
--

CREATE TABLE `t_users_log` (
  `log_No` int(200) NOT NULL,
  `log_userID` int(10) NOT NULL,
  `log_usertype` int(10) NOT NULL,
  `log_datestamp` date NOT NULL,
  `log_timestamp` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_users_log`
--

INSERT INTO `t_users_log` (`log_No`, `log_userID`, `log_usertype`, `log_datestamp`, `log_timestamp`) VALUES
(1, 11, 2, '2019-03-06', '13:49:34'),
(2, 12, 2, '2019-03-06', '14:39:33'),
(3, 2, 2, '2019-03-06', '17:28:39'),
(4, 1, 1, '2019-03-06', '17:30:27'),
(5, 12, 2, '2019-03-06', '17:40:29'),
(6, 11, 2, '2019-03-11', '18:32:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_document_type`
--
ALTER TABLE `r_document_type`
  ADD PRIMARY KEY (`docutype_ID`);

--
-- Indexes for table `r_office`
--
ALTER TABLE `r_office`
  ADD PRIMARY KEY (`office_ID`);

--
-- Indexes for table `r_priority_type`
--
ALTER TABLE `r_priority_type`
  ADD PRIMARY KEY (`priority_ID`);

--
-- Indexes for table `r_source_type`
--
ALTER TABLE `r_source_type`
  ADD PRIMARY KEY (`source_ID`);

--
-- Indexes for table `r_user_role`
--
ALTER TABLE `r_user_role`
  ADD PRIMARY KEY (`usr_ID`);

--
-- Indexes for table `t_accounts`
--
ALTER TABLE `t_accounts`
  ADD PRIMARY KEY (`acc_ID`),
  ADD KEY `FK_acc_role` (`acc_user_role`),
  ADD KEY `FK_acc_emp` (`acc_empID`);

--
-- Indexes for table `t_document_track`
--
ALTER TABLE `t_document_track`
  ADD PRIMARY KEY (`docu_tr_ID`),
  ADD UNIQUE KEY `docu_tr_ticket_no` (`docu_tr_ticket_no`),
  ADD KEY `FK_docutype` (`docu_tr_doctype`),
  ADD KEY `FK_sourcetype` (`docu_tr_sourcetype`),
  ADD KEY `FK_priotype` (`docu_tr_prioritytype`),
  ADD KEY `FK_createdby` (`docu_tr_createdby`),
  ADD KEY `FK_receiver` (`docu_tr_receiver`),
  ADD KEY `FK_sender` (`docu_tr_sender`),
  ADD KEY `FK_office_from` (`docu_tr_from_office`),
  ADD KEY `FK_office_to` (`docu_tr_to_office`);

--
-- Indexes for table `t_document_track_history`
--
ALTER TABLE `t_document_track_history`
  ADD PRIMARY KEY (`docu_tr_his_ID`),
  ADD KEY `FK_his_docutype` (`docu_tr_his_doctype`),
  ADD KEY `FK_his_sourcetype` (`docu_tr_his_sourcetype`),
  ADD KEY `FK_his_priotype` (`docu_tr_his_prioritytype`),
  ADD KEY `FK_his_createdby` (`docu_tr_his_createdby`),
  ADD KEY `FK_his_receiver` (`docu_tr_his_receiver`),
  ADD KEY `FK_his_sender` (`docu_tr_his_sender`),
  ADD KEY `FK_his_office_from` (`docu_tr_his_from_office`),
  ADD KEY `FK_his_office_to` (`docu_tr_his_to_office`);

--
-- Indexes for table `t_employees`
--
ALTER TABLE `t_employees`
  ADD PRIMARY KEY (`emp_ID`),
  ADD KEY `FK_emp_off` (`emp_office`);

--
-- Indexes for table `t_report_bug`
--
ALTER TABLE `t_report_bug`
  ADD PRIMARY KEY (`rb_ID`),
  ADD KEY `FK_reporter` (`rb_reporter`);

--
-- Indexes for table `t_users_log`
--
ALTER TABLE `t_users_log`
  ADD PRIMARY KEY (`log_No`),
  ADD KEY `FK_loguserID` (`log_userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_document_type`
--
ALTER TABLE `r_document_type`
  MODIFY `docutype_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `r_office`
--
ALTER TABLE `r_office`
  MODIFY `office_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `r_priority_type`
--
ALTER TABLE `r_priority_type`
  MODIFY `priority_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `r_source_type`
--
ALTER TABLE `r_source_type`
  MODIFY `source_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `r_user_role`
--
ALTER TABLE `r_user_role`
  MODIFY `usr_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_accounts`
--
ALTER TABLE `t_accounts`
  MODIFY `acc_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_document_track`
--
ALTER TABLE `t_document_track`
  MODIFY `docu_tr_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_document_track_history`
--
ALTER TABLE `t_document_track_history`
  MODIFY `docu_tr_his_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_employees`
--
ALTER TABLE `t_employees`
  MODIFY `emp_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_report_bug`
--
ALTER TABLE `t_report_bug`
  MODIFY `rb_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_users_log`
--
ALTER TABLE `t_users_log`
  MODIFY `log_No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_accounts`
--
ALTER TABLE `t_accounts`
  ADD CONSTRAINT `FK_acc_emp` FOREIGN KEY (`acc_empID`) REFERENCES `t_employees` (`emp_ID`),
  ADD CONSTRAINT `FK_acc_role` FOREIGN KEY (`acc_user_role`) REFERENCES `r_user_role` (`usr_ID`);

--
-- Constraints for table `t_document_track`
--
ALTER TABLE `t_document_track`
  ADD CONSTRAINT `FK_createdby` FOREIGN KEY (`docu_tr_createdby`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_docutype` FOREIGN KEY (`docu_tr_doctype`) REFERENCES `r_document_type` (`docutype_ID`),
  ADD CONSTRAINT `FK_office_from` FOREIGN KEY (`docu_tr_from_office`) REFERENCES `r_office` (`office_ID`),
  ADD CONSTRAINT `FK_office_to` FOREIGN KEY (`docu_tr_to_office`) REFERENCES `r_office` (`office_ID`),
  ADD CONSTRAINT `FK_priotype` FOREIGN KEY (`docu_tr_prioritytype`) REFERENCES `r_priority_type` (`priority_ID`),
  ADD CONSTRAINT `FK_receiver` FOREIGN KEY (`docu_tr_receiver`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_sender` FOREIGN KEY (`docu_tr_sender`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_sourcetype` FOREIGN KEY (`docu_tr_sourcetype`) REFERENCES `r_source_type` (`source_ID`);

--
-- Constraints for table `t_document_track_history`
--
ALTER TABLE `t_document_track_history`
  ADD CONSTRAINT `FK_his_createdby` FOREIGN KEY (`docu_tr_his_createdby`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_his_docutype` FOREIGN KEY (`docu_tr_his_doctype`) REFERENCES `r_document_type` (`docutype_ID`),
  ADD CONSTRAINT `FK_his_office_from` FOREIGN KEY (`docu_tr_his_from_office`) REFERENCES `r_office` (`office_ID`),
  ADD CONSTRAINT `FK_his_office_to` FOREIGN KEY (`docu_tr_his_to_office`) REFERENCES `r_office` (`office_ID`),
  ADD CONSTRAINT `FK_his_priotype` FOREIGN KEY (`docu_tr_his_prioritytype`) REFERENCES `r_priority_type` (`priority_ID`),
  ADD CONSTRAINT `FK_his_receiver` FOREIGN KEY (`docu_tr_his_receiver`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_his_sender` FOREIGN KEY (`docu_tr_his_sender`) REFERENCES `t_accounts` (`acc_ID`),
  ADD CONSTRAINT `FK_his_sourcetype` FOREIGN KEY (`docu_tr_his_sourcetype`) REFERENCES `r_source_type` (`source_ID`);

--
-- Constraints for table `t_employees`
--
ALTER TABLE `t_employees`
  ADD CONSTRAINT `FK_emp_off` FOREIGN KEY (`emp_office`) REFERENCES `r_office` (`office_ID`);

--
-- Constraints for table `t_report_bug`
--
ALTER TABLE `t_report_bug`
  ADD CONSTRAINT `FK_reporter` FOREIGN KEY (`rb_reporter`) REFERENCES `t_accounts` (`acc_ID`);

--
-- Constraints for table `t_users_log`
--
ALTER TABLE `t_users_log`
  ADD CONSTRAINT `FK_loguserID` FOREIGN KEY (`log_userID`) REFERENCES `t_accounts` (`acc_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
