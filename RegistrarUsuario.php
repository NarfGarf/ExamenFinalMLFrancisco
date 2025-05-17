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

$User_name = "";
$User_pass = "";

$Cli_name = "";
$Cli_apell = "";
$Cli_correo = "";
$Cli_fecha_nac = "";
$Cli_genero = "";

// Se usa htmlspecialchars() para prevenir html injection
$User_name = htmlspecialchars($_REQUEST["name"]);
$User_pass = htmlspecialchars($_REQUEST["pass"]);

$Cli_name = htmlspecialchars($_REQUEST["nombre"]);
$Cli_apell = htmlspecialchars($_REQUEST["apellido"]);
$Cli_correo = htmlspecialchars($_REQUEST["correo"]);
$Cli_fecha_nac = htmlspecialchars($_REQUEST["fecha_nac"]);
$Cli_genero = htmlspecialchars($_REQUEST["genero"]);


// Si registra al usuario y al cliente correctamente, te permite ir al inicio de sesion. Si hay un error te avisa
if (registerUser($User_name,$User_pass,$Cli_correo)&& registerClient($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero,$User_name,$User_pass)){
?>
    <div class="alert alert-success" role="alert"><!--Avisa que todo fue correcto-->
        Usuario Registrado Exitosamente!
    </div>
    <button type="button" class="btn btn-primary" onclick="location.href='Login.html'">Iniciar Sesion</button><!--Regresar a Login.html-->
    
<?php
} else{
?>
    <div class="alert alert-danger" role="alert"><!--Avisa que ocurrio un error-->
        Error, Usuario ya existente o correo ya existente
    </div>
    <button type="button" class="btn btn-primary" onclick="location.href='RegistrarUsuario.html'">Reintentar</button><!--Regresar a RegistrarUsuario.html para volver a intentar-->
<?php
}

// Metodo para registrar el usuario
function registerUser($User_name,$User_pass,$Cli_correo){
    // Si ya hay un usuario con ese nombre y contraseña O con el mismo correo, no creamos otro.
    if(userAlreadyHere($User_name,$User_pass)||cliAlreadyHere($Cli_correo)){return false;}
    
    $dConnect = new  DatabaseConection;
    try{
    // Registra el usuario a la base de datos
    $dConnect->register_user($User_name,$User_pass);
    return true;// Si todo fue bien, devuelve true
    
    }catch(Exception $e){// Si ocurre un error, devuelve falso
        echo "Error:" . $e->getMessage();
        return false;
    }
}
// Metodo para comprobar si ya hay un usuario registrado
function userAlreadyHere($User_name,$User_pass){
    $sqlName = "SELECT * FROM usuarios";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    // Por cada fila de datos, compara el nombre y la contraseña de la base de datos con los datos aportados en el formulario
    while($row = mysqli_fetch_assoc($datos)){
       if($User_name == $row["nombre"] && $User_pass == $row["pass"]){
            return true;// Devuelve true si encuentra algo
       }
    }
    return false; // Devuelve false si ningun dato en la BD coincide con los aportados
}

// Metodo para registrar el cliente
function registerClient($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero,$User_name,$User_pass){
    // Si ya hay un cliente con ese correo, no creamos otro.
    if(cliAlreadyHere($Cli_correo)){return false;}
    $dConnect = new  DatabaseConection;
    try{
    // Registra el cliente a la base de datos
    $dConnect->register_client($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero);
    return true;// Si todo fue bien, devuelve true

    }catch(Exception $e){// Si ocurre un error, devuelve falso
        echo "Error:" . $e->getMessage();
        return false;
    }
}
// Metodo para comprobar si ya hay un cliente con ese correo registrado
function cliAlreadyHere($Cli_correo){
    $sqlName = "SELECT * FROM clientes";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    // Por cada fila de datos, compara el correo de la base de datos con el correo aportado en el formulario
    while($row = mysqli_fetch_assoc($datos)){
       if($Cli_correo == $row["correo"]){
            return true;// Devuelve true si encuentra algo
       }
    }
    return false; // Devuelve false si ningun dato en la BD coincide con los aportados
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>