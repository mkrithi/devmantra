<?php

	ini_set("display_errors",1);
	error_reporting(E_ALL);
	
	//$host = "LOCAL";
	$host = "SERVER";
	

	if($host == "SERVER")
	{
		$dbUser 			= 'dbuser';
		$dbPass 			= 'User@123';
		$db	 				= 'taxnsave';
		$wwwroot			= "/var/www/test/";
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
	$dbHost 			= 'localhost';
	$g_link =  mysqli_connect( $dbHost, $dbUser, $dbPass,$db);
	//mysql_select_db($db, $g_link);	
	$filename = $wwwroot."__CRON/amfi_data/amfi_price.txt";
	$url = "https://www.amfiindia.com/spages/NAVAll.txt?t=".date("dmYHmi")."";	//jsessionid=".trim($_COOKIE['JSESSIONID']);


	echo "URL:-".$url;
	//echo filesize($filename);exit;
	/*if(mysql_num_rows(mysql_query("SELECT * FROM amfi_data WHERE is_updated = 0")) > 0 && filesize($filename) > 100)
	{
		echo "dd";
	}
	if(filesize($filename) > 100)
	{*/
		@unlink($filename);
		mysqli_query($g_link,"TRUNCATE TABLE amfi_data");
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$amfiData = curl_exec($ch);
		echo "<br>filename:=".$filename."<br>";
		$file = fopen($filename, "w+");
		fputs($file, $amfiData);
		fclose($file);
		//chmod("amfi_price.txt",0777);
		chmod($filename, 0775); 
		$load_sql = "SET GLOBAL local_infile = 'ON';";
        mysqli_query($g_link,$load_sql);      
		$importSQL = ' LOAD DATA LOCAL INFILE "'.$wwwroot.'__CRON/amfi_data/amfi_price.txt'.'"
										INTO TABLE amfi_data 
										FIELDS TERMINATED by \';\' 
										LINES TERMINATED BY \''.$newLine.'\' IGNORE 1 LINES;';
		mysqli_query($g_link,$importSQL);
		//mysqli_query($g_link,"DELETE FROM amfi_data WHERE ISIN = ''");	
		//$yesterday = (date('d-M-Y',strtotime("-1 days")));			
		//mysql_query("DELETE FROM amfi_data WHERE amfi_update_date = '".$yesterday."'");	
	//}
	
	//exit;
	$mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
	$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$mailHeaders .= 'From: Technical Support <support@optymoney.com>' . "\r\n";
	$mailSub = "OPTYMONEY - AMFI PRICE Data UPDATE ".date("d/M/Y H:m:i A");

	if(filesize($filename) > 100)
	{		
		// if($host == "SERVER")
		// 	include_once("../__lib.includes/config.inc.php");
		// else
		// 	include_once($wwwroot."__lib.includes/config.inc.php");	
		include_once("/var/www/test/__lib.includes/config.inc.php");
	
		$update_price = $mutualFund->updatePrice();
		//echo "HI";
		//print_r($update_price);

		//echo $update_price;
		
		//mail("support@devmantra.com",$mailSub,"Price Updated into DB with size of - ".filesize($filename),$mailHeaders); 
	}
	else
	{
		//mail("support@devmantra.com",$mailSub,"Price NOT Updated into DB with size of - ".filesize($filename),$mailHeaders);
	}
	//@unlink($filename);
	exit; 
?>