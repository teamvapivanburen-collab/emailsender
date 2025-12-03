<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // ---------- Email to Admin ----------
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'raushanmansagar12345@gmail.com';
        $mail->Password = 'ppqv zdri rqjl ftjw'; // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('raushanmansagar12345@gmail.com', 'Ignexus Website');
        $mail->addAddress('raushanmansagar12345@gmail.com'); 
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Inquiry Submitted on Ignexus from $name";
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; background: #f0f4f8; padding: 30px;'>
            <div style='max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);'>
                <h2 style='text-align:center; color:#4CAF50;'>🌟 New Message Received!</h2>
                <p style='text-align:center; color:#555;'>You have a new inquiry from Ignexus website. Details below:</p>
                <hr style='border:none; border-top:1px solid #eee; margin:20px 0;'>
                <p style='font-size:16px;'><strong>👤 Name:</strong> $name</p>
                <p style='font-size:16px;'><strong>📧 Email:</strong> $email</p>
                <div style='margin-top:20px; padding:15px; background:#f9f9f9; border-left:5px solid #4CAF50;'>
                    <p style='font-size:16px; margin:0;'><strong>💬 Message:</strong></p>
                    <p style='font-size:15px; color:#444;'>" . nl2br($message) . "</p>
                </div>
                <hr style='border:none; border-top:1px solid #eee; margin:25px 0;'>
                <p style='text-align:center; font-size:14px; color:#999;'>This message was automatically sent from Ignexus contact form.</p>
            </div>
        </div>";

        $mail->send();

        // ---------- Confirmation Email to User ----------
        $confirmation = new PHPMailer(true);

        try {
            $confirmation->isSMTP();
            $confirmation->Host = 'smtp.gmail.com';
            $confirmation->SMTPAuth = true;
            $confirmation->Username = 'raushanmansagar12345@gmail.com';
            $confirmation->Password = 'ppqv zdri rqjl ftjw';
            $confirmation->SMTPSecure = 'tls';
            $confirmation->Port = 587;

            $confirmation->setFrom('raushanmansagar12345@gmail.com', 'Ignexus Website');
            $confirmation->addAddress($email, $name);
            $confirmation->addReplyTo('raushanmansagar12345@gmail.com', 'Ignexus Team');

            $confirmation->isHTML(true);
            $confirmation->Subject = "Your Inquiry Has Been Successfully Submitted to Ignexus";

            $confirmation->Body = "
            <div style='font-family: Arial, sans-serif; background: #e6f7ff; padding: 30px;'>
                <div style='max-width:600px; margin:auto; background:#ffffff; border-radius:12px; padding:30px; box-shadow:0 8px 20px rgba(0,0,0,0.1);'>
                    <h2 style='text-align:center; color:#4CAF50;'> Hello $name!</h2>
                    <p style='text-align:center; color:#555;'>Thank you for contacting Ignexus. Your inquiry has been successfully submitted.</p>
                    <hr style='border:none; border-top:1px solid #eee; margin:20px 0;'>
                    <p style='font-size:16px;'><strong>📧 Your Email:</strong> $email</p>
                    <div style='margin-top:20px; padding:15px; background:#f9f9f9; border-left:5px solid #4CAF50;'>
                        <p style='font-size:16px; margin:0;'><strong>💬 Your Message:</strong></p>
                        <p style='font-size:15px; color:#444;'>" . nl2br($message) . "</p>
                    </div>
                    <hr style='border:none; border-top:1px solid #eee; margin:25px 0;'>
                    <p style='text-align:center; font-size:14px; color:#999;'>We will get back to you as soon as possible.<br>– The Ignexus Team</p>
                </div>
            </div>";

            $confirmation->send();

            echo "Message sent successfully! A vibrant confirmation email has been sent to $email.";

        } catch (Exception $e) {
            echo "Message sent to admin, but confirmation email failed: {$confirmation->ErrorInfo}";
        }

    } catch (Exception $e) {
        echo "Error sending email to admin: {$mail->ErrorInfo}";
    }
}
?>
