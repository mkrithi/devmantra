<?php

//include("../__lib.includes/config.inc.php"); 

    /* if($host == "SERVER")
    {*/
        $dbUser             = 'dbuser';
        $dbPass             = 'User@123';
        $db                 = 'taxnsave';
        $wwwroot            = "/var/www/test/";
        $newLine            = "\n";
    //}
   
    $dbHost             = 'localhost';
    $g_link =  mysqli_connect( $dbHost, $dbUser, $dbPass,$db);       //'162.144.140.80';  

    $debugMail          =  'support@devmantra.com';

   // $wwwroot            = $CONFIG->wwwroot;


    // Password

    $pword = "Devmantra@123";


    //SAVE FILE PATH FOR ZIP,DBF AND CSV
    $importKARVYPath    = $wwwroot.'__CRON/mf_data_file/rta_data/KARVY/';  
    //$zipFile = $wwwroot.'__CRON/mf_data_file/rta_data/KARVY/'; // Local Zip File Path

    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

    $username = 'support@devmantra.com'; # e.g somebody@gmail.com

    $password = 'support@123';

  

    /* try to connect */

    $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

    set_time_limit(3000); 

    $emails2 = imap_search($inbox,'UNSEEN SUBJECT "Subscribed Master AUM" SINCE "31 January 2018" FROM "distributorcare@kfintech.com"'); 

    if($emails2)        // KARVY

    {
        
        $count = 1;

        /* put the newest emails on top */

        rsort($emails2);
        echo "karvy:-";
        print_r($emails2);

         /* for every email... */
        $last_karvy_ids = array();
        foreach($emails2 as $email_number) 
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
            // if($date_on[2] == $c_month) 
            // {
            //     if ($date_on[1] == $c_date) 
            //     {
            //        echo "<br>HURRAY:-".$email_number."<br>";
                    array_push($last_karvy_ids, $email_number);                  
            //     }
            //     else
            //     {
            //         echo "Not in the Day!";
            //     }
            // }
            // else
            // {
            //     echo "NOT in hte Month";
            // }
        }
        echo "<br>ALL ID:-";
        print_r($last_karvy_ids);
        echo "<br>";
        //die();

        //$karvy_email_number = array_shift($emails2);
       /* echo "<br>";
        echo "<br>Email Number:-".$karvy_email_number;
        echo "<br>";
        echo "<br>";*/
        foreach ($last_karvy_ids as $karvy_email_number) 
        {
            $msg_body = imap_base64(imap_body($inbox,$karvy_email_number));

            //echo "<br><br>MESSAGE BODY:-".$msg_body."<br><br>";

            //$get_msg_body = imap_body($inbox, $karvy_email_number);
            //echo "<br><br>GET MESSAGE BODY:-".$get_msg_body."<br><br>";        
            //echo "<br>IMAP Body:-";
            //echo imap_body($inbox,$karvy_email_number);
            $file_structure = imap_fetchbody($inbox,$karvy_email_number,2);
            echo "<br>Structure:-".$file_structure."<br>";
            //print_r($file_structure);
            $structure = imap_fetch_overview($inbox,$karvy_email_number);
            echo "Structure:-";
            print_r($structure);
            echo "<br><br><br>";
            echo "<br>";
            echo "DATE:-".$structure[0]->date."<br><br><br>";
            $date = $structure[0]->date;
            $date = explode(',', $date);
            print_r($date);

            $karvy_links = array();
            $dom = new domdocument;
            $dom->loadHTML($file_structure);
            foreach ($dom->getElementsByTagName("a") as $a) 
            {
                if ($dom->getAttribute) 
                {
                    echo "<br><br><br>TagName:-".$dom->getAttribute."<br><br><br>";
                }
                    echo "$A".$a->textContent, "<br>";
                    array_push($karvy_links,$a->getAttribute("href"));
                    echo $a->getAttribute("href"), "<br>";
            }
            echo "<br><br>ALL Links:-";
            echo "<pre>";
            print_r($karvy_links);
            echo "</pre>";
            echo "<br><br>";
            // foreach ($karvy_links as $key) 
            // {
            //     if(preg_match('/SDHLIQAGF/', $key)) {
                   
            //         $karvy_link = $key;
            //         break;
            //     }

            // }
            echo "Specified Link:-";
            echo "<a href=".$karvy_link[1].">".$karvy_links[1]."</a><br><br><br>";
           /* if($karvy_link) 
            {*/
                $karvy_link = trim($karvy_links[1]);
                //$karvy_data = file_get_contents_curl($karvy_link); 
                if($karvy_link) 
                {
                    /*------------------------------------------------------------------------------------------------------*/
                        
                        $zip_name = 'karvy'.date("Y").rand().".zip"; 
                        $zipFile = $importKARVYPath.$zip_name;
                        $zipResource = fopen($zipFile, "w");
                        // Get The Zip File From Server
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $karvy_link);
                        curl_setopt($ch, CURLOPT_FAILONERROR, true);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
                        curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
                        curl_setopt($ch, CURLOPT_FILE, $zipResource);
                        $page = curl_exec($ch);
                        if(!$page) {
                         echo "Error :- ".curl_error($ch);
                        }
                        curl_close($ch);
                        if(file_exists($zipFile)) 
                        {
                            //echo "Hurray";  
                            //GET ZIP file Name            
                            $command = "zipinfo -1 ".$zipFile;
                            //echo "<br><br>Command:-".$command;
                            ob_start();
                            $dbf_file = shell_exec($command); 
                            ob_end_clean(); 
                            echo "<br>DBF FILE NAME:-".$dbf_file;

                            // CSV Name
                            $csvname = "karvy".rand().".csv";

                            //Download Zip file
                            $command = "7za e \"".$zipFile."\" -p".$pword." -aoa -o\"".$importKARVYPath."\"";
                            ob_start();
                            $ac= shell_exec($command); 
                            ob_end_clean(); 


                            $dbfname = trim($dbf_file);
                            $file_name_path = $importKARVYPath.$dbfname;
                            if(file_exists($file_name_path)) 
                            {
                                $convert = "dbf2csv ".$file_name_path." > ".$importKARVYPath.$csvname;
                                echo "<br><br><br>CONVERT:-".$convert."<br><br><br>";
                                ob_start();
                                $get_csv = shell_exec($convert); 
                                ob_end_clean(); 
                                //echo "<br><br><br>done<br><br><br>";
                                chmod($getCSVFile,0777);
                                 $getCSVFile = $importKARVYPath.$csvname;
                                 if(file_exists($getCSVFile)) 
                                 {
                                    // Upload to the database
                                    $load_sql = "SET GLOBAL local_infile = 'ON';";
                                    mysqli_query($g_link,$load_sql);      
                                    $RTAName = "karvy_inv";;
                                    $newLine = "\n";
                                    // $v       = '"';
                                    // $space = "' ".$v." '";
                                    // $esc = "\\";
                                    $a = '"';
                                    $delimeter = "'$a'";
                                    $importSQL =  'LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
                                                   INTO TABLE mf_'.strtolower($RTAName).'
                                                   FIELDS TERMINATED by \',\' OPTIONALLY ENCLOSED BY '.$delimeter.' 
                                                   LINES TERMINATED BY \''.$newLine.'\'  IGNORE 1 LINES;'; 
                                    
                                    echo "<br><br><br>SQL:".$importSQL."<br><br><br>";                                                        

                                    $run = mysqli_query($g_link,$importSQL);
                                    //$CONFIG->db->db_close();
                                    mysqli_close($g_link);
                                    if ($run) 
                                    {
                                        echo "<br>HURRAY";
                                        include_once("/var/www/test/__lib.includes/config.inc.php");
            							//echo "HI";
            							$mutualFund->updateinvfranklin();
                                        unlink($zipFile);
                                        unlink($file_name_path);
                                        //unlink($file_name_path);
                                        //unlink($getCSVFile);
                                    }
                                    else
                                    {
                                        echo "<br>Value is not Inserted into Database";
                                    }
                                 }
                            }
                            else
                            {
                                echo "<br><br><br>FILE IS NOT EXIST<br>";
                            }
                        }
                        else
                        {
                            echo "OOPS";
                        }
                    /*------------------------------------------------------------------------------------------------------*/
                }
                
            //}
        }
    }  
    else
    {
        echo "NO EMAIL UPDATE!";
    }
?>