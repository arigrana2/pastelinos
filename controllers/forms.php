<?php

    $tipoForm= $_POST['formulario'];

    switch($tipoForm){
        case "contacto": enviarMensaje($_POST['nombre'],$_POST['email'],$_POST['mensaje']);
        case "login": login($_POST['username'],$_POST['password']);
        case "profile": updateProfile($_POST['username'],$_POST['password'],$_POST['nombre'],$_POST['apellidopat'],$_POST['apellidomat'],$_POST['email'],$_POST['avatar'],$_POST['iduser']);    
        default: break;
    }

    function enviarMensaje($nombre,$email,$mensaje){
        require_once('../libraries/class.phpmailer.php');
        date_default_timezone_set('America/Mexico_city');
        require '../libraries/PHPMailerAutoload.php';
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP - requires a local mail server
        //Faster and safer than using mail()
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        $mail->CharSet = 'UTF-8';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = "ari.aacg@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "Ariadna871222";
        $mail->AddReplyTo($email,$nombre);

        $mail->SetFrom($email, $nombre);
        require_once('conexion.php');
        $query="SELECT email FROM usuarios WHERE idTipoUser=1";
        $result=mysqli_query($conexion,$query);
        while($fila=mysqli_fetch_assoc($result)){
            $mail->AddAddress($fila['email'], "Administrador");
        }
        $mail->AddCC($email,$nombre);
        $mail->Subject= "Mensaje nuevo en Pastelinos";
        $mail->IsHTML(false);
        $mail->Body= $mensaje; // optional, comment out and test

        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Message sent!";
        }
    }

    function login($username,$password){
        require('conexion.php');
        $passHashed=md5($password);
        $query="SELECT idusuarios,nombre, apellidopat FROM usuarios WHERE username='".$username."' AND password='".$passHashed."';";
       $result=mysqli_query($conexion,$query);
        if($fila=mysqli_fetch_assoc($result)){
            session_start();
            $_SESSION["usuario"]=$fila['nombre']." ".$fila["apellidopat"];
            $_SESSION["user"]=$fila['idusuarios'];
    ?>
            <script type="text/javascript">
                location.href="../admon/index.php";
            </script>
       <?php }else{ ?>
            <script type="text/javascript">
              alert("Username y/o password incorrecto!");
              location.href=history.back();
            </script>
     <?php   }
    }

    function updateProfile($username,$password,$nombre,$apellidopat,$apellidomat,$email,$avatar,$iduser){
        require('conexion.php');
        $query="SELECT password FROM usuarios WHERE idusuarios='".$iduser."';";
        $result=mysqli_query($conexion,$query);
        if($fila=mysqli_fetch_assoc($result)){
            if ($password!=$fila['password']){
                  $password=md5($password);
            }
        }
        $query="UPDATE usuarios set username='".$username."', password='".$password."', nombre='".$nombre."', apellidopat='".$apellidopat."', apellidomat='".$apellidomat."', email='".$email."', avatar='" .$avatar."' WHERE idusuarios='".$iduser."';";
        if ($conexion->query($query) === TRUE) {
            echo "Updated successfully";
        } else {
            echo "Error updating record: " . $conexion->error;
        }


    }
?>