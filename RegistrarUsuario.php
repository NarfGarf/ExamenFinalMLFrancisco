<!DOCTYPE html>
<html lang="en">
    <head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"></head>
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
//<button type="button" class="btn btn-primary">Primary</button>
if (login($name,$pass)){
?>
    <h1>VALIDO</h1>
<?php
} else{
?>
    <h1>NO VALIDO</h1>
    <button type="button" class="btn btn-primary" onclick="location.href='index.html'">Regresar</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>