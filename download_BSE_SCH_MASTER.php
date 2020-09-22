<?php

	ini_set("display_errors",1);
	error_reporting(E_ALL);
	
	$url = "https://www.bsestarmf.in/RptSchemeMaster.aspx";	//jsessionid=".trim($_COOKIE['JSESSIONID']);
	echo "URL:-".$url;
	$ch = curl_init($url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	print_r($result);
	
	preg_match_all('/<input type="hidden" name="([^"]*)" id="([^"]*)" value="([^"]*)"/', $result, $matches);
	//echo "<pre>";
	//print_r($matches);
	$param = $matches[2][0]."=".urlencode($matches[3][0])."&".$matches[2][1]."=".urlencode($matches[3][1])."&".
			 $matches[2][2]."=".urlencode($matches[3][2])."&".$matches[2][3]."=".urlencode($matches[3][3]);
	
	//$useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$param.'&ddlTypeOption=SCHEMEMASTERPHYSICAL&btnText=Export+to+Text');
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie:  ASP.NET_SessionId=pirg1qnldmbiloeeaufotagx"));
	curl_setopt($ch, CURLOPT_SSLVERSION, 4);
	
	$server_output = curl_exec ($ch);	
	$a = curl_getinfo($ch);
	$error = curl_error($ch); 
	/*-----------------------*/
	//print_r($server_output);
	/*-----------------------*/	
	$host = "SERVER";
	//$host = "LOCAL";
	
if($host == "SERVER")
	{
		$dbUser 			= 'dbuser';
		$dbPass 			= 'User@123';
		$db	 				= 'taxnsave_sample';
		$wwwroot			= "/var/www/html/";
		$newLine			= "\n";
	}
	else
	{
		$dbUser 			= 'root';
		$dbPass 			= 'publish';
		$db	 				= 'b2b';
		$wwwroot	     	= "D:/Dharm/www/Rajan/www.ca.in/";
		$newLine			= "\n";
	}
	
	$filename = $wwwroot."__CRON/sch_master.txt";
	$file = fopen($filename, "w+");
	fputs($file, $server_output);
	fclose($file);
	chmod("sch_master.txt",0777);
$mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$mailHeaders .= 'From: Technical Support <support@optymoney.com>' . "\r\n";
$mailSub = "OPTYMONEY - BSE Data Download ".date("d/M/Y H:m:i A");

	if(filesize($filename) > 10000)
	{
		
		$dbHost 			= 'localhost';
		$g_link = mysqli_connect( $dbHost, $dbUser, $dbPass,$db);
		//mysqli_select_db($db, $g_link);
		mysqli_query($g_link,"TRUNCATE TABLE `mf_scheme_bse_master`");
		
		$importSQL = ' LOAD DATA LOCAL INFILE "'.$wwwroot.'__CRON/sch_master.txt'.'"
										INTO TABLE mf_scheme_bse_master 
										FIELDS TERMINATED by \'|\' 
										LINES TERMINATED BY \''.$newLine.'\' IGNORE 1 LINES;';

										//LOAD DATA INFILE 'ratings.txt' INTO TABLE ratings FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES;
		//echo $importSQL;
		mysqli_query($g_link,$importSQL);
		//mysqli_error($g_link);
	
		if($host == "SERVER")
			include_once("../__lib.includes/config.inc.php");
		else
			include_once("../__lib.includes/config.inc.php");	
		
		//print_r($CONFIG);
		$m = $mutualFund->updateNAVMaster();

		echo "updateNAVMaster";
		print_r($m);
		echo "string";
		
		//mail("support@devmantra.com",$mailSub,"Data added into DB with size of - ".filesize($filename),$mailHeaders); 
	}
	else
	{
		mail("support@devmantra.com",$mailSub,"Data NOT added into DB with size of - ".filesize($filename),$mailHeaders);
	}
	@unlink($filename);
	exit; 
?>