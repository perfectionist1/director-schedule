<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__."/lib/AdnSmsNotification.php");
require_once(__DIR__."/config/db_config.php");
include('config/db_config.php');

use AdnSms\AdnSmsNotification;

 
 
 // Check connection
if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connection -> connect_error;
  exit();
}
		
	//$_POST['form_date'] = $_POST['form_subject'] = $_POST['form_time'] = $_POST['form_place'] = '';
    
    
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['insertdt'])) {
	   // echo $_POST['testing_key'];
		$date = $_GET['form_date'];
		$subject  = $_GET['form_subject'];
		$time  = $_GET['form_time'];
		$place  = $_GET['form_place'];
		
		
		$query = "INSERT INTO bmrc_schedule(`date`, `subject`, `time`, `place`) VALUES('$date', '$subject', '$time', '$place' )" ;

		$query_run = mysqli_query($connection, $query);
// 		print_r($query_run);
// 		exit();
		if($query_run){				
    		$message = "Schedule Director Sir - Date: ".$date." Subject: ".$subject." Time:".$time." Place: ".$place;
            $recipient="8801711002486";       // Number, destination number here
            $requestType = 'SINGLE_SMS';    // options available: "SINGLE_SMS", "OTP"
            $messageType = 'TEXT';         // options available: "TEXT", "UNICODE"
            $sms = new AdnSmsNotification();
            $sms->sendSms($requestType, $message, $recipient, $messageType);
            echo "Congrats! Your Data saved!";
			//header('Location:https://bmrcbd.org/director/index.php');
// 			echo "<script>location.href='https://bmrcbd.org/director/index.php'</script>";
             echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';     
            exit();
			
		}else{
			echo "Sorry! Your data is not being saved.";
		}
	}


