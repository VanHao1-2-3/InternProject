<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
class Mailer
{
    public function sendMail($code, $addressMail)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hovanhao12b1@gmail.com';
            $mail->Password = 'tzsbsnydvvhqphbd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('hovanhao12b1@gmail.com', mb_encode_mimeheader('Văn Hào', 'UTF-8', 'Q'));
            $mail->addAddress($addressMail);
            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Quên mật khẩu', 'UTF-8', 'Q');
            $mail->Body = 'Mật khẩu mới của bạn là: <strong>' . htmlspecialchars($code) . '</strong>';

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Lỗi: ' . $e->getMessage());
            return false;
        }
    }
}
