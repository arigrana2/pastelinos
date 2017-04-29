<?php 
    session_start();
    require_once('../controllers/conexion.php');
    $conexion->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pastelinos::Pasteles y postres</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="../js/slider.js"></script> 
	<link href="../css/blccbx.css" rel="stylesheet" type="text/css"/>
   <link rel="icon" type="image/png" href="../images/favicon.jpg" />
    <link rel="stylesheet" href="../css/pastelinos.css" />
  <link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css" />
    <script src="../js/bljjShadowbx1.js" type="text/javascript"></script>
    <script type="text/javascript">
    Shadowbox.init({
    overlayColor: "#000",
    overlayOpacity: "0.6",
    });
    </script>
         <script>
 
$(document).ready(function(){
    $('#Jtablacliente').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );
    $('#Jtablapasteles').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );
     $('#Jtablapedido').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );
});
</script>
    <script type="text/javascript" language="javascript" src="../js/jquery-3.2.1.min.js"></script>

    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
</head>
<body>
    <header> <h1 id="pasteleria">Pastelinos</h1>
<?php
    $query="SELECT avatar FROM usuarios WHERE idusuarios='".$_SESSION["user"]."';";
    $result=mysqli_query($conexion,$query);
    if($fila=mysqli_fetch_assoc($result)){
?>    
    <div class="avatar" style="background-image: url(../images/usuario/<?php echo $fila['avatar'];?>)"></div>
<?php }else{ ?> 
   <div class="avatar" style="background-image: url(../images/usuario/default.jpg)"></div>
<?php } ?>    
    <h2 id="usuario"><?php echo $_SESSION["usuario"] ?></h2>
    </header>
   
    <nav id="menuizq">
           <ul>
               <li><a href="#top">Inicio</a></li>
               <li><a href="#clientes">Clientes</a></li>
               <li><a href="#pasteles">Pasteles y postres</a></li>
               <li><a href="#pedidos">Pedidos</a></li>
               <li><a href="#perfil">Mi Perfil</a></li>
              </ul>
    </nav>
    <div id="container">
        <div id="derecha">
           <p><img class="social" src="../images/twitter.png" alt="@pastelinos"/></p>
            <p><a target="_blank" href="https://www.facebook.com/PasteleriaPastelinos/"><img class="social" src="../images/facebook.jpeg" alt="Pastelinos"/></a></p>
        </div>
        <div id="top">
               <div class="slide">
                   <figure>
                       <img class="img1" src="../images/product/pastel.jpg" alt="Pastel 3 leches" />   
                       <img src="../images/product/gelatina.jpg"  class="img2" alt="Pastel 3 leches" />
                       <img class="img3" src="../images/product/pandulce.jpg" alt="Pan dulce"/>
                   </figure>
               </div>
         </div>     
    </div>
    <section class="slogan" id="slogan">
        <h4>Te acompañamos en toda importante celebración o para el antojo de todos los días.</h4>
    </section> 
   <section class="page-section" id="clientes">
       <h1>Clientes</h1>
       <table id="Jtablacliente" cellpadding="0" cellspacing="0" border="0" class="display" >
        <thead>
        <tr>
               <th width="58" align="left">Codigo</th>
               <th width="274" align="left">Cliente</th>
               <th width="124" align="left">RFC</th>
               <th width="124" align="left">Dirección</th>
               <th width="119" align="left">Email</th>
               <th width="103" align="left">Contacto</th>
            </tr>
 
        </thead>
        <tbody>
<?php
        $query="SELECT idcliente,nombre, apellidopat,apellidomat,rfc,direccion,email,contacto FROM clientes;"; 
        $result=mysqli_query($conexion,$query);
        while($row=mysqli_fetch_assoc($result)){ 
?>        <tr>
              <td><?php echo trim($row['idcliente']); ?></td>
             <td><?php echo $row['nombre']." ".$row['apellidopat']." ".$row['apellidomat']; ?></td>
             <td><?php echo $row['rfc']; ?></td>
             <td><?php echo $row['direccion']; ?></td>
             <td><?php echo $row['email']; ?></td>
             <td><?php echo $row['contacto']; ?></td>
        </tr>
<?php 
        }
?>       
           </tbody> 
</table>
   </section>
   <section class="page-section" id="pasteles">
       <h1>Pasteles y postres</h1>
       <table id="Jtablapasteles" cellpadding="0" cellspacing="0" border="0" class="display" >
        <thead>
        <tr>
               <th width="58" align="left">Codigo</th>
               <th width="274" align="left">Categoría</th>
               <th width="274" align="left">Descripción</th>
               <th width="124" align="left">Cantidad</th>
               <th width="124" align="left">Costo</th>
               <th width="119" align="left">Tiempo</th>
               <th width="103" align="left">Editar</th>
               <th width="103" align="left">Eliminar</th>
            </tr>
 
        </thead>
        <tbody>
<?php
        $query="SELECT idproducto,descripcion, cantidad,costo,tiempo,(Select categoria FROM categorias WHERE id_cat=idcategoria) as categoria FROM producto;"; 
        $result=mysqli_query($conexion,$query);
        while($row=mysqli_fetch_assoc($result)){ 
?>        <tr>
              <td><?php echo trim($row['idproducto']); ?></td>
             <td><?php echo $row['categoria']; ?></td>
             <td><?php echo $row['descripcion']; ?></td>
             <td><?php echo $row['cantidad']; ?></td>
             <td><?php echo $row['costo']; ?></td>
             <td><?php echo $row['tiempo']; ?></td>
             <td>E</td>
             <td>X</td>
        </tr>
<?php 
        }
?>       
           </tbody> 
</table>
   </section>
   <section class="page-section" id="pedidos">
       <h1>Pedidos</h1>
       <table id="Jtablapedido" cellpadding="0" cellspacing="0" border="0" class="display" >
        <thead>
        <tr>
               <th width="58" align="left">Codigo</th>
               <th width="274" align="left">Cliente</th>
               <th width="274" align="left">Producto</th>
               <th width="124" align="left">Total</th>
               <th width="119" align="left">Status</th>
               <th width="103" align="left">Fecha Pedido</th>
               <th width="103" align="left">Editar</th>
                <th width="103" align="left">Imprimir</th>
            </tr>
 
        </thead>
        <tbody>
<?php
        $query="SELECT idpedido,(SELECT CONCAT(nombre,' ',apellidopat) FROM clientes WHERE idcliente=id_cliente) as cliente,(Select categoria FROM categorias WHERE id_cat IN (select idcategoria FROM producto WHERE idproducto= id_producto)) as categoria ,(Select descripcion FROM producto WHERE idproducto=id_producto) as producto,total,status,fecha FROM pedidos;";
        $result=mysqli_query($conexion,$query);
        while($row=mysqli_fetch_assoc($result)){ 
?>        <tr>
              <td><?php echo trim($row['idpedido']); ?></td>
             <td><?php echo $row['cliente']; ?></td>
             <td><?php echo $row['categoria'].", ".$row['producto']; ?></td>
             <td><?php echo $row['total']; ?></td>
             <td><?php echo $row['status']; ?></td>
             <td><?php echo $row['fecha']; ?></td>
             <td><a><img src="../images/
               editar.jpg" width="15px" height="15px" /></a></td>
             <td>I</td>
        </tr>
<?php 
        }
?>       
           </tbody> 
</table>
   </section>
   <section class="page-section" id="perfil">
      <h1>Mi perfil</h1>
       <form action="../controllers/forms.php" method="post" class="admin-form">
            <fieldset>
<?php
    $query="SELECT idusuarios,username,nombre, apellidopat,apellidomat,email,avatar,password FROM usuarios WHERE idusuarios='".$_SESSION["user"]."';";
    $result=mysqli_query($conexion,$query);
    if($fila=mysqli_fetch_assoc($result)){ 
?>
                <div>
                    <label>Nombre:</label>
                    <input type="text" required name="nombre" value="<?php echo $fila['nombre']; ?>" />
                </div>
                <div>
                    <label>Apellido Paterno:</label>
                    <input type="text" required name="apellidopat" value="<?php echo $fila['apellidopat'] ?>" />
                </div>
                <div>
                    <label>Apellido Materno:</label>
                    <input type="text" name="apellidomat" value="<?php echo $fila['apellidomat']; ?>" />
                </div>
                <div>
                    <label>Email:</label>
                    <input type="text" required name="email" value="<?php echo $fila['email']; ?>" />
                </div>
                <div>
                    <label>Username:</label>
                    <input type="text" required name="username" value="<?php echo $fila['username']; ?>" />
                </div>
                <div>
                    <label>Password:</label>
                    <input type="password" required name="password" value="<?php echo $fila['password']; ?>" />
                </div>
                <div>
                    <label>Archivo avatar:</label>
                    <input type="text"  name="avatar" value="<?php echo $fila['avatar']; ?>" />
                </div>
            <input type="hidden" name="iduser" value="<?php echo $fila['idusuarios']; ?>" />
            <input type="hidden" name="formulario" value="profile" />
<?php
    }
?>           
           <input type="submit" class="button" value="Actualizar">
           </fieldset>
       </form>
   </section>

    <footer id="footer">Pastelinos, Pastelería 2017 Morelia, Michoacán, México
    <address>Av. Guadalupe Victoria #1270, Col. Prados Verdes CP 58110. Tel: (443) 317 0908</address>
    
    <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
            alt="¡CSS Válido!" />
        </a>
    </p></footer>
</body>
</html>