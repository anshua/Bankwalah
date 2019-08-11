-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2017 at 07:55 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankwalah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BrID` int(11) NOT NULL,
  `BrLoc` varchar(255) NOT NULL,
  `BrIFSC` varchar(20) NOT NULL,
  `BrOpenDate` date NOT NULL,
  `BrPhone` varchar(20) DEFAULT NULL,
  `BrEmail` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BrID`, `BrLoc`, `BrIFSC`, `BrOpenDate`, `BrPhone`, `BrEmail`) VALUES
(1, 'IIT Bombay, Powai, Mumbai, Maharashtra, 400076', 'BKWL0001001', '1934-10-02', '022-65656545', 'powai@bankwalah.com'),
(2, 'K75, Kankarbagh, Patna, Bihar, 800020', 'BKWL0001002', '1943-10-03', '0612-7656543', 'patnabankwalah@gmail.com'),
(3, 'Xylo Santa, Chennai, Tamil Nadu, 300020', 'BKWL0001003', '1955-10-25', '+91-7898673456', 'xchennai@bankwalah.com'),
(4, 'Uhami Compound, Ramnagar, Bihar, 845106', 'BKWL0001004', '1947-10-02', '06256-768920', 'rambankwalah@gmail.com'),
(5, 'Radhe Marg, Pune, Maharashtra, 420903', 'BKWL0001005', '1956-10-04', '+91-7898764590', 'punebank@bankwalah.com'),
(6, 'BG Mall, Kanpur, Uttar Pradesh, 674523', 'BKWL0001006', '1962-10-08', '+91-9988771234', 'kanpurwala@rediffmail.com'),
(7, 'Gandhi Sarovar, Bhandup, Mumbai, Maharashtra, 450090', 'BKWL0001007', '1971-10-25', '022-90656590', 'bhandupwala@yahoo.com'),
(8, 'King Chan, Chennai, Tamil Nadu, 342123', 'BKWL0001008', '1941-10-08', '+91-9090908989', 'kingchennai@tamilman.com'),
(9, 'Inorbit Mall, Lokhandwala, Mumbai, Maharashtra, 400024', 'BKWL0001009', '1945-10-15', '022-65659090', 'banklokhand@rediffmail.com'),
(10, 'R Mall, Muzaffarpur, Bihar, 820012', 'BKWL0001010', '1966-10-25', '+91-7898768912', 'rmallmuz@rediffmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustID` int(11) NOT NULL,
  `CustName` varchar(255) NOT NULL,
  `CustFName` varchar(255) NOT NULL,
  `CustMName` varchar(255) DEFAULT NULL,
  `CustDOB` date NOT NULL,
  `CustJoinDate` date NOT NULL,
  `CustSex` varchar(20) NOT NULL,
  `CustLAdd` varchar(255) NOT NULL,
  `CustPAdd` varchar(255) DEFAULT NULL,
  `CustPhone` varchar(20) DEFAULT NULL,
  `CustEmail` varchar(255) DEFAULT NULL,
  `CustPAN` varchar(20) DEFAULT NULL,
  `CustAadhaar` varchar(20) DEFAULT NULL,
  `CustBrID` int(11) NOT NULL,
  `CustACType` varchar(20) NOT NULL,
  `CustCurrBal` double(18,2) NOT NULL,
  `CustLog` text,
  `CustLogin` varchar(20) DEFAULT NULL,
  `CustPass` varchar(20) DEFAULT NULL,
  `CustNetBank` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustID`, `CustName`, `CustFName`, `CustMName`, `CustDOB`, `CustJoinDate`, `CustSex`, `CustLAdd`, `CustPAdd`, `CustPhone`, `CustEmail`, `CustPAN`, `CustAadhaar`, `CustBrID`, `CustACType`, `CustCurrBal`, `CustLog`, `CustLogin`, `CustPass`, `CustNetBank`) VALUES
(1, 'Kedar Mansukh', 'Suresh Kaji', 'Suraiya Mansukh', '1977-10-02', '2017-10-25', 'Male', 'K-22, Devi Ghat, Panvel, Mumbai, Maharashtra, 400090', 'Sobhit Apt. R-202, Andheri, Mumbai, Maharashtra, 400090', '022-98783412', 'kdr@mansukh.com', 'ZASWE2345Z', '909080807070', 1, 'Saving', 11000.00, 'Mole on Left Cheek', NULL, '', 'No'),
(2, 'Laila Bhavani', 'Shivam Rai', 'Shobha Rai', '1981-10-01', '2017-10-25', 'Female', 'Angithi, Suiya Pahar, Jharkhand, 600078', 'Hari Road, Bhopal, Madhya Pradesh, 707022', '+91-8723239089', 'laila@bhavani.com', 'ZSAER4523S', '231276450927', 1, 'Saving', 11000.00, 'Cut Mark on Left Hand', NULL, '', 'No'),
(3, 'Suresh Agrawal', 'Suraj Mall', 'Ansika Dixit', '1979-10-01', '2017-10-25', 'Male', 'Devi Ghat, Ranchi, Jharkhand, 600978', 'Harihar Bhavan, Setora Park, Jammu-Kashmir, 223498', '+91-8765129830', 'sagrawal@gmail.com', 'ASQWX9998R', '123499007878', 4, 'Current', 8000.00, 'Mole on Chin', 'suresh', 'suresh123', 'No'),
(4, 'Salma Begum', 'Alfaz Ahmad', 'Sabina Khatoon', '1992-10-05', '2017-10-11', 'Female', 'Sonbahar, Silayche, Gangtok, Sikkim, 200912', 'K-567, J B Road, Jhansi, Uttar Pradesh, 342398', '0689-3981238', 'salmakhatoon@bankwalah.com', 'AZMNK2345S', '900012346543', 2, 'Current', 50000.00, 'Cut Mark On Wrist', NULL, '', 'No'),
(5, 'Rishi Diswah', 'Manoj Diswah', 'Hema Diswah', '1967-10-08', '2017-10-25', 'Male', 'Huma Adlabs, Kanjur Marg, Mumbai, Maharashtra, 400072', 'Saket Nagar, Muzaffarpur, Bihar, 452387', '02435-786523', 'rishi@bandit.com', 'ZASDE1234B', '123409873456', 1, 'Current', 6000.00, 'Mole on Forehead', NULL, '', 'No'),
(6, 'Priyanka Dixit', 'Santosh Kumar', 'Babita Devi', '1982-10-16', '2017-10-25', 'Female', 'Harmandir Sahib, Amritsar, Punjab, 200300', 'Jadavpur University, Kolkata, West Bengal, 420056', '+91-8723239034', 'priyanka@boltol.com', 'XZCVB4567Y', '909066663333', 4, 'Saving', 70000.00, 'Cut Mark on Left Arm', NULL, '', 'No'),
(7, 'Sangam Kukreza', 'Tussar Agrawal', 'Dimmy Devi', '1988-10-10', '2017-10-25', 'Male', 'Sichay Pahar, Lucknow, Uttar Pradesh, 456456', 'Kesav Vihar, Tingipur, Andaman-Nicobar, 567111', '+91-8765121212', 'sangamkuk@bhavani.com', 'XCVBN3456W', '111123456543', 4, 'FD', 20000.00, 'Polio on Leg', NULL, '', 'No'),
(8, 'Nikki Mukherjee', 'Avinash Kapoor', 'Sita Kapoor', '1967-10-01', '2017-10-25', 'Female', 'Tinpulwa, Mithapur, Patna, Bihar, 800001', 'Sakshi Apt. K-345, Mourya Lok, Patna, Bihar, 800020', '0612-6542348', 'nikki@golabari.com', 'MKJNH9876T', '777765439999', 4, 'Saving', 3500.00, 'Mole on Palm', NULL, '', 'No'),
(9, 'Kedar Malhotra', 'Lokesh Malhotra', 'Tina Devi', '1972-10-01', '2017-10-09', 'Male', 'Patanjali Bhavan, Bhagalpur, Bihar, 545466', 'Anjan Sadan, K-98, Someshwar, Bihar, 498978', '+91-7634239834', 'kedardear@gmail.com', 'AZXCV5676W', '121234349090', 2, 'Saving', 70000.00, 'Cut Mark on Left Thumb', NULL, '', 'No'),
(10, 'Sunita Choudhary', 'Gungun Choudhary', 'Gunja Devi', '1956-10-01', '2017-10-15', 'Male', 'G40, Anwesha, Jharkhand, 600044', 'Hari Tola, Kolkata, West Bengal, 420056', '+91-4723239072', 'sunsun@gmail.com', 'ANJHP5678X', '111199995555', 1, 'Current', 25000.00, 'Mole on Palm', NULL, '', 'No'),
(11, 'Pinky Chhabra', 'Rohan Kumar', 'Manju Devi', '1987-10-08', '2017-10-09', 'Male', 'S-52, Tarana Gali, Trivendram, Kerala, 700988', 'Joshi Street, B-55, Haryana, 546790', '+91-8723239033', 'pintu@gmail.com', 'ASQWX9998D', '345611110000', 2, 'RD', 500000.00, 'Bent Hand', NULL, '', 'No'),
(12, 'Amar Sinha', 'Govind Kumar', 'Meena Devi', '1993-10-03', '2017-10-26', 'Male', 'G-42, Hathua Market, Delihi, 893467', 'Nilay Apt. Kisori Bazar, 503, Surat, Gujarata, 905611', '+91-8723239022', 'amar@kingud.com', 'QLPKJ6578F', '999966661000', 3, 'Saving', 59000.00, 'Cut on Hands', NULL, '', 'No'),
(13, 'Abhay Keshav', 'Gurmeet Keshav', 'Ranjhana Devi', '1967-10-01', '2017-10-26', 'Male', 'Gorakhnath Temple, Gorakhpur, Uttar Pradesh, 116456', 'Hariyala Ghat, T-455, Punjab, 336790', '+91-7634439833', 'abhay@kingud.com', 'LPNUJ4567Z', '666611112323', 3, 'Saving', 50000.00, 'Half Hand', NULL, '', 'No'),
(14, 'Kavita Bhargav', 'Gopal Gokhale', 'Reshma Gokhale', '1967-10-08', '2017-10-02', 'Female', 'Saxena Tower, Amritsar, Punjab, 300078', 'Shyam Benegal Theatre, Kolkata, West Bengal, 420056', '+91-8723239000', 'kavita@kingud.com', 'ASBNH8989Z', '898911110909', 5, 'Current', 30000.00, 'Very Tall', NULL, '', 'No'),
(15, 'Pintu Verma', 'Guddu Verma', 'Sunanda Verma', '1965-10-10', '2017-10-26', 'Male', 'T-233, Kalyan, Mumbai, Maharashtra, 400070', 'Abhay Marg, Worli West, Mumbai, Maharashtra, 400074', '+91-8723239876', 'pintu@kedarnath.com', 'ZXMNB8787T', '111100005555', 5, 'Saving', 400000.00, '', NULL, '', 'No'),
(16, 'Anju Kapoor', 'Arun Kapoor', 'Seema Gupta', '1986-10-01', '2017-10-26', 'Female', 'Kindergarten, Tunki, Gangtok, Sikkim, 200987', 'Soya Street, Hizab, C-345, Gangtok, Sikkim, 300987', '08765-872312', 'anju@sara.com', 'QWLKJ5555C', '222211119090', 6, 'Saving', 3000.00, 'Mole on Palm', NULL, '', 'No'),
(17, 'Kunal Hemu', 'Deepak Meena', 'Shreya Meena', '1955-10-01', '2017-10-26', 'Male', 'Harbour Road, Ranchi, Jharkhand, 500978', 'Harbour Road, Ranchi, Jharkhand, 500978', '07867-900012', 'kunal@kingud.com', 'KULWA7878T', '111165651212', 6, 'Saving', 50000.00, '', NULL, '', 'No'),
(18, 'Kavita Arya', 'Kavi Arya', 'Sunita Arya', '1978-10-01', '2017-10-26', 'Female', 'Dola T-55, Amritsar, Punjab, 200399', 'BD Howard Lane, Kolkata, West Bengal, 420056', '+91-7634239850', 'kkavita@sara.com', 'QWERT9898U', '121245450909', 7, 'Saving', 9000.00, 'Mole on Palm', NULL, '', 'No'),
(19, 'Hira Singh', 'Totla Singh', 'Matki Singh', '1971-10-15', '2017-10-26', 'Male', 'Dev Anand Complex, Ranchi, Jharkhand, 600955', 'Dev Anand Complex, Ranchi, Jharkhand, 600955', '08989-565623', 'hira@mansukh.com', 'QWERT7777B', '121290908787', 2, 'Saving', 50000.00, '', NULL, '', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmpID` int(11) NOT NULL,
  `EmpName` varchar(255) NOT NULL,
  `EmpFName` varchar(255) NOT NULL,
  `EmpMName` varchar(255) DEFAULT NULL,
  `EmpDOB` date NOT NULL,
  `EmpJoinDate` date NOT NULL,
  `EmpSex` varchar(20) NOT NULL,
  `EmpLAdd` varchar(255) NOT NULL,
  `EmpPAdd` varchar(255) DEFAULT NULL,
  `EmpPhone` varchar(20) DEFAULT NULL,
  `EmpEmail` varchar(255) DEFAULT NULL,
  `EmpPAN` varchar(20) DEFAULT NULL,
  `EmpAadhaar` varchar(20) DEFAULT NULL,
  `EmpBrID` int(11) NOT NULL,
  `EmpRole` varchar(20) NOT NULL,
  `EmpLogin` varchar(20) NOT NULL,
  `EmpPass` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmpID`, `EmpName`, `EmpFName`, `EmpMName`, `EmpDOB`, `EmpJoinDate`, `EmpSex`, `EmpLAdd`, `EmpPAdd`, `EmpPhone`, `EmpEmail`, `EmpPAN`, `EmpAadhaar`, `EmpBrID`, `EmpRole`, `EmpLogin`, `EmpPass`) VALUES
(1, 'TRANSFER', 'RANSOMWARE', 'IIT BOMBAY', '2017-10-02', '2017-10-02', 'Other', 'CSE, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', 'CSE, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', '022-99887766', 'transfer@iitb.ac.in', 'ABCDE4444F', '112233445566', 1, 'Administrator', 'transfer', 'transfer123'),
(2, 'ATM', 'RANSOMWARE', 'IIT BOMBAY', '2017-10-03', '2017-10-03', 'Other', 'CSE, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', 'CSE, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', '022-99887700', 'atm@iitb.ac.in', 'ABCDE4444G', '112233445577', 1, 'Administrator', 'atm', 'atm123'),
(10, 'Ashish Chandra', 'Chandra Dev Prasad', 'Sharada Devi', '1990-12-25', '2017-10-03', 'Male', 'H2/8, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', 'Uhami Compound, Ramnagar, Bihar, 845106', '+91-9155743478', 'ashishcdev@gmail.com', 'ABCDE9999G', '902233445512', 1, 'Administrator', 'ashish', 'ashish123'),
(11, 'Deepesh Meena', 'Rahul Meena', 'Sumitra Devi', '1994-12-09', '2017-10-03', 'Male', 'H3/129, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', 'Kalam Road, Jaipur, Rajasthan, 228765', '+91-9100908955', 'deepsm@gmail.com', 'ABCDE9449G', '802233445512', 2, 'Manager', 'deepesh', 'deepesh123'),
(12, 'Anshu Ahirwar', 'Ramlochan Ahirwar', 'Asha Devi', '1994-02-09', '2017-10-03', 'Male', 'H7/22, IIT BOMBAY, Powai, Mumbai, Maharashtra, 400076', 'Singh Palace, Kanpur, Uttar Pradesh, 454567', '+91-9100908987', 'anshua@gmail.com', 'PBCDE9049T', '702255445590', 6, 'Clerk', 'anshu', 'anshu123'),
(13, 'Amrita Kapoor', 'Surya Nath Kapoor', 'Salvi Devi', '1989-10-10', '2017-10-04', 'Female', 'K-45, Lake Ping, Andheri, Mumbai, Maharashtra, 400054', 'Vasu Vihar, Bettiah, Bihar, 845104', '+91-9034751091', 'amritak@bankwalah.com', 'ASDCV2345T', '111199994444', 1, 'Manager', 'amrita', 'amrita123'),
(14, 'Kavita Mahato', 'Dilip Mahato', 'Mamata Devi', '1996-10-02', '2017-10-10', 'Female', 'Ram Mohan Seminary, Udaipur, Rajasthan, 342398', 'Y-398, Anand Vihar, Delhi, 110090', '+91-9012721904', 'kav@kavla.com', 'BNMJK2344X', '123400007890', 2, 'Clerk', 'kavita', 'kavita123'),
(15, 'Simmy Tesla', 'Abhinav Tesla', 'Anandi Tesla', '1987-10-22', '2017-10-26', 'Female', 'Singh Chat House, Udaipur, Rajasthan, 342309', 'Singh Chat House, Udaipur, Rajasthan, 342309', '09876-456723', 'simmy@kwador.com', 'ZASDF9898T', '111167672222', 2, 'Clerk', 'simmy', 'simmy123');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TrID` int(11) NOT NULL,
  `TrDateTime` datetime NOT NULL,
  `TrRemarks` varchar(255) DEFAULT NULL,
  `TrCustID` int(11) NOT NULL,
  `TrEmpID` int(11) NOT NULL,
  `TrAmount` double(18,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TrID`, `TrDateTime`, `TrRemarks`, `TrCustID`, `TrEmpID`, `TrAmount`) VALUES
(1, '2017-10-26 01:19:48', 'Account Opening Balance', 1, 10, 5000.00),
(2, '2017-10-26 01:56:29', 'Account Opening Balance', 2, 10, 12000.00),
(3, '2017-10-26 02:13:59', 'Account Opening Balance', 3, 10, 8000.00),
(4, '2017-10-26 02:18:09', 'Account Opening Balance', 4, 10, 45000.00),
(5, '2017-10-26 02:21:52', 'Account Opening Balance', 5, 10, 6000.00),
(6, '2017-10-26 02:51:33', 'Account Opening Balance', 6, 10, 70000.00),
(7, '2017-10-26 03:01:20', 'Account Opening Balance', 7, 10, 20000.00),
(8, '2017-10-26 03:02:16', 'Account Opening Balance', 8, 10, 3500.00),
(9, '2017-10-26 04:20:48', 'Sent to ID 1 (Kedar Mansukh) 2K for Birthday', 2, 10, -2000.00),
(10, '2017-10-26 04:20:48', 'Received from ID 2 (Laila Bhavani) 2K for Birthday', 1, 10, 2000.00),
(11, '2017-10-26 04:28:49', 'Cash Withdraw', 4, 10, -5000.00),
(12, '2017-10-26 06:12:04', 'Account Opening Balance', 9, 10, 75000.00),
(13, '2017-10-26 06:20:26', 'Wathdraw 4K For Personal Use', 9, 10, -4000.00),
(14, '2017-10-26 08:22:09', 'Account Opening Balance', 10, 10, 25000.00),
(15, '2017-10-26 08:29:31', 'Account Opening Balance', 11, 10, 525000.00),
(16, '2017-10-26 10:43:53', 'Account Opening Balance', 12, 10, 9000.00),
(17, '2017-10-26 10:49:44', 'Account Opening Balance', 13, 10, 50000.00),
(18, '2017-10-26 10:55:48', 'Account Opening Balance', 14, 10, 30000.00),
(19, '2017-10-26 11:01:57', 'Account Opening Balance', 15, 10, 450000.00),
(20, '2017-10-26 11:09:08', 'Account Opening Balance', 16, 10, 9000.00),
(21, '2017-10-26 11:12:48', 'Account Opening Balance', 17, 10, 12000.00),
(22, '2017-10-26 11:16:46', 'Account Opening Balance', 18, 10, 9000.00),
(23, '2017-10-26 11:21:04', 'Sent to ID 12 (Amar Sinha) 50K FOR FEE', 15, 10, -50000.00),
(24, '2017-10-26 11:21:04', 'Received from ID 15 (Pintu Verma) 50K FOR FEE', 12, 10, 50000.00),
(25, '2017-10-26 11:27:40', 'Sent to ID 4 (Salma Begum) For Soes', 9, 11, -1000.00),
(26, '2017-10-26 11:27:40', 'Received from ID 9 (Kedar Malhotra) For Soes', 4, 11, 1000.00),
(27, '2017-10-26 11:28:36', 'Cash Withdraw', 11, 11, -25000.00),
(28, '2017-10-26 11:33:24', 'Account Opening Balance', 19, 11, 60000.00),
(29, '2017-10-26 11:39:26', 'Sent to ID 4 (Salma Begum) 10K For Suit', 19, 11, -10000.00),
(30, '2017-10-26 11:39:26', 'Received from ID 19 (Hira Singh) 10K For Suit', 4, 11, 10000.00),
(31, '2017-10-26 11:40:51', 'Cash Withdraw', 4, 11, -1000.00),
(32, '2017-10-26 11:43:35', 'Cash Deposit', 17, 12, 4000.00),
(33, '2017-10-26 11:45:32', 'Sent to ID 16 (Anju Kapoor) 1K For Gift', 17, 12, -1000.00),
(34, '2017-10-26 11:45:32', 'Received from ID 17 (Kunal Hemu) 1K For Gift', 16, 12, 1000.00),
(35, '2017-10-26 11:46:23', 'Cash Deposit', 16, 12, 8000.00),
(36, '2017-10-26 11:48:42', 'Sent to ID 17 (Kunal Hemu) 2K For Toys', 16, 12, -2000.00),
(37, '2017-10-26 11:48:42', 'Received from ID 16 (Anju Kapoor) 2K For Toys', 17, 12, 2000.00),
(38, '2017-10-26 14:40:06', 'Sent to ID 17 (Kunal Hemu) GIFT', 16, 12, -3000.00),
(39, '2017-10-26 14:40:06', 'Received from ID 16 (Anju Kapoor) GIFT', 17, 12, 3000.00),
(40, '2017-10-26 14:41:47', 'Sent to ID 17 (Kunal Hemu) 3K', 16, 12, -30000.00),
(41, '2017-10-26 14:41:47', 'Received from ID 16 (Anju Kapoor) 3K', 17, 12, 30000.00),
(42, '2017-10-26 17:13:00', 'Cash Deposit', 16, 10, 20000.00),
(43, '2017-10-27 05:57:31', 'Cash Withdraw', 1, 10, -1000.00),
(44, '2017-10-27 06:49:25', 'Wathdraw 500 For Personal Use', 1, 10, -500.00),
(45, '2017-10-27 08:58:42', 'Cash Deposit', 1, 10, 6500.00),
(46, '2017-10-28 21:53:02', 'Sent to ID 2 (Laila Bhavani) 1K For Shoes', 1, 10, -1000.00),
(47, '2017-10-28 21:53:02', 'Received from ID 1 (Kedar Mansukh) 1K For Shoes', 2, 10, 1000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BrID`),
  ADD UNIQUE KEY `BrID` (`BrID`),
  ADD UNIQUE KEY `BrIFSC` (`BrIFSC`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustID`),
  ADD UNIQUE KEY `CustID` (`CustID`),
  ADD UNIQUE KEY `CustLogin` (`CustLogin`),
  ADD KEY `CustBrID` (`CustBrID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmpID`),
  ADD UNIQUE KEY `EmpID` (`EmpID`),
  ADD UNIQUE KEY `EmpLogin` (`EmpLogin`),
  ADD UNIQUE KEY `EmpPAN` (`EmpPAN`),
  ADD UNIQUE KEY `EmpAadhaar` (`EmpAadhaar`),
  ADD KEY `EmpBrID` (`EmpBrID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TrID`),
  ADD UNIQUE KEY `TrID` (`TrID`),
  ADD KEY `TrCustID` (`TrCustID`),
  ADD KEY `TrEmpID` (`TrEmpID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
