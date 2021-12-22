-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 04:33 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi171401117`
--

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `id` int(11) NOT NULL,
  `prime_p` int(11) NOT NULL,
  `prime_q` int(11) NOT NULL,
  `pubkey_n` int(11) NOT NULL,
  `pubkey_e` int(11) NOT NULL,
  `private_key` int(11) NOT NULL,
  `message_digest` varchar(255) NOT NULL,
  `signv_id` varchar(255) NOT NULL,
  `sign_value` varchar(255) NOT NULL,
  `sign_byID` int(11) NOT NULL,
  `sign_by` varchar(255) NOT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `pdf_newname` varchar(255) NOT NULL,
  `user_received` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `time_k` float NOT NULL,
  `time_s` float NOT NULL,
  `process_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signature`
--

INSERT INTO `signature` (`id`, `prime_p`, `prime_q`, `pubkey_n`, `pubkey_e`, `private_key`, `message_digest`, `signv_id`, `sign_value`, `sign_byID`, `sign_by`, `pdf_name`, `pdf_newname`, `user_received`, `date`, `time_k`, `time_s`, `process_time`) VALUES
(1, 193, 773, 149189, 5, 29645, 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', '598113587', '23a6:7d33:c13e:136a5:a8c3:20d4d:14af3:1ed20:daaf:99fb:e442:117d7:1074e:20f3a:342a:1357c', 34, 'Aryadd820', 'file4.pdf', 'Aryadd820_20211130-234134_file4.pdf', 'Dias1999', '2021-12-01 05:41:34', 0.00199199, 0.266062, 0.268054),
(15, 499, 503, 250997, 5, 199997, '70dc424b5f75c3bad4c37c323c05224d5211333070e365033ebab82795218848', '137881609411', '201a6:264c3:20f17:11bca:30953:21825:2ad7f:2c462:d038:3c1d8:32dae:24e51:11c2d:14b1a:1b0d7:29521', 36, 'Duta200899', 'file2.pdf', 'Duta200899_20211201-003428_file2.pdf', 'Aryadd820', '2021-12-01 06:34:29', 0.0131791, 1.12212, 1.1353),
(16, 499, 503, 250997, 5, 199997, '5b023cae3acd0bca7909618e8423e7930f8b10d0c63dad7f67d355ced30ad62f', '49790762624', 'b97c:2be80:11261:2ee92:2f575:39634:1cf8f:80b4:1c20a:b0ba:edf2:1c2ea:afe6:c9cf:1d05d:3b6b8', 36, 'Duta200899', 'file3.pdf', 'Duta200899_20211201-003438_file3.pdf', 'Aryadd820', '2021-12-01 06:34:39', 0.0155101, 1.10495, 1.12046),
(17, 499, 503, 250997, 5, 199997, 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', '174797758907', '28b2c:221bb:134bc:20f5:1c20a:29376:3c1f2:78c0:28dfb:215d6:16aec:6b8a:2b9e1:99fa:8ae3:2614a', 36, 'Duta200899', 'file4.pdf', 'Duta200899_20211201-003557_file4.pdf', 'Dias1999', '2021-12-01 06:35:58', 0.0120189, 1.1167, 1.12872),
(18, 499, 503, 250997, 5, 199997, 'e2c68d6afe41600248f1b9f7aa8fd092a18d02495976868240c2ba46653be2d7', '56225923995', 'd175:3839b:8104:39f3a:311b1:39626:9f68:848d:38648:2b341:1c720:201dd:2ae60:285b6:9098:3814b', 36, 'Duta200899', 'file5.pdf', 'Duta200899_20211201-003625_file5.pdf', 'Dias1999', '2021-12-01 06:36:27', 0.0113049, 1.22298, 1.23428),
(22, 499, 503, 250997, 5, 199997, 'f622c748f95bbe0c3900fdfc98f3d73457c965c22d7f836340da1ba5c7ead733', '151812966657', '2358c:20901:13dac:38cc4:19b0c:34e91:122bf:22f7e:f681:11521:3c1db:17078:669d:23d86:179c8:2614a', 34, 'Aryadd820', 'file1.pdf', 'Aryadd820_20211201-095343_file1.pdf', 'Dias1999', '2021-12-01 15:53:44', 0.0115399, 1.05856, 1.0701),
(23, 839, 353, 296167, 3, 196651, '248675d8c488ade8a0901193bf3d75dab93f62b0676aa469bbeceb0d3aaa8cf0', '15779556542', '3ac88:ecbe:1c1f7:26996:48078:e480:fe56:af36:2fece:25ea5:3c69c:2d99c:45797:3c0ab:18541:1dfc2', 34, 'Aryadd820', 'file6.pdf', 'Aryadd820_20211206-034013_file6.pdf', 'Dias1999', '2021-12-06 09:40:15', 0.0150559, 1.48048, 1.49554),
(24, 653, 587, 383311, 3, 254715, '248675d8c488ade8a0901193bf3d75dab93f62b0676aa469bbeceb0d3aaa8cf0', '253712719810', '3b127:4dfc2:2b15c:3af12:51bf3:f42a:41ef4:2df8:4b79e:9811:4aeb4:1252e:191b0:d89:1c609:3fff4', 34, 'Aryadd820', 'file6.pdf', 'Aryadd820_20211206-034051_file6.pdf', 'Dias1999', '2021-12-06 09:40:53', 0.016788, 1.90013, 1.91692),
(25, 499, 503, 250997, 5, 199997, '248675d8c488ade8a0901193bf3d75dab93f62b0676aa469bbeceb0d3aaa8cf0', '218708989906', '32ec1:257d2:32ce7:37591:2c3ab:2a173:862e:19532:14093:2649c:32f86:362f:a6cc:212fc:1d2bb:3c3e9', 34, 'Aryadd820', 'file6.pdf', 'Aryadd820_20211206-034309_file6.pdf', 'Dias1999', '2021-12-06 09:43:11', 0.0153689, 1.50623, 1.5216),
(26, 719, 631, 453689, 11, 246731, 'a1ced2e4615226e6a2e8668595a1c2d21319c95a77db8775c1de25e4d2135f76', '317864447544', '4a023:28e38:ac17:68421:2bf4c:2788:30ec7:64b98:4ffc3:50157:391ba:3ebca:c50c:6967c:a20:30226', 35, 'Dias1999', '161402062.pdf', 'Dias1999_20211208-062418_161402062.pdf', 'Aryadd820', '2021-12-08 12:24:19', 0.015183, 1.2891, 1.30428),
(27, 769, 641, 492929, 7, 421303, '2bd5f852367a1a7b42e899cf6901434320562c71d18878e9d8d69c3d1af0e262', '494564186159', '73265:2982f:b36a:724b:6c52:5590f:69a34:2bf4f:615d1:4be80:4fe66:67342:3b818:36c51:12e68:63d81', 34, 'Aryadd820', 'PERSETUJUAN_171401117.pdf', 'Aryadd820_20211216-143148_PERSETUJUAN_171401117.pdf', '', '2021-12-16 20:31:51', 0.037766, 3.23777, 3.27553);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(34, 'Arya', 'Aryadd820', 'arya@mail.com', '$2y$10$lIuHDn.8LvRC6nknJx/JOebuq7oIbUPftUW2xF3SuQhAPaPyTjNQu'),
(35, 'Dias', 'Dias1999', 'dias@mail.com', '$2y$10$CizB32K9zRTpt7CFqjwYmuIJShnPGK1SNo9T3T0azNB5HMPBkle5q'),
(36, 'Duta', 'Duta200899', 'duta@mail.com', '$2y$10$XdZenlgN07gYRL1Kt9j1VOMR/TniiZlIHI8Olo5m/u90nHgq7NN1m'),
(37, 'Tzuyu', 'Tzuyu123', 'tzuyu@gmail.com', '$2y$10$tifAimPxnSXThtBbUWDlwu1ptOYLaHZKxWR/Vq5EIOSWH.In7ULh2'),
(38, 'Dias', 'Arya12456', 'dsa@mail.com', '$2y$10$pz4jUjgwMagip79.cdzKjOrLSYzhy5U0mMIZ9igR24YR25zl7mNFO');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `sign_id` varchar(255) NOT NULL,
  `received_id` int(11) DEFAULT NULL,
  `sender_uname` varchar(255) DEFAULT NULL,
  `pubkey_n` int(11) DEFAULT NULL,
  `pubkey_e` int(11) DEFAULT NULL,
  `message_digest` varchar(255) DEFAULT NULL,
  `signv_id` varchar(255) DEFAULT NULL,
  `sign_value` varchar(255) DEFAULT NULL,
  `sign_by` varchar(255) DEFAULT NULL,
  `ver_value` varchar(255) DEFAULT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `pdf_newname` varchar(255) NOT NULL,
  `validation` enum('Not Verified','Valid','Not Valid') NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `process_time` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `sign_id`, `received_id`, `sender_uname`, `pubkey_n`, `pubkey_e`, `message_digest`, `signv_id`, `sign_value`, `sign_by`, `ver_value`, `pdf_name`, `pdf_newname`, `validation`, `date`, `process_time`) VALUES
(1, '1', 35, 'Aryadd820', 149189, 5, 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', '598113587', '23a6:7d33:c13e:136a5:a8c3:20d4d:14af3:1ed20:daaf:99fb:e442:117d7:1074e:20f3a:342a:1357c', 'Aryadd820', 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', 'file4.pdf', 'Aryadd820_20211130-234134_file4.pdf', 'Valid', '2021-12-01 05:41:34', 0.0678461),
(2, '1', 36, NULL, 149189, 5, 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', '598113587', '23a6:7d33:c13e:136a5:a8c3:20d4d:14af3:1ed20:daaf:99fb:e442:117d7:1074e:20f3a:342a:1357c', 'Aryadd820', 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', 'Aryadd820_20211130-234134_file4.pdf', '(20211130-235200)Aryadd820_20211130-234134_file4.pdf', 'Valid', '2021-12-01 05:52:00', 0.115341),
(4, '1', 36, NULL, 149189, 5, '9d0a723b40f67ee0ade0abc626c7b8b354b5f36ed19ff71e092776cba77dc3ad', '598113587', '23a6:7d33:c13e:136a5:a8c3:20d4d:14af3:1ed20:daaf:99fb:e442:117d7:1074e:20f3a:342a:1357c', 'Aryadd820', 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', 'Aryadd820_20211130-234134_file4.pdf', '(20211130-235943)Aryadd820_20211130-234134_file4.pdf', 'Not Valid', '2021-12-01 05:59:43', 0.175154),
(18, '15', 34, 'Duta200899', 250997, 5, '70dc424b5f75c3bad4c37c323c05224d5211333070e365033ebab82795218848', '137881609411', '201a6:264c3:20f17:11bca:30953:21825:2ad7f:2c462:d038:3c1d8:32dae:24e51:11c2d:14b1a:1b0d7:29521', 'Duta200899', '70dc424b5f75c3bad4c37c323c05224d5211333070e365033ebab82795218848', 'file2.pdf', 'Duta200899_20211201-003428_file2.pdf', 'Valid', '2021-12-01 06:34:29', 0.00667715),
(19, '16', 34, 'Duta200899', 250997, 5, '5b023cae3acd0bca7909618e8423e7930f8b10d0c63dad7f67d355ced30ad62f', '49790762624', 'b97c:2be80:11261:2ee92:2f575:39634:1cf8f:80b4:1c20a:b0ba:edf2:1c2ea:afe6:c9cf:1d05d:3b6b8', 'Duta200899', '5b023cae3acd0bca7909618e8423e7930f8b10d0c63dad7f67d355ced30ad62f', 'file3.pdf', 'Duta200899_20211201-003438_file3.pdf', 'Valid', '2021-12-01 06:34:39', 0.0148339),
(20, '17', 35, 'Duta200899', 250997, 5, 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', '174797758907', '28b2c:221bb:134bc:20f5:1c20a:29376:3c1f2:78c0:28dfb:215d6:16aec:6b8a:2b9e1:99fa:8ae3:2614a', 'Duta200899', 'a3a5d838eb6674110f8bf9633e587c06fba7e78652b903f563020abf5243d733', 'file4.pdf', 'Duta200899_20211201-003557_file4.pdf', 'Valid', '2021-12-01 06:35:58', 0.050648),
(21, '18', 35, 'Duta200899', 250997, 5, 'e2c68d6afe41600248f1b9f7aa8fd092a18d02495976868240c2ba46653be2d7', '56225923995', 'd175:3839b:8104:39f3a:311b1:39626:9f68:848d:38648:2b341:1c720:201dd:2ae60:285b6:9098:3814b', 'Duta200899', 'e2c68d6afe41600248f1b9f7aa8fd092a18d02495976868240c2ba46653be2d7', 'file5.pdf', 'Duta200899_20211201-003625_file5.pdf', 'Valid', '2021-12-01 06:36:27', 0.098496),
(25, '22', 35, 'Aryadd820', 250997, 5, 'f622c748f95bbe0c3900fdfc98f3d73457c965c22d7f836340da1ba5c7ead733', '151812966657', '2358c:20901:13dac:38cc4:19b0c:34e91:122bf:22f7e:f681:11521:3c1db:17078:669d:23d86:179c8:2614a', 'Aryadd820', 'f622c748f95bbe0c3900fdfc98f3d73457c965c22d7f836340da1ba5c7ead733', 'file1.pdf', 'Aryadd820_20211201-095343_file1.pdf', 'Valid', '2021-12-01 15:53:44', 0.00440216),
(26, '23', 35, 'Aryadd820', NULL, NULL, NULL, '15779556542', '3ac88:ecbe:1c1f7:26996:48078:e480:fe56:af36:2fece:25ea5:3c69c:2d99c:45797:3c0ab:18541:1dfc2', NULL, NULL, 'file6.pdf', 'Aryadd820_20211206-034013_file6.pdf', 'Not Verified', '2021-12-06 09:40:15', NULL),
(27, '24', 35, 'Aryadd820', NULL, NULL, NULL, '253712719810', '3b127:4dfc2:2b15c:3af12:51bf3:f42a:41ef4:2df8:4b79e:9811:4aeb4:1252e:191b0:d89:1c609:3fff4', NULL, NULL, 'file6.pdf', 'Aryadd820_20211206-034051_file6.pdf', 'Not Verified', '2021-12-06 09:40:53', NULL),
(28, '25', 35, 'Aryadd820', NULL, NULL, NULL, '218708989906', '32ec1:257d2:32ce7:37591:2c3ab:2a173:862e:19532:14093:2649c:32f86:362f:a6cc:212fc:1d2bb:3c3e9', NULL, NULL, 'file6.pdf', 'Aryadd820_20211206-034309_file6.pdf', 'Not Verified', '2021-12-06 09:43:11', NULL),
(29, '26', 34, 'Dias1999', 453689, 11, 'a1ced2e4615226e6a2e8668595a1c2d21319c95a77db8775c1de25e4d2135f76', '317864447544', '4a023:28e38:ac17:68421:2bf4c:2788:30ec7:64b98:4ffc3:50157:391ba:3ebca:c50c:6967c:a20:30226', 'Dias1999', 'a1ced2e4615226e6a2e8668595a1c2d21319c95a77db8775c1de25e4d2135f76', '161402062.pdf', 'Dias1999_20211208-062418_161402062.pdf', 'Valid', '2021-12-08 12:24:19', 0.0417771),
(30, '27', 0, 'Aryadd820', NULL, NULL, NULL, '494564186159', '73265:2982f:b36a:724b:6c52:5590f:69a34:2bf4f:615d1:4be80:4fe66:67342:3b818:36c51:12e68:63d81', NULL, NULL, 'PERSETUJUAN_171401117.pdf', 'Aryadd820_20211216-143148_PERSETUJUAN_171401117.pdf', 'Not Verified', '2021-12-16 20:31:51', NULL),
(31, '27', 35, NULL, 492929, 7, '2b7a5799a733ed59b47c276283ebd05a3817da7a6ab8f926097dcad9132559ea', '494564186159', '73265:2982f:b36a:724b:6c52:5590f:69a34:2bf4f:615d1:4be80:4fe66:67342:3b818:36c51:12e68:63d81', 'Aryadd820', '2bd5f852367a1a7b42e899cf6901434320562c71d18878e9d8d69c3d1af0e262', 'Aryadd820_20211216-143148_PERSETUJUAN_171401117.pdf', '(20211216-144048)Aryadd820_20211216-143148_PERSETUJUAN_171401117.pdf', 'Not Valid', '2021-12-16 20:40:48', 0.0476661);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
