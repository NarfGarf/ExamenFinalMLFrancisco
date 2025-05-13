<!DOCTYPE html>
<html lang="en">
<body>

<?php

include "DatabaseConection.php";

$dConnect = new  DatabaseConection;

$name = "";
$pass = "";

$name = htmlspecialchars($_REQUEST["name"]);
$pass = htmlspecialchars($_REQUEST["pass"]);

login($name,$pass);

//usar PreparedStatement para consultas sql para que no sql injeccion
//$name == 'admin'&& $pass == 'pass'
if ($name == 'admin'&& $pass == 'pass'){
?>
    <h1>VALIDO</h1>
<?php
} else{
?>
    <h1>NO VALIDO</h1>
<?php
}
function login($name,$pass){
    $sqlName = "SELECT nombre FROM usuarios";
    echo($sqlName);
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    $arrayDatos = array();
    while($row = mysqli_fetch_array($datos)){
        $arrayDatos[] = $row;
    }
    foreach($arrayDatos as &$e){
        if($e == $name){
            echo("USERNAME ENCONTRADO");
        }
        echo implode(" ",$e);
    }
}


?>
</body>
</html>