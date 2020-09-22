<?php

//include("../__lib.includes/config.inc.php");
    $dbHost             =  'localhost';            //'162.144.140.80';  
    $dbUser             = 'dbuser';
    $dbPass             = 'User@123';
    $db                 = 'taxnsave';
    $wwwroot            = "/var/www/test/";
    $newLine            = "\n";

    //DATABASE CONNECTION
    $g_link =  mysqli_connect( $dbHost, $dbUser, $dbPass,$db);

    function file_get_contents_curl($url) { 
    $ch = curl_init(); 
  
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
  
    $data = curl_exec($ch); 
    curl_close($ch); 
  
    return $data; 
    } 

    

    $debugMail          =  'support@devmantra.com';

    //$wwwroot            = $CONFIG->wwwroot;

    
    //SAVE FILE PATH FOR ZIP,DBF AND CSV
    $importfranklinPath    = $wwwroot.'__CRON/mf_data_file/rta_data/FRANKLIN/'; 
    /*echo "Path:-".$importfranklinPath;
    die();*/
    

    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

    $username = 'support@devmantra.com'; # e.g somebody@gmail.com

    $password = 'support@123';

  

    /* try to connect */

    $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

    set_time_limit(3000); 

    $emails1 = imap_search($inbox,'UNSEEN SUBJECT "Distributor Folio Details" SINCE "31 January 2018" FROM "distserve@franklintempleton.com"');



if($emails1)        // FRANKLIN

{

    $count = 1;

    echo "EMAIL:-";
    print_r($emails1);

    /* put the newest emails on top */

    //rsort($emails1);
    //echo "<br><br>";
    //print_r($emails1); 

    /* for every email... */

    // foreach($emails1 as $email_number) 

    // {
    $last_franklyn_ids = array();
    foreach($emails1 as $email_number) 
    {
    	 $overview = imap_fetch_overview($inbox,$email_number,0);
       	// DATE checking
        //echo "<br>Overview:-";
        //print_r($overview);
       	// echo "<br>";
        echo "<br>DATE FROM1:-".$overview[0]->date."<br>";//."<br><br><br>";
        $date = $overview[0]->date;
        $D = $date;
       // echo "<br>D:-".$D."<br>";
        $date_on = explode(' ',$D);
       	echo "<br>DATE Structure:-";
       	print_r($date_on);
        echo "<br>";
       	$c_month = date('M');
       	$c_date = date("d");
       	// if($date_on[1] == $c_month) 
       	// {
       	// 	if ($date_on[0] == $c_date) 
       	// 	{
       	// 		echo "<br>HURRAY:-".$email_number."<br>";
       	 		array_push($last_franklyn_ids, $email_number);       			
       	// 	}
       	// 	else
       	// 	{
       	// 		echo "Not in the Day!";
       	// 	}
       	// }
       	// else
       	// {
       	// 	echo "NOT in hte Month";
       	// }
    }
    echo "<br>ALL ID:-";
    print_r($last_franklyn_ids);
    echo "<br>";
    //die();

    // $last_franklyn_id = array_shift($emails1);
    // echo "<br>Franklyn Id:-".$last_franklyn_id."<br>";
    foreach ($last_franklyn_ids as $last_franklyn_id) {
    	# code...
        $msg_body = imap_qprint(imap_body($inbox, $last_franklyn_id));

        //echo "<br>Message:-".$msg_body."<br>";

        /* get information specific to this email */

        $overview = imap_fetch_overview($inbox,$last_franklyn_id,0);

        /* get mail message */

        $message =  imap_fetchbody($inbox,$last_franklyn_id,2);

        //echo "<br><br>MessageBody:-".$message;
        /* get mail structure */

        $structure = imap_fetchstructure($inbox, $last_franklyn_id);

        //echo "<br><br><br>Structure:-";
        //print_r($structure);
        //echo "<br><br><br>";

        $attachments = array();
            if(isset($structure->parts) && count($structure->parts)) {

                for($i = 0; $i < count($structure->parts); $i++) {

                    $attachments[$i] = array(
                        'is_attachment' => false,
                        'filename' => '',
                        'name' => '',
                        'attachment' => ''
                    );
                    
                    if($structure->parts[$i]->ifdparameters) {
                        foreach($structure->parts[$i]->dparameters as $object) {
                            if(strtolower($object->attribute) == 'filename') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['filename'] = $object->value;
                            }
                        }
                    }
                    
                    if($structure->parts[$i]->ifparameters) {
                        foreach($structure->parts[$i]->parameters as $object) {
                            if(strtolower($object->attribute) == 'name') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['name'] = $object->value;
                            }
                        }
                    }
                    //echo "Attachment:-".$attachments[$i]['attachment']."<br>";
                    if($attachments[$i]['is_attachment']) {
                        $attachments[$i]['attachment'] = imap_fetchbody($inbox, $last_franklyn_id, $i+1);
                        if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                            $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                        }
                        elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                            $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                        }
                    }
                }
            }

         //echo "Attchment:-";
         //print_r($attachments);
        /*----------------------------------------------------------------------------------------------------------------*/

        file_put_contents($importfranklinPath.$attachments[1]['name'], $attachments[1]['attachment']);
        if (file_exists($importfranklinPath.$attachment['filename'])) 
        {
            $zip_file_name = $attachments[1]['name'];
    
            //GET ZIP file Name            
            $command = "zipinfo -1 ".$importfranklinPath.$zip_file_name;
            //echo "<br><br>Command:-".$command;
            ob_start();
            $dbf_file = shell_exec($command); 
            ob_end_clean(); 
            echo "<br>DBF FILE NAME:-".$dbf_file;
            //Download Zip file

            $pword= "AAGC0312";

            $command = "7za e \"".$importfranklinPath.$zip_file_name."\" -p".$pword." -aoa -o\"".$importfranklinPath."\"";
            echo "Command<br>".$command."<br>";
            ob_start();
            $ac= shell_exec($command); 
            ob_end_clean(); 
            
            $dbfname = $dbf_file;
            //echo "<br>DBF_NAME:-".$dbfname."<br>";
            $path = $importfranklinPath;
            //echo "<br>PATH:-".$path."<br>";
            $csvname = rand().".csv";
            //echo "<br>CSV_NAME:-".$csvname."<br>";
            $dbfname = trim($dbfname);
            $file_name_path = $path.$dbfname;
            //echo "<br>FILE PATH:-".trim($file_name_path);
            if(file_exists($file_name_path)) 
            {
                $convert = "dbf2csv ".$file_name_path." > ".$path.$csvname;
                ob_start();
                $get_csv = shell_exec($convert); 
                ob_end_clean(); 
                //echo "<br><br><br><br>DBF2CSV:-<br><br>".$convert."";
                //echo "<br>Converstion:-".$get_csv;
                echo "<br><br><br>done<br><br><br>";
            }
            else
            {
                echo "<br><br><br>FILE IS NOT EXIST<br>";
            }
            
            // creating csv file name
            /* $csvfilename =  explode(".", $dbf_file);
            $csvfilename = $filename['0'].".csv";*/

            
            echo "<br>CSV File Name:-".$csvname."<br>";
            $getCSVFile = $importfranklinPath.$csvname;
            $load_sql = "SET GLOBAL local_infile = 'ON';";
            mysqli_query($g_link,$load_sql);      
            // Upload to the database
            $RTAName = "franklin_inv";
            $newLine = "\n";
            //$sperater = ",";
            $a = '"';
            $delimeter = "'$a'";
            $importSQL = 'LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
                                   INTO TABLE mf_'.strtolower($RTAName).'
                                   FIELDS TERMINATED by \',\' OPTIONALLY ENCLOSED BY '.$delimeter.' 
                                   LINES TERMINATED BY \''.$newLine.'\'  IGNORE 1 LINES;';  

            echo "<br><br><br>SQL:-".$importSQL."<br><br><br>";                                    
            $run = mysqli_query($g_link,$importSQL);
            mysqli_close($g_link);
            if ($run) 
            {
                echo "<br>HURRAY";
                unlink($importfranklinPath.$zip_file_name);
                unlink($importfranklinPath.$dbf_file);
                //unlink($getCSVFile);
                include_once("/var/www/test/__lib.includes/config.inc.php");
                $mutualFund->updateinvfranklin();
        		//echo "HI";
        		//$mutualFund->updateInvestorFolio();
            }
            else
            {
                echo "<br>DATA is not INSERT into TABLE";
            }

            //unlink($file);
        }
        else
        {
            echo "<br><br>OOPS!";
        }
    }

} 

?>