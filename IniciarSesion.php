<!DOCTYPE html>
<html lang="en">
    <head>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="css.css">
    </head>
<body>

<?php

include "DatabaseConection.php";

$dConnect = new  DatabaseConection;

$name = "";
$pass = "";

// Se usa htmlspecialchars() para prevenir html injection
$name = htmlspecialchars($_REQUEST["name"]);
$pass = htmlspecialchars($_REQUEST["pass"]);




if (login($name,$pass)){// Intenta iniciar sesión, si funciona te envía al Shop.php. Si falla te avisa y te permite regresar a Login.html
?>
    <meta http-equiv="refresh" content="0; url='Shop.php'" /><!--Te envía directamente a Shop.php-->
<?php
} else{
?>
    <div class="alert alert-danger" role="alert"><!--Avisa que ocurrio un error-->
        Error, Usuario o contraseña incorrecto
    </div>
    <button type="button" class="btn btn-primary" onclick="location.href='Login.html'">Regresar</button><!--Regresar a Login.html-->
<?php
}
function login($name,$pass){// Metodo para iniciar sesión
    $sqlName = "SELECT * FROM usuarios";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    // Por cada fila de datos, compara el nombre y la contraseña de la base de datos con los datos aportados en el formulario
    while($row = mysqli_fetch_assoc($datos)){
       if($name == $row["nombre"] && $pass == $row["pass"]){
            return true;// Devuelve true si encuentra algo
       }
    }
    return false;// Devuelve false si ningun dato en la BD coincide con los aportados
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>