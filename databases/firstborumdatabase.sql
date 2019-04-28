-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2019 at 04:22 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firstborumdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT '0',
  `forum_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `user_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` longtext,
  `date_entered` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `parent_id`, `forum_id`, `user_id`, `subject`, `body`, `date_entered`) VALUES
(1, 0, 1, 1, 'What is life?', 'What IS life?', '2019-03-29 20:21:32'),
(2, 0, 1, 6, 'What are the origins of Boron?', '', '2019-03-31 12:29:57'),
(3, 0, 1, 6, 'Who discovered Boron and how did they discover it?', '', '2019-03-31 12:31:38'),
(4, 0, 1, 6, 'How many different species of boars are there?', 'There are many species of boars. But exactly how many species are known?', '2019-03-31 12:33:59'),
(5, 0, 1, 6, 'How do you make Borax?', 'Please give me a step by step instruction', '2019-03-31 18:19:20'),
(6, 0, 1, 1, 'What are the uses of Boron?', '', '2019-04-03 18:34:48'),
(7, 0, 1, 9, 'BORing topic: Is water wet?', 'This question has plagued scientists for many decades. Please give me peace of mind by explaining your view on the topic.', '2019-04-06 10:19:37'),
(8, 0, 1, 15, 'Is it pronounced data, or data', 'You see how you read that in your head in 2 different ways. Cool, right!', '2019-04-09 09:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `bio` longtext NOT NULL,
  `pass` char(128) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `profile_picture` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `bio`, `pass`, `registration_date`, `profile_picture`) VALUES
(1, 'Savita', 'Singh', 'savitasinghmd@gmail.com', '', 'd057b529023967329fb3f54209af36373e6620e730756189733c24f482aa84a3351b46b303f48d85d18e9915996f4f802e4a3282ab7b288d395eb8d1bd0fd9a6', '2019-03-18 17:56:53', '20130202_133758.jpg'),
(2, 'Manav', 'Singh', 'manavcubed@gmail.com', '', '6e2fb53a5d8ab718e860f27c061c3f8442d3dbb5ab178d2c1a72aaab78f1615213e62d654a9b4d9d9570362e4b05b72add4219cfbf8127401ba8b435fc702cee', '2019-03-18 18:06:22', 'Pi Cubed (1).jpg'),
(8, 'Niraj', 'Singh', 'niraj_us_india@yahoo.com', '', '5446b59ce8a7212724beceeb82b316ae360f5d27aa8287f0ecd20bf6cc6fb924622c4e4832c5702581d1e2a8d2670e589221315f6b0ee5b120ebffda885bfe6b', '2019-04-04 17:25:59', 'borum profile picture.jpg'),
(4, 'Garcia', 'Flynn', 'garcia.flynn@hotmail.com', '', '77a4a0e5a07605130bb5dac8cd1e5e842f656d6a07a8aff229a13e71c68242cd5e37de51013b84cdd273669982454b94f72d83e33137bd96a6d2bb0198d2e8ad', '2019-03-19 13:45:50', 'N4.jpg'),
(5, 'NIHAL', 'BANKULLA', 'hello@hi', '', 'a542dabf0f585444fc4e40bfd052a974b60ead4eaa73bf52d698fc4fa6244a1a43d47d6e0f45bb5d4c25f5654d7f19ca3b8733bf440b52e642949a8f76d6fce4', '2019-03-26 11:58:47', NULL),
(6, 'Varun', 'Singh', 'VSpoet49@gmail.com', 'Hello. I am Varun Singh, the creator and administrator of bforborum. You can view the website\'s code on GitHub, my profiles on social networks from GitHub, and my actual website all oer here! I like to play chess, program, and play tennis.', '4facb53060c498f74ca2bf7e45e497dc3cbbae8d58dee9dd7b64b6c90c9ed5ea390df7e55e36353fcd8013813edfe9e686ade0b2c54128045e9d1c0e4752af1c', '2019-03-26 12:05:53', 'Doorbell.jpg'),
(7, 'Paulo', 'Grasse', 'paulograsse@gmail.com', '', '62670d1e1eea06b6c975e12bc8a16131b278f6d7bcbe017b65f854c58476baba86c2082b259fd0c1310935b365dc40f609971b6810b065e528b0b60119e69f61', '2019-03-29 11:37:17', '3d_awesome_face_by_espeorb.png'),
(9, 'Daniel', 'Porotov', 'dalepor15@gmail.com', '', 'e7647002901a8d47931c70b51e5ab762ade08d0a1c5d89b1a58fc638949485a3906c4a656d9fd3a831781f77213195f75e8b636f288253b2e440d97d8f4b5e75', '2019-04-06 10:06:59', 'Ducky_Head_Web_Low-Res.jpg'),
(10, 'Noamo', 'Abrahama', 'noamoabrahama@gmail.com', '', '1f86c769b319d953ab017153897f602b2fac6b73b4e64bf942085bd03c414c203c9030d47f33b937c9a3e30ed3764cf60eecbfd4e2284b736302fa837f8751c4', '2019-04-06 18:37:42', NULL),
(11, 'Davido', 'Hargya', 'davidohargya@gmail.com', '', '733c8373edc5d58c828d4050aa493529731547eeed2bb9c3ca57da790c61171446adf27ee828e7337791b59a91dff30e9de1ce878b725dc8a4622e1e68c63f07', '2019-04-07 17:28:10', NULL),
(12, 'Community', 'Moderator', 'varunsingh87@yahoo.com', '', 'b8474ff280f9a804057ce0b5055919345244f0abe0184a583d903fec09786913011ede0bd7b753b1866b1dc85bbfccf6844f49721f5dec27e506e5c5d2ffc216', '2019-04-07 17:28:56', NULL),
(13, 'Michaelo', 'Yesepankoo', 'jwithjolly@gmail.com', '', 'a118060ba3c0671b36005f785c818fd68e3478a91497019daa8cfa52dffe496445dbdbb4f0db6389056f4d26da4eb6bec5a3e3797de83649afb8f4eec5ace6dd', '2019-04-07 17:34:25', NULL),
(14, 'niraj', 'singh', 'mrnirajsingh@yahoo.com', '', '5446b59ce8a7212724beceeb82b316ae360f5d27aa8287f0ecd20bf6cc6fb924622c4e4832c5702581d1e2a8d2670e589221315f6b0ee5b120ebffda885bfe6b', '2019-04-07 17:42:45', NULL),
(15, 'Victor', 'Linetsky', 'victorlinetsky38@gmail.com', '', 'd0fc78dd4ee644dd744ef1fadb8647b9dfb796a3f69ab6d00fc8ca7ce09ac6fa8fbd3b8eac1a9b332dc722fd10c1788a74d5b48bc85d83d005158a70e64dce06', '2019-04-09 09:33:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
