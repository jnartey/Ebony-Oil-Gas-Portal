-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 19, 2018 at 04:59 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eog_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities_logs`
--

CREATE TABLE `activities_logs` (
  `id` int(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `workgroup_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `source_id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `source` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `photo_dir` varchar(255) NOT NULL,
  `photo_type` varchar(255) NOT NULL,
  `photo_size` int(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `banner_image`, `photo_dir`, `photo_type`, `photo_size`, `created`, `modified`) VALUES
(1, 'Banner 1', 'Welcome to Ebony Oil & Gas Portal', 'oilandgas.jpg', 'webroot/files/Banners/banner_image/', 'image/jpeg', 164886, '2017-12-21 13:13:41', '2017-12-21 13:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `canteen`
--

CREATE TABLE `canteen` (
  `id` int(20) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `week` varchar(2) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `morning_meal` varchar(255) DEFAULT NULL,
  `morning_meal_description` text,
  `afternoon_meal` varchar(255) DEFAULT NULL,
  `afternoon_meal_description` text,
  `evening_meal` varchar(255) DEFAULT NULL,
  `evening_meal_description` text,
  `status` varchar(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `menu`, `week`, `day`, `morning_meal`, `morning_meal_description`, `afternoon_meal`, `afternoon_meal_description`, `evening_meal`, `evening_meal_description`, `status`, `created`, `modified`) VALUES
(1, 'Week 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-08-11 07:34:58', '2017-08-11 10:42:50'),
(2, '1', NULL, '1', 'Mojito Monday & Breakfast Sandwich', 'Watermelon Blueberry Mojito. Pain au lait bun, over hard egg, cheddar, HP Sauce', 'Jerk Chicken', 'Rice & beans, habanero pepper, plantain', 'Canteen Burger', 'Iceberg lettuce, smoked cheddar, pickle mayo, sliced tomato, fries\r\nadd bacon +2.', '1', '2017-08-11 07:34:58', '2017-08-11 07:34:58'),
(3, '1', NULL, '2', 'Coffee & Canteen Breakfast', 'Two eggs your way, sausage, bacon, roasted mushrooms, home fries, toast', 'Champion waakye', 'Fried yam chips with well spiced grilled chicken', 'Margherita Pizza', 'San Marzano tomato sauce, basil, fior di latte add pepperoni +3.', '1', '2017-08-11 07:34:58', '2017-08-11 07:34:58'),
(4, '1', NULL, '3', 'Fruit Juice & Avocado Toast', 'Multigrain bread, chunky avocado, marinated cherry tomatoes, pea shoots, add two poached or scrambled eggs +4.', 'Yam chips and grilled chicken', '', 'Seafood Spaghettini', 'poached shrimp, clams, fennel confit, cherry tomatoes, preserved lemon', '1', '2017-08-11 07:34:58', '2017-08-11 07:34:58'),
(5, '1', NULL, '4', 'Coffee & Hot Steel-Cut Oats', 'peanut butter, flax seeds, banana, maple syrup. pain au lait bun, over hard egg, cheddar, HP Sauce', 'Jollof rice with beef', 'Comes with a choice of green salad or coleslaw', 'Steak Frites', 'Flat iron steak, romesco sauce', '1', '2017-08-11 07:34:58', '2017-08-11 07:34:58'),
(6, '1', NULL, '5', 'Feel Good Friday & Breakfast Sandwich', 'Pommies Apple Cider Pint. Pain au lait bun, over hard egg, cheddar, HP Sauce', 'Red red and fried plantain', 'Beans stew with boiled or fried plantain and a choice of fish or beef', 'Grain Bowl', 'asparagus, edamame, spinach, zucchini, pickled carrots, sunflower seeds, tofu, citrus tarragon dressing', '1', '2017-08-11 07:34:58', '2017-08-11 07:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `cash_requests`
--

CREATE TABLE `cash_requests` (
  `id` int(200) NOT NULL,
  `request_type` int(1) NOT NULL,
  `r_type` varchar(10) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `amount` int(10) NOT NULL,
  `user_id` int(200) DEFAULT NULL,
  `department_id` int(200) NOT NULL,
  `approved_by` int(200) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `paid_by` int(200) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cash_requests`
--

INSERT INTO `cash_requests` (`id`, `request_type`, `r_type`, `subject`, `amount`, `user_id`, `department_id`, `approved_by`, `approval_date`, `paid_by`, `status`, `created`, `modified`) VALUES
(1, 3, NULL, 'extra fuel', 100, 11, 5, NULL, '0000-00-00 00:00:00', NULL, 3, '2018-01-18 21:49:40', '2018-01-18 21:49:40'),
(2, 3, 'Cash', 'test', 20, 11, 5, NULL, NULL, NULL, 3, '2018-03-12 02:08:42', '2018-03-12 02:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Oil and Gas', '2017-05-19 01:30:59', '2017-05-19 01:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat`
--

CREATE TABLE `cometchat` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED NOT NULL,
  `to` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `read` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `direction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat`
--

INSERT INTO `cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES
(1, 4, 11, 'test', 1507880933, 1, 0),
(2, 11, 4, 'hello', 1507880944, 1, 0),
(3, 11, 4, '<img class=\"cometchat_smiley\" height=\"20\" width=\"20\" src=\"/webroot/cometchat/writable/images/smileys/flushed.png\" title=\"Flushed\"> <img class=\"cometchat_smiley\" height=\"20\" width=\"20\" src=\"/webroot/cometchat/writable/images/smileys/smile.png\" title=\"Smile\">', 1507880996, 1, 0),
(4, 11, 1, 'hi', 1508228710, 1, 0),
(5, 1, 11, 'hello', 1508228739, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_announcements`
--

CREATE TABLE `cometchat_announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `announcement` text NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `to` int(10) NOT NULL,
  `recd` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_block`
--

CREATE TABLE `cometchat_block` (
  `id` int(10) UNSIGNED NOT NULL,
  `fromid` int(10) UNSIGNED NOT NULL,
  `toid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_bots`
--

CREATE TABLE `cometchat_bots` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `keywords` text CHARACTER SET utf8,
  `avatar` varchar(200) NOT NULL,
  `apikey` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_chatroommessages`
--

CREATE TABLE `cometchat_chatroommessages` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `chatroomid` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_chatrooms`
--

CREATE TABLE `cometchat_chatrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) UNSIGNED NOT NULL,
  `createdby` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL,
  `vidsession` varchar(512) DEFAULT NULL,
  `invitedusers` text,
  `guid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_chatrooms_users`
--

CREATE TABLE `cometchat_chatrooms_users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `chatroomid` int(10) UNSIGNED NOT NULL,
  `isbanned` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_colors`
--

CREATE TABLE `cometchat_colors` (
  `color_key` varchar(100) NOT NULL,
  `color_value` text NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat_colors`
--

INSERT INTO `cometchat_colors` (`color_key`, `color_value`, `color`) VALUES
('color1', 'a:3:{s:7:\"primary\";s:6:\"56a8e3\";s:9:\"secondary\";s:6:\"3777A7\";s:5:\"hover\";s:6:\"ECF5FB\";}', 'color1'),
('color10', 'a:3:{s:7:\"primary\";s:6:\"23025E\";s:9:\"secondary\";s:6:\"3D1F84\";s:5:\"hover\";s:6:\"E5D7FF\";}', 'color10'),
('color11', 'a:3:{s:7:\"primary\";s:6:\"24D4F6\";s:9:\"secondary\";s:6:\"059EBB\";s:5:\"hover\";s:6:\"DBF9FF\";}', 'color11'),
('color12', 'a:3:{s:7:\"primary\";s:6:\"289D57\";s:9:\"secondary\";s:6:\"09632D\";s:5:\"hover\";s:6:\"DDF9E8\";}', 'color12'),
('color13', 'a:3:{s:7:\"primary\";s:6:\"D9B197\";s:9:\"secondary\";s:6:\"C38B66\";s:5:\"hover\";s:6:\"FFF1E8\";}', 'color13'),
('color14', 'a:3:{s:7:\"primary\";s:6:\"FF67AB\";s:9:\"secondary\";s:6:\"D6387E\";s:5:\"hover\";s:6:\"F3DDE7\";}', 'color14'),
('color15', 'a:3:{s:7:\"primary\";s:6:\"8E24AA\";s:9:\"secondary\";s:6:\"7B1FA2\";s:5:\"hover\";s:6:\"EFE8FD\";}', 'color15'),
('color2', 'a:3:{s:7:\"primary\";s:6:\"4DC5CE\";s:9:\"secondary\";s:6:\"068690\";s:5:\"hover\";s:6:\"D3EDEF\";}', 'color2'),
('color3', 'a:3:{s:7:\"primary\";s:6:\"FFC107\";s:9:\"secondary\";s:6:\"FFA000\";s:5:\"hover\";s:6:\"FFF8E2\";}', 'color3'),
('color4', 'a:3:{s:7:\"primary\";s:6:\"FB4556\";s:9:\"secondary\";s:6:\"BB091A\";s:5:\"hover\";s:6:\"F5C3C8\";}', 'color4'),
('color5', 'a:3:{s:7:\"primary\";s:6:\"DBA0C3\";s:9:\"secondary\";s:6:\"D87CB3\";s:5:\"hover\";s:6:\"ECD9E5\";}', 'color5'),
('color6', 'a:3:{s:7:\"primary\";s:6:\"3B5998\";s:9:\"secondary\";s:6:\"213A6D\";s:5:\"hover\";s:6:\"DFEAFF\";}', 'color6'),
('color7', 'a:3:{s:7:\"primary\";s:6:\"065E52\";s:9:\"secondary\";s:6:\"244C4E\";s:5:\"hover\";s:6:\"AFCCAF\";}', 'color7'),
('color8', 'a:3:{s:7:\"primary\";s:6:\"FF8A2E\";s:9:\"secondary\";s:6:\"CE610C\";s:5:\"hover\";s:6:\"FDD9BD\";}', 'color8'),
('color9', 'a:3:{s:7:\"primary\";s:6:\"E99090\";s:9:\"secondary\";s:6:\"B55353\";s:5:\"hover\";s:6:\"FDE8E8\";}', 'color9');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_guests`
--

CREATE TABLE `cometchat_guests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat_guests`
--

INSERT INTO `cometchat_guests` (`id`, `name`) VALUES
(10000000, 'guest-10000000');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_languages`
--

CREATE TABLE `cometchat_languages` (
  `lang_key` varchar(255) NOT NULL COMMENT 'Key of a language variable',
  `lang_text` text NOT NULL COMMENT 'Text/value of a language variable',
  `code` varchar(20) NOT NULL COMMENT 'Language code for e.g. en for English',
  `type` varchar(20) NOT NULL COMMENT 'Type of CometChat add on for e.g. module/plugin/extension/function',
  `name` varchar(50) NOT NULL COMMENT 'Name of add on for e.g. announcement,smilies, etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores all CometChat languages';

--
-- Dumping data for table `cometchat_languages`
--

INSERT INTO `cometchat_languages` (`lang_key`, `lang_text`, `code`, `type`, `name`) VALUES
('rtl', '0', 'en', 'core', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_recentconversation`
--

CREATE TABLE `cometchat_recentconversation` (
  `convo_id` varchar(100) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED NOT NULL,
  `to` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `sent` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat_recentconversation`
--

INSERT INTO `cometchat_recentconversation` (`convo_id`, `id`, `from`, `to`, `message`, `sent`) VALUES
('1b1ec039a3edd1622d1b11d0e056507d', 3, 11, 4, '<img class=\"cometchat_smiley\" height=\"20\" width=\"20\" src=\"/webroot/cometchat/writable/images/smileys/flushed.png\" title=\"Flushed\"> <img class=\"cometchat_smiley\" height=\"20\" width=\"20\" src=\"/webroot/cometchat/writable/images/smileys/smile.png\" title=\"Smile\">', '1507880996'),
('3340a177463a91e1221850b7903c53c7', 5, 1, 11, 'hello', '1508228739');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_session`
--

CREATE TABLE `cometchat_session` (
  `session_id` char(32) NOT NULL,
  `session_data` text NOT NULL,
  `session_lastaccesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat_session`
--

INSERT INTO `cometchat_session` (`session_id`, `session_data`, `session_lastaccesstime`) VALUES
('', '', '2017-10-17 05:37:55'),
('12glbt06edqdictt9g727pd6a3', '', '2017-10-12 07:23:38'),
('831kcfd3el7c2m16tknm1qenv2', 'cometchat|a:4:{s:20:\"cometchat_admin_user\";s:9:\"cometchat\";s:20:\"cometchat_admin_pass\";s:9:\"cometchat\";s:13:\"VERSION_CHECK\";i:1;s:6:\"MsgCnt\";s:1:\"3\";}', '2017-10-17 05:41:53'),
('hfpaaumlcvrhf35mbfv29u1mg1', 'cometchat|a:4:{s:20:\"cometchat_admin_user\";s:9:\"cometchat\";s:20:\"cometchat_admin_pass\";s:9:\"cometchat\";s:13:\"VERSION_CHECK\";i:1;s:6:\"MsgCnt\";i:0;}', '2017-10-11 12:25:13'),
('pel2f4mqtfbespuaqgsrlican1', 'cometchat|a:4:{s:20:\"cometchat_admin_user\";s:9:\"cometchat\";s:20:\"cometchat_admin_pass\";s:9:\"cometchat\";s:13:\"VERSION_CHECK\";i:1;s:6:\"MsgCnt\";i:0;}', '2017-10-11 11:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_settings`
--

CREATE TABLE `cometchat_settings` (
  `setting_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Configuration setting name. It can be PHP constant, variable or array',
  `value` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Value of the key.',
  `key_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'States whether the key is: 0 = PHP constant, 1 = atomic variable or 2 = serialized associative array.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Stores all the configuration settings for CometChat';

--
-- Dumping data for table `cometchat_settings`
--

INSERT INTO `cometchat_settings` (`setting_key`, `value`, `key_type`) VALUES
('api_response', '', 1),
('apikey', '48f52fdcd980bd85314e5e9de92806dc', 1),
('BASE_URL', '/webroot/cometchat/', 0),
('color', 'color1', 1),
('dbversion', '24', 1),
('disableContactsTab', '0', 1),
('DISPLAY_ALL_USERS', '1', 0),
('displayBusyNotification', '1', 1),
('displayOfflineNotification', '1', 1),
('displayOnlineNotification', '1', 1),
('extensions_core', 'a:4:{s:3:\"ads\";s:14:\"Advertisements\";s:9:\"mobileapp\";s:10:\"Mobile App\";s:7:\"desktop\";s:11:\"Desktop App\";s:4:\"bots\";s:4:\"Bots\";}', 2),
('hideOffline', '1', 1),
('LATEST_VERSION', '6.8.11', 0),
('modules_core', 'a:11:{s:13:\"announcements\";a:9:{i:0;s:13:\"announcements\";i:1;s:13:\"Announcements\";i:2;s:31:\"modules/announcements/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"280\";i:5;s:3:\"310\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:16:\"broadcastmessage\";a:9:{i:0;s:16:\"broadcastmessage\";i:1;s:17:\"Broadcast Message\";i:2;s:34:\"modules/broadcastmessage/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"385\";i:5;s:3:\"300\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:9:\"chatrooms\";a:9:{i:0;s:9:\"chatrooms\";i:1;s:6:\"Groups\";i:2;s:27:\"modules/chatrooms/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"600\";i:5;s:3:\"300\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:8:\"facebook\";a:9:{i:0;s:8:\"facebook\";i:1;s:17:\"Facebook Fan Page\";i:2;s:26:\"modules/facebook/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"500\";i:5;s:3:\"460\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:5:\"games\";a:9:{i:0;s:5:\"games\";i:1;s:19:\"Single Player Games\";i:2;s:23:\"modules/games/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"465\";i:5;s:3:\"300\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:4:\"home\";a:8:{i:0;s:4:\"home\";i:1;s:4:\"Home\";i:2;s:1:\"/\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";i:7;s:0:\"\";}s:17:\"realtimetranslate\";a:9:{i:0;s:17:\"realtimetranslate\";i:1;s:23:\"Translate Conversations\";i:2;s:35:\"modules/realtimetranslate/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"280\";i:5;s:3:\"310\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:11:\"scrolltotop\";a:8:{i:0;s:11:\"scrolltotop\";i:1;s:13:\"Scroll To Top\";i:2;s:40:\"javascript:jqcc.cometchat.scrollToTop();\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";i:7;s:0:\"\";}s:5:\"share\";a:8:{i:0;s:5:\"share\";i:1;s:15:\"Share This Page\";i:2;s:23:\"modules/share/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"350\";i:5;s:2:\"50\";i:6;s:0:\"\";i:7;s:1:\"1\";}s:9:\"translate\";a:9:{i:0;s:9:\"translate\";i:1;s:19:\"Translate This Page\";i:2;s:27:\"modules/translate/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"280\";i:5;s:3:\"310\";i:6;s:0:\"\";i:7;s:1:\"1\";i:8;s:0:\"\";}s:7:\"twitter\";a:8:{i:0;s:7:\"twitter\";i:1;s:7:\"Twitter\";i:2;s:25:\"modules/twitter/index.php\";i:3;s:6:\"_popup\";i:4;s:3:\"500\";i:5;s:3:\"300\";i:6;s:0:\"\";i:7;s:1:\"1\";}}', 2),
('plugins_core', 'a:17:{s:9:\"audiochat\";a:2:{i:0;s:10:\"Audio Chat\";i:1;i:0;}s:6:\"avchat\";a:2:{i:0;s:16:\"Audio/Video Chat\";i:1;i:0;}s:5:\"block\";a:2:{i:0;s:10:\"Block User\";i:1;i:1;}s:9:\"broadcast\";a:2:{i:0;s:21:\"Audio/Video Broadcast\";i:1;i:0;}s:11:\"chathistory\";a:2:{i:0;s:12:\"Chat History\";i:1;i:0;}s:17:\"clearconversation\";a:2:{i:0;s:18:\"Clear Conversation\";i:1;i:0;}s:12:\"filetransfer\";a:2:{i:0;s:11:\"Send a file\";i:1;i:0;}s:9:\"handwrite\";a:2:{i:0;s:19:\"Handwrite a message\";i:1;i:0;}s:6:\"report\";a:2:{i:0;s:19:\"Report Conversation\";i:1;i:1;}s:4:\"save\";a:2:{i:0;s:17:\"Save Conversation\";i:1;i:0;}s:11:\"screenshare\";a:2:{i:0;s:17:\"Share Your Screen\";i:1;i:0;}s:7:\"smilies\";a:2:{i:0;s:5:\"Emoji\";i:1;i:0;}s:8:\"stickers\";a:2:{i:0;s:8:\"Stickers\";i:1;i:0;}s:5:\"style\";a:2:{i:0;s:15:\"Color your text\";i:1;i:2;}s:13:\"transliterate\";a:2:{i:0;s:22:\"Write in your language\";i:1;i:0;}s:10:\"whiteboard\";a:2:{i:0;s:25:\"Share Whiteboard Document\";i:1;i:0;}s:10:\"writeboard\";a:2:{i:0;s:28:\"Share Collaborative Document\";i:1;i:0;}}', 2),
('searchDisplayNumber', '10', 1),
('theme', 'docked', 1),
('thumbnailDisplayNumber', '40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_status`
--

CREATE TABLE `cometchat_status` (
  `userid` int(10) UNSIGNED NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') DEFAULT NULL,
  `typingto` int(10) UNSIGNED DEFAULT NULL,
  `typingtime` int(10) UNSIGNED DEFAULT NULL,
  `isdevice` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `lastactivity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastseen` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastseensetting` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `readreceiptsetting` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cometchat_status`
--

INSERT INTO `cometchat_status` (`userid`, `message`, `status`, `typingto`, `typingtime`, `isdevice`, `lastactivity`, `lastseen`, `lastseensetting`, `readreceiptsetting`) VALUES
(0, NULL, NULL, NULL, NULL, 0, 1508240977, 1508240977, 0, 1),
(1, NULL, 'away', NULL, NULL, 0, 1508237385, 1508237385, 0, 1),
(4, NULL, 'away', NULL, NULL, 0, 1508219716, 1508219716, 0, 1),
(11, NULL, 'away', NULL, NULL, 0, 1508229955, 1508229955, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_users`
--

CREATE TABLE `cometchat_users` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `displayname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `grp` varchar(25) NOT NULL,
  `friends` text NOT NULL,
  `uid` varchar(255) NOT NULL,
  `roleid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cometchat_videochatsessions`
--

CREATE TABLE `cometchat_videochatsessions` (
  `username` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `timestamp` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `comment_src` int(1) NOT NULL,
  `source_id` int(255) DEFAULT NULL,
  `project_id` int(255) NOT NULL,
  `workgroup_id` int(255) NOT NULL,
  `forum_id` int(255) NOT NULL,
  `wiki_id` int(200) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_src`, `source_id`, `project_id`, `workgroup_id`, `forum_id`, `wiki_id`, `parent_id`, `user_id`, `comment`, `created`, `modified`, `lft`, `rght`) VALUES
(3, 2, 1, 1, 0, 0, 0, NULL, 6, 'test post edit', '2017-08-09 15:24:36', '2017-08-09 18:49:27', 1, 2),
(4, 2, 1, 1, 0, 0, 0, NULL, 6, 'test post 2', '2017-08-09 15:24:47', '2017-08-09 15:24:47', 3, 4),
(5, 1, 1, 1, 0, 0, 0, NULL, 6, 'project comment', '2017-08-09 19:35:45', '2017-08-09 19:35:45', 5, 6),
(6, 1, 1, 0, 1, 0, 0, NULL, 6, 'test post', '2017-08-10 13:49:12', '2017-08-10 13:49:12', 7, 8),
(7, 3, 1, 0, 1, 0, 0, NULL, 6, 'another test', '2017-08-10 13:53:39', '2017-08-10 13:53:39', 9, 10),
(8, 3, 1, 0, 1, 0, 0, NULL, 6, 'yet another test', '2017-08-10 13:56:09', '2017-08-10 13:56:09', 11, 12),
(9, 3, 1, 0, 1, 0, 0, NULL, 6, 'yet another test', '2017-08-10 13:57:19', '2017-08-10 13:57:19', 13, 14),
(10, 2, 1, 1, 0, 0, 0, NULL, 5, 'test comments for kwame', '2017-08-10 14:02:37', '2017-08-10 14:02:37', 15, 16),
(11, 4, 1, 0, 0, 1, 0, NULL, 6, '<p>This is awesome edited</p>\r\n', '2017-08-15 12:23:28', '2017-08-15 12:29:46', 17, 18);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(60) NOT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT 'The path to the department logo',
  `description` mediumtext,
  `department_type` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `user_id`, `name`, `logo`, `description`, `department_type`, `created`, `modified`) VALUES
(1, 1, 'Finance', '', '', 1, '2017-05-18 16:47:30', '2017-08-18 09:01:32'),
(2, 1, 'Sales & Marketing', '', '', 1, '2017-05-18 16:52:08', '2017-08-18 08:59:04'),
(3, 1, 'Human Resource & Administration', '', '', 3, '2017-05-18 16:53:18', '2017-08-18 09:01:52'),
(4, 1, 'Operations', '', '', 1, '2017-05-18 16:58:10', '2017-08-18 08:59:20'),
(5, 1, 'Business Development', '', '', 1, '2017-05-18 16:59:59', '2017-08-18 08:58:41'),
(6, 1, 'Trade & Commerce', '', '', 1, '2017-05-18 17:01:20', '2017-08-18 09:00:01'),
(7, 1, 'Information & Technology', '', '', 1, '2017-05-18 17:01:44', '2017-08-18 09:00:21'),
(8, 4, 'Risk & Internal Control', NULL, '', 1, '2017-08-17 08:19:37', '2017-08-18 09:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `departments_members`
--

CREATE TABLE `departments_members` (
  `id` int(100) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `department_role` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments_members`
--

INSERT INTO `departments_members` (`id`, `department_id`, `user_id`, `department_role`, `created`, `modified`) VALUES
(42, 5, 10, 3, '2017-08-17 08:23:58', '2017-08-17 08:25:19'),
(43, 5, 11, 2, '2017-08-17 08:24:35', '2017-08-17 08:28:57'),
(44, 5, 9, 3, '2017-08-17 08:25:03', '2017-08-17 08:25:11'),
(45, 4, 14, 3, '2017-08-17 08:26:24', '2017-08-17 08:28:30'),
(46, 4, 15, 2, '2017-08-17 08:26:46', '2017-08-17 08:28:35'),
(47, 4, 16, 1, '2017-08-17 08:27:00', '2017-08-17 08:27:00'),
(48, 4, 17, 1, '2017-08-17 08:27:08', '2017-08-17 08:27:08'),
(49, 4, 18, 1, '2017-08-17 08:27:15', '2017-08-17 08:27:15'),
(50, 4, 19, 1, '2017-08-17 08:27:28', '2017-08-17 08:27:28'),
(51, 4, 20, 1, '2017-08-17 08:27:37', '2017-08-17 08:27:37'),
(52, 4, 21, 1, '2017-08-17 08:27:43', '2017-08-17 08:27:43'),
(53, 4, 22, 1, '2017-08-17 08:27:50', '2017-08-17 08:27:50'),
(54, 6, 12, 3, '2017-08-17 08:29:58', '2017-08-17 08:30:17'),
(55, 6, 13, 1, '2017-08-17 08:30:05', '2017-08-17 08:30:05'),
(56, 1, 23, 3, '2017-08-17 08:45:49', '2017-08-17 08:47:07'),
(57, 1, 24, 1, '2017-08-17 08:46:00', '2017-08-17 08:46:00'),
(58, 1, 25, 1, '2017-08-17 08:46:13', '2017-08-17 08:46:13'),
(59, 1, 26, 2, '2017-08-17 08:46:22', '2017-08-17 08:47:13'),
(60, 1, 27, 1, '2017-08-17 08:46:34', '2017-08-17 08:46:34'),
(61, 1, 28, 1, '2017-08-17 08:46:46', '2017-08-17 08:46:46'),
(62, 2, 29, 3, '2017-08-17 08:51:29', '2017-08-17 08:52:05'),
(63, 2, 30, 2, '2017-08-17 08:51:38', '2017-08-17 08:52:10'),
(64, 2, 31, 1, '2017-08-17 08:51:46', '2017-08-17 08:51:46'),
(65, 2, 32, 1, '2017-08-17 08:51:55', '2017-08-17 08:51:55'),
(66, 8, 33, 3, '2017-08-17 08:53:50', '2017-08-17 08:53:55'),
(67, 7, 34, 3, '2017-08-17 08:56:47', '2017-08-17 08:56:54'),
(68, 3, 35, 3, '2017-08-17 09:01:56', '2017-08-17 09:02:17'),
(69, 3, 36, 1, '2017-08-17 09:02:04', '2017-08-17 09:02:05'),
(70, 3, 37, 1, '2017-08-17 09:02:12', '2017-08-17 09:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `department_comments`
--

CREATE TABLE `department_comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `comment_src` int(1) NOT NULL,
  `source_id` int(255) DEFAULT NULL,
  `project_id` int(255) NOT NULL,
  `forum_id` int(255) NOT NULL,
  `wiki_id` int(11) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(200) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_comments`
--

INSERT INTO `department_comments` (`id`, `comment_src`, `source_id`, `project_id`, `forum_id`, `wiki_id`, `parent_id`, `user_id`, `department_id`, `comment`, `created`, `modified`, `lft`, `rght`) VALUES
(1, 2, 0, 2, 0, 0, NULL, 11, NULL, 'test', '2017-10-24 08:56:38', '2017-10-24 08:56:38', 1, 2),
(2, 2, 1, 2, 0, 0, NULL, 11, NULL, 'correcting error', '2017-10-24 09:02:25', '2017-10-24 09:02:25', 3, 4),
(3, 2, 1, 2, 0, 0, NULL, 11, NULL, 'correcting error', '2017-10-24 09:04:59', '2017-10-24 09:04:59', 5, 6),
(4, 1, 2, 2, 0, 0, NULL, 11, NULL, 'test', '2017-10-24 10:12:22', '2017-10-24 10:12:22', 7, 8),
(5, 1, 1, 1, 0, 0, NULL, 11, NULL, 'testing comment counter', '2017-10-27 08:12:18', '2017-10-27 08:12:18', 9, 10),
(6, 2, 1, 1, 0, 0, NULL, 11, NULL, 'yes this works', '2017-10-27 08:57:55', '2017-10-27 08:57:55', 11, 12),
(7, 4, 0, 0, 0, 0, NULL, 11, 5, '<p>sure thing</p>\r\n', '2017-11-01 11:28:36', '2017-11-01 11:28:36', 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `department_events`
--

CREATE TABLE `department_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` mediumtext,
  `location` varchar(255) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `department_id` int(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_events`
--

INSERT INTO `department_events` (`id`, `name`, `description`, `location`, `from_date`, `to_date`, `registration_deadline`, `image`, `user_id`, `department_id`, `status`, `created`, `modified`) VALUES
(1, 'Test event', '<p>description</p>\r\n', 'tema', '2017-10-24 00:00:00', '2017-10-24 02:00:00', '2017-10-25 00:00:00', NULL, 11, 5, 0, '2017-10-24 05:43:25', '2017-10-24 05:43:25'),
(3, 'New new event', '<p>This is a test event</p>\r\n', 'Tema', '2017-08-17 00:00:00', '2017-09-29 22:30:00', '2017-09-10 22:30:00', NULL, 1, 3, 0, '2017-08-17 22:35:14', '2017-08-17 22:50:45'),
(4, 'Test Training', '<p>What did Jesus mean when He said to His disciples that some of them would not taste death until they saw the Son of Man coming in His kingdom? What is meant when the book of Revelation says that the things prophesied therein &ldquo;must soon take place&rdquo;? Comments such as these have raised many questions, causing some to conclude that Jesus was wrong about the time of His second coming. In this series,&nbsp;R.C.&nbsp;Sproul examines the time-texts associated with the Olivet Discourse and the book of Revelation, demonstrating that when properly understood, they are actually strong evidence for the truthfulness of&nbsp;Scripture.</p>\r\n', 'Conference room 2', '2017-08-18 00:00:00', '2017-08-19 00:00:00', '2017-08-19 00:00:00', NULL, 14, 4, 0, '2017-08-18 11:34:03', '2017-08-18 11:34:03'),
(5, 'Test event', '<p>description</p>\r\n', 'tema', '2017-10-24 00:00:00', '2017-10-24 02:00:00', '2017-10-25 00:00:00', NULL, 11, 5, 0, '2017-10-24 05:46:05', '2017-10-24 05:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `department_event_members`
--

CREATE TABLE `department_event_members` (
  `id` int(120) NOT NULL,
  `event_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `department_id` int(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_event_members`
--

INSERT INTO `department_event_members` (`id`, `event_id`, `user_id`, `department_id`, `status`, `comment`, `created`, `modified`) VALUES
(2, 1, 11, 5, 2, '', '2017-12-14 13:30:36', '2017-12-14 13:58:17'),
(3, 3, 1, 0, 1, '', '2017-08-17 23:09:31', '2017-08-17 23:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `department_forums`
--

CREATE TABLE `department_forums` (
  `id` int(100) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_forums`
--

INSERT INTO `department_forums` (`id`, `department_id`, `user_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 3, 1, 'Getting toasted', '<p>testing testing</p>\r\n', '2017-08-17 23:25:17', '2017-08-17 23:25:17'),
(2, 4, 16, 'test forum', '<p>What did Jesus mean when He said to His disciples that some of them would not taste death until they saw the Son of Man coming in His kingdom?&nbsp;</p>\r\n', '2017-08-18 12:08:25', '2017-08-18 12:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `department_media`
--

CREATE TABLE `department_media` (
  `id` int(11) NOT NULL,
  `source_id` int(200) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL,
  `project_id` int(200) DEFAULT NULL,
  `task_id` int(200) DEFAULT NULL,
  `folder_name` varchar(120) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `media_dir` varchar(200) NOT NULL,
  `media_type` varchar(200) NOT NULL,
  `uploaded_by` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `workgroup_id` int(200) DEFAULT NULL,
  `forum_id` int(200) NOT NULL,
  `wiki_id` int(200) NOT NULL,
  `media_access` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_media`
--

INSERT INTO `department_media` (`id`, `source_id`, `parent_id`, `lft`, `rght`, `project_id`, `task_id`, `folder_name`, `file_name`, `size`, `media_dir`, `media_type`, `uploaded_by`, `department_id`, `workgroup_id`, `forum_id`, `wiki_id`, `media_access`, `created`, `modified`) VALUES
(1, 3, NULL, 1, 28, 3, NULL, 'Business Development', '', 0, 'files/media', '', 11, 5, NULL, 0, 0, 1, '2017-11-01 09:04:55', '2017-11-04 17:47:01'),
(2, 4, 1, 2, 15, 4, NULL, 'testing new project', '', 0, 'files/media/Business Development', '', 11, 5, NULL, 0, 0, 1, '2017-11-01 09:15:37', '2017-11-01 09:15:37'),
(3, 0, NULL, 29, 30, NULL, NULL, 'Finance', '', 0, 'files/media', '', 0, 1, NULL, 0, 0, 1, '2017-11-04 17:46:11', '2017-11-04 17:46:11'),
(4, 0, NULL, 31, 32, NULL, NULL, 'Sales & Marketing', '', 0, 'files/media', '', 0, 2, NULL, 0, 0, 1, '2017-11-04 17:46:39', '2017-11-04 17:46:39'),
(5, 0, NULL, 33, 34, NULL, NULL, 'Human Resource & Administration', '', 0, 'files/media', '', 0, 3, NULL, 0, 0, 1, '2017-11-04 17:46:49', '2017-11-04 17:46:49'),
(6, 0, NULL, 35, 36, NULL, NULL, 'Operations', '', 0, 'files/media', '', 0, 4, NULL, 0, 0, 1, '2017-11-04 17:46:55', '2017-11-04 17:46:55'),
(7, 0, NULL, 37, 38, NULL, NULL, 'Trade & Commerce', '', 0, 'files/media', '', 0, 6, NULL, 0, 0, 1, '2017-11-04 17:47:06', '2017-11-04 17:47:06'),
(8, 0, NULL, 39, 40, NULL, NULL, 'Information & Technology', '', 0, 'files/media', '', 0, 7, NULL, 0, 0, 1, '2017-11-04 17:47:15', '2017-11-04 17:47:15'),
(9, 0, NULL, 41, 42, NULL, NULL, 'Risk & Internal Control', '', 0, 'files/media', '', 0, 8, NULL, 0, 0, 1, '2017-11-04 17:47:19', '2017-11-04 17:47:19'),
(10, 0, 1, 16, 17, NULL, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 09:46:17', '2017-11-11 09:46:17'),
(11, 0, 1, 18, 19, NULL, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 09:49:46', '2017-11-11 09:49:46'),
(12, 0, 1, 20, 21, NULL, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 09:53:49', '2017-11-11 09:53:49'),
(13, 0, 1, 22, 23, NULL, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 09:56:33', '2017-11-11 09:56:33'),
(14, 1, NULL, 43, 46, 1, 1, '', 'confirmation.pdf', 298474, 'webroot//Testing media uploads 1', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:10:39', '2017-11-11 10:10:39'),
(15, 1, 14, 44, 45, 1, NULL, '', 'confirmation.pdf', 298474, 'webroot/webroot//Testing media uploads 1/Testing and updating the portal', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:11:08', '2017-11-11 10:11:08'),
(16, 4, 2, 3, 4, 4, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development/testing new project', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:20:21', '2017-11-11 10:20:21'),
(17, 4, 2, 5, 6, 4, NULL, '', 'fifthlight-logo.jpeg', 117596, 'webroot/files/media/Business Development/testing new project', 'image/jpeg', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:21:10', '2017-11-11 10:21:10'),
(18, 4, 2, 7, 8, 4, NULL, '', 'confirmation.pdf', 298474, 'webroot/files/media/Business Development/testing new project', 'application/pdf', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:22:55', '2017-11-11 10:22:55'),
(19, 4, 2, 9, 10, 4, NULL, '', 'fifthlight-logo.jpeg', 117596, 'webroot/files/media/Business Development/testing new project', 'image/jpeg', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:45:32', '2017-11-11 10:45:32'),
(20, 4, 2, 11, 12, 4, NULL, '', 'fifthlight-logo.jpeg', 117596, 'webroot/files/media/Business Development/testing new project', 'image/jpeg', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:46:58', '2017-11-11 10:46:58'),
(21, 4, 2, 13, 14, 4, NULL, '', 'fifthlight-logo.jpeg', 117596, 'webroot/files/media/Business Development/testing new project', 'image/jpeg', 11, 5, NULL, 0, 0, 1, '2017-11-11 10:48:45', '2017-11-11 10:48:45'),
(22, 0, 1, 24, 25, NULL, NULL, '', 'leave-request form.doc', 87040, 'webroot/files/media/Business Development', 'application/msword', 11, 5, NULL, 0, 0, 1, '2017-11-12 15:07:47', '2017-11-12 15:07:47'),
(23, 0, 1, 26, 27, NULL, NULL, '', 'jacob school transcripts-20171102t112936z-001.zip', 2997406, 'webroot/files/media/Business Development', 'application/zip', 11, 5, NULL, 0, 0, 1, '2017-11-12 15:10:33', '2017-11-12 15:10:33'),
(24, 4, NULL, 47, 48, NULL, NULL, '', 'banner-2-1.jpg', 179270, 'webroot/files/media/Business Development/', 'image/jpeg', 11, 5, NULL, 0, 4, 1, '2017-12-14 15:29:12', '2017-12-14 15:29:12'),
(25, 4, NULL, 49, 50, NULL, NULL, '', 'banner-3-1.jpg', 139122, 'webroot/files/media/Business Development/', 'image/jpeg', 11, 5, NULL, 0, 4, 1, '2017-12-14 15:32:00', '2017-12-14 15:32:00'),
(26, 4, NULL, 51, 52, NULL, NULL, '', 'agritop.minister.tour (166 of 179).jpg', 5355036, 'webroot/files/media/Business Development/my new wiki', 'image/jpeg', 11, 5, NULL, 0, 4, 1, '2017-12-14 15:39:03', '2017-12-14 15:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `department_messages`
--

CREATE TABLE `department_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` int(10) UNSIGNED NOT NULL,
  `to` int(10) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department_news`
--

CREATE TABLE `department_news` (
  `id` int(150) UNSIGNED NOT NULL,
  `category_id` int(150) DEFAULT NULL,
  `department_id` int(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `story` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_news`
--

INSERT INTO `department_news` (`id`, `category_id`, `department_id`, `title`, `summary`, `story`, `image`, `user_id`, `created`, `modified`) VALUES
(1, 1, 1, 'test news', 'this is just a sample summary', '<p>thank for the story</p>\r\n', '', 1, '2017-08-17 22:01:05', '2017-08-17 22:01:05'),
(2, 1, 3, 'Yes i told you', 'We are making progress', '<p>oh yessss</p>\r\n', '', 1, '2017-08-17 22:02:05', '2017-08-17 22:02:05'),
(3, 1, 4, 'Test news 1', 'About the Teaching Series, The Last Days According to Jesus', '<p>What did Jesus mean when He said to His disciples that some of them would not taste death until they saw the Son of Man coming in His kingdom? What is meant when the book of Revelation says that the things prophesied therein &ldquo;must soon take place&rdquo;? Comments such as these have raised many questions, causing some to conclude that Jesus was wrong about the time of His second coming. In this series,&nbsp;R.C.&nbsp;Sproul examines the time-texts associated with the Olivet Discourse and the book of Revelation, demonstrating that when properly understood, they are actually strong evidence for the truthfulness of&nbsp;Scripture.</p>\r\n', '', 14, '2017-08-18 11:32:03', '2017-08-18 11:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `department_projects`
--

CREATE TABLE `department_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL COMMENT 'The deadline of the created project',
  `end_date` datetime NOT NULL,
  `status` varchar(12) NOT NULL COMMENT 'The status of the project. Can store values such as COMPLETED, PROGRESS, CANCELLED',
  `progress` int(3) NOT NULL,
  `monitor_timeline` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_projects`
--

INSERT INTO `department_projects` (`id`, `department_id`, `name`, `description`, `created_by`, `start_date`, `end_date`, `status`, `progress`, `monitor_timeline`, `created`, `modified`) VALUES
(1, 5, 'Testing and updating the portal', '<p>Adding features and optimising user experience</p>\r\n', 11, '2017-10-26 11:46:00', '2017-10-31 13:46:00', '1', 0, 3, '2017-10-26 11:47:23', '2017-10-26 12:10:16'),
(2, 3, 'testing projects', '<p>new</p>\r\n', 35, '2017-11-08 00:00:00', '2017-11-30 02:00:00', '1', 0, 3, '2017-11-01 07:02:56', '2017-11-01 07:02:56'),
(3, 5, 'Testing uploads', '<p>testing</p>\r\n', 11, '2017-11-16 00:00:00', '2017-11-30 02:00:00', '1', 0, 3, '2017-11-01 09:04:55', '2017-11-01 09:04:55'),
(4, 5, 'testing new project', '<p>description</p>\r\n', 11, '2017-11-30 00:00:00', '2017-12-30 02:00:00', '1', 0, 3, '2017-11-01 09:15:37', '2017-11-01 09:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `department_project_members`
--

CREATE TABLE `department_project_members` (
  `id` int(200) UNSIGNED NOT NULL,
  `project_id` int(200) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_project_members`
--

INSERT INTO `department_project_members` (`id`, `project_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, '9', '2017-11-01 08:44:42', '2017-11-01 08:44:42'),
(2, 1, '10', '2017-11-01 08:44:42', '2017-11-01 08:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `department_tasks`
--

CREATE TABLE `department_tasks` (
  `id` int(20) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `department_id` int(20) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `progress` int(3) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `notes` mediumtext NOT NULL,
  `attended_by` varchar(255) NOT NULL,
  `reviewed_by` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_tasks`
--

INSERT INTO `department_tasks` (`id`, `user_id`, `department_id`, `project_id`, `name`, `description`, `progress`, `deadline`, `status`, `notes`, `attended_by`, `reviewed_by`, `created`, `modified`) VALUES
(1, '', 5, '1', 'Testing media uploads 1', 'this is just a test block', 0, '0000-00-00 00:00:00', 1, '', '', '', '2017-10-26 11:47:54', '2017-10-26 12:03:01'),
(2, '', 5, '1', 'one task', 'one task description', 0, '0000-00-00 00:00:00', 1, '', '', '', '2017-10-26 13:41:43', '2017-10-26 13:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `department_wiki`
--

CREATE TABLE `department_wiki` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(200) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_wiki`
--

INSERT INTO `department_wiki` (`id`, `department_id`, `user_id`, `title`, `content`, `created`, `modified`) VALUES
(1, 5, 11, 'test wiki', '', '2017-12-14 14:08:06', '2017-12-14 14:08:06'),
(2, 5, 11, 'testing wiki', '<p>this is a test transmittion</p>\r\n', '2017-12-14 15:07:15', '2017-12-14 15:07:15'),
(3, 5, 11, 'testing wiki', '<p>this is a test transmittion</p>\r\n', '2017-12-14 15:07:46', '2017-12-14 15:07:46'),
(4, 5, 11, 'my new wiki', '<p>wiki content here</p>\r\n', '2017-12-14 15:25:23', '2017-12-14 15:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` mediumtext,
  `location` varchar(255) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `location`, `from_date`, `to_date`, `registration_deadline`, `image`, `user_id`, `status`, `created`, `modified`) VALUES
(1, 'This is a test event', '<p>Oh this is a test event, why are you asking?</p>\r\n', 'New York', '2017-12-18 00:00:00', '2017-12-30 02:00:00', '2017-12-21 00:00:00', NULL, 11, 0, '2017-12-18 09:01:49', '2017-12-18 09:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `events_members`
--

CREATE TABLE `events_members` (
  `id` int(120) NOT NULL,
  `event_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_members`
--

INSERT INTO `events_members` (`id`, `event_id`, `user_id`, `status`, `comment`, `created`, `modified`) VALUES
(1, 1, 11, 1, '', '2017-12-18 09:11:06', '2017-12-18 09:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(100) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `department_id`, `user_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 1, 6, 'iOS 11 Beta', '<p>So far, I&#39;m enjoying the beta on my iPad Pro 9.7.</p>\r\n\r\n<p>A few things I&#39;ve noticed so far:</p>\r\n\r\n<p>*Chrome is displaying the web address toward the right corner of the bar*</p>\r\n\r\n<p>*My display appears to be dimmer than normal*</p>\r\n\r\n<p>*Scrolling seems faster, really wish I could see it on the newer iPads with the faster refresh displays*</p>\r\n\r\n<p>*No app crashes so far, but I&#39;ve had some freeze up for a few moments*</p>\r\n\r\n<p>All in all, I think this is going to be a huge relegation for iPad owners who wish for a bit more utility from the world&#39;s best pure tablet.</p>\r\n\r\n<p>How has your experience been?</p>\r\n', '2017-08-15 11:44:22', '2017-08-15 11:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(100) NOT NULL,
  `holiday` text NOT NULL,
  `holiday_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday`, `holiday_date`, `created`, `modified`) VALUES
(1, 'Custom Holiday', '2017-10-25', '2017-10-24 06:44:57', '2017-10-24 06:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `leave_days`
--

CREATE TABLE `leave_days` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `annual_leave_days` int(10) NOT NULL DEFAULT '0',
  `study_leave_days` int(10) NOT NULL DEFAULT '0',
  `maternity_leave_days` int(10) NOT NULL DEFAULT '0',
  `paternity_leave_days` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_days`
--

INSERT INTO `leave_days` (`id`, `user_id`, `annual_leave_days`, `study_leave_days`, `maternity_leave_days`, `paternity_leave_days`, `created`, `modified`) VALUES
(1, 9, 30, 5, 0, 5, '2017-10-31 11:47:00', '2017-10-31 13:20:05'),
(2, 23, 30, 5, 0, 5, '2017-10-31 11:47:56', '2017-10-31 13:20:22'),
(3, 29, 30, 0, 0, 0, '2017-10-31 11:48:14', '2017-10-31 11:48:14'),
(4, 35, 30, 0, 0, 0, '2017-10-31 11:48:37', '2017-10-31 11:48:37'),
(5, 14, 30, 5, 0, 5, '2017-10-31 11:48:53', '2017-10-31 13:20:32'),
(6, 10, 30, 5, 0, 5, '2017-10-31 11:49:28', '2017-10-31 13:20:40'),
(7, 12, 30, 5, 0, 5, '2017-10-31 11:49:44', '2017-10-31 13:20:57'),
(8, 16, 25, 5, 0, 5, '2017-10-31 11:50:04', '2017-10-31 13:21:20'),
(9, 17, 25, 5, 0, 5, '2017-10-31 11:50:46', '2017-10-31 13:21:36'),
(10, 18, 25, 5, 0, 5, '2017-10-31 11:51:03', '2017-10-31 13:21:52'),
(11, 30, 25, 0, 0, 0, '2017-10-31 11:51:25', '2017-10-31 11:51:25'),
(12, 11, 7, 5, 90, 0, '2017-10-31 11:51:40', '2017-10-31 17:11:34'),
(13, 34, 25, 0, 0, 0, '2017-10-31 11:52:01', '2017-10-31 11:52:01'),
(14, 25, 25, 5, 0, 5, '2017-10-31 11:52:19', '2017-10-31 13:22:39'),
(15, 13, 25, 5, 90, 0, '2017-10-31 11:52:41', '2017-10-31 13:23:00'),
(16, 33, 25, 0, 0, 0, '2017-10-31 11:53:11', '2017-10-31 11:53:11'),
(17, 31, 25, 0, 0, 0, '2017-10-31 11:53:31', '2017-10-31 11:53:31'),
(18, 19, 25, 5, 0, 5, '2017-10-31 11:53:45', '2017-10-31 13:23:14'),
(19, 20, 25, 5, 90, 0, '2017-10-31 11:54:03', '2017-10-31 13:24:12'),
(20, 21, 25, 5, 0, 5, '2017-10-31 11:54:18', '2017-10-31 13:24:26'),
(21, 37, 25, 0, 0, 0, '2017-10-31 11:54:38', '2017-10-31 11:54:38'),
(22, 26, 25, 5, 0, 5, '2017-10-31 11:54:55', '2017-10-31 13:24:51'),
(23, 32, 0, 0, 0, 0, '2017-10-31 11:55:14', '2017-11-01 04:59:39'),
(24, 15, 25, 5, 0, 5, '2017-10-31 11:55:40', '2017-10-31 13:25:33'),
(25, 36, 25, 0, 0, 0, '2017-10-31 11:56:07', '2017-10-31 11:56:07'),
(26, 22, 25, 5, 0, 5, '2017-10-31 11:56:24', '2017-10-31 13:25:43'),
(27, 27, 25, 5, 0, 5, '2017-10-31 11:56:48', '2017-10-31 13:25:54'),
(28, 28, 25, 5, 0, 5, '2017-10-31 11:57:11', '2017-10-31 13:26:03'),
(29, 24, 25, 5, 0, 5, '2017-10-31 11:57:26', '2017-10-31 13:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(200) UNSIGNED NOT NULL,
  `request_type` int(1) NOT NULL,
  `leave_type` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `resumption_date` date NOT NULL,
  `number_of_days_requested` int(11) NOT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `address` text NOT NULL,
  `comments` longtext,
  `guarantor_remarks` longtext,
  `leave_entitlement` int(10) DEFAULT NULL,
  `leave_taken` int(10) DEFAULT NULL,
  `leave_days_remaining` int(10) DEFAULT NULL,
  `leave_travel_allowance` int(10) DEFAULT NULL,
  `meal_allowance` int(10) DEFAULT NULL,
  `leave_holidays` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(200) NOT NULL,
  `relieved_by` int(200) NOT NULL,
  `recommended_by` int(200) NOT NULL,
  `recommended_date` datetime DEFAULT NULL,
  `department_id` int(200) NOT NULL,
  `approved_by` int(200) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `approved_by_management` int(200) NOT NULL,
  `approved_m_date` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `request_type`, `leave_type`, `start_date`, `end_date`, `resumption_date`, `number_of_days_requested`, `tel`, `email`, `address`, `comments`, `guarantor_remarks`, `leave_entitlement`, `leave_taken`, `leave_days_remaining`, `leave_travel_allowance`, `meal_allowance`, `leave_holidays`, `status`, `user_id`, `relieved_by`, `recommended_by`, `recommended_date`, `department_id`, `approved_by`, `approved_date`, `approved_by_management`, `approved_m_date`, `created`, `modified`) VALUES
(1, 1, 'Annual', '2017-11-02', '2017-12-07', '2017-12-08', 25, NULL, 'jnartey@gmail.com', 'CO DTD 142 AI 24\r\nCommunity 5', 'This is just a test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 32, 31, 0, NULL, 2, 29, '2017-11-01 05:32:31', 35, '2017-11-01 05:40:26', '2017-11-01 04:59:39', '2017-11-01 05:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `level` varchar(50) NOT NULL,
  `scope` varchar(50) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text,
  `context` text,
  `department` int(100) NOT NULL,
  `workgroup` int(100) NOT NULL,
  `source` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(1, '2017-10-11 01:47:29', 'info', 'User login', 1, 'user logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(2, '2017-10-11 01:52:32', 'info', 'User login', 1, 'user logged in', '[]', 0, 0, 0),
(3, '2017-10-11 01:58:42', 'info', 'User login', 1, ' logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(4, '2017-10-11 02:10:49', 'info', 'User login', 1, 'user logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/users\\/login?redirect=%2Fusers%2Flogout\"}', 0, 0, 0),
(5, '2017-10-11 07:56:36', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/admin\\/users\\/view\\/10\"}', 0, 0, 0),
(6, '2017-10-11 08:03:45', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/admin\\/users\\/login?redirect=%2Fadmin%2Fpages\"}', 0, 0, 0),
(7, '2017-10-11 08:04:16', 'info', 'Users', 1, 'Fifthlight Media updated Elton Dusi', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/admin\\/users\\/view\\/9\"}', 0, 0, 0),
(8, '2017-10-11 08:05:37', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"fe2c91d2088c42bd693b50d170a04730\"},\"url\":\"admin\\/users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(9, '2017-10-11 08:09:26', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/pages\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/pages\"},\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"ec05ff0c92a5b2f396bc0a0f0521d8e5\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(10, '2017-10-11 08:09:42', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"023488585476d6d26d0f2169becbccf6\"},\"url\":\"admin\\/users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(11, '2017-10-12 11:35:24', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/pages\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/pages\"},\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"3c0d520d50c1a8944bed496de7b8fc6e\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(12, '2017-10-17 09:17:39', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"username\":\"sdebruyn\",\"password\":\"passportal\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"ff98ec01a3bb7a2e81f2151835d765a2\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(13, '2017-10-20 02:22:38', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added testing', '{\"request\":{\"params\":{\"controller\":\"Workgroups\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"name\":\"testing\",\"description\":\"test workgroup\",\"approve_members\":\"1\",\"content_access\":\"1\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"667ccef543d69dad1dd782defecf30c9\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(14, '2017-10-20 06:38:50', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"667ccef543d69dad1dd782defecf30c9\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(15, '2017-10-20 06:39:09', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"682cbf846738b0def909c0228642aa04\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(16, '2017-10-20 10:37:42', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"f8e1bef57a3ef41455614a4f723a0039\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"admin\\/users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(17, '2017-10-20 10:37:55', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/pages\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/pages\"},\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"58915358bfc9e8a00fd3cf3235841aa7\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(18, '2017-10-21 07:14:51', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"1a9c4ff7da3d7adbb618fdf3767e6f75\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(19, '2017-10-21 07:15:05', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(20, '2017-10-23 11:52:43', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(21, '2017-10-23 11:52:43', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(22, '2017-10-23 11:53:07', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(23, '2017-10-23 11:53:07', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(24, '2017-10-23 11:56:03', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(25, '2017-10-23 11:56:03', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(26, '2017-10-23 11:59:05', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(27, '2017-10-23 11:59:05', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(28, '2017-10-23 12:00:33', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(29, '2017-10-23 12:00:33', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(30, '2017-10-23 12:01:52', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(31, '2017-10-23 12:01:52', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"0\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"0\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(32, '2017-10-23 12:06:18', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added test', '{\"request\":{\"params\":{\"controller\":\"Workgroups\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"name\":\"test\",\"description\":\"testing workgroup\",\"approve_members\":\"1\",\"content_access\":\"1\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(33, '2017-10-23 12:09:37', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(34, '2017-10-23 12:09:37', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(35, '2017-10-23 12:10:09', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(36, '2017-10-23 12:10:09', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(37, '2017-10-23 12:11:19', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(38, '2017-10-23 12:11:19', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(39, '2017-10-23 12:13:34', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(40, '2017-10-23 12:13:34', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d0ee49d468a63f4ad8c623ebbee8be587499777cc74eb50346b245a9e1e097e0b6e641c5801568e0869e35707ec9bf21bc3ae034ad2e5fea4c00b17980a2a7a0\",\"CAKEPHP\":\"32cf43c474ff680aea964c4afb2f7a50\",\"_ga\":\"GA1.1.68773806.1508062653\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(41, '2017-10-23 12:18:55', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(42, '2017-10-23 12:19:22', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(43, '2017-10-23 12:19:22', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(44, '2017-10-23 12:22:05', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(45, '2017-10-23 12:22:05', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(46, '2017-10-23 12:22:32', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(47, '2017-10-23 12:22:32', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(48, '2017-10-23 12:24:12', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(49, '2017-10-23 12:24:12', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(50, '2017-10-23 12:24:32', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(51, '2017-10-23 12:24:32', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(52, '2017-10-23 12:25:10', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(53, '2017-10-23 12:25:10', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(54, '2017-10-23 12:25:42', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(55, '2017-10-23 12:25:42', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(56, '2017-10-23 12:29:50', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(57, '2017-10-23 12:29:50', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(58, '2017-10-23 12:33:55', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(59, '2017-10-23 12:33:55', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(60, '2017-10-23 12:37:30', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Diana Osei Antwi to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(61, '2017-10-23 12:37:30', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Standley Andoh to workgroup::', '{\"request\":{\"params\":{\"controller\":\"WorkgroupsMembers\",\"action\":\"add\",\"pass\":[\"6\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"user_id\":[\"37\",\"38\"],\"workgroup_id\":\"6\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups-members\\/add\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups-members\\/add\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(62, '2017-10-23 14:16:53', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"CAKEPHP\":\"1a22268e2e4fb5bd6d7964ca6204d824\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(63, '2017-10-23 16:59:19', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added This is a test workgroup', '{\"request\":{\"params\":{\"controller\":\"Workgroups\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"name\":\"This is a test workgroup\",\"description\":\"This a test workgroup description\",\"approve_members\":\"1\",\"content_access\":\"1\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(64, '2017-10-23 17:02:59', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added This a test workgroup', '{\"request\":{\"params\":{\"controller\":\"Workgroups\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"name\":\"This a test workgroup\",\"description\":\"This a test workgroup description\",\"approve_members\":\"1\",\"content_access\":\"1\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(65, '2017-10-23 17:07:07', 'info', 'Workgroup', 11, 'Sophiaa De-Bruyn added Test', '{\"request\":{\"params\":{\"controller\":\"Workgroups\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"name\":\"Test\",\"description\":\"test workgroup description\",\"approve_members\":\"1\",\"content_access\":\"1\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroups\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroups\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(66, '2017-10-23 17:15:06', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Array', '{\"request\":{\"params\":{\"controller\":\"WorkgroupMedia\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php4u6KKZ\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroup\\/workgroup-media\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-media\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(67, '2017-10-23 17:23:57', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"WorkgroupMedia\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpTTcPE7\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroup\\/workgroup-media\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-media\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(68, '2017-10-23 17:33:24', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"WorkgroupMedia\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpbTHFM2\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroup\\/workgroup-media\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-media\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(69, '2017-10-23 20:11:59', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/departments\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/departments\"},\"cookies\":{\"CAKEPHP\":\"80e32132e119e91f8b8af31c0bb21cf3\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(70, '2017-10-23 20:12:10', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(71, '2017-10-23 20:14:23', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(72, '2017-10-23 20:15:47', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(73, '2017-10-23 20:17:45', 'info', 'Department', 1, 'Fifthlight Media edited Sales & Marketing', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"2\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Sales & Marketing\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(74, '2017-10-23 20:17:51', 'info', 'Department', 1, 'Fifthlight Media edited Human Resource & Administration', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"3\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"3\",\"name\":\"Human Resource & Administration\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/3\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/3\",\"trustProxy\":false}}', 0, 0, 0),
(75, '2017-10-23 20:18:02', 'info', 'Department', 1, 'Fifthlight Media edited Operations', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"4\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Operations\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(76, '2017-10-23 20:18:09', 'info', 'Department', 1, 'Fifthlight Media edited Business Development', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"5\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Business Development\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/5\",\"trustProxy\":false}}', 0, 0, 0),
(77, '2017-10-23 20:18:14', 'info', 'Department', 1, 'Fifthlight Media edited Trade & Commerce', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"6\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Trade & Commerce\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(78, '2017-10-23 20:18:20', 'info', 'Department', 1, 'Fifthlight Media edited Information & Technology', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"7\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Information & Technology\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/7\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/7\",\"trustProxy\":false}}', 0, 0, 0),
(79, '2017-10-23 20:18:26', 'info', 'Department', 1, 'Fifthlight Media edited Risk & Internal Control', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"8\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Risk & Internal Control\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/8\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/8\",\"trustProxy\":false}}', 0, 0, 0),
(80, '2017-10-23 20:19:42', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(81, '2017-10-23 20:34:11', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(82, '2017-10-23 20:37:08', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(83, '2017-10-23 20:40:06', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(84, '2017-10-23 20:42:04', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(85, '2017-10-23 20:42:36', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(86, '2017-10-23 20:45:27', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(87, '2017-10-23 20:46:30', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(88, '2017-10-23 20:47:40', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2f6856cba03cc0e2e0fdb8dc4d54892c\",\"csrfToken\":\"dbc6ac75bfc1091cd0b432f229979f7bd688d44e4f26151a48fa503b862ca96b53099a74309eb2260b15cb7e63d66fd73804fac33714a9bb3748f3441e3c9a4c\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(89, '2017-10-23 21:07:22', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpooxY4A\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(90, '2017-10-23 21:25:42', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpshzqPw\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(91, '2017-10-23 21:44:40', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"WorkgroupMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpzUV3Mm\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"a8651289f3cdbf0edf352fd7afe7f0c2ae8c38cabe41365b23689a24bf6a7555f79397a37cfe27ae72115eb2e557d0ec8163e3f58dc9b5453195f56c012cecd0\",\"CAKEPHP\":\"ba7ac4009c473c44117f75eb298def3b\"},\"url\":\"workgroup\\/workgroup-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(92, '2017-10-23 22:50:13', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"2be005a7d6eb17f283489d797c195d07\",\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(93, '2017-10-24 04:18:37', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"451799cdfa0f1d31eb00d9db6f537619\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(94, '2017-10-24 04:18:55', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(95, '2017-10-24 05:43:25', 'info', 'Event', 11, 'Sophiaa De-Bruyn added Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"from_date\":\"2017-10-24 00:00:00\",\"to_date\":\"2017-10-24 02:00:00\",\"registration_deadline\":\"2017-10-25 00:00:00\",\"name\":\"Test event\",\"description\":\"<p>description<\\/p>\\r\\n\",\"location\":\"tema\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-events\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(96, '2017-10-24 05:46:05', 'info', 'Event', 11, 'Sophiaa De-Bruyn added Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"from_date\":\"2017-10-24 00:00:00\",\"to_date\":\"2017-10-24 02:00:00\",\"registration_deadline\":\"2017-10-25 00:00:00\",\"name\":\"Test event\",\"description\":\"<p>description<\\/p>\\r\\n\",\"location\":\"tema\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-events\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(97, '2017-10-24 06:15:46', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Fifth Light Project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"1\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"Fifth Light Project\",\"description\":\"<p>description here<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(98, '2017-10-24 06:27:00', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/departments\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/departments\"},\"cookies\":{\"CAKEPHP\":\"c1f0e85fcb55497f3cb054f68288ea70\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(99, '2017-10-24 07:55:50', 'info', 'Project', 11, 'Sophiaa De-Bruyn deleted Fifth Light Project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"delete\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/delete\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/delete\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(100, '2017-10-24 08:40:00', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"Test Projects\",\"description\":\"<p>description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(101, '2017-10-24 08:42:58', 'info', 'Project', 11, 'Sophiaa De-Bruyn added workgroup project', '{\"request\":{\"params\":{\"controller\":\"WorkgroupProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"workgroup_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"workgroup project\",\"description\":\"<p>description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"workgroup\\/workgroup-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(102, '2017-10-24 08:51:32', 'info', 'Task', 11, 'Sophiaa De-Bruyn deleted Great this works', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"delete\",\"pass\":[\"5\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/delete\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/delete\\/5\",\"trustProxy\":false}}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(103, '2017-10-24 08:53:22', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Elton Dusi to project::Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-project-members\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(104, '2017-10-24 08:53:22', 'info', 'Project', 11, 'Sophiaa De-Bruyn added William  Narh - Adjabeng to project::Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-project-members\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(105, '2017-10-24 08:53:53', 'info', 'Task', 11, 'Sophiaa De-Bruyn added test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"test task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(106, '2017-10-24 08:53:53', 'info', 'Task', 11, 'Sophiaa De-Bruyn added test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"test task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(107, '2017-10-24 08:53:53', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned William  Narh - Adjabeng to task::test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"test task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(108, '2017-10-24 08:56:38', 'info', 'Task', 11, 'Sophiaa De-Bruyn commented on test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"view\",\"pass\":[\"0\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"2\",\"source_id\":\"0\",\"project_id\":\"2\",\"user_id\":\"11\",\"comment\":\"test\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/view\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/view\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(109, '2017-10-24 09:02:25', 'info', 'Task', 11, 'Sophiaa De-Bruyn commented on test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"view\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"2\",\"source_id\":\"1\",\"project_id\":\"2\",\"user_id\":\"11\",\"comment\":\"correcting error\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/view\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/view\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(110, '2017-10-24 09:04:59', 'info', 'Task', 11, 'Sophiaa De-Bruyn commented on test task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"view\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"2\",\"source_id\":\"1\",\"project_id\":\"2\",\"user_id\":\"11\",\"comment\":\"correcting error\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/view\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/view\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(111, '2017-10-24 09:37:03', 'info', 'Media', 11, 'Sophiaa De-Bruyn created folder - test', '{\"request\":{\"params\":{\"controller\":\"Media\",\"action\":\"addFolder\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test\",\"media_access\":\"1\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(112, '2017-10-24 09:42:55', 'info', 'Media', 11, 'Sophiaa De-Bruyn created folder - test 2', '{\"request\":{\"params\":{\"controller\":\"Media\",\"action\":\"addFolder\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test 2\",\"media_access\":\"1\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(113, '2017-10-24 09:47:39', 'info', 'Forum', 11, 'Sophiaa De-Bruyn created folder - test', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"addFolder\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test\",\"media_access\":\"3\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(114, '2017-10-24 09:49:46', 'info', 'Forum', 11, 'Sophiaa De-Bruyn created folder - test 2', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"addFolder\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test 2\",\"media_access\":\"3\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(115, '2017-10-24 09:50:30', 'info', 'Forum', 11, 'Sophiaa De-Bruyn created folder - test 3', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"addFolder\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test 3\",\"media_access\":\"3\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(116, '2017-10-24 10:00:29', 'info', 'Media', 11, 'Sophiaa De-Bruyn created folder - test', '{\"request\":{\"params\":{\"controller\":\"WorkgroupMedia\",\"action\":\"addFolder\",\"pass\":[],\"prefix\":\"workgroup\",\"plugin\":null,\"_matchedRoute\":\"\\/workgroup\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"folder_name\":\"test\",\"media_access\":\"3\"},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"workgroup\\/workgroup-media\\/add_folder\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/workgroup\\/workgroup-media\\/add_folder\",\"trustProxy\":false}}', 0, 0, 0),
(117, '2017-10-24 10:12:22', 'info', 'Project', 11, 'Sophiaa De-Bruyn commented on Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"comments\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"1\",\"source_id\":\"2\",\"project_id\":\"2\",\"user_id\":\"11\",\"comment\":\"test\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/comments\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/comments\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(118, '2017-10-24 10:18:12', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpSNKM1C\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(119, '2017-10-24 10:18:33', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpM0dWdd\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(120, '2017-10-24 10:37:21', 'info', 'Project', 11, 'Sophiaa De-Bruyn added test', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 10:37:05\",\"end_date\":\"2017-10-31 12:37:05\",\"name\":\"test\",\"description\":\"<p>test description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(121, '2017-10-24 10:39:08', 'info', 'Project', 11, 'Sophiaa De-Bruyn added my project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"my project\",\"description\":\"<p>des<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(122, '2017-10-24 10:39:28', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Elton Dusi to project::my project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"9\"],\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-project-members\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(123, '2017-10-24 10:39:58', 'info', 'Task', 11, 'Sophiaa De-Bruyn added testing tasks', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"testing tasks\",\"department_id\":\"\",\"description\":\"ok\",\"user_id\":[\"9\"],\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(124, '2017-10-24 10:39:58', 'info', 'Task', 11, 'Sophiaa De-Bruyn added testing tasks', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"testing tasks\",\"department_id\":\"\",\"description\":\"ok\",\"user_id\":[\"9\"],\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(125, '2017-10-24 10:39:58', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned Elton Dusi to task::testing tasks', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"testing tasks\",\"department_id\":\"\",\"description\":\"ok\",\"user_id\":[\"9\"],\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(126, '2017-10-25 06:42:43', 'info', 'Project', 11, 'Sophiaa De-Bruyn deleted Elton Dusi from project::my project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"delete\",\"pass\":[\"3\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-project-members\\/delete\\/3\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/delete\\/3\",\"trustProxy\":false}}', 0, 0, 0),
(127, '2017-10-25 06:43:13', 'info', 'Task', 11, 'Sophiaa De-Bruyn added task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task\",\"department_id\":\"\",\"description\":\"testing my task\",\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(128, '2017-10-25 06:43:13', 'info', 'Task', 11, 'Sophiaa De-Bruyn added task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task\",\"department_id\":\"\",\"description\":\"testing my task\",\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(129, '2017-10-25 06:47:21', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated task 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"9\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task 1\",\"department_id\":\"5\",\"description\":\"testing my task\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/edit\\/9\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/9\",\"trustProxy\":false}}', 0, 0, 0),
(130, '2017-10-25 06:47:30', 'info', 'Project', 11, 'Sophiaa De-Bruyn added William  Narh - Adjabeng to project::my project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"10\"],\"project_id\":\"4\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-project-members\\/add\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(131, '2017-10-25 06:47:47', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated task 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"9\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task 1\",\"department_id\":\"5\",\"description\":\"testing my task\",\"user_id\":[\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/edit\\/9\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/9\",\"trustProxy\":false}}', 0, 0, 0),
(132, '2017-10-25 06:47:47', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated and assigned William  Narh - Adjabeng to task::task 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"9\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task 1\",\"department_id\":\"5\",\"description\":\"testing my task\",\"user_id\":[\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/edit\\/9\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/9\",\"trustProxy\":false}}', 0, 0, 0),
(133, '2017-10-25 06:48:43', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated task 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"9\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task 1\",\"department_id\":\"5\",\"description\":\"testing my task\",\"user_id\":[\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/edit\\/9\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/9\",\"trustProxy\":false}}', 0, 0, 0),
(134, '2017-10-25 06:48:43', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated and assigned William  Narh - Adjabeng to task::task 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"9\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"task 1\",\"department_id\":\"5\",\"description\":\"testing my task\",\"user_id\":[\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"e6da2e0cf2b8469a3c46c9b38084985e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/edit\\/9\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/9\",\"trustProxy\":false}}', 0, 0, 0),
(135, '2017-10-26 08:25:20', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(136, '2017-10-26 08:39:50', 'info', 'Project', 11, 'Sophiaa De-Bruyn edited Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"edit\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"5\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"Test Projects\",\"description\":\"<p>description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/edit\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/edit\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(137, '2017-10-26 08:41:07', 'info', 'Project', 11, 'Sophiaa De-Bruyn edited Test Projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"edit\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"5\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-24 00:00:00\",\"end_date\":\"2017-10-31 02:00:00\",\"name\":\"Test Projects\",\"description\":\"<p>description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/edit\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/edit\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(138, '2017-10-26 09:07:04', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 2017 Prayer Fasting Guide (English).pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php8867tF\",\"error\":0,\"name\":\"2017 Prayer Fasting Guide (English).pdf\",\"type\":\"application\\/pdf\",\"size\":722790}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\",\"trustProxy\":false}}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(139, '2017-10-26 09:28:01', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 2017 Prayer Fasting Guide (English).pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpltNKh4\",\"error\":0,\"name\":\"2017 Prayer Fasting Guide (English).pdf\",\"type\":\"application\\/pdf\",\"size\":722790}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(140, '2017-10-26 09:28:50', 'info', 'Task', 11, 'Sophiaa De-Bruyn added new task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"9\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(141, '2017-10-26 09:28:50', 'info', 'Task', 11, 'Sophiaa De-Bruyn added new task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"9\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(142, '2017-10-26 09:28:50', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned Elton Dusi to task::new task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task\",\"department_id\":\"\",\"description\":\"testing\",\"user_id\":[\"9\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(143, '2017-10-26 09:29:16', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 2017 Prayer Fasting Guide (English).pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\",\"10\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpdmC1h0\",\"error\":0,\"name\":\"2017 Prayer Fasting Guide (English).pdf\",\"type\":\"application\\/pdf\",\"size\":722790}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\\/10\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\\/10\",\"trustProxy\":false}}', 0, 0, 0),
(144, '2017-10-26 09:37:19', 'info', 'Task', 11, 'Sophiaa De-Bruyn added new task 2', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task 2\",\"department_id\":\"\",\"description\":\"testing new task 2\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(145, '2017-10-26 09:37:19', 'info', 'Task', 11, 'Sophiaa De-Bruyn added new task 2', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task 2\",\"department_id\":\"\",\"description\":\"testing new task 2\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(146, '2017-10-26 09:37:19', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned Elton Dusi,William  Narh - Adjabeng to task::new task 2', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"new task 2\",\"department_id\":\"\",\"description\":\"testing new task 2\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(147, '2017-10-26 09:40:42', 'info', 'Task', 11, 'Sophiaa De-Bruyn added original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"original task\",\"department_id\":\"\",\"description\":\"testing original task\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(148, '2017-10-26 09:40:42', 'info', 'Task', 11, 'Sophiaa De-Bruyn added original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"original task\",\"department_id\":\"\",\"description\":\"testing original task\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(149, '2017-10-26 09:40:42', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned Elton Dusi,William  Narh - Adjabeng to task::original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"original task\",\"department_id\":\"\",\"description\":\"testing original task\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(150, '2017-10-26 09:43:02', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 2017 Prayer Fasting Guide (English).pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\",\"12\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php5q1s8j\",\"error\":0,\"name\":\"2017 Prayer Fasting Guide (English).pdf\",\"type\":\"application\\/pdf\",\"size\":722790}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\\/12\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\\/12\",\"trustProxy\":false}}', 0, 0, 0),
(151, '2017-10-26 11:10:18', 'info', 'Task', 11, 'Sophiaa De-Bruyn added my new original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"my new original task\",\"department_id\":\"\",\"description\":\"testing description\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(152, '2017-10-26 11:10:18', 'info', 'Task', 11, 'Sophiaa De-Bruyn added my new original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"my new original task\",\"department_id\":\"\",\"description\":\"testing description\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(153, '2017-10-26 11:10:18', 'info', 'Task', 11, 'Sophiaa De-Bruyn assigned Elton Dusi,William  Narh - Adjabeng to task::my new original task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"my new original task\",\"department_id\":\"\",\"description\":\"testing description\",\"user_id\":[\"9\",\"10\"],\"project_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(154, '2017-10-26 11:10:58', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 13667843_1105694852834803_7476356508097079030_o.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\",\"13\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpxCaZ4c\",\"error\":0,\"name\":\"13667843_1105694852834803_7476356508097079030_o.jpg\",\"type\":\"image\\/jpeg\",\"size\":247506}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\\/13\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\\/13\",\"trustProxy\":false}}', 0, 0, 0),
(155, '2017-10-26 11:12:43', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 13667843_1105694852834803_7476356508097079030_o.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"2\",\"13\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"2\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php4tH4aR\",\"error\":0,\"name\":\"13667843_1105694852834803_7476356508097079030_o.jpg\",\"type\":\"image\\/jpeg\",\"size\":247506}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/2\\/13\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/2\\/13\",\"trustProxy\":false}}', 0, 0, 0),
(156, '2017-10-26 11:19:29', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/departments\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/departments\"},\"cookies\":{\"CAKEPHP\":\"994bec09034a27b5a34d9d7baf7da0d1\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(157, '2017-10-26 11:19:55', 'info', 'Department', 1, 'Fifthlight Media added', '{\"request\":{\"params\":{\"controller\":\"DepartmentsMembers\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"user_id\":\"11\",\"department_id\":\"1\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments-members\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments-members\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(158, '2017-10-26 11:20:34', 'info', 'Department', 1, 'Fifthlight Media removed Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"DepartmentsMembers\",\"action\":\"delete\",\"pass\":[\"71\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":[],\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments-members\\/delete\\/71\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments-members\\/delete\\/71\",\"trustProxy\":false}}', 0, 0, 0),
(159, '2017-10-26 11:26:16', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(160, '2017-10-26 11:28:13', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(161, '2017-10-26 11:28:33', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(162, '2017-10-26 11:29:07', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(163, '2017-10-26 11:30:06', 'info', 'Department', 1, 'Fifthlight Media edited Sales & Marketing', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"2\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Sales & Marketing\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(164, '2017-10-26 11:30:13', 'info', 'Department', 1, 'Fifthlight Media edited Human Resource & Administration', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"3\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"3\",\"name\":\"Human Resource & Administration\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/3\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/3\",\"trustProxy\":false}}', 0, 0, 0),
(165, '2017-10-26 11:30:22', 'info', 'Department', 1, 'Fifthlight Media edited Operations', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"4\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Operations\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(166, '2017-10-26 11:30:28', 'info', 'Department', 1, 'Fifthlight Media edited Business Development', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"5\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Business Development\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/5\",\"trustProxy\":false}}', 0, 0, 0),
(167, '2017-10-26 11:30:34', 'info', 'Department', 1, 'Fifthlight Media edited Trade & Commerce', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"6\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Trade & Commerce\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(168, '2017-10-26 11:30:39', 'info', 'Department', 1, 'Fifthlight Media edited Information & Technology', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"7\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Information & Technology\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/7\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/7\",\"trustProxy\":false}}', 0, 0, 0),
(169, '2017-10-26 11:30:44', 'info', 'Department', 1, 'Fifthlight Media edited Risk & Internal Control', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"8\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\"},\"data\":{\"department_type\":\"1\",\"name\":\"Risk & Internal Control\",\"description\":\"\"},\"query\":[],\"cookies\":{\"CAKEPHP\":\"84f17982d1ece1c6606208ffef90c982\",\"csrfToken\":\"8c75640d7a0e18756afd3a14af9aa066bd8626797a995aeaab0e5aea8439316d04d08207479e31d6d92933a48374b5e8cc0d30fe9d9bb3f67d0dc81eca10665f\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/departments\\/edit\\/8\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/8\",\"trustProxy\":false}}', 0, 0, 0),
(170, '2017-10-26 11:32:41', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Testing portal QA', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-26 11:31:55\",\"end_date\":\"2017-10-31 13:31:55\",\"name\":\"Testing portal QA\",\"description\":\"<p>Making sure this portal is error free<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(171, '2017-10-26 11:33:35', 'info', 'Task', 11, 'Sophiaa De-Bruyn added Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"\",\"description\":\"Make sure uploads works well thank you\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(172, '2017-10-26 11:33:35', 'info', 'Task', 11, 'Sophiaa De-Bruyn added Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"\",\"description\":\"Make sure uploads works well thank you\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(173, '2017-10-26 11:33:52', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Elton Dusi to project::Testing portal QA', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-project-members\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(174, '2017-10-26 11:33:52', 'info', 'Project', 11, 'Sophiaa De-Bruyn added William  Narh - Adjabeng to project::Testing portal QA', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-project-members\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(175, '2017-10-26 11:34:06', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"5\",\"description\":\"Make sure uploads works well thank you\",\"user_id\":[\"9\",\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(176, '2017-10-26 11:34:06', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated and assigned Elton Dusi,William  Narh - Adjabeng to task::Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"5\",\"description\":\"Make sure uploads works well thank you\",\"user_id\":[\"9\",\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(177, '2017-10-26 11:34:29', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 13667843_1105694852834803_7476356508097079030_o.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpyPN22m\",\"error\":0,\"name\":\"13667843_1105694852834803_7476356508097079030_o.jpg\",\"type\":\"image\\/jpeg\",\"size\":247506}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/1\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(178, '2017-10-26 11:44:08', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"5\",\"description\":\"Make sure uploads works well thank you\",\"user_id\":[\"9\",\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(179, '2017-10-26 11:44:08', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated and assigned Elton Dusi,William  Narh - Adjabeng to task::Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing uploads\",\"department_id\":\"5\",\"description\":\"Make sure uploads works well thank you\",\"user_id\":[\"9\",\"10\"]},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(180, '2017-10-26 11:47:23', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Testing and updating the portal', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-26 11:46:40\",\"end_date\":\"2017-10-31 13:46:40\",\"name\":\"Testing and updating the portal\",\"description\":\"<p>Adding features and optimising user experience<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(181, '2017-10-26 11:47:54', 'info', 'Task', 11, 'Sophiaa De-Bruyn added Testing media uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing media uploads\",\"department_id\":\"\",\"description\":\"this is just a test block\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(182, '2017-10-26 11:47:54', 'info', 'Task', 11, 'Sophiaa De-Bruyn added Testing media uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing media uploads\",\"department_id\":\"\",\"description\":\"this is just a test block\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(183, '2017-10-26 11:56:50', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated Testing media uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing media uploads\",\"department_id\":\"5\",\"description\":\"this is just a test block\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(184, '2017-10-26 12:03:01', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated Testing media uploads 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing media uploads 1\",\"department_id\":\"5\",\"description\":\"this is just a test block\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(185, '2017-10-26 12:04:57', 'info', 'Task', 11, 'Sophiaa De-Bruyn updated Testing media uploads 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"Testing media uploads 1\",\"department_id\":\"5\",\"description\":\"this is just a test block\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(186, '2017-10-26 12:10:16', 'info', 'Project', 11, 'Sophiaa De-Bruyn edited Testing and updating the portal', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"department_id\":\"5\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-10-26 11:46:00\",\"end_date\":\"2017-10-31 13:46:00\",\"name\":\"Testing and updating the portal\",\"description\":\"<p>Adding features and optimising user experience<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(187, '2017-10-26 13:27:38', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 13667843_1105694852834803_7476356508097079030_o.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpEOvmGA\",\"error\":0,\"name\":\"13667843_1105694852834803_7476356508097079030_o.jpg\",\"type\":\"image\\/jpeg\",\"size\":247506}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(188, '2017-10-26 13:41:43', 'info', 'Task', 11, 'Sophiaa De-Bruyn added one task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"one task\",\"department_id\":\"\",\"description\":\"one task description\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(189, '2017-10-26 13:41:44', 'info', 'Task', 11, 'Sophiaa De-Bruyn added one task', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"name\":\"one task\",\"department_id\":\"\",\"description\":\"one task description\",\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-tasks\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(190, '2017-10-26 13:48:28', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 5-excursion-robinson-crusoe.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpc30O6Q\",\"error\":0,\"name\":\"5-excursion-robinson-crusoe.jpg\",\"type\":\"image\\/jpeg\",\"size\":416831}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(191, '2017-10-26 13:51:04', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 5-excursion-robinson-crusoe.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpXf6mPm\",\"error\":0,\"name\":\"5-excursion-robinson-crusoe.jpg\",\"type\":\"image\\/jpeg\",\"size\":416831}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(192, '2017-10-26 13:53:43', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded 5-excursion-robinson-crusoe.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpry2mpj\",\"error\":0,\"name\":\"5-excursion-robinson-crusoe.jpg\",\"type\":\"image\\/jpeg\",\"size\":416831}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\",\"_gid\":\"GA1.1.1884418976.1508947454\"},\"url\":\"department\\/department-projects\\/upload\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(193, '2017-10-27 06:04:36', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\",\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpzcCs2E\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/1\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(194, '2017-10-27 06:37:59', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\",\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phphXrmed\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/1\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(195, '2017-10-27 06:41:29', 'info', 'Task', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"upload\",\"pass\":[\"1\",\"2\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpFY8RPs\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/upload\\/1\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/upload\\/1\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(196, '2017-10-27 08:12:18', 'info', 'Project', 11, 'Sophiaa De-Bruyn commented on Testing and updating the portal', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"comments\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"1\",\"source_id\":\"1\",\"project_id\":\"1\",\"user_id\":\"11\",\"comment\":\"testing comment counter\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/comments\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/comments\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(197, '2017-10-27 08:57:55', 'info', 'Task', 11, 'Sophiaa De-Bruyn commented on Testing media uploads 1', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"view\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"comment_src\":\"2\",\"source_id\":\"1\",\"project_id\":\"1\",\"user_id\":\"11\",\"comment\":\"yes this works\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/view\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/view\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(198, '2017-10-27 12:09:49', 'info', 'Forum', 11, '  added test forum', '{\"request\":{\"params\":{\"controller\":\"DepartmentForums\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\"},\"data\":{\"title\":\"test forum\",\"description\":\"<p>testing forum description<\\/p>\\r\\n\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8422cab6e9842246dc9a25ee6d5af6acd71ea31fc8e4fda93869f1e0a282d1710efe49473de8738290554484068f3e6e0b67edd50cd361709df8d570110c7f70\",\"CAKEPHP\":\"5a7ce72ecdb12f215d7d9cee88647756\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-forums\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-forums\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(199, '2017-10-30 14:20:49', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(200, '2017-10-30 17:50:00', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"6ba7d743ad4890983605ab484d338519c0115d1863ac503c2898a2932cd8585c86f4d68385dd3ed2aaaf2143ed5fb831eef6b505453b04ffa82b5525a0e9ed8d\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"CAKEPHP\":\"da078136ab4e10b63d23173a82290772\",\"csrfToken\":\"6ba7d743ad4890983605ab484d338519c0115d1863ac503c2898a2932cd8585c86f4d68385dd3ed2aaaf2143ed5fb831eef6b505453b04ffa82b5525a0e9ed8d\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(201, '2017-10-31 13:16:53', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/leave-days\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"6ba7d743ad4890983605ab484d338519c0115d1863ac503c2898a2932cd8585c86f4d68385dd3ed2aaaf2143ed5fb831eef6b505453b04ffa82b5525a0e9ed8d\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/leave-days\"},\"cookies\":{\"CAKEPHP\":\"991325851767f573c6a44efc7c4df5f4\",\"csrfToken\":\"6ba7d743ad4890983605ab484d338519c0115d1863ac503c2898a2932cd8585c86f4d68385dd3ed2aaaf2143ed5fb831eef6b505453b04ffa82b5525a0e9ed8d\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(202, '2017-10-31 13:45:57', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(203, '2017-10-31 17:49:16', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/leave-days\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"a9635e40df294fff49b29df4215fb93ff9214d63ef39401286c5fa0667a25bdaaad0f601c88115dbeede0ce2443d7e968fc7336a9192be5eb90bf7c85d8f655c\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/leave-days\"},\"cookies\":{\"csrfToken\":\"a9635e40df294fff49b29df4215fb93ff9214d63ef39401286c5fa0667a25bdaaad0f601c88115dbeede0ce2443d7e968fc7336a9192be5eb90bf7c85d8f655c\",\"CAKEPHP\":\"bc414e579818eeaabe8d60a7acda41e4\",\"_ga\":\"GA1.1.304518820.1464955071\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(204, '2017-10-31 19:13:29', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"04011ca3e12ff0b5123177aff8fa44c3\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(205, '2017-10-31 19:14:29', 'info', 'Users', 10, 'William  Narh - Adjabeng logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(206, '2017-10-31 19:19:41', 'info', 'Users', 10, 'William  Narh - Adjabeng logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"c1fea971b07a8fbd86eaa24e852a509f\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(207, '2017-10-31 19:20:36', 'info', 'Users', 36, 'Faridah Kudjo logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(208, '2017-10-31 19:21:55', 'info', 'Users', 36, 'Faridah Kudjo logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"a803c7f68f32c4adeffc728c8c0495ca\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(209, '2017-10-31 19:23:21', 'info', 'Users', 10, 'William  Narh - Adjabeng logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(210, '2017-10-31 19:23:48', 'info', 'Users', 10, 'William  Narh - Adjabeng logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"1735b146c9a41dbbba5bd5214a289ac2\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(211, '2017-10-31 19:24:17', 'info', 'Users', 36, 'Faridah Kudjo logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(212, '2017-10-31 19:33:58', 'info', 'Users', 36, 'Faridah Kudjo logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"e4610bc76e2fdb60038d313c1001b8c4\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(213, '2017-10-31 19:34:20', 'info', 'Users', 35, 'Ruth Opoku Fokuo logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(214, '2017-11-01 04:50:27', 'info', 'Users', 35, 'Ruth Opoku Fokuo logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"849a8f2b06927162a39f742c4a8124fb\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(215, '2017-11-01 04:50:37', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(216, '2017-11-01 04:53:43', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"d6e2c499c0a622ed9831634c201ec44a\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(217, '2017-11-01 04:53:52', 'info', 'Users', 32, 'Michael Kofi Duku logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(218, '2017-11-01 04:59:39', 'info', 'Leave Request', 32, 'Michael Kofi Duku requested for annual leave ', '{\"request\":{\"params\":{\"controller\":\"Requests\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"leave_type\":\"Annual\",\"start_date\":\"2017-11-02\",\"end_date\":\"2017-12-07\",\"resumption_date\":\"2017-12-8\",\"number_of_days_requested\":\"25\",\"comments\":\"This is just a test\",\"Tel\":\"0243509560\",\"email\":\"jnartey@gmail.com\",\"address\":\"CO DTD 142 AI 24\\r\\nCommunity 5\",\"relieved_by\":\"31\",\"status\":\"1\",\"request_type\":\"1\",\"user_id\":\"32\",\"department_id\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"96825afc3f9401d5c8490e4fa5cb8c85\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/requests\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/requests\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(219, '2017-11-01 05:00:42', 'info', 'Users', 32, 'Michael Kofi Duku logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"96825afc3f9401d5c8490e4fa5cb8c85\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(220, '2017-11-01 05:00:55', 'info', 'Users', 29, 'Lesley Asiedu logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(221, '2017-11-01 05:32:37', 'info', 'Leave Request', 29, 'Lesley Asiedu reviewed  for Michael Kofi Duku', '{\"request\":{\"params\":{\"controller\":\"Requests\",\"action\":\"review\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"status\":\"3\",\"approved_by\":\"29\",\"approved_date\":\"2017-11-01 05:32:31\"},\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"b736561af70d874602d44ebac3ec5650\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/requests\\/review\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/requests\\/review\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(222, '2017-11-01 05:35:58', 'info', 'Users', 29, 'Lesley Asiedu logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"b736561af70d874602d44ebac3ec5650\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(223, '2017-11-01 05:36:55', 'info', 'Users', 35, 'Ruth Opoku Fokuo logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(224, '2017-11-01 05:40:40', 'info', 'Leave Request', 35, 'Ruth Opoku Fokuo approved  for Michael Kofi Duku', '{\"request\":{\"params\":{\"controller\":\"Requests\",\"action\":\"approve\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"status\":\"4\",\"leave_entitlement\":\"\",\"leave_travel_allowance\":\"\",\"meal_allowance\":\"\",\"approved_by_management\":\"35\",\"approved_m_date\":\"2017-11-01 05:40:26\"},\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"85ffde6b46b28b0fd00b39f992dce520\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/requests\\/approve\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/requests\\/approve\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(225, '2017-11-01 07:02:56', 'info', 'Project', 35, 'Ruth Opoku Fokuo added testing projects', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"department_id\":\"\",\"created_by\":\"35\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-11-08 00:00:00\",\"end_date\":\"2017-11-30 02:00:00\",\"name\":\"testing projects\",\"description\":\"<p>new<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"85ffde6b46b28b0fd00b39f992dce520\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(226, '2017-11-01 07:13:30', 'info', 'Users', 35, 'Ruth Opoku Fokuo logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"85ffde6b46b28b0fd00b39f992dce520\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(227, '2017-11-01 07:14:35', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"4c7e19f1e37b22606929c2e422d82f39\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(228, '2017-11-01 08:44:11', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(229, '2017-11-01 08:44:42', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Elton Dusi to project::Testing and updating the portal', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"60d092c546cc024b77e164d2cb3cc42e\"},\"url\":\"department\\/department-project-members\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(230, '2017-11-01 08:44:42', 'info', 'Project', 11, 'Sophiaa De-Bruyn added William  Narh - Adjabeng to project::Testing and updating the portal', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjectMembers\",\"action\":\"add\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"user_id\":[\"9\",\"10\"],\"project_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"60d092c546cc024b77e164d2cb3cc42e\"},\"url\":\"department\\/department-project-members\\/add\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-project-members\\/add\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(231, '2017-11-01 09:04:55', 'info', 'Project', 11, 'Sophiaa De-Bruyn added Testing uploads', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-11-16 00:00:00\",\"end_date\":\"2017-11-30 02:00:00\",\"name\":\"Testing uploads\",\"description\":\"<p>testing<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"60d092c546cc024b77e164d2cb3cc42e\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(232, '2017-11-01 09:15:37', 'info', 'Project', 11, 'Sophiaa De-Bruyn added testing new project', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_id\":\"\",\"created_by\":\"11\",\"status\":\"1\",\"monitor_timeline\":\"3\",\"start_date\":\"2017-11-30 00:00:00\",\"end_date\":\"2017-12-30 02:00:00\",\"name\":\"testing new project\",\"description\":\"<p>description<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"60d092c546cc024b77e164d2cb3cc42e\"},\"url\":\"department\\/department-projects\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(233, '2017-11-01 10:42:22', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"60d092c546cc024b77e164d2cb3cc42e\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(234, '2017-11-01 10:43:46', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(235, '2017-11-01 11:28:36', 'info', 'Forum', 11, 'Sophiaa De-Bruyn commented <p>sure thing</p>\r\n', '{\"request\":{\"params\":{\"controller\":\"DepartmentForums\",\"action\":\"view\",\"pass\":[\"0\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"comment_src\":\"4\",\"source_id\":\"0\",\"forum_id\":\"0\",\"user_id\":\"11\",\"comment\":\"<p>sure thing<\\/p>\\r\\n\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"e1f74a570aa0118237ab51f32e394e20\"},\"url\":\"department\\/department-forums\\/view\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-forums\\/view\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(236, '2017-11-01 15:25:46', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"e1f74a570aa0118237ab51f32e394e20\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(237, '2017-11-01 16:31:53', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(238, '2017-11-02 04:38:23', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/users\\/view\\/4\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\\/users\\/view\\/4\"},\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"dea4123f4a92b538238c18073fa6cb2e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(239, '2017-11-02 04:39:16', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"uploadPhoto\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"email\":\"info@fifthlightmedia.com\",\"photo\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpvjZkMa\",\"error\":0,\"name\":\"Jacob passport photo.jpg\",\"type\":\"image\\/jpeg\",\"size\":51647}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"c108b5cc0f9c43793f08b925faf71f7e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/upload_photo\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/upload_photo\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(240, '2017-11-02 04:46:01', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"uploadPhoto\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"email\":\"info@fifthlightmedia.com\",\"photo\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php43C73s\",\"error\":0,\"name\":\"Jacob passport photo.jpg\",\"type\":\"image\\/jpeg\",\"size\":51647}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"c108b5cc0f9c43793f08b925faf71f7e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/upload_photo\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/upload_photo\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(241, '2017-11-02 04:47:21', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"uploadPhoto\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"email\":\"info@fifthlightmedia.com\",\"photo\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpYbVr5D\",\"error\":0,\"name\":\"Jacob passport photo.jpg\",\"type\":\"image\\/jpeg\",\"size\":51647}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"c4ae7281126d033f5c7689f851eb340d2b6815d572c59d61f7e9236d5a88d1a0bfced3aa68b9774e01e0a86617ed2d47a2d7b7c576aa93a21c9f775c20c1d9ac\",\"CAKEPHP\":\"c108b5cc0f9c43793f08b925faf71f7e\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/upload_photo\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/upload_photo\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(242, '2017-11-02 08:00:11', 'info', 'Users', 1, 'Fifthlight Media changed password for Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"changePassword\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"old_password\":\"123456789\",\"password1\":\"123456789\",\"password2\":\"123456789\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/change-password\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/change-password\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(243, '2017-11-02 08:00:16', 'info', 'Users', 1, 'Fifthlight Media changed password for Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"changePassword\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"old_password\":\"123456789\",\"password1\":\"123456789\",\"password2\":\"123456789\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/change-password\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/change-password\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(244, '2017-11-02 08:01:56', 'info', 'Users', 1, 'Fifthlight Media changed password for Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"changePassword\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"old_password\":\"123456789\",\"password1\":\"123456789\",\"password2\":\"123456789\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/change-password\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/change-password\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(245, '2017-11-02 08:09:59', 'info', 'Users', 1, 'Fifthlight Media changed password for Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"changePassword\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"old_password\":\"123456789\",\"password1\":\"123456789\",\"password2\":\"123456789\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/change-password\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/change-password\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(246, '2017-11-02 08:14:59', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(247, '2017-11-02 08:20:48', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(248, '2017-11-02 08:23:38', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(249, '2017-11-02 08:25:17', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight1 Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight1\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(250, '2017-11-02 08:27:07', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(251, '2017-11-02 08:31:22', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(252, '2017-11-02 08:33:03', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(253, '2017-11-02 08:34:06', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight1 Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight1\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(254, '2017-11-02 08:36:38', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight1 Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight1\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(255, '2017-11-02 08:36:44', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight1 Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight1\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(256, '2017-11-02 08:36:55', 'info', 'Users', 1, 'Fifthlight Media updated Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"1\"],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"fifthlight\",\"first_name\":\"Fifthlight\",\"last_name\":\"Media\",\"date_of_birth\":\"\",\"position\":\"\",\"email\":\"info@fifthlightmedia.com\",\"employee_id\":\"\",\"phone_number\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"users\\/personal-details\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/personal-details\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(257, '2017-11-02 08:41:45', 'info', 'Users', 1, 'Fifthlight Media updated Ebony Administrator', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"personalDetails\",\"pass\":[\"4\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"username\":\"eogadmin\",\"first_name\":\"Ebony\",\"last_name\":\"Administrator\",\"date_of_birth\":\"\",\"position\":\"IT Manager\",\"email\":\"admin@ebonyoilandgas.com\",\"employee_id\":\"\",\"grade\":\"\",\"phone_number\":\"\",\"role_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/users\\/personal-details\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/personal-details\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(258, '2017-11-04 17:46:11', 'info', 'Department', 1, 'Fifthlight Media edited Finance', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Finance\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(259, '2017-11-04 17:46:39', 'info', 'Department', 1, 'Fifthlight Media edited Sales & Marketing', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"2\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Sales & Marketing\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/2\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/2\",\"trustProxy\":false}}', 0, 0, 0),
(260, '2017-11-04 17:46:49', 'info', 'Department', 1, 'Fifthlight Media edited Human Resource & Administration', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"3\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"3\",\"name\":\"Human Resource & Administration\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/3\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/3\",\"trustProxy\":false}}', 0, 0, 0),
(261, '2017-11-04 17:46:55', 'info', 'Department', 1, 'Fifthlight Media edited Operations', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"4\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Operations\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(262, '2017-11-04 17:47:01', 'info', 'Department', 1, 'Fifthlight Media edited Business Development', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"5\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Business Development\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/5\",\"trustProxy\":false}}', 0, 0, 0),
(263, '2017-11-04 17:47:06', 'info', 'Department', 1, 'Fifthlight Media edited Trade & Commerce', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"6\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Trade & Commerce\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/6\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/6\",\"trustProxy\":false}}', 0, 0, 0),
(264, '2017-11-04 17:47:15', 'info', 'Department', 1, 'Fifthlight Media edited Information & Technology', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"7\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Information & Technology\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/7\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/7\",\"trustProxy\":false}}', 0, 0, 0),
(265, '2017-11-04 17:47:19', 'info', 'Department', 1, 'Fifthlight Media edited Risk & Internal Control', '{\"request\":{\"params\":{\"controller\":\"Departments\",\"action\":\"edit\",\"pass\":[\"8\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":{\"department_type\":\"1\",\"name\":\"Risk & Internal Control\",\"description\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"f412c9f6b2af0588ae5b86135a8a492f\"},\"url\":\"admin\\/departments\\/edit\\/8\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/departments\\/edit\\/8\",\"trustProxy\":false}}', 0, 0, 0),
(266, '2017-11-09 06:10:12', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(267, '2017-11-09 06:10:36', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"91b11b0339ef68751552cec6bc366bb1\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(268, '2017-11-09 06:10:54', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(269, '2017-11-09 06:23:54', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"d6f208ef40b3e4a4ae59b8650bd7ade2\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(270, '2017-11-09 06:24:19', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(271, '2017-11-09 06:28:34', 'info', 'Event', 1, 'Fifthlight Media deleted Ebony Oil and Gas Portal updates', '{\"request\":{\"params\":{\"controller\":\"Events\",\"action\":\"delete\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"de0a2e8c9b0f386f2ca92f590824cdac413462e53d8140d201803aba2f52724903f5b540bfb5dcdc2c1af3b86684ee339436b4e488aa7d5876cd27e55d944104\",\"CAKEPHP\":\"a9c637d87661b7e982cd0f10e2dd4e2f\"},\"url\":\"admin\\/events\\/delete\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/events\\/delete\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(272, '2017-11-09 09:02:43', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/media\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"96cfb0e5832256daeb7a8b82805c38e1505e31513019b6d0b45478e83855bb46f5aeef2b8d8e47e3abf5601b6ba82b28f5cbf632d6abcd48bde6d4f1b19d4577\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/media\"},\"cookies\":{\"CAKEPHP\":\"15a14aa7e7054b36e4563d4a4c52cc26\",\"csrfToken\":\"96cfb0e5832256daeb7a8b82805c38e1505e31513019b6d0b45478e83855bb46f5aeef2b8d8e47e3abf5601b6ba82b28f5cbf632d6abcd48bde6d4f1b19d4577\"},\"url\":\"users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(273, '2017-11-10 16:08:33', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(274, '2017-11-11 09:45:17', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"5d767a552f9d9ddddae6ac03854fed07\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(275, '2017-11-11 09:45:28', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(276, '2017-11-11 09:46:17', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpbVh3zK\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(277, '2017-11-11 09:49:46', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpAzj0R5\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(278, '2017-11-11 09:53:49', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpND0fnI\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(279, '2017-11-11 09:56:33', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpro3E4g\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(280, '2017-11-11 10:10:39', 'info', 'Task', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentTasks\",\"action\":\"upload\",\"pass\":[\"1\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpXJm9Nt\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-tasks\\/upload\\/1\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-tasks\\/upload\\/1\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(281, '2017-11-11 10:11:08', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"1\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phphFvhRW\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(282, '2017-11-11 10:20:21', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpb3vams\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(283, '2017-11-11 10:21:10', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded fifthlight-logo.jpeg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpwb84uu\",\"error\":0,\"name\":\"fifthlight-logo.jpeg\",\"type\":\"image\\/jpeg\",\"size\":117596}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(284, '2017-11-11 10:22:55', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded Confirmation.pdf', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpIHhhMb\",\"error\":0,\"name\":\"Confirmation.pdf\",\"type\":\"application\\/pdf\",\"size\":298474}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(285, '2017-11-11 10:45:32', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded fifthlight-logo.jpeg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpWfbOOJ\",\"error\":0,\"name\":\"fifthlight-logo.jpeg\",\"type\":\"image\\/jpeg\",\"size\":117596}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(286, '2017-11-11 10:46:58', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded fifthlight-logo.jpeg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpVVcd4o\",\"error\":0,\"name\":\"fifthlight-logo.jpeg\",\"type\":\"image\\/jpeg\",\"size\":117596}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(287, '2017-11-11 10:48:45', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded fifthlight-logo.jpeg', '{\"request\":{\"params\":{\"controller\":\"DepartmentProjects\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpOZr2CB\",\"error\":0,\"name\":\"fifthlight-logo.jpeg\",\"type\":\"image\\/jpeg\",\"size\":117596}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-projects\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-projects\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(288, '2017-11-12 15:07:47', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded LEAVE-REQUEST FORM.doc', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpp7w925\",\"error\":0,\"name\":\"LEAVE-REQUEST FORM.doc\",\"type\":\"application\\/msword\",\"size\":87040}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(289, '2017-11-12 15:10:33', 'info', 'Forum', 11, 'Sophiaa De-Bruyn uploaded Jacob School Transcripts-20171102T112936Z-001.zip', '{\"request\":{\"params\":{\"controller\":\"DepartmentMedia\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\"},\"data\":{\"parent_id\":\"\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phplHkyq7\",\"error\":0,\"name\":\"Jacob School Transcripts-20171102T112936Z-001.zip\",\"type\":\"application\\/zip\",\"size\":2997406}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"3fdd62273fe02fd7ec892a8bfe49fe114b5e4676be06f659520adcc16df3d4cf0beb94e538b321d665b4e57760f42f150bd473ae09bc165755df634e045ba64b\",\"CAKEPHP\":\"ede93e664aff4561c1ad7fb67e8cce66\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"department\\/department-media\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-media\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(290, '2017-12-13 17:07:52', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(291, '2017-12-14 09:49:06', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(292, '2017-12-14 10:20:52', 'info', 'Event', 11, 'Sophiaa De-Bruyn deleted ', '{\"request\":{\"params\":{\"controller\":\"DepartmentEventMembers\",\"action\":\"delete\",\"pass\":[\"0\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-event-members\\/delete\\/0\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-event-members\\/delete\\/0\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(293, '2017-12-14 10:22:09', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(294, '2017-12-14 10:22:16', 'info', 'Event', 11, 'Sophiaa De-Bruyn deleted Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"DepartmentEventMembers\",\"action\":\"delete\",\"pass\":[\"0\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-event-members\\/delete\\/0\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-event-members\\/delete\\/0\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(295, '2017-12-14 10:23:14', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(296, '2017-12-14 10:23:20', 'info', 'Event', 11, 'Sophiaa De-Bruyn deleted Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"DepartmentEventMembers\",\"action\":\"delete\",\"pass\":[\"0\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-event-members\\/delete\\/0\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-event-members\\/delete\\/0\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(297, '2017-12-14 10:26:07', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(298, '2017-12-14 10:26:15', 'info', 'Event', 11, 'Sophiaa De-Bruyn deleted Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"DepartmentEventMembers\",\"action\":\"delete\",\"pass\":[\"0\",\"1\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-event-members\\/delete\\/0\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-event-members\\/delete\\/0\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(299, '2017-12-14 10:28:47', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(300, '2017-12-14 10:28:53', 'info', 'Event', 11, 'Sophiaa De-Bruyn deleted Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"DepartmentEventMembers\",\"action\":\"delete\",\"pass\":[\"0\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-event-members\\/delete\\/0\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-event-members\\/delete\\/0\",\"trustProxy\":false}}', 0, 0, 0),
(301, '2017-12-14 13:30:36', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\",\"status\":\"1\",\"comment\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(302, '2017-12-14 13:47:43', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\",\"status\":\"2\",\"comment\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(303, '2017-12-14 13:58:18', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - Test event', '{\"request\":{\"params\":{\"controller\":\"DepartmentEvents\",\"action\":\"register\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\",\"id\":\"2\",\"status\":\"2\",\"comment\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(304, '2017-12-14 14:08:06', 'info', 'Wiki', 11, 'Sophiaa De-Bruyn added test wiki', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"title\":\"test wiki\",\"content\":\"\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(305, '2017-12-14 15:07:15', 'info', 'Wiki', 11, 'Sophiaa De-Bruyn added testing wiki', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"title\":\"testing wiki\",\"content\":\"<p>this is a test transmittion<\\/p>\\r\\n\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(306, '2017-12-14 15:07:46', 'info', 'Wiki', 11, 'Sophiaa De-Bruyn added testing wiki', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"title\":\"testing wiki\",\"content\":\"<p>this is a test transmittion<\\/p>\\r\\n\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(307, '2017-12-14 15:25:23', 'info', 'Wiki', 11, 'Sophiaa De-Bruyn added my new wiki', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"title\":\"my new wiki\",\"content\":\"<p>wiki content here<\\/p>\\r\\n\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(308, '2017-12-14 15:29:12', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded banner-2-1.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phpKwv3Qp\",\"error\":0,\"name\":\"banner-2-1.jpg\",\"type\":\"image\\/jpeg\",\"size\":179270}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(309, '2017-12-14 15:32:00', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded banner-3-1.jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/phptlSPdi\",\"error\":0,\"name\":\"banner-3-1.jpg\",\"type\":\"image\\/jpeg\",\"size\":139122}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(310, '2017-12-14 15:39:03', 'info', 'Project', 11, 'Sophiaa De-Bruyn uploaded agritop.minister.tour (166 of 179).jpg', '{\"request\":{\"params\":{\"controller\":\"DepartmentWiki\",\"action\":\"upload\",\"pass\":[\"4\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"?\":{\"fancybox\":\"true\"},\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\"},\"data\":{\"parent_id\":\"4\",\"file_name\":{\"tmp_name\":\"\\/Applications\\/MAMP\\/tmp\\/php\\/php0CPuRh\",\"error\":0,\"name\":\"agritop.minister.tour (166 of 179).jpg\",\"type\":\"image\\/jpeg\",\"size\":5355036}},\"query\":{\"fancybox\":\"true\"},\"cookies\":{\"csrfToken\":\"93c321ebe2efc8ac538f08d5397a4dc5a4740fda39d6f93a76108ca09bc4eca62ff55a3785572c5544f4465cde49c01453504668ae5725a450ba43a4a8d9e084\",\"CAKEPHP\":\"768b84a660501cd41d5b3d41b517a518\"},\"url\":\"department\\/department-wiki\\/upload\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/department-wiki\\/upload\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(311, '2017-12-18 08:36:20', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(312, '2017-12-18 09:01:49', 'info', 'Event', 11, 'Sophiaa De-Bruyn added This is a test event', '{\"request\":{\"params\":{\"controller\":\"Events\",\"action\":\"add\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\"},\"data\":{\"from_date\":\"2017-12-18 00:00:00\",\"to_date\":\"2017-12-30 02:00:00\",\"registration_deadline\":\"2017-12-21 00:00:00\",\"name\":\"This is a test event\",\"description\":\"<p>Oh this is a test event, why are you asking?<\\/p>\\r\\n\",\"location\":\"New York\",\"user_id\":\"11\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\",\"CAKEPHP\":\"58b88284dd38fbba1110f7db284fd2b0\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"events\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/events\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(313, '2017-12-18 09:11:06', 'info', 'Event', 11, 'Sophiaa De-Bruyn is attending this event - This is a test event', '{\"request\":{\"params\":{\"controller\":\"Events\",\"action\":\"register\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\"},\"data\":{\"user_id\":\"11\",\"event_id\":\"1\",\"status\":\"1\",\"comment\":\"\"},\"query\":[],\"cookies\":{\"csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\",\"CAKEPHP\":\"58b88284dd38fbba1110f7db284fd2b0\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"events\\/register\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/events\\/register\",\"trustProxy\":false}}', 0, 0, 0),
(314, '2017-12-21 11:45:37', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\",\"CAKEPHP\":\"58b88284dd38fbba1110f7db284fd2b0\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0);
INSERT INTO `logs` (`id`, `created`, `level`, `scope`, `user_id`, `message`, `context`, `department`, `workgroup`, `source`) VALUES
(315, '2017-12-21 11:46:00', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"csrfToken\":\"d12511d53c6f6d39f75760eae507fbc620ad9cd056a08a501ef326a2a83ef28c639d8f564dfa47cb1cc145379ab74aec51b7b734167577bee3dbe6cb927b61f5\",\"CAKEPHP\":\"56ad753736ef798bee3536a7c44d91af\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"wingify_do_not_show_chicklet\":\"true\",\"wingify_push_db_status\":\"\",\"wingify_push_subscriber_id\":\"\",\"wingify_push_subscription_id\":\"\",\"wingify_push_subscription_status\":\"\",\"_ga\":\"GA1.1.1490675179.1449472931\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(316, '2018-01-09 23:23:14', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(317, '2018-01-12 12:50:34', 'info', 'Work outside schedule', 11, 'Sophiaa De-Bruyn recommended  for Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"WorkOutsideSchedules\",\"action\":\"recommend\",\"pass\":[\"5\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"4f2b22950b760191419876fbc0f19e4fe3ebef7ece3468d3a7c4ffee82933a7c2930a53f124fe8fcd92f8e5521aba7f98d1c4e6ed24891b81699240e4e52260d\"},\"data\":{\"department_head\":\"11\",\"department_head_approval_date\":\"2018-01-12 12:50:32\",\"status\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"4f2b22950b760191419876fbc0f19e4fe3ebef7ece3468d3a7c4ffee82933a7c2930a53f124fe8fcd92f8e5521aba7f98d1c4e6ed24891b81699240e4e52260d\",\"CAKEPHP\":\"b701e7f79ad0f0be1599505b8146f9db\"},\"url\":\"department\\/work-outside-schedules\\/recommend\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/work-outside-schedules\\/recommend\\/5\",\"trustProxy\":false}}', 0, 0, 0),
(318, '2018-01-12 12:51:05', 'info', 'Work outside schedule', 11, 'Sophiaa De-Bruyn recommended  for Sophiaa De-Bruyn', '{\"request\":{\"params\":{\"controller\":\"WorkOutsideSchedules\",\"action\":\"recommend\",\"pass\":[\"5\"],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"4f2b22950b760191419876fbc0f19e4fe3ebef7ece3468d3a7c4ffee82933a7c2930a53f124fe8fcd92f8e5521aba7f98d1c4e6ed24891b81699240e4e52260d\"},\"data\":{\"department_head\":\"11\",\"department_head_approval_date\":\"2018-01-12 12:51:02\",\"status\":\"2\"},\"query\":[],\"cookies\":{\"csrfToken\":\"4f2b22950b760191419876fbc0f19e4fe3ebef7ece3468d3a7c4ffee82933a7c2930a53f124fe8fcd92f8e5521aba7f98d1c4e6ed24891b81699240e4e52260d\",\"CAKEPHP\":\"b701e7f79ad0f0be1599505b8146f9db\"},\"url\":\"department\\/work-outside-schedules\\/recommend\\/5\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/work-outside-schedules\\/recommend\\/5\",\"trustProxy\":false}}', 0, 0, 0),
(319, '2018-01-18 19:13:20', 'info', 'Users', 1, '  logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\",\"CAKEPHP\":\"4112588ac164642d5885247ab66cb7cb\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(320, '2018-01-18 19:22:01', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(321, '2018-01-18 20:09:14', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"plugin\":null,\"_matchedRoute\":\"\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\",\"CAKEPHP\":\"e364f553e0eb3e700fb17d25066a5a26\"},\"url\":\"users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(322, '2018-01-18 20:09:27', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(323, '2018-01-18 21:49:40', 'info', 'Cash Request', 11, 'Sophiaa De-Bruyn requested for cash ', '{\"request\":{\"params\":{\"controller\":\"CashRequests\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\"},\"data\":{\"subject\":\"extra fuel\",\"amount\":\"100\",\"status\":\"3\",\"request_type\":\"3\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"8000f7ba6390b0b33e9ed13d66590f338b925d048a89716105fd8858142bb37bf28343524507c1627244b0d9a00efc4670ce74cf3b607d59ec3b2b307297df00\",\"CAKEPHP\":\"8d78f4e95f49c8557667dc95028e2c76\"},\"url\":\"department\\/cash-requests\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/cash-requests\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(324, '2018-02-13 23:14:40', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"123456789\"},\"query\":{\"redirect\":\"\\/admin\"},\"cookies\":{\"CAKEPHP\":\"d05c11fb5b78ffbad1910b96293c3134\",\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(325, '2018-02-14 12:01:47', 'info', 'Users', 1, 'Fifthlight Media reset password for Fifthlight Media', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"resetPassword\",\"pass\":[\"1\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":true,\"_Token\":{\"unlockedFields\":[]}},\"data\":{\"password1\":\"CwA@ZE9H\"},\"query\":[],\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"ba17cdfff2d41e69b89d445d5a92361f\"},\"url\":\"admin\\/users\\/reset-password\\/1\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/reset-password\\/1\",\"trustProxy\":false}}', 0, 0, 0),
(326, '2018-02-14 12:14:54', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"ba17cdfff2d41e69b89d445d5a92361f\"},\"url\":\"admin\\/users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(327, '2018-02-14 12:15:03', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/pages\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"CwA@ZE9H\"},\"query\":{\"redirect\":\"\\/admin\\/pages\"},\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"1be6682d2b67d0763999049af5b3b5c8\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(328, '2018-02-14 12:15:08', 'info', 'Users', 1, 'Fifthlight Media logged out', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"logout\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"data\":[],\"query\":[],\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"7e23f8c34d02f41fa8bfb3f3b01dcb0c\"},\"url\":\"admin\\/users\\/logout\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/logout\",\"trustProxy\":false}}', 0, 0, 0),
(329, '2018-02-14 12:15:21', 'info', 'Users', 1, 'Fifthlight Media logged in', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"login\",\"pass\":[],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"?\":{\"redirect\":\"\\/admin\\/pages\"},\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\"},\"data\":{\"username\":\"fifthlight\",\"password\":\"CwA@ZE9H\"},\"query\":{\"redirect\":\"\\/admin\\/pages\"},\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"fa0ddf4f5239bfca8daa2e0512974f61\"},\"url\":\"admin\\/users\\/login\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/login\",\"trustProxy\":false}}', 0, 0, 0),
(330, '2018-02-14 12:16:29', 'info', 'Users', 1, 'Fifthlight Media reset password for Ebony Administrator', '{\"request\":{\"params\":{\"controller\":\"Users\",\"action\":\"resetPassword\",\"pass\":[\"4\"],\"prefix\":\"admin\",\"plugin\":null,\"_matchedRoute\":\"\\/admin\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]}},\"data\":{\"password1\":\")_S@?kr*\"},\"query\":[],\"cookies\":{\"csrfToken\":\"e4f93fa2b149e119a7e2e3f0242bddf2837749afaebdb3df207e0c0da9fa17b59965dc27486115bb305af3cdda2da5af4c638d31d5771bcc81703c9e3737fbf6\",\"CAKEPHP\":\"e5440e5055f094c60fba2ff92b6989fd\"},\"url\":\"admin\\/users\\/reset-password\\/4\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/admin\\/users\\/reset-password\\/4\",\"trustProxy\":false}}', 0, 0, 0),
(331, '2018-03-05 10:02:49', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(332, '2018-03-12 00:31:24', 'info', 'Users', 11, 'Sophiaa De-Bruyn logged in', '{\"referer\":\"http:\\/\\/localhost:8888\\/eog\\/eog-portal\\/\"}', 0, 0, 0),
(333, '2018-03-12 02:08:42', 'info', 'Cash Request', 11, 'Sophiaa De-Bruyn requested for cash ', '{\"request\":{\"params\":{\"controller\":\"CashRequests\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"r_type\":\"Cash\",\"subject\":\"test\",\"amount\":\"20\",\"status\":\"3\",\"request_type\":\"3\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/cash-requests\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/cash-requests\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(334, '2018-03-12 02:12:37', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"car_registeration_number\":\"1\",\"mileage\":\"12000\",\"general_servicing\":\"0\",\"others_specify\":\"yes\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(335, '2018-03-12 02:27:10', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"car_registeration_number\":\"1\",\"mileage\":\"12000\",\"general_servicing\":\"0\",\"others_specify\":\"test\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(336, '2018-03-12 02:30:20', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"car_registeration_number\":\"2\",\"mileage\":\"12000\",\"general_servicing\":\"0\",\"others_specify\":\"test\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(337, '2018-03-12 02:32:35', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"car_registeration_number\":\"1\",\"mileage\":\"12000\",\"general_servicing\":\"0\",\"others_specify\":\"test\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(338, '2018-03-12 02:44:44', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"vehicle_id\":\"1\",\"mileage\":\"12000\",\"general_servicing\":\"1\",\"others_specify\":\"test\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0),
(339, '2018-03-12 02:47:56', 'info', 'Vehicle Servicings', 11, 'Sophiaa De-Bruyn requested for vehicle servicing ', '{\"request\":{\"params\":{\"controller\":\"VehicleServicings\",\"action\":\"add\",\"pass\":[],\"prefix\":\"department\",\"plugin\":null,\"_matchedRoute\":\"\\/department\\/:controller\\/:action\\/*\",\"isAjax\":false,\"_Token\":{\"unlockedFields\":[]},\"_csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\"},\"data\":{\"vehicle_id\":\"1\",\"mileage\":\"12000\",\"general_servicing\":\"1\",\"other\":\"test\",\"status\":\"1\",\"request_type\":\"4\",\"user_id\":\"11\",\"department_id\":\"5\"},\"query\":[],\"cookies\":{\"csrfToken\":\"818a3fc47116f62aff3fb1b770976a766ffdffd096ea19beab5e3bf12396f5ec580fc9e0b59375e936e025c845e31d2b4100532e610117372090b75a27555224\",\"CAKEPHP\":\"d51da120a73584ee26a66e0742c5142b\",\"_ga\":\"GA1.1.1626351475.1516729696\",\"wingify_push_do_not_show_notification_popup\":\"true\",\"__utma\":\"111872281.1626351475.1516729696.1518131026.1518131026.1\",\"__utmz\":\"111872281.1518131026.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)\",\"accordion_nav\":\"\"},\"url\":\"department\\/vehicle-servicings\\/add\",\"base\":\"\\/eog\\/eog-portal\",\"webroot\":\"\\/eog\\/eog-portal\\/\",\"here\":\"\\/eog\\/eog-portal\\/department\\/vehicle-servicings\\/add\",\"trustProxy\":false}}', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `source_id` int(200) DEFAULT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL,
  `folder_name` varchar(120) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `media_dir` varchar(200) NOT NULL,
  `media_type` varchar(200) NOT NULL,
  `uploaded_by` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `media_access` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `source_id`, `parent_id`, `lft`, `rght`, `folder_name`, `file_name`, `size`, `media_dir`, `media_type`, `uploaded_by`, `department_id`, `media_access`, `created`, `modified`) VALUES
(0, NULL, NULL, 1, 2, '', 'fifthlight-logo.jpeg', 117596, 'webroot/files/media', 'image/jpeg', 1, 0, 1, '2017-11-02 06:00:00', '2017-11-02 06:00:00'),
(0, NULL, NULL, 3, 4, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-09 07:24:13', '2017-11-09 07:24:13'),
(0, NULL, NULL, 5, 6, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-10 16:16:37', '2017-11-10 16:16:37'),
(0, NULL, NULL, 7, 8, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 07:36:30', '2017-11-11 07:36:30'),
(0, NULL, NULL, 9, 10, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 07:42:28', '2017-11-11 07:42:28'),
(0, NULL, NULL, 11, 12, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 07:49:52', '2017-11-11 07:49:52'),
(0, NULL, NULL, 13, 14, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:00:46', '2017-11-11 08:00:46'),
(0, NULL, NULL, 15, 16, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:05:19', '2017-11-11 08:05:19'),
(0, NULL, NULL, 17, 18, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:06:55', '2017-11-11 08:06:55'),
(0, NULL, NULL, 19, 20, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:10:44', '2017-11-11 08:10:44'),
(0, NULL, NULL, 21, 22, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:12:10', '2017-11-11 08:12:10'),
(0, NULL, NULL, 23, 24, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:14:23', '2017-11-11 08:14:23'),
(0, NULL, NULL, 25, 26, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:15:47', '2017-11-11 08:15:47'),
(0, NULL, NULL, 27, 28, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:24:25', '2017-11-11 08:24:25'),
(0, NULL, NULL, 29, 30, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:25:14', '2017-11-11 08:25:14'),
(0, NULL, NULL, 31, 32, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:26:17', '2017-11-11 08:26:17'),
(0, NULL, NULL, 33, 34, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:40:53', '2017-11-11 08:40:53'),
(0, NULL, NULL, 35, 36, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:44:29', '2017-11-11 08:44:29'),
(0, NULL, NULL, 37, 38, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:46:44', '2017-11-11 08:46:44'),
(0, NULL, NULL, 39, 40, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:48:52', '2017-11-11 08:48:52'),
(0, NULL, NULL, 41, 42, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:54:07', '2017-11-11 08:54:07'),
(0, NULL, NULL, 43, 44, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:55:38', '2017-11-11 08:55:38'),
(0, NULL, NULL, 45, 46, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:56:53', '2017-11-11 08:56:53'),
(0, NULL, NULL, 47, 48, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 08:56:59', '2017-11-11 08:56:59'),
(0, NULL, NULL, 49, 50, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 09:03:57', '2017-11-11 09:03:57'),
(0, NULL, NULL, 51, 52, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 09:25:55', '2017-11-11 09:25:55'),
(0, NULL, NULL, 53, 54, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 09:26:43', '2017-11-11 09:26:43'),
(0, NULL, NULL, 55, 56, '', 'confirmation.pdf', 298474, 'webroot/files/media', 'application/pdf', 1, 0, 1, '2017-11-11 09:29:10', '2017-11-11 09:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` mediumtext,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_from` varchar(100) DEFAULT NULL,
  `chat_to` varchar(100) DEFAULT NULL,
  `recd` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `date`, `chat_from`, `chat_to`, `recd`, `created`, `modified`) VALUES
(1, NULL, '2017-09-15 10:19:31', NULL, NULL, 1, '2017-09-15 10:19:31', '2017-09-15 10:19:31'),
(2, NULL, '2017-09-15 10:19:40', NULL, NULL, 1, '2017-09-15 10:19:40', '2017-09-15 10:19:40'),
(3, NULL, '2017-09-15 10:19:43', NULL, NULL, 1, '2017-09-15 10:19:43', '2017-09-15 10:19:43'),
(4, NULL, '2017-09-15 10:19:56', NULL, NULL, 1, '2017-09-15 10:19:56', '2017-09-15 10:19:56'),
(5, NULL, '2017-10-09 12:45:30', NULL, NULL, 1, '2017-10-09 12:45:30', '2017-10-09 12:45:30'),
(6, 'test', '2017-10-09 12:45:47', 'fifthlight', 'eogadmin', 1, '2017-10-09 12:45:47', '2017-10-09 12:50:15'),
(7, 'hi', '2017-10-09 12:55:33', 'sdebruyn', 'eogadmin', 0, '2017-10-09 12:55:33', '2017-10-09 12:55:33'),
(8, 'hello', '2017-10-09 12:55:44', 'eogadmin', 'sdebruyn', 1, '2017-10-09 12:55:44', '2017-10-09 12:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(150) UNSIGNED NOT NULL,
  `category_id` int(150) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `story` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `title`, `summary`, `story`, `image`, `user_id`, `created`, `modified`) VALUES
(1, 1, 'Ebony Oil and Gas Intranet Under Construction ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione, delectus atque tempore sed, suscipit ullam.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione, delectus atque tempore sed, suscipit ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione, delectus atque tempore sed, suscipit ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione, delectus atque tempore sed, suscipit ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione, delectus atque tempore sed, suscipit ullam.</p>', '', 0, '2017-05-19 02:05:41', '2017-05-19 02:05:41'),
(2, 1, 'industry News', 'The health issues in Ghana.', '<p>The healthier we eat with the correct propostions.</p>\r\n', '', 0, '2017-08-21 11:55:48', '2017-08-21 11:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL COMMENT 'The deadline of the created project',
  `end_date` datetime NOT NULL,
  `status` varchar(12) NOT NULL COMMENT 'The status of the project. Can store values such as COMPLETED, PROGRESS, CANCELLED',
  `progress` int(3) NOT NULL,
  `monitor_timeline` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `department_id`, `name`, `description`, `created_by`, `start_date`, `end_date`, `status`, `progress`, `monitor_timeline`, `created`, `modified`) VALUES
(1, 1, 'Completion of ebony portal', '<p>no description for this project</p>\r\n', 3, '2017-08-01 00:58:14', '2017-08-10 07:10:00', '1', 25, 1, '2017-07-14 10:31:20', '2017-08-16 01:32:33'),
(2, 1, 'Testing', '<p>testing all projects</p>\r\n', 3, '2017-08-16 05:47:00', '2017-09-30 05:47:00', '1', 0, 3, '2017-08-10 15:00:21', '2017-08-16 08:04:28'),
(3, 1, 'New project', '<p>testing new project</p>\r\n', 6, '2017-08-31 00:00:00', '2017-09-29 00:00:00', '1', 0, 1, '2017-08-10 15:02:24', '2017-08-10 15:02:24'),
(4, 1, 'New project 1', '<p>testing this new project</p>\r\n', 6, '2017-08-25 00:00:00', '2017-09-26 00:00:00', '1', 0, 1, '2017-08-10 15:03:34', '2017-08-10 15:03:34'),
(5, 1, 'New project 2', '<p>test description</p>\r\n', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 0, 1, '2017-08-10 15:05:08', '2017-08-16 04:36:27'),
(6, 1, 'New project 3', '<p>new test description</p>\r\n', 6, '2017-08-24 00:00:00', '2017-09-30 00:00:00', '1', 0, 1, '2017-08-10 15:06:13', '2017-08-10 15:06:13'),
(7, 1, 'New project 4', '<p>test description</p>\r\n', 6, '2017-08-24 00:00:00', '2017-09-30 00:00:00', '1', 0, 1, '2017-08-10 15:07:37', '2017-08-10 15:07:37'),
(9, 1, 'New project 6', '<p>Yayyyy this really works</p>\r\n', 6, '2017-08-31 00:00:00', '2017-09-30 00:00:00', '1', 0, 1, '2017-08-10 15:11:54', '2017-08-10 15:11:54'),
(10, 1, 'New project fifthlight', '<p>test description</p>\r\n', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 0, 1, '2017-08-10 15:17:43', '2017-08-16 00:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `projects_members`
--

CREATE TABLE `projects_members` (
  `id` int(200) UNSIGNED NOT NULL,
  `project_id` int(200) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_members`
--

INSERT INTO `projects_members` (`id`, `project_id`, `user_id`, `created`, `modified`) VALUES
(10, 1, '5', '2017-08-04 20:45:19', '2017-08-04 20:45:19'),
(11, 2, '5', '2017-08-16 02:19:53', '2017-08-16 02:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `request_forms`
--

CREATE TABLE `request_forms` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rate` int(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_forms`
--

INSERT INTO `request_forms` (`id`, `name`, `rate`, `created`, `modified`) VALUES
(1, 'Leave', NULL, '2017-10-30 00:00:00', '2017-10-30 00:00:00'),
(2, 'Work outside work schedule', NULL, '2017-10-30 00:00:00', '2017-10-30 00:00:00'),
(3, 'Cash Request', NULL, '2017-10-30 00:00:00', '2017-10-30 00:00:00'),
(4, 'Vehicle servicing', NULL, '2017-10-30 00:00:00', '2017-10-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `request_handlers`
--

CREATE TABLE `request_handlers` (
  `id` int(10) NOT NULL,
  `request_forms_id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `user_id` int(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_handlers`
--

INSERT INTO `request_handlers` (`id`, `request_forms_id`, `department_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, 3, NULL, '2017-10-31 17:50:08', '2017-10-31 17:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Staff', '2017-05-17 17:01:13', '2017-05-17 17:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(20) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `department_id` int(20) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `progress` int(3) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `notes` mediumtext NOT NULL,
  `attended_by` varchar(255) NOT NULL,
  `reviewed_by` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `department_id`, `project_id`, `name`, `description`, `progress`, `deadline`, `status`, `notes`, `attended_by`, `reviewed_by`, `created`, `modified`) VALUES
(1, '5', 1, '1', 'test', 'testing task', 0, '0000-00-00 00:00:00', 2, '', '5', '6', '2017-08-04 18:14:33', '2017-08-15 09:52:24'),
(2, '5', 1, '2', 'New tasks *', 'To use the min, max, and step attributes the input first needs a type of number, range or one of the date/time values. In the case of type=\"number\", small arrow widgets are applied after the input which increment the current value of the input up or down. In the case of type=\"range\", the possible values of the slider GUI presented in supporting browsers will range from the min to the max value, incrementing by the value of the step attribute.', 20, '0000-00-00 00:00:00', 3, '', '3', '3', '2017-08-16 02:01:53', '2017-08-16 10:46:29'),
(5, '', 1, '2', 'Test task 2', 'Test task description here', 25, '0000-00-00 00:00:00', 1, '', '', '', '2017-08-16 06:25:03', '2017-08-16 06:32:43'),
(6, '5', 1, '2', 'yet another task', 'test', 0, '0000-00-00 00:00:00', 1, '', '', '', '2017-08-16 10:58:10', '2017-08-16 10:58:10'),
(7, '', 1, '10', 'Task one new', 'this is just a test', 0, '0000-00-00 00:00:00', 1, '', '', '', '2017-08-16 11:09:45', '2017-08-16 11:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `position` varchar(255) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(256) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `grade` varchar(1) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `im_account_name` varchar(60) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL COMMENT 'The full path to the user''s avatar',
  `photo_dir` varchar(200) NOT NULL,
  `photo_size` varchar(200) NOT NULL,
  `photo_type` varchar(200) NOT NULL,
  `role_id` int(20) NOT NULL,
  `im_status` varchar(10) DEFAULT NULL COMMENT 'A user''s IM status. Possible data to be stored in this include ON (Online), OFF (Offline), AWAY(Away) or BUSY(Busy)',
  `active` int(1) NOT NULL DEFAULT '0',
  `is_blocked` int(1) NOT NULL DEFAULT '0' COMMENT 'Whether the user is blocked or not. Can be set or unset by the portal administrator and defaults to FALSE',
  `employee_of_the_year` int(1) NOT NULL DEFAULT '1',
  `department_access` int(200) DEFAULT NULL,
  `workgroup_access` int(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `position`, `employee_id`, `email`, `password`, `date_of_birth`, `grade`, `phone_number`, `im_account_name`, `photo`, `photo_dir`, `photo_size`, `photo_type`, `role_id`, `im_status`, `active`, `is_blocked`, `employee_of_the_year`, `department_access`, `workgroup_access`, `created`, `modified`) VALUES
(1, 'fifthlight', 'Fifthlight', 'Media', '', '', 'info@fifthlightmedia.com', '$2y$10$4.mIVUz3I11TLEiv5e2L4uJgF5ave6wH3S7YzvI/3HQg95saNF9eu', '0000-00-00', NULL, '', '', 'jacob-passport-photo.jpg', 'webroot/files/Users/photo/', '51647', 'image/jpeg', 1, '', 2, 0, 1, 1, 1, '2017-04-11 22:10:37', '2018-02-14 12:15:21'),
(4, 'eogadmin', 'Ebony', 'Administrator', 'IT Manager', '', 'admin@ebonyoilandgas.com', '$2y$10$AA38xR7NtMEj2YQwHfA3qOC5Lpc3dwNSh.3zDI6q4wtYDtG6kRmKe', '0000-00-00', NULL, '', '', '', '', '', '', 1, NULL, 1, 0, 1, 7, NULL, '2017-05-19 02:15:36', '2018-02-14 12:16:29'),
(9, 'eltondusi', 'Elton', 'Dusi', 'Chief Executive Officer', '', 'edusi@ebonyoilandgas.com', '$2y$10$lK0GJFmQCAH80QIBsr0zZ.iaY9Tg07/wKhpMD2RKCho/0.ZmmRdq6', '0000-00-00', NULL, '0561099999', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 07:45:08', '2017-08-17 14:04:03'),
(10, 'wadjabeng', 'William ', 'Narh - Adjabeng', 'Head of Business Development', '', 'wnadjabeng@ebonyoilandgas.com', '$2y$10$6OWCRQEGuWdFE5Dvt5Wxf.iV5fBXgUYXLhlvOzi95qN0DsffkAvne', '0000-00-00', NULL, '0561100018', '', NULL, '', '', '', 3, NULL, 1, 0, 1, 5, NULL, '2017-08-17 07:48:41', '2017-12-21 14:27:19'),
(11, 'sdebruyn', 'Sophiaa', 'De-Bruyn', 'Business Development Officer', '', 'sde-bruyn@ebonyoilandgas.com', '$2y$10$IJ4.BmrrHN3IJsLcl2SKMOBlPO5JnGTlzL0WhML4YTepIErOsKhye', '0000-00-00', NULL, '0561099954', '', NULL, '', '', '', 3, NULL, 2, 0, 2, 5, 1, '2017-08-17 07:59:01', '2018-03-12 00:37:20'),
(12, 'nyboakye', 'Nana ', 'Yaw Boakye', 'Head of Commerce', '', 'nyboakye@ebonyoilandgas.com', '$2y$10$cnmZAe8m0ksKRYHjUsuwr.dvSMSMPVZNitkpC0ClPbirULfm.a0Je', '0000-00-00', NULL, '0561099956', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:00:37', '2017-12-21 14:26:49'),
(13, 'igoh', 'Ida ', 'Mona Goh', 'Commerce Analyst', '', 'igoh@ebonyoilandgas.com', '$2y$10$2U4pWKABHGjmJuuOsw1qwuPqrYBrPXvuAkseNDVXaeTOmPJtgseBW', '0000-00-00', NULL, '0561099955', '', NULL, '', '', '', 3, NULL, 0, 0, 1, 6, NULL, '2017-08-17 08:01:57', '2017-08-18 16:48:54'),
(14, 'eegamey', 'Edmund ', 'Edem Gamey', 'Head of Operations', '', 'eegamey@ebonyoilandgas.com', '$2y$10$zWUqRzvp12Pk0/1A2OFQBOueG5Krqvv32zAWJCaFZwnTY9OlyErRe', '0000-00-00', NULL, '0561100017', '', NULL, '', '', '', 3, NULL, 0, 0, 1, 4, NULL, '2017-08-17 08:03:25', '2017-08-18 13:52:12'),
(15, 'tkagbeveade', 'Theodore', 'Agbeveade', 'Operations Supervisor', '', 'tkagbeveade@ebonyoilandgas.com', '$2y$10$EiHuWd3UGuuwEodgg786BeHzrFB/gnNTRfvRPhUHya6tEFZxPzPMK', '0000-00-00', NULL, '0560027428', '', NULL, '', '', '', 3, NULL, 0, 0, 1, 4, NULL, '2017-08-17 08:04:29', '2017-08-18 16:48:41'),
(16, 'egorman', 'Ebo', 'Gorman', 'Operations Supervisor', '', 'egorman@ebonyoilandgas.com', '$2y$10$qjPuuFMtSEVkCwR2RlsUMucoq1JnzI0ra977kBd8AYe7zUHkR68Ie', '0000-00-00', NULL, '0561099960', '', NULL, '', '', '', 3, NULL, 0, 0, 1, 4, NULL, '2017-08-17 08:06:44', '2017-08-18 13:51:51'),
(17, 'dakwetey', 'Dickson', 'Siaw Akwetey', 'Operations Supervisor', '', 'dakwetey@ebonyoilandgas.com', '$2y$10$VIQodVc4HXdq9JSzw2IbMe1s9omKcshpHly2hLvyYySJaJK9TP.aC', '0000-00-00', NULL, '0561099952', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:08:47', '2017-08-17 14:07:03'),
(18, 'glekettey', 'Godwin', 'Lekettey', 'Operations Officer', '', 'glekettey@ebonyoilandgas.com', '$2y$10$i3DsB5.vAiSsOFuUB8Ttn.t9Q5Q8lDKHXeNTpAY4oTzl06RmrKcVS', '0000-00-00', NULL, '0561099964', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:10:14', '2017-08-17 14:07:29'),
(19, 'gcofie', 'Gilbert', 'Cofie', 'Operations Officer', '', 'gcofie@ebonyoilandgas.com', '$2y$10$BAgjmMwhnMne1o4pDarH6eFF5Jp64lutnKPo1QOTtp.B.j8//1jF6', '0000-00-00', NULL, '0561099951', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:13:30', '2017-08-17 14:07:55'),
(20, 'nawudu', 'Nafisa', 'Awudu', 'Operations Officer', '', 'nawudu@ebonyoilandgas.com', '$2y$10$Yd2b0qr0dTtaA9uSPB5mj.bKkwZfWQb3MrGNgeIe1OgjsvmDff176', '0000-00-00', NULL, '0561099962', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:14:23', '2017-08-17 14:08:27'),
(21, 'pamase', 'Philip', 'Aflo Mase', 'Operations Officer', '', 'pamase@ebonyoilandgas.com', '$2y$10$UuTGFsZ22NyCFz4rQ2LEweATyuyd/v7y2w.pklbOadoEyhil5yPnm', '0000-00-00', NULL, '0561099963', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:15:37', '2017-08-17 14:08:50'),
(22, 'dtorsu', 'Daniel', 'Torsu', 'Operations Officer', '', 'dtorsu@ebonyoilandgas.com', '$2y$10$xwICJbd2d.aF8VTbsqLsaOEGU16CzgAnNwbuAfJAGj4Vo3k3k.kjO', '0000-00-00', NULL, '0560027427', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:16:24', '2017-08-17 14:09:30'),
(23, 'afolowosele', 'Adelowo', 'Folowosele', 'Chief Finance Officer', '', 'afolowosele@ebonyoilandgas.com', '$2y$10$sL8CZnqnDowd2GmAfcTeiekjguyvPLlCs9UwSPqIwuKysTwx0zkE.', '0000-00-00', NULL, '', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:33:19', '2017-08-17 08:33:19'),
(24, 'todonkor', 'Theophlius', 'Nanor Donkor', 'Financial accountant ', '', 'todonkor@ebonyoilandgas.com', '$2y$10$qDvQIwfYakK2Xi6K4XhM4.kBk4ZUbMlpWRuxFKecBNCLtluWgyoG.', '0000-00-00', NULL, '0556485826', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:40:48', '2017-08-17 14:10:31'),
(25, 'cdapilaah', 'Cornelius', 'Dapilaah', 'Treasury Officer', '', 'cdapilaah@ebonyoilandgas.com', '$2y$10$GtWnO7dcm95E0WOyUdt68.0h10kbUWgUfO7GZ6h3b5fyxgUUa6Rm.', '0000-00-00', NULL, '0561099953', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:42:00', '2017-08-17 14:10:55'),
(26, 'eagyepong', 'Emmanuel', 'Agyepong', 'Credit Controller', '', 'eagyepong@ebonyoilandgas.com', '$2y$10$etgcT1nSxsDZh1R.pVcxsuSlAr4/X24cHtLcy56Jfagr4bLZ2rhuG', '0000-00-00', NULL, '0561099966', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:43:02', '2017-08-17 14:11:25'),
(27, 'mboateng', 'Nana', 'Kofi Boateng', 'Account payable officer', '', 'mboateng@ebonyoilandgas.com', '$2y$10$UI.k5NuHxsCgcLk0a11Mh.Ptf/AvljiCms7erUHHvGPLCBRsRNbCS', '0000-00-00', NULL, '0556537907', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:44:17', '2017-08-17 14:12:22'),
(28, 'nbatingane', 'Bright ', 'Atingane', 'Credit Control officer', '', 'nbatingane@ebonyoilandgas.com', '$2y$10$qL0sYHGoaZPMsynyAGT8oucoUalISFqR17D9KvEhpwYLCPFhBroxy', '0000-00-00', NULL, '0556537749', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:45:24', '2017-08-17 14:14:07'),
(29, 'larthur', 'Lesley', 'Asiedu', 'Head of Sales', '', 'larthur@ebonyoilandgas.com', '$2y$10$Pe7f1V5hivqUThWZ6iN8jOjYXcqKLG52N/gJ1.mu.RgKzWfdegwBO', '0000-00-00', NULL, '0561100016', '', NULL, '', '', '', 3, NULL, 1, 0, 1, 2, NULL, '2017-08-17 08:48:24', '2017-11-01 05:35:58'),
(30, 'hallotey', 'Hannah', 'Allotey', 'Key Account Manager', '', 'hallotey@ebonyoilandgas.com', '$2y$10$plXr7h9rj2Ewl3jHkkYdi.Ex.tYjFLw6RoXlYdlDATXyskt.rgiNm', '0000-00-00', NULL, '0561099957', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:49:09', '2017-08-17 14:15:43'),
(31, 'rd-kesse', 'Roseline', 'Dupulu Kesse', 'Key Account Manager', '', 'rd-kesse@ebonyoilandgas.com', '$2y$10$AvvdqEwGm/qwZZG8k7MFB.g.fPsWi7NJmoFtTfzD.jQTR5v3IfEEG', '0000-00-00', NULL, '0561099958', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:50:05', '2017-08-17 14:16:18'),
(32, 'mkduku', 'Michael', 'Kofi Duku', 'Key Account Manager', '', 'mkduku@ebonyoilandgas.com', '$2y$10$f2iWRtsAQo2l3Jm6ofZiwuMYy1uuwDzOPTWemYdMxu.GacrVfqVPe', '0000-00-00', NULL, '0561099967', '', NULL, '', '', '', 3, NULL, 1, 0, 1, 2, NULL, '2017-08-17 08:50:54', '2017-11-01 05:00:42'),
(33, 'doasante', 'Desmond', 'Ohene Asante', 'Risk Officer', '', 'doasante@ebonyoilandgas.com', '$2y$10$iSnaIz6SirwGfJqq.VM6M.3O0hACW5AX7r1gSo8dU4KZmKwNGqth.', '0000-00-00', NULL, '0561099952', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 08:53:19', '2017-08-17 14:17:12'),
(34, 'earthur', 'Eugene', 'Bernard  Arthur', 'IT Specialist', '', 'earthur@ebonyoilandgas.com', '$2y$10$5PVBl51SbcZNctO.VNVkee9C1DKqmSuc3iYE/bFBE1TqAgWpIUc6G', '0000-00-00', NULL, '0561099965', '', NULL, '', '', '', 3, NULL, 1, 0, 1, NULL, NULL, '2017-08-17 08:56:21', '2017-10-10 18:18:08'),
(35, 'rfokuo', 'Ruth', 'Opoku Fokuo', 'Head of HR and Administration', '', 'rfokuo@ebonyoilandgas.com', '$2y$10$G6EE731OeDdbUTw2jHHgw.1dIYP6Mglc3tR4CDhpzpWot.8TJ5PbC', '0000-00-00', NULL, '', '', NULL, '', '', '', 3, NULL, 1, 0, 1, 3, NULL, '2017-08-17 08:58:15', '2017-11-01 07:13:30'),
(36, 'fekudjo', 'Faridah', 'Kudjo', 'Administrative Officer', '', 'fekudjo@ebonyoilandgas.com', '$2y$10$2I/V3vbmSbDuV5Rd86.k4OFoTQEHVYj1tM1Zl.6h3McMiC/7sKsaO', '0000-00-00', NULL, '0560027426', '', NULL, '', '', '', 3, NULL, 1, 0, 1, 3, NULL, '2017-08-17 08:59:02', '2017-10-31 19:33:58'),
(37, 'do-antwi', 'Diana', 'Osei Antwi', 'Administrative Officer', '', 'do-antwi@ebonyoilandgas.com', '$2y$10$c9BxX3qURibJ4Iu9dXgLtekgoteznzSg9jMgbggq3iTacFwv3LFMy', '0000-00-00', NULL, '0561099959', '', NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-17 09:01:37', '2017-08-17 14:18:34'),
(38, 'sandoh', 'Standley', 'Andoh', 'IT Assistant', 'qqwwee', 'sandoh@ebonyoilandgas.com', '$2y$10$InZk0CW4JAJZARZEzpDUWeGK1JqVx5xIjRirYPANP64teRVkUMoS2', NULL, NULL, '', NULL, NULL, '', '', '', 3, NULL, 0, 0, 1, NULL, NULL, '2017-08-21 09:15:33', '2017-08-21 12:00:22'),
(39, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0, NULL, 0, 0, 1, NULL, NULL, '2017-12-21 14:23:11', '2017-12-21 14:23:11'),
(40, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0, NULL, 0, 0, 1, NULL, NULL, '2017-12-21 14:23:27', '2017-12-21 14:23:27'),
(41, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0, NULL, 0, 0, 1, NULL, NULL, '2017-12-21 14:25:37', '2017-12-21 14:25:37'),
(42, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0, NULL, 0, 0, 1, NULL, NULL, '2017-12-21 14:26:22', '2017-12-21 14:26:22'),
(43, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0, NULL, 0, 0, 1, NULL, NULL, '2017-12-21 14:26:49', '2017-12-21 14:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `id` int(200) UNSIGNED NOT NULL,
  `user_id` int(200) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`id`, `user_id`, `status`, `created`, `modified`) VALUES
(6, 2, 1, '2017-08-28 14:07:06', '2017-08-28 14:08:52'),
(7, 1, 2, '2017-08-28 14:07:40', '2017-08-28 14:07:40'),
(8, 2, 2, '2017-08-28 14:08:33', '2017-08-28 14:08:33'),
(9, 2, 1, '2017-08-28 14:10:52', '2017-08-28 14:12:15'),
(10, 1, 1, '2017-08-28 15:14:12', '2017-09-15 10:20:00'),
(11, 5, 1, '2017-08-28 15:44:53', '2017-08-29 02:10:18'),
(12, 2, 1, '2017-08-28 21:15:48', '2017-08-29 01:37:50'),
(13, 2, 1, '2017-08-29 01:38:04', '2017-08-31 11:31:45'),
(14, 5, 2, '2017-08-29 02:10:41', '2017-08-29 02:10:41'),
(15, 5, 2, '2017-08-30 09:05:26', '2017-08-30 09:05:26'),
(16, 5, 2, '2017-08-30 16:20:28', '2017-08-30 16:20:28'),
(17, 6, 2, '2017-08-31 11:32:20', '2017-08-31 11:32:20'),
(18, 1, 1, '2017-09-28 03:59:22', '2017-09-28 04:13:40'),
(19, 1, 1, '2017-09-28 07:37:39', '2017-10-09 08:11:28'),
(20, 0, 1, '2017-09-30 08:48:20', '2017-09-30 08:48:20'),
(21, 0, 1, '2017-09-30 08:49:47', '2017-09-30 08:49:47'),
(22, 1, 2, '2017-10-09 08:11:47', '2017-10-09 08:11:47'),
(23, 1, 1, '2017-10-09 12:23:10', '2017-10-09 12:51:24'),
(24, 4, 2, '2017-10-09 12:50:11', '2017-10-09 12:50:11'),
(25, 11, 1, '2017-10-09 12:55:16', '2017-10-09 13:05:01'),
(26, 4, 2, '2017-10-10 11:11:34', '2017-10-10 11:11:34'),
(27, 1, 1, '2017-10-10 11:15:12', '2017-10-10 14:26:15'),
(28, 4, 1, '2017-10-10 16:57:45', '2017-10-10 16:59:27'),
(29, 11, 1, '2017-10-10 16:59:44', '2017-10-10 17:00:52'),
(30, 34, 1, '2017-10-10 17:01:00', '2017-10-10 18:18:08'),
(31, 1, 1, '2017-10-10 18:25:43', '2017-10-10 18:28:08'),
(32, 1, 1, '2017-10-10 18:28:23', '2017-10-11 01:33:46'),
(33, 1, 1, '2017-10-11 01:35:30', '2017-10-11 01:38:08'),
(34, 1, 1, '2017-10-11 01:38:32', '2017-10-11 01:47:17'),
(35, 1, 1, '2017-10-11 01:47:29', '2017-10-11 01:52:18'),
(36, 1, 1, '2017-10-11 01:52:32', '2017-10-11 01:58:28'),
(37, 1, 1, '2017-10-11 01:58:42', '2017-10-11 02:08:20'),
(38, 1, 1, '2017-10-11 02:08:33', '2017-10-11 02:10:27'),
(39, 1, 1, '2017-10-11 02:10:49', '2017-10-11 07:56:36'),
(40, 1, 1, '2017-10-11 08:03:45', '2017-10-11 08:05:37'),
(41, 1, 1, '2017-10-11 08:09:26', '2017-10-11 08:09:42'),
(42, 1, 2, '2017-10-12 11:35:24', '2017-10-12 11:35:24'),
(43, 11, 1, '2017-10-17 09:17:39', '2017-10-20 06:38:50'),
(44, 1, 1, '2017-10-20 06:39:09', '2017-10-20 10:37:42'),
(45, 1, 1, '2017-10-20 10:37:55', '2017-10-21 07:14:51'),
(46, 11, 2, '2017-10-21 07:15:05', '2017-10-21 07:15:05'),
(47, 11, 2, '2017-10-23 12:18:55', '2017-10-23 12:18:55'),
(48, 1, 2, '2017-10-23 14:16:53', '2017-10-23 14:16:53'),
(49, 1, 2, '2017-10-23 20:11:59', '2017-10-23 20:11:59'),
(50, 1, 1, '2017-10-23 22:50:13', '2017-10-24 04:18:37'),
(51, 11, 2, '2017-10-24 04:18:55', '2017-10-24 04:18:55'),
(52, 1, 2, '2017-10-24 06:27:00', '2017-10-24 06:27:00'),
(53, 11, 2, '2017-10-26 08:25:20', '2017-10-26 08:25:20'),
(54, 1, 2, '2017-10-26 11:19:29', '2017-10-26 11:19:29'),
(55, 11, 2, '2017-10-30 14:20:49', '2017-10-30 14:20:49'),
(56, 1, 2, '2017-10-30 17:50:00', '2017-10-30 17:50:00'),
(57, 1, 2, '2017-10-31 13:16:53', '2017-10-31 13:16:53'),
(58, 11, 1, '2017-10-31 13:45:57', '2017-10-31 19:13:29'),
(59, 1, 2, '2017-10-31 17:49:16', '2017-10-31 17:49:16'),
(60, 10, 1, '2017-10-31 19:14:29', '2017-10-31 19:19:41'),
(61, 36, 1, '2017-10-31 19:20:36', '2017-10-31 19:21:55'),
(62, 10, 1, '2017-10-31 19:23:21', '2017-10-31 19:23:48'),
(63, 36, 1, '2017-10-31 19:24:17', '2017-10-31 19:33:58'),
(64, 35, 1, '2017-10-31 19:34:20', '2017-11-01 04:50:26'),
(65, 11, 1, '2017-11-01 04:50:37', '2017-11-01 04:53:42'),
(66, 32, 1, '2017-11-01 04:53:52', '2017-11-01 05:00:42'),
(67, 29, 1, '2017-11-01 05:00:55', '2017-11-01 05:35:58'),
(68, 35, 1, '2017-11-01 05:36:55', '2017-11-01 07:13:30'),
(69, 1, 2, '2017-11-01 07:14:35', '2017-11-01 07:14:35'),
(70, 11, 1, '2017-11-01 08:44:11', '2017-11-01 10:42:22'),
(71, 11, 1, '2017-11-01 10:43:46', '2017-11-01 15:25:46'),
(72, 1, 2, '2017-11-01 16:31:53', '2017-11-01 16:31:53'),
(73, 1, 2, '2017-11-02 04:38:23', '2017-11-02 04:38:23'),
(74, 1, 1, '2017-11-09 06:10:12', '2017-11-09 06:10:36'),
(75, 11, 1, '2017-11-09 06:10:54', '2017-11-09 06:23:54'),
(76, 1, 2, '2017-11-09 06:24:19', '2017-11-09 06:24:19'),
(77, 1, 2, '2017-11-09 09:02:43', '2017-11-09 09:02:43'),
(78, 1, 1, '2017-11-10 16:08:33', '2017-11-11 09:45:17'),
(79, 11, 2, '2017-11-11 09:45:28', '2017-11-11 09:45:28'),
(80, 11, 2, '2017-12-13 17:07:52', '2017-12-13 17:07:52'),
(81, 11, 1, '2017-12-18 08:36:20', '2017-12-21 11:45:37'),
(82, 1, 1, '2017-12-21 11:46:00', '2018-01-18 19:13:20'),
(83, 11, 2, '2018-01-09 23:23:14', '2018-01-09 23:23:14'),
(84, 1, 1, '2018-01-18 19:22:01', '2018-01-18 20:09:14'),
(85, 11, 2, '2018-01-18 20:09:27', '2018-01-18 20:09:27'),
(86, 1, 1, '2018-02-13 23:14:40', '2018-02-14 12:14:54'),
(87, 1, 1, '2018-02-14 12:15:03', '2018-02-14 12:15:08'),
(88, 1, 2, '2018-02-14 12:15:21', '2018-02-14 12:15:21'),
(89, 11, 2, '2018-03-05 10:02:49', '2018-03-05 10:02:49'),
(90, 11, 2, '2018-03-12 00:31:24', '2018-03-12 00:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(200) NOT NULL,
  `registeration_number` varchar(150) NOT NULL,
  `model` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `registeration_number`, `model`, `created`, `modified`) VALUES
(1, 'GN 2117-17', 'Land Cruiser', '2017-10-31 12:25:48', '2017-10-31 12:25:48'),
(2, 'GM 7475-13', 'Fortuner', '2017-10-31 12:26:18', '2017-10-31 12:26:18'),
(3, 'GM 1139-15', 'Land Rover Discovery', '2017-10-31 12:26:47', '2017-10-31 12:30:08'),
(4, 'GM 33-15', 'BMW', '2017-10-31 12:27:07', '2017-10-31 12:27:07'),
(5, 'GN 2962-15', 'Rav 4', '2017-10-31 12:27:25', '2017-10-31 12:27:25'),
(6, 'GX 9500-16', 'Prado', '2017-10-31 12:27:55', '2017-10-31 12:30:34'),
(7, 'GT 959-16', 'Land Rover Discovery', '2017-10-31 12:28:27', '2017-10-31 12:28:27'),
(8, 'GT 9665-15', 'Corolla', '2017-10-31 12:28:49', '2017-10-31 12:28:49'),
(9, 'GW 6976-16', 'Corolla', '2017-10-31 12:29:04', '2017-10-31 12:29:04'),
(10, 'GW 6975-16', 'Corolla', '2017-10-31 12:29:20', '2017-10-31 12:29:20'),
(11, 'GT 9664-15', 'Hilux', '2017-10-31 12:29:44', '2017-10-31 12:29:44'),
(12, 'GT 9663-15', 'Hilux', '2017-10-31 12:29:58', '2017-10-31 12:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_servicings`
--

CREATE TABLE `vehicle_servicings` (
  `id` int(11) NOT NULL,
  `request_type` int(1) NOT NULL,
  `user_id` int(200) NOT NULL,
  `department_id` int(10) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `mileage` varchar(200) NOT NULL,
  `general_servicing` int(1) NOT NULL,
  `other` longtext NOT NULL,
  `service_date` date NOT NULL,
  `next_service_date` date NOT NULL,
  `approved_by` int(200) NOT NULL,
  `approval_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `vehicle_servicings`
--

INSERT INTO `vehicle_servicings` (`id`, `request_type`, `user_id`, `department_id`, `vehicle_id`, `mileage`, `general_servicing`, `other`, `service_date`, `next_service_date`, `approved_by`, `approval_date`, `status`, `created`, `modified`) VALUES
(6, 4, 11, 5, 1, '12000', 1, 'test', '0000-00-00', '0000-00-00', 0, '0000-00-00', 1, '2018-03-12 02:47:56', '2018-03-12 02:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `wiki`
--

CREATE TABLE `wiki` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(200) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki`
--

INSERT INTO `wiki` (`id`, `department_id`, `user_id`, `title`, `content`, `created`, `modified`) VALUES
(1, 1, 6, 'Test wiki', '<p>here is where you put wiki contents</p>\r\n', '2017-08-15 08:22:33', '2017-08-15 08:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `workgroups`
--

CREATE TABLE `workgroups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `user_id` int(200) UNSIGNED NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve_members` varchar(10) NOT NULL DEFAULT 'ALL' COMMENT 'Approved members. Data can be stored include ALL (Any site member can join), ANY(Only approved members can join), APPR(Only approved members can join except for invited members)',
  `content_access` varchar(45) NOT NULL DEFAULT 'GROUP' COMMENT 'The content access, ALL (anybody can view the content), SITE(Site members), GROUP (Group members). Defaults to only group members',
  `is_approved` int(1) NOT NULL DEFAULT '1' COMMENT 'Whether a workgroup created is approved by the portal adminsitrator or not. Defaults to FALSE',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroups`
--

INSERT INTO `workgroups` (`id`, `name`, `description`, `user_id`, `created_on`, `approve_members`, `content_access`, `is_approved`, `created`, `modified`) VALUES
(1, 'This a test workgroup', 'This a test workgroup description', 11, '2017-10-23 17:02:59', '1', '1', 2, '2017-10-23 17:02:59', '2017-10-23 17:03:52'),
(2, 'Test', 'test workgroup description', 11, '2017-10-23 17:07:07', '1', '1', 1, '2017-10-23 17:07:07', '2017-10-23 17:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `workgroups_members`
--

CREATE TABLE `workgroups_members` (
  `id` int(200) UNSIGNED NOT NULL,
  `workgroup_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroups_members`
--

INSERT INTO `workgroups_members` (`id`, `workgroup_id`, `user_id`, `status`, `created`, `modified`) VALUES
(1, 1, 11, 0, '2017-10-23 17:02:59', '2017-10-23 17:02:59'),
(2, 2, 11, 0, '2017-10-23 17:07:07', '2017-10-23 17:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_comments`
--

CREATE TABLE `workgroup_comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `comment_src` int(1) NOT NULL,
  `source_id` int(255) DEFAULT NULL,
  `project_id` int(255) NOT NULL,
  `forum_id` int(255) NOT NULL,
  `wiki_id` int(200) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `workgroup_id` int(200) NOT NULL,
  `comment` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroup_comments`
--

INSERT INTO `workgroup_comments` (`id`, `comment_src`, `source_id`, `project_id`, `forum_id`, `wiki_id`, `parent_id`, `user_id`, `workgroup_id`, `comment`, `created`, `modified`, `lft`, `rght`) VALUES
(1, 1, 1, 1, 0, 0, NULL, 6, 0, 'test comment', '2017-08-18 06:13:40', '2017-08-18 06:13:40', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_events`
--

CREATE TABLE `workgroup_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` mediumtext,
  `location` varchar(255) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `workgroup_id` int(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_event_members`
--

CREATE TABLE `workgroup_event_members` (
  `id` int(120) NOT NULL,
  `event_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `workgroup_id` int(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_forums`
--

CREATE TABLE `workgroup_forums` (
  `id` int(100) UNSIGNED NOT NULL,
  `workgroup_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_media`
--

CREATE TABLE `workgroup_media` (
  `id` int(11) NOT NULL,
  `source_id` int(200) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `lft` int(255) NOT NULL,
  `rght` int(255) NOT NULL,
  `project_id` int(200) NOT NULL,
  `task_id` int(200) NOT NULL,
  `folder_name` varchar(120) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `media_dir` varchar(200) NOT NULL,
  `media_type` varchar(200) NOT NULL,
  `uploaded_by` int(10) UNSIGNED NOT NULL,
  `workgroup_id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(200) NOT NULL,
  `wiki_id` int(200) NOT NULL,
  `media_access` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_messages`
--

CREATE TABLE `workgroup_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` int(10) UNSIGNED NOT NULL,
  `to` int(10) UNSIGNED NOT NULL,
  `workgroup_id` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_news`
--

CREATE TABLE `workgroup_news` (
  `id` int(150) UNSIGNED NOT NULL,
  `category_id` int(150) DEFAULT NULL,
  `workgroup_id` int(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `story` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroup_news`
--

INSERT INTO `workgroup_news` (`id`, `category_id`, `workgroup_id`, `title`, `summary`, `story`, `image`, `user_id`, `created`, `modified`) VALUES
(1, 1, 1, 'test news', 'this is a test', '<p>yes this is a test</p>\r\n', '', 6, '2017-08-18 06:24:52', '2017-08-18 06:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_projects`
--

CREATE TABLE `workgroup_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `workgroup_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL COMMENT 'The deadline of the created project',
  `end_date` datetime NOT NULL,
  `status` varchar(12) NOT NULL COMMENT 'The status of the project. Can store values such as COMPLETED, PROGRESS, CANCELLED',
  `progress` int(3) NOT NULL,
  `monitor_timeline` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workgroup_projects`
--

INSERT INTO `workgroup_projects` (`id`, `workgroup_id`, `name`, `description`, `created_by`, `start_date`, `end_date`, `status`, `progress`, `monitor_timeline`, `created`, `modified`) VALUES
(0, 1, 'workgroup project', '<p>description</p>\r\n', 11, '2017-10-24 00:00:00', '2017-10-31 02:00:00', '1', 0, 3, '2017-10-24 08:42:57', '2017-10-24 08:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_project_members`
--

CREATE TABLE `workgroup_project_members` (
  `id` int(200) UNSIGNED NOT NULL,
  `project_id` int(200) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `workgroup_id` int(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_tasks`
--

CREATE TABLE `workgroup_tasks` (
  `id` int(20) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `workgroup_id` int(20) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `progress` int(3) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `notes` mediumtext NOT NULL,
  `attended_by` varchar(255) NOT NULL,
  `reviewed_by` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workgroup_wiki`
--

CREATE TABLE `workgroup_wiki` (
  `id` int(10) UNSIGNED NOT NULL,
  `workgroup_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(200) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_outside_schedules`
--

CREATE TABLE `work_outside_schedules` (
  `id` int(200) NOT NULL,
  `request_type` int(1) NOT NULL,
  `user_id` int(200) NOT NULL,
  `location` varchar(255) NOT NULL,
  `stand_by` longtext,
  `stand_in` longtext,
  `start_date` varchar(10) DEFAULT NULL,
  `end_date` varchar(10) DEFAULT NULL,
  `number_of_days` int(10) DEFAULT NULL,
  `total` int(20) DEFAULT NULL,
  `justification` longtext,
  `department_head` int(200) DEFAULT NULL,
  `department_head_approval_date` datetime DEFAULT NULL,
  `checked_by` int(200) DEFAULT NULL,
  `checked_date` datetime DEFAULT NULL,
  `approved_by` int(200) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `department_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `work_outside_schedules`
--

INSERT INTO `work_outside_schedules` (`id`, `request_type`, `user_id`, `location`, `stand_by`, `stand_in`, `start_date`, `end_date`, `number_of_days`, `total`, `justification`, `department_head`, `department_head_approval_date`, `checked_by`, `checked_date`, `approved_by`, `approval_date`, `department_id`, `status`, `created`, `modified`) VALUES
(5, 2, 11, 'kumasi', '', '01/08/2018,01/11/2018,01/16/2018,01/18/2018,01/19/2018', '01/08/2018', '01/19/2018', 5, 750, 'test', 11, '2018-01-12 12:51:02', NULL, NULL, NULL, NULL, 5, 2, '2018-01-11 09:36:20', '2018-01-12 12:51:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities_logs`
--
ALTER TABLE `activities_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canteen`
--
ALTER TABLE `canteen`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `cash_requests`
--
ALTER TABLE `cash_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cometchat`
--
ALTER TABLE `cometchat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to` (`to`),
  ADD KEY `from` (`from`),
  ADD KEY `direction` (`direction`),
  ADD KEY `read` (`read`),
  ADD KEY `sent` (`sent`);

--
-- Indexes for table `cometchat_announcements`
--
ALTER TABLE `cometchat_announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to` (`to`),
  ADD KEY `time` (`time`),
  ADD KEY `to_id` (`to`,`id`);

--
-- Indexes for table `cometchat_block`
--
ALTER TABLE `cometchat_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromid` (`fromid`),
  ADD KEY `toid` (`toid`),
  ADD KEY `fromid_toid` (`fromid`,`toid`);

--
-- Indexes for table `cometchat_bots`
--
ALTER TABLE `cometchat_bots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cometchat_chatroommessages`
--
ALTER TABLE `cometchat_chatroommessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `chatroomid` (`chatroomid`),
  ADD KEY `sent` (`sent`);

--
-- Indexes for table `cometchat_chatrooms`
--
ALTER TABLE `cometchat_chatrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lastactivity` (`lastactivity`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `cometchat_chatrooms_users`
--
ALTER TABLE `cometchat_chatrooms_users`
  ADD PRIMARY KEY (`userid`,`chatroomid`) USING BTREE,
  ADD KEY `chatroomid` (`chatroomid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid_chatroomid` (`chatroomid`,`userid`);

--
-- Indexes for table `cometchat_colors`
--
ALTER TABLE `cometchat_colors`
  ADD UNIQUE KEY `color_index` (`color_key`,`color`);

--
-- Indexes for table `cometchat_guests`
--
ALTER TABLE `cometchat_guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cometchat_languages`
--
ALTER TABLE `cometchat_languages`
  ADD UNIQUE KEY `lang_index` (`lang_key`,`code`,`type`,`name`) USING BTREE;

--
-- Indexes for table `cometchat_recentconversation`
--
ALTER TABLE `cometchat_recentconversation`
  ADD UNIQUE KEY `convo_id` (`convo_id`),
  ADD KEY `fromid` (`from`),
  ADD KEY `toid` (`to`),
  ADD KEY `fromid_toid` (`from`,`to`);

--
-- Indexes for table `cometchat_session`
--
ALTER TABLE `cometchat_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `cometchat_settings`
--
ALTER TABLE `cometchat_settings`
  ADD PRIMARY KEY (`setting_key`),
  ADD KEY `key` (`setting_key`);

--
-- Indexes for table `cometchat_status`
--
ALTER TABLE `cometchat_status`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `typingto` (`typingto`),
  ADD KEY `typingtime` (`typingtime`);

--
-- Indexes for table `cometchat_users`
--
ALTER TABLE `cometchat_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cometchat_videochatsessions`
--
ALTER TABLE `cometchat_videochatsessions`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `identity` (`identity`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments_members`
--
ALTER TABLE `departments_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_comments`
--
ALTER TABLE `department_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_events`
--
ALTER TABLE `department_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_event_members`
--
ALTER TABLE `department_event_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `department_forums`
--
ALTER TABLE `department_forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_media`
--
ALTER TABLE `department_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_messages`
--
ALTER TABLE `department_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_news`
--
ALTER TABLE `department_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_projects`
--
ALTER TABLE `department_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_project_members`
--
ALTER TABLE `department_project_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_tasks`
--
ALTER TABLE `department_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_wiki`
--
ALTER TABLE `department_wiki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_members`
--
ALTER TABLE `events_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_days`
--
ALTER TABLE `leave_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `scope` (`scope`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_forms`
--
ALTER TABLE `request_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_handlers`
--
ALTER TABLE `request_handlers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_servicings`
--
ALTER TABLE `vehicle_servicings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workgroups`
--
ALTER TABLE `workgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workgroups_members`
--
ALTER TABLE `workgroups_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workgroup_media`
--
ALTER TABLE `workgroup_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_outside_schedules`
--
ALTER TABLE `work_outside_schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities_logs`
--
ALTER TABLE `activities_logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cash_requests`
--
ALTER TABLE `cash_requests`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cometchat`
--
ALTER TABLE `cometchat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cometchat_announcements`
--
ALTER TABLE `cometchat_announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cometchat_block`
--
ALTER TABLE `cometchat_block`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cometchat_bots`
--
ALTER TABLE `cometchat_bots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cometchat_chatroommessages`
--
ALTER TABLE `cometchat_chatroommessages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cometchat_chatrooms`
--
ALTER TABLE `cometchat_chatrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cometchat_guests`
--
ALTER TABLE `cometchat_guests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000001;
--
-- AUTO_INCREMENT for table `cometchat_users`
--
ALTER TABLE `cometchat_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `departments_members`
--
ALTER TABLE `departments_members`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `department_comments`
--
ALTER TABLE `department_comments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department_events`
--
ALTER TABLE `department_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `department_forums`
--
ALTER TABLE `department_forums`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department_media`
--
ALTER TABLE `department_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `department_projects`
--
ALTER TABLE `department_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `department_project_members`
--
ALTER TABLE `department_project_members`
  MODIFY `id` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department_tasks`
--
ALTER TABLE `department_tasks`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department_wiki`
--
ALTER TABLE `department_wiki`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events_members`
--
ALTER TABLE `events_members`
  MODIFY `id` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `leave_days`
--
ALTER TABLE `leave_days`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `request_forms`
--
ALTER TABLE `request_forms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `request_handlers`
--
ALTER TABLE `request_handlers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `id` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vehicle_servicings`
--
ALTER TABLE `vehicle_servicings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `workgroups`
--
ALTER TABLE `workgroups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `workgroups_members`
--
ALTER TABLE `workgroups_members`
  MODIFY `id` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `workgroup_media`
--
ALTER TABLE `workgroup_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_outside_schedules`
--
ALTER TABLE `work_outside_schedules`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
