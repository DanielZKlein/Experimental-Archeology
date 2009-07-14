-- MySQL dump 10.13  Distrib 5.1.30, for Win32 (ia32)
--
-- Host: localhost    Database: ea
-- ------------------------------------------------------
-- Server version	5.1.30-community

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
-- Table structure for table `chatcachetable`
--

DROP TABLE IF EXISTS `chatcachetable`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `chatcachetable` (
  `identifier` varchar(64) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `chatcachetable`
--

LOCK TABLES `chatcachetable` WRITE;
/*!40000 ALTER TABLE `chatcachetable` DISABLE KEYS */;
INSERT INTO `chatcachetable` VALUES ('0',0,0);
/*!40000 ALTER TABLE `chatcachetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatcontent`
--

DROP TABLE IF EXISTS `chatcontent`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `chatcontent` (
  `chatid` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `chattext` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `chatcontent`
--

LOCK TABLES `chatcontent` WRITE;
/*!40000 ALTER TABLE `chatcontent` DISABLE KEYS */;
INSERT INTO `chatcontent` VALUES (0,1243610589,0,'okay...',20),(0,1243610593,0,'what',21),(0,1243616096,0,'this is really cool though',22),(0,1243616100,0,'hm',23),(0,1243616152,0,'cool',24),(0,1243616153,0,'hm',25),(0,1243681748,0,'wow',26),(0,1243681751,0,'This is really slow here',27),(0,1243681756,0,'uhm',28),(0,1243681764,0,'this does not seem to work',29),(0,1243682600,0,'let\'s see now',30),(0,1243682603,0,'cool',31),(0,1243682607,0,'now we just need brs',32),(0,1243682647,0,'oh',33),(0,1243682654,0,'it seems to be built the wrong way round',34),(0,1243682657,0,'that is interesting',35),(0,1243682664,0,'Yeah',36),(0,1243682694,0,'and I type something!',37),(0,1243682697,0,'there we are',38),(0,1243682698,0,'works',39),(0,1243682718,0,'Hello world',40),(0,1243682774,2,'Hallo, I am not Pascal',41),(0,1243682780,2,'No, you are not',42),(0,1243682789,0,'Indeed',43),(0,1243682864,0,'Hello Fasih :)',44),(0,1243682978,0,'say something when you\'re here',45),(0,1243682986,1,'something',46),(0,1243682990,0,':D',47),(0,1243682995,0,'So I built my first chat!',48),(0,1243682997,0,'Isn\'t that awesome?',49),(0,1243683005,1,'awesome',50),(0,1243683008,0,'this is a cool little html chat module',51),(0,1243683012,1,'I shall use this one henceforth',52),(0,1243683015,0,'which I can put into any part of the game',53),(0,1243683016,0,'haha',54),(0,1243683016,0,':D',55),(0,1243683046,0,'I\'m also making good progress with the rest',56),(0,1243683051,0,'building systems that I will need first',57),(0,1243683055,0,'and then working on the specifics',58),(0,1243683069,0,'I will need to tune this chat though I think',59),(0,1243683076,0,'it might become very slow once the log is very long',60),(0,1243683078,0,'we\'ll see',61),(0,1243683092,1,'also the fact that it occupies the whole screen is great :P',62),(0,1243683096,0,'haha',63),(0,1243683105,0,'I can make it a little bigger',64),(0,1243683110,0,'and let me deactivate the debug output ;P',65),(0,1243683120,1,'finally I was able to transfer my gstreamer settings to KDE Sound',66),(0,1243683131,1,'and now',67),(0,1243683135,0,'haha',68),(0,1243683136,1,'I can\'t do any proper work',69),(0,1243683138,0,'you\'re still trying linux',70),(0,1243683140,1,'from listening to songs',71),(0,1243683141,0,'because of the music?',72),(0,1243683142,0,'haha :D',73),(0,1243683150,1,'how can this be... really',74),(0,1243683150,0,'if you refresh this page, the debug output will go away',75),(0,1243683163,1,'I like the debug output',76),(0,1243683188,0,'haha',77),(0,1243683196,0,'this is so coooool ;P',78),(0,1243683201,0,'it was so stupidly easy to build this',79),(0,1243683209,0,'but it makes you feel cool',80),(0,1243683210,0,'my OWN chat',81),(0,1243683310,0,'I may need to make it flash still ;P',82),(0,1243683313,0,'when you get a new message',83),(0,1243683318,0,'I\'ll have to do some research',84),(0,1243683339,1,'question daniel',85),(0,1243683348,0,'ask Fasih',86),(0,1243683352,1,'a question you won\'t answer',87),(0,1243683354,0,'haha',88),(0,1243683355,1,'but still',89),(0,1243683356,0,'possibly',90),(0,1243683362,1,'Kopete or Pidgin?',91),(0,1243683368,0,'dunno kopete',92),(0,1243683370,0,'pidgin sucks',93),(0,1243683377,0,'but it might suck less than kopete',94),(0,1243683382,1,'hahahah',95),(0,1243683385,0,'google talk has a native linux client, doesn\'t it?',96),(0,1243683396,1,'does it?',97),(0,1243683432,0,'http://www.google.com/talk/otherclients.html',98),(0,1243683435,0,'it doesn\'t :/',99),(0,1243683441,0,'TODO: make links autolink',100),(0,1243683449,2,'there\'s butter on my face',101),(0,1243683453,0,'IS THERE NOW?',102),(0,1243683455,0,'Hi Pascal :D',103),(0,1243683463,0,'now ALL THE USERS in my system are logged in',104),(0,1243683464,0,'awesome ;P',105),(0,1243683465,2,'greetings experimental archeologists',106),(0,1243683473,1,'http://www.google.com/talk/otherclients.html',107),(0,1243683482,0,'yeah I linked to that a little earlier ;)',108),(0,1243683483,1,'hey pascal!!',109),(0,1243683487,2,'ola Fasih',110),(0,1243683495,0,'I built this chat just to see if I could',111),(0,1243683500,2,'do you want to come to krefeld for a tavern meeting too? now',112),(0,1243683501,0,'now that I have, I can put it into any part of the game',113),(0,1243683513,2,'you could be there before it\'s over again :P',114),(0,1243683521,1,'can\'t... Koray\'s metal band released its album',115),(0,1243683529,1,'I have to be at the concert tonight',116),(0,1243683531,2,'oh, nice',117),(0,1243683534,1,'or else',118),(0,1243683536,2,'say hello from us',119),(0,1243683539,1,'I would have come',120),(0,1243683541,1,'sure',121),(0,1243683541,0,'also todo: make a logged in users list',122),(0,1243683543,2,':D',123),(0,1243683551,0,'yes, say hi to Koray :D',124),(0,1243683574,0,'btw, you can close this page and open it again and you\'ll get your full log again',125),(0,1243683576,0,'hihi',126),(0,1243683591,1,'he\'s enjoying himself',127),(0,1243683596,2,'omg, it steals my data',128),(0,1243683597,0,'oh yeah I am :D',129),(0,1243683606,0,'TODO: onkeydown in body focus chatbox',130),(0,1243683611,0,'also I\'m leaving myself messages',131),(0,1243683631,0,'lateron I can just do a SELECT chattext FROM chatcontent WHERE chattext like \"TODO%\"',132),(0,1243683636,0,'and it\'ll show me all my todos',133),(0,1243683639,0,'wee',134),(0,1243683644,0,'php is simple and fun ;)',135),(0,1243683652,0,'okay, but now I have to go for a bit, be back in a few hours',136),(0,1243683655,0,'enjoy Krefeld, Pascal',137),(0,1243683672,1,'kay',138),(0,1243683673,1,'seeya',139),(0,1243683993,2,'DISREGARD THAT, I SUCK COCKS',140),(0,1243684047,0,'todo: check for multiple logins from same user',141),(0,1244987062,0,'this is working again then',142),(0,1244987065,0,'Very good',143),(0,1244987081,0,'500ms seems to be enough for the refresh',144),(0,1244987098,0,'yep',145),(0,1244987895,0,'alright then',146),(0,1245077874,0,'what',147),(0,1245077882,0,'great',148),(0,1246057331,0,'and finally...',149),(0,1246057333,0,'yes',150),(0,1246057337,0,'We have communication',151),(0,1246057339,0,'again',152),(0,1246057341,0,'for the n-th time',153),(0,1246057348,0,'seriously, Daniel, stop breaking and rebuilding stuff',154),(0,1246057350,0,'it\'s not funny anymore',155),(0,1246057366,0,'much smoother',156),(0,1246057368,0,'indeed',157),(0,1246128051,0,'jo',158),(0,1246304432,0,'oi',159),(0,1246304576,0,'aaaoo',160),(0,1246307819,0,'oookay',161),(0,1246307896,0,'what now',162),(0,1246307924,0,'gogo',163),(0,1246307944,0,'again',164),(0,1246307981,0,'jj',165),(0,1246307999,0,'hello',166),(0,1246308028,0,'Hello Martyna',167),(0,1246477346,0,'no',168),(0,1246480211,0,'jo',169),(0,1246480358,0,'oh yeah',170),(0,1246491008,0,'hui',171),(0,1246491244,0,'oh gott wie geil',172),(0,1246491252,0,'wie krass krass krass',173),(0,1246492270,0,'ja',174),(0,1246492274,0,'freude und so',175),(0,1246547396,0,'now then',176),(0,1246548022,0,'blubb',177),(0,1247601822,0,'undefined',178),(0,1247602633,0,'undefined',179),(0,1247602696,0,'undefined',180),(0,1247602786,0,'undefined',181),(0,1247613778,0,'past',182),(0,1247613781,0,'is present',183),(0,1247613783,0,'and awesome',184),(0,1247614409,0,'cheeky',185),(0,1247614527,0,'ok',186),(0,1247614544,0,'yes',187);
/*!40000 ALTER TABLE `chatcontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chattouserid` int(11) DEFAULT NULL,
  `topic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,0,'Allied chat game 1');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chattouserid`
--

DROP TABLE IF EXISTS `chattouserid`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `chattouserid` (
  `userid` int(11) DEFAULT NULL,
  `chatid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `chattouserid`
--

LOCK TABLES `chattouserid` WRITE;
/*!40000 ALTER TABLE `chattouserid` DISABLE KEYS */;
INSERT INTO `chattouserid` VALUES (1,0),(2,0),(0,0);
/*!40000 ALTER TABLE `chattouserid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamecachetable`
--

DROP TABLE IF EXISTS `gamecachetable`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamecachetable` (
  `identifier` varchar(64) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamecachetable`
--

LOCK TABLES `gamecachetable` WRITE;
/*!40000 ALTER TABLE `gamecachetable` DISABLE KEYS */;
/*!40000 ALTER TABLE `gamecachetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamedata_cards`
--

DROP TABLE IF EXISTS `gamedata_cards`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamedata_cards` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `description` text,
  `effect` text,
  `apcost` int(11) DEFAULT NULL,
  `dollarcost` int(11) DEFAULT NULL,
  `angercost` int(11) DEFAULT NULL,
  `serenitycost` int(11) DEFAULT NULL,
  `lustcost` int(11) DEFAULT NULL,
  `greedcost` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamedata_cards`
--

LOCK TABLES `gamedata_cards` WRITE;
/*!40000 ALTER TABLE `gamedata_cards` DISABLE KEYS */;
INSERT INTO `gamedata_cards` VALUES (0,'Super card','This card is super','none',NULL,NULL,NULL,NULL,NULL,NULL),(1,'Bad card','This card is bad','none',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Mauve','This card is mauve','none',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Tibetan Tunnels','Use this card to teleport to any city.','goto self any',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `gamedata_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamedata_characters`
--

DROP TABLE IF EXISTS `gamedata_characters`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamedata_characters` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `charisma` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `dollar` int(11) DEFAULT NULL,
  `ap` int(11) DEFAULT NULL,
  `anger` int(11) DEFAULT NULL,
  `serenity` int(11) DEFAULT NULL,
  `greed` int(11) DEFAULT NULL,
  `lust` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamedata_characters`
--

LOCK TABLES `gamedata_characters` WRITE;
/*!40000 ALTER TABLE `gamedata_characters` DISABLE KEYS */;
INSERT INTO `gamedata_characters` VALUES (0,'Sara Croft',7,5,9,10,100,5,0,0,0,5),(1,'Ohio Jones',8,7,7,10,100,5,5,0,0,3),(2,'Doctor John',4,10,5,10,50,5,0,10,0,0),(3,'Monopoly Guy',2,8,7,10,1000,5,2,0,10,0);
/*!40000 ALTER TABLE `gamedata_characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamestate`
--

DROP TABLE IF EXISTS `gamestate`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamestate` (
  `current_round` int(11) DEFAULT NULL,
  `character_playing` int(11) DEFAULT NULL,
  `gameid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `lastactivity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamestate`
--

LOCK TABLES `gamestate` WRITE;
/*!40000 ALTER TABLE `gamestate` DISABLE KEYS */;
INSERT INTO `gamestate` VALUES (1,0,0,1,NULL,NULL,NULL),(5,0,1,1,NULL,NULL,NULL),(0,-1,2,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `gamestate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamestate_characters`
--

DROP TABLE IF EXISTS `gamestate_characters`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamestate_characters` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `ap` int(11) DEFAULT NULL,
  `dollar` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `playedby` int(11) DEFAULT NULL,
  `cards` text,
  `anger` int(11) DEFAULT NULL,
  `serenity` int(11) DEFAULT NULL,
  `lust` int(11) DEFAULT NULL,
  `greed` int(11) DEFAULT NULL,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `charisma` int(11) DEFAULT NULL,
  `gameid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamestate_characters`
--

LOCK TABLES `gamestate_characters` WRITE;
/*!40000 ALTER TABLE `gamestate_characters` DISABLE KEYS */;
INSERT INTO `gamestate_characters` VALUES (0,'Bringa',0,201,4,0,'0 0 0 1 2 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(1,'Hans',5,7,4,1,'2 1 2 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `gamestate_characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamestate_commands`
--

DROP TABLE IF EXISTS `gamestate_commands`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamestate_commands` (
  `id` int(11) NOT NULL,
  `flavourtext` text,
  `effect` text,
  `apcost` int(11) DEFAULT NULL,
  `dollarcost` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `gameid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamestate_commands`
--

LOCK TABLES `gamestate_commands` WRITE;
/*!40000 ALTER TABLE `gamestate_commands` DISABLE KEYS */;
INSERT INTO `gamestate_commands` VALUES (0,'Raise money','getmoney 4',1,0,4,1),(1,'Dig for leads','digleads 4',1,0,4,1),(2,'Take the ship to New York','goto 2',2,2,2,1),(3,'Take the ship to Anchorage','goto 1',3,2,1,1);
/*!40000 ALTER TABLE `gamestate_commands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamestate_users`
--

DROP TABLE IF EXISTS `gamestate_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gamestate_users` (
  `gameid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gamestate_users`
--

LOCK TABLES `gamestate_users` WRITE;
/*!40000 ALTER TABLE `gamestate_users` DISABLE KEYS */;
INSERT INTO `gamestate_users` VALUES (1,0),(1,1),(1,2);
/*!40000 ALTER TABLE `gamestate_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gametouserid`
--

DROP TABLE IF EXISTS `gametouserid`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gametouserid` (
  `gameid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gametouserid`
--

LOCK TABLES `gametouserid` WRITE;
/*!40000 ALTER TABLE `gametouserid` DISABLE KEYS */;
INSERT INTO `gametouserid` VALUES (0,1),(0,2),(1,0),(1,1),(1,2),(2,1),(2,2);
/*!40000 ALTER TABLE `gametouserid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lobbycachetable`
--

DROP TABLE IF EXISTS `lobbycachetable`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `lobbycachetable` (
  `identifier` varchar(64) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `lobbycachetable`
--

LOCK TABLES `lobbycachetable` WRITE;
/*!40000 ALTER TABLE `lobbycachetable` DISABLE KEYS */;
INSERT INTO `lobbycachetable` VALUES ('thereisonlyonelobby',0,1240605088);
/*!40000 ALTER TABLE `lobbycachetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mapdata_cities`
--

DROP TABLE IF EXISTS `mapdata_cities`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mapdata_cities` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mapdata_cities`
--

LOCK TABLES `mapdata_cities` WRITE;
/*!40000 ALTER TABLE `mapdata_cities` DISABLE KEYS */;
INSERT INTO `mapdata_cities` VALUES (0,'Test Town',50,50),(1,'Anchorage',260,290),(2,'New York',890,600),(3,'Mexico',470,930),(4,'Anywhere',666,666),(5,'Vancouver',370,480);
/*!40000 ALTER TABLE `mapdata_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mapdata_routes`
--

DROP TABLE IF EXISTS `mapdata_routes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mapdata_routes` (
  `city1id` int(11) DEFAULT NULL,
  `city2id` int(11) DEFAULT NULL,
  `apcost` int(11) DEFAULT NULL,
  `dollarcost` int(11) DEFAULT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mapdata_routes`
--

LOCK TABLES `mapdata_routes` WRITE;
/*!40000 ALTER TABLE `mapdata_routes` DISABLE KEYS */;
INSERT INTO `mapdata_routes` VALUES (1,2,2,0,'Drive to %s'),(1,2,1,5,'Take the zeppelin to %s'),(2,4,2,2,'Take the ship to %s'),(1,2,2,2,'Take the ship to %s'),(1,4,3,2,'Take the ship to %s'),(2,3,2,0,'Drive to %s');
/*!40000 ALTER TABLE `mapdata_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `maps` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `jpgname` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `painful`
--

DROP TABLE IF EXISTS `painful`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `painful` (
  `posterior` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`posterior`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `painful`
--

LOCK TABLES `painful` WRITE;
/*!40000 ALTER TABLE `painful` DISABLE KEYS */;
/*!40000 ALTER TABLE `painful` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playertocharacter`
--

DROP TABLE IF EXISTS `playertocharacter`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `playertocharacter` (
  `userid` int(11) DEFAULT NULL,
  `characterid` int(11) DEFAULT NULL,
  `gameid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `playertocharacter`
--

LOCK TABLES `playertocharacter` WRITE;
/*!40000 ALTER TABLE `playertocharacter` DISABLE KEYS */;
/*!40000 ALTER TABLE `playertocharacter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temptest_chars`
--

DROP TABLE IF EXISTS `temptest_chars`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `temptest_chars` (
  `chartype` int(11) DEFAULT NULL,
  `name` text,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `charisma` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `dollar` int(11) DEFAULT NULL,
  `ap` int(11) DEFAULT NULL,
  `anger` int(11) DEFAULT NULL,
  `serenity` int(11) DEFAULT NULL,
  `greed` int(11) DEFAULT NULL,
  `lust` int(11) DEFAULT NULL,
  `playedby` int(11) DEFAULT NULL,
  `gameid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `temptest_chars`
--

LOCK TABLES `temptest_chars` WRITE;
/*!40000 ALTER TABLE `temptest_chars` DISABLE KEYS */;
INSERT INTO `temptest_chars` VALUES (1,'Ohio Jones',8,7,7,10,100,5,5,0,0,3,0,12);
/*!40000 ALTER TABLE `temptest_chars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_chars`
--

DROP TABLE IF EXISTS `test_chars`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `test_chars` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `charisma` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `dollar` int(11) DEFAULT NULL,
  `ap` int(11) DEFAULT NULL,
  `anger` int(11) DEFAULT NULL,
  `serenity` int(11) DEFAULT NULL,
  `greed` int(11) DEFAULT NULL,
  `lust` int(11) DEFAULT NULL,
  `chartype` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `test_chars`
--

LOCK TABLES `test_chars` WRITE;
/*!40000 ALTER TABLE `test_chars` DISABLE KEYS */;
INSERT INTO `test_chars` VALUES (0,'Sara Croft',7,5,9,10,100,5,0,0,0,5,0),(1,'Ohio Jones',8,7,7,10,100,5,5,0,0,3,1);
/*!40000 ALTER TABLE `test_chars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testing`
--

DROP TABLE IF EXISTS `testing`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `testing` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `strength` int(11) DEFAULT NULL,
  `intelligence` int(11) DEFAULT NULL,
  `charisma` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `dollar` int(11) DEFAULT NULL,
  `ap` int(11) DEFAULT NULL,
  `anger` int(11) DEFAULT NULL,
  `serenity` int(11) DEFAULT NULL,
  `greed` int(11) DEFAULT NULL,
  `lust` int(11) DEFAULT NULL,
  `newcol` int(11) DEFAULT '23'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `testing`
--

LOCK TABLES `testing` WRITE;
/*!40000 ALTER TABLE `testing` DISABLE KEYS */;
/*!40000 ALTER TABLE `testing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user` (
  `login` varchar(64) DEFAULT NULL,
  `pw` varchar(64) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `curpage` text,
  `gameid` int(11) DEFAULT NULL,
  `lastping` int(11) DEFAULT NULL,
  `focus` int(11) DEFAULT NULL,
  `access_level` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('daniel','gehirn',0,'lobbytemplate.php',23,1247614544,1,9000),('fasih','bragi',1,'lobbytemplate.php',1,NULL,1,0),('Pascalle','laser',2,'lobbytemplate.php',1,1243900117,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlaststate`
--

DROP TABLE IF EXISTS `userlaststate`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `userlaststate` (
  `userid` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL,
  `chatid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `userlaststate`
--

LOCK TABLES `userlaststate` WRITE;
/*!40000 ALTER TABLE `userlaststate` DISABLE KEYS */;
INSERT INTO `userlaststate` VALUES (0,-1803580438,0);
/*!40000 ALTER TABLE `userlaststate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlistcachetable`
--

DROP TABLE IF EXISTS `userlistcachetable`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `userlistcachetable` (
  `identifier` varchar(64) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `crc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `userlistcachetable`
--

LOCK TABLES `userlistcachetable` WRITE;
/*!40000 ALTER TABLE `userlistcachetable` DISABLE KEYS */;
INSERT INTO `userlistcachetable` VALUES ('0',0,-1870053524);
/*!40000 ALTER TABLE `userlistcachetable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-07-14 23:54:44
