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



//usar PreparedStatement para consultas sql para que no sql injeccion
//$name == 'admin'&& $pass == 'pass'
if (login($name,$pass)){
?>
    <h1>VALIDO</h1>
<?php
} else{
?>
    <h1>NO VALIDO</h1>
    
<?php
}
function login($name,$pass){
    $sqlName = "SELECT * FROM usuarios";
    $dConnect = new  DatabaseConection;
    $datos = $dConnect-> exec_query($sqlName);

    while($row = mysqli_fetch_assoc($datos)){
       if($name == $row["nombre"] && $pass == $row["pass"]){
            return true;
       }
    }
    return false;
}


?>
</body>
</html>