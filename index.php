
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

 <script type="text/javascript" src="vis/dist/vis.js"></script>

<link href="vis/dist/vis.css" rel="stylesheet" type="text/css">

<style type="text/css">

#grafo1{

    width: 600px;
    height: 400px;
    border: 1px solid lightgray;

}

</style>


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

        $_SESSION["Grafo"]->visualisar_vertice($_POST["id_ver"]);
    }

?>

<form class="Arista" action = "index.php" method = "post">

    <h4>Agregar Arista</h4>

    <input class = "item" placeholder = "Vertice de origen" type = "text" name = "v_origen">
    <input class = "item" placeholder = "Vertice destino" type = "text" name = "v_destino">
    <input class = "item" placeholder = "Peso" type = "text" name = "peso"><br><br>
    <input class="Botom"  type="submit" value="Agregar arista" name="AgregarA">

</form><br>

<form class="visual" action= "index.php" method="post">

        <input class= "botom" type= "submit" value= "Visualizar grafo" name = "vis">

</form><br>



    <?php 

        if (isset($_POST["v_origen"]) && isset($_POST["v_destino"]) && isset($_POST["peso"])) {
            $_SESSION["Grafo"]->AgregarArista($_POST["v_origen"],$_POST["v_destino"],$_POST["peso"]);

            $origen =$_POST["v_origen"]; 
            $destino=$_POST["v_destino"];
            $peso=$_POST["peso"];
            $mensaje= "{from: '".$_POST["v_origen"] ."' , to: '" .$_POST["v_destino"]. "', label: " .$_POST["peso"] ."}, ";
            
            $_SESSION["Grafo"]-> visualisar_arista($mensaje, $origen, $destino, $peso);
           
        }
        
        print_r($_SESSION["Grafo"]->GetMatriz());

     ?>



<br><hr><br>

<div id="grafo1"></div>

<script type="text/javascript">

var nodos = new vis.DataSet([

<?php
 

 $v =  $_SESSION["Grafo"]->GetVectorvisvert();

  if(isset($_POST["vis"])!=null){


        foreach ($v as $id ) {
           
            echo "{id: '$id', label: '$id' }, ";
            
        } 

       
  }
   

?>

 ]);

 var aristas = new vis.DataSet([

    <?php

    $va =  $_SESSION["Grafo"]-> GetVectorVisArist();

         if(isset($_POST["vis"])!=null) {

       
            foreach ($va as $ar ) {
           
                echo $ar;
                
            } 

    }

?>

]);

var contenedor = document.getElementById("grafo1");

var datos = {

    nodes:nodos,
    edges: aristas

};

var opciones = {

    edges:{

        arrows:{

            to:{

                enabled:true        //Para grafos dirigidos

            }

        }

    },

     /*   configure:{

            enabled: true,
            container: undefined,
            showButton: true


        }*/

};

var grafo = new vis.Network(contenedor, datos, opciones);

</script>




</body>
</html>