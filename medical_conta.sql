-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2021 at 11:29 AM
-- Server version: 5.7.33
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_conta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `nume`, `email`, `parola`) VALUES
(1, 'FELIX', 'felix_szekely@yahoo.com', 'b713605fdbd5c86c5491484efa631507'),
(2, 'Rares', 'office@medicalpubit.ro', '0df48cfdaed81fd59e12dbafef9685d7');

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

CREATE TABLE `categorii` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`ID`, `nume`) VALUES
(3, 'Electronice'),
(4, 'Cadouri'),
(6, 'Mobila'),
(7, 'Auto'),
(8, 'Servicii'),
(10, '');

-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE `comenzi` (
  `ID` int(255) NOT NULL,
  `partener` int(255) NOT NULL,
  `factura` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comenzi`
--

INSERT INTO `comenzi` (`ID`, `partener`, `factura`) VALUES
(11, 16, 'Factura11.pdf'),
(12, 18, 'Factura12.pdf'),
(13, 18, 'Factura13.pdf'),
(14, 18, 'Factura14.pdf'),
(15, 18, 'Factura15.pdf'),
(19, 16, 'Factura19.pdf'),
(18, 18, 'Factura18.pdf'),
(20, 18, 'Factura20.pdf'),
(21, 18, 'Factura21.pdf'),
(22, 18, 'Factura22.pdf'),
(23, 18, 'Factura23.pdf'),
(24, 17, 'Factura24.pdf'),
(25, 18, 'Factura25.pdf'),
(26, 17, 'Factura26.pdf'),
(27, 17, 'Factura27.pdf'),
(28, 18, 'Factura28.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `conturi`
--

CREATE TABLE `conturi` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tip` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conturi`
--

INSERT INTO `conturi` (`ID`, `nume`, `email`, `pass`, `tip`) VALUES
(2, 'Cont 1', 'cont1', 'be673e458602de2bf8b22bcc456b5c7d', 0),
(8, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(4, 'FELIX', 'felix_szekely@yahoo.com', '0c4a2e6d29ec26e0237b0fe153c0f008', 0),
(5, 'Rares', 'office@medicalpubit.ro', '0df48cfdaed81fd59e12dbafef9685d7', 0),
(9, 'Tudor', 'tudorcimpean@wedev-it.com', 'c362ae45e4fecc8749d350a18fa09cfd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `crearecomenzi`
--

CREATE TABLE `crearecomenzi` (
  `ID` int(255) NOT NULL,
  `id_produs` int(255) NOT NULL,
  `cantitate` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crearecomenzi`
--

INSERT INTO `crearecomenzi` (`ID`, `id_produs`, `cantitate`) VALUES
(94, 0, 0),
(95, 0, 0),
(96, 0, 0),
(97, 0, 0),
(98, 0, 0),
(99, 0, 0),
(100, 0, 0),
(101, 0, 0),
(102, 0, 0),
(103, 0, 0),
(104, 0, 0),
(105, 0, 0),
(106, 0, 0),
(107, 0, 0),
(108, 0, 0),
(109, 0, 0),
(110, 0, 0),
(111, 0, 0),
(112, 0, 0),
(113, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `datefirma`
--

CREATE TABLE `datefirma` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `oras` varchar(255) NOT NULL,
  `judet` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cui` varchar(255) NOT NULL,
  `rc` varchar(255) NOT NULL,
  `banca` varchar(255) NOT NULL,
  `cont1` varchar(255) NOT NULL,
  `cont2` varchar(255) NOT NULL,
  `cont3` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `capital_social` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datefirma`
--

INSERT INTO `datefirma` (`ID`, `nume`, `adresa`, `oras`, `judet`, `email`, `cui`, `rc`, `banca`, `cont1`, `cont2`, `cont3`, `logo`, `capital_social`, `telefon`) VALUES
(1, 'MEDICALPUBIT SRL', 'NICOLAE TITULESCU 31/28', 'CLUJ-NAPOCA', 'CLUJ', 'rares_soanca@yahoo.co.uk', 'RO 33628746', 'J12/2806/26.09.2014', 'BT', 'RO19BTRLRONCRT0477621301', '', '', '', '200 RON', '0720959441');

-- --------------------------------------------------------

--
-- Table structure for table `facturi_chitante`
--

CREATE TABLE `facturi_chitante` (
  `ID` int(255) NOT NULL,
  `id_comanda` bigint(255) NOT NULL,
  `partener` int(255) NOT NULL,
  `chitanta_factura` varchar(255) NOT NULL,
  `data_ora` int(255) NOT NULL,
  `incasat` float(255,2) NOT NULL,
  `platit` float(255,2) NOT NULL,
  `tip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facturi_chitante`
--

INSERT INTO `facturi_chitante` (`ID`, `id_comanda`, `partener`, `chitanta_factura`, `data_ora`, `incasat`, `platit`, `tip`) VALUES
(40, 11, 16, 'Factura11.pdf', 1568742552, 5476.86, 0.00, 'factura'),
(41, 18, 18, 'Factura18.pdf', 1568747435, 1927.80, 0.00, 'factura'),
(42, 12, 18, 'Factura12.pdf', 1568747485, 2737.00, 0.00, 'factura'),
(43, 13, 18, 'Factura13.pdf', 1568747508, 1499.83, 0.00, 'factura'),
(45, 11, 16, 'Chitanta11.pdf', 1569946958, 49291.70, 0.00, 'chitanta'),
(46, 11, 16, 'Chitanta2.pdf', 1569947127, 49291.70, 0.00, 'chitanta'),
(47, 11, 16, 'Chitanta3.pdf', 1569947166, 49291.70, 0.00, 'chitanta'),
(48, 11, 16, 'Chitanta4.pdf', 1569947780, 49291.70, 0.00, 'chitanta'),
(49, 11, 16, 'Proforma11.pdf', 1569948133, 49291.70, 0.00, 'proforma'),
(50, 21, 18, 'Proforma21.pdf', 1570710494, 163.17, 0.00, 'proforma'),
(51, 21, 18, 'Chitanta5.pdf', 1570716736, 163.17, 0.00, 'chitanta'),
(52, 21, 18, 'Factura21.pdf', 1570716784, 163.17, 0.00, 'factura'),
(53, 22, 18, 'Proforma22.pdf', 1570719217, 1190.00, 0.00, 'proforma'),
(54, 22, 18, 'Factura22.pdf', 1570719324, 1190.00, 0.00, 'factura'),
(55, 24, 17, 'Proforma24.pdf', 1570736375, 3570.00, 0.00, 'proforma'),
(56, 24, 17, 'Factura24.pdf', 1570736527, 3570.00, 0.00, 'factura'),
(57, 24, 17, 'Chitanta6.pdf', 1570736537, 3570.00, 0.00, 'chitanta'),
(58, 25, 18, 'Factura25.pdf', 1571645622, 2559.10, 0.00, 'factura'),
(59, 25, 18, 'Proforma25.pdf', 1572182553, 2559.10, 0.00, 'proforma'),
(60, 20, 18, 'Proforma20.pdf', 1572182563, 1774.81, 0.00, 'proforma'),
(61, 15, 18, 'Proforma15.pdf', 1572184863, 1905.43, 0.00, 'proforma'),
(62, 14, 18, 'Factura14.pdf', 1572184870, 8980.93, 0.00, 'factura'),
(63, 12, 18, 'Chitanta7.pdf', 1572184875, 2737.00, 0.00, 'chitanta'),
(64, 25, 18, 'Chitanta8.pdf', 1572350015, 2559.10, 0.00, 'chitanta'),
(65, 23, 18, 'Proforma23.pdf', 1572350360, 600.33, 0.00, 'proforma'),
(66, 20, 18, 'Factura20.pdf', 1573321564, 1774.81, 0.00, 'factura'),
(67, 15, 18, 'Factura15.pdf', 1573499335, 1905.43, 0.00, 'factura'),
(68, 23, 18, 'Factura23.pdf', 1573499379, 600.33, 0.00, 'factura'),
(69, 26, 17, 'Proforma26.pdf', 1573499548, 2618.00, 0.00, 'proforma'),
(70, 27, 17, 'Proforma27.pdf', 1577532995, 189.21, 0.00, 'proforma'),
(71, 27, 17, 'Factura27.pdf', 1577533324, 189.21, 0.00, 'factura'),
(72, 19, 16, 'Proforma19.pdf', 1577533331, 1785.00, 0.00, 'proforma'),
(73, 28, 18, 'Factura28.pdf', 1580284845, 178.50, 0.00, 'factura'),
(74, 28, 18, 'Chitanta9.pdf', 1580284917, 178.50, 0.00, 'chitanta'),
(75, 0, 0, 'Chitanta10.pdf', 1583559741, 0.00, 0.00, 'chitanta'),
(76, 0, 0, 'Proforma.pdf', 1583559759, 0.00, 0.00, 'proforma'),
(77, 0, 0, 'Factura.pdf', 1583559764, 0.00, 0.00, 'factura'),
(78, 18, 18, 'Proforma18.pdf', 1615823266, 1790.95, 0.00, 'proforma'),
(79, 28, 18, 'Proforma28.pdf', 1615823290, 0.00, 0.00, 'proforma'),
(80, 19, 16, 'Factura19.pdf', 1615823507, 0.00, 0.00, 'factura');

-- --------------------------------------------------------

--
-- Table structure for table `mijloace`
--

CREATE TABLE `mijloace` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `cantitate` int(255) NOT NULL,
  `numar_inventar` varchar(255) NOT NULL,
  `data_adaugarii` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mijloace`
--

INSERT INTO `mijloace` (`ID`, `nume`, `cantitate`, `numar_inventar`, `data_adaugarii`) VALUES
(2, 'Scaun', 5, '00456662', 1563832800),
(3, 'Canapea', 1, '0058', 1563905539),
(4, 'Birou', 2, '0045', 1564206596),
(9, 'Laptop', 1, '3', 1573499932),
(11, '', 0, '', 0),
(12, '', 0, '', 0),
(13, '', 0, '', 0),
(14, '', 0, '', 0),
(15, '', 0, '', 0),
(16, '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parteneri`
--

CREATE TABLE `parteneri` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `oras` varchar(255) NOT NULL,
  `judet` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `cui` varchar(255) NOT NULL,
  `rc` varchar(255) NOT NULL,
  `banca` varchar(255) NOT NULL,
  `cont_bancar` varchar(255) NOT NULL,
  `persoana_contact` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parteneri`
--

INSERT INTO `parteneri` (`ID`, `nume`, `email`, `telefon`, `oras`, `judet`, `adresa`, `cui`, `rc`, `banca`, `cont_bancar`, `persoana_contact`) VALUES
(18, 'ENERGO POWER SRL', 'elena.pascu@gmail.com', '0728968688', 'Petrosani', 'Giurgiu', 'STR. COSTACHE NEGRI 2-4 Ap. 1 Cod 400407', 'RO21779923 ', 'J12/2292/2007', 'BRD', 'RO81BTRLRONCRT210980921XX', 'Elena Vasilescu'),
(16, 'VEVERITA VEA SRL', 'contact@veveritav.ro', '0751929345', 'Cluj-Napoca', 'Cluj', 'Strada Fabricii, Nr. 8', '38797209', 'J12/3248/2009', 'Transilvania', 'fsdafdsfds', 'Rares Maier'),
(17, 'ASADO CONSULT SRL', 'asado@upcnet.ro', '0256345003', 'TIMISOARA', 'TIMIS', 'CALEA MARTIRILOR 80 Et. 1 Ap. 6 Cod 300776', 'RO14505054 ', 'J35/310/2002', 'BCR', 'RO81BTRLRONCRT210980921XX', 'Dumitru Alex'),
(20, '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE `produse` (
  `ID` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `pret` decimal(65,2) NOT NULL,
  `stoc` int(255) NOT NULL,
  `descriere` longtext NOT NULL,
  `id_cat` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`ID`, `nume`, `pret`, `stoc`, `descriere`, `id_cat`) VALUES
(16, 'Birou MK2', 150.50, 39, 'Birou Frumos', 6),
(21, 'Telefon Samsung s30', 150.00, 1, 'defect: Ã©cran spart', 8),
(23, '', 0.00, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produse_comenzi`
--

CREATE TABLE `produse_comenzi` (
  `ID` int(255) NOT NULL,
  `id_comanda` int(255) NOT NULL,
  `id_produs` int(255) NOT NULL,
  `cantitate` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produse_comenzi`
--

INSERT INTO `produse_comenzi` (`ID`, `id_comanda`, `id_produs`, `cantitate`) VALUES
(66, 4, 5, 300),
(65, 3, 6, 500),
(64, 2, 5, 100),
(63, 1, 5, 100),
(67, 5, 5, 200),
(68, 6, 5, 100),
(69, 6, 6, 10),
(70, 7, 5, 100),
(71, 7, 6, 5),
(72, 8, 5, 100),
(73, 8, 6, 10),
(74, 9, 5, 100),
(75, 9, 6, 10),
(76, 10, 5, 100),
(77, 10, 6, 30),
(78, 11, 11, 20),
(79, 11, 14, 20),
(80, 12, 11, 20),
(81, 13, 11, 7),
(82, 13, 13, 5),
(83, 13, 14, 3),
(84, 14, 16, 50),
(85, 14, 13, 1),
(86, 15, 11, 2),
(87, 15, 13, 10),
(88, 15, 14, 10),
(89, 18, 11, 1),
(90, 18, 16, 10),
(91, 19, 17, 1),
(231, 11, 11, 20),
(230, 11, 14, 20),
(229, 11, 14, 20),
(228, 11, 11, 20),
(227, 11, 11, 20),
(226, 11, 14, 20),
(225, 11, 14, 20),
(224, 11, 11, 20),
(223, 11, 11, 20),
(222, 11, 14, 20),
(221, 11, 14, 20),
(220, 11, 11, 20),
(219, 11, 11, 20),
(218, 11, 14, 20),
(217, 11, 14, 20),
(216, 11, 11, 20),
(215, 20, 13, 5),
(214, 20, 14, 12),
(280, 28, 22, 1),
(279, 27, 13, 2),
(278, 27, 11, 1),
(277, 26, 20, 1),
(276, 26, 18, 1),
(275, 25, 18, 2),
(274, 25, 16, 1),
(273, 24, 18, 3),
(272, 23, 14, 4),
(271, 23, 13, 2),
(270, 22, 18, 1),
(269, 21, 14, 1),
(268, 21, 13, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categorii`
--
ALTER TABLE `categorii`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conturi`
--
ALTER TABLE `conturi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crearecomenzi`
--
ALTER TABLE `crearecomenzi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `datefirma`
--
ALTER TABLE `datefirma`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `facturi_chitante`
--
ALTER TABLE `facturi_chitante`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mijloace`
--
ALTER TABLE `mijloace`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parteneri`
--
ALTER TABLE `parteneri`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `produse_comenzi`
--
ALTER TABLE `produse_comenzi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorii`
--
ALTER TABLE `categorii`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `conturi`
--
ALTER TABLE `conturi`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `crearecomenzi`
--
ALTER TABLE `crearecomenzi`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `datefirma`
--
ALTER TABLE `datefirma`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facturi_chitante`
--
ALTER TABLE `facturi_chitante`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `mijloace`
--
ALTER TABLE `mijloace`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `parteneri`
--
ALTER TABLE `parteneri`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `produse_comenzi`
--
ALTER TABLE `produse_comenzi`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
