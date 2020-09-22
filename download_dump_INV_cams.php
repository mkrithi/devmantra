<?php

//include("../__lib.includes/config.inc.php");
    
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

   

    $dbHost             =  'localhost';            //'162.144.140.80';  

    $debugMail          =  'support@devmantra.com';

    //$wwwroot            = $CONFIG->wwwroot;

    //$fileSavePath       = $wwwroot.'__uploaded.files/storage_1/__admin.upload/__RTADownloaded.files/';

    $importCAMPath      = $wwwroot.'__CRON/mf_data_file/rta_data/CAMS/';
    

    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

    $username = 'support@devmantra.com'; # e.g somebody@gmail.com

    $password = 'support@123';

  

    /* try to connect */

    $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());


    set_time_limit(3000); 

    $emails = imap_search($inbox,'UNSEEN SUBJECT "WBR9. Investor Static details feed" SINCE "31 Jan 2018" FROM "donotreply@camsonline.com"');



if($emails)         
{
    $count = 1;

    /* put the newest emails on top */

    rsort($emails);
    
    /* for every email... */
    $last_cams_ids = array();
    foreach($emails as $email_number) 
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
        //     if ($date_on[0] == $c_date) 
        //     {
        //         echo "<br>HURRAY:-".$email_number."<br>";
                array_push($last_cams_ids, $email_number);                  
        //     }
        //     else
        //     {
        //         echo "Not in the Day!";
        //     }
        // }
        // else
        // {
        //     echo "NOT in the Month";
        // }
    }
    echo "<br>ALL ID:-";
    print_r($last_cams_ids);
    echo "<br>";
    //die();

        //$email_number = array_shift($emails);

        //echo "Email Number:-".$email_number."<br>";
        foreach ($last_cams_ids as $email_number) 
        {

        
            $overview = imap_fetch_overview($inbox,$email_number,0);

            $message = imap_fetchbody($inbox,$email_number,2);
           
            $msg_body = imap_qprint(imap_body($inbox, $email_number));
            //echo $msg_body."<br>";

            

            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $msg_body, $match);

            $link = array_shift($match);


            //print_r($link);
            $link = array_shift($link);


            $file_name = basename($link); 
            
            $data = file_get_contents_curl($link); 
            $fp = basename($link); 
            file_put_contents($importCAMPath.$fp, $data);
            $file = $importCAMPath.$fp;
            if(file_exists($file))
            {
                //echo "<br><br>COOL";  
              


                //GET ZIP file Name            
                $command = "zipinfo -1 ".$file;
                //echo "<br><br>Command:-".$command;
                ob_start();
                $dbf_file = shell_exec($command); 
                ob_end_clean(); 
                echo "<br>DBF FILE NAME:-".$dbf_file;
                echo "<br>";
                $file_extension = "";
                $file_ext = "";
                $file_ext = explode(".", $dbf_file);
                $file_ext = strtolower($file_ext[1]);
                $file_extension = trim(strval($file_ext));
                echo $file_extension."<br>";
                if($file_extension == "dbf") 
                {
                    echo "HI";
                        //Download Zip file
                        $command = "7za e \"".$file."\" -pmantra12 -aoa -o\"".$importCAMPath."\"";
                        ob_start();
                        $ac= shell_exec($command); 
                        ob_end_clean(); 
                        
                        $dbfname = $dbf_file;
                        //echo "<br>DBF_NAME:-".$dbfname."<br>";
                        $path = $importCAMPath;
                        //echo "<br>PATH:-".$path."<br>";
                        $csvname = rand().".csv";
                        //echo "<br>CSV_NAME:-".$csvname."<br>";
                        $dbfname = trim($dbfname);
                        $file_name_path = $path.$dbfname;
                        //echo "<br>FILE PATH:-".trim($file_name_path);
                        // if(file_exists($file_name_path)) 
                        // {
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
                        $getCSVFile = $importCAMPath.$csvname;

                        // Upload to the database
                        $RTAName = "cam_inv";
                        $newLine = "\n";
                        $load_sql = "SET GLOBAL local_infile = 'ON';";
                        mysqli_query($g_link,$load_sql);                        
                        $a = '"';
                        $delimeter = "'$a'";
                        $importSQL = 'LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
                                   INTO TABLE mf_'.strtolower($RTAName).'
                                   FIELDS TERMINATED by \',\' OPTIONALLY ENCLOSED BY '.$delimeter.' 
                                   LINES TERMINATED BY \''.$newLine.'\'  IGNORE 1 LINES;';    

                        $run = mysqli_query($g_link,$importSQL);
                        mysqli_close($g_link);
                        if ($run) 
                        {
                            echo "<br>HURRAY";
                            unlink($importCAMPath.$file);
                            unlink($importCAMPath.$dbf_file);
                            //unlink($getCSVFile);

                            include_once("/var/www/test/__lib.includes/config.inc.php");
                            //echo "HI";
                            $mutualFund->updateinvcams();
                        }
                        else
                        {
                            echo "<br>OOOOPS!SORRY";
                            // include_once("../__lib.includes/config.inc.php");
                            // //echo "HI";
                            // $mutualFund->updateCAMData();
                        }

                    //unlink($file);
                // }
                // else
                // {
                //     echo "<br>FILE extension NOT Supported<br>";
                //     //echo "Extention:=".$file_ext;
                // }
            }
        else
        {
            echo "<br><br>OOPS!";
        }
        }
    } 
    else
    {
        echo "No mail to update Data";
    }

    

?>