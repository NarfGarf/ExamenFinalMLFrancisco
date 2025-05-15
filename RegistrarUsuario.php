<!DOCTYPE html>
<html lang="en">
    <head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"></head>
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

$User_name = htmlspecialchars($_REQUEST["name"]);
$User_pass = htmlspecialchars($_REQUEST["pass"]);

$Cli_name = htmlspecialchars($_REQUEST["nombre"]);
$Cli_apell = htmlspecialchars($_REQUEST["apellido"]);
$Cli_correo = htmlspecialchars($_REQUEST["correo"]);
$Cli_fecha_nac = htmlspecialchars($_REQUEST["fecha_nac"]);
$Cli_genero = htmlspecialchars($_REQUEST["genero"]);

//usar PreparedStatement para consultas sql para que no sql injeccion
//$User_name == 'admin'&& $User_pass == 'pass'
//<button type="button" class="btn btn-primary">Primary</button>
if (registerUser($User_name,$User_pass,$Cli_correo)&& registerClient($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero,$User_name,$User_pass)){
?>
    <h1>VALIDO</h1>
<?php
} else{
?>
    <h1>NO VALIDO</h1>
    <button type="button" class="btn btn-primary" onclick="location.href='RegistrarUsuario.html'">Regresar</button>
<?php
}



function registerUser($User_name,$User_pass,$Cli_correo){
    if(userAlreadyHere($User_name,$User_pass)||cliAlreadyHere($Cli_correo)){return false;}// si ya hay un usuario con ese nombre y contraseña, no creamos otro.
    
    $dConnect = new  DatabaseConection;
    try{
    $dConnect->register_user($User_name,$User_pass);
    
    echo "Usuario Creado Exitosamente";
    return true;
    }catch(Exception $e){
        echo "Error:" . $e->getMessage();
        return false;
    }
}

function userAlreadyHere($User_name,$User_pass){
    $sqlName = "SELECT * FROM usuarios";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    while($row = mysqli_fetch_assoc($datos)){
       if($User_name == $row["nombre"] && $User_pass == $row["pass"]){
            return true;
       }
    }
    return false; 
}

function registerClient($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero,$User_name,$User_pass){
    if(cliAlreadyHere($Cli_correo)){return false;}// si ya hay un cliente con ese correo, no creamos otro.
    $dConnect = new  DatabaseConection;
    try{
    $dConnect->register_client($Cli_name,$Cli_apell,$Cli_correo,$Cli_fecha_nac,$Cli_genero);
    
    echo "Cliente Creado Exitosamente";
    return true;
    }catch(Exception $e){
        echo "Error:" . $e->getMessage();
        return false;
    }
}

function cliAlreadyHere($Cli_correo){
    $sqlName = "SELECT * FROM clientes";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    while($row = mysqli_fetch_assoc($datos)){
       if($Cli_correo == $row["correo"]){
            return true;
       }
    }
    return false; 
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>