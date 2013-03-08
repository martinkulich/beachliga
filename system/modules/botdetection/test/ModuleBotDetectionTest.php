<?php
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Glen Langer 2011 
 * @author     BugBuster 
 * @package    BotDetectionTest 
 * @license    LGPL 
 * @filesource
 */

/**
 * Aufruf direkt!
 * http://deine-domain.de/system/modules/botdetection/test/ModuleBotDetectionTest.php
 */

/**
 * Initialize the system
 */
define('TL_MODE', 'FE');
require(dirname(dirname(dirname(dirname(__FILE__)))).'/initialize.php');

/**
 * Class ModuleBotDetectionTest 
 *
 * @copyright  Glen Langer 2011 
 * @author     BugBuster 
 * @package    BotDetectionTest
 */
class ModuleBotDetectionTest extends ModuleBotDetection  
{

	public function run()
	{
	    // AGENT TEST DEFINITIONS
	    
	    $arrTest[] = array(false, false,'your browser'); // own Browser
	    //Browser
	    $arrTest[] = array(false, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3','Firefox');
	    $arrTest[] = array(false, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1);','IE8.0');
	    $arrTest[] = array(false, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; de; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2','Macintosh FF');
	    $arrTest[] = array(false, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; de-de) AppleWebKit/531.22.7 (KHTML, like Gecko) Version/4.0.5 Safari/531.22.7','Macintosh Safari');
	    //Bots
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','Googlebot');
	    $arrTest[] = array(true, 'ia_archiver (+http://www.alexa.com/site/help/webmasters; crawler@alexa.com)','Alexa Crawler');
	    $arrTest[] = array(true, 'Yandex/1.01.001 (compatible; Win16; P)','Yandex');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)','Yahoo! Slurp');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; Exabot/3.0; +http://www.exabot.com/go/robot)','Exabot');
	    $arrTest[] = array(true, 'msnbot/2.0b (+http://search.msn.com/msnbot.htm)','MSNbot');
	    $arrTest[] = array(true, 'Mozilla/5.0 (Twiceler-0.9 http://www.cuil.com/twiceler/robot.html)','Twiceler');
	    $arrTest[] = array(true, 'Googlebot-Image/1.0','Googlebot-Image');
	    $arrTest[] = array(true, 'Yeti/1.0 (NHN Corp.; http://help.naver.com/robots/)','Yeti');
	    $arrTest[] = array(true, 'Baiduspider+(+http://www.baidu.com/search/spider.htm)','Baiduspider');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; spbot/2.0.2; +http://www.seoprofiler.com/bot/ )','seoprofiler');
	    $arrTest[] = array(true, 'ia_archiver-web.archive.org','ia_archiver-web.archive.org');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; archive.org_bot +http://www.archive.org/details/archive.org_bot)','Internet Archiv');

	    $arrTest[] = array(true, 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)','MSNbot-media');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; Ask Jeeves/Teoma; +http://about.ask.com/en/docs/about/webmasters.shtml)','Ask Jeeves/Teoma');
	    $arrTest[] = array(true, 'TrueKnowledgeBot (http://www.trueknowledge.com/tkbot/; tkbot -AT- trueknowledge _dot_ com)','TrueKnowledgeBot');
	    $arrTest[] = array(true, 'Mozilla/5.0 (compatible; ptd-crawler; +http://bixolabs.com/crawler/ptd/; crawler@bixolabs.com)','ptd-crawler bixolabs.com');
		$arrTest[] = array(true, 'Cityreview Robot (+http://www.cityreview.org/crawler/)','Cityreview Robot');
		$arrTest[] = array(true, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906 Firefox/3.0/1.0 (bot; http://)','No-Name-Bot');
		$arrTest[] = array(true, 'Mozilla/5.0 (en-us) AppleWebKit/525.13 (KHTML, like Gecko; Google Web Preview) Version/3.1 Safari/525.13','Google Web Preview');
		
		//Output
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de">
<body>';
		echo '<div>';
			echo '<div style="float:left;width:50%;font-family:Verdana,sans-serif;font-size: 12px;">';
				$this->CheckBotAgentTest($arrTest);
			echo '</div>';
			echo '<div style="float:left;width:50%;font-family:Verdana,sans-serif;font-size: 12px;">';
				$this->CheckBotAgentAdvancedTest($arrTest);
			echo '</div>';
		echo '</div>';
		echo '<div style="clear:both;font-family:Verdana,sans-serif;font-size: 12px;"><br>';
			$this->CheckBotIPTest();
		echo '</div>';
		echo "<h2>ModuleBotDetection Version: ".$this->getVersion()."</h2>";
		echo "</body></html>";
	} 
	
	private function CheckBotAgentTest($arrTest)
	{
	    echo "<h1>CheckBotTest</h1>";

	    $y=count($arrTest);
	    for ($x=0; $x<$y; $x++)
	    {
	        $result[$x] = $this->BD_CheckBotAgent($arrTest[$x][1]);
	    }
	    for ($x=0; $x<$y; $x++)
	    {
	        $nr = ($x<10) ? "&nbsp;".$x : $x;
	        if ($arrTest[$x][0] == $result[$x]) {
	        	echo '<span style="color:green;">';
	        } else 
	        {
	            echo '<span style="color:red;">';
	        }
	        echo "TestNr: ". $nr ."&nbsp;&nbsp;Expectation/Result: ".var_export($arrTest[$x][0],true)."/".var_export($result[$x],true)." (".$arrTest[$x][2].")";
	        echo "</span><br>";
	    }
		
		return true;
	}
	
	private function CheckBotIPTest()
	{
	    echo "<h1>CheckBotIPTest</h1>";
	    $arrTest[] = array(false,false,'own IP');
	    $arrTest[] = array(false,'74.125.79.100','74.125.79.100 - Google Plus');
	    $arrTest[] = array(true,'192.114.71.13','192.114.71.13 - web spider israel');
	    $arrTest[] = array(true,'65.55.231.74','65.55.231.74 in 65.52.0.0/14 - MSN Net');
	    $arrTest[] = array(true,'66.249.95.222','66.249.95.222 in 66.249.64.0/19 - Google Net');
	    $arrTest[] = array(true,'2001:4860:4801:1109:0:6006:1300:b075','2001:4860:4801:1109:0:6006:1300:b075 - Google Bot IPv6');
	    $arrTest[] = array(false,'2001:0db8:85a3:08d3:1319:8a2e:0370:7334','2001:0db8:85a3:08d3:1319:8a2e:0370:7334 - No Bot');
	    $arrTest[] = array(false,'2001:0db8:85a3:08d3:1319:8a2e:0370:7334','2001:0db8:85a3:08d3:1319:8a2e:0370:7334 - No Bot');
	    $arrTest[] = array(false,'::ffff:c000:280','::ffff:c000:280 - double quad notation for ipv4 mapped addresses');
	    $arrTest[] = array(false,'::ffff:192.0.2.128','::ffff:192.0.2.128 - double quad notation for ipv4 mapped addresses');
	    
	    $y=count($arrTest);
	    for ($x=0; $x<$y; $x++)
	    {
	        $result[$x] = $this->BD_CheckBotIP($arrTest[$x][1]);
	    }
	    for ($x=0; $x<$y; $x++)
	    {
	        $nr = ($x<10) ? "&nbsp;".$x : $x;
	        if ($arrTest[$x][0] == $result[$x]) {
	        	echo '<span style="color:green;">';
	        } else 
	        {
	            echo '<span style="color:red;">';
	        }
	        echo "TestNr: ". $nr ."&nbsp;&nbsp;Expectation/Result: ".var_export($arrTest[$x][0],true)."/".var_export($result[$x],true)." (".$arrTest[$x][2].")";
	        echo "</span><br>";
	    }

	    return true;
	}
	
	private function CheckBotAgentAdvancedTest($arrTest)
	{
	    echo "<h1>CheckBotAdvancedTest</h1>";
	    $y=count($arrTest);
	    for ($x=0; $x<$y; $x++)
	    {
	        $result[$x] = $this->BD_CheckBotAgentAdvanced($arrTest[$x][1]);
	    }
	    for ($x=0; $x<$y; $x++)
	    {
	        $nr = ($x<10) ? "&nbsp;".$x : $x;
	        if ($arrTest[$x][0] == $result[$x]) {
	        	echo '<span style="color:green;">';
	        } else 
	        {
	            echo '<span style="color:red;">';
	        }
	        echo "TestNr: ". $nr ."&nbsp;&nbsp;Expectation/Result: ".var_export($arrTest[$x][0],true)."/".var_export($result[$x],true)." (".$arrTest[$x][2].")";
	        echo "</span><br>";
	    }
	
		return true;
	}
	
} // class

/**
 * Instantiate controller
 */
$objBotDetectionTest = new ModuleBotDetectionTest();
$objBotDetectionTest->run();

?>