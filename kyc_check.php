<!-- Sample Codes - PAN inquiry (PHP code)-->

        <?php
        //echo 'User IP Address - '.$_SERVER['REMOTE_ADDR']."<br>";
        echo "Domain Name:-".$_SERVER['HTTP_HOST']."<br>";
        echo "IP:-".gethostbyname($_SERVER['HTTP_HOST'])."<br>";
        print_r("\r\n@@@@@@@@@@      Calling NDML KRA WebService      @@@@@@@@@@\r\n<br>");
        $wsdl = 'https://kra.ndml.in/sms-ws/PANServiceImplService/PANServiceImplService.wsdl';
        $p_key = date("d").date("y").rand(000000,999999);
        echo "P key:-".$p_key."<br>";
        $context = stream_context_create([
                                            'ssl' => [
                                                // set some SSL/TLS specific options
                                                'verify_peer' => false,
                                                'verify_peer_name' => true,
                                                'allow_self_signed' => true
                                            ]
                                        ]);
        $options = array(
                                'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
                                'style'=>SOAP_RPC,
                                'use'=>SOAP_ENCODED,
                                'soap_version'=>SOAP_1_1,
                                'cache_wsdl'=>WSDL_CACHE_NONE,
                                'connection_timeout'=>15,
                                'trace'=>true,
                                'encoding'=>'UTF-8',
                                'exceptions'=>true,
                                'stream_context' => $context
                );  
        $soap = new SoapClient($wsdl, $options); 
//        print_r($soap->__getFunctions());
        try {
            $userId = 'VIKAS';
            echo "UserId:-".$userId."<br>";
            $password = 'NDML@1234';
            //echo "Password:-".$password."<br>";
            $passKey = $p_key;
            $request_id = date("Y").rand(000000,999999);
            echo "Request_ID:".$request_id."<br>";
            $passcode_params = array('arg0' => $password, 'arg1' => $passKey);
            $encPass = $soap->getPasscode($passcode_params);            
            $encPassword = $encPass->return;
            print_r("@@@@@@@@@@      Encrypted Password  :->      ".$encPassword."\r\n<br>");            
            $xml_request =  '
                            <APP_REQ_ROOT>
                                 <APP_PAN_INQ>
                                     <APP_PAN_NO>APMPS8553B</APP_PAN_NO>
                                     <APP_MOBILE_NO>9900192697</APP_MOBILE_NO>
                                     <APP_REQ_NO>'.$request_id.'</APP_REQ_NO>
                                 </APP_PAN_INQ>
                             </APP_REQ_ROOT>
                             ';
            echo "XML:".$xml_request."<br>";
            $params = array('arg0' => $xml_request, 'arg1' => $userId, 'arg2' => $encPassword, 'arg3' => $passKey);
//            $data = $soap->panInquiryDetails($params)->return;
            $data = $soap->panInquiryDetails($params)->return;
            print_r("@@@@@@@@@@      XML Response :->      \r\n");
            print_r($data);
            $data = strtolower($data);
            $data = str_replace('"', "", $data);
            echo "<br>".$data."<br>";
            $res = $data;//"<pre>".$data."</pre><br>";
            //$res = explode(" ", $data);
            //echo "<pre>";
            print_r($res);
            //echo "</pre>";
            echo "<br>String Position:-".strpos($res,'apmps8555b')."<br>";
            if(strpos($res,'not available'))
            {
            	echo "<br>KYC not complain";
            }
            else
            {
            	echo "<br>KYC complain";
            }
        }
        catch(Exception $e) {
            print_r("@@@@@@@@@@      Exception occured :->      ".$e->getMessage()."\r\n");
            die($e->getTraceAsString());
        }
        die;
    ?>