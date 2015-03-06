-- MySQL dump 10.13  Distrib 5.1.47, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: mowdata
-- ------------------------------------------------------
-- Server version	5.1.47

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `mid` mediumint(9) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `firstmealdate` date DEFAULT NULL,
  `mealstatus` char(1) DEFAULT NULL,
  `mlang` varchar(10) DEFAULT NULL,
  `clang` char(2) DEFAULT NULL,
  `cdif_exd` tinyint(1) DEFAULT NULL,
  `cdif_hoh` tinyint(1) DEFAULT NULL,
  `phonec` varchar(18) DEFAULT NULL,
  `payscale` int(6) unsigned DEFAULT '1',
  `dRoute` char(3) DEFAULT NULL,
  `dType` char(1) DEFAULT NULL,
  `dStop` smallint(6) DEFAULT NULL,
  `dDirections` varchar(500) DEFAULT NULL,
  `dMon` tinyint(1) DEFAULT NULL,
  `dTue` tinyint(1) DEFAULT NULL,
  `dWed` tinyint(1) DEFAULT NULL,
  `dThu` tinyint(1) DEFAULT NULL,
  `dFri` tinyint(1) DEFAULT NULL,
  `dSat` tinyint(1) DEFAULT NULL,
  `rfref_loa` tinyint(1) DEFAULT NULL,
  `rfref_iso` tinyint(1) DEFAULT NULL,
  `rfref_fin` tinyint(1) DEFAULT NULL,
  `rfref_nut` tinyint(1) DEFAULT NULL,
  `rfref_cog` tinyint(1) DEFAULT NULL,
  `rfref_mob` tinyint(1) DEFAULT NULL,
  `rfref_vis` tinyint(1) DEFAULT NULL,
  `rfref_aln` tinyint(1) DEFAULT NULL,
  `rNotes` varchar(120) DEFAULT NULL,
  `alert` tinyint(1) DEFAULT NULL,
  `alertmsg` varchar(254) DEFAULT NULL,
  `sNotes` varchar(254) DEFAULT NULL,
  `billto` char(2) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mMealmod_cut` tinyint(1) DEFAULT NULL,
  `mMealmod_dat` tinyint(1) DEFAULT NULL,
  `mMealmod_pur` tinyint(1) DEFAULT NULL,
  `mMealallergy` tinyint(1) DEFAULT NULL,
  `mMealdiabete` tinyint(1) DEFAULT NULL,
  `mDiet_salt` tinyint(1) DEFAULT NULL,
  `mDiet_milk` tinyint(1) DEFAULT NULL,
  `mDiet_fish` tinyint(1) DEFAULT NULL,
  `mDiet_ham` tinyint(1) DEFAULT NULL,
  `mDiet_poul` tinyint(1) DEFAULT NULL,
  `mDiet_beef` tinyint(1) DEFAULT NULL,
  `mDiet_pork` tinyint(1) DEFAULT NULL,
  `mDiet_veal` tinyint(1) DEFAULT NULL,
  `mDiet_spicy` tinyint(1) DEFAULT NULL,
  `mDiet_nuts` tinyint(1) DEFAULT NULL,
  `mDiet_choc` tinyint(1) DEFAULT NULL,
  `mDiet_rice` tinyint(1) DEFAULT NULL,
  `mDiet_ptat` tinyint(1) DEFAULT NULL,
  `mDiet_past` tinyint(1) DEFAULT NULL,
  `mDiet_msg` tinyint(1) DEFAULT NULL,
  `mDiet_glut` tinyint(1) DEFAULT NULL,
  `mDiet_div` tinyint(1) DEFAULT NULL,
  `mLabel` varchar(254) DEFAULT NULL,
  `lastmeal` date NOT NULL,
  `stopdate` date NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `client_billing`
--

DROP TABLE IF EXISTS `client_billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_billing` (
  `mid` mediumint(9) NOT NULL,
  `accountno` varchar(15) DEFAULT NULL,
  `authno` varchar(15) DEFAULT NULL,
  `billto` varchar(6) DEFAULT NULL,
  `salutation` varchar(30) DEFAULT NULL,
  `address1` varchar(35) DEFAULT NULL,
  `address2` varchar(35) DEFAULT NULL,
  `address3` varchar(35) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `prov` varchar(2) DEFAULT NULL,
  `post` varchar(7) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `client_log`
--

DROP TABLE IF EXISTS `client_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_log` (
  `date` date NOT NULL,
  `mid` mediumint(7) unsigned NOT NULL,
  `important` tinyint(1) DEFAULT '0',
  `message` varchar(254) DEFAULT NULL,
  `editor` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `client_relationships`
--

DROP TABLE IF EXISTS `client_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_relationships` (
  `mid` mediumint(9) unsigned NOT NULL,
  `rid` mediumint(9) NOT NULL,
  `emerge` tinyint(1) NOT NULL,
  `refer` tinyint(1) NOT NULL,
  `billto` tinyint(1) NOT NULL,
  `editor` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `rid` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `organ` varchar(30) NOT NULL,
  `relate` varchar(15) NOT NULL,
  `prof` tinyint(1) NOT NULL,
  `address1` varchar(35) NOT NULL,
  `address2` varchar(35) NOT NULL,
  `city` varchar(25) NOT NULL,
  `prov` varchar(2) NOT NULL,
  `post` varchar(7) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone1` varchar(13) NOT NULL,
  `phone1ext` varchar(5) NOT NULL,
  `phone2` varchar(13) NOT NULL,
  `phone3` varchar(13) NOT NULL,
  `phone3ext` varchar(5) NOT NULL,
  `editor` varchar(25) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=2616 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `db_settings`
--

DROP TABLE IF EXISTS `db_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_settings` (
  `name` varchar(20) DEFAULT NULL,
  `type` char(4) NOT NULL,
  `value` varchar(75) DEFAULT NULL,
  `tindex` int(6) DEFAULT '0',
  `index` int(8) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_10`
--

DROP TABLE IF EXISTS `meals01_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_11`
--

DROP TABLE IF EXISTS `meals01_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_12`
--

DROP TABLE IF EXISTS `meals01_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_13`
--

DROP TABLE IF EXISTS `meals01_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_14`
--

DROP TABLE IF EXISTS `meals01_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals01_15`
--

DROP TABLE IF EXISTS `meals01_15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals01_15` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_10`
--

DROP TABLE IF EXISTS `meals02_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_11`
--

DROP TABLE IF EXISTS `meals02_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_12`
--

DROP TABLE IF EXISTS `meals02_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_13`
--

DROP TABLE IF EXISTS `meals02_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_14`
--

DROP TABLE IF EXISTS `meals02_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals02_15`
--

DROP TABLE IF EXISTS `meals02_15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals02_15` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_10`
--

DROP TABLE IF EXISTS `meals03_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_11`
--

DROP TABLE IF EXISTS `meals03_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_12`
--

DROP TABLE IF EXISTS `meals03_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_13`
--

DROP TABLE IF EXISTS `meals03_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_14`
--

DROP TABLE IF EXISTS `meals03_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals03_15`
--

DROP TABLE IF EXISTS `meals03_15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals03_15` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals04_10`
--

DROP TABLE IF EXISTS `meals04_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals04_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals04_11`
--

DROP TABLE IF EXISTS `meals04_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals04_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals04_12`
--

DROP TABLE IF EXISTS `meals04_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals04_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals04_13`
--

DROP TABLE IF EXISTS `meals04_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals04_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals04_14`
--

DROP TABLE IF EXISTS `meals04_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals04_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals05_10`
--

DROP TABLE IF EXISTS `meals05_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals05_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals05_11`
--

DROP TABLE IF EXISTS `meals05_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals05_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals05_12`
--

DROP TABLE IF EXISTS `meals05_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals05_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals05_13`
--

DROP TABLE IF EXISTS `meals05_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals05_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals05_14`
--

DROP TABLE IF EXISTS `meals05_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals05_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals06_10`
--

DROP TABLE IF EXISTS `meals06_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals06_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals06_11`
--

DROP TABLE IF EXISTS `meals06_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals06_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals06_12`
--

DROP TABLE IF EXISTS `meals06_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals06_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals06_13`
--

DROP TABLE IF EXISTS `meals06_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals06_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals06_14`
--

DROP TABLE IF EXISTS `meals06_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals06_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_09`
--

DROP TABLE IF EXISTS `meals07_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_10`
--

DROP TABLE IF EXISTS `meals07_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_11`
--

DROP TABLE IF EXISTS `meals07_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_12`
--

DROP TABLE IF EXISTS `meals07_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_13`
--

DROP TABLE IF EXISTS `meals07_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals07_14`
--

DROP TABLE IF EXISTS `meals07_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals07_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_09`
--

DROP TABLE IF EXISTS `meals08_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(4) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_10`
--

DROP TABLE IF EXISTS `meals08_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_11`
--

DROP TABLE IF EXISTS `meals08_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_12`
--

DROP TABLE IF EXISTS `meals08_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_13`
--

DROP TABLE IF EXISTS `meals08_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals08_14`
--

DROP TABLE IF EXISTS `meals08_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals08_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_09`
--

DROP TABLE IF EXISTS `meals09_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(4) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_10`
--

DROP TABLE IF EXISTS `meals09_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_11`
--

DROP TABLE IF EXISTS `meals09_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_12`
--

DROP TABLE IF EXISTS `meals09_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_13`
--

DROP TABLE IF EXISTS `meals09_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals09_14`
--

DROP TABLE IF EXISTS `meals09_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals09_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_09`
--

DROP TABLE IF EXISTS `meals10_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_10`
--

DROP TABLE IF EXISTS `meals10_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_11`
--

DROP TABLE IF EXISTS `meals10_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_12`
--

DROP TABLE IF EXISTS `meals10_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_13`
--

DROP TABLE IF EXISTS `meals10_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals10_14`
--

DROP TABLE IF EXISTS `meals10_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals10_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_09`
--

DROP TABLE IF EXISTS `meals11_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_10`
--

DROP TABLE IF EXISTS `meals11_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_11`
--

DROP TABLE IF EXISTS `meals11_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_12`
--

DROP TABLE IF EXISTS `meals11_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_13`
--

DROP TABLE IF EXISTS `meals11_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals11_14`
--

DROP TABLE IF EXISTS `meals11_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals11_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_09`
--

DROP TABLE IF EXISTS `meals12_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_09` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_10`
--

DROP TABLE IF EXISTS `meals12_10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_10` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_11`
--

DROP TABLE IF EXISTS `meals12_11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_11` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_12`
--

DROP TABLE IF EXISTS `meals12_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_12` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_13`
--

DROP TABLE IF EXISTS `meals12_13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_13` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals12_14`
--

DROP TABLE IF EXISTS `meals12_14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals12_14` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals2012`
--

DROP TABLE IF EXISTS `meals2012`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals2012` (
  `mid` mediumint(9) DEFAULT NULL,
  `mDate` date DEFAULT NULL,
  `mNumber` tinyint(4) DEFAULT NULL,
  `mPortion` char(1) DEFAULT NULL,
  `mSidefs` tinyint(4) DEFAULT NULL,
  `mSidegs` tinyint(4) DEFAULT NULL,
  `mSidedd` tinyint(4) DEFAULT NULL,
  `mSideds` tinyint(4) DEFAULT NULL,
  `mSidepd` tinyint(4) DEFAULT NULL,
  `mSidegz` tinyint(4) DEFAULT NULL,
  `mSidevz` tinyint(4) DEFAULT NULL,
  `mSidevb` tinyint(4) DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals_billed`
--

DROP TABLE IF EXISTS `meals_billed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals_billed` (
  `date` date NOT NULL,
  `mid` mediumint(7) unsigned NOT NULL,
  `mNumber` smallint(2) unsigned DEFAULT NULL,
  `mSize` varchar(1) DEFAULT NULL,
  `mSidedd` smallint(2) unsigned DEFAULT NULL,
  `mSideds` smallint(2) unsigned DEFAULT NULL,
  `mSidefs` smallint(2) unsigned DEFAULT NULL,
  `mSidegs` smallint(2) unsigned DEFAULT NULL,
  `mSidepd` smallint(2) unsigned DEFAULT NULL,
  `mSidegz` smallint(2) unsigned DEFAULT NULL,
  `mSidevb` smallint(2) unsigned DEFAULT NULL,
  `mSidevz` smallint(2) unsigned DEFAULT NULL,
  `payscale` int(6) unsigned DEFAULT '1',
  `nocharge` tinyint(1) DEFAULT NULL,
  `reason` varchar(80) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals_default`
--

DROP TABLE IF EXISTS `meals_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals_default` (
  `mid` mediumint(9) DEFAULT NULL,
  `dMonNumber` tinyint(4) DEFAULT '1',
  `dMonPortion` char(1) DEFAULT 'R',
  `dMonSidefs` tinyint(4) DEFAULT '0',
  `dMonSidegs` tinyint(4) DEFAULT '0',
  `dMonSidedd` tinyint(4) DEFAULT '0',
  `dMonSideds` tinyint(4) DEFAULT '0',
  `dMonSidepd` tinyint(4) DEFAULT '0',
  `dMonSidegz` tinyint(4) DEFAULT '0',
  `dMonSidevz` tinyint(4) DEFAULT '0',
  `dMonSidevb` tinyint(4) DEFAULT '0',
  `dTueNumber` tinyint(4) DEFAULT '1',
  `dTuePortion` char(1) DEFAULT 'R',
  `dTueSidefs` tinyint(4) DEFAULT '0',
  `dTueSidegs` tinyint(4) DEFAULT '0',
  `dTueSidedd` tinyint(4) DEFAULT '0',
  `dTueSideds` tinyint(4) DEFAULT '0',
  `dTueSidepd` tinyint(4) DEFAULT '0',
  `dTueSidegz` tinyint(4) DEFAULT '0',
  `dTueSidevz` tinyint(4) DEFAULT '0',
  `dTueSidevb` tinyint(4) DEFAULT '0',
  `dWedNumber` tinyint(4) DEFAULT '1',
  `dWedPortion` char(1) DEFAULT 'R',
  `dWedSidefs` tinyint(4) DEFAULT '0',
  `dWedSidegs` tinyint(4) DEFAULT '0',
  `dWedSidedd` tinyint(4) DEFAULT '0',
  `dWedSideds` tinyint(4) DEFAULT '0',
  `dWedSidepd` tinyint(4) DEFAULT '0',
  `dWedSidegz` tinyint(4) DEFAULT '0',
  `dWedSidevz` tinyint(4) DEFAULT '0',
  `dWedSidevb` tinyint(4) DEFAULT '0',
  `dFriNumber` tinyint(4) DEFAULT '1',
  `dFriPortion` char(1) DEFAULT 'R',
  `dFriSidefs` tinyint(4) DEFAULT '0',
  `dFriSidegs` tinyint(4) DEFAULT '0',
  `dFriSidedd` tinyint(4) DEFAULT '0',
  `dFriSideds` tinyint(4) DEFAULT '0',
  `dFriSidepd` tinyint(4) DEFAULT '0',
  `dFriSidegz` tinyint(4) DEFAULT '0',
  `dFriSidevz` tinyint(4) DEFAULT '0',
  `dFriSidevb` tinyint(4) DEFAULT '0',
  `dSatNumber` tinyint(4) DEFAULT '1',
  `dSatPortion` char(1) DEFAULT 'R',
  `dSatSidefs` tinyint(4) DEFAULT '0',
  `dSatSidegs` tinyint(4) DEFAULT '0',
  `dSatSidedd` tinyint(4) DEFAULT '0',
  `dSatSideds` tinyint(4) DEFAULT '0',
  `dSatSidepd` tinyint(4) DEFAULT '0',
  `dSatSidegz` tinyint(4) DEFAULT '0',
  `dSatSidevz` tinyint(4) DEFAULT '0',
  `dSatSidevb` tinyint(4) DEFAULT '0',
  `last_name` varchar(20) DEFAULT NULL,
  `lastedit` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meals_scheduled`
--

DROP TABLE IF EXISTS `meals_scheduled`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals_scheduled` (
  `mDate` date NOT NULL,
  `mid` mediumint(7) unsigned NOT NULL,
  `mNumber` smallint(2) unsigned DEFAULT NULL,
  `mPortion` varchar(1) DEFAULT NULL,
  `mSidedd` smallint(2) unsigned DEFAULT NULL,
  `mSideds` smallint(2) unsigned DEFAULT NULL,
  `mSidefs` smallint(2) unsigned DEFAULT NULL,
  `mSidegs` smallint(2) unsigned DEFAULT NULL,
  `mSidepd` smallint(2) unsigned DEFAULT NULL,
  `mSidegz` smallint(2) unsigned DEFAULT NULL,
  `mSidevb` smallint(2) unsigned DEFAULT NULL,
  `mSidevz` smallint(2) unsigned DEFAULT NULL,
  `mSuspend` tinyint(1) DEFAULT '0',
  `reason` varchar(80) DEFAULT NULL,
  `editor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL DEFAULT '',
  `last_name` varchar(20) DEFAULT NULL,
  `address1` varchar(35) DEFAULT NULL,
  `address2` varchar(35) DEFAULT NULL,
  `post` varchar(7) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `prov` varchar(2) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `phoneb` varchar(13) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mVol` tinyint(1) NOT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `mClient` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4174 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usr_settings`
--

DROP TABLE IF EXISTS `usr_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr_settings` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `usrname` varchar(20) NOT NULL,
  `displayname` varchar(30) NOT NULL,
  `lang` char(2) DEFAULT 'EN',
  `email` varchar(75) DEFAULT NULL,
  `usrlevel` tinyint(3) DEFAULT '1',
  `usrbirth` date NOT NULL,
  `customlink1` varchar(75) DEFAULT NULL,
  `customlink2` varchar(75) DEFAULT NULL,
  `customlink3` varchar(75) DEFAULT NULL,
  `cl1name` varchar(28) DEFAULT NULL,
  `cl2name` varchar(28) DEFAULT NULL,
  `cl3name` varchar(28) DEFAULT NULL,
  `md5phash` varchar(36) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vol2_volunteers`
--

DROP TABLE IF EXISTS `vol2_volunteers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vol2_volunteers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `orientationdate` date DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `searchableName` varchar(200) DEFAULT NULL,
  `birthyear` int(11) DEFAULT NULL,
  `birthmonth` int(11) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `phone1` varchar(20) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `phone3` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` text,
  `emergname` varchar(50) DEFAULT NULL,
  `emergrelation` varchar(50) DEFAULT NULL,
  `emergphone1` varchar(20) DEFAULT NULL,
  `emergphone2` varchar(20) DEFAULT NULL,
  `emergphone3` varchar(20) DEFAULT NULL,
  `emergemail` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `occupationother` text,
  `foundout` varchar(50) DEFAULT NULL,
  `foundoutother` text,
  `language1` varchar(50) DEFAULT NULL,
  `language2` varchar(50) DEFAULT NULL,
  `language3` varchar(50) DEFAULT NULL,
  `language4` varchar(50) DEFAULT NULL,
  `language5` varchar(50) DEFAULT NULL,
  `occupation2` varchar(50) DEFAULT NULL,
  `occupation3` varchar(50) DEFAULT NULL,
  `foundout2` varchar(50) DEFAULT NULL,
  `foundout3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3995 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer` (
  `mid` int(11) NOT NULL,
  `mbirth` date DEFAULT NULL,
  `urgname` varchar(40) DEFAULT NULL,
  `urgphone` varchar(15) DEFAULT NULL,
  `urgrelate` varchar(8) DEFAULT NULL,
  `urgother` varchar(45) DEFAULT NULL,
  `drv_do` tinyint(1) DEFAULT NULL,
  `drvname` varchar(40) DEFAULT NULL,
  `drvlicense` varchar(17) DEFAULT NULL,
  `drvprov` varchar(18) DEFAULT NULL,
  `drvexp` date DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `refname` varchar(40) DEFAULT NULL,
  `refrelate` varchar(8) DEFAULT NULL,
  `refphone` varchar(15) DEFAULT NULL,
  `mlang` varchar(8) DEFAULT NULL,
  `mlang2` varchar(26) DEFAULT NULL,
  `origin` varchar(25) DEFAULT NULL,
  `padd` varchar(45) DEFAULT NULL,
  `pcity` varchar(21) DEFAULT NULL,
  `pprov` varchar(2) DEFAULT NULL,
  `ppost` varchar(7) DEFAULT NULL,
  `refoth` varchar(20) DEFAULT NULL,
  `heard` varchar(18) DEFAULT NULL,
  `othr_vol` varchar(18) DEFAULT NULL,
  `occup` varchar(15) DEFAULT NULL,
  `able1` tinyint(1) DEFAULT NULL,
  `able2` tinyint(1) DEFAULT NULL,
  `able3` tinyint(1) DEFAULT NULL,
  `able4` tinyint(1) DEFAULT NULL,
  `able5` tinyint(1) DEFAULT NULL,
  `able6` tinyint(1) DEFAULT NULL,
  `able7` tinyint(1) DEFAULT NULL,
  `able8` tinyint(1) DEFAULT NULL,
  `able9` tinyint(1) DEFAULT NULL,
  `able10` tinyint(1) DEFAULT NULL,
  `able11` tinyint(1) DEFAULT NULL,
  `able_mr` varchar(25) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-06 17:02:56
