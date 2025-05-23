<?php


require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class MailHelper {
    public static function sendMail($to, $subject, $body) {
        $mail = new PHPMailer(true);
        
        try {
            // Debug mode
            
            $mail->Debugoutput = 'html';
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tan01204986304@gmail.com';
            $mail->Password = 'ymnx wogx rkll fwty';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            // Cấu hình đặc biệt cho localhost
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            // Tăng timeout
            $mail->Timeout = 60;
            
            $mail->setFrom('tan01204986304@gmail.com', 'HOOPE');
            $mail->addAddress($to);
            
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            $mail->send();
            return true;
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>
