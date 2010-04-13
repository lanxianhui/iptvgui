-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost:3306
-- 生成日期: 2010 年 04 月 08 日 12:45
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.3
-- 
-- 数据库: `test5`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `admin`
-- 

CREATE TABLE `admin` (
  `id` bigint(10) NOT NULL auto_increment,
  `usename` varchar(200) default NULL,
  `usepass` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `admin`
-- 

INSERT INTO `admin` (`id`, `usename`, `usepass`) VALUES (1, 'admin', 'admin');

-- --------------------------------------------------------

-- 
-- 表的结构 `cases`
-- 

CREATE TABLE `cases` (
  `id` bigint(20) NOT NULL auto_increment,
  `casetitle` varchar(200) NOT NULL,
  `rootid` bigint(20) NOT NULL,
  `catid` bigint(20) NOT NULL,
  `casepic1` varchar(256) default NULL,
  `casepic2` varchar(256) default NULL,
  `casepic3` varchar(256) default NULL,
  `casepic4` varchar(256) default NULL,
  `casepic5` varchar(256) default NULL,
  `casepic6` varchar(256) default NULL,
  `casepic7` varchar(256) default NULL,
  `casepic8` varchar(256) default NULL,
  `casedesc` text NOT NULL,
  `caseorder` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `cases`
-- 

INSERT INTO `cases` (`id`, `casetitle`, `rootid`, `catid`, `casepic1`, `casepic2`, `casepic3`, `casepic4`, `casepic5`, `casepic6`, `casepic7`, `casepic8`, `casedesc`, `caseorder`) VALUES (1, '锡林浩特湖3#地块景观规划', 1, 1, 'aaa1.jpg', 'aaa2.jpg', 'aaa3.jpg', 'aaa4.jpg', 'aaa5.jpg', 'aaa6.jpg', NULL, NULL, '<p>&nbsp;</p>\r\n<p>本项目位于锡林浩特新区3#湖地块，是新区内重要的滨水空间。东临滨河路，西接锡林湖，规划面积8.7万平方米。</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
(2, '锡林浩特湖', 1, 1, 'aaa6(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;</p>\r\n<p>锡林浩特湖3#地块景观规划设计<br />\r\n本项目位于锡林浩特新区3#湖地块，是新区内重要的滨水空间。东临滨河路，西接锡林湖，规划面积8.7万平方米。</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
(3, '锡林浩特湖3#', 1, 1, 'aaa5(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;</p>\r\n<p>锡林浩特湖3#地块景观规划设计<br />\r\n本项目位于锡林浩特新区3#湖地块，是新区内重要的滨水空间。东临滨河路，西接锡林湖，规划面积8.7万平方米。</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
(4, '规划1', 1, 2, 'aaa2(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;</p>\r\n<p>规划1</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
(5, '规划2_样稿', 1, 2, 'aaa3(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;</p>\r\n<p>规划2_样稿</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
(6, '规划2_样稿3', 1, 2, 'aaa1(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;</p>\r\n<p>规划2_样稿3</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `casescat`
-- 

CREATE TABLE `casescat` (
  `id` bigint(20) NOT NULL auto_increment,
  `catname` varchar(200) NOT NULL,
  `rootid` bigint(20) NOT NULL,
  `catorder` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `casescat`
-- 

INSERT INTO `casescat` (`id`, `catname`, `rootid`, `catorder`) VALUES (1, '公共绿地类', 1, 1),
(2, '度假区类', 1, 2),
(3, '居住区类', 1, 3);

-- --------------------------------------------------------

-- 
-- 表的结构 `casesroot`
-- 

CREATE TABLE `casesroot` (
  `id` bigint(20) NOT NULL auto_increment,
  `rootname` varchar(200) NOT NULL,
  `rootorder` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `casesroot`
-- 

INSERT INTO `casesroot` (`id`, `rootname`, `rootorder`) VALUES (1, '景观', 1),
(2, '建筑', 2),
(3, '规划', 3);

-- --------------------------------------------------------

-- 
-- 表的结构 `consulting`
-- 

CREATE TABLE `consulting` (
  `id` bigint(20) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `company` varchar(200) default NULL,
  `phone` varchar(200) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `consulting`
-- 

INSERT INTO `consulting` (`id`, `title`, `company`, `phone`, `content`) VALUES (1, '阿斯顿发生地方', '阿斯地方', '阿斯地方', '阿斯地方');

-- --------------------------------------------------------

-- 
-- 表的结构 `friendlink`
-- 

CREATE TABLE `friendlink` (
  `id` bigint(20) NOT NULL auto_increment,
  `linkname` varchar(200) default NULL,
  `linkaddress` varchar(256) default NULL,
  `linkorder` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `friendlink`
-- 

INSERT INTO `friendlink` (`id`, `linkname`, `linkaddress`, `linkorder`) VALUES (1, '中国景观设计论坛', 'http://www.google.cn', 1),
(2, '未来水晶石', 'http://www.google.cn', 2),
(3, '第一设计之家', 'http://www.google.cn', 3),
(4, '中国景观设计论坛', 'http://www.google.cn', 4),
(5, '未来水晶石', 'http://www.google.cn', 5),
(6, '第一设计之家', 'http://www.google.cn', 6);

-- --------------------------------------------------------

-- 
-- 表的结构 `news`
-- 

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL auto_increment,
  `newstitle` varchar(200) NOT NULL,
  `catid` bigint(20) NOT NULL,
  `newsdesc` text NOT NULL,
  `pubtime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- 
-- 导出表中的数据 `news`
-- 

INSERT INTO `news` (`id`, `newstitle`, `catid`, `newsdesc`, `pubtime`) VALUES (37, '建筑行业的新选择', 2, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: verdana, sans-serif; font-size: 12px" class="Apple-style-span">\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>\r\n</span></span></p>', '2010-03-03 00:00:00'),
(38, '建筑行业的新选择', 2, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(39, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(40, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(41, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(42, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(43, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(44, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(45, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(46, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(47, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(48, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(49, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(50, '建筑行业的新选择', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-03 00:00:00'),
(51, '清雅最新动向', 1, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: verdana, sans-serif; font-size: 12px" class="Apple-style-span">\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>\r\n</span></span></p>', '2010-03-06 00:00:00'),
(52, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(53, '清雅最新动向', 1, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(54, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(55, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(56, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(57, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00');
INSERT INTO `news` (`id`, `newstitle`, `catid`, `newsdesc`, `pubtime`) VALUES (58, '清雅最新动向', 1, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(59, '清雅最新动向', 1, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(60, '清雅最新动向', 1, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: verdana, sans-serif; font-size: 12px" class="Apple-style-span">\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>\r\n</span></span></p>', '2010-03-06 00:00:00'),
(61, '清雅最新动向', 1, '<p>\r\n<p>&nbsp;</p>\r\n</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00'),
(62, '清雅最新动向', 1, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">美国时间3月17日，在Oracle收购Sun Microsystems之后，Java之父James Gosling首度在公开场合露面，他一如既往保持着对Java的高度关注，并表示Java在Oracle的掌管下令人放心，随后他还透露了Java的发展方向。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling是在TheServerSide Java Symposium上发表这份公开说明的，当时他的报告主题是Java Today and Tomorrow。他表示目睹了Oracle掌舵Java的方向之后，他深受鼓舞，Java的未来不需要担忧，关于Java的运营以及其技术的发展仍在向着有利的方向继续。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling还公布了一份最新的Java报告，比如JRE (Java Runtime Environment)的每周下载量为1500万；共有100亿个Java-enabled的应用；10亿个Java-enabled的桌面；一亿个Java-enabled的TV设备；26亿个Java-enabled的移动设备；55亿个Java智能卡以及超过650万名Java开发者。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">尽管目前大家看到的大多是Oracle在企业端Java的努力，但Gosling表示，Oracle同样也在致力于Java在桌面端、嵌入式、移动领域、高性能计算机及其他系统方面的发展。他说，所有这一切的原则是网络，网络将这些应用和功能链接。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">谈到企业端Java，Gosling表示Java EE 6 (Java Platform, Enterprise Edition 6)将是下一代企业软件的基础， Java社区及许多开发者在2009年11月促使了Java EE 6 specification的认可，并发布和升级了一些Java API，Gosling对此表示感谢。</p>\r\n<p style="line-height: 25px; text-indent: 25px; font-size: 14px">Gosling表示，Java EE 6以模块化为中心，引入了profiles的概念，但是有两个profiles，一个是full profile，另一个是Web profile。Web profile是第一个被定义的Java EE profile，对于现代Web应用开发它是一个功能全面的中型堆栈。</p>', '2010-03-06 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `newscat`
-- 

CREATE TABLE `newscat` (
  `id` bigint(20) NOT NULL auto_increment,
  `catname` varchar(200) default NULL,
  `catorder` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `newscat`
-- 

INSERT INTO `newscat` (`id`, `catname`, `catorder`) VALUES (1, '公司新闻', 1),
(2, '行业新闻', 2);

-- --------------------------------------------------------

-- 
-- 表的结构 `service`
-- 

CREATE TABLE `service` (
  `id` bigint(20) NOT NULL auto_increment,
  `servicename` varchar(200) NOT NULL,
  `pubtime` datetime NOT NULL,
  `servicedesc` text NOT NULL,
  `rootid` bigint(20) NOT NULL,
  `catid` bigint(20) NOT NULL,
  `servicepic` varchar(256) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `service`
-- 

INSERT INTO `service` (`id`, `servicename`, `pubtime`, `servicedesc`, `rootid`, `catid`, `servicepic`) VALUES (1, '清雅简介内容', '2010-03-19 00:00:00', '<p><strong>清雅景观设计规划公司<br />\r\n</strong><span style="color: #808000">的文字简介</span></p>', 2, 1, 'logo_01.jpg'),
(2, '职位1', '2010-03-09 00:00:00', '<p>阿斯顿发射点发射点发射</p>', 6, 6, 'index_09.jpg'),
(3, '职位2', '2010-03-16 00:00:00', '<p>asdfasdfasdfasdfasdfsadfasdfsadfasdfasdfsdafasdfasdfas阿斯顿发射点发射</p>', 6, 6, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `servicecat`
-- 

CREATE TABLE `servicecat` (
  `id` bigint(20) NOT NULL auto_increment,
  `catname` varchar(200) default NULL,
  `rootid` bigint(20) default NULL,
  `catdesc` text,
  `catorder` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- 导出表中的数据 `servicecat`
-- 

INSERT INTO `servicecat` (`id`, `catname`, `rootid`, `catdesc`, `catorder`) VALUES (1, '清雅简介', 2, '<p>上海清雅景观设计有限公司，专业从事综合性公共绿地开发规划、城市规划和设计、旧城改造、住宅社区、商业开发项目的建筑和园林景观设计、以及风景度假区与主题公园规划与设计。</p>', 1),
(2, '清雅团队', 2, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 2),
(3, '清雅文化', 2, '<p>这里是清雅文化的文字内容</p>', 3),
(4, '清雅福利', 2, '<p>这里是清雅福利的文字内容</p>', 4),
(5, '服务内容', 2, '<p>这里是服务内容的文字</p>', 5),
(6, '加入我们', 6, '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1),
(10, '联系我们', 7, '<p>地　址： 上海市大连路1546号国中酒店B－5B</p>\r\n<p>邮　编： 200092</p>\r\n<p>电　话： 021-65029663</p>\r\n<p>Email ： <a href="mailto:hrchinya@163.com">hrchinya@163.com</a></p>\r\n<p>&nbsp;</p>\r\n<p><br />\r\n<br />\r\n<a href="http://ditu.google.cn/maps?f=q&amp;source=s_q&amp;hl=zh-CN&amp;geocode=&amp;q=%E4%B8%8A%E6%B5%B7%E5%B8%82%E5%A4%A7%E8%BF%9E%E8%B7%AF1546%E5%8F%B7&amp;sll=35.86166,104.195397&amp;sspn=54.149366,134.912109&amp;brcurrent=3,0x35b2715dbb3e1509:0x6eee6acee3a9142c,0,0x35b2714180cd65c7:0xa5bef294e91108e7%3B5,0,0&amp;ie=UTF8&amp;hq=&amp;hnear=%E4%B8%8A%E6%B5%B7%E5%B8%82%E5%A4%A7%E8%BF%9E%E8%B7%AF1546%E5%8F%B7&amp;ll=31.272572,121.505077&amp;spn=0.003558,0.008234&amp;z=18"><img alt="_blank" width="629" height="449" src="/userfiles/map.jpg" /></a></p>', 1),
(11, '公司新闻', 4, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: Arial, 宋体; font-size: 14px" class="Apple-style-span">\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">中国画中的山水画自隋唐以来发展变化的轨迹犹如群山起伏，重峦叠嶂，高峰迭起，无论是工笔重彩的青绿山水，还是淡雅轻墨的水墨山水，都有其独特的面貌出现在历史的画卷之上，成为人类<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/painting/" target="_blank">绘画</a>文明史上的瑰宝，为世人所称道。林林总总的精美山水画卷，为后人留下了十分珍贵的精神财富。山水画之所以受到了人们的喜爱和欢迎，首先，主要是由于山水画所表现的内容能够代表或抒发出人们内心世界对世界的感受，能够宣泄出人们对现实的困惑、无奈，从而找到一个可以寓意抒情的载体进而达到&ldquo;畅神&rdquo;的目的，能够表现出人类对自然的&ldquo;观照&rdquo;思想和对自然现象的种种感悟；其次，山水画让人观之眼前为之一亮，心胸为之豁然，心潮为之起伏跌宕，能够产生出浮想联翩的奇思妙想。正如一些明白人所讲得，画养眼就是好看、耐看；心喜，就是观后心里产生快乐，从而产生了强烈的审美欲望，在心理上产生了一种文化积累后的爆发，产生出强烈的审美效果；第三，由于山水画具有&ldquo;咫尺之内，而瞻万里之遥；方寸之中，乃辨千寻之峻&rdquo;的浓缩和再现自然景观的功能，让真山真水重新耸立在人们的面前，使人不出门就能目睹奇山妙水的真面貌，这种将自然之妙通过<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/tag/50/bimo-24695/1.html" target="_blank">笔墨</a>关系的变化来再现给世人，使世人神游于大自然，感受到大自然的雄浑、清雅、苍郁、奇妙、独特等原始魅力，使人产生一种喜爱自然、关注自然、融入自然的感受，这也是山水画&ldquo;澄怀观&rdquo;和&ldquo;道法自然&rdquo;的魅力所在。</p>\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">　　众所周知，中国画基本是线条和墨的艺术，特别是山水画，都是由笔墨关系的构成而或图或画。笔者，墨者，历来众说纷纭。南派绘画大师潘天寿先生曾讲过：&ldquo;画者，画也，既以线为界，而或其画也。笔为骨，墨与彩色为血肉，气息神情为灵魂，风韵格趣为意志，能具此，活矣。</p>\r\n</span></span></p>', 1),
(12, '行业新闻', 4, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: Arial, 宋体; font-size: 14px" class="Apple-style-span">\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">中国画中的山水画自隋唐以来发展变化的轨迹犹如群山起伏，重峦叠嶂，高峰迭起，无论是工笔重彩的青绿山水，还是淡雅轻墨的水墨山水，都有其独特的面貌出现在历史的画卷之上，成为人类<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/painting/" target="_blank">绘画</a>文明史上的瑰宝，为世人所称道。林林总总的精美山水画卷，为后人留下了十分珍贵的精神财富。山水画之所以受到了人们的喜爱和欢迎，首先，主要是由于山水画所表现的内容能够代表或抒发出人们内心世界对世界的感受，能够宣泄出人们对现实的困惑、无奈，从而找到一个可以寓意抒情的载体进而达到&ldquo;畅神&rdquo;的目的，能够表现出人类对自然的&ldquo;观照&rdquo;思想和对自然现象的种种感悟；其次，山水画让人观之眼前为之一亮，心胸为之豁然，心潮为之起伏跌宕，能够产生出浮想联翩的奇思妙想。正如一些明白人所讲得，画养眼就是好看、耐看；心喜，就是观后心里产生快乐，从而产生了强烈的审美欲望，在心理上产生了一种文化积累后的爆发，产生出强烈的审美效果；第三，由于山水画具有&ldquo;咫尺之内，而瞻万里之遥；方寸之中，乃辨千寻之峻&rdquo;的浓缩和再现自然景观的功能，让真山真水重新耸立在人们的面前，使人不出门就能目睹奇山妙水的真面貌，这种将自然之妙通过<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/tag/50/bimo-24695/1.html" target="_blank">笔墨</a>关系的变化来再现给世人，使世人神游于大自然，感受到大自然的雄浑、清雅、苍郁、奇妙、独特等原始魅力，使人产生一种喜爱自然、关注自然、融入自然的感受，这也是山水画&ldquo;澄怀观&rdquo;和&ldquo;道法自然&rdquo;的魅力所在。</p>\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">　　众所周知，中国画基本是线条和墨的艺术，特别是山水画，都是由笔墨关系的构成而或图或画。笔者，墨者，历来众说纷纭。南派绘画大师潘天寿先生曾讲过：&ldquo;画者，画也，既以线为界，而或其画也。笔为骨，墨与彩色为血肉，气息神情为灵魂，风韵格趣为意志，能具此，活矣。</p>\r\n</span></span></p>', 2),
(13, '项目咨询', 5, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: Arial, 宋体; font-size: 14px" class="Apple-style-span">\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">中国画中的山水画自隋唐以来发展变化的轨迹犹如群山起伏，重峦叠嶂，高峰迭起，无论是工笔重彩的青绿山水，还是淡雅轻墨的水墨山水，都有其独特的面貌出现在历史的画卷之上，成为人类<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/painting/" target="_blank">绘画</a>文明史上的瑰宝，为世人所称道。林林总总的精美山水画卷，为后人留下了十分珍贵的精神财富。山水画之所以受到了人们的喜爱和欢迎，首先，主要是由于山水画所表现的内容能够代表或抒发出人们内心世界对世界的感受，能够宣泄出人们对现实的困惑、无奈，从而找到一个可以寓意抒情的载体进而达到&ldquo;畅神&rdquo;的目的，能够表现出人类对自然的&ldquo;观照&rdquo;思想和对自然现象的种种感悟；其次，山水画让人观之眼前为之一亮，心胸为之豁然，心潮为之起伏跌宕，能够产生出浮想联翩的奇思妙想。正如一些明白人所讲得，画养眼就是好看、耐看；心喜，就是观后心里产生快乐，从而产生了强烈的审美欲望，在心理上产生了一种文化积累后的爆发，产生出强烈的审美效果；第三，由于山水画具有&ldquo;咫尺之内，而瞻万里之遥；方寸之中，乃辨千寻之峻&rdquo;的浓缩和再现自然景观的功能，让真山真水重新耸立在人们的面前，使人不出门就能目睹奇山妙水的真面貌，这种将自然之妙通过<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/tag/50/bimo-24695/1.html" target="_blank">笔墨</a>关系的变化来再现给世人，使世人神游于大自然，感受到大自然的雄浑、清雅、苍郁、奇妙、独特等原始魅力，使人产生一种喜爱自然、关注自然、融入自然的感受，这也是山水画&ldquo;澄怀观&rdquo;和&ldquo;道法自然&rdquo;的魅力所在。</p>\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">　　众所周知，中国画基本是线条和墨的艺术，特别是山水画，都是由笔墨关系的构成而或图或画。笔者，墨者，历来众说纷纭。南派绘画大师潘天寿先生曾讲过：&ldquo;画者，画也，既以线为界，而或其画也。笔为骨，墨与彩色为血肉，气息神情为灵魂，风韵格趣为意志，能具此，活矣。</p>\r\n</span></span></p>', 1),
(14, '项目案例', 3, '<p><span style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium Simsun; white-space: normal; orphans: 2; letter-spacing: normal; color: rgb(0,0,0); word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" class="Apple-style-span"><span style="text-align: left; line-height: 18px; font-family: Arial, 宋体; font-size: 14px" class="Apple-style-span">\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">中国画中的山水画自隋唐以来发展变化的轨迹犹如群山起伏，重峦叠嶂，高峰迭起，无论是工笔重彩的青绿山水，还是淡雅轻墨的水墨山水，都有其独特的面貌出现在历史的画卷之上，成为人类<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/painting/" target="_blank">绘画</a>文明史上的瑰宝，为世人所称道。林林总总的精美山水画卷，为后人留下了十分珍贵的精神财富。山水画之所以受到了人们的喜爱和欢迎，首先，主要是由于山水画所表现的内容能够代表或抒发出人们内心世界对世界的感受，能够宣泄出人们对现实的困惑、无奈，从而找到一个可以寓意抒情的载体进而达到&ldquo;畅神&rdquo;的目的，能够表现出人类对自然的&ldquo;观照&rdquo;思想和对自然现象的种种感悟；其次，山水画让人观之眼前为之一亮，心胸为之豁然，心潮为之起伏跌宕，能够产生出浮想联翩的奇思妙想。正如一些明白人所讲得，画养眼就是好看、耐看；心喜，就是观后心里产生快乐，从而产生了强烈的审美欲望，在心理上产生了一种文化积累后的爆发，产生出强烈的审美效果；第三，由于山水画具有&ldquo;咫尺之内，而瞻万里之遥；方寸之中，乃辨千寻之峻&rdquo;的浓缩和再现自然景观的功能，让真山真水重新耸立在人们的面前，使人不出门就能目睹奇山妙水的真面貌，这种将自然之妙通过<a style="padding-bottom: 0px; margin: 0px; padding-left: 0px; padding-right: 0px; color: rgb(0,0,255); text-decoration: underline; padding-top: 0px" href="http://www.artxun.com/tag/50/bimo-24695/1.html" target="_blank">笔墨</a>关系的变化来再现给世人，使世人神游于大自然，感受到大自然的雄浑、清雅、苍郁、奇妙、独特等原始魅力，使人产生一种喜爱自然、关注自然、融入自然的感受，这也是山水画&ldquo;澄怀观&rdquo;和&ldquo;道法自然&rdquo;的魅力所在。</p>\r\n<p style="padding-bottom: 0px; text-indent: 24px; margin: 0px 0px 16px; padding-left: 0px; padding-right: 0px; padding-top: 0px">　　众所周知，中国画基本是线条和墨的艺术，特别是山水画，都是由笔墨关系的构成而或图或画。笔者，墨者，历来众说纷纭。南派绘画大师潘天寿先生曾讲过：&ldquo;画者，画也，既以线为界，而或其画也。笔为骨，墨与彩色为血肉，气息神情为灵魂，风韵格趣为意志，能具此，活矣。</p>\r\n</span></span></p>', 1),
(15, 'English', 8, '<p>Hello World</p>', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `serviceroot`
-- 

CREATE TABLE `serviceroot` (
  `id` bigint(20) NOT NULL auto_increment,
  `rootname` varchar(200) default NULL,
  `rootorder` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `serviceroot`
-- 

INSERT INTO `serviceroot` (`id`, `rootname`, `rootorder`) VALUES (1, '首页', 1),
(2, '关于清雅', 2),
(3, '项目案例', 3),
(4, '新闻资讯', 4),
(5, '项目咨询', 5),
(6, '加入我们', 6),
(7, '联系我们', 7),
(8, '站点内容', -1);

-- --------------------------------------------------------

-- 
-- 表的结构 `team`
-- 

CREATE TABLE `team` (
  `id` bigint(20) NOT NULL auto_increment,
  `teampic` varchar(256) default NULL,
  `teamname` varchar(200) default NULL,
  `teamjobs` varchar(200) default NULL,
  `teamdesc` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `team`
-- 

INSERT INTO `team` (`id`, `teampic`, `teamname`, `teamjobs`, `teamdesc`) VALUES (1, 'left_06.jpg', '成员1', '阿斯顿发生点', '<p>成员XXXXX</p>'),
(2, 'left_06.jpg', '成员2', '阿斯顿发生点2', '<p>成员XXXXX</p>'),
(3, 'left_06.jpg', '成员3', '阿斯顿发生点3', '<p>成员XXXXX</p>');
