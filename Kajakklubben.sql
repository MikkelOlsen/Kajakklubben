-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 03:22 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kajakklubben`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacs`
--

CREATE TABLE `contacs` (
  `contactId` int(11) NOT NULL,
  `contactName` varchar(45) NOT NULL,
  `contactEmail` varchar(128) NOT NULL,
  `contactMobile` int(8) DEFAULT NULL,
  `contactMessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventsId` int(11) NOT NULL,
  `eventTitle` varchar(25) NOT NULL,
  `eventStartDate` date NOT NULL,
  `eventDescription` text NOT NULL,
  `eventCover` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eventsubscribers`
--

CREATE TABLE `eventsubscribers` (
  `eventSubscriberId` int(11) NOT NULL,
  `fkEventSubUserId` int(11) NOT NULL,
  `fkEventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `galleryId` int(11) NOT NULL,
  `fkGalleryEventId` int(11) NOT NULL,
  `fkGalleryMediaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kajaks`
--

CREATE TABLE `kajaks` (
  `kajakId` int(11) NOT NULL,
  `kajakName` varchar(52) NOT NULL,
  `kajakStock` int(11) NOT NULL,
  `kajakLevel` int(2) NOT NULL,
  `fkKajakType` int(11) NOT NULL,
  `fkKajakMedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kajaktypes`
--

CREATE TABLE `kajaktypes` (
  `kajakTypeId` int(11) NOT NULL,
  `kajakTypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mediaId` int(11) NOT NULL,
  `filename` varchar(96) NOT NULL,
  `filepath` varchar(45) NOT NULL,
  `mime` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `newsTitle` varchar(25) NOT NULL,
  `newsContent` text NOT NULL,
  `newsStartDate` date NOT NULL,
  `newsEndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `newsTitle`, `newsContent`, `newsStartDate`, `newsEndDate`) VALUES
(7, 'Test V1', '&#60;p&#62;Jeg tænker at nu tester vi lige, ja vi gør nemlig så. Hvem er du lige nu? er du ham eller hende? ork eller gigant? menneske eller gnom? tyk eller tynd?&#60;/p&#62;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#60;p&#62;&#38;nbsp;høj eller lav? bums eller rig? for ja vi tester tester tester oh yeah det gør vi!&#60;/p&#62;', '2018-03-08', '2018-03-23'),
(9, 'Test', '&#60;p&#62;sdfsdfsdfsdf&#60;/p&#62;', '2018-03-15', '2018-03-17'),
(10, 'Bums', '&#60;p&#62;sdfsfsdf&#60;/p&#62;', '2018-03-13', '2018-03-31'),
(11, 'Yeah boi', '&#60;p&#62;sdfsdfsdfdsfs&#60;/p&#62;', '2018-03-22', '2018-03-27'),
(12, 'sdfds', '&#60;p&#62;sdfdsfdsfsdfs&#60;/p&#62;', '2018-03-14', '2018-03-30'),
(13, 'sdfsfs', '&#60;p&#62;testsdfss&#60;/p&#62;', '2018-03-14', '2018-03-23'),
(14, 'sdfdsfsdfds', '&#60;p&#62;sdfdsfdsfdsfdsfsdf&#60;/p&#62;', '2018-03-20', '2018-03-31'),
(15, 'dfsdfsd', '&#60;p&#62;sdfsfsdfs&#60;/p&#62;', '2018-03-14', '2018-03-17'),
(16, 'sdfsfsdfsd', '&#60;p&#62;sdfdsfdsfdsfsdfs&#60;/p&#62;', '2018-03-14', '2018-03-17'),
(17, 'sdfsfsfs', '&#60;p&#62;sdfdsfdsfdsfsd&#60;/p&#62;', '2018-03-13', '2018-03-31'),
(18, 'sdfsfdsfdsfds', '&#60;p&#62;sdfsfdsfdsfdsfdsfs&#60;/p&#62;', '2018-03-13', '2018-03-30'),
(19, 'asdadasd', '&#60;p&#62;asdadadasdasda&#60;/p&#62;', '2018-03-14', '2018-03-24'),
(20, 'asdadadsadsa', '&#60;p&#62;asdadsada&#60;/p&#62;', '2018-03-13', '2018-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `newslettersubscribers`
--

CREATE TABLE `newslettersubscribers` (
  `newsLetterSubscribersId` int(11) NOT NULL,
  `fkNewslettersUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `fkUserRole` int(11) NOT NULL,
  `fkRoleType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roletypes`
--

CREATE TABLE `roletypes` (
  `roleTypeId` int(11) NOT NULL,
  `roleTypeName` varchar(64) NOT NULL,
  `roleTypeInt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesId` int(11) NOT NULL,
  `salesKajakId` int(11) NOT NULL,
  `salesPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `userLevelId` int(11) NOT NULL,
  `userLevelName` varchar(25) NOT NULL,
  `userLevelReqKm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `userRole` int(11) NOT NULL,
  `userEmail` varchar(64) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `userKm` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacs`
--
ALTER TABLE `contacs`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventsId`),
  ADD KEY `fkEventCoverMedia_idx` (`eventCover`);

--
-- Indexes for table `eventsubscribers`
--
ALTER TABLE `eventsubscribers`
  ADD PRIMARY KEY (`eventSubscriberId`),
  ADD KEY `fkSubEventId_idx` (`fkEventId`),
  ADD KEY `fkUserSuEventbId_idx` (`fkEventSubUserId`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`galleryId`),
  ADD KEY `fkEventGalleryId_idx` (`fkGalleryEventId`),
  ADD KEY `fkMediaGalleryId_idx` (`fkGalleryMediaId`);

--
-- Indexes for table `kajaks`
--
ALTER TABLE `kajaks`
  ADD PRIMARY KEY (`kajakId`),
  ADD KEY `fkTypeKajak_idx` (`fkKajakType`),
  ADD KEY `fkMediaKajak_idx` (`fkKajakMedia`);

--
-- Indexes for table `kajaktypes`
--
ALTER TABLE `kajaktypes`
  ADD PRIMARY KEY (`kajakTypeId`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `newslettersubscribers`
--
ALTER TABLE `newslettersubscribers`
  ADD PRIMARY KEY (`newsLetterSubscribersId`),
  ADD KEY `fkNewsletterSubUserId_idx` (`fkNewslettersUserId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`),
  ADD KEY `fk_userRole_idx` (`fkUserRole`),
  ADD KEY `fk_roleType_idx` (`fkRoleType`);

--
-- Indexes for table `roletypes`
--
ALTER TABLE `roletypes`
  ADD PRIMARY KEY (`roleTypeId`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesId`),
  ADD KEY `fkKajakSalesId_idx` (`salesKajakId`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userLevelId`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fkUserRole_idx` (`userRole`),
  ADD KEY `fkUserAvatar_idx` (`avatar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacs`
--
ALTER TABLE `contacs`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventsubscribers`
--
ALTER TABLE `eventsubscribers`
  MODIFY `eventSubscriberId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `galleryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kajaks`
--
ALTER TABLE `kajaks`
  MODIFY `kajakId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kajaktypes`
--
ALTER TABLE `kajaktypes`
  MODIFY `kajakTypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `newslettersubscribers`
--
ALTER TABLE `newslettersubscribers`
  MODIFY `newsLetterSubscribersId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roletypes`
--
ALTER TABLE `roletypes`
  MODIFY `roleTypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlevels`
--
ALTER TABLE `userlevels`
  MODIFY `userLevelId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fkEventCoverMedia` FOREIGN KEY (`eventCover`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventsubscribers`
--
ALTER TABLE `eventsubscribers`
  ADD CONSTRAINT `fkSubEventId` FOREIGN KEY (`fkEventId`) REFERENCES `events` (`eventsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUserSuEventbId` FOREIGN KEY (`fkEventSubUserId`) REFERENCES `users` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fkEventGalleryId` FOREIGN KEY (`fkGalleryEventId`) REFERENCES `events` (`eventsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkMediaGalleryId` FOREIGN KEY (`fkGalleryMediaId`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kajaks`
--
ALTER TABLE `kajaks`
  ADD CONSTRAINT `fkMediaKajak` FOREIGN KEY (`fkKajakMedia`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkTypeKajak` FOREIGN KEY (`fkKajakType`) REFERENCES `kajaktypes` (`kajakTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `newslettersubscribers`
--
ALTER TABLE `newslettersubscribers`
  ADD CONSTRAINT `fkNewsletterSubUserId` FOREIGN KEY (`fkNewslettersUserId`) REFERENCES `users` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roleType` FOREIGN KEY (`fkRoleType`) REFERENCES `roletypes` (`roleTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userRole` FOREIGN KEY (`fkUserRole`) REFERENCES `userroles` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fkKajakSalesId` FOREIGN KEY (`salesKajakId`) REFERENCES `kajaks` (`kajakId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fkUserAvatar` FOREIGN KEY (`avatar`) REFERENCES `media` (`mediaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUserRole` FOREIGN KEY (`userRole`) REFERENCES `userroles` (`roleId`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
