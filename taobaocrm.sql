-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 12 日 22:58
-- 服务器版本: 5.1.54
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `taobaocrm`
--

-- --------------------------------------------------------

--
-- 表的结构 `ec_account`
--

CREATE TABLE IF NOT EXISTS `ec_account` (
  `accountid` int(19) NOT NULL DEFAULT '0',
  `accountname` varchar(100) NOT NULL,
  `prefix` varchar(2) DEFAULT NULL,
  `tao_user_id` int(19) DEFAULT '0',
  `tao_uid` int(19) DEFAULT '0',
  `belongshop` varchar(100) DEFAULT NULL,
  `membername` varchar(100) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `account_buyer_credit` varchar(30) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `promoted_type` varchar(50) DEFAULT NULL,
  `alipay_no` varchar(50) DEFAULT NULL,
  `alipay_account` varchar(50) DEFAULT NULL,
  `consumer_protection` varchar(50) DEFAULT NULL,
  `alipay_bind` varchar(50) DEFAULT NULL,
  `contact_date` datetime DEFAULT NULL,
  `contacttimes` int(10) DEFAULT '0',
  `vipinfo` varchar(50) DEFAULT NULL,
  `lastorderdate` datetime DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ordernum` int(11) DEFAULT '0',
  `ordertotal` decimal(11,2) DEFAULT NULL,
  `buy_pro_num` int(11) DEFAULT '0',
  `last_logintime` datetime DEFAULT NULL,
  `bill_state` varchar(30) DEFAULT NULL,
  `bill_city` varchar(30) DEFAULT NULL,
  `bill_district` varchar(30) DEFAULT NULL,
  `bill_street` varchar(250) DEFAULT NULL,
  `bill_code` varchar(30) DEFAULT NULL,
  `description` text,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `oneweekbuy` int(11) DEFAULT '0',
  `onemonthbuy` int(11) DEFAULT '0',
  `threemonthbuy` int(11) DEFAULT '0',
  `oneweeksendmess` int(11) DEFAULT '0',
  `onemonthsendmess` int(11) DEFAULT '0',
  `threemonthsendmess` int(11) DEFAULT '0',
  `oneweeksendmail` int(11) DEFAULT '0',
  `onemonthsendmail` int(11) DEFAULT '0',
  `threemonthsendmail` int(11) DEFAULT '0',
  `lastsendmessdate` date DEFAULT '0000-00-00',
  `lastsendmaildate` date DEFAULT '0000-00-00',
  `allsuccessbuy` int(11) DEFAULT '0',
  `tel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`accountid`),
  KEY `account_account_type_idx` (`account_type`),
  KEY `prefix` (`prefix`),
  KEY `membername_index` (`deleted`,`smownerid`,`membername`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_account`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_attachments`
--

CREATE TABLE IF NOT EXISTS `ec_attachments` (
  `attachmentsid` int(19) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `setype` varchar(100) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `smcreatorid` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`attachmentsid`),
  KEY `attachments_description_name_type_attachmentsid_idx` (`description`,`name`,`type`,`attachmentsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_attachments`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_attachmentsjrel`
--

CREATE TABLE IF NOT EXISTS `ec_attachmentsjrel` (
  `sjid` int(19) DEFAULT NULL,
  `attachmentsid` int(19) NOT NULL,
  PRIMARY KEY (`attachmentsid`),
  KEY `sjid` (`sjid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_attachmentsjrel`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_attachments_seq`
--

CREATE TABLE IF NOT EXISTS `ec_attachments_seq` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_attachments_seq`
--

INSERT INTO `ec_attachments_seq` (`id`) VALUES
(71);

-- --------------------------------------------------------

--
-- 表的结构 `ec_audit_trial`
--

CREATE TABLE IF NOT EXISTS `ec_audit_trial` (
  `auditid` int(19) NOT NULL,
  `userid` int(19) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `recordid` varchar(20) DEFAULT NULL,
  `actiondate` datetime DEFAULT NULL,
  PRIMARY KEY (`auditid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_audit_trial`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_bill_country`
--

CREATE TABLE IF NOT EXISTS `ec_bill_country` (
  `actualfieldid` int(19) NOT NULL,
  `actualfieldname` varchar(200) NOT NULL,
  `sortorderid` int(19) NOT NULL DEFAULT '0',
  `presence` int(1) NOT NULL DEFAULT '1',
  `thelevel` int(11) NOT NULL DEFAULT '1',
  `parentfieldid` int(19) NOT NULL DEFAULT '0',
  PRIMARY KEY (`actualfieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_bill_country`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_bill_country_seq`
--

CREATE TABLE IF NOT EXISTS `ec_bill_country_seq` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_bill_country_seq`
--

INSERT INTO `ec_bill_country_seq` (`id`) VALUES
(3233);

-- --------------------------------------------------------

--
-- 表的结构 `ec_blocks`
--

CREATE TABLE IF NOT EXISTS `ec_blocks` (
  `blockid` int(19) NOT NULL,
  `tabid` int(19) NOT NULL,
  `blocklabel` varchar(100) NOT NULL,
  `sequence` int(10) DEFAULT NULL,
  `show_title` int(2) DEFAULT NULL,
  `visible` int(2) NOT NULL DEFAULT '0',
  `create_view` int(2) NOT NULL DEFAULT '0',
  `edit_view` int(2) NOT NULL DEFAULT '0',
  `detail_view` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blockid`),
  KEY `block_tabid_idx` (`tabid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_blocks`
--

INSERT INTO `ec_blocks` (`blockid`, `tabid`, `blocklabel`, `sequence`, `show_title`, `visible`, `create_view`, `edit_view`, `detail_view`) VALUES
(1, 6, 'LBL_ACCOUNT_INFORMATION', 1, 0, 0, 0, 0, 0),
(102, 34, '客户', 2, 0, 0, 0, 0, 0),
(3, 6, 'LBL_ORDER_INFORMATION', 3, 0, 0, 0, 0, 0),
(4, 6, 'LBL_SHOP_INFORMATION', 4, 0, 0, 0, 0, 0),
(5, 6, 'LBL_ADDRESS_INFORMATION', 5, 0, 0, 0, 0, 0),
(6, 6, 'LBL_DESCRIPTION_INFORMATION', 6, 0, 0, 0, 0, 0),
(7, 6, 'LBL_SYSTEM_INFORMATION', 7, 0, 0, 0, 0, 0),
(8, 6, 'LBL_CUSTOM_INFORMATION', 8, 0, 0, 0, 0, 0),
(21, 8, 'LBL_NOTE_INFORMATION', 1, 0, 0, 0, 0, 0),
(22, 8, 'LBL_CONTENT_INFORMATION', 2, 0, 0, 0, 0, 0),
(23, 8, 'LBL_SYSTEM_INFORMATION', 3, 0, 0, 0, 0, 0),
(24, 8, 'LBL_CUSTOM_INFORMATION', 4, 0, 0, 0, 0, 0),
(41, 14, 'LBL_PRODUCT_INFORMATION', 1, 0, 0, 0, 0, 0),
(42, 14, 'LBL_PRICING_INFORMATION', 2, 0, 0, 0, 0, 0),
(43, 14, 'LBL_PROPS_INFORMATION', 3, 0, 0, 0, 0, 0),
(44, 14, 'LBL_IMAGE_INFORMATION', 4, 0, 0, 0, 0, 0),
(47, 14, 'LBL_DESCRIPTION_INFORMATION', 7, 0, 0, 0, 0, 0),
(48, 14, 'LBL_SYSTEM_INFORMATION', 8, 0, 0, 0, 0, 0),
(49, 14, 'LBL_CUSTOM_INFORMATION', 9, 0, 0, 0, 0, 0),
(61, 22, 'LBL_SO_INFORMATION', 1, 0, 0, 0, 0, 0),
(62, 22, 'LBL_BUYER_INFORMATION', 2, 0, 0, 0, 0, 0),
(63, 22, 'LBL_BUYERMESSAGE_INFORMATION', 3, 0, 0, 0, 0, 0),
(64, 22, 'LBL_RECEIVER_INFORMATION', 4, 0, 0, 0, 0, 0),
(65, 22, 'LBL_SELLER_INFORMATION', 5, 0, 0, 0, 0, 0),
(66, 22, 'LBL_TRADE_INFORMATION', 6, 0, 0, 0, 0, 0),
(67, 22, 'LBL_TC_INFORMATION', 7, 0, 0, 0, 0, 0),
(68, 22, 'LBL_PROMOTION_INFORMATION', 8, 0, 0, 0, 0, 0),
(69, 22, 'LBL_WL_INFORMATION', 9, 0, 0, 0, 0, 0),
(70, 22, 'LBL_DESCRIPTION_INFORMATION', 10, 0, 0, 0, 0, 0),
(71, 22, 'LBL_SYSTEM_INFORMATION', 11, 0, 0, 0, 0, 0),
(72, 22, 'LBL_CUSTOM_INFORMATION', 12, 0, 0, 0, 0, 0),
(79, 29, 'LBL_USERLOGIN_ROLE', 1, 0, 0, 0, 0, 0),
(80, 29, 'LBL_MORE_INFORMATION', 2, 0, 0, 0, 0, 0),
(81, 29, 'LBL_ADDRESS_INFORMATION', 3, 0, 0, 0, 0, 0),
(83, 29, 'LBL_USER_IMAGE_INFORMATION', 4, 0, 0, 0, 0, 0),
(84, 33, 'LBL_QUNFA_INFORMATION', 1, 0, 0, 0, 0, 0),
(85, 33, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(86, 33, '描述信息', 5, 0, 0, 0, 0, 0),
(87, 34, 'LBL_MAILLIST_INFORMATION', 1, 0, 0, 0, 0, 0),
(88, 34, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(89, 34, '描述信息', 5, 0, 0, 0, 0, 0),
(90, 35, 'LBL_QUNFATMP_INFORMATION', 1, 0, 0, 0, 0, 0),
(91, 35, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(92, 35, '内容信息', 3, 0, 0, 0, 0, 0),
(93, 36, 'LBL_MAILLISTTMP_INFORMATION', 1, 0, 0, 0, 0, 0),
(94, 36, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(95, 36, '内容信息', 3, 0, 0, 0, 0, 0),
(96, 33, '短信内容', 3, 0, 0, 0, 0, 0),
(97, 34, '邮件内容', 3, 0, 0, 0, 0, 0),
(98, 34, '邮件主题', 2, 0, 0, 0, 0, 0),
(99, 37, 'LBL_RELSETTING_INFORMATION', 1, 0, 0, 0, 0, 0),
(100, 37, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(101, 37, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(103, 33, '客户', 2, 0, 0, 0, 0, 0),
(104, 44, 'LBL_SFADESKTOP_INFORMATION', 1, 0, 0, 0, 0, 0),
(105, 44, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(106, 44, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(107, 45, 'LBL_SFALIST_INFORMATION', 1, 0, 0, 0, 0, 0),
(108, 45, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(109, 45, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(110, 46, 'LBL_SFALOG_INFORMATION', 1, 0, 0, 0, 0, 0),
(111, 46, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(112, 46, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(113, 47, 'LBL_SFASETTING_INFORMATION', 1, 0, 0, 0, 0, 0),
(114, 47, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0),
(115, 47, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(116, 48, 'LBL_DESCRIPTION_INFORMATION', 3, 0, 0, 0, 0, 0),
(117, 48, 'LBL_MEMDAY_INFORMATION', 1, 0, 0, 0, 0, 0),
(118, 48, 'LBL_CUSTOM_INFORMATION', 2, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ec_crmentity`
--

CREATE TABLE IF NOT EXISTS `ec_crmentity` (
  `crmid` int(19) NOT NULL,
  `smcreatorid` int(19) NOT NULL DEFAULT '0',
  `smownerid` int(19) NOT NULL DEFAULT '0',
  `modifiedby` int(19) NOT NULL DEFAULT '0',
  `setype` varchar(30) NOT NULL,
  `description` text,
  `createdtime` datetime NOT NULL,
  `modifiedtime` datetime NOT NULL,
  `viewedtime` datetime DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`crmid`),
  KEY `crmentity_smcreatorid_idx` (`smcreatorid`),
  KEY `crmentity_smownerid_idx` (`smownerid`),
  KEY `crmentity_modifiedby_idx` (`modifiedby`),
  KEY `crmentity_deleted_smownerid_idx` (`deleted`,`smownerid`),
  KEY `crmentity_smownerid_deleted_idx` (`smownerid`,`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_crmentity`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_crmentityrel`
--

CREATE TABLE IF NOT EXISTS `ec_crmentityrel` (
  `module` varchar(100) NOT NULL,
  `relmodule` varchar(100) NOT NULL,
  UNIQUE KEY `module_relmodule_idx` (`module`,`relmodule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_crmentityrel`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_crmentity_seq`
--

CREATE TABLE IF NOT EXISTS `ec_crmentity_seq` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_crmentity_seq`
--

INSERT INTO `ec_crmentity_seq` (`id`) VALUES
(2286911);

-- --------------------------------------------------------

--
-- 表的结构 `ec_customview`
--

CREATE TABLE IF NOT EXISTS `ec_customview` (
  `cvid` int(19) NOT NULL,
  `viewname` varchar(100) NOT NULL,
  `setdefault` int(1) DEFAULT '0',
  `setmetrics` int(1) DEFAULT '0',
  `entitytype` varchar(100) NOT NULL,
  `setpublic` varchar(200) DEFAULT '0',
  `collectcolumn` varchar(150) DEFAULT NULL,
  `smownerid` int(19) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cvid`),
  KEY `smownerid` (`smownerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_customview`
--

INSERT INTO `ec_customview` (`cvid`, `viewname`, `setdefault`, `setmetrics`, `entitytype`, `setpublic`, `collectcolumn`, `smownerid`) VALUES
(1, '所有', 1, 0, 'Accounts', '', '', 0),
(2, '所有', 1, 0, 'Notes', '', '', 0),
(3, '所有', 0, 0, 'Products', '', '', 0),
(4, '所有', 1, 0, 'SalesOrder', '', '', 0),
(8, '所有', 1, 0, 'Qunfatmps', '', '', 0),
(6, '所有', 1, 0, 'Maillists', '0', NULL, 0),
(9, '所有', 0, 0, 'Maillisttmps', '', '', 0),
(10, '所有', 1, 0, 'Relsettings', '0', NULL, 0),
(11, '成功交易的客户', 0, 0, 'Accounts', '', '', 0),
(12, '只成功购买一次的客户', 0, 0, 'Accounts', '', '', 0),
(13, '重复消费的客户', 0, 0, 'Accounts', '', '', 0),
(14, '休眠100天的用户', 0, 0, 'Accounts', '', '', 0),
(15, '休眠180天的客户', 0, 0, 'Accounts', '', '', 0),
(16, '未成功购买客户', 0, 0, 'Accounts', '', '', 0),
(18, 'test', 0, 0, 'Accounts', '', '', 7),
(19, '33333333', 0, 0, 'Accounts', '', '', 7),
(21, '23423423424234', 0, 0, 'Qunfatmps', '', '', 8),
(32, '所有', 1, 0, 'Sfalists', '0', NULL, 0),
(26, '买家已付款，等待卖家发货', 0, 0, 'SalesOrder', '', '', 0),
(25, '等待买家付款', 0, 0, 'SalesOrder', '', '', 0),
(31, '所有', 1, 0, 'SfaDesktops', '0', NULL, 0),
(27, '卖家已发货，等待买家确认', 0, 0, 'SalesOrder', '', '', 0),
(28, '交易成功', 0, 0, 'SalesOrder', '', '', 0),
(29, '交易关闭', 0, 0, 'SalesOrder', '', '', 0),
(33, '所有', 1, 0, 'Sfalogs', '0', NULL, 0),
(34, '所有', 1, 0, 'Sfasettings', '0', NULL, 0),
(35, '111', 0, 0, 'Notes', '', '', 21),
(37, '客户资料', 0, 0, 'SalesOrder', '', '', 84),
(38, '所有', 0, 0, 'Memdays', '', '', 0),
(39, '1', 0, 0, 'Accounts', '', 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 233),
(40, 'xxxx', 0, 0, 'Accounts', '', '', 353),
(42, '111', 0, 0, 'SalesOrder', '', '', 425),
(43, '11', 0, 0, 'Maillisttmps', '', '', 447),
(44, 'EDM', 0, 0, 'Maillisttmps', '', '', 466),
(45, '出售中', 0, 0, 'Products', '', 'ec_products:price:price:Products_Price:N', 467),
(46, '交易表', 0, 0, 'SalesOrder', '', '', 370),
(47, '发发发', 0, 0, 'Maillisttmps', '', '', 407),
(49, '产品视图', 0, 0, 'Products', '', '', 513),
(50, '易品男装', 0, 0, 'Maillisttmps', '', '', 452),
(51, '22', 0, 0, 'Products', '', '', 452),
(52, ' 测试模板', 0, 0, 'Maillisttmps', '', '', 545),
(53, '123456', 0, 0, 'Accounts', '', '', 607),
(54, '01', 0, 0, 'Accounts', '', '', 748),
(55, '服装', 0, 0, 'Products', '', '', 760),
(56, '1', 0, 0, 'Products', '', '', 822),
(63, '上季度联系', 0, 0, 'Accounts', '', '', 895),
(61, '客户', 0, 0, 'Accounts', '', 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 876),
(59, '健身会员', 0, 0, 'SalesOrder', '', '', 873),
(60, '健身会员', 0, 0, 'Accounts', '', '', 873),
(62, '客户2', 0, 0, 'Accounts', '', '', 876),
(64, '本季度联系', 0, 0, 'Accounts', '', '', 895),
(65, '111', 0, 0, 'Products', '', '', 907),
(66, '2-4次购买', 0, 0, 'Accounts', '', 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 1019),
(67, '00000000000000000000000000', 0, 0, 'Accounts', '', 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I', 1046),
(71, '341', 0, 0, 'Products', '', '', 1201),
(72, '1', 0, 0, 'Accounts', '', 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 1325),
(73, '慢慢', 0, 0, 'Accounts', '', '', 1363),
(74, '导出', 0, 0, 'Accounts', '', '', 1396),
(75, '近期报表', 0, 0, 'Products', '', '', 1457),
(76, 'qw', 0, 0, 'Accounts', '', 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I', 1547),
(78, 'xc', 0, 0, 'Accounts', '', '', 1456);

-- --------------------------------------------------------

--
-- 表的结构 `ec_customview_seq`
--

CREATE TABLE IF NOT EXISTS `ec_customview_seq` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_customview_seq`
--

INSERT INTO `ec_customview_seq` (`id`) VALUES
(78);

-- --------------------------------------------------------

--
-- 表的结构 `ec_cvadvfilter`
--

CREATE TABLE IF NOT EXISTS `ec_cvadvfilter` (
  `cvid` int(19) NOT NULL,
  `columnindex` int(11) NOT NULL,
  `columnname` varchar(250) DEFAULT '',
  `comparator` varchar(10) DEFAULT '',
  `value` varchar(200) DEFAULT '',
  PRIMARY KEY (`cvid`,`columnindex`),
  KEY `cvadvfilter_cvid_idx` (`cvid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_cvadvfilter`
--

INSERT INTO `ec_cvadvfilter` (`cvid`, `columnindex`, `columnname`, `comparator`, `value`) VALUES
(7, 0, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T', 'e', '622'),
(7, 1, '', '', ''),
(7, 2, '', '', ''),
(7, 3, '', '', ''),
(7, 4, '', '', ''),
(8, 4, '', '', ''),
(8, 3, '', '', ''),
(8, 2, '', '', ''),
(8, 1, '', '', ''),
(8, 0, '', '', ''),
(9, 4, '', '', ''),
(9, 3, '', '', ''),
(9, 2, '', '', ''),
(9, 1, '', '', ''),
(9, 0, '', '', ''),
(1, 4, '', '', ''),
(1, 3, '', '', ''),
(1, 2, '', '', ''),
(3, 4, '', '', ''),
(3, 3, '', '', ''),
(3, 2, '', '', ''),
(11, 1, '', '', ''),
(11, 2, '', '', ''),
(13, 1, '', '', ''),
(14, 0, '', '', ''),
(14, 1, '', '', ''),
(15, 0, '', '', ''),
(15, 1, '', '', ''),
(15, 2, '', '', ''),
(14, 2, '', '', ''),
(17, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(17, 1, '', '', ''),
(17, 2, '', '', ''),
(17, 3, '', '', ''),
(17, 4, '', '', ''),
(12, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'e', '1'),
(16, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'l', '1'),
(2, 0, '', '', ''),
(2, 1, '', '', ''),
(2, 2, '', '', ''),
(2, 3, '', '', ''),
(2, 4, '', '', ''),
(4, 4, '', '', ''),
(4, 3, '', '', ''),
(4, 2, '', '', ''),
(4, 1, '', '', ''),
(4, 0, '', '', ''),
(1, 1, '', '', ''),
(11, 3, '', '', ''),
(11, 4, '', '', ''),
(15, 3, '', '', ''),
(11, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '1'),
(18, 0, '', '', ''),
(18, 1, '', '', ''),
(18, 2, '', '', ''),
(18, 3, '', '', ''),
(18, 4, '', '', ''),
(19, 4, '', '', ''),
(19, 3, '', '', ''),
(19, 2, '', '', ''),
(19, 1, '', '', ''),
(19, 0, '', '', ''),
(1, 0, '', '', ''),
(20, 4, '', '', ''),
(20, 3, '', '', ''),
(20, 2, '', '', ''),
(20, 1, '', '', ''),
(20, 0, '', '', ''),
(21, 4, '', '', ''),
(21, 3, '', '', ''),
(21, 2, '', '', ''),
(21, 1, '', '', ''),
(21, 0, '', '', ''),
(12, 1, '', '', ''),
(12, 2, '', '', ''),
(12, 3, '', '', ''),
(12, 4, '', '', ''),
(13, 2, '', '', ''),
(13, 3, '', '', ''),
(14, 3, '', '', ''),
(14, 4, '', '', ''),
(15, 4, '', '', ''),
(16, 1, '', '', ''),
(16, 2, '', '', ''),
(16, 3, '', '', ''),
(16, 4, '', '', ''),
(22, 2, '', '', ''),
(22, 3, '', '', ''),
(22, 1, 'ec_salesorder:consign_time:consign_time:SalesOrder_Consign_Time:V', 'e', '0000-00-00 00:00:00'),
(22, 0, '', '', ''),
(22, 4, '', '', ''),
(23, 0, 'ec_salesorder:pay_time:pay_time:SalesOrder_Pay_Time:V', 'e', '0000-00-00 00:00:00'),
(23, 1, '', '', ''),
(23, 2, '', '', ''),
(23, 3, '', '', ''),
(23, 4, '', '', ''),
(24, 0, '', '', ''),
(24, 1, '', '', ''),
(24, 2, '', '', ''),
(24, 3, '', '', ''),
(24, 4, '', '', ''),
(25, 0, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V', 'e', '等待买家付款'),
(25, 1, '', '', ''),
(25, 2, '', '', ''),
(25, 3, '', '', ''),
(25, 4, '', '', ''),
(26, 0, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V', 'e', '买家已付款，等待卖家发货'),
(26, 1, '', '', ''),
(26, 2, '', '', ''),
(26, 3, '', '', ''),
(26, 4, '', '', ''),
(27, 0, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V', 'e', '卖家已发货，等待买家确认'),
(27, 1, '', '', ''),
(27, 2, '', '', ''),
(27, 3, '', '', ''),
(27, 4, '', '', ''),
(28, 0, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V', 'e', '交易成功'),
(28, 1, '', '', ''),
(28, 2, '', '', ''),
(28, 3, '', '', ''),
(28, 4, '', '', ''),
(29, 0, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V', 'e', '交易关闭'),
(29, 1, '', '', ''),
(29, 2, '', '', ''),
(29, 3, '', '', ''),
(29, 4, '', '', ''),
(30, 0, '', '', ''),
(30, 1, '', '', ''),
(30, 2, '', '', ''),
(30, 3, '', '', ''),
(30, 4, '', '', ''),
(3, 1, '', '', ''),
(3, 0, '', '', ''),
(13, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'g', '1'),
(13, 4, '', '', ''),
(35, 0, '', '', ''),
(35, 1, '', '', ''),
(35, 2, '', '', ''),
(35, 3, '', '', ''),
(35, 4, '', '', ''),
(36, 0, '', '', ''),
(36, 1, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D', '', ''),
(36, 2, '', '', ''),
(36, 3, '', '', ''),
(36, 4, '', '', ''),
(37, 0, '', '', ''),
(37, 1, '', '', ''),
(37, 2, '', '', ''),
(37, 3, '', '', ''),
(37, 4, '', '', ''),
(38, 0, '', '', ''),
(38, 1, '', '', ''),
(38, 2, '', '', ''),
(38, 3, '', '', ''),
(38, 4, '', '', ''),
(39, 0, '', '', ''),
(39, 1, '', '', ''),
(39, 2, '', '', ''),
(39, 3, '', '', ''),
(39, 4, '', '', ''),
(40, 4, '', '', ''),
(40, 3, '', '', ''),
(40, 2, '', '', ''),
(40, 1, '', '', ''),
(40, 0, '', '', ''),
(41, 0, '', '', ''),
(41, 1, '', '', ''),
(41, 2, '', '', ''),
(41, 3, '', '', ''),
(41, 4, '', '', ''),
(42, 4, '', '', ''),
(42, 3, '', '', ''),
(42, 2, '', '', ''),
(42, 1, '', '', ''),
(42, 0, '', '', ''),
(43, 0, '', '', ''),
(43, 1, '', '', ''),
(43, 2, '', '', ''),
(43, 3, '', '', ''),
(43, 4, '', '', ''),
(44, 0, '', '', ''),
(44, 1, '', '', ''),
(44, 2, '', '', ''),
(44, 3, '', '', ''),
(44, 4, '', '', ''),
(45, 0, '', '', ''),
(45, 1, '', '', ''),
(45, 2, '', '', ''),
(45, 3, '', '', ''),
(45, 4, '', '', ''),
(46, 0, '', '', ''),
(46, 1, '', '', ''),
(46, 2, '', '', ''),
(46, 3, '', '', ''),
(46, 4, '', '', ''),
(47, 4, '', '', ''),
(47, 3, '', '', ''),
(47, 2, '', '', ''),
(47, 1, '', '', ''),
(47, 0, '', '', ''),
(48, 0, '', '', ''),
(48, 1, '', '', ''),
(48, 2, '', '', ''),
(48, 3, '', '', ''),
(48, 4, '', '', ''),
(49, 0, 'ec_products:num:num:Products_Num:V', 's', '10'),
(49, 1, '', '', ''),
(49, 2, '', '', ''),
(49, 3, '', '', ''),
(49, 4, '', '', ''),
(50, 0, '', '', ''),
(50, 1, '', '', ''),
(50, 2, '', '', ''),
(50, 3, '', '', ''),
(50, 4, '', '', ''),
(51, 0, '', '', ''),
(51, 1, '', '', ''),
(51, 2, '', '', ''),
(51, 3, '', '', ''),
(51, 4, '', '', ''),
(52, 0, '', '', ''),
(52, 1, '', '', ''),
(52, 2, '', '', ''),
(52, 3, '', '', ''),
(52, 4, '', '', ''),
(53, 0, '', '', ''),
(53, 1, '', '', ''),
(53, 2, '', '', ''),
(53, 3, '', '', ''),
(53, 4, '', '', ''),
(54, 4, '', '', ''),
(54, 3, '', '', ''),
(54, 2, '', '', ''),
(54, 1, '', '', ''),
(54, 0, '', '', ''),
(55, 0, '', '', ''),
(55, 1, '', '', ''),
(55, 2, '', '', ''),
(55, 3, '', '', ''),
(55, 4, '', '', ''),
(56, 0, '', '', ''),
(56, 1, '', '', ''),
(56, 2, '', '', ''),
(56, 3, '', '', ''),
(56, 4, '', '', ''),
(57, 3, '', '', ''),
(57, 4, '', '', ''),
(57, 2, '', '', ''),
(57, 1, '', '', ''),
(58, 0, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I', 'e', '健身会员'),
(57, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', '健身会员'),
(58, 1, '', '', ''),
(58, 2, '', '', ''),
(58, 3, '', '', ''),
(58, 4, '', '', ''),
(59, 0, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I', 'e', '健身会员'),
(59, 1, '', '', ''),
(59, 2, '', '', ''),
(59, 3, '', '', ''),
(59, 4, '', '', ''),
(60, 3, '', '', ''),
(61, 0, '', '', ''),
(60, 1, '', '', ''),
(60, 2, '', '', ''),
(60, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 's', 'YX'),
(61, 1, '', '', ''),
(61, 2, '', '', ''),
(61, 3, '', '', ''),
(61, 4, '', '', ''),
(64, 1, '', '', ''),
(64, 2, '', '', ''),
(64, 0, '', '', ''),
(63, 0, '', '', ''),
(63, 1, '', '', ''),
(63, 2, '', '', ''),
(63, 3, '', '', ''),
(63, 4, '', '', ''),
(60, 4, '', '', ''),
(62, 0, '', '', ''),
(62, 1, '', '', ''),
(62, 2, '', '', ''),
(62, 3, '', '', ''),
(62, 4, '', '', ''),
(64, 3, '', '', ''),
(64, 4, '', '', ''),
(65, 0, '', '', ''),
(65, 1, '', '', ''),
(65, 2, '', '', ''),
(65, 3, '', '', ''),
(65, 4, '', '', ''),
(66, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '2'),
(66, 1, '', '', ''),
(66, 2, '', '', ''),
(66, 3, '', '', ''),
(66, 4, '', '', ''),
(67, 0, '', '', ''),
(67, 1, '', '', ''),
(67, 2, '', '', ''),
(67, 3, '', '', ''),
(67, 4, '', '', ''),
(68, 0, '', '', ''),
(68, 1, '', '', ''),
(68, 2, '', '', ''),
(68, 3, '', '', ''),
(68, 4, '', '', ''),
(69, 4, '', '', ''),
(69, 3, '', '', ''),
(69, 2, '', '', ''),
(69, 1, '', '', ''),
(69, 0, '', '', ''),
(70, 4, '', '', ''),
(71, 0, '', '', ''),
(71, 1, '', '', ''),
(70, 3, '', '', ''),
(70, 2, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'c', '江苏'),
(70, 1, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'c', '浙江'),
(70, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'c', '上海'),
(71, 2, '', '', ''),
(71, 3, '', '', ''),
(71, 4, '', '', ''),
(72, 0, '', '', ''),
(72, 1, '', '', ''),
(72, 2, '', '', ''),
(72, 3, '', '', ''),
(72, 4, '', '', ''),
(73, 0, '', '', ''),
(73, 1, '', '', ''),
(73, 2, '', '', ''),
(73, 3, '', '', ''),
(73, 4, '', '', ''),
(74, 0, '', '', ''),
(74, 1, '', '', ''),
(74, 2, '', '', ''),
(74, 3, '', '', ''),
(74, 4, '', '', ''),
(75, 0, '', '', ''),
(75, 1, '', '', ''),
(75, 2, '', '', ''),
(75, 3, '', '', ''),
(75, 4, '', '', ''),
(76, 0, '', '', ''),
(76, 1, '', '', ''),
(76, 2, '', '', ''),
(76, 3, '', '', ''),
(76, 4, '', '', ''),
(77, 0, '', '', ''),
(77, 1, '', '', ''),
(77, 2, '', '', ''),
(77, 3, '', '', ''),
(77, 4, '', '', ''),
(78, 0, '', '', ''),
(78, 1, '', '', ''),
(78, 2, '', '', ''),
(78, 3, '', '', ''),
(78, 4, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ec_cvadvfilterfenzu`
--

CREATE TABLE IF NOT EXISTS `ec_cvadvfilterfenzu` (
  `cvid` int(19) NOT NULL,
  `columnindex` int(11) NOT NULL,
  `columnname` varchar(250) DEFAULT NULL,
  `comparator` varchar(10) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cvid`,`columnindex`),
  KEY `cvid` (`cvid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_cvadvfilterfenzu`
--

INSERT INTO `ec_cvadvfilterfenzu` (`cvid`, `columnindex`, `columnname`, `comparator`, `value`) VALUES
(3, 0, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T', 'g', '1111'),
(3, 1, '', '', ''),
(3, 2, '', '', ''),
(3, 3, '', '', ''),
(3, 4, '', '', ''),
(4, 4, '', '', ''),
(4, 3, '', '', ''),
(4, 2, '', '', ''),
(4, 1, '', '', ''),
(4, 0, '', '', ''),
(7, 0, '', '', ''),
(5, 3, '', '', ''),
(5, 4, '', '', ''),
(5, 2, '', '', ''),
(5, 1, '', '', ''),
(5, 0, '', '', ''),
(7, 3, '', '', ''),
(7, 1, '', '', ''),
(7, 2, '', '', ''),
(6, 2, '', '', ''),
(6, 1, '', '', ''),
(6, 0, '', '', '8-'),
(7, 4, '', '', ''),
(6, 3, '', '', ''),
(6, 4, '', '', ''),
(8, 4, '', '', ''),
(8, 3, '', '', ''),
(8, 2, '', '', ''),
(8, 1, '', '', ''),
(8, 0, '', '', ''),
(9, 0, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V', 'e', '恒毅男女服饰专卖店 '),
(9, 1, '', '', ''),
(9, 2, '', '', ''),
(9, 3, '', '', ''),
(9, 4, '', '', ''),
(10, 0, '', '', ''),
(10, 1, '', '', ''),
(10, 2, '', '', ''),
(10, 3, '', '', ''),
(10, 4, '', '', ''),
(11, 0, 'ec_account:sex:sex:Accounts_Sex:V', 'n', '女'),
(11, 1, '', '', ''),
(11, 2, '', '', ''),
(11, 3, '', '', ''),
(11, 4, '', '', ''),
(112, 0, '', '', ''),
(112, 1, '', '', ''),
(112, 2, '', '', ''),
(112, 3, '', '', ''),
(112, 4, '', '', ''),
(113, 0, '', '', ''),
(113, 1, '', '', ''),
(113, 2, '', '', ''),
(113, 3, '', '', ''),
(113, 4, '', '', ''),
(114, 4, '', '', ''),
(114, 3, '', '', ''),
(114, 2, '', '', ''),
(114, 1, '', '', ''),
(114, 0, '', '', ''),
(115, 0, 'ec_account:oneweeksendmess:oneweeksendmess:Accounts_最近一周发送短信次数:I', 'l', '1'),
(115, 1, '', '', ''),
(115, 2, '', '', ''),
(115, 3, '', '', ''),
(115, 4, '', '', ''),
(116, 0, 'ec_account:oneweeksendmail:oneweeksendmail:Accounts_最近一周发送邮件次数:I', 'l', '1'),
(116, 1, '', '', ''),
(116, 2, '', '', ''),
(116, 3, '', '', ''),
(116, 4, '', '', ''),
(117, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', '程亮'),
(117, 1, '', '', ''),
(117, 2, '', '', ''),
(117, 3, '', '', ''),
(117, 4, '', '', ''),
(118, 0, '', '', ''),
(118, 1, '', '', ''),
(118, 2, '', '', ''),
(118, 3, '', '', ''),
(118, 4, '', '', ''),
(119, 0, '', '', ''),
(119, 1, '', '', ''),
(119, 2, '', '', ''),
(119, 3, '', '', ''),
(119, 4, '', '', ''),
(120, 0, '', '', ''),
(120, 1, '', '', ''),
(120, 2, '', '', ''),
(120, 3, '', '', ''),
(120, 4, '', '', ''),
(121, 4, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'chengzhe1111'),
(124, 0, '', '', ''),
(123, 4, '', '', ''),
(122, 0, '', '', ''),
(122, 1, '', '', ''),
(122, 2, '', '', ''),
(122, 3, '', '', ''),
(122, 4, '', '', ''),
(123, 1, '', '', ''),
(123, 2, '', '', ''),
(123, 3, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V', 'e', 'vip会员4级'),
(121, 3, '', '', ''),
(121, 0, '', '', ''),
(121, 1, '', '', ''),
(121, 2, '', '', ''),
(123, 0, '', '', ''),
(124, 1, '', '', ''),
(124, 2, '', '', ''),
(124, 3, '', '', ''),
(124, 4, '', '', ''),
(125, 0, 'ec_account:tel:tel:Accounts_电话:V', 'n', 'null'),
(125, 1, '', '', ''),
(125, 2, '', '', ''),
(125, 3, '', '', ''),
(125, 4, '', '', ''),
(126, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', ''),
(126, 1, '', '', ''),
(126, 2, '', '', ''),
(126, 3, '', '', ''),
(126, 4, '', '', ''),
(127, 0, '', '', ''),
(127, 1, '', '', ''),
(127, 2, '', '', ''),
(127, 3, '', '', ''),
(127, 4, '', '', ''),
(128, 0, '', '', ''),
(128, 1, '', '', ''),
(128, 2, '', '', ''),
(128, 3, '', '', ''),
(128, 4, '', '', ''),
(129, 0, '', '', ''),
(129, 1, '', '', ''),
(129, 2, '', '', ''),
(129, 3, '', '', ''),
(129, 4, '', '', ''),
(130, 0, '', '', ''),
(130, 1, '', '', ''),
(130, 2, '', '', ''),
(130, 3, '', '', ''),
(130, 4, '', '', ''),
(131, 0, '', '', ''),
(131, 1, '', '', ''),
(131, 2, '', '', ''),
(131, 3, '', '', ''),
(131, 4, '', '', ''),
(132, 0, '', '', ''),
(132, 1, '', '', ''),
(132, 2, '', '', ''),
(132, 3, '', '', ''),
(132, 4, '', '', ''),
(133, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', '胡家斌'),
(134, 0, '', '', ''),
(134, 1, '', '', ''),
(134, 2, '', '', ''),
(134, 3, '', '', ''),
(134, 4, '', '', ''),
(133, 1, '', '', ''),
(133, 2, '', '', ''),
(133, 3, '', '', ''),
(133, 4, '', '', ''),
(135, 0, '', '', ''),
(135, 1, '', '', ''),
(135, 2, '', '', ''),
(135, 3, '', '', ''),
(135, 4, '', '', ''),
(136, 0, '', '', ''),
(136, 1, '', '', ''),
(136, 2, '', '', ''),
(136, 3, '', '', ''),
(136, 4, '', '', ''),
(137, 0, '', '', ''),
(137, 1, '', '', ''),
(137, 2, '', '', ''),
(137, 3, '', '', ''),
(137, 4, '', '', ''),
(138, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', '77083464@qq.com'),
(138, 1, '', '', ''),
(138, 2, '', '', ''),
(138, 3, '', '', ''),
(138, 4, '', '', ''),
(139, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', '77083464@qq.com'),
(139, 1, '', '', ''),
(139, 2, '', '', ''),
(139, 3, '', '', ''),
(139, 4, '', '', ''),
(140, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '风飘去'),
(140, 1, '', '', ''),
(140, 2, '', '', ''),
(140, 3, '', '', ''),
(140, 4, '', '', ''),
(141, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', '77083464@qq.com'),
(141, 1, '', '', ''),
(141, 2, '', '', ''),
(141, 3, '', '', ''),
(141, 4, '', '', ''),
(142, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', '77083464@qq.com'),
(142, 1, '', '', ''),
(142, 2, '', '', ''),
(142, 3, '', '', ''),
(142, 4, '', '', ''),
(143, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', '77083464@qq.com'),
(143, 1, '', '', ''),
(143, 2, '', '', ''),
(143, 3, '', '', ''),
(143, 4, '', '', ''),
(144, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'e', ''),
(144, 1, '', '', ''),
(144, 2, '', '', ''),
(144, 3, '', '', ''),
(144, 4, '', '', ''),
(145, 0, '', '', ''),
(145, 1, '', '', ''),
(145, 2, '', '', ''),
(145, 3, '', '', ''),
(145, 4, '', '', ''),
(146, 0, '', '', ''),
(146, 1, '', '', ''),
(146, 2, '', '', ''),
(146, 3, '', '', ''),
(146, 4, '', '', ''),
(147, 0, '', '', ''),
(147, 1, '', '', ''),
(147, 2, '', '', ''),
(147, 3, '', '', ''),
(147, 4, '', '', ''),
(148, 0, '', '', ''),
(148, 1, '', '', ''),
(148, 2, '', '', ''),
(148, 3, '', '', ''),
(148, 4, '', '', ''),
(149, 1, '', '', ''),
(149, 2, '', '', ''),
(149, 3, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'g', '1'),
(149, 4, '', '', ''),
(150, 0, 'ec_account:email:email:Accounts_Email:E', 'e', ''),
(149, 0, '', '', ''),
(150, 1, '', '', ''),
(150, 2, '', '', ''),
(150, 3, '', '', ''),
(150, 4, '', '', ''),
(151, 0, 'ec_account:threemonthsendmail:threemonthsendmail:Accounts_最近三月发送邮件次数:I', 'e', ''),
(151, 1, '', '', ''),
(151, 2, '', '', ''),
(151, 3, '', '', ''),
(151, 4, '', '', ''),
(152, 1, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V', '', ''),
(152, 0, 'ec_account:email:email:Accounts_Email:E', 'e', ''),
(152, 2, '', '', ''),
(152, 3, '', '', ''),
(152, 4, '', '', ''),
(153, 0, '', '', ''),
(153, 1, '', '', ''),
(153, 2, '', '', ''),
(153, 3, '', '', ''),
(153, 4, '', '', ''),
(154, 0, '', '', ''),
(154, 1, '', '', ''),
(154, 2, '', '', ''),
(154, 3, '', '', ''),
(154, 4, '', '', ''),
(155, 0, '', '', ''),
(155, 1, '', '', ''),
(155, 2, '', '', ''),
(155, 3, '', '', ''),
(155, 4, '', '', ''),
(156, 3, '', '', ''),
(156, 4, '', '', ''),
(156, 1, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(156, 2, 'ec_account:email:email:Accounts_Email:E', 'c', 'shadowj1020'),
(156, 0, 'ec_account:email:email:Accounts_Email:E', 'h', '1'),
(157, 2, '', '', ''),
(157, 1, 'ec_account:email:email:Accounts_Email:E', 'k', 'slsf--shadow'),
(157, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'k', 'shadowj1020'),
(157, 3, '', '', ''),
(157, 4, '', '', ''),
(158, 0, '', '', ''),
(158, 1, '', '', ''),
(158, 2, '', '', ''),
(158, 3, '', '', ''),
(158, 4, '', '', ''),
(159, 0, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'm', '0'),
(159, 1, 'ec_account:email:email:Accounts_Email:E', 'c', '@'),
(159, 2, '', '', ''),
(159, 3, '', '', ''),
(159, 4, '', '', ''),
(160, 4, '', '', ''),
(160, 3, '', '', ''),
(160, 2, '', '', ''),
(160, 1, '', '', ''),
(160, 0, '', '', ''),
(161, 0, '', '', ''),
(161, 1, '', '', ''),
(161, 2, '', '', ''),
(161, 3, '', '', ''),
(161, 4, '', '', ''),
(162, 0, '', '', ''),
(162, 1, '', '', ''),
(162, 2, '', '', ''),
(162, 3, '', '', ''),
(162, 4, '', '', ''),
(163, 0, '', '', ''),
(163, 1, '', '', ''),
(163, 2, '', '', ''),
(163, 3, '', '', ''),
(163, 4, '', '', ''),
(164, 0, '', '', ''),
(164, 1, '', '', ''),
(164, 2, '', '', ''),
(164, 3, '', '', ''),
(164, 4, '', '', ''),
(165, 1, 'ec_account:email:email:Accounts_Email:E', '', ''),
(165, 0, 'ec_account:email:email:Accounts_Email:E', '', 'a,b,c,j,k,w'),
(165, 2, '', '', ''),
(165, 3, '', '', ''),
(165, 4, '', '', ''),
(167, 0, 'ec_account:email:email:Accounts_Email:E', '', ''),
(167, 1, '', '', ''),
(167, 2, '', '', ''),
(167, 3, '', '', ''),
(167, 4, '', '', ''),
(166, 2, 'ec_account:email:email:Accounts_Email:E', 'c', 'u,v,w,x,y,z'),
(166, 1, 'ec_account:email:email:Accounts_Email:E', 'c', 'h,i,j,k,l,m,n,o,p,q,r,s,t'),
(166, 3, 'ec_account:email:email:Accounts_Email:E', 'c', '1,2,3,4,5,6,7'),
(166, 4, 'ec_account:email:email:Accounts_Email:E', 'c', '8,9,0'),
(166, 0, 'ec_account:email:email:Accounts_Email:E', 'c', 'a,b,c,d,e,f,g'),
(168, 0, '', '', ''),
(168, 1, '', '', ''),
(168, 2, '', '', ''),
(168, 3, '', '', ''),
(168, 4, '', '', ''),
(169, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', ''),
(169, 1, '', '', ''),
(169, 2, '', '', ''),
(169, 3, '', '', ''),
(169, 4, '', '', ''),
(170, 0, '', '', ''),
(170, 1, '', '', ''),
(170, 2, '', '', ''),
(170, 3, '', '', ''),
(170, 4, '', '', ''),
(171, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', '许岚'),
(171, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', '李甫健'),
(171, 2, '', '', ''),
(171, 3, '', '', ''),
(171, 4, '', '', ''),
(172, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '许岚'),
(172, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '李甫健'),
(172, 2, '', '', ''),
(172, 3, '', '', ''),
(172, 4, '', '', ''),
(173, 0, '', '', ''),
(173, 1, '', '', ''),
(173, 2, '', '', ''),
(173, 3, '', '', ''),
(173, 4, '', '', ''),
(174, 0, '', '', ''),
(174, 1, '', '', ''),
(174, 2, '', '', ''),
(174, 3, '', '', ''),
(174, 4, '', '', ''),
(175, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '许岚'),
(175, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '李甫健'),
(175, 2, '', '', ''),
(175, 3, '', '', ''),
(175, 4, '', '', ''),
(176, 0, '', '', ''),
(176, 1, '', '', ''),
(176, 2, '', '', ''),
(176, 3, '', '', ''),
(176, 4, '', '', ''),
(177, 0, '', '', ''),
(177, 1, '', '', ''),
(177, 2, '', '', ''),
(177, 3, '', '', ''),
(177, 4, '', '', ''),
(178, 0, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V', '', ''),
(178, 1, '', '', ''),
(178, 2, '', '', ''),
(178, 3, '', '', ''),
(178, 4, '', '', ''),
(179, 0, '', '', ''),
(179, 1, '', '', ''),
(179, 2, '', '', ''),
(179, 3, '', '', ''),
(179, 4, '', '', ''),
(180, 0, '', '', ''),
(180, 1, '', '', ''),
(180, 2, '', '', ''),
(180, 3, '', '', ''),
(180, 4, '', '', ''),
(181, 0, '', '', ''),
(181, 1, '', '', ''),
(181, 2, '', '', ''),
(181, 3, '', '', ''),
(181, 4, '', '', ''),
(182, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(182, 1, '', '', ''),
(182, 2, '', '', ''),
(182, 3, '', '', ''),
(182, 4, '', '', ''),
(183, 0, '', '', ''),
(183, 1, '', '', ''),
(183, 2, '', '', ''),
(183, 3, '', '', ''),
(183, 4, '', '', ''),
(184, 0, '', '', ''),
(184, 1, '', '', ''),
(184, 2, '', '', ''),
(184, 3, '', '', ''),
(184, 4, '', '', ''),
(185, 0, '', '', ''),
(185, 1, '', '', ''),
(185, 2, '', '', ''),
(185, 3, '', '', ''),
(185, 4, '', '', ''),
(186, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', '', ''),
(186, 1, '', '', ''),
(186, 2, '', '', ''),
(186, 3, '', '', ''),
(186, 4, '', '', ''),
(187, 0, '', '', ''),
(187, 1, '', '', ''),
(187, 2, '', '', ''),
(187, 3, '', '', ''),
(187, 4, '', '', ''),
(188, 0, '', '', ''),
(188, 1, '', '', ''),
(188, 2, '', '', ''),
(188, 3, '', '', ''),
(188, 4, '', '', ''),
(189, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'e', ''),
(189, 1, '', '', ''),
(189, 2, '', '', ''),
(189, 3, '', '', ''),
(189, 4, '', '', ''),
(190, 0, '', '', ''),
(190, 1, '', '', ''),
(190, 2, '', '', ''),
(190, 3, '', '', ''),
(190, 4, '', '', ''),
(191, 0, 'ec_account:phone:phone:Accounts_Phone:V', 'e', ''),
(191, 1, '', '', ''),
(191, 2, '', '', ''),
(191, 3, '', '', ''),
(191, 4, '', '', ''),
(192, 0, '', '', ''),
(192, 1, '', '', ''),
(192, 2, '', '', ''),
(192, 3, '', '', ''),
(192, 4, '', '', ''),
(193, 0, '', '', ''),
(193, 1, '', '', ''),
(193, 2, '', '', ''),
(193, 3, '', '', ''),
(193, 4, '', '', ''),
(194, 0, '', '', ''),
(194, 1, '', '', ''),
(194, 2, '', '', ''),
(194, 3, '', '', ''),
(194, 4, '', '', ''),
(195, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', ''),
(195, 1, '', '', ''),
(195, 2, '', '', ''),
(195, 3, '', '', ''),
(195, 4, '', '', ''),
(196, 0, '', '', ''),
(196, 1, '', '', ''),
(196, 2, '', '', ''),
(196, 3, '', '', ''),
(196, 4, '', '', ''),
(197, 0, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V', 'c', '@'),
(198, 0, '', '', ''),
(198, 1, '', '', ''),
(198, 2, '', '', ''),
(198, 3, '', '', ''),
(198, 4, '', '', ''),
(199, 0, '', '', ''),
(199, 1, '', '', ''),
(199, 2, '', '', ''),
(199, 3, '', '', ''),
(199, 4, '', '', ''),
(200, 0, '', '', ''),
(200, 1, '', '', ''),
(200, 2, '', '', ''),
(200, 3, '', '', ''),
(200, 4, '', '', ''),
(197, 1, '', '', ''),
(197, 2, '', '', ''),
(197, 3, '', '', ''),
(197, 4, '', '', ''),
(201, 0, 'ec_account:email:email:Accounts_Email:E', '', ''),
(201, 1, '', '', ''),
(201, 2, '', '', ''),
(201, 3, '', '', ''),
(201, 4, '', '', ''),
(202, 0, '', '', ''),
(202, 1, '', '', ''),
(202, 2, '', '', ''),
(202, 3, '', '', ''),
(202, 4, '', '', ''),
(203, 0, '', '', ''),
(203, 1, '', '', ''),
(203, 2, '', '', ''),
(203, 3, '', '', ''),
(203, 4, '', '', ''),
(204, 0, '', '', ''),
(204, 1, '', '', ''),
(204, 2, '', '', ''),
(204, 3, '', '', ''),
(204, 4, '', '', ''),
(205, 0, '', '', ''),
(205, 1, '', '', ''),
(205, 2, '', '', ''),
(205, 3, '', '', ''),
(205, 4, '', '', ''),
(206, 0, '', '', ''),
(206, 1, '', '', ''),
(206, 2, '', '', ''),
(206, 3, '', '', ''),
(206, 4, '', '', ''),
(207, 0, '', '', ''),
(207, 1, '', '', ''),
(207, 2, '', '', ''),
(207, 3, '', '', ''),
(207, 4, '', '', ''),
(208, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'g', '1'),
(208, 1, '', '', ''),
(208, 2, '', '', ''),
(208, 3, '', '', ''),
(208, 4, '', '', ''),
(209, 0, '', '', ''),
(209, 1, '', '', ''),
(209, 2, '', '', ''),
(209, 3, '', '', ''),
(209, 4, '', '', ''),
(210, 0, '', '', ''),
(210, 1, '', '', ''),
(210, 2, '', '', ''),
(210, 3, '', '', ''),
(210, 4, '', '', ''),
(211, 0, 'ec_account:email:email:Accounts_Email:E', '', ''),
(211, 1, '', '', ''),
(211, 2, '', '', ''),
(211, 3, '', '', ''),
(211, 4, '', '', ''),
(212, 0, 'ec_account:threemonthsendmail:threemonthsendmail:Accounts_最近三月发送邮件次数:I', 'l', '1'),
(212, 1, '', '', ''),
(212, 2, '', '', ''),
(212, 3, '', '', ''),
(212, 4, '', '', ''),
(213, 0, '', '', ''),
(213, 1, '', '', ''),
(213, 2, '', '', ''),
(213, 3, '', '', ''),
(213, 4, '', '', ''),
(214, 4, '', '', ''),
(214, 3, '', '', ''),
(214, 2, '', '', ''),
(215, 0, '', '', ''),
(215, 1, '', '', ''),
(215, 2, '', '', ''),
(215, 3, '', '', ''),
(215, 4, '', '', ''),
(214, 1, '', '', ''),
(214, 0, '', '', ''),
(216, 0, '', '', ''),
(216, 1, '', '', ''),
(216, 2, '', '', ''),
(216, 3, '', '', ''),
(216, 4, '', '', ''),
(217, 0, '', '', ''),
(217, 1, '', '', ''),
(217, 2, '', '', ''),
(217, 3, '', '', ''),
(217, 4, '', '', ''),
(218, 0, '', '', ''),
(218, 1, '', '', ''),
(218, 2, '', '', ''),
(218, 3, '', '', ''),
(218, 4, '', '', ''),
(219, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', ''),
(219, 1, '', '', ''),
(219, 2, '', '', ''),
(219, 3, '', '', ''),
(219, 4, '', '', ''),
(220, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'm', '1'),
(220, 1, '', '', ''),
(220, 2, '', '', ''),
(220, 3, '', '', ''),
(220, 4, '', '', ''),
(221, 1, 'ec_account:onemonthbuy:onemonthbuy:Accounts_最近一月购买次数:I', 'h', '1'),
(221, 2, '', '', ''),
(221, 0, 'ec_account:threemonthbuy:threemonthbuy:Accounts_最近三月购买次数:I', 'm', '1'),
(221, 3, '', '', ''),
(221, 4, '', '', ''),
(222, 0, '', '', ''),
(222, 1, '', '', ''),
(222, 2, '', '', ''),
(222, 3, '', '', ''),
(222, 4, '', '', ''),
(223, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', '淘淘凡品'),
(223, 1, '', '', ''),
(223, 2, '', '', ''),
(223, 3, '', '', ''),
(223, 4, '', '', ''),
(224, 3, '', '', ''),
(224, 2, '', '', ''),
(224, 1, '', '', ''),
(224, 0, '', '', '淘淘凡品'),
(224, 4, '', '', ''),
(225, 0, '', '', ''),
(225, 1, '', '', ''),
(225, 2, '', '', ''),
(225, 3, '', '', ''),
(225, 4, '', '', ''),
(226, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'c', ''),
(226, 1, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'g', '1'),
(226, 2, '', '', ''),
(226, 3, '', '', ''),
(226, 4, '', '', ''),
(227, 0, '', '', ''),
(227, 1, '', '', ''),
(227, 2, '', '', ''),
(227, 3, '', '', ''),
(227, 4, '', '', ''),
(228, 0, '', '', ''),
(228, 1, '', '', ''),
(228, 2, '', '', ''),
(228, 3, '', '', ''),
(228, 4, '', '', ''),
(229, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(229, 1, '', '', ''),
(229, 2, '', '', ''),
(229, 3, '', '', ''),
(229, 4, '', '', ''),
(230, 4, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(230, 3, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(230, 2, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(230, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(230, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(231, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(231, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(231, 2, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(231, 3, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(231, 4, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(232, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', 'thxy2009'),
(232, 1, '', '', ''),
(232, 2, '', '', ''),
(232, 3, '', '', ''),
(232, 4, '', '', ''),
(233, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', ''),
(233, 1, '', '', ''),
(233, 2, '', '', ''),
(233, 3, '', '', ''),
(233, 4, '', '', ''),
(234, 0, '', '', ''),
(234, 1, '', '', ''),
(234, 2, '', '', ''),
(234, 3, '', '', ''),
(234, 4, '', '', ''),
(235, 0, '', '', ''),
(235, 1, '', '', ''),
(235, 2, '', '', ''),
(235, 3, '', '', ''),
(235, 4, '', '', ''),
(236, 0, '', '', ''),
(236, 1, '', '', ''),
(236, 2, '', '', ''),
(236, 3, '', '', ''),
(236, 4, '', '', ''),
(237, 0, '', '', ''),
(237, 1, '', '', ''),
(237, 2, '', '', ''),
(237, 3, '', '', ''),
(237, 4, '', '', ''),
(238, 4, '', '', ''),
(238, 3, '', '', ''),
(238, 2, '', '', ''),
(238, 1, '', '', ''),
(238, 0, '', '', ''),
(239, 0, '', '', ''),
(239, 1, '', '', ''),
(239, 2, '', '', ''),
(239, 3, '', '', ''),
(239, 4, '', '', ''),
(241, 0, '', '', ''),
(240, 2, '', '', ''),
(240, 3, '', '', ''),
(240, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', '', ''),
(240, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'c', 'asfd'),
(241, 1, '', '', ''),
(241, 2, '', '', ''),
(241, 3, '', '', ''),
(241, 4, '', '', ''),
(242, 1, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'g', '10'),
(242, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(242, 2, 'ec_account:buy_pro_num:buy_pro_num:Accounts_Buy_Pro_Num:I', 'h', '1'),
(242, 3, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '1次'),
(242, 4, '', '', ''),
(240, 4, '', '', ''),
(243, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(243, 1, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'h', '10'),
(243, 2, 'ec_account:buy_pro_num:buy_pro_num:Accounts_Buy_Pro_Num:I', 'h', '1'),
(243, 3, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '1'),
(243, 4, 'ec_account:threemonthbuy:threemonthbuy:Accounts_最近三月购买次数:I', 'h', '1'),
(246, 2, '', '', ''),
(244, 1, '', '', ''),
(244, 2, '', '', ''),
(244, 3, '', '', ''),
(244, 4, '', '', ''),
(245, 0, '', '', ''),
(245, 1, '', '', ''),
(245, 2, '', '', ''),
(245, 3, '', '', ''),
(245, 4, '', '', ''),
(246, 0, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'h', '100'),
(246, 1, '', '', ''),
(244, 0, '', '', ''),
(246, 3, '', '', ''),
(246, 4, '', '', ''),
(247, 0, '', '', ''),
(247, 1, '', '', ''),
(247, 2, '', '', ''),
(247, 3, '', '', ''),
(247, 4, '', '', ''),
(248, 0, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '2'),
(248, 1, '', '', ''),
(248, 2, '', '', ''),
(248, 3, '', '', ''),
(248, 4, '', '', ''),
(249, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', 'szz'),
(249, 1, '', '', ''),
(249, 2, '', '', ''),
(249, 3, '', '', ''),
(249, 4, '', '', ''),
(250, 2, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '4'),
(251, 0, '', '', ''),
(250, 3, '', '', ''),
(250, 4, '', '', ''),
(250, 1, '', '', ''),
(250, 0, '', '', ''),
(251, 1, '', '', ''),
(251, 2, '', '', ''),
(251, 3, '', '', ''),
(251, 4, '', '', ''),
(252, 4, '', '', ''),
(252, 3, '', '', ''),
(252, 2, 'ec_account:phone:phone:Accounts_Phone:V', 'e', '13822929434'),
(252, 1, '', '', ''),
(252, 0, '', '', ''),
(253, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', '2222'),
(253, 1, '', '', ''),
(253, 2, '', '', ''),
(253, 3, '', '', ''),
(253, 4, '', '', ''),
(254, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'e', '2222'),
(254, 1, '', '', ''),
(254, 2, '', '', ''),
(254, 3, '', '', ''),
(254, 4, '', '', ''),
(255, 0, '', '', ''),
(255, 1, '', '', ''),
(255, 2, '', '', ''),
(255, 3, '', '', ''),
(255, 4, '', '', ''),
(256, 0, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'l', '25'),
(256, 1, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'g', '15'),
(256, 2, '', '', ''),
(256, 3, '', '', ''),
(256, 4, '', '', ''),
(257, 0, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'l', '25'),
(257, 1, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'g', '15'),
(257, 2, '', '', ''),
(257, 3, '', '', ''),
(257, 4, '', '', ''),
(258, 0, '', '', ''),
(258, 1, '', '', ''),
(258, 2, '', '', ''),
(258, 3, '', '', ''),
(258, 4, '', '', ''),
(259, 0, '', '', ''),
(259, 1, '', '', ''),
(259, 2, '', '', ''),
(259, 3, '', '', ''),
(259, 4, '', '', ''),
(260, 0, '', '', ''),
(260, 1, '', '', ''),
(260, 2, '', '', ''),
(260, 3, '', '', ''),
(260, 4, '', '', ''),
(261, 0, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V', 'c', ''),
(261, 1, 'ec_account:onemonthbuy:onemonthbuy:Accounts_最近一月购买次数:I', 'e', ''),
(261, 2, '', '', ''),
(261, 3, '', '', ''),
(261, 4, '', '', ''),
(262, 0, '', '', ''),
(262, 1, '', '', ''),
(262, 2, '', '', ''),
(262, 3, '', '', ''),
(262, 4, '', '', ''),
(263, 0, '', '', ''),
(263, 1, '', '', ''),
(263, 2, '', '', ''),
(263, 3, '', '', ''),
(263, 4, '', '', ''),
(264, 4, '', '', ''),
(264, 3, '', '', ''),
(264, 2, '', '', ''),
(264, 1, '', '', ''),
(264, 0, '', '', ''),
(265, 0, '', '', ''),
(265, 1, '', '', ''),
(265, 2, '', '', ''),
(265, 3, '', '', ''),
(265, 4, '', '', ''),
(266, 0, '', '', ''),
(266, 1, '', '', ''),
(266, 2, '', '', ''),
(266, 3, '', '', ''),
(266, 4, '', '', ''),
(267, 0, '', '', ''),
(267, 1, '', '', ''),
(267, 2, '', '', ''),
(267, 3, '', '', ''),
(267, 4, '', '', ''),
(268, 0, 'ec_account:oneweeksendmail:oneweeksendmail:Accounts_最近5天发送邮件次数:I', '', ''),
(268, 1, '', '', ''),
(268, 2, '', '', ''),
(268, 3, '', '', ''),
(268, 4, '', '', ''),
(269, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', ''),
(269, 1, 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I', 'e', '2'),
(269, 2, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', 'h', '1'),
(269, 3, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '1'),
(269, 4, 'ec_account:oneweeksendmail:oneweeksendmail:Accounts_最近5天发送邮件次数:I', 'e', ''),
(270, 0, '', '', ''),
(270, 1, '', '', ''),
(270, 2, '', '', ''),
(270, 3, '', '', ''),
(270, 4, '', '', ''),
(271, 0, '', '', ''),
(271, 1, '', '', ''),
(271, 2, '', '', ''),
(271, 3, '', '', ''),
(271, 4, '', '', ''),
(272, 0, '', '', ''),
(272, 1, '', '', ''),
(272, 2, '', '', ''),
(272, 3, '', '', ''),
(272, 4, '', '', ''),
(273, 4, '', '', ''),
(273, 3, '', '', ''),
(273, 2, '', '', ''),
(273, 1, '', '', ''),
(273, 0, '', '', ''),
(274, 0, '', '', ''),
(274, 1, '', '', ''),
(274, 2, '', '', ''),
(274, 3, '', '', ''),
(274, 4, '', '', ''),
(275, 0, '', '', ''),
(275, 1, '', '', ''),
(275, 2, '', '', ''),
(275, 3, '', '', ''),
(275, 4, '', '', ''),
(276, 0, '', '', ''),
(276, 1, '', '', ''),
(276, 2, '', '', ''),
(276, 3, '', '', ''),
(276, 4, '', '', ''),
(277, 0, '', '', ''),
(277, 1, '', '', ''),
(277, 2, '', '', ''),
(277, 3, '', '', ''),
(277, 4, '', '', ''),
(278, 0, '', '', ''),
(278, 1, '', '', ''),
(278, 2, '', '', ''),
(278, 3, '', '', ''),
(278, 4, '', '', ''),
(279, 0, '', '', ''),
(279, 1, '', '', ''),
(279, 2, '', '', ''),
(279, 3, '', '', ''),
(279, 4, '', '', ''),
(280, 0, '', '', ''),
(280, 1, '', '', ''),
(280, 2, '', '', ''),
(280, 3, '', '', ''),
(280, 4, '', '', ''),
(281, 0, '', '', ''),
(281, 1, '', '', ''),
(281, 2, '', '', ''),
(281, 3, '', '', ''),
(281, 4, '', '', ''),
(282, 0, '', '', ''),
(282, 1, '', '', ''),
(282, 2, '', '', ''),
(282, 3, '', '', ''),
(282, 4, '', '', ''),
(283, 0, '', '', ''),
(283, 1, '', '', ''),
(283, 2, '', '', ''),
(283, 3, '', '', ''),
(283, 4, '', '', ''),
(284, 0, '', '', ''),
(284, 1, '', '', ''),
(284, 2, '', '', ''),
(284, 3, '', '', ''),
(284, 4, '', '', ''),
(285, 0, '', '', ''),
(285, 1, '', '', ''),
(285, 2, '', '', ''),
(285, 3, '', '', ''),
(285, 4, '', '', ''),
(286, 0, '', '', ''),
(286, 1, '', '', ''),
(286, 2, '', '', ''),
(286, 3, '', '', ''),
(286, 4, '', '', ''),
(287, 0, '', '', ''),
(287, 1, '', '', ''),
(287, 2, '', '', ''),
(287, 3, '', '', ''),
(287, 4, '', '', ''),
(288, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', '', ''),
(288, 1, 'ec_account:phone:phone:Accounts_Phone:V', '', ''),
(288, 2, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I', '', ''),
(288, 3, '', '', ''),
(288, 4, '', '', ''),
(289, 0, '', '', ''),
(289, 1, '', '', ''),
(289, 2, '', '', ''),
(289, 3, '', '', ''),
(289, 4, '', '', ''),
(290, 0, '', '', ''),
(290, 1, '', '', ''),
(290, 2, '', '', ''),
(290, 3, '', '', ''),
(290, 4, '', '', ''),
(291, 0, 'ec_account:email:email:Accounts_Email:E', 'g', '0'),
(291, 1, '', '', ''),
(291, 2, '', '', ''),
(291, 3, '', '', ''),
(291, 4, '', '', ''),
(292, 1, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'e', '新疆'),
(292, 2, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'e', '山东'),
(292, 3, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'e', '河北'),
(292, 4, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'e', '内蒙古'),
(292, 0, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V', 'n', '0'),
(293, 0, 'ec_account:threemonthbuy:threemonthbuy:Accounts_最近三月购买次数:I', '', ''),
(293, 1, '', '', ''),
(293, 2, '', '', ''),
(293, 3, '', '', ''),
(293, 4, '', '', ''),
(294, 0, '', '', ''),
(294, 1, '', '', ''),
(294, 2, '', '', ''),
(294, 3, '', '', ''),
(294, 4, '', '', ''),
(295, 0, '', '', ''),
(295, 1, '', '', ''),
(295, 2, '', '', ''),
(295, 3, '', '', ''),
(295, 4, '', '', ''),
(296, 0, '', '', ''),
(296, 1, '', '', ''),
(296, 2, '', '', ''),
(296, 3, '', '', ''),
(296, 4, '', '', ''),
(297, 0, '', '', ''),
(297, 1, '', '', ''),
(297, 2, '', '', ''),
(297, 3, '', '', ''),
(297, 4, '', '', ''),
(298, 0, '', '', ''),
(298, 1, '', '', ''),
(298, 2, '', '', ''),
(298, 3, '', '', ''),
(298, 4, '', '', ''),
(299, 1, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N', 'h', '150'),
(299, 0, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I', 'h', '3'),
(299, 2, '', '', ''),
(299, 3, '', '', ''),
(299, 4, '', '', ''),
(300, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', 'e', '北京，上海，浙江，江苏，广东，福建'),
(300, 1, '', '', ''),
(300, 2, '', '', ''),
(300, 3, '', '', ''),
(300, 4, '', '', ''),
(301, 4, '', '', ''),
(301, 3, '', '', ''),
(301, 2, '', '', ''),
(301, 1, '', '', ''),
(301, 0, '', '', ''),
(302, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'n', '272230964@qq.com'),
(303, 0, '', '', ''),
(303, 1, '', '', ''),
(303, 2, '', '', ''),
(303, 3, '', '', ''),
(303, 4, '', '', ''),
(304, 4, '', '', ''),
(304, 3, '', '', ''),
(304, 2, '', '', ''),
(304, 1, '', '', ''),
(304, 0, '', '', ''),
(305, 0, 'ec_account:email:email:Accounts_Email:E', 'e', '272230964@qq.com'),
(305, 1, '', '', ''),
(305, 2, '', '', ''),
(305, 3, '', '', ''),
(305, 4, '', '', ''),
(306, 0, '', '', ''),
(306, 1, '', '', ''),
(306, 2, '', '', ''),
(306, 3, '', '', ''),
(306, 4, '', '', ''),
(302, 1, '', '', ''),
(302, 2, '', '', ''),
(302, 3, '', '', ''),
(302, 4, '', '', ''),
(307, 0, '', '', ''),
(307, 1, '', '', ''),
(307, 2, '', '', ''),
(307, 3, '', '', ''),
(307, 4, '', '', ''),
(308, 0, '', '', ''),
(308, 1, '', '', ''),
(308, 2, '', '', ''),
(308, 3, '', '', ''),
(308, 4, '', '', ''),
(309, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'n', '官人'),
(309, 1, '', '', ''),
(309, 2, '', '', ''),
(309, 3, '', '', ''),
(309, 4, '', '', ''),
(310, 0, '', '', ''),
(310, 1, '', '', ''),
(310, 2, '', '', ''),
(310, 3, '', '', ''),
(310, 4, '', '', ''),
(311, 1, '', '', ''),
(311, 2, '', '', ''),
(311, 3, 'ec_account:oneweeksendmail:oneweeksendmail:Accounts_最近5天发送邮件次数:I', 'e', '0'),
(311, 4, '', '', ''),
(312, 0, '', '', ''),
(311, 0, '', '', ''),
(312, 1, '', '', ''),
(312, 2, '', '', ''),
(312, 3, '', '', ''),
(312, 4, '', '', ''),
(313, 0, '', '', ''),
(313, 1, '', '', ''),
(313, 2, '', '', ''),
(313, 3, '', '', ''),
(313, 4, '', '', ''),
(314, 0, '', '', ''),
(314, 1, '', '', ''),
(314, 2, '', '', ''),
(314, 3, '', '', ''),
(314, 4, '', '', ''),
(315, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', '', ''),
(315, 1, '', '', ''),
(315, 2, '', '', ''),
(315, 3, '', '', ''),
(315, 4, '', '', ''),
(316, 0, '', '', ''),
(316, 1, '', '', ''),
(316, 2, '', '', ''),
(316, 3, '', '', ''),
(316, 4, '', '', ''),
(317, 0, 'ec_account:email:email:Accounts_Email:E', '', ''),
(317, 1, '', '', ''),
(317, 2, '', '', ''),
(317, 3, '', '', ''),
(317, 4, '', '', ''),
(318, 1, '', '', ''),
(318, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', 'tang_yunpeng@yeah.net'),
(318, 2, '', '', ''),
(318, 3, '', '', ''),
(318, 4, '', '', ''),
(319, 4, '', '', ''),
(319, 3, '', '', ''),
(319, 2, '', '', ''),
(319, 1, '', '', ''),
(319, 0, '', '', ''),
(320, 0, '', '', ''),
(320, 1, '', '', ''),
(320, 2, '', '', ''),
(320, 3, '', '', ''),
(320, 4, '', '', ''),
(321, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', '', ''),
(321, 1, '', '', ''),
(321, 2, '', '', ''),
(321, 3, '', '', ''),
(321, 4, '', '', ''),
(322, 0, '', '', ''),
(322, 1, '', '', ''),
(322, 2, '', '', ''),
(322, 3, '', '', ''),
(322, 4, '', '', ''),
(323, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V', '', ''),
(323, 1, '', '', ''),
(323, 2, '', '', ''),
(323, 3, '', '', ''),
(323, 4, '', '', ''),
(324, 0, 'ec_account:oneweeksendmail:oneweeksendmail:Accounts_最近5天发送邮件次数:I', '', ''),
(324, 1, '', '', ''),
(324, 2, '', '', ''),
(324, 3, '', '', ''),
(324, 4, '', '', ''),
(325, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V', 'c', 'a'),
(325, 1, '', '', ''),
(325, 2, '', '', ''),
(325, 3, '', '', ''),
(325, 4, '', '', ''),
(326, 0, '', '', ''),
(326, 1, '', '', ''),
(326, 2, '', '', ''),
(326, 3, '', '', ''),
(326, 4, '', '', ''),
(327, 0, '', '', ''),
(327, 1, '', '', ''),
(327, 2, '', '', ''),
(327, 3, '', '', ''),
(327, 4, '', '', ''),
(328, 0, '', '', ''),
(328, 1, '', '', ''),
(328, 2, '', '', ''),
(328, 3, '', '', ''),
(328, 4, '', '', ''),
(329, 0, '', '', ''),
(329, 1, '', '', ''),
(329, 2, '', '', ''),
(329, 3, '', '', ''),
(329, 4, '', '', ''),
(330, 0, '', '', ''),
(330, 1, '', '', ''),
(330, 2, '', '', ''),
(331, 0, '', '', ''),
(331, 1, '', '', ''),
(331, 2, '', '', ''),
(331, 3, '', '', ''),
(331, 4, '', '', ''),
(330, 3, '', '', ''),
(330, 4, '', '', ''),
(332, 4, '', '', ''),
(332, 3, '', '', ''),
(332, 2, '', '', ''),
(332, 1, '', '', ''),
(332, 0, '', '', ''),
(333, 0, '', '', ''),
(333, 1, '', '', ''),
(333, 2, '', '', ''),
(333, 3, '', '', ''),
(333, 4, '', '', ''),
(334, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V', 'e', ''),
(334, 1, '', '', ''),
(334, 2, '', '', ''),
(334, 3, '', '', ''),
(334, 4, '', '', ''),
(335, 0, '', '', ''),
(335, 1, '', '', ''),
(335, 2, '', '', ''),
(335, 3, '', '', ''),
(335, 4, '', '', ''),
(336, 4, '', '', ''),
(336, 3, '', '', ''),
(336, 2, '', '', ''),
(336, 1, '', '', ''),
(336, 0, '', '', ''),
(337, 0, '', '', ''),
(337, 1, '', '', ''),
(337, 2, '', '', ''),
(337, 3, '', '', ''),
(337, 4, '', '', ''),
(338, 0, '', '', ''),
(338, 1, '', '', ''),
(338, 2, '', '', ''),
(338, 3, '', '', ''),
(338, 4, '', '', ''),
(339, 0, '', '', ''),
(339, 1, '', '', ''),
(339, 2, '', '', ''),
(339, 3, '', '', ''),
(339, 4, '', '', ''),
(340, 0, '', '', ''),
(340, 1, '', '', ''),
(340, 2, '', '', ''),
(340, 3, '', '', ''),
(340, 4, '', '', ''),
(341, 0, '', '', ''),
(341, 1, '', '', ''),
(341, 2, '', '', ''),
(341, 3, '', '', ''),
(341, 4, '', '', ''),
(342, 0, '', '', ''),
(342, 1, '', '', ''),
(342, 2, '', '', ''),
(342, 3, '', '', ''),
(342, 4, '', '', ''),
(343, 0, '', '', ''),
(343, 1, '', '', ''),
(343, 2, '', '', ''),
(343, 3, '', '', ''),
(343, 4, '', '', ''),
(344, 0, '', '', ''),
(344, 1, '', '', ''),
(344, 2, '', '', ''),
(344, 3, '', '', ''),
(344, 4, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ec_cvcolumnlist`
--

CREATE TABLE IF NOT EXISTS `ec_cvcolumnlist` (
  `cvid` int(19) NOT NULL,
  `columnindex` int(11) NOT NULL,
  `columnname` varchar(250) DEFAULT '',
  PRIMARY KEY (`cvid`,`columnindex`),
  KEY `cvcolumnlist_columnindex_idx` (`columnindex`),
  KEY `cvcolumnlist_cvid_idx` (`cvid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_cvcolumnlist`
--

INSERT INTO `ec_cvcolumnlist` (`cvid`, `columnindex`, `columnname`) VALUES
(1, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(1, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(1, 7, 'ec_account:threemonthbuy:threemonthbuy:Accounts_最近三月购买次数:I'),
(2, 3, 'ec_notes:contact_date:contact_date:Notes_Contact_Date:D'),
(2, 2, 'ec_notes:notetype:notetype:Notes_Note_Type:V'),
(2, 1, 'ec_notes:accountid:account_id:Notes_Account_Name:V'),
(2, 0, 'ec_notes:title:notes_title:Notes_Note_Title:V'),
(3, 7, 'ec_products:createdtime:createdtime:Products_Created_Time:T'),
(3, 5, ''),
(3, 6, ''),
(3, 4, 'ec_products:num_iid:num_iid:Products_Num_Iid:V'),
(3, 3, ''),
(4, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(4, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(4, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(4, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(4, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(4, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(4, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(1, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(5, 0, 'ec_qunfas:qunfaname:qunfaname:Qunfas_Qunfa_Name:V'),
(5, 1, 'ec_qunfas:smownerid:assigned_user_id:Qunfas_Assigned_To:V'),
(5, 2, ''),
(5, 3, ''),
(5, 4, ''),
(5, 5, ''),
(5, 6, ''),
(5, 7, ''),
(5, 8, ''),
(6, 0, 'ec_maillists:maillistname:maillistname:Maillists_Maillist_Name:V'),
(6, 1, 'ec_maillists:smownerid:assigned_user_id:Maillists_Assigned_To:V'),
(6, 2, ''),
(6, 3, ''),
(6, 4, ''),
(6, 5, ''),
(6, 6, ''),
(6, 7, ''),
(6, 8, ''),
(7, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(7, 1, 'ec_account:smcreatorid:smcreatorid:Accounts_smcreator:V'),
(7, 2, 'ec_account:smownerid:assigned_user_id:Accounts_Assigned_To:V'),
(7, 3, ''),
(7, 4, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T'),
(7, 5, ''),
(7, 6, ''),
(7, 7, ''),
(7, 8, ''),
(8, 1, 'ec_qunfatmps:description:description:Qunfatmps_Description:V'),
(8, 2, 'ec_qunfatmps:smcreatorid:smcreatorid:Qunfatmps_smcreator:V'),
(8, 3, 'ec_qunfatmps:createdtime:createdtime:Qunfatmps_Created_Time:T'),
(8, 0, 'ec_qunfatmps:qunfatmpname:qunfatmpname:Qunfatmps_Qunfatmp_Name:V'),
(8, 4, ''),
(8, 5, ''),
(8, 6, ''),
(8, 7, ''),
(8, 8, ''),
(9, 4, 'ec_maillisttmps:modifiedtime:modifiedtime:Maillisttmps_Modified_Time:T'),
(9, 2, ''),
(9, 3, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time:T'),
(9, 1, 'ec_maillisttmps:description:description:Maillisttmps_Description:V'),
(9, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(1, 5, 'ec_account:oneweekbuy:oneweekbuy:Accounts_最近一周购买次数:I'),
(10, 0, 'ec_relsettings:relsettingname:relsettingname:Relsettings_Relsetting_Name:V'),
(10, 1, 'ec_relsettings:smownerid:assigned_user_id:Relsettings_Assigned_To:V'),
(10, 2, ''),
(10, 3, ''),
(10, 4, ''),
(10, 5, ''),
(10, 6, ''),
(10, 7, ''),
(10, 8, ''),
(3, 2, 'ec_products:price:price:Products_Price:N'),
(11, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(11, 3, 'ec_account:email:email:Accounts_Email:E'),
(11, 4, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I'),
(11, 5, 'ec_account:oneweekbuy:oneweekbuy:Accounts_最近一周购买次数:I'),
(11, 6, 'ec_account:onemonthbuy:onemonthbuy:Accounts_最近一月购买次数:I'),
(18, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(12, 6, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(12, 5, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(12, 4, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(12, 3, 'ec_account:email:email:Accounts_Email:E'),
(12, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(12, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(13, 6, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I'),
(13, 5, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(13, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(13, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(13, 3, 'ec_account:email:email:Accounts_Email:E'),
(14, 3, 'ec_account:email:email:Accounts_Email:E'),
(14, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(14, 5, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I'),
(14, 6, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(14, 7, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(15, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(15, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(15, 3, 'ec_account:email:email:Accounts_Email:E'),
(15, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(15, 5, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I'),
(15, 6, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(15, 7, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(15, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(14, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(14, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(16, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(16, 3, 'ec_account:email:email:Accounts_Email:E'),
(16, 4, 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I'),
(16, 5, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(16, 6, 'ec_account:threemonthsendmail:threemonthsendmail:Accounts_最近三月发送邮件次数:I'),
(17, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(17, 1, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V'),
(17, 2, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(17, 3, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T'),
(17, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(17, 5, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(17, 6, 'ec_account:buy_pro_num:buy_pro_num:Accounts_Buy_Pro_Num:I'),
(17, 7, 'ec_account:phone:phone:Accounts_Phone:V'),
(17, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(1, 3, 'ec_account:email:email:Accounts_Email:E'),
(1, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(12, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(13, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(13, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(14, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(16, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(16, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(2, 4, ''),
(2, 5, ''),
(2, 6, ''),
(2, 7, ''),
(2, 8, ''),
(4, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(1, 6, 'ec_account:onemonthbuy:onemonthbuy:Accounts_最近一月购买次数:I'),
(11, 7, 'ec_account:threemonthbuy:threemonthbuy:Accounts_最近三月购买次数:I'),
(11, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(11, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(16, 7, 'ec_account:threemonthsendmess:threemonthsendmess:Accounts_最近三月发送短信次数:I'),
(15, 0, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(3, 1, 'ec_products:productcode:productcode:Products_Product_Code:V'),
(18, 1, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V'),
(18, 2, ''),
(18, 3, ''),
(18, 4, ''),
(18, 5, ''),
(18, 6, ''),
(18, 7, ''),
(18, 8, ''),
(19, 2, ''),
(19, 3, ''),
(19, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(19, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(19, 4, ''),
(19, 5, ''),
(19, 6, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V'),
(19, 7, ''),
(19, 8, ''),
(20, 2, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(20, 1, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V'),
(20, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(20, 3, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(20, 4, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(20, 5, ''),
(20, 6, ''),
(20, 7, ''),
(20, 8, ''),
(21, 2, ''),
(21, 3, 'ec_qunfatmps:smcreatorid:smcreatorid:Qunfatmps_smcreator:V'),
(21, 1, 'ec_qunfatmps:createdtime:createdtime:Qunfatmps_Created_Time:T'),
(21, 0, 'ec_qunfatmps:qunfatmpname:qunfatmpname:Qunfatmps_Qunfatmp_Name:V'),
(21, 4, ''),
(21, 5, ''),
(21, 6, ''),
(21, 7, ''),
(21, 8, ''),
(1, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(11, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(12, 7, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T'),
(12, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(13, 7, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(14, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(16, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(4, 8, 'ec_salesorder:consign_time:consign_time:SalesOrder_Consign_Time:V'),
(22, 6, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(22, 5, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(22, 4, 'ec_salesorder:shipping_type:shipping_type:SalesOrder_Shipping_Type:V'),
(22, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(22, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(22, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(22, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(22, 7, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(22, 8, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(23, 6, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(23, 5, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(23, 4, 'ec_salesorder:shipping_type:shipping_type:SalesOrder_Shipping_Type:V'),
(23, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(23, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(23, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(23, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(23, 7, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(23, 8, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(24, 7, 'ec_account:phone:phone:Accounts_Phone:V'),
(24, 5, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(24, 6, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(24, 4, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(24, 3, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(24, 2, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(24, 1, 'ec_account:belongshop:belongshop:Accounts_Belongshop:V'),
(24, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(24, 8, 'ec_account:email:email:Accounts_Email:E'),
(25, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(25, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(25, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(25, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(25, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(25, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(25, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(25, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(25, 8, 'ec_salesorder:shipping_type:shipping_type:SalesOrder_Shipping_Type:V'),
(26, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(26, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(26, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(26, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(26, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(26, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(26, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(26, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(26, 8, 'ec_salesorder:shipping_type:shipping_type:SalesOrder_Shipping_Type:V'),
(27, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(27, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(27, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(27, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(27, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(27, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(27, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(27, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(27, 8, 'ec_salesorder:seller_rate:seller_rate:SalesOrder_Seller_Rate:V'),
(28, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(28, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(28, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(28, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(28, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(28, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(28, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(28, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(28, 8, 'ec_salesorder:buyer_message:buyer_message:SalesOrder_Buyer_Message:V'),
(29, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(29, 1, 'ec_salesorder:oid:oid:SalesOrder_Oid:V'),
(29, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(29, 3, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(29, 4, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(29, 5, 'ec_salesorder:postage:postage:SalesOrder_Postage:V'),
(29, 6, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(29, 7, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(29, 8, 'ec_salesorder:buyer_message:buyer_message:SalesOrder_Buyer_Message:V'),
(30, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(30, 1, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(30, 2, 'ec_salesorder:smownerid:assigned_user_id:SalesOrder_Assigned_To:V'),
(30, 3, 'ec_salesorder:smcreatorid:smcreatorid:SalesOrder_smcreator:V'),
(30, 4, ''),
(30, 5, ''),
(30, 6, ''),
(30, 7, 'ec_salesorder:receiver_state:receiver_state:SalesOrder_Receiver_State:V'),
(30, 8, ''),
(31, 0, 'ec_sfadesktops:sfadesktopname:sfadesktopname:SfaDesktops_SfaDesktop_Name:V'),
(31, 1, 'ec_sfadesktops:smownerid:assigned_user_id:SfaDesktops_Assigned_To:V'),
(31, 2, ''),
(31, 3, ''),
(31, 4, ''),
(31, 5, ''),
(31, 6, ''),
(31, 7, ''),
(31, 8, ''),
(32, 0, 'ec_sfalists:sfalistname:sfalistname:Sfalists_Sfalist_Name:V'),
(32, 1, 'ec_sfalists:smownerid:assigned_user_id:Sfalists_Assigned_To:V'),
(32, 2, ''),
(32, 3, ''),
(32, 4, ''),
(32, 5, ''),
(32, 6, ''),
(32, 7, ''),
(32, 8, ''),
(33, 0, 'ec_sfalogs:sfalogname:sfalogname:Sfalogs_Sfalog_Name:V'),
(33, 1, 'ec_sfalogs:smownerid:assigned_user_id:Sfalogs_Assigned_To:V'),
(33, 2, ''),
(33, 3, ''),
(33, 4, ''),
(33, 5, ''),
(33, 6, ''),
(33, 7, ''),
(33, 8, ''),
(34, 0, 'ec_sfasettings:sfasettingname:sfasettingname:Sfasettings_Sfasetting_Name:V'),
(34, 1, 'ec_sfasettings:smownerid:assigned_user_id:Sfasettings_Assigned_To:V'),
(34, 2, ''),
(34, 3, ''),
(34, 4, ''),
(34, 5, ''),
(34, 6, ''),
(34, 7, ''),
(34, 8, ''),
(3, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(9, 5, ''),
(9, 6, ''),
(9, 7, ''),
(9, 8, ''),
(13, 8, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(35, 0, 'ec_notes:title:notes_title:Notes_Note_Title:V'),
(35, 1, 'ec_notes:accountid:account_id:Notes_Account_Name:V'),
(35, 2, 'ec_notes:contact_date:contact_date:Notes_Contact_Date:D'),
(35, 3, ''),
(35, 4, ''),
(35, 5, 'ec_notes:modifiedtime:modifiedtime:Notes_Modified_Time:T'),
(35, 6, ''),
(35, 7, ''),
(35, 8, ''),
(36, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(36, 1, 'ec_account:phone:phone:Accounts_Phone:V'),
(36, 2, ''),
(36, 3, ''),
(36, 4, ''),
(36, 5, ''),
(36, 6, ''),
(36, 7, ''),
(36, 8, ''),
(37, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(37, 1, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(37, 2, 'ec_salesorder:receiver_name:receiver_name:SalesOrder_Receiver_Name:V'),
(37, 3, 'ec_salesorder:receiver_state:receiver_state:SalesOrder_Receiver_State:V'),
(37, 4, 'ec_salesorder:receiver_city:receiver_city:SalesOrder_Receiver_City:V'),
(37, 5, 'ec_salesorder:receiver_district:receiver_district:SalesOrder_Receiver_District:V'),
(37, 6, 'ec_salesorder:receiver_street:receiver_street:SalesOrder_Receiver_Street:V'),
(37, 7, 'ec_salesorder:receiver_code:receiver_code:SalesOrder_Receiver_Code:V'),
(37, 8, 'ec_salesorder:receiver_phone:receiver_phone:SalesOrder_Receiver_Phone:V'),
(38, 2, 'ec_memdays:memday938:memday938:Memdays_纪念日类型:V'),
(38, 1, 'ec_memdays:accountid:account_id:Memdays_Account_Name:V'),
(38, 0, 'ec_memdays:memdayname:memdayname:Memdays_Memday_Name:V'),
(38, 3, 'ec_memdays:memday1004:memday1004:Memdays_日历类型:V'),
(38, 4, 'ec_memdays:memday940:memday940:Memdays_纪念日:V'),
(38, 5, 'ec_memdays:memday946:memday946:Memdays_下次提醒:V'),
(38, 6, ''),
(38, 7, ''),
(38, 8, ''),
(39, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(39, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(39, 2, ''),
(39, 3, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(39, 4, ''),
(39, 5, ''),
(39, 6, ''),
(39, 7, ''),
(39, 8, ''),
(40, 2, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V'),
(40, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(40, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(40, 3, ''),
(40, 4, ''),
(40, 5, ''),
(40, 6, ''),
(40, 7, ''),
(40, 8, ''),
(41, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(41, 1, 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I'),
(41, 2, ''),
(41, 3, ''),
(41, 4, ''),
(41, 5, ''),
(41, 6, ''),
(41, 7, ''),
(41, 8, ''),
(42, 2, ''),
(42, 3, ''),
(42, 1, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(42, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(42, 4, ''),
(42, 5, 'ec_salesorder:wl_no:wl_no:SalesOrder_WL_No:V'),
(42, 6, ''),
(42, 7, ''),
(42, 8, ''),
(43, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(43, 1, ''),
(43, 2, ''),
(43, 3, ''),
(43, 4, ''),
(43, 5, ''),
(43, 6, ''),
(43, 7, ''),
(43, 8, ''),
(44, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(44, 1, ''),
(44, 2, ''),
(44, 3, ''),
(44, 4, ''),
(44, 5, ''),
(44, 6, ''),
(44, 7, ''),
(44, 8, ''),
(45, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(45, 1, 'ec_products:productcode:productcode:Products_Product_Code:V'),
(45, 2, 'ec_products:outer_id:outer_id:Products_商家编码:V'),
(45, 3, 'ec_products:num_iid:num_iid:Products_Num_Iid:V'),
(45, 4, 'ec_products:detail_url:detail_url:Products_Detail_Url:V'),
(45, 5, 'ec_products:price:price:Products_Price:N'),
(45, 6, 'ec_products:num:num:Products_Num:V'),
(45, 7, 'ec_products:description:description:Products_Description:V'),
(45, 8, 'ec_products:createdtime:createdtime:Products_Created_Time:T'),
(46, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(46, 1, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(46, 2, 'ec_salesorder:orderstatus:orderstatus:SalesOrder_Order_Status:V'),
(46, 3, 'ec_salesorder:gift_item_name:gift_item_name:SalesOrder_Gift_Item_Name:V'),
(46, 4, ''),
(46, 5, ''),
(46, 6, ''),
(46, 7, ''),
(46, 8, ''),
(47, 1, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time:T'),
(47, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(47, 2, 'ec_maillisttmps:modifiedtime:modifiedtime:Maillisttmps_Modified_Time:T'),
(47, 3, ''),
(47, 4, ''),
(47, 5, 'ec_maillisttmps:description:description:Maillisttmps_Description:V'),
(47, 6, ''),
(47, 7, ''),
(47, 8, ''),
(48, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(48, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(48, 2, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(48, 3, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(48, 4, 'ec_account:email:email:Accounts_Email:E'),
(48, 5, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(48, 6, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(48, 7, 'ec_account:phone:phone:Accounts_Phone:V'),
(48, 8, 'ec_account:tel:tel:Accounts_电话:V'),
(49, 0, 'ec_products:productcode:productcode:Products_Product_Code:V'),
(49, 1, 'ec_products:productname:productname:Products_Product_Name:V'),
(49, 2, 'ec_products:num:num:Products_Num:V'),
(49, 3, 'ec_products:price:price:Products_Price:N'),
(49, 4, ''),
(49, 5, ''),
(49, 6, ''),
(49, 7, ''),
(49, 8, ''),
(50, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(50, 1, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time:T'),
(50, 2, 'ec_maillisttmps:modifiedtime:modifiedtime:Maillisttmps_Modified_Time:T'),
(50, 3, ''),
(50, 4, ''),
(50, 5, ''),
(50, 6, ''),
(50, 7, ''),
(50, 8, ''),
(51, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(51, 1, ''),
(51, 2, ''),
(51, 3, ''),
(51, 4, ''),
(51, 5, ''),
(51, 6, ''),
(51, 7, ''),
(51, 8, ''),
(52, 0, 'ec_maillisttmps:maillisttmpname:maillisttmpname:Maillisttmps_Maillisttmp_Name:V'),
(52, 1, 'ec_maillisttmps:description:description:Maillisttmps_Description:V'),
(52, 2, ''),
(52, 3, ''),
(52, 4, ''),
(52, 5, 'ec_maillisttmps:modifiedtime:modifiedtime:Maillisttmps_Modified_Time:T'),
(52, 6, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time:T'),
(52, 7, ''),
(52, 8, ''),
(53, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(53, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(53, 2, ''),
(53, 3, ''),
(53, 4, ''),
(53, 5, ''),
(53, 6, ''),
(53, 7, ''),
(53, 8, ''),
(54, 2, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(54, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(54, 0, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V'),
(54, 3, ''),
(54, 4, ''),
(54, 5, ''),
(54, 6, ''),
(54, 7, ''),
(54, 8, ''),
(55, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(55, 1, ''),
(55, 2, ''),
(55, 3, ''),
(55, 4, ''),
(55, 5, ''),
(55, 6, ''),
(55, 7, ''),
(55, 8, ''),
(56, 0, 'ec_products:num_iid:num_iid:Products_Num_Iid:V'),
(56, 1, 'ec_products:productname:productname:Products_Product_Name:V'),
(56, 2, 'ec_products:price:price:Products_Price:N'),
(56, 3, 'ec_products:num:num:Products_Num:V'),
(56, 4, ''),
(56, 5, ''),
(56, 6, ''),
(56, 7, ''),
(56, 8, ''),
(57, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(57, 2, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(57, 3, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(57, 7, ''),
(57, 6, ''),
(57, 4, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(57, 5, ''),
(58, 3, 'ec_salesorder:buyer_nick:buyer_nick:SalesOrder_Buyer_Nick:V'),
(58, 2, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(58, 1, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(58, 0, 'ec_salesorder:tid:tid:SalesOrder_Tid:V'),
(57, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(58, 4, 'ec_salesorder:pay_time:pay_time:SalesOrder_Pay_Time:V'),
(58, 5, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(58, 6, 'ec_salesorder:payment:payment:SalesOrder_Payment:V'),
(58, 7, 'ec_salesorder:description:description:SalesOrder_Description:V'),
(58, 8, ''),
(59, 0, 'ec_salesorder:subject:subject:SalesOrder_Subject:V'),
(59, 1, 'ec_salesorder:accountid:account_id:SalesOrder_Account_Name:I'),
(59, 2, 'ec_salesorder:pay_time:pay_time:SalesOrder_Pay_Time:V'),
(59, 3, 'ec_salesorder:total:total:SalesOrder_Total:V'),
(59, 4, 'ec_salesorder:payment:payment:SalesOrder_Payment:V'),
(59, 5, ''),
(59, 6, ''),
(59, 7, ''),
(59, 8, ''),
(57, 8, ''),
(60, 7, ''),
(60, 8, ''),
(60, 5, ''),
(60, 6, ''),
(60, 4, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(60, 3, 'ec_account:createdtime:createdtime:Accounts_Created_Time:T'),
(60, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(60, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(60, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(61, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(61, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(61, 2, 'ec_account:email:email:Accounts_Email:E'),
(61, 3, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(61, 4, 'ec_account:bill_code:bill_code:Accounts_Billing_Code:V'),
(61, 5, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(61, 6, 'ec_account:phone:phone:Accounts_Phone:V'),
(61, 7, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V'),
(61, 8, 'ec_account:allsuccessbuy:allsuccessbuy:Accounts_总共成功购买次数:I'),
(62, 8, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V'),
(62, 7, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V'),
(62, 6, 'ec_account:phone:phone:Accounts_Phone:V'),
(62, 5, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(62, 4, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(62, 3, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(62, 2, 'ec_account:email:email:Accounts_Email:E'),
(62, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(62, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(63, 2, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(63, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(63, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(63, 3, ''),
(63, 4, ''),
(63, 5, ''),
(63, 6, ''),
(63, 7, ''),
(63, 8, ''),
(64, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(64, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(64, 2, 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I'),
(64, 3, ''),
(64, 4, ''),
(64, 5, ''),
(64, 6, ''),
(64, 7, ''),
(64, 8, ''),
(65, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(65, 1, ''),
(65, 2, ''),
(65, 3, ''),
(65, 4, ''),
(65, 5, ''),
(65, 6, ''),
(65, 7, ''),
(65, 8, ''),
(66, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(66, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(66, 2, ''),
(66, 3, ''),
(66, 4, ''),
(66, 5, ''),
(66, 6, ''),
(66, 7, ''),
(66, 8, ''),
(67, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(67, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(67, 2, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(67, 3, ''),
(67, 4, ''),
(67, 5, ''),
(67, 6, ''),
(67, 7, ''),
(67, 8, ''),
(3, 8, ''),
(68, 0, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(68, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(68, 2, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(68, 3, 'ec_account:ordernum:ordernum:Accounts_Ordernum:I'),
(68, 4, 'ec_account:email:email:Accounts_Email:E'),
(68, 5, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(68, 6, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(68, 7, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V'),
(68, 8, 'ec_account:phone:phone:Accounts_Phone:V'),
(69, 2, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(69, 3, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(69, 4, 'ec_account:account_type:account_type:Accounts_Account_Type:V'),
(69, 5, 'ec_account:phone:phone:Accounts_Phone:V'),
(69, 6, 'ec_account:email:email:Accounts_Email:E'),
(69, 7, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(69, 8, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(70, 1, 'ec_account:phone:phone:Accounts_Phone:V'),
(69, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(69, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(70, 2, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(70, 3, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V'),
(70, 4, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(70, 5, ''),
(70, 6, ''),
(70, 7, ''),
(70, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(70, 8, ''),
(71, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(71, 1, ''),
(71, 2, ''),
(71, 3, ''),
(71, 4, ''),
(71, 5, ''),
(71, 6, ''),
(71, 7, ''),
(71, 8, ''),
(72, 0, 'ec_account:email:email:Accounts_Email:E'),
(72, 1, ''),
(72, 2, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(72, 3, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(72, 4, ''),
(72, 5, ''),
(72, 6, ''),
(72, 7, ''),
(72, 8, ''),
(73, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(73, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(73, 2, 'ec_account:tel:tel:Accounts_电话:V'),
(73, 3, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(73, 4, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime:T'),
(73, 5, 'ec_account:phone:phone:Accounts_Phone:V'),
(73, 6, 'ec_account:vipinfo:vipinfo:Accounts_Vipinfo:V'),
(73, 7, ''),
(73, 8, ''),
(74, 0, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date:T'),
(74, 1, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(74, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(74, 3, 'ec_account:tel:tel:Accounts_电话:V'),
(74, 4, 'ec_account:bill_district:bill_district:Accounts_Billing_District:V'),
(74, 5, 'ec_account:bill_city:bill_city:Accounts_Billing_City:V'),
(74, 6, 'ec_account:bill_state:bill_state:Accounts_Billing_State:V'),
(74, 7, 'ec_account:bill_street:bill_street:Accounts_Billing_Address:V'),
(74, 8, 'ec_account:bill_code:bill_code:Accounts_Billing_Code:V'),
(75, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(75, 1, 'ec_products:num_iid:num_iid:Products_Num_Iid:V'),
(75, 2, 'ec_products:detail_url:detail_url:Products_Detail_Url:V'),
(75, 3, 'ec_products:price:price:Products_Price:N'),
(75, 4, 'ec_products:num:num:Products_Num:V'),
(75, 5, 'ec_products:productcode:productcode:Products_Product_Code:V'),
(75, 6, ''),
(75, 7, ''),
(75, 8, ''),
(76, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(76, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(76, 2, 'ec_account:phone:phone:Accounts_Phone:V'),
(76, 3, 'ec_account:email:email:Accounts_Email:E'),
(76, 4, 'ec_account:tel:tel:Accounts_电话:V'),
(76, 5, 'ec_account:alipay_account:alipay_account:Accounts_Alipay_Account:V'),
(76, 6, 'ec_account:contact_date:contact_date:Accounts_Contact_Date:D'),
(76, 7, 'ec_account:ordertotal:ordertotal:Accounts_Ordertotal:N'),
(76, 8, 'ec_account:contacttimes:contacttimes:Accounts_Contacttimes:I'),
(77, 0, 'ec_products:productname:productname:Products_Product_Name:V'),
(77, 1, 'ec_products:outer_id:outer_id:Products_商家编码:V'),
(77, 2, ''),
(77, 3, ''),
(77, 4, ''),
(77, 5, ''),
(77, 6, ''),
(77, 7, ''),
(77, 8, ''),
(78, 0, 'ec_account:accountname:accountname:Accounts_Account_Name:V'),
(78, 1, 'ec_account:membername:membername:Accounts_Tao_MemberName:V'),
(78, 2, 'ec_account:account_buyer_credit:account_buyer_credit:Accounts_Account_Buyer_Credit:V'),
(78, 3, ''),
(78, 4, ''),
(78, 5, ''),
(78, 6, ''),
(78, 7, ''),
(78, 8, '');

-- --------------------------------------------------------

--
-- 表的结构 `ec_cvstdfilter`
--

CREATE TABLE IF NOT EXISTS `ec_cvstdfilter` (
  `cvid` int(19) NOT NULL,
  `columnname` varchar(250) DEFAULT '',
  `stdfilter` varchar(250) DEFAULT '',
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`cvid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_cvstdfilter`
--

INSERT INTO `ec_cvstdfilter` (`cvid`, `columnname`, `stdfilter`, `startdate`, `enddate`) VALUES
(7, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'custom', '0000-00-00', '0000-00-00'),
(8, 'ec_qunfatmps:createdtime:createdtime:Qunfatmps_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(9, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(18, '', 'custom', '0000-00-00', '0000-00-00'),
(3, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(11, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(12, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(13, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(14, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'before100days', '1900-01-01', '2011-10-09'),
(15, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'before180days', '1900-01-01', '2011-07-21'),
(19, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(16, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '0000-00-00', '0000-00-00'),
(17, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(2, '', 'custom', '0000-00-00', '0000-00-00'),
(4, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(1, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(20, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(21, 'ec_qunfatmps:createdtime:createdtime:Qunfatmps_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(22, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(23, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(24, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'thisfq', '2012-01-01', '2012-03-31'),
(25, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(26, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(27, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(28, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(29, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(30, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(35, 'ec_notes:modifiedtime:modifiedtime:Notes_Modified_Time', 'before7days', '1900-01-01', '2012-02-13'),
(36, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'before7days', '1900-01-01', '2012-02-13'),
(37, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'thismonth', '2012-02-01', '2012-02-29'),
(38, 'ec_memdays:createdtime:createdtime:Memdays_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(39, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '2012-02-01', '2012-03-13'),
(40, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(41, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(42, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '2012-04-01', '2012-04-10'),
(43, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(44, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'custom', '2012-04-03', '2012-06-08'),
(45, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(46, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(47, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'custom', '2012-04-22', '2012-04-22'),
(48, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '2012-04-22', '2012-04-30'),
(49, 'ec_products:modifiedtime:modifiedtime:Products_Modified_Time', 'custom', '0000-00-00', '0000-00-00'),
(50, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'today', '2012-04-25', '2012-04-25'),
(51, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(52, 'ec_maillisttmps:createdtime:createdtime:Maillisttmps_Created_Time', 'thismonth', '2012-04-01', '2012-04-30'),
(53, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(54, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(55, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(56, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(57, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(58, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(59, 'ec_salesorder:createdtime:createdtime:SalesOrder_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(60, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(61, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2008-06-01', '2012-06-24'),
(62, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'custom', '2008-06-25', '2012-06-25'),
(63, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'prevfq', '2012-04-01', '2012-06-30'),
(64, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'thisfq', '2012-04-01', '2012-06-30'),
(65, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(66, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(67, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(68, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(69, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(70, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'before30days', '1900-01-01', '2012-07-27'),
(71, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(72, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'before7days', '1900-01-01', '2012-10-13'),
(73, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(74, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(75, 'ec_products:createdtime:createdtime:Products_Created_Time', 'thisfq', '2012-10-01', '2012-12-31'),
(76, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(77, 'ec_products:createdtime:createdtime:Products_Created_Time', 'custom', '2012-12-04', '2012-12-06'),
(78, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- 表的结构 `ec_cvstdfilterfenzu`
--

CREATE TABLE IF NOT EXISTS `ec_cvstdfilterfenzu` (
  `cvid` int(19) NOT NULL,
  `columnname` varchar(250) CHARACTER SET ucs2 DEFAULT NULL,
  `stdfilter` varchar(250) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`cvid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_cvstdfilterfenzu`
--

INSERT INTO `ec_cvstdfilterfenzu` (`cvid`, `columnname`, `stdfilter`, `startdate`, `enddate`) VALUES
(3, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'prevfy', '2010-01-01', '2010-12-31'),
(4, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(5, 'ec_account:birthday:birthday:Accounts_Birthday', 'nextmonth', '2011-09-01', '2011-09-30'),
(6, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thisweek', '2011-08-28', '2011-09-03'),
(7, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(8, 'ec_account:birthday:birthday:Accounts_Birthday', 'thismonth', '0000-00-00', '0000-00-00'),
(9, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(10, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(11, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(112, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(113, 'ec_account:birthday:birthday:Accounts_Birthday', 'thismonth', '2011-09-01', '2011-09-30'),
(114, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(115, 'ec_account:birthday:birthday:Accounts_Birthday', 'custom', '0000-00-00', '0000-00-00'),
(116, 'ec_account:birthday:birthday:Accounts_Birthday', 'custom', '0000-00-00', '0000-00-00'),
(117, '', 'custom', '0000-00-00', '0000-00-00'),
(118, '', 'custom', '0000-00-00', '0000-00-00'),
(119, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'before7days', '1900-01-01', '2012-01-05'),
(120, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'before15days', '1900-01-01', '2011-12-28'),
(121, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(122, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'before7days', '1900-01-01', '2012-01-05'),
(123, 'ec_account:lastsendmessdate:lastsendmessdate:Accounts_最新发送短信日期', 'custom', '0000-00-00', '0000-00-00'),
(124, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'next90days', '2012-01-17', '2012-04-15'),
(125, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(126, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-11', '2012-02-18'),
(127, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(128, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'before30days', '1900-01-01', '2012-01-24'),
(129, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'prevfy', '2011-01-01', '2011-12-31'),
(130, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'before30days', '1900-01-01', '2012-01-24'),
(131, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(132, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(133, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(134, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'today', '2012-02-28', '2012-02-28'),
(135, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-27', '2012-02-28'),
(136, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-27', '2012-02-28'),
(137, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-25', '2012-02-28'),
(138, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(139, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(140, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(141, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(142, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(143, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(144, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(145, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(146, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(147, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(148, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(149, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2010-03-01', '2012-03-07'),
(150, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2011-04-10', '2012-03-10'),
(151, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'last180days', '2011-09-13', '2012-03-10'),
(152, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-03-01', '2012-02-15'),
(153, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-01', '2012-03-01'),
(154, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-03-01', '2012-03-15'),
(155, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(156, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thisfq', '2012-01-01', '2012-03-31'),
(157, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-02-01', '2012-03-24'),
(158, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(159, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(160, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thismonth', '2012-03-01', '2012-03-31'),
(161, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'prevfy', '2011-01-01', '2011-12-31'),
(162, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'before30days', '1900-01-01', '2012-02-29'),
(163, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(164, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'before60days', '1900-01-01', '2012-01-30'),
(165, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thismonth', '2012-03-01', '2012-03-31'),
(166, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(167, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(168, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(169, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(170, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-01', '2012-04-03'),
(171, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'custom', '0000-00-00', '0000-00-00'),
(172, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(173, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-17', '2012-04-17'),
(174, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-16', '2012-04-17'),
(175, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(176, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'prevfy', '2011-01-01', '2011-12-31'),
(177, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(178, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(179, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'lastmonth', '2012-03-01', '2012-03-31'),
(180, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2011-03-01', '2011-12-31'),
(181, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-03-01', '2012-04-19'),
(182, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-02-01', '2012-04-19'),
(183, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisweek', '2012-04-15', '2012-04-21'),
(184, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(185, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(186, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-22', '2012-04-30'),
(187, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-22', '2012-04-30'),
(188, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'after15days', '2012-05-09', '2099-12-31'),
(189, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(190, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2011-04-01', '2012-04-27'),
(191, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'before7days', '1900-01-01', '2012-04-22'),
(192, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thisfq', '2012-04-01', '2012-06-30'),
(193, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'thisfy', '2012-01-01', '2012-12-31'),
(194, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(195, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'lastmonth', '2012-04-01', '2012-04-30'),
(196, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-01', '2012-05-03'),
(197, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-05-04', '2012-05-04'),
(198, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(199, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-05-03', '2012-05-04'),
(200, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-05-03', '2012-05-04'),
(201, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(202, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'lastmonth', '2012-04-01', '2012-04-30'),
(203, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'next3days', '2012-05-05', '2012-05-07'),
(204, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-05-04', '2012-05-04'),
(205, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'custom', '2012-05-01', '2012-05-05'),
(206, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(207, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2010-05-10', '2012-05-10'),
(208, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-04-11', '2012-05-13'),
(209, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(210, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2010-05-27', '2012-05-20'),
(211, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(212, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(213, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(214, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-05-01', '2012-05-16'),
(215, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(216, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(217, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(218, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(219, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'next180days', '2012-05-31', '2012-11-26'),
(220, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-04-01', '2012-04-30'),
(221, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(222, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-01-03', '2012-07-03'),
(223, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'today', '2012-07-03', '2012-07-03'),
(224, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '0000-00-00', '0000-00-00'),
(225, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'thisfy', '2012-01-01', '2012-12-31'),
(226, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-02-01', '2012-07-04'),
(227, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thisfy', '2012-01-01', '2012-12-31'),
(228, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(229, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(230, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(231, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(232, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-07-04', '2012-07-04'),
(233, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'today', '2012-07-07', '2012-07-07'),
(234, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(235, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'last180days', '2012-01-11', '2012-07-08'),
(236, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(237, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(238, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisfq', '2012-04-01', '2012-06-30'),
(239, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(240, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(241, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'before30days', '1900-01-01', '2012-06-12'),
(242, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'last180days', '2012-01-15', '2012-07-12'),
(243, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'last180days', '2012-01-15', '2012-07-12'),
(244, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2010-01-01', '2012-07-12'),
(245, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'today', '2012-07-19', '2012-07-19'),
(246, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(247, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(248, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(249, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(250, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(251, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'yesterday', '2012-07-21', '2012-07-21'),
(252, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(253, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(254, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(255, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(256, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(257, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(258, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(259, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(260, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'before7days', '1900-01-01', '2012-07-29'),
(261, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'custom', '0000-00-00', '0000-00-00'),
(262, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(263, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(264, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(265, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(266, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(267, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(268, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-08-25', '2012-08-30'),
(269, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'before7days', '1900-01-01', '2012-08-18'),
(270, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'nextweek', '2012-08-26', '2012-09-01'),
(271, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(272, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'nextweek', '2012-08-26', '2012-09-01'),
(273, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisfq', '2012-07-01', '2012-09-30'),
(274, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(275, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(276, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(277, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thismonth', '2012-08-01', '2012-08-31'),
(278, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(279, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thismonth', '2012-09-01', '2012-09-30'),
(280, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2011-05-01', '2012-09-30'),
(281, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(282, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2010-09-01', '2012-09-15'),
(283, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(284, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-09-01', '2012-09-22'),
(285, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '0000-00-00', '0000-00-00'),
(286, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(287, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thismonth', '2012-10-01', '2012-10-31'),
(288, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thismonth', '2012-10-01', '2012-10-31'),
(289, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-10-01', '2012-10-09'),
(290, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(291, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'lastweek', '2012-10-07', '2012-10-13'),
(292, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'custom', '2012-10-01', '2012-10-20'),
(293, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(294, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(295, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'prevfq', '2012-07-01', '2012-10-01'),
(296, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(297, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(298, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'custom', '0000-00-00', '0000-00-00'),
(299, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-07-01', '2012-10-15'),
(300, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(301, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'custom', '2008-12-01', '2009-02-01'),
(302, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'custom', '0000-00-00', '0000-00-00'),
(303, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-01', '2012-11-03'),
(304, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-11-06', '2012-11-06'),
(305, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(306, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-06', '2012-11-06'),
(307, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-06', '2012-11-06'),
(308, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-01', '2012-11-03'),
(309, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(310, 'ec_account:contact_date:contact_date:Accounts_Contact_Date', 'custom', '0000-00-00', '0000-00-00'),
(311, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'today', '2012-11-06', '2012-11-06'),
(312, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(313, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(314, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-01', '2012-11-10'),
(315, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '2012-11-01', '2012-11-08'),
(316, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'after180days', '2013-05-08', '2099-12-31'),
(317, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'after180days', '2012-07-10', '2099-12-31'),
(318, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisfy', '2012-01-01', '2012-12-31'),
(319, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'last30days', '2012-10-19', '2012-11-17'),
(320, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisfy', '2012-01-01', '2012-12-31'),
(321, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'thisweek', '2012-11-11', '2012-11-17'),
(322, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '0000-00-00', '0000-00-00'),
(323, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thismonth', '2012-11-01', '2012-11-30'),
(324, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisweek', '2012-11-18', '2012-12-01'),
(325, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(326, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(327, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(328, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'custom', '0000-00-00', '0000-00-00'),
(329, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'today', '2012-12-09', '2012-12-09'),
(330, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'today', '2012-12-09', '2012-12-09'),
(331, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'today', '2012-12-09', '2012-12-09'),
(332, 'ec_account:modifiedtime:modifiedtime:Accounts_Modified_Time', 'today', '2012-12-09', '2012-12-09'),
(333, 'ec_account:last_logintime:last_logintime:Accounts_Last_Logintime', 'thisfy', '2012-01-01', '2012-12-31'),
(334, 'ec_account:lastsendmaildate:lastsendmaildate:Accounts_最新发送邮件日期', 'thisfy', '2012-01-01', '2012-12-31'),
(335, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-15', '2012-12-25'),
(336, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-12-15', '2012-12-20'),
(337, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-20', '2012-12-20'),
(338, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-20', '2012-12-20'),
(339, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-20', '2012-12-20'),
(340, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-21', '2012-12-21'),
(341, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-21', '2012-12-21'),
(342, 'ec_account:lastorderdate:lastorderdate:Accounts_LastOrder_Date', 'custom', '2012-12-20', '2012-12-21'),
(343, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-21', '2012-12-21'),
(344, 'ec_account:createdtime:createdtime:Accounts_Created_Time', 'custom', '2012-12-21', '2012-12-21');

-- --------------------------------------------------------

--
-- 表的结构 `ec_def_org_field`
--

CREATE TABLE IF NOT EXISTS `ec_def_org_field` (
  `tabid` int(10) DEFAULT NULL,
  `fieldid` int(19) NOT NULL,
  `visible` int(19) DEFAULT NULL,
  `readonly` int(19) DEFAULT NULL,
  PRIMARY KEY (`fieldid`),
  KEY `def_org_field_tabid_fieldid_idx` (`tabid`,`fieldid`),
  KEY `def_org_field_tabid_idx` (`tabid`),
  KEY `def_org_field_visible_fieldid_idx` (`visible`,`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_def_org_field`
--

INSERT INTO `ec_def_org_field` (`tabid`, `fieldid`, `visible`, `readonly`) VALUES
(6, 1, 0, 1),
(6, 2, 1, 1),
(6, 3, 0, 1),
(6, 4, 0, 1),
(6, 5, 0, 1),
(6, 6, 0, 1),
(6, 7, 0, 1),
(6, 8, 0, 1),
(6, 9, 0, 1),
(6, 10, 0, 1),
(6, 11, 0, 1),
(6, 12, 0, 1),
(6, 13, 0, 1),
(6, 14, 0, 1),
(6, 15, 0, 1),
(6, 16, 0, 1),
(6, 17, 0, 1),
(6, 18, 0, 1),
(6, 19, 0, 1),
(6, 20, 0, 1),
(6, 21, 0, 1),
(6, 22, 0, 1),
(6, 23, 0, 1),
(6, 24, 0, 1),
(6, 25, 0, 1),
(6, 26, 0, 1),
(6, 27, 0, 1),
(6, 28, 0, 1),
(6, 29, 0, 1),
(6, 30, 0, 1),
(6, 31, 0, 1),
(6, 32, 0, 1),
(6, 33, 0, 1),
(6, 34, 0, 1),
(6, 35, 0, 1),
(6, 36, 0, 1),
(6, 37, 0, 1),
(8, 38, 0, 1),
(8, 39, 0, 1),
(8, 40, 0, 1),
(8, 41, 0, 1),
(8, 42, 0, 1),
(8, 43, 0, 1),
(8, 44, 0, 1),
(8, 45, 0, 1),
(8, 46, 0, 1),
(14, 47, 0, 1),
(14, 48, 0, 1),
(14, 49, 0, 1),
(14, 50, 0, 1),
(14, 51, 0, 1),
(14, 52, 0, 1),
(14, 53, 0, 1),
(14, 54, 0, 1),
(14, 55, 0, 1),
(14, 56, 0, 1),
(14, 57, 0, 1),
(14, 58, 0, 1),
(14, 59, 0, 1),
(14, 60, 0, 1),
(14, 61, 0, 1),
(14, 62, 0, 1),
(14, 63, 0, 1),
(14, 64, 0, 1),
(14, 65, 0, 1),
(14, 66, 0, 1),
(14, 67, 0, 1),
(14, 68, 0, 1),
(14, 69, 0, 1),
(14, 70, 0, 1),
(14, 71, 0, 1),
(14, 72, 0, 1),
(14, 73, 0, 1),
(14, 74, 0, 1),
(14, 75, 0, 1),
(14, 76, 0, 1),
(14, 77, 0, 1),
(14, 78, 0, 1),
(14, 79, 0, 1),
(22, 80, 0, 1),
(22, 81, 0, 1),
(22, 82, 0, 1),
(22, 83, 0, 1),
(22, 84, 0, 1),
(22, 85, 0, 1),
(22, 86, 0, 1),
(22, 87, 0, 1),
(22, 88, 0, 1),
(22, 89, 0, 1),
(22, 90, 0, 1),
(22, 91, 0, 1),
(22, 92, 0, 1),
(22, 93, 0, 1),
(22, 94, 0, 1),
(22, 95, 0, 1),
(22, 96, 0, 1),
(22, 97, 0, 1),
(22, 98, 0, 1),
(22, 99, 0, 1),
(22, 100, 0, 1),
(22, 101, 0, 1),
(22, 102, 0, 1),
(22, 103, 0, 1),
(22, 104, 0, 1),
(22, 105, 0, 1),
(22, 106, 0, 1),
(22, 107, 0, 1),
(22, 108, 0, 1),
(22, 109, 0, 1),
(22, 110, 0, 1),
(22, 111, 0, 1),
(22, 112, 0, 1),
(22, 113, 0, 1),
(22, 114, 1, 1),
(22, 115, 0, 1),
(22, 116, 0, 1),
(22, 117, 0, 1),
(22, 118, 0, 1),
(14, 377, 0, 1),
(22, 120, 0, 1),
(22, 121, 0, 1),
(22, 122, 0, 1),
(22, 123, 0, 1),
(22, 119, 0, 1),
(6, 376, 0, 1),
(22, 126, 0, 1),
(22, 127, 0, 1),
(22, 128, 0, 1),
(22, 129, 0, 1),
(22, 130, 0, 1),
(22, 131, 0, 1),
(22, 132, 0, 1),
(22, 133, 0, 1),
(22, 134, 0, 1),
(22, 135, 0, 1),
(22, 136, 0, 1),
(22, 137, 0, 1),
(22, 138, 0, 1),
(22, 139, 0, 1),
(22, 140, 0, 1),
(22, 141, 0, 1),
(22, 142, 0, 1),
(22, 143, 0, 1),
(22, 144, 0, 1),
(22, 145, 0, 1),
(22, 146, 0, 1),
(22, 147, 0, 1),
(22, 148, 0, 1),
(22, 149, 0, 1),
(33, 179, 0, 1),
(33, 180, 0, 1),
(33, 181, 1, 1),
(33, 182, 0, 1),
(33, 183, 0, 1),
(33, 184, 0, 1),
(33, 185, 0, 1),
(33, 186, 0, 1),
(33, 187, 1, 1),
(33, 188, 1, 1),
(33, 189, 1, 1),
(33, 190, 1, 1),
(33, 191, 0, 1),
(33, 192, 0, 1),
(34, 193, 0, 1),
(34, 194, 0, 1),
(34, 195, 1, 1),
(34, 196, 0, 1),
(34, 197, 0, 1),
(34, 198, 0, 1),
(34, 199, 0, 1),
(34, 200, 0, 1),
(34, 201, 1, 1),
(34, 202, 1, 1),
(34, 203, 1, 1),
(34, 204, 1, 1),
(34, 205, 0, 1),
(34, 206, 0, 1),
(35, 207, 0, 1),
(35, 208, 1, 1),
(35, 209, 0, 1),
(35, 210, 0, 1),
(35, 211, 0, 1),
(35, 212, 0, 1),
(35, 213, 0, 1),
(35, 214, 0, 1),
(35, 215, 0, 1),
(35, 216, 0, 1),
(35, 217, 0, 1),
(35, 218, 0, 1),
(35, 219, 1, 1),
(35, 220, 1, 1),
(36, 221, 0, 1),
(36, 222, 1, 1),
(36, 223, 0, 1),
(36, 224, 1, 1),
(36, 225, 1, 1),
(36, 226, 1, 1),
(36, 227, 0, 1),
(36, 228, 1, 1),
(36, 229, 0, 1),
(36, 230, 0, 1),
(36, 231, 0, 1),
(36, 232, 0, 1),
(36, 233, 1, 1),
(36, 234, 1, 1),
(22, 235, 0, 1),
(22, 236, 0, 1),
(22, 237, 0, 1),
(22, 238, 0, 1),
(22, 239, 0, 1),
(22, 240, 0, 1),
(22, 241, 0, 1),
(33, 242, 0, 1),
(33, 243, 0, 1),
(33, 244, 0, 1),
(33, 245, 0, 1),
(33, 246, 0, 1),
(33, 247, 0, 1),
(33, 248, 0, 1),
(33, 249, 0, 1),
(33, 250, 0, 1),
(33, 251, 0, 1),
(33, 252, 0, 1),
(33, 253, 1, 1),
(33, 254, 0, 1),
(33, 255, 0, 1),
(34, 256, 0, 1),
(34, 257, 0, 1),
(34, 258, 0, 1),
(34, 259, 0, 1),
(34, 260, 0, 1),
(34, 261, 0, 1),
(34, 262, 0, 1),
(34, 263, 0, 1),
(34, 264, 0, 1),
(34, 265, 0, 1),
(34, 266, 0, 1),
(34, 267, 0, 1),
(34, 268, 0, 1),
(34, 269, 0, 1),
(34, 270, 0, 1),
(34, 271, 0, 1),
(34, 272, 0, 1),
(34, 273, 0, 1),
(34, 274, 0, 1),
(34, 275, 0, 1),
(34, 276, 0, 1),
(34, 277, 0, 1),
(34, 278, 1, 1),
(34, 279, 0, 1),
(34, 280, 0, 1),
(34, 281, 0, 1),
(34, 282, 0, 1),
(34, 283, 0, 1),
(34, 284, 0, 1),
(34, 285, 1, 1),
(34, 286, 0, 1),
(34, 287, 0, 1),
(34, 288, 0, 1),
(34, 289, 1, 1),
(34, 290, 0, 1),
(37, 296, 1, 1),
(37, 292, 0, 1),
(37, 294, 1, 1),
(37, 295, 1, 1),
(37, 293, 1, 1),
(37, 291, 0, 1),
(37, 297, 0, 1),
(37, 298, 1, 1),
(37, 299, 1, 1),
(37, 300, 1, 1),
(37, 301, 1, 1),
(37, 302, 1, 1),
(37, 303, 1, 1),
(37, 304, 1, 1),
(6, 305, 0, 1),
(6, 306, 0, 1),
(6, 307, 0, 1),
(6, 308, 1, 1),
(6, 309, 1, 1),
(6, 310, 1, 1),
(6, 311, 0, 1),
(6, 312, 0, 1),
(6, 313, 0, 1),
(6, 314, 1, 1),
(6, 315, 0, 1),
(6, 316, 0, 1),
(22, 318, 0, 1),
(14, 319, 0, 1),
(44, 320, 0, 1),
(44, 321, 0, 1),
(44, 333, 0, 1),
(44, 332, 0, 1),
(44, 331, 0, 1),
(44, 330, 0, 1),
(44, 329, 0, 1),
(44, 328, 0, 1),
(44, 327, 0, 1),
(44, 326, 0, 1),
(44, 325, 0, 1),
(44, 324, 0, 1),
(44, 323, 0, 1),
(44, 322, 0, 1),
(45, 339, 0, 1),
(45, 338, 0, 1),
(45, 337, 0, 1),
(45, 336, 0, 1),
(45, 335, 0, 1),
(45, 334, 0, 1),
(45, 347, 0, 1),
(45, 346, 0, 1),
(45, 345, 0, 1),
(45, 344, 0, 1),
(45, 343, 0, 1),
(45, 342, 0, 1),
(45, 341, 0, 1),
(45, 340, 0, 1),
(46, 361, 0, 1),
(46, 360, 0, 1),
(46, 359, 0, 1),
(46, 358, 0, 1),
(46, 357, 0, 1),
(46, 356, 0, 1),
(46, 355, 0, 1),
(46, 354, 0, 1),
(46, 353, 0, 1),
(46, 352, 0, 1),
(46, 351, 0, 1),
(46, 350, 0, 1),
(46, 349, 0, 1),
(46, 348, 0, 1),
(47, 366, 1, 1),
(47, 365, 1, 1),
(47, 364, 0, 1),
(47, 363, 0, 1),
(47, 362, 0, 1),
(47, 372, 0, 1),
(47, 373, 0, 1),
(47, 371, 0, 1),
(47, 370, 0, 1),
(47, 369, 1, 1),
(47, 368, 0, 1),
(47, 367, 1, 1),
(47, 374, 1, 1),
(47, 375, 1, 1),
(48, 378, 0, 1),
(48, 379, 0, 1),
(48, 380, 0, 1),
(48, 381, 0, 1),
(48, 382, 0, 1),
(48, 383, 0, 1),
(48, 384, 0, 1),
(48, 385, 0, 1),
(48, 386, 0, 1),
(48, 387, 0, 1),
(48, 388, 0, 1),
(48, 389, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ec_entityname`
--

CREATE TABLE IF NOT EXISTS `ec_entityname` (
  `tabid` int(19) NOT NULL DEFAULT '0',
  `modulename` varchar(50) NOT NULL,
  `tablename` varchar(100) NOT NULL,
  `fieldname` varchar(150) NOT NULL,
  `entityidfield` varchar(150) NOT NULL,
  PRIMARY KEY (`tabid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_entityname`
--

INSERT INTO `ec_entityname` (`tabid`, `modulename`, `tablename`, `fieldname`, `entityidfield`) VALUES
(6, 'Accounts', 'ec_account', 'accountname', 'accountid'),
(8, 'Notes', 'ec_notes', 'title', 'notesid'),
(14, 'Products', 'ec_products', 'productname', 'productid'),
(29, 'Users', 'ec_users', 'last_name', 'id'),
(22, 'SalesOrder', 'ec_salesorder', 'subject', 'salesorderid'),
(33, 'Qunfas', 'ec_qunfas', 'qunfaname', 'qunfasid'),
(34, 'Maillists', 'ec_maillists', 'maillistname', 'maillistsid'),
(35, 'Qunfatmps', 'ec_qunfatmps', 'qunfatmpname', 'qunfatmpsid'),
(36, 'Maillisttmps', 'ec_maillisttmps', 'maillisttmpname', 'maillisttmpsid'),
(37, 'Relsettings', 'ec_relsettings', 'relsettingname', 'relsettingsid'),
(44, 'SfaDesktops', 'ec_sfadesktops', 'sfadesktopname', 'sfadesktopsid'),
(45, 'Sfalists', 'ec_sfalists', 'sfalistname', 'sfalistsid'),
(46, 'Sfalogs', 'ec_sfalogs', 'sfalogname', 'sfalogsid'),
(47, 'Sfasettings', 'ec_sfasettings', 'sfasettingname', 'sfasettingsid'),
(48, 'Memdays', 'ec_memdays', 'memdayname', 'memdaysid');

-- --------------------------------------------------------

--
-- 表的结构 `ec_fenzu`
--

CREATE TABLE IF NOT EXISTS `ec_fenzu` (
  `cvid` int(19) NOT NULL,
  `viewname` varchar(100) NOT NULL,
  `entitytype` varchar(100) NOT NULL,
  `smownerid` int(19) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cvid`),
  KEY `smownerid` (`smownerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_fenzu`
--

INSERT INTO `ec_fenzu` (`cvid`, `viewname`, `entitytype`, `smownerid`) VALUES
(2, '1111111111', 'Accounts', 7),
(3, '11111111', 'Accounts', 7),
(112, '所有客户', 'Qunfas', 7),
(116, '最近一周未发送过的客户', 'Maillists', 7),
(114, '所有客户', 'Maillists', 7),
(115, '最近一周未发送过的客户', 'Qunfas', 7),
(117, '2222', 'Qunfas', 7),
(118, '234234234234', 'Qunfas', 7),
(119, '最新发送邮件日期（7天前）', 'Maillists', 8),
(122, '最新发送短信日期7天前', 'Qunfas', 8),
(121, '测试', 'Maillists', 8),
(123, '测试', 'Qunfas', 8),
(124, '100天未下单2', 'Qunfas', 8),
(125, '测试', 'Maillists', 11),
(126, '客户', 'Maillists', 43),
(127, '', 'Maillists', 48),
(130, '12.2.23  30天前', 'Maillists', 73),
(131, '老客户', 'Maillists', 84),
(132, '客户1', 'Maillists', 96),
(141, '', 'Maillists', 102),
(135, '', 'Maillists', 102),
(137, '', 'Maillists', 102),
(138, '', 'Maillists', 102),
(145, '1', 'Maillists', 102),
(144, '', 'Maillists', 102),
(147, 'qq', 'Maillists', 156),
(148, 'dd', 'Maillists', 181),
(149, '20100606至20120307订单数为1', 'Maillists', 146),
(150, '美妍方', 'Maillists', 209),
(151, '卡姿兰', 'Maillists', 209),
(152, '3.15之前', 'Maillists', 253),
(153, '', 'Maillists', 284),
(154, '00', 'Maillists', 284),
(157, '客户2', 'Maillists', 239),
(156, '客户', 'Maillists', 239),
(158, '没有成功购买', 'Maillists', 257),
(159, '', 'Maillists', 257),
(162, 'g2', 'Maillists', 353),
(161, 'g1', 'Maillists', 353),
(163, 'ga', 'Maillists', 353),
(164, '', 'Maillists', 353),
(166, 'tt', 'Maillists', 366),
(167, '', 'Maillists', 366),
(168, 'VIP客户', 'Maillists', 383),
(169, '', 'Maillists', 417),
(170, '', 'Maillists', 417),
(171, '', 'Maillists', 461),
(175, 'bbhcvb', 'Maillists', 461),
(173, '', 'Maillists', 461),
(174, '', 'Maillists', 461),
(176, '11', 'Maillists', 468),
(177, '旗舰店客户群', 'Maillists', 466),
(178, '', 'Maillists', 466),
(179, '3个月前', 'Maillists', 477),
(180, '11', 'Maillists', 485),
(181, '', 'Maillists', 485),
(182, '2222', 'Maillists', 485),
(183, '', 'Maillists', 487),
(184, '1', 'Maillists', 194),
(187, '发发发1', 'Maillists', 407),
(188, '', 'Maillists', 452),
(189, '33', 'Maillists', 452),
(190, '', 'Maillists', 48),
(191, '', 'Maillists', 545),
(192, '', 'Maillists', 537),
(193, '本财年', 'Maillists', 584),
(194, '5-1', 'Maillists', 594),
(195, '', 'Maillists', 545),
(196, '1', 'Maillists', 545),
(201, '', 'Maillists', 599),
(202, '', 'Maillists', 599),
(203, '4月', 'Maillists', 599),
(204, '1111', 'Maillists', 599),
(205, '123', 'Maillists', 607),
(208, '', 'Maillists', 660),
(209, '', 'Maillists', 617),
(210, '1', 'Maillists', 617),
(211, '', 'Maillists', 617),
(212, '', 'Maillists', 617),
(213, '', 'Maillists', 617),
(214, 'ii', 'Maillists', 699),
(215, '', 'Maillists', 699),
(216, '', 'Maillists', 760),
(217, '客户', 'Maillists', 760),
(218, '', 'Maillists', 772),
(219, 'VIP客户', 'Maillists', 412),
(220, '成交用户', 'Maillists', 804),
(221, '3个月仅买一次', 'Maillists', 882),
(223, '', 'Maillists', 906),
(224, '11', 'Maillists', 906),
(225, '', 'Maillists', 610),
(226, '韩都衣舍', 'Maillists', 610),
(227, '', 'Maillists', 610),
(231, 'cc', 'Maillists', 912),
(229, '', 'Maillists', 912),
(233, '营销', 'Maillists', 914),
(237, '魅力维克', 'Maillists', 937),
(236, '1', 'Maillists', 937),
(238, '优尚行', 'Maillists', 938),
(239, '自由的普罗米修斯', 'Maillists', 489),
(243, '', 'Maillists', 942),
(241, '', 'Maillists', 942),
(244, '最近客户', 'Maillists', 942),
(245, '充值用户', 'Maillists', 979),
(247, '顾客1', 'Maillists', 989),
(254, '2222', 'Maillists', 935),
(251, '', 'Maillists', 935),
(256, '', 'Maillists', 1026),
(257, '呼啦圈', 'Maillists', 1026),
(258, '潜在客户', 'Maillists', 1002),
(259, '8989898', 'Maillists', 1046),
(260, '554646', 'Maillists', 1046),
(261, '', 'Maillists', 1046),
(262, '客户1', 'Maillists', 1062),
(263, 'test', 'Maillists', 987),
(264, '测试', 'Maillists', 1088),
(265, '啊啊', 'Maillists', 1108),
(266, 'test', 'Maillists', 1061),
(267, 'test', 'Maillists', 1061),
(268, '潜在会员', 'Maillists', 1127),
(269, '', 'Maillists', 1127),
(270, '', 'Maillists', 1127),
(271, '', 'Maillists', 1127),
(272, '只购买过一次的会员', 'Maillists', 1127),
(273, '发邮箱', 'Maillists', 1127),
(274, 'sdf', 'Maillists', 1126),
(275, 'dfdgf', 'Maillists', 1126),
(277, '重复消费的客户', 'Maillists', 1127),
(278, 'all', 'Maillists', 1139),
(279, '', 'Maillists', 1159),
(280, '', 'Maillists', 1197),
(281, '01', 'Maillists', 1197),
(282, '', 'Maillists', 1197),
(283, '1', 'Maillists', 1216),
(284, '', 'Maillists', 1216),
(285, '1', 'Maillists', 1216),
(286, '1', 'Maillists', 1253),
(287, '001', 'Maillists', 1263),
(288, '客户组', 'Maillists', 1152),
(289, '', 'Maillists', 1325),
(290, '1', 'Maillists', 1325),
(291, '', 'Maillists', 1325),
(292, '11', 'Maillists', 1325),
(293, '', 'Maillists', 1011),
(294, '群发通知', 'Maillists', 1360),
(295, '', 'Maillists', 1360),
(296, 'fz1', 'Maillists', 1367),
(297, '', 'Maillists', 1385),
(298, '1', 'Maillists', 1385),
(299, '重点客户', 'Maillists', 1082),
(300, '', 'Maillists', 1321),
(314, '345', 'Maillists', 1404),
(309, '', 'Maillists', 1407),
(315, '', 'Maillists', 1419),
(305, '第二批', 'Maillists', 1407),
(311, '1', 'Maillists', 1407),
(312, '1111', 'Maillists', 1414),
(313, '', 'Maillists', 1414),
(316, 'we', 'Maillists', 608),
(318, '所有用户', 'Maillists', 1410),
(319, '实验版', 'Maillists', 1462),
(320, '客户', 'Maillists', 1464),
(321, '客户', 'Maillists', 1468),
(322, '1组', 'Maillists', 728),
(323, '', 'Maillists', 1426),
(338, '下次11', 'Maillists', 1456),
(325, '测试', 'Maillists', 1547),
(326, '路由器客户', 'Maillists', 1566),
(327, '平板皮套客户', 'Maillists', 1566),
(328, '双12促销', 'Maillists', 1587),
(329, '', 'Maillists', 1456),
(343, '34545', 'Maillists', 1456),
(333, '', 'Maillists', 1604),
(334, '', 'Maillists', 1604),
(344, 'sdfdsg', 'Maillists', 1456);

-- --------------------------------------------------------

--
-- 表的结构 `ec_fenzu_seq`
--

CREATE TABLE IF NOT EXISTS `ec_fenzu_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_fenzu_seq`
--

INSERT INTO `ec_fenzu_seq` (`id`) VALUES
(244);

-- --------------------------------------------------------

--
-- 表的结构 `ec_field`
--

CREATE TABLE IF NOT EXISTS `ec_field` (
  `tabid` int(19) NOT NULL,
  `fieldid` int(19) NOT NULL,
  `columnname` varchar(30) NOT NULL,
  `tablename` varchar(50) NOT NULL,
  `generatedtype` int(19) NOT NULL DEFAULT '0',
  `uitype` varchar(30) NOT NULL,
  `fieldname` varchar(50) NOT NULL,
  `fieldlabel` varchar(50) NOT NULL,
  `readonly` int(1) NOT NULL,
  `presence` int(19) NOT NULL DEFAULT '1',
  `selected` int(1) NOT NULL,
  `maximumlength` int(19) DEFAULT NULL,
  `sequence` int(19) DEFAULT NULL,
  `block` int(19) DEFAULT NULL,
  `displaytype` int(19) DEFAULT NULL,
  `typeofdata` varchar(100) DEFAULT NULL,
  `quickcreate` int(10) NOT NULL DEFAULT '1',
  `quickcreatesequence` int(19) DEFAULT NULL,
  `info_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`fieldid`),
  KEY `field_tabid_idx` (`tabid`),
  KEY `field_fieldname_idx` (`fieldname`),
  KEY `field_block_idx` (`block`),
  KEY `field_displaytype_idx` (`displaytype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_field`
--

INSERT INTO `ec_field` (`tabid`, `fieldid`, `columnname`, `tablename`, `generatedtype`, `uitype`, `fieldname`, `fieldlabel`, `readonly`, `presence`, `selected`, `maximumlength`, `sequence`, `block`, `displaytype`, `typeofdata`, `quickcreate`, `quickcreatesequence`, `info_type`) VALUES
(6, 1, 'accountname', 'ec_account', 1, '2', 'accountname', 'Account Name', 1, 0, 0, 100, 1, 1, 1, 'V~M', 0, 1, 'BAS'),
(6, 2, 'belongshop', 'ec_account', 1, '1', 'belongshop', 'Belongshop', 1, 0, 0, 100, 2, 1, 1, 'V~O', 1, NULL, 'BAS'),
(6, 3, 'membername', 'ec_account', 1, '1', 'membername', 'Tao MemberName', 1, 0, 0, 100, 3, 1, 1, 'V~M', 1, 0, 'BAS'),
(6, 6, 'account_buyer_credit', 'ec_account', 1, '15', 'account_buyer_credit', 'Account Buyer Credit', 1, 0, 0, 100, 6, 1, 1, 'V~O', 1, NULL, 'BAS'),
(44, 320, 'sfadesktopname', 'ec_sfadesktops', 1, '2', 'sfadesktopname', 'SfaDesktop Name', 1, 0, 0, 100, 1, 104, 1, 'V~M', 0, 1, 'BAS'),
(6, 9, 'account_type', 'ec_account', 1, '15', 'account_type', 'Account Type', 1, 0, 0, 100, 9, 1, 1, 'V~O', 1, 0, 'BAS'),
(6, 12, 'alipay_account', 'ec_account', 1, '1', 'alipay_account', 'Alipay Account', 1, 0, 0, 100, 14, 1, 1, 'V~O', 1, 0, 'BAS'),
(47, 362, 'sfasettingname', 'ec_sfasettings', 1, '2', 'sfasettingname', 'Sfasetting Name', 1, 0, 0, 100, 1, 113, 1, 'V~M', 0, 1, 'BAS'),
(6, 15, 'contact_date', 'ec_account', 1, '70', 'contact_date', 'Contact Date', 1, 0, 0, 100, 17, 1, 2, 'D~O', 1, NULL, 'BAS'),
(6, 16, 'contacttimes', 'ec_account', 1, '1', 'contacttimes', 'Contacttimes', 1, 0, 0, 100, 18, 1, 2, 'I~O', 1, NULL, 'BAS'),
(6, 17, 'vipinfo', 'ec_account', 1, '15', 'vipinfo', 'Vipinfo', 1, 0, 0, 100, 5, 1, 1, 'V~O', 1, NULL, 'BAS'),
(6, 18, 'lastorderdate', 'ec_account', 1, '70', 'lastorderdate', 'LastOrder Date', 1, 0, 0, 100, 20, 3, 2, 'T~O', 1, NULL, 'BAS'),
(6, 19, 'last_logintime', 'ec_account', 1, '70', 'last_logintime', 'Last Logintime', 1, 0, 0, 100, 18, 1, 2, 'T~O', 1, 0, 'BAS'),
(6, 20, 'phone', 'ec_account', 1, '11', 'phone', 'Phone', 1, 0, 0, 100, 15, 1, 1, 'V~O', 0, 2, 'BAS'),
(6, 23, 'email', 'ec_account', 1, '13', 'email', 'Email', 1, 0, 0, 100, 17, 1, 1, 'E~O', 1, NULL, 'BAS'),
(6, 24, 'ordernum', 'ec_account', 1, '1', 'ordernum', 'Ordernum', 1, 0, 0, 100, 1, 3, 2, 'I~O', 1, NULL, 'BAS'),
(6, 25, 'ordertotal', 'ec_account', 1, '1', 'ordertotal', 'Ordertotal', 1, 0, 0, 100, 2, 3, 2, 'N~O', 1, NULL, 'BAS'),
(6, 26, 'buy_pro_num', 'ec_account', 1, '1', 'buy_pro_num', 'Buy Pro Num', 1, 0, 0, 100, 3, 3, 2, 'I~O', 1, NULL, 'BAS'),
(14, 319, 'description', 'ec_products', 1, '19', 'description', 'Description', 1, 0, 0, 100, 7, 47, 1, 'V~O', 1, 1, 'BAS'),
(6, 28, 'bill_state', 'ec_account', 1, '1021', 'bill_state', 'Billing State', 1, 0, 0, 100, 2, 5, 1, 'V~O~::2', 1, NULL, 'BAS'),
(6, 29, 'bill_city', 'ec_account', 1, '1022', 'bill_city', 'Billing City', 1, 0, 0, 100, 3, 5, 1, 'V~O~::2', 1, NULL, 'BAS'),
(6, 30, 'bill_district', 'ec_account', 1, '1023', 'bill_district', 'Billing District', 1, 0, 0, 100, 4, 5, 1, 'V~O~::2', 1, NULL, 'BAS'),
(6, 31, 'bill_street', 'ec_account', 1, '21', 'bill_street', 'Billing Address', 1, 0, 0, 100, 5, 5, 1, 'V~O', 1, NULL, 'BAS'),
(6, 32, 'bill_code', 'ec_account', 1, '1', 'bill_code', 'Billing Code', 1, 0, 0, 100, 6, 5, 1, 'V~O', 1, NULL, 'BAS'),
(6, 33, 'description', 'ec_account', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 6, 1, 'V~O', 1, NULL, 'BAS'),
(47, 372, 'modifiedtime', 'ec_sfasettings', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 113, 2, 'T~O', 1, NULL, 'BAS'),
(6, 36, 'createdtime', 'ec_account', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 32, 7, 2, 'T~O', 1, NULL, 'BAS'),
(6, 37, 'modifiedtime', 'ec_account', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 34, 7, 2, 'T~O', 1, NULL, 'BAS'),
(8, 38, 'title', 'ec_notes', 1, '2', 'notes_title', 'Note Title', 1, 0, 0, 200, 1, 21, 1, 'V~M', 0, 1, 'BAS'),
(8, 39, 'accountid', 'ec_notes', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 2, 21, 1, 'V~M', 0, 1, 'BAS'),
(8, 40, 'notetype', 'ec_notes', 1, '15', 'notetype', 'Note Type', 1, 0, 0, 100, 3, 21, 1, 'V~O', 1, NULL, 'BAS'),
(8, 41, 'contact_date', 'ec_notes', 1, '70', 'contact_date', 'Contact Date', 1, 0, 0, 100, 4, 21, 1, 'D~M', 1, NULL, 'BAS'),
(8, 42, 'notecontent', 'ec_notes', 1, '19', 'notecontent', 'Note', 1, 0, 0, 100, 1, 22, 1, 'V~O', 1, NULL, 'BAS'),
(8, 45, 'createdtime', 'ec_notes', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 3, 23, 2, 'T~O', 1, NULL, 'BAS'),
(8, 46, 'modifiedtime', 'ec_notes', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 4, 23, 2, 'T~O', 1, NULL, 'BAS'),
(14, 47, 'productname', 'ec_products', 1, '2', 'productname', 'Product Name', 1, 0, 0, 100, 1, 41, 1, 'V~M', 1, NULL, 'BAS'),
(14, 48, 'productcode', 'ec_products', 1, '1', 'productcode', 'Product Code', 1, 0, 0, 100, 2, 41, 1, 'V~O', 1, NULL, 'BAS'),
(45, 339, 'potentialid', 'ec_sfalists', 1, '76', 'potential_id', 'Potential Name', 1, 0, 0, 100, 6, 107, 1, 'V~O', 1, NULL, 'BAS'),
(14, 50, 'detail_url', 'ec_products', 1, '1', 'detail_url', 'Detail Url', 1, 0, 0, 100, 5, 41, 1, 'V~O', 1, NULL, 'BAS'),
(14, 51, 'num_iid', 'ec_products', 1, '1', 'num_iid', 'Num Iid', 1, 0, 0, 100, 4, 41, 1, 'V~O', 1, NULL, 'BAS'),
(45, 338, 'salesorderid', 'ec_sfalists', 1, '80', 'salesorder_id', 'Sales Order', 1, 0, 0, 100, 5, 107, 1, 'V~O', 1, NULL, 'BAS'),
(14, 53, 'num', 'ec_products', 1, '1', 'num', 'Num', 1, 0, 0, 100, 7, 41, 1, 'V~O', 1, NULL, 'BAS'),
(45, 337, 'contact_id', 'ec_sfalists', 1, '57', 'contact_id', 'Contact Name', 1, 0, 0, 100, 4, 107, 1, 'V~O', 1, NULL, 'BAS'),
(45, 336, 'accountid', 'ec_sfalists', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 3, 107, 1, 'V~M', 0, 1, 'BAS'),
(45, 334, 'sfalistname', 'ec_sfalists', 1, '2', 'sfalistname', 'Sfalist Name', 1, 0, 0, 100, 1, 107, 1, 'V~M', 0, 1, 'BAS'),
(14, 59, 'price', 'ec_products', 1, '71', 'price', 'Price', 1, 0, 0, 100, 6, 41, 1, 'N~O', 1, NULL, 'BAS'),
(44, 333, 'approved', 'ec_sfadesktops', 1, '1007', 'approved', 'Approve Status', 1, 0, 0, 100, 16, 104, 2, 'I~O', 1, NULL, 'BAS'),
(44, 332, 'approvedby', 'ec_sfadesktops', 1, '1008', 'approvedby', 'Approved By', 1, 0, 0, 100, 15, 104, 2, 'I~O', 1, NULL, 'BAS'),
(44, 331, 'description', 'ec_sfadesktops', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 106, 1, 'V~O', 1, NULL, 'BAS'),
(44, 330, 'modifiedtime', 'ec_sfadesktops', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 104, 2, 'T~O', 1, NULL, 'BAS'),
(44, 329, 'createdtime', 'ec_sfadesktops', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 104, 2, 'T~O', 1, NULL, 'BAS'),
(44, 327, 'purchaseorderid', 'ec_sfadesktops', 1, '79', 'purchaseorder_id', 'Purchase Order', 1, 0, 0, 100, 8, 104, 1, 'V~O', 1, NULL, 'BAS'),
(44, 326, 'vendorid', 'ec_sfadesktops', 1, '81', 'vendor_id', 'Vendor Name', 1, 0, 0, 100, 7, 104, 1, 'V~O', 1, NULL, 'BAS'),
(44, 325, 'potentialid', 'ec_sfadesktops', 1, '76', 'potential_id', 'Potential Name', 1, 0, 0, 100, 6, 104, 1, 'V~O', 1, NULL, 'BAS'),
(44, 324, 'salesorderid', 'ec_sfadesktops', 1, '80', 'salesorder_id', 'Sales Order', 1, 0, 0, 100, 5, 104, 1, 'V~O', 1, NULL, 'BAS'),
(44, 323, 'contact_id', 'ec_sfadesktops', 1, '57', 'contact_id', 'Contact Name', 1, 0, 0, 100, 4, 104, 1, 'V~O', 1, NULL, 'BAS'),
(44, 322, 'accountid', 'ec_sfadesktops', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 3, 104, 1, 'V~M', 0, 1, 'BAS'),
(14, 78, 'createdtime', 'ec_products', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 2, 48, 2, 'T~O', 1, NULL, 'BAS'),
(14, 79, 'modifiedtime', 'ec_products', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 3, 48, 2, 'T~O', 1, NULL, 'BAS'),
(22, 80, 'tid', 'ec_salesorder', 1, '1', 'tid', 'Tid', 1, 0, 0, 100, 1, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 81, 'oid', 'ec_salesorder', 1, '1', 'oid', 'Oid', 1, 0, 0, 100, 2, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 82, 'subject', 'ec_salesorder', 1, '2', 'subject', 'Subject', 1, 0, 0, 100, 3, 61, 1, 'V~M', 1, NULL, 'BAS'),
(22, 83, 'accountid', 'ec_salesorder', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 4, 61, 1, 'I~M', 1, NULL, 'BAS'),
(46, 361, 'approved', 'ec_sfalogs', 1, '1007', 'approved', 'Approve Status', 1, 0, 0, 100, 16, 110, 2, 'I~O', 1, NULL, 'BAS'),
(46, 360, 'approvedby', 'ec_sfalogs', 1, '1008', 'approvedby', 'Approved By', 1, 0, 0, 100, 15, 110, 2, 'I~O', 1, NULL, 'BAS'),
(22, 86, 'orderstatus', 'ec_salesorder', 1, '15', 'orderstatus', 'Order Status', 1, 0, 0, 100, 7, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 87, 'num', 'ec_salesorder', 1, '1', 'num', 'Num', 1, 0, 0, 100, 8, 61, 2, 'V~O', 1, NULL, 'BAS'),
(22, 88, 'shipping_type', 'ec_salesorder', 1, '15', 'shipping_type', 'Shipping Type', 1, 0, 0, 100, 9, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 89, 'pay_type', 'ec_salesorder', 1, '15', 'pay_type', 'Pay Type', 1, 0, 0, 100, 10, 61, 1, 'V~O', 1, NULL, 'BAS'),
(46, 359, 'description', 'ec_sfalogs', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 112, 1, 'V~O', 1, NULL, 'BAS'),
(46, 358, 'modifiedtime', 'ec_sfalogs', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 110, 2, 'T~O', 1, NULL, 'BAS'),
(22, 92, 'postage', 'ec_salesorder', 1, '71', 'postage', 'Postage', 1, 0, 0, 100, 13, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 93, 'pay_time', 'ec_salesorder', 1, '1', 'pay_time', 'Pay Time', 1, 0, 0, 100, 14, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 94, 'total', 'ec_salesorder', 1, '71', 'total', 'Total', 1, 0, 0, 100, 15, 61, 2, 'V~O', 1, NULL, 'BAS'),
(22, 95, 'payment', 'ec_salesorder', 1, '71', 'payment', 'Payment', 1, 0, 0, 100, 16, 61, 2, 'V~O', 1, NULL, 'BAS'),
(22, 96, 'sku_properties_name', 'ec_salesorder', 1, '1', 'sku_properties_name', 'Sku Properties Name', 1, 0, 0, 100, 17, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 97, 'express_agency_fee', 'ec_salesorder', 1, '71', 'express_agency_fee', 'Express Agency Fee', 1, 0, 0, 100, 18, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 98, 'invoice_name', 'ec_salesorder', 1, '1', 'invoice_name', 'Invoice Name', 1, 0, 0, 100, 19, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 99, 'buyer_nick', 'ec_salesorder', 1, '1', 'buyer_nick', 'Buyer Nick', 1, 0, 0, 100, 1, 62, 1, 'V~O', 1, NULL, 'BAS'),
(22, 100, 'buyer_alipay_no', 'ec_salesorder', 1, '1', 'buyer_alipay_no', 'Buyer Alipay No', 1, 0, 0, 100, 2, 62, 1, 'V~O', 1, NULL, 'BAS'),
(22, 101, 'buyer_memo', 'ec_salesorder', 1, '1', 'buyer_memo', 'Buyer Memo', 1, 0, 0, 100, 3, 62, 1, 'V~O', 1, NULL, 'BAS'),
(22, 103, 'buyer_rate', 'ec_salesorder', 1, '15', 'buyer_rate', 'Buyer Rate', 1, 0, 0, 100, 6, 62, 1, 'V~O', 1, NULL, 'BAS'),
(22, 104, 'buyer_credit', 'ec_salesorder', 1, '15', 'buyer_credit', 'Buyer Credit', 1, 0, 0, 100, 7, 62, 1, 'V~O', 1, 0, 'BAS'),
(22, 105, 'buyer_message', 'ec_salesorder', 1, '1', 'buyer_message', 'Buyer Message', 1, 0, 0, 100, 8, 62, 1, 'V~O', 1, NULL, 'BAS'),
(22, 106, 'receiver_name', 'ec_salesorder', 1, '1', 'receiver_name', 'Receiver Name', 1, 0, 0, 100, 1, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 107, 'receiver_state', 'ec_salesorder', 1, '1', 'receiver_state', 'Receiver State', 1, 0, 0, 100, 3, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 108, 'receiver_city', 'ec_salesorder', 1, '1', 'receiver_city', 'Receiver City', 1, 0, 0, 100, 4, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 109, 'receiver_district', 'ec_salesorder', 1, '1', 'receiver_district', 'Receiver District', 1, 0, 0, 100, 5, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 110, 'receiver_street', 'ec_salesorder', 1, '1', 'receiver_street', 'Receiver Street', 1, 0, 0, 100, 6, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 111, 'receiver_code', 'ec_salesorder', 1, '1', 'receiver_code', 'Receiver Code', 1, 0, 0, 100, 7, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 112, 'receiver_phone', 'ec_salesorder', 1, '1', 'receiver_phone', 'Receiver Phone', 1, 0, 0, 100, 8, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 113, 'receiver_tel', 'ec_salesorder', 1, '1', 'receiver_tel', 'Receiver Tel', 1, 0, 0, 100, 9, 64, 1, 'V~O', 1, NULL, 'BAS'),
(22, 114, 'seller_name', 'ec_salesorder', 1, '1', 'seller_name', 'Seller Name', 1, 0, 0, 100, 1, 65, 1, 'V~O', 1, NULL, 'BAS'),
(46, 357, 'createdtime', 'ec_sfalogs', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 110, 2, 'T~O', 1, NULL, 'BAS'),
(46, 355, 'purchaseorderid', 'ec_sfalogs', 1, '79', 'purchaseorder_id', 'Purchase Order', 1, 0, 0, 100, 8, 110, 1, 'V~O', 1, NULL, 'BAS'),
(46, 354, 'vendorid', 'ec_sfalogs', 1, '81', 'vendor_id', 'Vendor Name', 1, 0, 0, 100, 7, 110, 1, 'V~O', 1, NULL, 'BAS'),
(22, 119, 'consign_time', 'ec_salesorder', 1, '1', 'consign_time', 'Consign Time', 1, 0, 0, 100, 20, 61, 1, 'V~O', 1, NULL, 'BAS'),
(46, 353, 'potentialid', 'ec_sfalogs', 1, '76', 'potential_id', 'Potential Name', 1, 0, 0, 100, 6, 110, 1, 'V~O', 1, NULL, 'BAS'),
(46, 352, 'salesorderid', 'ec_sfalogs', 1, '80', 'salesorder_id', 'Sales Order', 1, 0, 0, 100, 5, 110, 1, 'V~O', 1, NULL, 'BAS'),
(46, 351, 'contact_id', 'ec_sfalogs', 1, '57', 'contact_id', 'Contact Name', 1, 0, 0, 100, 4, 110, 1, 'V~O', 1, NULL, 'BAS'),
(22, 123, 'seller_rate', 'ec_salesorder', 1, '15', 'seller_rate', 'Seller Rate', 1, 0, 0, 100, 21, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 124, 'adjust_fee', 'ec_salesorder', 1, '71', 'adjust_fee', 'Adjust Fee', 1, 0, 0, 100, 12, 65, 1, 'V~O', 1, NULL, 'BAS'),
(22, 125, 'received_payment', 'ec_salesorder', 1, '71', 'received_payment', 'Received Payment', 1, 0, 0, 100, 13, 65, 1, 'V~O', 1, NULL, 'BAS'),
(46, 350, 'accountid', 'ec_sfalogs', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 3, 110, 1, 'V~M', 0, 1, 'BAS'),
(46, 348, 'sfalogname', 'ec_sfalogs', 1, '2', 'sfalogname', 'Sfalog Name', 1, 0, 0, 100, 1, 110, 1, 'V~M', 0, 1, 'BAS'),
(45, 347, 'approved', 'ec_sfalists', 1, '1007', 'approved', 'Approve Status', 1, 0, 0, 100, 16, 107, 2, 'I~O', 1, NULL, 'BAS'),
(45, 346, 'approvedby', 'ec_sfalists', 1, '1008', 'approvedby', 'Approved By', 1, 0, 0, 100, 15, 107, 2, 'I~O', 1, NULL, 'BAS'),
(45, 345, 'description', 'ec_sfalists', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 109, 1, 'V~O', 1, NULL, 'BAS'),
(45, 344, 'modifiedtime', 'ec_sfalists', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 107, 2, 'T~O', 1, NULL, 'BAS'),
(45, 343, 'createdtime', 'ec_sfalists', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 107, 2, 'T~O', 1, NULL, 'BAS'),
(45, 341, 'purchaseorderid', 'ec_sfalists', 1, '79', 'purchaseorder_id', 'Purchase Order', 1, 0, 0, 100, 8, 107, 1, 'V~O', 1, NULL, 'BAS'),
(45, 340, 'vendorid', 'ec_sfalists', 1, '81', 'vendor_id', 'Vendor Name', 1, 0, 0, 100, 7, 107, 1, 'V~O', 1, NULL, 'BAS'),
(22, 139, 'item_meal_name', 'ec_salesorder', 1, '1', 'item_meal_name', 'Item Meal Name', 1, 0, 0, 100, 19, 61, 1, 'V~O', 1, NULL, 'BAS'),
(22, 140, 'promotion_name', 'ec_salesorder', 1, '1', 'promotion_name', 'Promotion Name', 1, 0, 0, 100, 1, 68, 1, 'V~O', 1, NULL, 'BAS'),
(22, 141, 'discount_fee', 'ec_salesorder', 1, '71', 'discount_fee', 'Discount Fee', 1, 0, 0, 100, 2, 68, 1, 'V~O', 1, NULL, 'BAS'),
(22, 142, 'gift_item_name', 'ec_salesorder', 1, '1', 'gift_item_name', 'Gift Item Name', 1, 0, 0, 100, 3, 68, 1, 'V~O', 1, NULL, 'BAS'),
(22, 143, 'wl_no', 'ec_salesorder', 1, '1', 'wl_no', 'WL No', 1, 0, 0, 100, 1, 69, 1, 'V~O', 1, NULL, 'BAS'),
(22, 144, 'wl_company', 'ec_salesorder', 1, '1', 'wl_company', 'WL Company', 1, 0, 0, 100, 2, 69, 1, 'V~O', 1, NULL, 'BAS'),
(22, 145, 'description', 'ec_salesorder', 1, '19', 'description', 'Description', 1, 0, 0, 100, 20, 70, 1, 'V~O', 1, NULL, 'BAS'),
(47, 371, 'createdtime', 'ec_sfasettings', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 113, 2, 'T~O', 1, NULL, 'BAS'),
(22, 148, 'createdtime', 'ec_salesorder', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 3, 71, 2, 'T~O', 1, NULL, 'BAS'),
(22, 149, 'modifiedtime', 'ec_salesorder', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 4, 71, 2, 'T~O', 1, NULL, 'BAS'),
(29, 150, 'user_name', 'ec_users', 1, '106', 'user_name', 'User Name', 1, 0, 0, 11, 1, 79, 1, 'V~M', 1, NULL, 'BAS'),
(29, 151, 'is_admin', 'ec_users', 1, '156', 'is_admin', 'Admin', 1, 0, 0, 3, 2, 79, 1, 'V~O', 1, NULL, 'BAS'),
(29, 152, 'user_password', 'ec_users', 1, '99', 'user_password', 'Password', 1, 0, 0, 30, 3, 79, 4, 'P~M', 1, NULL, 'BAS'),
(29, 153, 'confirm_password', 'ec_users', 1, '99', 'confirm_password', 'Confirm Password', 1, 0, 0, 30, 5, 79, 4, 'P~M', 1, NULL, 'BAS'),
(29, 154, 'last_name', 'ec_users', 1, '2', 'last_name', 'Last Name', 1, 0, 0, 30, 9, 79, 1, 'V~M', 1, NULL, 'BAS'),
(29, 155, 'roleid', 'ec_user2role', 1, '98', 'roleid', 'Role', 1, 0, 0, 200, 11, 79, 1, 'V~M', 1, NULL, 'BAS'),
(29, 156, 'email1', 'ec_users', 1, '104', 'email1', 'Email', 1, 0, 0, 100, 4, 79, 1, 'E~M', 1, NULL, 'BAS'),
(29, 157, 'status', 'ec_users', 1, '115', 'status', 'Status', 1, 0, 0, 100, 6, 79, 1, 'V~O', 1, NULL, 'BAS'),
(29, 158, 'currency_id', 'ec_users', 1, '116', 'currency_id', 'Currency', 1, 0, 0, 100, 8, 79, 1, 'I~O', 1, NULL, 'BAS'),
(29, 159, 'hour_format', 'ec_users', 1, '116', 'hour_format', 'Calendar Hour Format', 1, 0, 0, 100, 13, 79, 3, 'I~O', 1, NULL, 'BAS'),
(29, 160, 'end_hour', 'ec_users', 1, '116', 'end_hour', 'Day ends at', 1, 0, 0, 100, 15, 79, 3, 'I~O', 1, NULL, 'BAS'),
(29, 161, 'start_hour', 'ec_users', 1, '116', 'start_hour', 'Day starts at', 1, 0, 0, 100, 14, 79, 3, 'I~O', 1, NULL, 'BAS'),
(29, 162, 'title', 'ec_users', 1, '1', 'title', 'Title', 1, 0, 0, 50, 1, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 163, 'phone_work', 'ec_users', 1, '1', 'phone_work', 'Office Phone', 1, 0, 0, 50, 5, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 164, 'phone_mobile', 'ec_users', 1, '1', 'phone_mobile', 'Mobile', 1, 0, 0, 50, 7, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 165, 'reports_to_id', 'ec_users', 1, '101', 'reports_to_id', 'Reports To', 1, 0, 0, 50, 8, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 166, 'phone_other', 'ec_users', 1, '1', 'phone_other', 'Other Phone', 1, 0, 0, 50, 11, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 167, 'email2', 'ec_users', 1, '13', 'email2', 'Other Email', 1, 0, 0, 100, 4, 80, 1, 'E~O', 1, NULL, 'BAS'),
(29, 168, 'phone_fax', 'ec_users', 1, '1', 'phone_fax', 'Fax', 1, 0, 0, 50, 2, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 169, 'yahoo_id', 'ec_users', 1, '13', 'yahoo_id', 'Yahoo id', 1, 0, 0, 100, 6, 80, 1, 'E~O', 1, NULL, 'BAS'),
(29, 170, 'phone_home', 'ec_users', 1, '1', 'phone_home', 'Home Phone', 1, 0, 0, 50, 9, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 171, 'date_format', 'ec_users', 1, '15', 'date_format', 'Date Format', 1, 0, 0, 30, 12, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 172, 'signature', 'ec_users', 1, '21', 'signature', 'Signature', 1, 0, 0, 250, 13, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 173, 'description', 'ec_users', 1, '21', 'description', 'Description', 1, 0, 0, 250, 14, 80, 1, 'V~O', 1, NULL, 'BAS'),
(29, 174, 'address_street', 'ec_users', 1, '21', 'address_street', 'Street Address', 1, 0, 0, 250, 1, 81, 1, 'V~O', 1, NULL, 'BAS'),
(29, 175, 'address_city', 'ec_users', 1, '1', 'address_city', 'City', 1, 0, 0, 100, 3, 81, 1, 'V~O', 1, NULL, 'BAS'),
(29, 176, 'address_state', 'ec_users', 1, '1', 'address_state', 'State', 1, 0, 0, 100, 5, 81, 1, 'V~O', 1, NULL, 'BAS'),
(29, 177, 'address_postalcode', 'ec_users', 1, '1', 'address_postalcode', 'Postal Code', 1, 0, 0, 100, 4, 81, 1, 'V~O', 1, NULL, 'BAS'),
(29, 178, 'address_country', 'ec_users', 1, '1', 'address_country', 'Country', 1, 0, 0, 100, 2, 81, 1, 'V~O', 1, NULL, 'BAS'),
(33, 179, 'qunfaname', 'ec_qunfas', 1, '2', 'qunfaname', 'Qunfa Name', 1, 0, 0, 100, 1, 84, 1, 'V~M', 0, 1, 'BAS'),
(33, 181, 'accountid', 'ec_qunfas', 1, '19', 'accountid', 'Account Name', 1, 0, 0, 100, 3, 103, 1, 'V~O', 0, 1, 'BAS'),
(37, 296, 'potentialid', 'ec_relsettings', 1, '76', 'potential_id', 'Potential Name', 1, 0, 0, 100, 6, 99, 1, 'V~O', 1, NULL, 'BAS'),
(34, 285, 'subject', 'ec_maillists', 1, '1', 'subject', '邮件主题', 1, 0, 0, 100, 5, 98, 1, 'V~O', 1, 0, 'BAS'),
(33, 188, 'createdtime', 'ec_qunfas', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 84, 2, 'T~O', 1, NULL, 'BAS'),
(33, 189, 'modifiedtime', 'ec_qunfas', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 84, 2, 'T~O', 1, NULL, 'BAS'),
(33, 190, 'description', 'ec_qunfas', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 86, 1, 'V~O', 1, NULL, 'BAS'),
(34, 193, 'maillistname', 'ec_maillists', 1, '2', 'maillistname', 'Maillist Name', 1, 0, 0, 100, 1, 87, 1, 'V~M', 0, 1, 'BAS'),
(34, 195, 'accountid', 'ec_maillists', 1, '19', 'accountid', 'Account Name', 1, 0, 0, 100, 1, 102, 1, 'V~O', 0, 1, 'BAS'),
(37, 294, 'contact_id', 'ec_relsettings', 1, '57', 'contact_id', 'Contact Name', 1, 0, 0, 100, 4, 99, 1, 'V~O', 1, NULL, 'BAS'),
(37, 295, 'salesorderid', 'ec_relsettings', 1, '80', 'salesorder_id', 'Sales Order', 1, 0, 0, 100, 5, 99, 1, 'V~O', 1, NULL, 'BAS'),
(34, 278, 'from_name', 'ec_maillists', 1, '1', 'from_name', '发件人', 1, 0, 0, 100, 2, 98, 1, 'V~O', 1, 0, 'BAS'),
(33, 253, 'msg', 'ec_qunfas', 1, '1', 'msg', '群发短信内容', 1, 0, 0, 100, 5, 96, 1, 'V~O', 1, 0, 'BAS'),
(34, 202, 'createdtime', 'ec_maillists', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 87, 2, 'T~O', 1, NULL, 'BAS'),
(34, 203, 'modifiedtime', 'ec_maillists', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 87, 2, 'T~O', 1, NULL, 'BAS'),
(34, 204, 'description', 'ec_maillists', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 89, 1, 'V~O', 1, NULL, 'BAS'),
(37, 293, 'accountid', 'ec_relsettings', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 3, 99, 1, 'V~M', 0, 1, 'BAS'),
(35, 207, 'qunfatmpname', 'ec_qunfatmps', 1, '2', 'qunfatmpname', 'Qunfatmp Name', 1, 0, 0, 100, 1, 90, 1, 'V~M', 0, 1, 'BAS'),
(36, 221, 'maillisttmpname', 'ec_maillisttmps', 1, '2', 'maillisttmpname', 'Maillisttmp Name', 1, 0, 0, 100, 1, 93, 1, 'V~M', 0, 1, 'BAS'),
(35, 216, 'createdtime', 'ec_qunfatmps', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 90, 2, 'T~O', 1, NULL, 'BAS'),
(35, 217, 'modifiedtime', 'ec_qunfatmps', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 90, 2, 'T~O', 1, NULL, 'BAS'),
(35, 218, 'description', 'ec_qunfatmps', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 92, 1, 'V~O', 1, NULL, 'BAS'),
(35, 219, 'approvedby', 'ec_qunfatmps', 1, '1008', 'approvedby', 'Approved By', 1, 0, 0, 100, 15, 90, 2, 'I~O', 1, NULL, 'BAS'),
(35, 220, 'approved', 'ec_qunfatmps', 1, '1007', 'approved', 'Approve Status', 1, 0, 0, 100, 16, 90, 2, 'I~O', 1, NULL, 'BAS'),
(36, 230, 'createdtime', 'ec_maillisttmps', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 93, 2, 'T~O', 1, NULL, 'BAS'),
(36, 231, 'modifiedtime', 'ec_maillisttmps', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 93, 2, 'T~O', 1, NULL, 'BAS'),
(36, 232, 'description', 'ec_maillisttmps', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 95, 1, 'V~O', 1, NULL, 'BAS'),
(34, 289, 'mailcontent', 'ec_maillists', 1, '19', 'mailcontent', '邮件内容', 1, 0, 0, 100, 5, 97, 1, 'V~O', 1, 0, 'BAS'),
(37, 291, 'relsettingname', 'ec_relsettings', 1, '2', 'relsettingname', 'Relsetting Name', 1, 0, 0, 100, 1, 99, 1, 'V~M', 0, 1, 'BAS'),
(37, 297, 'vendorid', 'ec_relsettings', 1, '81', 'vendor_id', 'Vendor Name', 1, 0, 0, 100, 7, 99, 1, 'V~O', 1, NULL, 'BAS'),
(37, 298, 'purchaseorderid', 'ec_relsettings', 1, '79', 'purchaseorder_id', 'Purchase Order', 1, 0, 0, 100, 8, 99, 1, 'V~O', 1, NULL, 'BAS'),
(14, 377, 'outer_id', 'ec_products', 1, '1', 'outer_id', '商家编码', 1, 0, 0, 100, 3, 41, 1, 'V~O', 1, 0, 'BAS'),
(37, 300, 'createdtime', 'ec_relsettings', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 99, 2, 'T~O', 1, NULL, 'BAS'),
(37, 301, 'modifiedtime', 'ec_relsettings', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 99, 2, 'T~O', 1, NULL, 'BAS'),
(37, 302, 'description', 'ec_relsettings', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 101, 1, 'V~O', 1, NULL, 'BAS'),
(37, 303, 'approvedby', 'ec_relsettings', 1, '1008', 'approvedby', 'Approved By', 1, 0, 0, 100, 15, 99, 2, 'I~O', 1, NULL, 'BAS'),
(37, 304, 'approved', 'ec_relsettings', 1, '1007', 'approved', 'Approve Status', 1, 0, 0, 100, 16, 99, 2, 'I~O', 1, NULL, 'BAS'),
(6, 305, 'oneweekbuy', 'ec_account', 1, '1', 'oneweekbuy', '最近一周购买次数', 1, 0, 0, 100, 21, 3, 2, 'I~O', 1, 0, 'BAS'),
(6, 306, 'onemonthbuy', 'ec_account', 1, '1', 'onemonthbuy', '最近一月购买次数', 1, 0, 0, 100, 22, 3, 2, 'I~O', 1, 0, 'BAS'),
(6, 307, 'threemonthbuy', 'ec_account', 1, '1', 'threemonthbuy', '最近三月购买次数', 1, 0, 0, 100, 23, 3, 2, 'I~O', 1, 0, 'BAS'),
(6, 308, 'oneweeksendmess', 'ec_account', 1, '1', 'oneweeksendmess', '最近一周发送短信次数', 1, 0, 0, 100, 1, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 309, 'onemonthsendmess', 'ec_account', 1, '1', 'onemonthsendmess', '最近一月发送短信次数', 1, 0, 0, 100, 3, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 310, 'threemonthsendmess', 'ec_account', 1, '1', 'threemonthsendmess', '最近三月发送短信次数', 1, 0, 0, 100, 5, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 311, 'oneweeksendmail', 'ec_account', 1, '1', 'oneweeksendmail', '最近5天发送邮件次数', 1, 0, 0, 100, 2, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 312, 'onemonthsendmail', 'ec_account', 1, '1', 'onemonthsendmail', '最近一月发送邮件次数', 1, 0, 0, 100, 4, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 313, 'threemonthsendmail', 'ec_account', 1, '1', 'threemonthsendmail', '最近三月发送邮件次数', 1, 0, 0, 100, 6, 7, 2, 'I~O', 1, 0, 'BAS'),
(6, 314, 'lastsendmessdate', 'ec_account', 1, '5', 'lastsendmessdate', '最新发送短信日期', 1, 0, 0, 100, 8, 7, 2, 'D~O', 1, 0, 'BAS'),
(6, 315, 'lastsendmaildate', 'ec_account', 1, '5', 'lastsendmaildate', '最新发送邮件日期', 1, 0, 0, 100, 10, 7, 2, 'D~O', 1, 0, 'BAS'),
(6, 316, 'allsuccessbuy', 'ec_account', 1, '1', 'allsuccessbuy', '总共成功购买次数', 1, 0, 0, 100, 7, 3, 2, 'I~O', 1, 0, 'BAS'),
(6, 376, 'tel', 'ec_account', 1, '1', 'tel', '电话', 1, 0, 0, 100, 16, 1, 1, 'V~O', 1, 0, 'BAS'),
(48, 378, 'description', 'ec_memdays', 1, '19', 'description', 'Description', 1, 0, 0, 100, 1, 116, 1, 'V~O', 0, 1, 'BAS'),
(48, 379, 'memdayname', 'ec_memdays', 1, '2', 'memdayname', 'Memday Name', 1, 0, 0, 100, 1, 117, 1, 'V~M', 0, 1, 'BAS'),
(48, 380, 'smownerid', 'ec_memdays', 1, '53', 'assigned_user_id', 'Assigned To', 1, 0, 0, 100, 2, 117, 2, 'V~M', 0, 1, 'BAS'),
(48, 381, 'memday946', 'ec_memdays', 1, '1', 'memday946', '下次提醒', 1, 0, 0, 100, 10, 117, 2, 'V~O~LE~50', 0, 1, 'BAS'),
(48, 383, 'modifiedtime', 'ec_memdays', 1, '70', 'modifiedtime', 'Modified Time', 1, 0, 0, 100, 14, 117, 2, 'T~O', 0, 1, 'BAS'),
(48, 384, 'accountid', 'ec_memdays', 1, '51', 'account_id', 'Account Name', 1, 0, 0, 100, 3, 117, 1, 'V~M', 0, 1, 'BAS'),
(48, 385, 'createdtime', 'ec_memdays', 1, '70', 'createdtime', 'Created Time', 1, 0, 0, 100, 13, 117, 2, 'T~O', 0, 1, 'BAS'),
(48, 386, 'smcreatorid', 'ec_memdays', 1, '1004', 'smcreatorid', 'smcreator', 1, 0, 0, 100, 9, 117, 2, 'V~M', 0, 1, 'BAS'),
(48, 387, 'memday938', 'ec_memdays', 1, '15', 'memday938', '纪念日类型', 1, 0, 0, 100, 5, 117, 1, 'V~O', 0, 1, 'BAS'),
(48, 388, 'memday940', 'ec_memdays', 1, '15', 'memday940', '纪念日', 1, 0, 0, 100, 7, 117, 1, 'V~O', 0, 1, 'BAS'),
(48, 389, 'memday1004', 'ec_memdays', 1, '15', 'memday1004', '日历类型', 1, 0, 0, 100, 6, 117, 1, 'V~O', 0, 1, 'BAS');

-- --------------------------------------------------------

--
-- 表的结构 `ec_field_seq`
--

CREATE TABLE IF NOT EXISTS `ec_field_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_field_seq`
--

INSERT INTO `ec_field_seq` (`id`) VALUES
(389);

-- --------------------------------------------------------

--
-- 表的结构 `ec_import_maps`
--

CREATE TABLE IF NOT EXISTS `ec_import_maps` (
  `id` int(19) NOT NULL,
  `name` varchar(36) NOT NULL,
  `module` varchar(36) NOT NULL,
  `content` longblob,
  `has_header` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assigned_user_id` varchar(36) DEFAULT NULL,
  `is_published` varchar(3) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `import_maps_assigned_user_id_module_name_deleted_idx` (`assigned_user_id`,`module`,`name`,`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_import_maps`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_inventoryproductrel`
--

CREATE TABLE IF NOT EXISTS `ec_inventoryproductrel` (
  `id` int(19) DEFAULT NULL,
  `productid` int(19) DEFAULT NULL,
  `sequence_no` int(4) DEFAULT NULL,
  `quantity` decimal(11,2) DEFAULT NULL,
  `listprice` decimal(11,2) DEFAULT NULL,
  `discount_percent` decimal(11,2) DEFAULT NULL,
  `discount_amount` decimal(11,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `pricebookid` int(19) DEFAULT NULL,
  KEY `inventoryproductrel_id_idx` (`id`),
  KEY `inventoryproductrel_productid_idx` (`productid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_inventoryproductrel`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_loginhistory`
--

CREATE TABLE IF NOT EXISTS `ec_loginhistory` (
  `login_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_ip` varchar(25) NOT NULL,
  `logout_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_loginhistory`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_loginhistory_seq`
--

CREATE TABLE IF NOT EXISTS `ec_loginhistory_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_loginhistory_seq`
--

INSERT INTO `ec_loginhistory_seq` (`id`) VALUES
(161);

-- --------------------------------------------------------

--
-- 表的结构 `ec_maillists`
--

CREATE TABLE IF NOT EXISTS `ec_maillists` (
  `maillistsid` int(19) NOT NULL DEFAULT '0',
  `maillistname` varchar(250) NOT NULL,
  `accountid` varchar(255) DEFAULT '0',
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `description` text,
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `from_name` varchar(100) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `mailcontent` text,
  PRIMARY KEY (`maillistsid`),
  KEY `maillists_maillistname_idx` (`maillistname`),
  KEY `maillists_maillistsid_idx` (`maillistsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_maillists`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_maillists_seq`
--

CREATE TABLE IF NOT EXISTS `ec_maillists_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_maillists_seq`
--

INSERT INTO `ec_maillists_seq` (`id`) VALUES
(155);

-- --------------------------------------------------------

--
-- 表的结构 `ec_maillisttmps`
--

CREATE TABLE IF NOT EXISTS `ec_maillisttmps` (
  `maillisttmpsid` int(19) NOT NULL DEFAULT '0',
  `maillisttmpname` varchar(250) NOT NULL,
  `accountid` int(19) DEFAULT '0',
  `contact_id` int(19) DEFAULT '0',
  `potentialid` int(19) DEFAULT '0',
  `salesorderid` int(19) DEFAULT '0',
  `vendorid` int(19) DEFAULT '0',
  `purchaseorderid` int(19) DEFAULT '0',
  `total` decimal(11,2) DEFAULT NULL,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `groupid` int(19) DEFAULT '0',
  `description` text,
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `approved` int(1) DEFAULT '0',
  `approvedby` int(19) DEFAULT '0',
  PRIMARY KEY (`maillisttmpsid`),
  KEY `maillisttmps_maillisttmpname_idx` (`maillisttmpname`),
  KEY `maillisttmps_maillisttmpsid_idx` (`maillisttmpsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_maillisttmps`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_mailsets`
--

CREATE TABLE IF NOT EXISTS `ec_mailsets` (
  `id` int(19) NOT NULL,
  `sendperson` varchar(50) DEFAULT NULL,
  `sendmail` varchar(100) DEFAULT NULL,
  `smownerid` int(19) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_mailsets`
--

INSERT INTO `ec_mailsets` (`id`, `sendperson`, `sendmail`, `smownerid`) VALUES
(7, '张三', 'zhangsan@sina.com', 8);

-- --------------------------------------------------------

--
-- 表的结构 `ec_mailsets_seq`
--

CREATE TABLE IF NOT EXISTS `ec_mailsets_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_mailsets_seq`
--

INSERT INTO `ec_mailsets_seq` (`id`) VALUES
(7);

-- --------------------------------------------------------

--
-- 表的结构 `ec_memdays`
--

CREATE TABLE IF NOT EXISTS `ec_memdays` (
  `memdaysid` int(19) NOT NULL DEFAULT '0',
  `description` text,
  `memdayname` varchar(250) DEFAULT NULL,
  `memday946` varchar(250) DEFAULT NULL,
  `contact_id` int(19) DEFAULT NULL,
  `accountid` int(19) DEFAULT NULL,
  `memday938` varchar(255) DEFAULT NULL,
  `memday940` varchar(255) DEFAULT NULL,
  `memday1004` varchar(255) DEFAULT NULL,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `groupid` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `approved` int(1) DEFAULT '0',
  `approvedby` int(19) DEFAULT '0',
  PRIMARY KEY (`memdaysid`),
  KEY `memdays_memdayname_idx` (`memdayname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_memdays`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_message`
--

CREATE TABLE IF NOT EXISTS `ec_message` (
  `id` int(19) NOT NULL,
  `recipient` int(19) DEFAULT NULL,
  `sender` int(19) DEFAULT NULL,
  `message` text,
  `type` text,
  `stamp` text,
  `received` int(1) DEFAULT '0',
  `deleted_sender` int(1) DEFAULT '0',
  `deleted_recipient` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_message`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_messageaccount`
--

CREATE TABLE IF NOT EXISTS `ec_messageaccount` (
  `id` int(19) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `smownerid` int(19) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_messageaccount`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_message_seq`
--

CREATE TABLE IF NOT EXISTS `ec_message_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_message_seq`
--

INSERT INTO `ec_message_seq` (`id`) VALUES
(8);

-- --------------------------------------------------------

--
-- 表的结构 `ec_moduleentityrel`
--

CREATE TABLE IF NOT EXISTS `ec_moduleentityrel` (
  `crmid` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `relcrmid` int(11) NOT NULL,
  `relmodule` varchar(100) NOT NULL,
  KEY `module_crmid_idx` (`crmid`),
  KEY `module_relcrmid_idx` (`relcrmid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_moduleentityrel`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_modulelist`
--

CREATE TABLE IF NOT EXISTS `ec_modulelist` (
  `tabid` int(19) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `filememo` varchar(100) DEFAULT NULL,
  UNIQUE KEY `modulelist_tabidtype_idx` (`tabid`,`type`,`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_modulelist`
--

INSERT INTO `ec_modulelist` (`tabid`, `type`, `filename`, `filememo`) VALUES
(20, 'productfield', '', NULL),
(21, 'productfield', '', NULL),
(22, 'productfield', '', NULL),
(23, 'productfield', '', NULL),
(22, 'template', 'SalesOrderHtmlTemplate', NULL),
(8, 'template', 'NoteHtmlTemplate', NULL),
(33, 'approve', '', NULL),
(33, 'template', 'QunfaHtmlTemplate', NULL),
(34, 'approve', '', NULL),
(34, 'template', 'MaillistHtmlTemplate', NULL),
(35, 'approve', '', NULL),
(35, 'template', 'QunfatmpHtmlTemplate', NULL),
(36, 'approve', '', NULL),
(36, 'template', 'MaillisttmpHtmlTemplate', NULL),
(37, 'approve', '', NULL),
(37, 'template', 'RelsettingHtmlTemplate', NULL),
(44, 'approve', '', NULL),
(44, 'template', 'SfaDesktopHtmlTemplate', NULL),
(45, 'approve', '', NULL),
(45, 'template', 'SfalistHtmlTemplate', NULL),
(46, 'approve', '', NULL),
(46, 'template', 'SfalogHtmlTemplate', NULL),
(47, 'approve', '', NULL),
(47, 'template', 'SfasettingHtmlTemplate', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ec_multifield`
--

CREATE TABLE IF NOT EXISTS `ec_multifield` (
  `multifieldid` int(19) NOT NULL,
  `tabid` int(19) NOT NULL DEFAULT '0',
  `totallevel` int(11) NOT NULL DEFAULT '2',
  `multifieldname` varchar(255) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  PRIMARY KEY (`multifieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_multifield`
--

INSERT INTO `ec_multifield` (`multifieldid`, `tabid`, `totallevel`, `multifieldname`, `tablename`) VALUES
(1, 6, 3, '省市区', 'ec_bill_country'),
(2, 6, 3, '省市区', 'ec_bill_country');

-- --------------------------------------------------------

--
-- 表的结构 `ec_multifield_seq`
--

CREATE TABLE IF NOT EXISTS `ec_multifield_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_multifield_seq`
--

INSERT INTO `ec_multifield_seq` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- 表的结构 `ec_notes`
--

CREATE TABLE IF NOT EXISTS `ec_notes` (
  `notesid` int(19) NOT NULL DEFAULT '0',
  `accountid` int(19) DEFAULT '0',
  `title` varchar(250) NOT NULL,
  `notetype` varchar(50) DEFAULT NULL,
  `contact_date` datetime DEFAULT NULL,
  `notecontent` text,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`notesid`),
  KEY `notes_title_idx` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_notes`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_parenttab`
--

CREATE TABLE IF NOT EXISTS `ec_parenttab` (
  `parenttabid` int(19) NOT NULL,
  `parenttab_label` varchar(100) NOT NULL,
  `sequence` int(10) NOT NULL,
  `visible` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`parenttabid`),
  KEY `parenttab_parenttabid_parenttabl_label_visible_idx` (`parenttabid`,`parenttab_label`,`visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_parenttab`
--

INSERT INTO `ec_parenttab` (`parenttabid`, `parenttab_label`, `sequence`, `visible`) VALUES
(3, 'Customer', 3, 0),
(4, 'Product', 4, 0),
(5, 'Sales', 5, 0),
(6, 'Marketing', 6, 0),
(12, 'report', 7, 0),
(11, 'Settings', 11, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ec_parenttabrel`
--

CREATE TABLE IF NOT EXISTS `ec_parenttabrel` (
  `parenttabid` int(3) NOT NULL,
  `tabid` int(3) NOT NULL,
  `sequence` int(3) NOT NULL,
  KEY `parenttabrel_tabid_parenttabid_idx` (`tabid`,`parenttabid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_parenttabrel`
--

INSERT INTO `ec_parenttabrel` (`parenttabid`, `tabid`, `sequence`) VALUES
(1, 3, 1),
(1, 9, 2),
(1, 28, 3),
(1, 37, 10),
(11, 37, 2),
(3, 8, 2),
(3, 6, 1),
(4, 14, 2),
(4, 19, 3),
(5, 2, 2),
(5, 20, 4),
(5, 22, 5),
(5, 23, 6),
(1, 33, 10),
(1, 34, 10),
(10, 25, 2),
(1, 35, 10),
(6, 36, 2),
(1, 36, 10),
(6, 34, 1),
(11, 0, 1),
(10, 38, 2),
(12, 41, 5),
(10, 39, 2),
(12, 40, 4),
(10, 40, 2),
(12, 39, 3),
(10, 41, 2),
(12, 42, 2),
(10, 42, 2),
(12, 38, 1),
(10, 43, 2),
(12, 43, 6),
(3, 48, 5);

-- --------------------------------------------------------

--
-- 表的结构 `ec_picklist`
--

CREATE TABLE IF NOT EXISTS `ec_picklist` (
  `id` int(19) NOT NULL,
  `colvalue` varchar(50) DEFAULT NULL,
  `colname` varchar(50) DEFAULT NULL,
  `sequence` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `picklist_colname_idx` (`colname`,`colvalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_picklist`
--

INSERT INTO `ec_picklist` (`id`, `colvalue`, `colname`, `sequence`) VALUES
(1, '无', 'sex', 0),
(2, '男', 'sex', 1),
(3, '女', 'sex', 2),
(4, '普通会员', 'grade', 0),
(5, '黄金会员', 'grade', 1),
(6, ' 白金会员', 'grade', 2),
(7, '钻石会员', 'grade', 3),
(8, '正常', 'rating', 0),
(9, '未激活', 'rating', 1),
(10, '删除', 'rating', 2),
(11, '冻结', 'rating', 3),
(12, '监管', 'rating', 4),
(13, '无', 'account_type', 0),
(14, 'B商家', 'account_type', 1),
(15, 'C商家', 'account_type', 2),
(16, '其它', 'account_type', 3),
(17, '没有认证', 'promoted_type', 0),
(18, '实名认证', 'promoted_type', 1),
(19, '无', 'buyer_credit', 0),
(20, '1心', 'buyer_credit', 1),
(21, '2心', 'buyer_credit', 2),
(22, '3心', 'buyer_credit', 3),
(23, '4心', 'buyer_credit', 4),
(24, '5心', 'buyer_credit', 5),
(25, '1钻', 'buyer_credit', 6),
(26, '2钻', 'buyer_credit', 7),
(27, '3钻', 'buyer_credit', 8),
(28, '4钻', 'buyer_credit', 9),
(29, '5钻', 'buyer_credit', 10),
(30, '1蓝冠', 'buyer_credit', 11),
(31, '2蓝冠', 'buyer_credit', 12),
(32, '3蓝冠', 'buyer_credit', 13),
(33, '4蓝冠', 'buyer_credit', 14),
(34, '5蓝冠', 'buyer_credit', 15),
(35, '1皇冠', 'buyer_credit', 16),
(36, '2皇冠', 'buyer_credit', 17),
(37, '3皇冠', 'buyer_credit', 18),
(38, '4皇冠', 'buyer_credit', 19),
(39, '5皇冠', 'buyer_credit', 20),
(40, '无', 'seller_credit', 0),
(41, '1心', 'seller_credit', 1),
(42, '2心', 'seller_credit', 2),
(43, '3心', 'seller_credit', 3),
(44, '4心', 'seller_credit', 4),
(45, '5心', 'seller_credit', 5),
(46, '1钻', 'seller_credit', 6),
(47, '2钻', 'seller_credit', 7),
(48, '3钻', 'seller_credit', 8),
(49, '4钻', 'seller_credit', 9),
(50, '5钻', 'seller_credit', 10),
(51, '1蓝冠', 'seller_credit', 11),
(52, '2蓝冠', 'seller_credit', 12),
(53, '3蓝冠', 'seller_credit', 13),
(54, '4蓝冠', 'seller_credit', 14),
(55, '5蓝冠', 'seller_credit', 15),
(56, '1皇冠', 'seller_credit', 16),
(57, '2皇冠', 'seller_credit', 17),
(58, '3皇冠', 'seller_credit', 18),
(59, '4皇冠', 'seller_credit', 19),
(60, '5皇冠', 'seller_credit', 20),
(61, '无', 'consumer_protection', 0),
(62, '否', 'consumer_protection', 1),
(63, '是', 'consumer_protection', 2),
(64, '未绑定', 'alipay_bind', 0),
(65, '绑定', 'alipay_bind', 1),
(289, '体验vip会员4级', 'vipinfo', 6),
(283, '无', 'vipinfo', 0),
(284, '普通会员', 'vipinfo', 1),
(285, '荣誉会员', 'vipinfo', 2),
(286, '体验vip会员1级', 'vipinfo', 3),
(287, '体验vip会员2级', 'vipinfo', 4),
(288, '体验vip会员3级', 'vipinfo', 5),
(76, '无', 'notetype', 0),
(77, '潜在客户首联', 'notetype', 1),
(78, '潜在客户二联', 'notetype', 2),
(79, '潜在客户三联', 'notetype', 3),
(80, '成交客户回访', 'notetype', 4),
(81, '无', 'usageunit', 0),
(82, '盒', 'usageunit', 1),
(83, '升', 'usageunit', 2),
(84, '打', 'usageunit', 3),
(85, '小时', 'usageunit', 4),
(86, '米', 'usageunit', 5),
(87, '吨', 'usageunit', 6),
(88, '页', 'usageunit', 7),
(89, '个', 'usageunit', 8),
(90, '无', 'weightunit', 0),
(91, '微克', 'weightunit', 1),
(92, '毫克', 'weightunit', 2),
(93, '克', 'weightunit', 3),
(94, '千克', 'weightunit', 4),
(95, '吨 ', 'weightunit', 5),
(96, '无', 'level', 0),
(97, '1星', 'level', 1),
(98, '2星', 'level', 2),
(99, '3星', 'level', 3),
(100, '4星', 'level', 4),
(101, '5星', 'level', 5),
(102, '6星', 'level', 6),
(103, '7星', 'level', 7),
(104, '8星', 'level', 8),
(105, '9星', 'level', 9),
(106, '10星', 'level', 10),
(107, '11星', 'level', 11),
(108, '12星', 'level', 12),
(109, '无', 'pro_status', 0),
(110, '商家确认', 'pro_status', 1),
(111, '屏蔽', 'pro_status', 2),
(112, '小二确认', 'pro_status', 3),
(113, '未确认', 'pro_status', 4),
(114, '删除', 'pro_status', 5),
(115, '无', 'vertical_market', 0),
(116, '3C', 'vertical_market', 1),
(117, '鞋城', 'vertical_market', 2),
(118, '其它', 'vertical_market', 3),
(119, '人民币', 'currency', 0),
(120, '美元', 'currency', 1),
(121, '英镑', 'currency', 2),
(122, '欧元', 'currency', 3),
(123, '否', 'is_oversold', 0),
(124, '是', 'is_oversold', 1),
(281, '交易成功', 'orderstatus', 6),
(282, '交易关闭', 'orderstatus', 7),
(279, '卖家已发货，等待买家确认', 'orderstatus', 4),
(278, '买家已付款，等待卖家发货', 'orderstatus', 3),
(275, '无', 'orderstatus', 0),
(276, '未创建支付宝交易', 'orderstatus', 1),
(277, '等待买家付款', 'orderstatus', 2),
(274, '虚拟物品', 'shipping_type', 5),
(271, '快递', 'shipping_type', 2),
(272, '平邮', 'shipping_type', 3),
(270, 'EMS', 'shipping_type', 1),
(259, '支付宝卡通', 'pay_type', 2),
(260, '信用卡支付', 'pay_type', 3),
(257, '无', 'pay_type', 0),
(258, '支付宝', 'pay_type', 1),
(146, '否', 'buyer_rate', 0),
(147, '是', 'buyer_rate', 1),
(148, '否', 'seller_rate', 0),
(149, '是', 'seller_rate', 1),
(150, '无', 'trade_type', 0),
(151, '一口价', 'trade_type', 1),
(152, '拍卖', 'trade_type', 2),
(153, '一口价、拍卖', 'trade_type', 3),
(154, '自动发货', 'trade_type', 4),
(155, '旺店入门版交易', 'trade_type', 5),
(156, '旺店标准版交易', 'trade_type', 6),
(157, '直冲', 'trade_type', 7),
(158, '货到付款', 'trade_type', 8),
(159, '分销', 'trade_type', 9),
(160, '游戏装备', 'trade_type', 10),
(161, 'ShopEX交易', 'trade_type', 11),
(162, '万网交易', 'trade_type', 12),
(163, '统一外部交易', 'trade_type', 13),
(164, '无', 'trade_status', 0),
(165, '未创建支付宝交易', 'trade_status', 1),
(166, '等待买家付款', 'trade_status', 2),
(167, '等待卖家发货', 'trade_status', 3),
(168, '等待买家确认收货', 'trade_status', 4),
(169, '买家已签收', 'trade_status', 5),
(170, '交易成功', 'trade_status', 6),
(171, '付款以后用户退款成功', 'trade_status', 7),
(172, '付款以前,卖家或买家主动关闭交易', 'trade_status', 8),
(173, '无', 'trade_from', 0),
(174, '手机', 'trade_from', 1),
(175, '嗨淘', 'trade_from', 2),
(176, 'TOP平台', 'trade_from', 3),
(177, '普通淘宝', 'trade_from', 4),
(178, '聚划算', 'trade_from', 5),
(179, '否', 'is_threeD', 0),
(180, '是', 'is_threeD', 1),
(181, '无', 'account_buyer_credit', 0),
(182, '1心', 'account_buyer_credit', 1),
(183, '2心', 'account_buyer_credit', 2),
(184, '3心', 'account_buyer_credit', 3),
(185, '4心', 'account_buyer_credit', 4),
(186, '5心', 'account_buyer_credit', 5),
(187, '1钻', 'account_buyer_credit', 6),
(188, '2钻', 'account_buyer_credit', 7),
(189, '3钻', 'account_buyer_credit', 8),
(190, '4钻', 'account_buyer_credit', 9),
(191, '5钻', 'account_buyer_credit', 10),
(192, '1蓝冠', 'account_buyer_credit', 11),
(193, '2蓝冠', 'account_buyer_credit', 12),
(194, '3蓝冠', 'account_buyer_credit', 13),
(195, '4蓝冠', 'account_buyer_credit', 14),
(196, '5蓝冠', 'account_buyer_credit', 15),
(197, '1皇冠', 'account_buyer_credit', 16),
(198, '2皇冠', 'account_buyer_credit', 17),
(199, '3皇冠', 'account_buyer_credit', 18),
(200, '4皇冠', 'account_buyer_credit', 19),
(201, '5皇冠', 'account_buyer_credit', 20),
(202, '无', 'account_seller_credit', 0),
(203, '1心', 'account_seller_credit', 1),
(204, '2心', 'account_seller_credit', 2),
(205, '3心', 'account_seller_credit', 3),
(206, '4心', 'account_seller_credit', 4),
(207, '5心', 'account_seller_credit', 5),
(208, '1钻', 'account_seller_credit', 6),
(209, '2钻', 'account_seller_credit', 7),
(210, '3钻', 'account_seller_credit', 8),
(211, '4钻', 'account_seller_credit', 9),
(212, '5钻', 'account_seller_credit', 10),
(213, '1蓝冠', 'account_seller_credit', 11),
(214, '2蓝冠', 'account_seller_credit', 12),
(215, '3蓝冠', 'account_seller_credit', 13),
(216, '4蓝冠', 'account_seller_credit', 14),
(217, '5蓝冠', 'account_seller_credit', 15),
(218, '1皇冠', 'account_seller_credit', 16),
(219, '2皇冠', 'account_seller_credit', 17),
(220, '3皇冠', 'account_seller_credit', 18),
(221, '4皇冠', 'account_seller_credit', 19),
(222, '5皇冠', 'account_seller_credit', 20),
(223, '无', 'pro_type', 0),
(224, '一口价', 'pro_type', 1),
(225, '拍卖', 'pro_type', 2),
(226, '无', 'stuff_status', 0),
(227, '全新', 'stuff_status', 1),
(228, '闲置', 'stuff_status', 2),
(229, '二手', 'stuff_status', 3),
(230, '无', 'has_invoice', 0),
(231, '有', 'has_invoice', 1),
(232, '无', 'has_warranty', 0),
(233, '有', 'has_warranty', 1),
(234, '无', 'has_showcase', 0),
(235, '有', 'has_showcase', 1),
(236, '无', 'approve_status', 0),
(237, '出售中', 'approve_status', 1),
(238, '库中', 'approve_status', 2),
(239, '无', 'has_discount', 0),
(240, '有', 'has_discount', 1),
(241, '无', 'freight_payer', 0),
(242, '卖家承担', 'freight_payer', 1),
(243, '买家承担', 'freight_payer', 2),
(244, '无', 'is_taobao', 0),
(245, '有', 'is_taobao', 1),
(246, '无', 'is_ex', 0),
(247, '有', 'is_ex', 1),
(280, '买家已签收', 'orderstatus', 5),
(261, '货到付款', 'pay_type', 4),
(262, '网上银行', 'pay_type', 5),
(273, '卖家承担运费', 'shipping_type', 4),
(269, '无', 'shipping_type', 0),
(290, 'vip会员1级', 'vipinfo', 7),
(291, 'vip会员2级', 'vipinfo', 8),
(292, 'vip会员3级', 'vipinfo', 9),
(293, 'vip会员4级', 'vipinfo', 10),
(294, '请选择', 'memday938', 0),
(295, '生日', 'memday938', 1),
(296, '子女生日', 'memday938', 2),
(297, '父母生日', 'memday938', 3),
(298, '结婚纪念日', 'memday938', 4),
(299, '公司成立纪念日', 'memday938', 5),
(300, '毕业纪念日', 'memday938', 6),
(301, '其他', 'memday938', 7),
(302, '年(可选)', 'memday940', 0),
(303, '公历', 'memday1004', 0),
(304, '农历', 'memday1004', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ec_picklist_seq`
--

CREATE TABLE IF NOT EXISTS `ec_picklist_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_picklist_seq`
--

INSERT INTO `ec_picklist_seq` (`id`) VALUES
(304);

-- --------------------------------------------------------

--
-- 表的结构 `ec_productfieldlist`
--

CREATE TABLE IF NOT EXISTS `ec_productfieldlist` (
  `id` int(11) NOT NULL,
  `fieldname` varchar(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `width` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_productfieldlist`
--

INSERT INTO `ec_productfieldlist` (`id`, `fieldname`, `module`, `width`) VALUES
(1, 'productname', 'SalesOrder', '15%'),
(2, 'productcode', 'SalesOrder', '10%');

-- --------------------------------------------------------

--
-- 表的结构 `ec_productfieldlist_seq`
--

CREATE TABLE IF NOT EXISTS `ec_productfieldlist_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_productfieldlist_seq`
--

INSERT INTO `ec_productfieldlist_seq` (`id`) VALUES
(4);

-- --------------------------------------------------------

--
-- 表的结构 `ec_products`
--

CREATE TABLE IF NOT EXISTS `ec_products` (
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `productcode` varchar(100) DEFAULT NULL,
  `pro_type` varchar(100) DEFAULT NULL,
  `detail_url` varchar(300) DEFAULT NULL,
  `num_iid` varchar(100) DEFAULT NULL,
  `outer_id` varchar(30) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `valid_thru` varchar(30) DEFAULT NULL,
  `list_time` datetime DEFAULT NULL,
  `delist_time` datetime DEFAULT NULL,
  `stuff_status` varchar(30) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `post_fee` decimal(11,2) DEFAULT NULL,
  `express_fee` decimal(11,2) DEFAULT NULL,
  `ems_fee` decimal(11,2) DEFAULT NULL,
  `props` varchar(100) DEFAULT NULL,
  `property_alias` varchar(100) DEFAULT NULL,
  `has_invoice` varchar(30) DEFAULT NULL,
  `has_warranty` varchar(30) DEFAULT NULL,
  `has_showcase` varchar(30) DEFAULT NULL,
  `increment` varchar(30) DEFAULT NULL,
  `approve_status` varchar(30) DEFAULT NULL,
  `has_discount` varchar(30) DEFAULT NULL,
  `freight_payer` varchar(30) DEFAULT NULL,
  `is_taobao` varchar(30) DEFAULT NULL,
  `is_ex` varchar(30) DEFAULT NULL,
  `auction_point` varchar(30) DEFAULT NULL,
  `imagename` text,
  `description` text,
  `smownerid` int(19) NOT NULL DEFAULT '0',
  `smcreatorid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`productid`),
  KEY `smownerid` (`smownerid`),
  KEY `num_iid_index` (`deleted`,`smownerid`,`num_iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_products`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_qunfas`
--

CREATE TABLE IF NOT EXISTS `ec_qunfas` (
  `qunfasid` int(19) NOT NULL,
  `qunfaname` varchar(250) NOT NULL,
  `accountid` varchar(255) DEFAULT '0',
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `description` text,
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `msg` text,
  PRIMARY KEY (`qunfasid`),
  KEY `qunfas_qunfaname_idx` (`qunfaname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_qunfas`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_qunfas_seq`
--

CREATE TABLE IF NOT EXISTS `ec_qunfas_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_qunfas_seq`
--

INSERT INTO `ec_qunfas_seq` (`id`) VALUES
(12);

-- --------------------------------------------------------

--
-- 表的结构 `ec_qunfatmps`
--

CREATE TABLE IF NOT EXISTS `ec_qunfatmps` (
  `qunfatmpsid` int(19) NOT NULL DEFAULT '0',
  `qunfatmpname` varchar(250) NOT NULL,
  `accountid` int(19) DEFAULT '0',
  `contact_id` int(19) DEFAULT '0',
  `potentialid` int(19) DEFAULT '0',
  `salesorderid` int(19) DEFAULT '0',
  `purchaseorderid` int(19) DEFAULT '0',
  `total` decimal(11,2) DEFAULT NULL,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `groupid` int(19) DEFAULT '0',
  `description` text,
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `approved` int(1) DEFAULT '0',
  `approvedby` int(19) DEFAULT '0',
  PRIMARY KEY (`qunfatmpsid`),
  KEY `qunfatmps_qunfatmpname_idx` (`qunfatmpname`),
  KEY `qunfatmps_qunfatmpsid_idx` (`qunfatmpsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_qunfatmps`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_relatedlists`
--

CREATE TABLE IF NOT EXISTS `ec_relatedlists` (
  `relation_id` int(19) NOT NULL,
  `tabid` int(10) DEFAULT NULL,
  `related_tabid` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sequence` int(10) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `presence` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_relatedlists`
--

INSERT INTO `ec_relatedlists` (`relation_id`, `tabid`, `related_tabid`, `name`, `sequence`, `label`, `presence`) VALUES
(1, 6, 8, 'get_notes', 0, 'Notes', 0),
(2, 6, 22, 'get_salesorder', 9, 'Sales Order', 0),
(3, 6, 14, 'get_products', 10, 'Products', 0),
(4, 14, 0, 'get_attachments', 2, 'Attachments', 1),
(5, 33, 0, 'get_apprhtry', 1, 'ApproveHistory', 1),
(6, 6, 33, 'get_qunfas', 4, 'Qunfas', 1),
(7, 33, 0, 'get_attachments', 1, 'Attachments', 1),
(9, 34, 0, 'get_apprhtry', 1, 'ApproveHistory', 1),
(10, 6, 34, 'get_maillists', 4, 'Maillists', 0),
(11, 34, 0, 'get_attachments', 1, 'Attachments', 0),
(13, 35, 0, 'get_apprhtry', 1, 'ApproveHistory', 1),
(14, 6, 35, 'get_generalmodules', 4, 'Qunfatmps', 1),
(15, 35, 0, 'get_attachments', 1, 'Attachments', 1),
(17, 36, 0, 'get_apprhtry', 1, 'ApproveHistory', 1),
(18, 6, 36, 'get_generalmodules', 4, 'Maillisttmps', 1),
(19, 36, 0, 'get_attachments', 1, 'Attachments', 1),
(21, 37, 0, 'get_apprhtry', 1, 'ApproveHistory', 1),
(22, 6, 37, 'get_generalmodules', 4, 'Relsettings', 1),
(23, 37, 0, 'get_attachments', 1, 'Attachments', 1),
(25, 44, 0, 'get_apprhtry', 1, 'ApproveHistory', 0),
(26, 45, 0, 'get_apprhtry', 1, 'ApproveHistory', 0),
(27, 46, 0, 'get_apprhtry', 1, 'ApproveHistory', 0),
(28, 47, 0, 'get_apprhtry', 1, 'ApproveHistory', 0),
(29, 6, 48, 'get_generalmodules', 4, 'Memdays', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ec_relatedlists_seq`
--

CREATE TABLE IF NOT EXISTS `ec_relatedlists_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_relatedlists_seq`
--

INSERT INTO `ec_relatedlists_seq` (`id`) VALUES
(29);

-- --------------------------------------------------------

--
-- 表的结构 `ec_relcriteria`
--

CREATE TABLE IF NOT EXISTS `ec_relcriteria` (
  `queryid` int(19) NOT NULL,
  `columnindex` int(11) NOT NULL,
  `columnname` varchar(250) DEFAULT '',
  `comparator` varchar(10) DEFAULT '',
  `value` varchar(200) DEFAULT '',
  PRIMARY KEY (`queryid`,`columnindex`),
  KEY `relcriteria_queryid_idx` (`queryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_relcriteria`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_relmodfieldlist`
--

CREATE TABLE IF NOT EXISTS `ec_relmodfieldlist` (
  `id` int(11) NOT NULL,
  `fieldname` varchar(30) NOT NULL,
  `module` varchar(30) NOT NULL,
  `width` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_relmodfieldlist`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_salesorder`
--

CREATE TABLE IF NOT EXISTS `ec_salesorder` (
  `salesorderid` int(19) NOT NULL DEFAULT '0',
  `tid` varchar(100) DEFAULT NULL,
  `oid` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `accountid` int(19) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `is_oversold` varchar(30) DEFAULT NULL,
  `orderstatus` varchar(50) DEFAULT NULL,
  `num` varchar(30) DEFAULT NULL,
  `shipping_type` varchar(30) DEFAULT NULL,
  `pay_type` varchar(30) DEFAULT NULL,
  `point_fee` decimal(11,2) DEFAULT NULL,
  `buyer_obtain_point_fee` decimal(11,2) DEFAULT NULL,
  `postage` decimal(11,2) DEFAULT NULL,
  `pay_time` datetime DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `payment` decimal(11,2) DEFAULT NULL,
  `sku_properties_name` varchar(100) DEFAULT NULL,
  `express_agency_fee` decimal(11,2) DEFAULT NULL,
  `invoice_name` varchar(100) DEFAULT NULL,
  `buyer_nick` varchar(30) DEFAULT NULL,
  `buyer_alipay_no` varchar(100) DEFAULT NULL,
  `buyer_memo` varchar(100) DEFAULT NULL,
  `buyer_flag` varchar(30) DEFAULT NULL,
  `buyer_rate` varchar(30) DEFAULT NULL,
  `buyer_credit` varchar(50) DEFAULT NULL,
  `buyer_message` text,
  `receiver_name` varchar(30) DEFAULT NULL,
  `receiver_state` varchar(30) DEFAULT NULL,
  `receiver_city` varchar(30) DEFAULT NULL,
  `receiver_district` varchar(30) DEFAULT NULL,
  `receiver_street` varchar(200) DEFAULT NULL,
  `receiver_code` varchar(30) DEFAULT NULL,
  `receiver_phone` varchar(30) DEFAULT NULL,
  `receiver_tel` varchar(30) DEFAULT NULL,
  `seller_name` varchar(30) DEFAULT NULL,
  `seller_nick` varchar(30) DEFAULT NULL,
  `seller_mobile` varchar(30) DEFAULT NULL,
  `seller_phone` varchar(30) DEFAULT NULL,
  `seller_email` varchar(100) DEFAULT NULL,
  `consign_time` datetime DEFAULT NULL,
  `seller_alipay_no` varchar(100) DEFAULT NULL,
  `seller_memo` varchar(100) DEFAULT NULL,
  `seller_flag` varchar(30) DEFAULT NULL,
  `seller_rate` varchar(30) DEFAULT NULL,
  `adjust_fee` decimal(11,2) DEFAULT NULL,
  `received_payment` decimal(11,2) DEFAULT NULL,
  `seller_credit` varchar(50) DEFAULT NULL,
  `trade_title` varchar(200) DEFAULT NULL,
  `trade_type` varchar(30) DEFAULT NULL,
  `trade_status` varchar(30) DEFAULT NULL,
  `trade_from` varchar(50) DEFAULT NULL,
  `trade_commission_fee` decimal(11,2) DEFAULT NULL,
  `trade_snapshot_url` varchar(100) DEFAULT NULL,
  `is_threed` varchar(30) DEFAULT NULL,
  `trade_promotion` varchar(200) DEFAULT NULL,
  `trade_available_confirm_fee` decimal(11,2) DEFAULT NULL,
  `trade_created` datetime DEFAULT NULL,
  `trade_modified` datetime DEFAULT NULL,
  `trade_end_time` datetime DEFAULT NULL,
  `item_meal_name` text,
  `promotion_name` varchar(100) DEFAULT NULL,
  `discount_fee` decimal(11,2) DEFAULT NULL,
  `gift_item_name` varchar(200) DEFAULT NULL,
  `wl_no` varchar(50) DEFAULT NULL,
  `wl_company` varchar(50) DEFAULT NULL,
  `description` text,
  `smcreatorid` int(19) DEFAULT '0',
  `smownerid` int(19) DEFAULT '0',
  `modifiedby` int(19) DEFAULT '0',
  `createdtime` datetime DEFAULT NULL,
  `modifiedtime` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`salesorderid`),
  KEY `salesorer_accountid_idx` (`accountid`,`createdtime`),
  KEY `tid_index` (`deleted`,`smownerid`,`tid`),
  KEY `oid_index` (`deleted`,`smownerid`,`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_salesorder`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_selectcolumn`
--

CREATE TABLE IF NOT EXISTS `ec_selectcolumn` (
  `queryid` int(19) NOT NULL,
  `columnindex` int(11) NOT NULL DEFAULT '0',
  `columnname` varchar(250) DEFAULT '',
  PRIMARY KEY (`queryid`,`columnindex`),
  KEY `selectcolumn_queryid_idx` (`queryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_selectcolumn`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_selectquery`
--

CREATE TABLE IF NOT EXISTS `ec_selectquery` (
  `queryid` int(19) NOT NULL,
  `startindex` int(19) DEFAULT '0',
  `numofobjects` int(19) DEFAULT '0',
  PRIMARY KEY (`queryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_selectquery`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_selectquery_seq`
--

CREATE TABLE IF NOT EXISTS `ec_selectquery_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_selectquery_seq`
--

INSERT INTO `ec_selectquery_seq` (`id`) VALUES
(70);

-- --------------------------------------------------------

--
-- 表的结构 `ec_systems`
--

CREATE TABLE IF NOT EXISTS `ec_systems` (
  `id` int(19) NOT NULL,
  `server` varchar(50) DEFAULT NULL,
  `server_port` int(19) DEFAULT NULL,
  `server_username` varchar(50) DEFAULT NULL,
  `server_password` varchar(50) DEFAULT NULL,
  `server_type` varchar(50) DEFAULT NULL,
  `smtp_auth` varchar(5) DEFAULT NULL,
  `smownerid` int(19) DEFAULT '0',
  `from_email` varchar(50) DEFAULT NULL,
  `from_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `smownerid` (`smownerid`),
  KEY `from_email` (`from_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_systems`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_systems_seq`
--

CREATE TABLE IF NOT EXISTS `ec_systems_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_systems_seq`
--

INSERT INTO `ec_systems_seq` (`id`) VALUES
(49);

-- --------------------------------------------------------

--
-- 表的结构 `ec_tab`
--

CREATE TABLE IF NOT EXISTS `ec_tab` (
  `tabid` int(19) NOT NULL DEFAULT '0',
  `name` varchar(25) NOT NULL,
  `presence` int(19) NOT NULL DEFAULT '1',
  `tabsequence` int(10) DEFAULT NULL,
  `tablabel` varchar(25) NOT NULL,
  `modifiedby` int(19) DEFAULT NULL,
  `modifiedtime` int(19) DEFAULT NULL,
  `customized` int(1) DEFAULT NULL,
  `reportable` int(19) DEFAULT '0',
  UNIQUE KEY `tab_name_idx` (`name`),
  KEY `tab_modifiedby_idx` (`modifiedby`),
  KEY `tab_tabid_idx` (`tabid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_tab`
--

INSERT INTO `ec_tab` (`tabid`, `name`, `presence`, `tabsequence`, `tablabel`, `modifiedby`, `modifiedtime`, `customized`, `reportable`) VALUES
(3, 'Home', 0, 1, 'Home', NULL, NULL, 1, 0),
(6, 'Accounts', 0, 5, 'Accounts', NULL, NULL, 1, 1),
(8, 'Notes', 0, 9, 'Notes', NULL, NULL, 1, 1),
(14, 'Products', 0, 8, 'Products', NULL, NULL, 1, 1),
(22, 'SalesOrder', 0, 19, 'SalesOrder', NULL, NULL, 1, 1),
(29, 'Users', 0, 26, 'Users', NULL, NULL, 1, 0),
(33, 'Qunfas', 0, 33, 'Qunfas', NULL, NULL, 1, 0),
(34, 'Maillists', 0, 34, 'Maillists', NULL, NULL, 1, 0),
(35, 'Qunfatmps', 0, 35, 'Qunfatmps', NULL, NULL, 1, 0),
(36, 'Maillisttmps', 0, 36, 'Maillisttmps', NULL, NULL, 1, 0),
(37, 'Relsettings', 0, 37, 'Relsettings', NULL, NULL, 1, 0),
(38, 'Newmemberreports', 0, 38, 'Newmemberreports', NULL, NULL, 1, 0),
(39, 'Ordernumreports', 0, 39, 'Ordernumreports', NULL, NULL, 1, 0),
(40, 'Addressreports', 0, 40, 'Addressreports', NULL, NULL, 1, 0),
(41, 'Salesorderreports', 0, 41, 'Salesorderreports', NULL, NULL, 1, 0),
(42, 'Repeatmemberreports', 0, 42, 'Repeatmemberreports', NULL, NULL, 1, 0),
(43, 'OnlineAccsalesreports', 0, 43, 'OnlineAccsalesreports', NULL, NULL, 1, 0),
(44, 'SfaDesktops', 0, 44, 'SfaDesktops', NULL, NULL, 1, 1),
(45, 'Sfalists', 0, 45, 'Sfalists', NULL, NULL, 1, 1),
(46, 'Sfalogs', 0, 46, 'Sfalogs', NULL, NULL, 1, 1),
(47, 'Sfasettings', 0, 47, 'Sfasettings', NULL, NULL, 1, 1),
(48, 'Memdays', 0, 48, 'Memdays', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ec_tracker`
--

CREATE TABLE IF NOT EXISTS `ec_tracker` (
  `id` int(11) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `module_name` varchar(25) DEFAULT NULL,
  `item_id` varchar(36) DEFAULT NULL,
  `item_summary` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_tracker`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_users`
--

CREATE TABLE IF NOT EXISTS `ec_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `user_password` varchar(30) DEFAULT NULL,
  `user_hash` varchar(32) DEFAULT NULL,
  `cal_color` varchar(25) DEFAULT '#E6FAD8',
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `reports_to_id` varchar(36) DEFAULT NULL,
  `is_admin` varchar(3) DEFAULT '0',
  `currency_id` int(19) NOT NULL DEFAULT '1',
  `description` text,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` varchar(36) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `phone_home` varchar(50) DEFAULT NULL,
  `phone_mobile` varchar(50) DEFAULT NULL,
  `phone_work` varchar(50) DEFAULT NULL,
  `phone_other` varchar(50) DEFAULT NULL,
  `phone_fax` varchar(50) DEFAULT NULL,
  `email1` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `yahoo_id` varchar(100) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `signature` varchar(250) DEFAULT NULL,
  `address_street` varchar(150) DEFAULT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_state` varchar(100) DEFAULT NULL,
  `address_country` varchar(25) DEFAULT NULL,
  `address_postalcode` varchar(9) DEFAULT NULL,
  `user_preferences` text,
  `tz` varchar(30) DEFAULT NULL,
  `holidays` varchar(60) DEFAULT NULL,
  `namedays` varchar(60) DEFAULT NULL,
  `workdays` varchar(30) DEFAULT NULL,
  `weekstart` int(11) DEFAULT NULL,
  `date_format` varchar(30) DEFAULT NULL,
  `hour_format` varchar(30) DEFAULT '24',
  `start_hour` varchar(30) DEFAULT '9:00',
  `end_hour` varchar(30) DEFAULT '23:00',
  `homeorder` varchar(255) DEFAULT 'ALVT,HDB,PLVT,QLTQ,CVLVT,HLT,OLV,OLTSO,ILTI,MNL,OLTPO,LTFAQ',
  `activity_view` varchar(25) DEFAULT 'Today',
  `lead_view` varchar(25) DEFAULT 'Today',
  `imagename` varchar(250) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `defhomeview` varchar(100) DEFAULT NULL,
  `confirm_password` varchar(30) DEFAULT NULL,
  `buddylist` text,
  `is_online` int(11) DEFAULT NULL,
  `last_ping` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_user_name_idx` (`user_name`),
  KEY `user_user_password_idx` (`user_password`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_users`
--

INSERT INTO `ec_users` (`id`, `user_name`, `user_password`, `user_hash`, `cal_color`, `first_name`, `last_name`, `reports_to_id`, `is_admin`, `currency_id`, `description`, `date_entered`, `date_modified`, `modified_user_id`, `title`, `department`, `phone_home`, `phone_mobile`, `phone_work`, `phone_other`, `phone_fax`, `email1`, `email2`, `yahoo_id`, `status`, `signature`, `address_street`, `address_city`, `address_state`, `address_country`, `address_postalcode`, `user_preferences`, `tz`, `holidays`, `namedays`, `workdays`, `weekstart`, `date_format`, `hour_format`, `start_hour`, `end_hour`, `homeorder`, `activity_view`, `lead_view`, `imagename`, `deleted`, `defhomeview`, `confirm_password`, `buddylist`, `is_online`, `last_ping`, `prefix`) VALUES
(13, '汐飞扬', NULL, NULL, '#E6FAD8', NULL, NULL, NULL, '0', 1, NULL, '2012-02-07 15:19:47', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', '9:00', '23:00', 'ALVT,HDB,PLVT,QLTQ,CVLVT,HLT,OLV,OLTSO,ILTI,MNL,OLTPO,LTFAQ', 'Today', 'Today', NULL, 0, NULL, NULL, NULL, 1, NULL, NULL),
(23, 'dfar2008', NULL, NULL, '#E6FAD8', NULL, NULL, NULL, '0', 1, NULL, '2012-02-09 22:11:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', '9:00', '23:00', 'ALVT,HDB,PLVT,QLTQ,CVLVT,HLT,OLV,OLTSO,ILTI,MNL,OLTPO,LTFAQ', 'Today', 'Today', NULL, 0, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ec_users_last_import`
--

CREATE TABLE IF NOT EXISTS `ec_users_last_import` (
  `id` int(36) NOT NULL,
  `assigned_user_id` varchar(36) DEFAULT NULL,
  `bean_type` varchar(36) DEFAULT NULL,
  `bean_id` varchar(36) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`assigned_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_users_last_import`
--


-- --------------------------------------------------------

--
-- 表的结构 `ec_users_seq`
--

CREATE TABLE IF NOT EXISTS `ec_users_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ec_users_seq`
--

INSERT INTO `ec_users_seq` (`id`) VALUES
(1636);
