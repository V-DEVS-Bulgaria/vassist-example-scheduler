<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//SMTP server settings
$host = "";
$port = ";
$username = "";
$password = "";

//Recipient's email address
$to = "";


$subject = "";
$message = "";
$licenseNumber = "";

$encryption = "tls";


$mail = new PHPMailer;


$mail->isSMTP();


$mail->SMTPDebug = 0;


$mail->Host = $host;


$mail->Port = $port;


$mail->SMTPAuth = true;


$mail->Username = $username;


$mail->Password = $password;


$mail->SMTPSecure = $encryption;


$mail->setFrom($username, 'V-ASSIST | Дневен статус за рег.номер ' . $licenseNumber);


$mail->addReplyTo($username, 'V-ASSIST | Асистент за шофьори');


$mail->addAddress($to);


$mail->Subject = $subject;


$url = "https://e-uslugi.mvr.bg/api/Obligations/AND?mode=1";
          $url .= "&obligedPersonIdent=" . $_POST['licenseNumber'];
          $url .= "&drivingLicenceNumber=" . $_POST['personId'];
        
        $response = file_get_contents($url);
  
  
        $data = $response;
        if($response !== false) {
            if(strpos($data, '"hasNonHandedSlip":false') !== false) {
                $to = ""; // Enter Recipient
                $subject = "Дневен Статус за глоби към рег.номер " . $_POST['licenseNumber'];;
                $message = "Не бяха открити глоби към регистрационен номер " . $_POST['licenseNumber']; . ", за периода " . date("Y-m-d H:i:s");
                $headers = "From: vassist@v-devs.online" . "\r\n";
                mail($to, $subject, $message, $headers);
            }
            else if(strpos($data,'"hasNonHandedSlip":true') !== false){
                $to = ""; // Enter Recipient
                $subject = "Дневен Статус за глоби към рег.номер " . $_POST['licenseNumber'];;
                $message = "Бяха открити глоби към регистрационен номер " . $_POST['licenseNumber']; . ", за периода " . date("Y-m-d H:i:s");
                $headers = "From: vassist@v-devs.online" . "\r\n";
                mail($to, $subject, $message, $headers);
            }
        }
        


















$task = "[BETA] Дневна проверка за глоби";

echo "Задача:  " . $task . " е изпълнена на" . date("Y-m-d H:i:s") . "\n";


?>
