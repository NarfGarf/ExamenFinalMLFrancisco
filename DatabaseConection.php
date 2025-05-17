<?php
class DatabaseConection{
    private function dbConect(){
        $_servername="localhost";
        $_username="root";
        $_password="";
        $_database="examenmlfrancisco";
        $_port = 3306; 

        $conn = mysqli_connect($_servername, $_username, $_password, $_database, $_port );
        mysqli_set_charset($conn,'utf8');
        // Comprobar conexion
        if (!$conn){
            die("conection failed: ".mysqli_connect_error());
        }
        return $conn;

    }// Fin dbconnect
    // Creamos un metodo det data para devolver las select
    public function exec_query($sql){
        $mysqli=$this->dbConect();
        $res = $mysqli->query($sql);
        // Cerramos la conexion
        mysqli_close($mysqli);
        return $res;
    }
    // Metodo para registrar un usuario usando prepared statements para prevenir SQLInjection
    public function register_user($name,$pass){
        $mysqli=$this->dbConect();
        $stmt = $mysqli->prepare("insert into usuarios (nombre,pass) VALUES (?,?)");
        $stmt->bind_param("ss", $name, $pass);
        $stmt->execute();
        mysqli_close($mysqli);
    }
    // Metodo para registrar un cliente usando prepared statements para prevenir SQLInjection
    public function register_client($name,$apell,$correo,$fecha_nac,$genero){
        $mysqli=$this->dbConect();
        $stmt = $mysqli->prepare("insert into clientes (nombre,apellidos,correo,fecha_nac,genero) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $apell,$correo,$fecha_nac,$genero);
        $stmt->execute();
        mysqli_close($mysqli);
    }
}
?>