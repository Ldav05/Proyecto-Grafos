
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
    <script type="text/javascript" src="vis/dist/vis.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Grafos</title>

    <style type="text/css">
        #Grafo{
            width: 600px;
            height: 400px;
            border: 1px solid lightgray;
        }

        #Grafo2{
            width: 600px;
            height: 400px;
            border: 1px solid lightgray;
        }

        
    </style>
</head>
<body>

<div class=titulo><h2> PROYECTO GRAFOS</h2></div>

<form class="Vertice" action="index.php" method="post">

    <h4>Vertices</h4>

    <input class="item"  placeholder=" Id del vertice "  type="text"  name="id_ver"><br><br>
    <input class="Botom"  type="submit" value="Agregar vertice" name="Echo">
    <input class="Botom"  type="submit" value="Ver Grado Vertice" name="Echo">
    <input class="Botom"  type="submit" value="Eliminar vertice" name="Echo">

</form><br><hr>

<?php 

    
    $action = (isset($_POST["Echo"]))?$_POST["Echo"]:"";

    switch ($action) {
        case 'Agregar vertice':
                    
            if (empty($_POST["id_ver"])) {
                $Ndos="Ingrese un valor para agregar";
            }else{
                if (isset($_POST["id_ver"])) {
                    $v = new Vertice($_POST["id_ver"]);
                    $n = $_SESSION["Grafo"]->AgregarVertice($v);
                    $Ndos = "Vertice Agregado Correctamente";
                }
            }

            echo "<script type='text/javascript'>alert('$Ndos');</script>";

            break;

        case 'Ver Grado Vertice':

            if (empty($_POST["id_ver"])) {
                $msj = "Ingrese un valor para buscar";
            }else{
                $msj = "El valor del grado ".$_POST["id_ver"]." Es de ".$_SESSION["Grafo"]->Grado($_POST["id_ver"]);
            }

            echo "<script type='text/javascript'>alert('$msj');</script>";


            break;


        case 'Eliminar vertice':

            if(empty($_POST["id_ver"])){
                $msj = "Ingrese un valor para eliminar";
            }else{
                $_SESSION["Grafo"]->EliminarVertice($_POST["id_ver"]);
                $msj = "Vertice Eliminado Correctamente";
            }

            echo "<script type='text/javascript'>alert('$msj');</script>";

            break;
        
        default:
            # code...
            break;
    }


?>

<form class="Arista" action = "index.php" method = "post">

    <h4>Aristas</h4>

    <input class = "item" placeholder = "Vertice de origen" type = "text" name = "v_origen">
    <input class = "item" placeholder = "Vertice destino" type = "text" name = "v_destino">
    <input class = "item" placeholder = "Peso" type = "text" name = "peso"><br><br>
    <input class="Botom"  type="submit" value="Agregar arista" name="Capturar">
    <input class="Botom"  type="submit" value="Eliminar arista" name="Capturar">

</form><br><hr>

<form class="ver_vertice" action="index.php" method="post">
    
    <h4>Ver vertice</h4>

    <input class = "item" placeholder= "Vertice para ver" type= "text" name="vertice_ver">
    <input class = "Botom" type = "submit" value = "Ver vertice"  name="VerV">
    
    </form><br><hr>



    <?php 


        $capturar = (isset($_POST["Capturar"]))?$_POST["Capturar"]:"";

        $msj="";

        switch ($capturar) {
            case 'Agregar arista':
                        
                if (empty($_POST["v_origen"]) && empty($_POST["v_destino"])) {
                    $msj = "Error Vertice Origen o Destino vacio";
                }else{
                    $_SESSION["Grafo"]->AgregarArista($_POST["v_origen"],$_POST["v_destino"],$_POST["peso"]);
                    $msj = "Arista Agregada Correctamente";
                }

                echo "<script type='text/javascript'>alert('$msj');</script>";

                break;

            case 'Eliminar arista':

                if (empty($_POST["v_origen"]) && isset($_POST["v_destino"])) {
                    $msj = "Error Vertice Origen o Destino vacio";
                }else{
                    $_SESSION["Grafo"]->EliminarArista($_POST["v_origen"],$_POST["v_destino"]);
                    $msj = "Arista Eliminada Correctamente";
                }

                echo "<script type='text/javascript'>alert('$msj');</script>";

                break;
            
            default:
                # code...
                break;
        }

        print_r($_SESSION["Grafo"]->GetMatriz());



     ?>


   
    <br><hr><br>

    <h3>Grafo</h3><br>
     <div id ="Grafo"></div>

     <br>

     <script type="text/javascript">

    var nodos = new vis.DataSet([
        <?php
            $Mtriz = $_SESSION["Grafo"]->GetMatriz();
            $cont = 1;
            foreach ($Mtriz as $key => $value) {
                if ($cont == count($_SESSION["Grafo"]->GetMatriz())) {
                    echo "{id : '$key', label: '$key'}";
                }else{
                    echo "{id : '$key', label: '$key'},";
                }
                $cont++;
            };
        ?>
        ]);

    var aristas = new vis.DataSet([
        <?php
            $Mtriz = $_SESSION["Grafo"]->GetMatriz();

            foreach ($Mtriz as $key => $value) {
                if ($value != null) {
                    foreach ($value as $Val => $Aris) {
                        if ($Aris == null) {
                            echo "{from: '$key', to: '$Val'},";
                        }else{
                            echo "{from: '$key', to: '$Val', label: '$Aris'},";
                        }       
                    };
                }
            };
        ?>
        ]);

    var contenedor = document.getElementById("Grafo");

    var opciones = {
        edges:{
            arrows:{
                to:{
                    enabled:true
                }
            }
        }/*,
        configure:{
            enabled:true,
            container:undefined,
            showButton:true
        }*/
    };

    var datos = {
        nodes: nodos,
        edges: aristas
    };


    var grafo = new vis.Network(contenedor,datos,opciones);



    </script>


     <form class="ver_vertice" action="index.php" method="post">
    
    <h4>Ver adyacentes</h4>

    <input class = "item" placeholder= "Vertice" type= "text" name="ver_adyacentes">
    <input class = "Botom" type = "submit" value = "Ver vertice"  name="VerAd">
    
    </form><br>
    
     

     <div id ="Grafo2"></div>



        <script type="text/javascript">

            var nodos = new vis.DataSet([
                <?php
                    if(isset($_POST["ver_adyacentes"]) && isset($_POST["VerAd"])!=null){

                    $p = $_POST["ver_adyacentes"];
                    echo "{id: '$p', label: '$p' },";
                
                    $Mtriz = $_SESSION["Grafo"]->GetAdyacentes($_POST["ver_adyacentes"]);
     
                    foreach ($Mtriz as $key => $value) {
                            echo "{id : '$key', label: '$key'},";
                    };
                }
                ?>
                ]);

            var arista = new vis.DataSet([
                <?php
                if(isset($_POST["ver_adyacentes"]) && isset($_POST["VerAd"])!=null){
                    $Mtriz = $_SESSION["Grafo"]->GetAdyacentes($_POST["ver_adyacentes"]);
                    $Nodo = $_POST["ver_adyacentes"];
                    foreach ($Mtriz as $key => $value) {
                            echo "{from: '$Nodo', to: '$key', label: '$value'},";     
                        };
                    }
                ?>
                ]);

            var contenedor = document.getElementById("Grafo2");

            var opciones = {
                edges:{
                    arrows:{
                        to:{
                            enabled:true
                        }
                    }
                }/*,
                configure:{
                    enabled:true,
                    container:undefined,
                    showButton:true
                }*/
            };

            var datos = {
                nodes: nodos,
                edges: arista
            };


            var grafo = new vis.Network(contenedor,datos,opciones);



        </script>



</body>
</html>