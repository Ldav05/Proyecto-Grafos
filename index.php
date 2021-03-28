
<?php

    include('Grafo.php');
    session_start();
    if (isset($_SESSION["Grafo"])==false) {
      $_SESSION["Grafo"] = new Grafo();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Grafos</title>
</head>
<body>

<div class=titulo><h2> PROYECTO GRAFOS</h2></div>

<form class="Vertice" action="index.php" method="post">
    <h4>Agregar Vertice</h4>

    <input class="item"  placeholder=" Id del vertice "  type="text"  name="id_ver"><br><br>
    <input class="Botom"  type="submit" value="Agregar vertice" name="AgregarV">

</form>

<?php 

    if (isset($_POST["id_ver"])) {
        $v = new Vertice($_POST["id_ver"]);
        $n = $_SESSION["Grafo"]->AgregarVertice($v);
    }

?>

<form class="Arista" action = "index.php" method = "post">

    <h4>Agregar Arista</h4>

    <input class = "item" placeholder = "Vertice de origen" type = "text" name = "v_origen">
    <input class = "item" placeholder = "Vertice destino" type = "text" name = "v_destino">
    <input class = "item" placeholder = "Peso" type = "text" name = "peso"><br><br>
    <input class="Botom"  type="submit" value="Agregar arista" name="AgregarA">

</form>


    <?php 

        if (isset($_POST["v_origen"]) && isset($_POST["v_destino"]) && isset($_POST["peso"])) {
            $_SESSION["Grafo"]->AgregarArista($_POST["v_origen"],$_POST["v_destino"],$_POST["peso"]);
        }

        print_r($_SESSION["Grafo"]->GetMatriz());

     ?>

</body>
</html>