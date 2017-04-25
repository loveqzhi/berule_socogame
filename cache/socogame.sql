-- MySQL dump 10.13  Distrib 5.5.38, for Linux (x86_64)
--
-- Host: localhost    Database: socogame
-- ------------------------------------------------------
-- Server version	5.5.38-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT 'password',
  `uuid` varchar(64) NOT NULL DEFAULT '' COMMENT '唯一uuid',
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '手机',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '显示昵称',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` enum('M','F','U') NOT NULL DEFAULT 'U' COMMENT '性别',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '状态 1正常,2锁定',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `accessed` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'root','$S$G65d74a5442cea7530176350c85ef8423ffab9c5f73a6be036ef1c838bf8a','root','15221816172','root','','M',1,1415939223,1418939223,1419939223),(2,'test','$S$h440e703cb666298fcccbf975bf128a4d3e980d82a3a1495ac6be41bb0ece','de8c11ab-ff99-4b44-a000-f7cabfe8bf58','15221816172','test','','F',1,1421746105,1421746105,1421746105);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类别',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keyword` varchar(255) DEFAULT '' COMMENT '关键字',
  `preview` varchar(255) DEFAULT '' COMMENT '预览图',
  `summary` varchar(255) DEFAULT '' COMMENT '摘要',
  `content` mediumtext NOT NULL COMMENT '正文',
  `source` varchar(50) DEFAULT '' COMMENT '文章来源',
  `author` varchar(30) DEFAULT '' COMMENT '作者',
  `click` int(10) NOT NULL DEFAULT '1' COMMENT '点击次数',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `type` (`type`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'news','上门服务2015将退潮，裸泳者现原形','','','O2O在2014年火了，上门服务也顺带沾光，但在2015年，我们可能会看到很多没有必要上门的创业项目烧完了钱数据也没有做起来，投资人停止输血的情况。这很正常，裸泳者终究会尴尬退场。','<p class=\"text\">&nbsp;&nbsp;&nbsp; 一个月之前，我写过一篇<a target=\"_blank\" href=\"http://lubei.baijia.baidu.com/article/40290\">分析O2O上门服务商业模式的稿子</a>，引起了不少创业者和投资人关注。步入2015年，作为一名曾经在O2O上门服务行业探索过的创业者，我想就自己的一点经验预测一下O2O上门服务在2015年的前景和钱景。</p><p class=\"text\"><strong>首先，我把上门服务分为实物配送和服务配送两类。</strong>实物配送的主要代表有社区001、爱鲜蜂、雅各库克等，它们主要配送大家日常生活所需要的米面油、牛奶饮料、蔬菜肉类。服务配送的主要代表有河狸家、爱大厨、阿姨帮、卡拉丁等，它们主要上门提供美甲、做饭、保洁、汽车保养等服务。</p><p class=\"text\">在<a target=\"_blank\" href=\"http://lubei.baijia.baidu.com/article/40290\">上一篇稿子</a>里，我提到，凡是不能响应并发需求的上门服务很难做大，我还是坚持这一观点，并且加上用户需求必须是高频这一条。</p><p class=\"text\"><strong>实物配送做高频订制是大方向</strong></p><p class=\"text\">首先看看实物配送这一块，社区001和爱鲜蜂主要提\r\n供米面油等日常必需品和牛奶饮料等快消品，这一类商品，特别是爱鲜蜂主打的快消品有一大特性，就是购买门槛特别低，几乎小区门口的便利店和居民楼底商都有\r\n售，而愿意使用手机购买爱鲜蜂商品的基本都是年轻人，这群人下班路上很容易顺道去小区便利店采购。</p><div class=\"quote\"><p>而且像牛奶饮料这一类产品，集中批量采购也很方便，一次买一周的量也很正常。爱鲜蜂的懒人用户最大的需求无非买包泡面、来两罐啤酒、四五罐饮料，男的可能偶尔来包烟，而那些真正对生活品质有要求的人不会在爱鲜蜂采购，大超市才是正道。</p></div><p class=\"text\">所以对于爱鲜蜂这种平均单价比超市贵5毛至3块，30元起送，满100元才免运费的服务，我是不看好的。<strong>原因有三个：门槛太高(100元免运费)、商品偏贵、需求不旺。</strong></p><div class=\"quote\"><p>至于社区001，如果按它对标的Instacart，将会是很有潜力的\r\n创业公司，但中美国情不同，Instacart整合的闲散劳动力在社区001变成了专职采购员、快递员，众包变承包，模式重不可言。但社区001提供的是\r\n强需求，特别是对不愿意去超市采购米面油的家庭主妇，以及体弱不能负重的中老年人而言，是一大福音，希望这家公司不要太快倒掉。</p></div><p class=\"text\">对标爱鲜蜂和社区001的京东快点据传亏得厉害，希望巨头做不起来的事创业公司能趟出一条新路。</p><p class=\"text\"><strong>雅各库克提供的是日常蔬果、肉类的快送，这些品类对于有需求的用户而言是天天都需要，绝对的高频和必需品。</strong>在\r\n北方的冬季，去菜市场买菜是一件比较煎熬的事情，一般菜市场距离居民楼都不近，顶着北风买菜不是件好差事。这在全国也大抵如此。所以做这个品类的订购，相\r\n较前面俩更有前景，一是高频，容易预估存货量，其二是配送高度集中化，大概一天配送两次就行，上午一次，下午一次，快递员效率容易最大化。用户养成习惯后\r\n头一天按需下单，雅各库克负责集合采买还能降低单价，从中抽成也很简单，商业模式清晰可见。</p><p class=\"text\">总的来说，对实物配送这一块的上门服务，<strong>我比较看好高频且容易定制化的创业项目。</strong></p><p class=\"text\"><strong>服务配送主要看性价比</strong></p><p class=\"text\">再来看服务配送，过去的一年涌现了很多服务类项目的上门服务初创团队，从美甲到美发，从做饭到汽车保养，几乎所有原来必须去门店才能享受的服务都被推到了用户家里。</p><p class=\"text\">对这一类项目我的观点是，<strong>提供服务和接受服务的双方必须性价比足够高才能持续。</strong></p><p class=\"text\">去门店化后，用户是否增加了单次费用，以及服务人员是否增加了收入，对创业公司至关重要。以河狸家为例，这家公司在推广过程中大量补贴，也吸引了很多白领女性使用，在不久前更是宣称日客单量突破7000单，一位美甲师被宣传1月15日当天订单收入达到1.6万元。<strong>我不得不佩服雕爷，这么高的数字都敢说，这得碰上多少个有钱没地花的主啊。</strong></p><div class=\"quote\"><p>任何一项服务，特别是雕爷计划烧5亿元力推的河狸家，终究要以大众消费\r\n者为主要目标用户，对于美甲而言，单次4000元毕竟是少数，我在河狸家APP上看到的只有两人做过，更多的还是集中在100元左右的普通美甲，这才是河\r\n狸家的核心竞争力。在这个价位上，美甲师在有限的时间段(前文已分析过，集中在工作日晚上、周末白天)能够覆盖多少客人?是否比原来在美甲店上班赚的多?\r\n不能随时上厕所的担忧是否影响美甲师手艺?恐怕还是有一堆疑问在等着雕爷解答吧。</p></div><p class=\"text\"><strong>让利用户，补贴美甲师只能解决一时的问题，要是能一直这样补贴下去雕爷也算活雷锋了。</strong></p><p class=\"text\">至于像爱大厨、卡拉丁这一类原来门店(饭店)优势太明显的创业项目，我不太看好，专业的还是交给专业的人去做，上门服务不是万能的。<strong>这一类项目最后可能会成为少数人专享的高品质生活的象征，收费必须足够高才能彰显土豪本色。</strong></p><p class=\"text\">而像阿姨帮这种整合了原有服务配送资源的创业项目，因为服务必须上门，反而有做大的可能。去中介化增加了保洁阿姨的收入，进而会提高服务质量，对买卖双方而言，性价比都得到了提高，这才算改造了一个行业。<strong>这才是服务配送的一大发展方向。</strong></p><p class=\"text\">O2O在2014年火了，上门服务也顺带沾光，但<strong>在2015年，我们可能会看到很多没有必要上门的创业项目烧完了钱数据也没有做起来，投资人停止输血的情况。</strong>这很正常，裸泳者终究会尴尬退场。</p><p><br/></p>','','',1,1,1,1421826217,1421827473),(2,'news','退春运火车票将入“收费期” 线路增多致退票量增加','','','新华网北京1月20日消息，从1月21日起，退春运首日车票将收取退票费。记者1月20日从各大铁路局了解到，自去年底全国铁路延长火车票预售期实行退改签新政后，各局退票量较往年均有所增加','<p style=\"text-indent:2em;display:block;\" align=\"left\">新华网北京1月20日消息，从1月21日起，退春运首日车票将收取退票费。记者1月20日从各大铁路局了解到，自去年底全国铁路延长火车票预售期实行退改签新政后，各局退票量较往年均有所增加。</p><p>&nbsp;</p><p style=\"text-indent:2em;display:block;\" align=\"left\">按照中国铁路总公司的规定，自2014年12月起，全国铁路延长客票预售期至60天，并开始实行新的退改签规则。对开车前15天以上退票的旅客，将不收取退票费。1月20日成为春运首日车票（2月4日）最晚免费退票日。</p><p>&nbsp;</p><p style=\"text-indent:2em;display:block;\" align=\"left\">长达两个月的预售期让旅客有了更多的\r\n选择，也让不少行程未定的旅客成了“囤票族”。据统计，目前，上海铁路局日均退票18万张左右，较去年日均增加6万余张。截至1月20日15时，西安铁路\r\n局春运期间退票总数达31万余张，其中2月4日至2月19日期间退票有10.9万余张，较往年同期也有大幅增加。退票方向主要集中在广州、北京、深圳、上\r\n海、太原等方向。</p><p>&nbsp;</p><p style=\"text-indent:2em;display:block;\" align=\"left\">此外，哈尔滨铁路局目前每日平均退票数量约29000张，同比去年每日增加3300张，呼和浩特铁路局统计显示，自1月10日开始，日退票量也在9000张左右，退车票方向主要集中在东北以及北京、成都、广州等方面。</p><p>&nbsp;</p><p style=\"text-indent:2em;display:block;\" align=\"left\">中国铁路客户服务中心12306网站表示，相关售票系统已得到进一步完善，以确保让退了的票能快速及时地回到销售系统里再出售，让需要的人能买到票。</p><p>&nbsp;</p><p style=\"text-indent:2em;display:block;\" align=\"left\">铁路部门表示，除了预售期的提前，去年新开线路增多也是导致退票量增加的一个因素。对于还未买上票的旅客，建议随时关注12306网站的余票信息。</p><p><br/></p>','','',1,1,1,1421827164,1421827465),(3,'news','沪指暴涨近5%超百点重返3300 权重大涨','','','沪指暴涨近5%超百点重返3300，深成指报11360点涨逾3%，创业板报1722点。','<p style=\"text-indent:2em;display:block;\" align=\"left\">从盘面上看，个股普涨，所有板块全线飘红，其中保险、交运设备、券商、铁路基建、民航机场、石油等板块涨幅居前，权重板块大涨，沪市847家上涨87家下跌，深市1203家上涨，237家下跌，两市上涨家数超2000家，近50家涨停。</p><p>&nbsp;</p><p>分析认为，在流动性宽裕、改革红利释\r\n放封杀系统性风险背景下，业绩增长确定性强的股票有望获得市场溢价。从业绩增长的确定性角度来看，一方面，以医药、食品饮料为代表的大消费板块有望保持较\r\n高业绩增速，且前期涨幅较小，中期布局价值较大；另一方面，业绩增速超预期，能够逐渐消化估值压力的优质成长股同样值得重点关注</p><p><br/></p>','','',1,1,1,1421827390,1421827390),(4,'game','《桑塔与海盗的诅咒》欧版将于2月5日登陆WiiU','','','桑塔与海盗的诅咒》是由WayForward所制作的一款2D横版动作游戏，此前游戏的美版已经于2014年12月25日登陆WiiU平台。而日前官方终于通过推特透露了游戏欧版的发售日','<p>《桑塔与海盗的诅咒》是由WayForward所制作的一款2D横版动作游戏，此前游戏的美版已经于2014年12月25日登陆WiiU平台。而日前官方\r\n终于通过推特透露了游戏欧版的发售日，确认这款游戏的WiiU版和3DS版均将于2015年2月5日登陆欧洲、新西兰和澳大利亚等地。</p><p align=\"center\"><img src=\"http://dev.socogame.com/cache/upload/images/20150121/14218277318636.jpg\" _src=\"http://dev.socogame.com/cache/upload/images/20150121/14218277318636.jpg\"/></p><p>据报道本作的WiiU版将提供off-TV功能，支持经典Pro手柄和WiiU Pro手柄。游戏中含有可解锁的海盗模式，存在多重游戏结局，并且包含由Jake “Virt” Kaufman打造的经典游戏原声。</p>','','',1,1,1,1421827745,1421827745),(5,'game','任天堂俱乐部新增20款VC游戏?60至200点兑换','','','任天堂在昨天宣布任天堂俱乐部即将停止服务后，随后公开了20个可用点数换取的VC游戏，详细列表如下','<p>任天堂在昨天宣布任天堂俱乐部即将停止服务后，随后公开了20个可用点数换取的VC游戏，详细列表如下</p><p align=\"center\"><img src=\"http://dev.socogame.com/cache/upload/images/20150121/14218278672584.jpg\" _src=\"http://dev.socogame.com/cache/upload/images/20150121/14218278672584.jpg\"/></p><p><strong>3DS</strong></p><p>打砖块 60点</p><p>超级马里奥大陆 80点</p><p>雪人兄弟 100点</p><p>塞尔达传说1 100点</p><p>银河战士 100点</p><p>谜之村雨城 100点</p><p>交易&amp;战斗：卡片英雄 120点</p><p>气球大战GB 120点</p><p><strong>Wii/Wii U</strong></p><p>快乐机器人格斗 100点</p><p>光之神话：帕鲁迪那之镜 100点</p><p>抢救彩虹 150点</p><p>FC文库：初次之森 150点</p><p>超级马里奥赛车 150点</p><p>1080°滑雪 200点</p><p>罪与罚：地球的继承者 200点</p><p><strong>Wii U</strong></p><p>F-ZERO GBA版 150点</p><p>超级马里奥弹珠台 150点</p><p>奇异：猴子们的宝岛</p><p>马里奥对大金刚 150点</p><p>瓦里奥制造 150点</p>','','',1,1,1,1421827875,1421827875),(6,'news','索乐沈烨[燃烧的蔬菜]品牌化漫画千万级量','','','6月8日， 2014年第5期GAMELOOK游戏开放日活动在北京成功举行，此次活动由乐元素独家赞助支持。','<p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">&nbsp; 6月8日，&nbsp;2014年第5期GAMELOOK游戏开放日活动在北京成功举行，此次活动由乐元素独家赞助支持。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 大会现场，索乐游戏CEO&nbsp;沈烨&nbsp;从品牌打造和休闲游戏制作的体会两个方面作了《休闲手机游戏的系列化、品牌化》的主题分享。</span></span></p><p align=\"center\"><img src=\"http://dev.socogame.com/cache/upload/images/20150122/14219116917698.jpg\" _src=\"http://dev.socogame.com/cache/upload/images/20150122/14219116917698.jpg\"/></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">《燃烧的蔬菜》手机拥有累计过亿的用户，在谈及如何将该游戏品牌化时，沈烨提到：“休闲游戏拥有一定的人气后就要去发挥它的价值，索乐现在成立了拍摄公司，在做动画。《燃烧的蔬菜》的漫画现在在线下连载，用户已经达到千万级，索乐还在尝试做音乐，休闲游戏一定要打造文化品牌，立足泛娱乐产业链。”</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 索乐对休闲游戏是如何理解的呢？沈烨提出了“内外兼修，抓住灵魂”的概念，抓住游戏的核心玩法，做好游戏的卖相，不断优化数据，调试、迭代、提升产品内在质量。详细内容请看现场采访实录。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(255, 0, 0);\"><strong style=\"margin: 0px; padding: 0px;\">以下是现场演讲实录：</strong></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">沈烨：大家好，我是沈烨，来自索乐游戏。很高兴今天能跟站在这里跟大家分享一些关于“《燃烧的蔬菜》品牌化和系列化”方面我们所做的一些工作。今天没有准备材料，我就从两个方面跟大家做一下分享。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(255, 0, 0);\"><strong style=\"margin: 0px; padding: 0px;\">打造休闲游戏文化品牌，立足泛娱乐产业链</strong></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">第一个方面是关于《燃烧的蔬菜》文化品牌的打造。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">《燃烧的蔬菜》这款休闲游戏已经自然的获得大量的粉丝，《燃烧的蔬菜》现在手机端上已经累计过亿的用户，然而中国现在已经出现拥有上千万用户休闲手机游戏，这很值得我们学习。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">我觉得休闲游戏是能够自然获取到大量用户的。休闲游戏最大的好处就是当它获得一定的人气之后，后面要考虑如何发挥它的价值，因为数学模型是不同的。索乐也在思考这个为题，如何去发挥《燃烧的蔬菜》的人气价值，打造文化品牌。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">索乐现在不仅仅是一家游戏公司，我们现在成立了一家拍摄公司，我们在拍《燃烧的蔬菜》；除此之外，我们做了《燃烧的蔬菜》的漫画，我们仅仅在线下期刊上连载，现在量能够过千万级。能够达到千万级的量，因为两个期刊，一个叫《我们爱科学》，还一个叫《中国少年》，都是我们小时候非常有名的期刊，都在连载，而且这是付费的，这是千万级的。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">我们也尝试做了表情，今年刚开始做。今年情人节做一个多月就有千万人下载，我们蔬菜的表情也应该在千万级以上。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">我们还做过音乐，今年我们想把音乐的事情好好做一下，下一步我们能做出成绩来再跟大家分享。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">总而言之，我们想把《燃烧的蔬菜》做成一个文化品牌，核心是怎么样形成各类的文化产品，尤其是动画、漫画、电影、音乐、阅读这些其实都是文化产品，我们怎么样做出精品，然后又有很多粉丝，最终我们为这个品牌不断的注入内涵，这是我们要考虑和要做的。我们的目标是成为一个00后最喜爱的文化品牌，这是《燃烧的蔬菜》的探索，我们基础还是游戏，今年我们会推出新一代的游戏产品，我们会逐渐发布新的游戏产品。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(255, 0, 0);\"><strong style=\"margin: 0px; padding: 0px;\">做休闲游戏：抓灵魂、内外兼修</strong></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">下面我讲一下索乐对休闲游戏的理解，我们是如何做一款成功的休闲游戏的，如何成为休闲游戏的高手。我觉得做好的休闲游戏需要具备三个核心，第一是灵魂，第二是内功，第三是外功，也就是怎么样从灵魂到内外兼修做出优秀的游戏。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\"><strong style=\"margin: 0px; padding: 0px;\">什么是灵魂呢，我们觉得核心玩法是灵魂。</strong>比如三消游戏，三消就类似于炒青菜，每家每户都可以炒青菜，怎么样炒出国宴级的青菜，或者是销魂菜，每一关我觉得它都非常耐人寻味的。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">我们花了很多心思去做这些关卡，因为在数据模型稳定情况下，我觉得中国人最强大的是数学和逻辑能力。数学模型上，我们总觉得中国高考让大家数学都特别好，但是中国人特别差的是想象力，所以<strong style=\"margin: 0px; padding: 0px;\">我们觉得要么就是在一种非常主流的休闲游戏的玩法上，去把它做出深度；要么就是做出一种全新的玩法，并且这种玩法不是你认为好，而是有广大的受众范围</strong>，《植物大战僵尸》就是一个非常典型的例子，Popcap做过很多游戏，在国内最火的当属《植物大战僵尸》了。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">我觉得能够开创一种玩法，并且能够风靡这是一件非常了不起的事情，这是需要建立在一个非常大的代价之上，什么叫代价呢？就是试做成本，需要很多人花很多时间不断的试做，去思考、沉淀。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">索乐的单机游戏的团队从2005年开始做JAVA时代的单机游戏，市面上各种类型的游戏我们都做过，比如三消、跑酷等，各种类型不成功的做过好几十款，后来想到说做一款形象上不一样的游戏，所以选了蔬菜，在玩法上选择了弹射塔防，后来我们面临了非常大的挑战，如何把这种弹射塔防做的非常有趣，这是我们现在一直每天在思考和努力工作的一个地方。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\"><strong style=\"margin: 0px; padding: 0px;\">做休闲游戏要么把一种大的内容做深，要么开创一种玩法，这些要求比较高。</strong></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\"><strong style=\"margin: 0px; padding: 0px;\">其实还有一种就是所谓C2C</strong>，我们看到很多非常好的游戏的核心玩法，尤其是国外创造了很多的游戏玩法，在一个知识产权底限的前提下，结合中国一种新的定位，把它做好。据我们了解除了俄罗斯方块，大多数游戏是没有专利的。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">我们也看到一些典型的例子，像《保卫萝卜》、《找你妹》，在美国都有原型游戏，关键是非常好的继承这个精神，找到非常好的细分，把它做精就行了，我觉得核心玩法是我们做好休闲游戏的灵魂。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\"><strong style=\"margin: 0px; padding: 0px;\">第二个是内功，内功需要很多的积累</strong>，比如说刚刚乐园素《开心消消乐》制作人甘玉磊讲的，休闲游戏一定要注重视觉、听觉的反馈。手机游戏现在成千上万了，如果一款产品形象如果太丑，或者没有亮点是很难留住用户的。我们看到《开心消消乐》这个形象非常讨人喜欢，不仅是形象，甚至里面的声音，包括腾讯的《天天爱消除》，我们听它前面唱的那首歌，看他的画面，就已经有足够HI的心情去玩了。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">然后再讲一下技术和引擎。我们看国外的游戏确实做的很牛，但是游戏包体有1个多G，国内很多用户的手机都装不下，既要做到非常好的表现，同时兼顾到市场的终端和网络环境，这个时候需要好的引擎或者好的解决方案，当然市面上有很多可以参考的引擎。对于我们公司来讲，我们用了一个挺笨的方法，iOS用Unity做的，Andriod用自己的一套程序做的，做一个很小的包体，所以满足两边的需求，因此我觉得基于这种技术的积累，知识需要一点时间去沉淀。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">另外一方面在于调数据，这是一个基本功。其实每一款游戏都会碰到一个问题，怎么样去不断的优化数据，可能需要时间一点一点去调，调整各种数值，这就要求有一套比较好的数据分析系统和解决方案。另外，游戏还要不断去试，我们现在看到运营商也提供了一些服务，我觉得这个挺好的。先在一些运营商平台把自己的休闲游戏先调好，调整好之后再放到十大平台做联运，这个是一个比较稳妥的办法。</span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\">休闲游戏一定要不断的修整这个数据模型，不断的迭代版本，最终形成一个比较好的流程，比较大的DAU。包括你的朋友怎么样理解你的艺术和技术，怎么形成一个比较讨人喜爱的一款产品。可能有些东西做的特别专业，但是面对的用户群比较小。你必须兼顾专业性和普通大众喜好和理解程度。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px;\"><strong style=\"margin: 0px; padding: 0px;\">第三个是外力，即营销与渠道推广。</strong>只有当我们认为这款游戏的数据非常好，非常吸量，有IP，或者大家一看就喜欢上它，这种情况下投入大规模的营销。同时获得广大渠道的发力推广。</span></span></p><p style=\"margin: 8px 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">营销该怎么做？比如说你去做品牌的广告，你怎么样做购买流量的广告，包括像我们拍动画片，我们觉得目前从动画片商业模式来看亏损是肯定的，但是为什么去投这个事情？我们觉得还是想利用它做支撑。至少现在是这样，我们觉得动画片这个行业也正在改变之中，所以通过各式各样的方式做宣传，让大家知道这见事情，喜欢这件事情，并且当你的产品本身的基础很好的时候，当你的营销足够好的时候，渠道正面的推进才是一个比较有效的，这样才能换来各大渠道长期的支持，这个东西是需要天时地利人和的，关键是练好自己的内功，内外检修，抓好灵魂，这样能够形成优秀的休闲游戏，谢谢大家。</span></p><p align=\"center\"><br/></p>','','',1,1,1,1421911722,1421911722),(7,'news','圣诞特辑：圣诞节不得不玩的游戏 《燃烧的蔬菜季节版》','','','《燃烧的蔬菜季节版》于12月19日登陆安卓市场，一经上线，瞬间吸引众多粉丝蜂拥下载，下载量节节攀升。华丽的圣诞场景、炫酷的弹射快感、超萌的蔬菜声音','<p><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\">《燃烧的蔬菜季节版》于12月19日登陆安卓市场，一经上线，瞬间吸引众多粉丝蜂拥下载，下载量节节攀升。华丽的圣诞场景、炫酷的弹射快感、超萌的蔬菜声音，都让人称赞不已，看来又一股势不可挡的萌物正在俘获众多伙伴们的内心。</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"><img src=\"http://dev.socogame.com/cache/upload/images/20150122/14219117837603.jpg\" _src=\"http://dev.socogame.com/cache/upload/images/20150122/14219117837603.jpg\"/></span></p><p><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\">《燃烧的蔬菜》使用3D抛物线式弹射方法，让游戏更快、更准、更好玩，同时也解放了小伙伴们的双手，只要动一根手指，选位、拉扯、发射只需三步，即可完成不同蔬菜宝宝的绝杀技能比如定位打击、致命一击、连环出击等多种炫酷技能。这种多彩的功能玩法赋予了手游全新活力，小伙伴们完全可以切换自如、乐在其中。用最简单的操作带来最炫酷的绝杀，全民都可当高手。</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"><br/></span></p><p><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\">史上最强的蔬菜大军就在《燃烧的蔬菜季节版》，超级大番番分身术助力最火爆的圣诞战场。华美的画面与流畅的对战，在3D技术打造的游戏里，即使蔬菜争霸终极boss这种大场面也丝毫不会使游戏的卡顿。蔬菜技能一触即发，短暂的特写镜头更是将华丽无比的炫酷特效完全展露在小伙伴面前，绝对的视觉享受，绝对的心灵震撼。</span><span style=\"color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"></span></p>','','',1,1,1,1421911811,1421911811),(8,'game','空战大作《空战英豪2》即将上线，各渠道争相造势','','','空战大作来了！精致逼真的史诗级画面，足以媲美好莱坞电影大片；二战经典机型英姿重现，火爆畅爽的射击轰炸场面，将彻底点燃你内心热情之火','<p><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: -webkit-left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"><span class=\"Apple-converted-space\">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 空战大作来了！精致逼真的史诗级画面，足以媲美好莱坞电影大片；二战经典机型英姿重现，火爆畅爽的射击轰炸场面，将彻底点燃你内心热情之火。索乐游戏全球独家首发，精品空战游戏《空战英豪2》将于9月25日震撼上线，据悉届时各大手游渠道均会推出精彩活动，为游戏激情造势。从空前强大的活动力度，完全可以看出各渠道将这款大作的价值发挥至最佳的决心。</span></p><p><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: -webkit-left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"><img src=\"http://dev.socogame.com/cache/upload/images/20150122/1421911872438.jpg\" _src=\"http://dev.socogame.com/cache/upload/images/20150122/1421911872438.jpg\"/></span></p><div style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\" align=\"left\"><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">渠道争相造势 精彩活动豪礼不停送<br style=\"margin: 0px; padding: 0px;\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9月25日《空战英豪2》将于360、百度、腾讯、豌豆荚、安智、UC、金山、可可游戏、小米、爱奇艺、联想、酷派、金立、搜狗、千尺、华为、VIVO、酷狗、天奕达（排名不分先后）等各大渠道首发。<br style=\"margin: 0px; padding: 0px;\"/>顶级水准游戏画面，超凡卓越的游戏品质，《空战英豪2》横空出世，不仅令国内数以亿计的玩家得以品尝这款空战射击游戏大餐，也让国内各大手游市场渠道及IT软硬件厂商热情饱满，他们早嗅到了奇货可居的味道，纷纷狂掷万金。据悉，届时各大渠道将陆续推出各类精彩活动和不计其数的游戏豪礼来吸引用户。同时这款游戏也会支持全网手机付费，方便广大玩家体验游戏。</span></div><p><span style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; background-color: rgb(255, 255, 255);\"></span></p><div style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体, Arial, Meiryo, Verdana; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);\" align=\"left\"><br style=\"margin: 0px; padding: 0px;\"/><span style=\"margin: 0px; padding: 0px; font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; color: rgb(102, 102, 102);\">电影级战争画面 精心重现二战场面&nbsp;&nbsp;<br style=\"margin: 0px; padding: 0px;\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 移动平台的特点决定了手游必须具备快速上手、最短时间内吸引到玩家等特征，《空战英豪2》制作者们显然深谙此道，游戏可以说是完全做到了让人一见钟情。采用Unity3D引擎，打造出高大上的电影级绚丽视觉效果，可谓让人眼前一亮。<br style=\"margin: 0px; padding: 0px;\"/>&nbsp;&nbsp;&nbsp;&nbsp; 《空战英豪2》中战斗机盘旋来去，机枪呼啸怒射，炸弹雨点般降落，地面浓烟飘扬，爆炸四起，配以震撼劲爆的音效，以及精心打造的天气变化效果，玩家们立刻就能身临其境的感受到二战时期那种风云动荡、瞬息万变的战争氛围。</span></div><p><br class=\"Apple-interchange-newline\"/></p><p><br/><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft YaHei&#39;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.2000007629395px; orphans: auto; text-align: -webkit-left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);\"></span></p>','','',1,1,1,1421911892,1421911892);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
  `department` varchar(100) NOT NULL DEFAULT '' COMMENT '部门',
  `preview` varchar(255) DEFAULT '' COMMENT '预览图',
  `summary` varchar(255) DEFAULT '' COMMENT '摘要',
  `content` mediumtext NOT NULL COMMENT '正文',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='联系我们';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'小李子','socogame@socogame.com','投资并购','','','',1,1,1421901147,1421901147),(2,'小木三','socogame@socogame.com','客户服务','','','',1,1,1421901181,1421901322);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culture`
--

DROP TABLE IF EXISTS `culture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `culture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类别',
  `subtype` varchar(20) DEFAULT '' COMMENT '子类别',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keyword` varchar(255) DEFAULT '' COMMENT '关键字',
  `preview` varchar(255) DEFAULT '' COMMENT '预览图',
  `summary` varchar(255) DEFAULT '' COMMENT '摘要',
  `content` mediumtext COMMENT '正文',
  `source` varchar(500) DEFAULT '' COMMENT '来源',
  `author` varchar(30) DEFAULT '' COMMENT '作者',
  `participant` varchar(255) DEFAULT '' COMMENT '参与者',
  `up` varchar(50) DEFAULT '' COMMENT '更新到',
  `tag` varchar(50) DEFAULT '' COMMENT '标签',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`name`),
  KEY `type` (`type`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文化品牌';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture`
--

LOCK TABLES `culture` WRITE;
/*!40000 ALTER TABLE `culture` DISABLE KEYS */;
INSERT INTO `culture` VALUES (1,'cartoon','','航海王','xxxxxx','/cache/upload/images/20150122/20150122_869456.PNG','',NULL,'http://www.baidu.com','xxx','xxxxx','20','',1,1,1421893272,1421999948),(2,'music','','我都记得','','/cache/upload/images/20150122/20150122_585717.PNG','',NULL,'http://music.baidu.com/album/131095271?pst=shoufa','A-Lin','','','new',1,1,1421894246,1422000149),(3,'caricature','1','昆虫世界','','/cache/upload/images/20150122/20150122_270800.PNG','',NULL,'http://image.baidu.com/i?tn=redirect&word=j&juid=911B47&sign=ciecwoiowi&url=http%3A%2F%2Ffat.2081.org%2Fitem%2F8_49_17106648.html','','','','',1,1,1421894798,1421895042),(4,'other','3','测试图片1','','/cache/upload/images/20150122/20150122_289128.PNG','',NULL,'http://www.ranshaodeshucai.com/channels/68.html','','','','',1,1,1421895478,1421895517),(5,'caricature','2','百度图片','','/cache/upload/images/20150123/20150123_530340.jpg','',NULL,'http://dandan198605.tuchong.com/6667023/7368366/','','','','',1,1,1421992758,1421992758);
/*!40000 ALTER TABLE `culture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_field_node_image`
--

DROP TABLE IF EXISTS `data_field_node_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_field_node_image` (
  `entity_type` varchar(32) NOT NULL,
  `entity_id` int(10) NOT NULL,
  `delta` int(10) NOT NULL,
  `field_node_image_name` varchar(255) DEFAULT NULL COMMENT '图片名称',
  `field_node_image_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `field_node_image_type` varchar(50) DEFAULT NULL COMMENT '类型',
  `field_node_image_href` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `field_node_image_src` varchar(255) NOT NULL COMMENT '图片source',
  `field_node_image_description` longtext COMMENT '描述',
  `field_node_image_data` longblob COMMENT 'other option',
  PRIMARY KEY (`entity_type`,`entity_id`,`delta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='节点图片';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_field_node_image`
--

LOCK TABLES `data_field_node_image` WRITE;
/*!40000 ALTER TABLE `data_field_node_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_field_node_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_field_role_permission`
--

DROP TABLE IF EXISTS `data_field_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_field_role_permission` (
  `entity_type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Entity Type',
  `entity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Entity ID',
  `delta` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '复数排序',
  `field_role_permission_permission` varchar(128) NOT NULL DEFAULT '' COMMENT '权限名称',
  `field_role_permission_data` longblob COMMENT '权限序列化数据',
  PRIMARY KEY (`entity_type`,`entity_id`,`delta`),
  KEY `entity_type_id` (`entity_type`,`entity_id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_field_role_permission`
--

LOCK TABLES `data_field_role_permission` WRITE;
/*!40000 ALTER TABLE `data_field_role_permission` DISABLE KEYS */;
INSERT INTO `data_field_role_permission` VALUES ('role',1,0,'/admin/article/news','a:6:{s:5:\"title\";s:12:\"新闻动态\";s:11:\"description\";s:12:\"新闻动态\";s:6:\"module\";s:7:\"article\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,1,'/admin/article/game','a:6:{s:5:\"title\";s:12:\"游戏资讯\";s:11:\"description\";s:12:\"游戏资讯\";s:6:\"module\";s:7:\"article\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,2,'/admin/game/standalone','a:6:{s:5:\"title\";s:12:\"单机游戏\";s:11:\"description\";s:12:\"单机游戏\";s:6:\"module\";s:4:\"game\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,3,'/admin/game/online','a:6:{s:5:\"title\";s:12:\"联网游戏\";s:11:\"description\";s:12:\"联网游戏\";s:6:\"module\";s:4:\"game\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,4,'/admin/culture/cartoon','a:6:{s:5:\"title\";s:12:\"动画产品\";s:11:\"description\";s:12:\"动画产品\";s:6:\"module\";s:7:\"culture\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,5,'/admin/culture/music','a:6:{s:5:\"title\";s:12:\"音乐作品\";s:11:\"description\";s:12:\"音乐作品\";s:6:\"module\";s:7:\"culture\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,6,'/admin/culture/caricature','a:6:{s:5:\"title\";s:12:\"文化动漫\";s:11:\"description\";s:12:\"文化动漫\";s:6:\"module\";s:7:\"culture\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,7,'/admin/culture/other','a:6:{s:5:\"title\";s:12:\"系列周边\";s:11:\"description\";s:12:\"系列周边\";s:6:\"module\";s:7:\"culture\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,8,'/admin/recruitment/search','a:6:{s:5:\"title\";s:12:\"在招岗位\";s:11:\"description\";s:12:\"在招岗位\";s:6:\"module\";s:11:\"recruitment\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,9,'/admin/contact/search','a:6:{s:5:\"title\";s:12:\"商务合作\";s:11:\"description\";s:12:\"商务合作\";s:6:\"module\";s:7:\"contact\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,10,'/admin/picture/home','a:6:{s:5:\"title\";s:12:\"首页横幅\";s:11:\"description\";s:12:\"首页横幅\";s:6:\"module\";s:7:\"picture\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,11,'/admin/picture/staff','a:6:{s:5:\"title\";s:12:\"员工风采\";s:11:\"description\";s:12:\"员工风采\";s:6:\"module\";s:7:\"picture\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,12,'/admin/user/search','a:6:{s:5:\"title\";s:12:\"用户列表\";s:11:\"description\";s:12:\"更新地区\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,13,'/admin/user/add','a:6:{s:5:\"title\";s:12:\"添加用户\";s:11:\"description\";s:12:\"添加用户\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,14,'/admin/user/edit','a:6:{s:5:\"title\";s:12:\"编辑用户\";s:11:\"description\";s:12:\"编辑用户\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,15,'/admin/role/search','a:6:{s:5:\"title\";s:12:\"角色列表\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,16,'/admin/role/add','a:6:{s:5:\"title\";s:12:\"添加角色\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',1,17,'/admin/role/edit','a:6:{s:5:\"title\";s:12:\"编辑角色\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,0,'/admin/user/search','a:6:{s:5:\"title\";s:12:\"用户列表\";s:11:\"description\";s:12:\"更新地区\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,1,'/admin/user/add','a:6:{s:5:\"title\";s:12:\"添加用户\";s:11:\"description\";s:12:\"添加用户\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"2\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,2,'/admin/user/edit','a:6:{s:5:\"title\";s:12:\"编辑用户\";s:11:\"description\";s:12:\"编辑用户\";s:6:\"module\";s:4:\"user\";s:8:\"quantity\";s:1:\"3\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,3,'/admin/role/search','a:6:{s:5:\"title\";s:12:\"角色列表\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,4,'/admin/role/add','a:6:{s:5:\"title\";s:12:\"添加角色\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}'),('role',2,5,'/admin/role/edit','a:6:{s:5:\"title\";s:12:\"编辑角色\";s:11:\"description\";s:12:\"更新角色\";s:6:\"module\";s:4:\"role\";s:8:\"quantity\";s:1:\"1\";s:9:\"inherited\";s:0:\"\";s:7:\"warning\";s:0:\"\";}');
/*!40000 ALTER TABLE `data_field_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_config`
--

DROP TABLE IF EXISTS `field_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_config` (
  `id` int(10) unsigned NOT NULL COMMENT '自增主键',
  `entity_type` varchar(64) NOT NULL DEFAULT '' COMMENT 'Entity Type',
  `field_name` varchar(128) NOT NULL DEFAULT '' COMMENT '字段名称',
  `data` longblob NOT NULL COMMENT '字段信息',
  `active` tinyint(1) NOT NULL COMMENT '是否启用',
  `locked` tinyint(1) NOT NULL COMMENT '是否锁定',
  PRIMARY KEY (`id`),
  KEY `entity_type` (`entity_type`,`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字段配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_config`
--

LOCK TABLES `field_config` WRITE;
/*!40000 ALTER TABLE `field_config` DISABLE KEYS */;
INSERT INTO `field_config` VALUES (1,'role','field_role_permission','a:1:{s:7:\"columns\";a:2:{s:10:\"permission\";a:7:{s:11:\"description\";s:12:\"权限名称\";s:4:\"type\";s:7:\"varchar\";s:7:\"default\";s:0:\"\";s:8:\"not null\";b:1;s:8:\"key type\";s:0:\"\";s:9:\"increment\";b:0;s:7:\"decimal\";i:0;}s:4:\"data\";a:7:{s:11:\"description\";s:21:\"权限序列化数据\";s:4:\"type\";s:8:\"longblob\";s:7:\"default\";N;s:8:\"not null\";b:0;s:8:\"key type\";s:0:\"\";s:9:\"increment\";b:0;s:7:\"decimal\";i:0;}}}',1,0);
/*!40000 ALTER TABLE `field_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '游戏类别',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '游戏名称',
  `keyword` varchar(255) DEFAULT '' COMMENT '关键字',
  `mode` int(4) NOT NULL DEFAULT '1' COMMENT '1手机游戏2网页游戏',
  `preview` varchar(255) DEFAULT '' COMMENT '预览图',
  `summary` varchar(255) DEFAULT '' COMMENT '摘要',
  `content` mediumtext NOT NULL COMMENT '正文',
  `source` varchar(500) DEFAULT '' COMMENT '来源',
  `click` int(10) NOT NULL DEFAULT '1' COMMENT '点击次数',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `top` int(4) NOT NULL DEFAULT '0' COMMENT '1置顶',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`status`),
  KEY `name` (`name`),
  KEY `top` (`top`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='集团游戏';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'standalone','鬼泣5简体中文版(2DLC)(汉化V3.0)','',2,'/cache/upload/images/20150121/20150121_848922.jpg','《鬼泣5》是继《鬼泣4》之后的Capcom又一新作，其内容是围绕系列主角但丁年轻时的故事展开，并且这','<p>《鬼泣5》是继《鬼泣4》之后的Capcom又一新作，其内容是围绕系列主角但丁年轻时的故事展开，并且这一代Capcom交给了曾经制作《天剑》的工作\r\n室Ninja Theory来制作。虽然许多玩家对这款游戏存在很大争议，但是《鬼泣5》还是依靠稳健的实力获得了各方媒体及玩家的认可。\r\n\r\n　　《鬼泣5》中开发商将但丁投置在一个更新更好的世界中，华美的打击系统和自成一派的风格足以让老但丁心安。这款数位动作游戏打磨精良，主角玩世不恭，\r\n加之枪火的调味，足以使人沉浸在浴血的嗜杀中。就连“鬼泣之父”神谷英树也称它是一款非常独特的游戏。\r\n　　在《鬼泣》这部“重生”之作中，英国工作室Ninja \r\nTheory对但丁和维吉尔老哥俩之间的关系进行了新的解释。二人之间的矛盾和围绕此展开的诸神的战争在本作中都有着非常合理的理由，而打斗和枪战则变得\r\n更加炫酷更加不合理不科学，最终呈现给我们的就是流畅，震撼，异常文艺的屠魔体验。\r\n　　《鬼泣5》中的敌人AI和战斗系统一样设计出色，给玩家留有很大余地。游戏设计有五个难度等级，第一个难度等级下面又分为三个等级，以对新手玩家多些\r\n照顾。战斗设计的很公平很合理，但绝不简单。Ninja \r\nTheory还非常贴心的提供了训练模式，这是《鬼泣》系列中重大的功能补充。　　《鬼泣5》是继《鬼泣4》之后的Capcom又一新作，其内容是围绕系\r\n列主角但丁年轻时的故事展开，并且这一代Capcom交给了曾经制作《天剑》的工作室Ninja \r\nTheory来制作。虽然许多玩家对这款游戏存在很大争议，但是《鬼泣5》还是依靠稳健的实力获得了各方媒体及玩家的认可。\r\n\r\n　　《鬼泣5》中开发商将但丁投置在一个更新更好的世界中，华美的打击系统和自成一派的风格足以让老但丁心安。这款数位动作游戏打磨精良，主角玩世不恭，\r\n加之枪火的调味，足以使人沉浸在浴血的嗜杀中。就连“鬼泣之父”神谷英树也称它是一款非常独特的游戏。\r\n　　在《鬼泣》这部“重生”之作中，英国工作室Ninja \r\nTheory对但丁和维吉尔老哥俩之间的关系进行了新的解释。二人之间的矛盾和围绕此展开的诸神的战争在本作中都有着非常合理的理由，而打斗和枪战则变得\r\n更加炫酷更加不合理不科学，最终呈现给我们的就是流畅，震撼，异常文艺的屠魔体验。\r\n　　《鬼泣5》中的敌人AI和战斗系统一样设计出色，给玩家留有很大余地。游戏设计有五个难度等级，第一个难度等级下面又分为三个等级，以对新手玩家多些\r\n照顾。战斗设计的很公平很合理，但绝不简单。Ninja Theory还非常贴心的提供了训练模式，这是《鬼泣》系列中重大的功能补充。</p><p><br/></p>','http://baidu.com/',1,1,0,1,1421831558,1421914000),(2,'standalone','xxxxxxxx','',2,'/cache/upload/images/20150122/20150122_056784.jpg','','','http://123.com',1,1,1,1,1421910868,1421914007),(3,'online','11111','',2,'/cache/upload/images/20150122/20150122_176318.jpg','','','http://baidu.com',1,1,0,1,1421910942,1421910942),(4,'standalone','123123','',1,'/cache/upload/images/20150122/20150122_988733.jpg','','','http://berule.com',1,1,0,1,1421910976,1421910976),(5,'standalone','模拟人生4：创造市民试玩版','',2,'/cache/upload/images/20150123/20150123_091820.PNG','','','http://www.91danji.com/news/78292.html',1,1,0,1,1422002495,1422002495),(6,'online','狙击精英3：非洲简体中文版','',2,'/cache/upload/images/20150123/20150123_400516.PNG','','','http://iwan.baidu.com/singlegame/detailPcgame?gameid=1004232&zt=ps&from=29154&psquery=%E5%8D%95%E6%9C%BA%E6%B8%B8%E6%88%8F&qid=12823794416162450171',1,1,0,1,1422002591,1422002591);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类别',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `preview` varchar(255) NOT NULL DEFAULT '' COMMENT '预览图',
  `source` varchar(500) NOT NULL COMMENT '来源',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='图文信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture`
--

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` VALUES (1,'home','测试图片123','/cache/upload/images/20150122/20150122_769813.jpg','http://baidu.com/123',1,1,1421903108,1421912296),(2,'home','首页大图','/cache/upload/images/20150122/20150122_512293.jpg','http://www.berule.com',1,1,1421907579,1421915489),(3,'staff','第一张员工图','/cache/upload/images/20150122/20150122_844503.PNG','http://baiduc.om',1,1,1421915568,1421915568),(4,'home','测试大图','/cache/upload/images/20150122/20150122_533055.jpg','http://berule.com',1,1,1421915665,1421915665),(5,'staff','百度员工','/cache/upload/images/20150123/20150123_698682.jpg','http://baiduc.om',1,1,1422002981,1422002981),(6,'staff','百度员工','/cache/upload/images/20150123/20150123_554716.PNG','http://baiduc.om',1,1,1422003128,1422003128);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recruitment`
--

DROP TABLE IF EXISTS `recruitment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recruitment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` int(4) NOT NULL DEFAULT '1' COMMENT '类别',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '职位名称',
  `keyword` varchar(255) DEFAULT '' COMMENT '关键字',
  `preview` varchar(255) DEFAULT '' COMMENT '预览图',
  `summary` varchar(255) DEFAULT '' COMMENT '摘要',
  `content` mediumtext NOT NULL COMMENT '正文',
  `source` varchar(255) DEFAULT '' COMMENT '来源',
  `click` int(10) NOT NULL DEFAULT '1' COMMENT '点击次数',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态1显示0已删除',
  `adminid` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`status`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='招贤纳士';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recruitment`
--

LOCK TABLES `recruitment` WRITE;
/*!40000 ALTER TABLE `recruitment` DISABLE KEYS */;
INSERT INTO `recruitment` VALUES (1,1,'APP设计师','','','','<p><br/></p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">岗位职责：</p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">1、负责移动App和网页的用户界面设计,根据产品原型进行具体UI设计（包括界面风格、布局细节处理、icon绘制等）； 2、独立完成UI相关图形设计工作，能根据产品的设计思路设计对应配套的UI； 3、总结和制定产品视觉规范； 4、参与产品构思及界面优化，提出对产品界面规划的见解，把控产品最终界面实现效果。</p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">任职要求： <br/></p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">1、美术类、设计类专业，2年以上UI设计资历； 2、熟练使用Photoshop，Illustrator等设计软件； 3、熟悉iOS和Android交互体验和UI设计规范； 4、具备良好合作态度及团队精神，色彩感、形式感强，视野开阔，创意丰富； 5、拥有良好的绘画功底者，美术基础者优先； 6、有Android、iOS等App设计经验者优先； 面试请提供个人作品。</p><p><br/></p>','百度',1,1,1,1421898602,1421899225),(2,4,'APP产品运营','','','','<p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">岗位描述：<br style=\"outline: none;\"/>1. 负责店铺内容的更新与专题的选题、设计、版式、策划、编辑和组织完成，及时反映爆点；<br style=\"outline: none;\"/>2. 负责公司店铺对外宣传文稿策划编写；<br style=\"outline: none;\"/>3、熟悉网络推广（搜索引擎推广与SEM），户外媒体推广方案（根据当季度推广方案确定）自己能够独立操作推广；<br style=\"outline: none;\"/>4、能够撰写项目攻略与活动攻略，根据项目内容撰写关于本项目的软文，广告文案等宣传品，完场一定的SEO，论坛，博客营销等内容；<br style=\"outline: none;\"/>5. 协助其他教学相关活动、学术讨论及配合招生宣传工作。&nbsp;<br style=\"outline: none;\"/>岗位要求：<br style=\"outline: none;\"/>1. 具有良好的团队协作能力、应变能力及协作沟通能力；2. 有软文撰写、推广经验，具备较强的新闻敏感度、创新意识和创新能力； 3. 熟练掌握OFFICE办公软件和网络基本知识，具备较强的文字功底和专题策划能力，会使用Dreamweaver，Photoshop，html代码的优先熟悉网络广告操作规范、流程、发布渠道；</p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">4. 具有良好的敬业精神，有较强的创新意识，能够在较大压力下工作； 5. 营销或经济类专业。</p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">岗位待遇：</p><p style=\"outline: none; color: rgb(119, 119, 119); font-family: Arial, &#39;Hiragino Sans GB&#39;, 微软雅黑, 宋体; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(250, 250, 250);\">1. 有竞争力的薪酬、丰厚的奖金、高额提成；<br style=\"outline: none;\"/>2. 保险+带薪年假+完善培训体系；<br style=\"outline: none;\"/>3. 广阔的职业发展平台。</p><p><br/></p>','拉沟',1,1,1,1421898649,1421906950);
/*!40000 ALTER TABLE `recruitment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation_admin_roles`
--

DROP TABLE IF EXISTS `relation_admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relation_admin_roles` (
  `id` int(10) unsigned NOT NULL COMMENT '管理员ID',
  `rid` int(10) unsigned NOT NULL COMMENT '权限ID',
  PRIMARY KEY (`id`,`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relation_admin_roles`
--

LOCK TABLES `relation_admin_roles` WRITE;
/*!40000 ALTER TABLE `relation_admin_roles` DISABLE KEYS */;
INSERT INTO `relation_admin_roles` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `relation_admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '角色名称',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '权重',
  PRIMARY KEY (`rid`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'超级管理员',99),(2,'见习编辑',8);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `name` varchar(128) NOT NULL,
  `value` longtext,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='variables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-23 17:11:06
