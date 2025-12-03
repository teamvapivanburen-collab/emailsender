<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        // ---------- 1. Email to Admin ----------
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'raushanmansagar12345@gmail.com';
        $mail->Password = 'ppqv zdri rqjl ftjw';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('raushanmansagar12345@gmail.com', 'Ignexus Website');
        $mail->addAddress('raushanmansagar12345@gmail.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = " New Inquiry from $name - Ignexus";

        $mail->Body = '
        <html>
        <head>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin:0; padding:0;}
            .container { max-width: 600px; margin: auto; background: #ffffff; border-radius: 10px; overflow: hidden; }
            .header { background: #4CAF50; color: #ffffff; text-align: center; padding: 20px;}
            .header img { max-height: 50px; display: block; margin: auto; }
            .content { padding: 30px; color: #333; }
            .message-box { padding:15px; background:#f9f9f9; border-left:5px solid #4CAF50; margin-top:10px;}
            .footer { background: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #888;}
        </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://ignexus.in/ignexus/images/oie_8135719L4eGjFJ2.png" alt="Ignexus Logo">
                    <h2>New Inquiry Received</h2>
                </div>
                <div class="content">
                    <p><strong>👤 Name:</strong> '.$name.'</p>
                    <p><strong>📧 Email:</strong> '.$email.'</p>
                    <p><strong>💬 Message:</strong></p>
                    <div class="message-box">'.nl2br($message).'</div>
                </div>
                <div class="footer">
                    This message was sent automatically from the Ignexus website.
                    <br>
                    <a href="https://www.ignexus.in" style="color:#4CAF50; text-decoration:none;">www.ignexus.in</a>
                </div>
            </div>
        </body>
        </html>';

        $mail->send();

        // ---------- 2. Confirmation Email to User ----------
        $confirmation = new PHPMailer(true);
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
        $confirmation->Subject = " Your Inquiry Has Been Received - Ignexus";

        $confirmation->Body = '
        <html>
        <head>
        <style>
            body { font-family: Arial, sans-serif; background-color:#e6f7ff; margin:0; padding:0;}
            .container { max-width:600px; margin:auto; background:#ffffff; border-radius:10px; overflow:hidden;}
            .header { background:#4CAF50; color:#ffffff; text-align:center; padding:20px;}
            .header img { max-height:50px; display:block; margin:auto; }
            .content { padding:30px; color:#333;}
            .message-box { padding:15px; background:#f9f9f9; border-left:5px solid #4CAF50; margin-top:10px;}
            .button { display:inline-block; background:#4CAF50; color:#fff; text-decoration:none; padding:10px 20px; border-radius:5px; margin-top:15px;}
            .footer { background:#f0f8ff; padding:15px; text-align:center; font-size:12px; color:#888;}
            .social-icons img { width:24px; height:24px; margin:0 5px;}
        </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://ignexus.in/ignexus/images/oie_8135719L4eGjFJ2.png" alt="Ignexus Logo">
                    <h2>Thank You, '.$name.'</h2>
                </div>
                <div class="content">
                    <p>We have received your inquiry and will get back to you shortly.</p>
                    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">
                    <p><strong>📧 Your Email:</strong> '.$email.'</p>
                    <p><strong>💬 Your Message:</strong></p>
                    <div class="message-box">'.nl2br($message).'</div>
                    <p style="text-align:center;">
                        <a href="https://www.ignexus.in" class="button">Visit Our Website</a>
                    </p>
                </div>
                <div class="footer">
                    Connect with us:
                    <div class="social-icons">
                        <a href="https://www.facebook.com/ignexus" target="_blank"><img src="https://img.icons8.com/color/48/000000/facebook-new.png"/></a>
                        <a href="https://www.linkedin.com/company/ignexus" target="_blank"><img src="https://img.icons8.com/color/48/000000/linkedin.png"/></a>
                        <a href="https://twitter.com/ignexus" target="_blank"><img src="https://img.icons8.com/color/48/000000/twitter.png"/></a>
                    </div>
                    <br>
                    Ignexus | <a href="https://www.ignexus.in" style="color:#4CAF50; text-decoration:none;">www.ignexus.in</a>
                </div>
            </div>
        </body>
        </html>';

        $confirmation->send();

        echo "Message sent successfully! A professional confirmation email has been sent to $email.";

    } catch (Exception $e) {
        echo "Error sending email: {$e->getMessage()}";
    }
}
?>
