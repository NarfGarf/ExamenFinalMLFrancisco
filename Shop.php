<html>
    <head>
        <title>Shop Fran</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="css.css">
        <?php 
            include "DatabaseConection.php";
        ?>
    
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand" >Shop de Palos y Rocas</a>
    </nav>


        <div class="container">
        <div class="row">
        
        <?php
        $sqlName = "SELECT * FROM productos";
        $dConnect = new  DatabaseConection;
        $datos = $dConnect-> exec_query($sqlName);
        while($row = mysqli_fetch_assoc($datos)){// automaticamente agrega los productos de la tabla a la pagina web
        ?>
        <div class="card">
            <img src="<?php echo $row["image"]?>" class="card-img-top" alt="img">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["nombre"]?></h5>
                <p class="card-text"><?php echo $row["descripcion"]?></p>
                <h5 class="card-money"><?php echo "$"; echo $row["precio"]?></h5>
                <a class="btn btn-primary" >Comprar</a>
            </div>
        </div>
        <?php } ?>
        
        </div>
        </div>
        <button type="button" class="btn btn-warning" onclick="location.href='index.html'">Logout</button>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>
