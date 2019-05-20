-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2019 at 03:04 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 7.2.7

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
CREATE DATABASE IF NOT EXISTS `firstborumdatabase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `firstborumdatabase`;

--
-- Truncate table before insert `messages`
--

TRUNCATE TABLE `messages`;
--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `parent_id`, `forum_id`, `user_id`, `subject`, `body`, `date_entered`) VALUES
(2, 0, 1, 6, 'What are the origins of Boron?', '', '2019-03-31 12:29:57'),
(3, 0, 1, 6, 'Who discovered Boron and how did they discover it?', '', '2019-03-31 12:31:38'),
(4, 0, 3, 6, 'How many different species of boars are there?', 'There are many species of boars. But exactly how many species are known?', '2019-03-31 12:33:59'),
(5, 0, 2, 6, 'How do you make Borax?', 'Please give me a step by step instruction', '2019-03-31 18:19:20'),
(7, 0, 4, 9, 'BORing topic: Is water wet?', 'This question has plagued scientists for many decades. Please give me peace of mind by explaining your view on the topic.', '2019-04-06 10:19:37'),
(14, 7, NULL, 6, NULL, 'No water is not wet.', '2019-04-25 18:13:33'),
(11, 7, NULL, 6, NULL, 'Yes. Water is indeed wet. Mr. Hogan said so and I said so. There is no doubting it after that has been confirmed! Here is the science: water molecules in a water compound are always touching other molecules made up of 2 Hydrogen atoms and 1 Oxygen atom chemically bonded with chemical energy. This makes each of these water molecules wet, thereby making the entire compound of water, wet.', '2019-04-24 18:50:40'),
(12, 3, NULL, 9, NULL, 'Boron was discovered by a team of three scientists: Humphry Davy, Louis Jacques Thenard, and Joseph Louis Gay-Lussac on June 30, 1808.', '2019-04-25 14:16:43'),
(15, 0, 5, 4, 'What\'s the difference between a boreal, tropical, temperate, and deciduous forest?', 'What is the difference? Can they overlap? For example, can a biome be tropical AND deciduous?', '2019-05-13 17:47:29'),
(16, 0, 9, 2, 'Who was Robert Bork', 'I see that a topic is called Bork. After research on Google, I found that this was a name short for Robert Bork, a Republican judge. Why is he so significant?', '2019-05-13 17:48:28'),
(17, 0, 6, 9, 'What are the boroughs and how many are there in NYC?', 'I already know the answer. I just wanted to fill a topic.', '2019-05-14 16:17:53'),
(18, 17, NULL, 4, NULL, 'New York City encompasses five county-level administrative divisions called boroughs: The Bronx, Brooklyn, Manhattan, Queens, and Staten Island. All boroughs are part of New York City, and each of the boroughs is coextensive with a respective county, the primary administrative subdivision within New York state. Queens and the Bronx are concurrent with the counties of the same name, while Manhattan, Brooklyn, and Staten Island correspond to New York, Kings, and Richmond counties respectively.\r\nSource: [Wikepedia](https://en.wikipedia.org/wiki/Boroughs_of_New_York_City)', '2019-05-15 15:16:50'),
(19, 0, 8, 4, 'Why can\'t we see the Aurora Borealis everyday in the night sky?', 'An aurora is a natural light display in the Earth\'s sky. It is the result of disturbances in the magnetosphere. How can one predict when there will be disturbances in the magnetosphere? Is there always an Aurora Borealis when there are these disturbances?', '2019-05-15 15:20:39'),
(20, 0, 10, 4, 'Is it borrowing to take something without someone\'s permission and return it without them knowing?', 'Is it borrowing to take something belonging to someone else without his or her permission and return it without him or her knowing?', '2019-05-15 15:22:01'),
(21, 0, 9, 4, 'Where did Robert Bork live?', 'Where did Robert Bork live? In a boreal forest? In the country?', '2019-05-15 15:23:08'),
(22, 21, NULL, 17, NULL, 'Boring Pittsburgh, Pennsylvania', '2019-05-20 08:05:38'),
(23, 0, 1, 17, 'What does the suffix -borg mean?', 'Ex. cyborg, seaborg(ium), etc.', '2019-05-20 08:07:42'),
(24, 2, NULL, 17, NULL, 'Hm.. Let\'s see. Ok Google, what are the origins of Boron? According to Google Home (buy today), \"According to rxlist.com, \'Boron is a mineral that is found in food and the environment. People take boron supplements as medicine. Boron is used for building strong bones, treating osteoarthritis, as an aid for building muscles and increasing testosterone levels, and for improving thinking skills and muscle coordination.\'\"', '2019-05-20 08:09:34'),
(25, 4, NULL, 17, NULL, 'There are nineteen known species of boars (also known as the Suidae family) discovered by humans. Some possibly familiar ones are wild boars (Sus scrofa) and common warthogs (Phacochoerus africanus). However, you might not have known that domestic pigs (Sus scrofa domesticus) are considered boars, or that there is a type of boar called the pygmy hog (Porcula salvania)!\r\n\r\nHere is the list of all known species of boars:\r\n\r\n- Domestic pigs (Sus scrofa domesticus)\r\n- Wild boars (Sus scrofa)\r\n- Palawan bearded pigs (Sus ahoenobarbus)\r\n- Bornean bearded pigs (Sus barbatus)\r\n- Visayan warty pigs (Sus cebifrons)\r\n- Sulawesi warty pigs (Sus celebensis)\r\n- Mindoro warty pigs (Sus oliveri)\r\n- Philippine warty pigs (Sus philippensis)\r\n- Javan warty pigs (Sus verrucosus)\r\n- Pygmy hogs (Porcula salvania)\r\n- Giant forest hogs (Hylochoerus meinertzhageni)\r\n- Bushpig (Potamochoerus larvatus)\r\n- Red river hogs (Potamochoerus porcus)\r\n- Common warthogs (Phacochoerus africanus)\r\n- Desert warthogs (Phacochoerus aethiopicus)\r\n- Moluccan babirusas (Babyrousa babyrussa)\r\n- Bola Batu babirusas (Babyrousa bolabatuensis)\r\n- North Sulawesi babirusas (Babyrousa celebensis)\r\n- Togian babirusas (Babyrousa togeanensis)', '2019-05-20 08:25:16'),
(26, 7, NULL, 17, NULL, 'However, to counteract Varun\'s argument, I propose the theory of dark matter. If dark matter does, indeed, exist, then this energy form would interrupt the chemical bond between these atoms. However, we know that all atoms have a chemical bond in a compound, right? So, what if that chemical energy that creates the bond between atoms is a direct result of energy transfer from dark matter to chemical energy? This would mean the chemical bond was indirectly formed and therefore water is not wet.', '2019-05-20 08:30:29'),
(27, 20, NULL, 17, NULL, 'No, because you do not know if they are dependent on it at the same exact time you happen to take it. Asking for permission is a more cautious and mindful approach.', '2019-05-20 08:32:26'),
(28, 19, NULL, 17, NULL, 'Using prior knowledge, my best guess would be the photon particles produced from the collision between the sun\'s charged particles and the atmosphere\'s gas molecules that make up northern lights are not visible everyday because these charged particles are generally produced from the sun\'s solar flares. Since these flares are not consistent and the charged particles take time to travel through space, you will generally not see an aurora borealis everyday.', '2019-05-20 11:23:47'),
(29, 0, 10, 6, 'What would you consider is impolite for someone to borrow?', 'There are numerous things people borrow. What would you consider are the top 10 things that are fine to borrow and not fine to borrow?', '2019-05-20 14:57:04');

--
-- Truncate table before insert `topics`
--

TRUNCATE TABLE `topics`;
--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`) VALUES
(1, 'Boron'),
(2, 'Borax'),
(3, 'Boars'),
(4, 'Boring-Topics'),
(5, 'Boreal-Forests'),
(6, 'Boroughs'),
(7, 'Borohydride'),
(8, 'Aurora-Borealis'),
(9, 'Bork'),
(10, 'Borrowing'),
(11, 'Borescopes'),
(12, 'Boronia'),
(13, 'Borzoi'),
(14, 'Borking');

--
-- Truncate table before insert `user-message-votes`
--

TRUNCATE TABLE `user-message-votes`;
--
-- Dumping data for table `user-message-votes`
--

INSERT INTO `user-message-votes` (`id`, `user_id`, `message_id`, `vote`) VALUES
(1, 4, 7, 1),
(5, 6, 4, 1),
(9, 6, 7, 1),
(13, 17, 2, 1),
(14, 17, 4, 1),
(15, 17, 14, 1),
(16, 17, 11, -1),
(17, 17, 7, 1),
(18, 17, 20, 1),
(19, 17, 21, 1),
(20, 17, 17, 1),
(21, 17, 18, 1),
(22, 17, 16, 1),
(23, 6, 25, 1);

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `bio`, `pass`, `registration_date`, `profile_picture`) VALUES
(1, 'Savita', 'Singh', 'savitasinghmd@gmail.com', '', 'd057b529023967329fb3f54209af36373e6620e730756189733c24f482aa84a3351b46b303f48d85d18e9915996f4f802e4a3282ab7b288d395eb8d1bd0fd9a6', '2019-03-18 17:56:53', '20130202_133758.jpg'),
(2, 'Manav', 'Singh', 'manavcubed@gmail.com', '', '6e2fb53a5d8ab718e860f27c061c3f8442d3dbb5ab178d2c1a72aaab78f1615213e62d654a9b4d9d9570362e4b05b72add4219cfbf8127401ba8b435fc702cee', '2019-03-18 18:06:22', 'Pi Cubed (1).jpg'),
(8, 'Niraj', 'Singh', 'niraj_us_india@yahoo.com', '', '5446b59ce8a7212724beceeb82b316ae360f5d27aa8287f0ecd20bf6cc6fb924622c4e4832c5702581d1e2a8d2670e589221315f6b0ee5b120ebffda885bfe6b', '2019-04-04 17:25:59', 'borum profile picture.jpg'),
(4, 'Garcia', 'Flynn', 'garcia.flynn@hotmail.com', '', '77a4a0e5a07605130bb5dac8cd1e5e842f656d6a07a8aff229a13e71c68242cd5e37de51013b84cdd273669982454b94f72d83e33137bd96a6d2bb0198d2e8ad', '2019-03-19 13:45:50', 'clock-147257_960_720.png'),
(5, 'NIHAL', 'BANKULLA', 'hello@hi', '', 'a542dabf0f585444fc4e40bfd052a974b60ead4eaa73bf52d698fc4fa6244a1a43d47d6e0f45bb5d4c25f5654d7f19ca3b8733bf440b52e642949a8f76d6fce4', '2019-03-26 11:58:47', NULL),
(6, 'Varun', 'Singh', 'VSpoet49@gmail.com', 'Hello. I am Varun Singh, the creator and administrator of bforborum. You can view the website\'s code on GitHub, my profiles on social networks from GitHub, and my actual website all oer here! I like to play chess, program, and play tennis.', '4facb53060c498f74ca2bf7e45e497dc3cbbae8d58dee9dd7b64b6c90c9ed5ea390df7e55e36353fcd8013813edfe9e686ade0b2c54128045e9d1c0e4752af1c', '2019-03-26 12:05:53', 'GoogleProfilePicture.jpg'),
(7, 'Paulo', 'Grasse', 'paulograsse@gmail.com', '', '62670d1e1eea06b6c975e12bc8a16131b278f6d7bcbe017b65f854c58476baba86c2082b259fd0c1310935b365dc40f609971b6810b065e528b0b60119e69f61', '2019-03-29 11:37:17', '3d_awesome_face_by_espeorb.png'),
(9, 'Daniel', 'Porotov', 'dalepor15@gmail.com', '', 'e7647002901a8d47931c70b51e5ab762ade08d0a1c5d89b1a58fc638949485a3906c4a656d9fd3a831781f77213195f75e8b636f288253b2e440d97d8f4b5e75', '2019-04-06 10:06:59', 'Ducky_Head_Web_Low-Res.jpg'),
(10, 'Noamo', 'Abrahama', 'noamoabrahama@gmail.com', '', '1f86c769b319d953ab017153897f602b2fac6b73b4e64bf942085bd03c414c203c9030d47f33b937c9a3e30ed3764cf60eecbfd4e2284b736302fa837f8751c4', '2019-04-06 18:37:42', NULL),
(11, 'Davido', 'Hargya', 'davidohargya@gmail.com', '', '733c8373edc5d58c828d4050aa493529731547eeed2bb9c3ca57da790c61171446adf27ee828e7337791b59a91dff30e9de1ce878b725dc8a4622e1e68c63f07', '2019-04-07 17:28:10', NULL),
(12, 'Community', 'Moderator', 'varunsingh87@yahoo.com', '', 'b8474ff280f9a804057ce0b5055919345244f0abe0184a583d903fec09786913011ede0bd7b753b1866b1dc85bbfccf6844f49721f5dec27e506e5c5d2ffc216', '2019-04-07 17:28:56', NULL),
(13, 'Michaelo', 'Yesepankoo', 'jwithjolly@gmail.com', '', 'a118060ba3c0671b36005f785c818fd68e3478a91497019daa8cfa52dffe496445dbdbb4f0db6389056f4d26da4eb6bec5a3e3797de83649afb8f4eec5ace6dd', '2019-04-07 17:34:25', NULL),
(14, 'niraj', 'singh', 'mrnirajsingh@yahoo.com', '', '5446b59ce8a7212724beceeb82b316ae360f5d27aa8287f0ecd20bf6cc6fb924622c4e4832c5702581d1e2a8d2670e589221315f6b0ee5b120ebffda885bfe6b', '2019-04-07 17:42:45', NULL),
(15, 'Victor', 'Linetsky', 'victorlinetsky38@gmail.com', '', 'd0fc78dd4ee644dd744ef1fadb8647b9dfb796a3f69ab6d00fc8ca7ce09ac6fa8fbd3b8eac1a9b332dc722fd10c1788a74d5b48bc85d83d005158a70e64dce06', '2019-04-09 09:33:27', NULL),
(16, 'Juan', 'Cortez', 'tits@tops.com', '', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '2019-05-07 07:39:30', NULL),
(17, 'Nacho', 'Cheez', 'keprinisawesome@gmail.com', '', '1fe105ac481db74d5a93987561e75ffb4ecc31c0f00ba1271dc736c7a944b1c5e701e525aae9406401c95929ece2f78217f38e94b854a1d55a5b4729fa3e7a8f', '2019-05-20 08:03:51', 'qvqwzocm0gk01.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
