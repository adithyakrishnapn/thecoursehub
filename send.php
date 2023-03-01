<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'sendemail/phpmailer/src/Exception.php';
require 'sendemail/phpmailer/src/PHPMailer.php';
require 'sendemail/phpmailer/src/SMTP.php';


if(isset($_POST["send"])){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dragoncorexgamer@gmail.com';
    $mail->Password = 'gdscximiixmtwtwt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('dragoncorexgamer@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = $_POST["subject"];
    $mail->Body = "Name : ".$_POST["fname"]."<br> Mail : ".$_POST["y_mail"]."<br> Number : ".$_POST["number"]."<br> Message : ".$_POST["msg"];

    $mail->send();
}


$fname = $_POST['fname'];
$y_mail = $_POST['y_mail'];
$number = $_POST['number'];
$message = $_POST['msg'];

#connect
$connect = new mysqli('localhost','root','','coursehub');
if($connect -> connect_error){
    die('connection failed :' .$connect -> connect_error);
}
else{
    $stmt = $connect ->prepare("insert into details(name,mail,number,message) values(?,?,?,?)");
    $stmt -> bind_param("ssis",$fname,$y_mail,$number,$message);
    $stmt -> execute();
    echo "Thanks for filling the form";
    $stmt ->close();
    $connect -> close();

    echo "<script>
    alert('Sent Successfully');
    document.location.href='index.html';
    </script>";
}
    
?>