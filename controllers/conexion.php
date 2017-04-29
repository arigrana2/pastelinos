<?php
//Conexion a la BD pastelinos

$conexion = mysqli_connect("localhost:3306", "root","");
if(mysqli_select_db($conexion,"pastelinos")){
   // echo "Conexion estabilizada";
}else{
    //echo "Conexion rechazada";
}

?>