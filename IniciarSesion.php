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

if ($name == 'admin'&& $pass == 'pass'){
?>
    <h1>VALIDO</h1>
<?php
} else{
?>
    <h1>NO VALIDO</h1>
<?php
}

?>
</body>
</html>