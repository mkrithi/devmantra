<?php

include("../__lib.includes/config.inc.php");
//print_r($CONFIG);
// $importCAMPath = "/var/www/test/__CRON/mf_data_file/rta_data/CAMS/";
// $getCSVFile = $importCAMPath."375732492.csv";

// echo $getCSVFile."<br>";


// $RTAName = "cam";


// if (file_exists($getCSVFile)) 
// {
// 	$newLine = "\n";
// 	$a = '"';
// 	$delimeter = "'$a'";
// 	$d1 = "' '";
// 	$importSQL = 'LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
// 	                               INTO TABLE mf_'.strtolower($RTAName).'
// 	                               FIELDS TERMINATED by \',\' OPTIONALLY ENCLOSED BY '.$delimeter.' 
// 	                               LINES TERMINATED BY \''.$newLine.'\'  IGNORE 1 LINES;';	
	
// 	echo "<br>SQL:-".$importSQL."<br>";
// 	$run = $CONFIG->db->db_run_query($importSQL);
// 	$CONFIG->db->db_close();
// 	if ($run) 
// 	{
// 	    echo "<br>HURRAY";
// 	}
// 	else
// 	{
// 	    echo "<br>OOOOPS!SORRY";
// 	}
// }
// else
// {
// 	echo "FILE NOT EXIST";
// }
//echo $mutualFund->check_live_tbl('fr_cam_id');
//$bseSync->check_kyc();
//print_r($customerProfile->ucc_check());
//$mutualFund->updateInvestorFolio();
//$mutualFund->get_c_amount("B251G");
// $otpnew = "456465";
// $mobno = "8622807690";
// $otp_msg = "Your OTP to Register on OPTYMONEY is ".$otpnew." The OTP will be valid for next 15 mins";
// $url = "https://api-alerts.solutionsinfini.com/v4/?api_key=A97ac1e77641316f29e16438656e2cbb4&method=sms&message=".$otp_msg."&to=".$mobno."&sender=OPTMNY";
// $result = file_get_contents($url);
// print($result);
echo $buySell->kyc_check('FEPPS4533L');
?>