-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 26, 2020 at 09:58 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: "BAZINGA"
--

-- --------------------------------------------------------

--
-- Table structure for table "comments"
--

CREATE TABLE "comments" ;

--
-- Dumping data for table "comments"
--

SET IDENTITY_INSERT "comments" ON ;
INSERT INTO "comments" ("comment_id", "user_id", "post_id", "comment", "commented_at") VALUES
(41, 32, 233, 'asdfdsaf', '2019-05-21 00:12:38'),
(45, 45, 235, 'Hello world\r\n', '2019-07-02 21:07:25'),
(48, 32, 238, '896', '2019-07-29 14:02:22');

SET IDENTITY_INSERT "comments" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "friendrequest"
--

CREATE TABLE "friendrequest" ;

--
-- Dumping data for table "friendrequest"
--

SET IDENTITY_INSERT "friendrequest" ON ;
INSERT INTO "friendrequest" ("friendship_id", "receiver", "sender") VALUES
(54, '48', '45'),
(55, '48', '45'),
(57, '32', '45'),
(58, '32', '45'),
(59, '32', '45'),
(60, '32', '45');

SET IDENTITY_INSERT "friendrequest" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "likes"
--

CREATE TABLE "likes" ;

--
-- Dumping data for table "likes"
--

SET IDENTITY_INSERT "likes" ON ;
INSERT INTO "likes" ("like_id", "post_id", "liked_by") VALUES
(24, 119, 41),
(28, 47, 41),
(29, 45, 41),
(30, 40, 41),
(31, 220, 32),
(32, 119, 32),
(35, 47, 32),
(36, 48, 32),
(39, 45, 32),
(42, 225, 30),
(43, 119, 30),
(44, 45, 30),
(45, 44, 30),
(47, 225, 39);

SET IDENTITY_INSERT "likes" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "myfriends"
--

CREATE TABLE "myfriends" ;

--
-- Dumping data for table "myfriends"
--

SET IDENTITY_INSERT "myfriends" ON ;
INSERT INTO "myfriends" ("friendship_id", "my_id", "friend_id") VALUES
(51, '45', '47'),
(51, '47', '45'),
(50, '43', '47'),
(56, '45', '32'),
(50, '47', '43'),
(56, '32', '45');

SET IDENTITY_INSERT "myfriends" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "notification"
--

CREATE TABLE "notification" ;

--
-- Dumping data for table "notification"
--

SET IDENTITY_INSERT "notification" ON ;
INSERT INTO "notification" ("friendship_id", "deleter_id", "deleted_id") VALUES
(50, '47', '43'),
(48, '47', '48'),
(52, '48', '47');

SET IDENTITY_INSERT "notification" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "posts"
--

CREATE TABLE "posts" ;

--
-- Dumping data for table "posts"
--

SET IDENTITY_INSERT "posts" ON ;
INSERT INTO "posts" ("post_id", "user_id", "content", "picture_url", "posted_at") VALUES
(119, 38, 'canımmmm naber??', '0x0-01.jpg', '2019-05-12 17:44:08'),
(48, 41, 'selam yeni katıldım bazingaya nasılsınız?', NULL, '2019-05-12 16:26:34'),
(40, 30, 'merhaba ben arda uslu bazinga ya yeni katıldım', NULL, '2019-05-12 16:21:34'),
(39, 30, 'selam arkadaşlar ben arda uslu', NULL, '2019-05-12 16:21:22'),
(225, 32, 'game of thrones', '4550_16.jpg', '2019-05-17 17:49:16'),
(227, 41, NULL, '4550_18.jpg', '2019-05-17 18:50:36'),
(235, 45, NULL, 'logoo.png', '2019-05-19 17:47:55'),
(231, 45, 'selam kızlarrr ben dila bilgin', NULL, '2019-05-18 23:10:57'),
(232, 45, NULL, '404.png', '2019-05-18 23:11:30'),
(233, 32, NULL, 'avatar1-sm.jpg', '2019-05-18 23:47:46'),
(234, 46, 'selam ben mehmet uslu', NULL, '2019-05-19 00:47:28'),
(238, 32, NULL, 'matematik-zeka-sorusu-10.jpg', '2019-07-29 14:02:07'),
(237, 48, 'merhaba', NULL, '2019-05-21 00:10:56'),
(239, 32, 'asdasdas', NULL, '2020-02-06 12:47:33'),
(240, 32, 'arda', NULL, '2020-02-06 12:47:41');

SET IDENTITY_INSERT "posts" OFF;

-- --------------------------------------------------------

--
-- Table structure for table "users"
--

CREATE TABLE "users" ;

--
-- Dumping data for table "users"
--

SET IDENTITY_INSERT "users" ON ;
INSERT INTO "users" ("user_id", "email", "password", "first_name", "last_name", "profile_picture_url", "birth_date", "phone", "gender", "joined_at") VALUES
(32, 'burcu@gmail.com', '$2y$10$kltlhNl3YAG10xox.0iG/.PE/1X87vsTX5thIhfcO7QLrnyvHCREO', 'Burcu', 'Biricik', 'avatar27-sm.jpg', '1994-05-18', '5425608022', 'Female', '2019-05-09 17:48:03'),
(46, 'mehmet@gmail.com', '$2y$10$pRDot.o.MFYF7rkp289i7euzP2cg8HdwlIMGyq5X6uSofXrLL2wXq', 'Mehmet', 'Uslu', 'avatar9-sm.jpg', '1984-10-12', '5421548788', 'Male', '2019-05-19 00:04:33'),
(45, 'dila@gmail.com', '$2y$10$Ma5dN4ZQv8Ahc8tuBXuuB.Y7L2O1DpKkwBGwCHYCgUECMzIJHOFY2', 'Dila', 'Bilgin', 'avatar17-sm.jpg', '1984-10-12', '5245148585', 'Male', '2019-05-18 22:35:20'),
(43, 'kuzgun@gmail.com', '$2y$10$XUO8XIEKmsV1WF/u0HF9DuI0I3FLEaRvWBKUFIYVq8cxAFdeqnTvi', 'Kuzgun', 'Cebeci', '0x0-01.jpg', '1984-10-12', '5325418744', 'Male', '2019-05-12 20:26:55'),
(47, 'arda@gmail.com', '$2y$10$J4NWaN/n/QCnp5P2ufL2BOFytmv899nFQETE/8HoirVKGHCkpMfeW', 'Arda', 'Ersoy', 'author-page.jpg', '1984-10-12', '5384152488', 'Male', '2019-05-19 17:50:39'),
(48, 'mustafa@gmail.com', '$2y$10$F5mr3UTkD6nLEzp9Hym/UuzCWjr.FWxjzWndDRddq47JSS9tCySSK', 'Mustafa', 'Mele', 'avatar2-sm.jpg', '1984-10-12', '5425608024', 'Male\'', '2019-05-19 21:19:36');

SET IDENTITY_INSERT "users" OFF;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
