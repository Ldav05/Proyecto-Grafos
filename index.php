
<?php

    include('Grafo.php');
    session_start();
    if (isset($_SESSION["Grafo"])==false) {
      $_SESSION["Grafo"] = new Grafo();
    } 
    global $activar;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="vis/dist/vis.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Proyecto Grafos</title>

    <style type="text/css">
        #Grafo{
            width: 400px;
            height: 345px;
            border: 1px solid lightgray;
            border-radius: 15px;
            margin-top: -671px;
            margin-left: 900px;
            position: relative;
            background: #ffffff6c;

        }

        #Grafo2{
            width: 400px;
            height: 199px;
            border: 1px solid lightgray;
            border-radius: 15px;
            margin-left: 900px;
            margin-top: -218px;
            position: relative;
            background: #ffffff6c;
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

</form><br>

<?php 

    
    $action = (isset($_POST["Echo"]))?$_POST["Echo"]:"";
    $n = null;

    switch ($action) {
        case 'Agregar vertice':
                    
            if (empty($_POST["id_ver"])) {
                $Ndos="Campo vacio";
            }else{
                if (isset($_POST["id_ver"])) {
                    $v = new Vertice($_POST["id_ver"]);
                    $n = $_SESSION["Grafo"]->AgregarVertice($v);
                }

                if ($n==false) {
                    $Ndos= "El vertice ya existe";
                }else{
                    $Ndos = "Vertice Agregado Correctamente";
                }
    
            }

            
            echo "<script type='text/javascript'>alert('$Ndos');</script>";

            break;

        case 'Ver Grado Vertice':

            if (empty($_POST["id_ver"])) {
                echo "<script type='text/javascript'>alert('Campo vacio');</script>"; 
            }else{
                
         $mat = $_SESSION["Grafo"]->GetMatriz();
 
                if ($mat == null) {

                    echo "<script type='text/javascript'>alert('No existe el vertice');</script>"; 

                }else{

                    $vali = false;
 
         foreach ($mat as $key => $value ) {
       
        if ($key == $_POST["id_ver"]) {

                $msj = "El valor del grado ".$_POST["id_ver"]." Es de ".$_SESSION["Grafo"]->Grado($_POST["id_ver"]);
                echo "<script type='text/javascript'>alert('$msj');</script>"; 
                $valid = false;
                break;
            }else{

            $valid = true;

            }
            

        } 

        if ($valid == true) {

            echo "<script type='text/javascript'>alert('El vertice no existe');</script>"; 
            
        }
            
        
        }
        }


            break;


        case 'Eliminar vertice':

            if (empty($_POST["id_ver"])) {
            
                echo "<script type='text/javascript'>alert('Campo vacio');</script>"; 

        }else{

            $p = $_SESSION["Grafo"]->EliminarVertice($_POST["id_ver"]);
               
            if ($p == false) {
                $msj = "El vertice no existe";
            }else{
                if(isset($_POST["id_ver"])){
                    $msj = "Vertice Eliminado Correctamente";
                }
            }

            echo "<script type='text/javascript'>alert('$msj');</script>";

        }

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

</form><br>

<form class="ver_vertice" action="index.php" method="post">
    
    <h4>Ver vertice</h4>

    <input class = "item" placeholder= "Vertice para ver" type= "text" name="vertice_aver">
    <input class = "Botom" type = "submit" value = "Ver vertice"  name="VerV">
    
    </form><br>

<?php

if(isset($_POST["vertice_aver"]) && isset($_POST["VerV"])!=null){

    if (empty($_POST["vertice_aver"])) {

    echo "<script type='text/javascript'>alert('Campo vac??o');</script>";
}else{

  if(isset($_POST["vertice_aver"]) && isset($_POST["VerV"])!=null){

    $mat = $_SESSION["Grafo"]->GetMatriz();
 
       if($mat == null){

        echo "<script type='text/javascript'>alert('El vertice no existe');</script>";

       }else{

        $valid = false;
 
    foreach ($mat as $key => $value ) {
       
        if ($key == $_POST["vertice_aver"]) {

        $valid = false;
        $vert = $_SESSION["Grafo"]->GetVertice($_POST["vertice_aver"]);
        $visited =  $vert->Getvisitado();
        $id = $vert->getid();
                                    
            if ($visited == true){

                $m1 =  "El vertice ". $id. " visitado";
                echo "<script type='text/javascript'>alert('$m1');</script>";

             
            } else{
    
                $m2 =  "El vertice ". $id. " no ha sido visitado";
                echo "<script type='text/javascript'>alert('$m2');</script>";

            } 
         break;
        }else{

            $valid = true;
    
        }
        
    }

    if($valid == true){

        echo "<script type='text/javascript'>alert('El vertice no existe');</script>";

    }
    
}
}
}
}




?> 



    <?php 

        $capturar = (isset($_POST["Capturar"]))?$_POST["Capturar"]:"";

        $msj="";
        $valor = null;

        switch ($capturar) {
            case 'Agregar arista':

                if (empty($_POST["v_origen"]) && empty($_POST["v_destino"])) {

                    echo "<script type='text/javascript'>alert('Campos vacios');</script>";
                }else{
                if($_POST["peso"] >= 0){      
                $valor = $_SESSION["Grafo"]->AgregarArista($_POST["v_origen"],$_POST["v_destino"],$_POST["peso"]);
                
                if ($valor == true) {
                    $msj = "Arista Agregada Correctamente";
                }else{
                    if (isset($_POST["v_origen"]) && isset($_POST["v_destino"])) {
                    $msj = "Error No Existe El Vertice Origen o Destino";
                    }
                }

                echo "<script type='text/javascript'>alert('$msj');</script>";

            }else{
                echo "<script type='text/javascript'>alert('No se aceptan n??meros negativos');</script>";
            }
        }  
            break;

            case 'Eliminar arista':

                
                if (empty($_POST["v_origen"]) && empty($_POST["v_destino"])) {

                    echo "<script type='text/javascript'>alert('Campos vacios');</script>";
                }else{
                        

                $p = $_SESSION["Grafo"]->EliminarArista($_POST["v_origen"],$_POST["v_destino"]);

                if (isset($_POST["v_origen"]) && isset($_POST["v_destino"]) && $p == false) {
                    $msj = "Error Vertice Origen o Destino vacio o no existe";
                }else{
                    if ($p == true) {
                        $msj = "Arista Eliminada Correctamente";
                    }
                }

                echo "<script type='text/javascript'>alert('$msj');</script>";
            }

            break;
    
            default:
       
            break;
        }   
    ?>


   
    <br><br>

    <h3>By: Double L</h3><br>
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


<form class="Adyacentes" action="index.php" method="post">
    
    <h4>Ver adyacentes</h4>

    <input class = "item" placeholder= "Vertice" type= "text" name="ver_adyacentes">
    <input class = "Botom" type = "submit" value = "Ver adyacente"  name="Echo">
    
    </form><br>
    
     

     <div id ="Grafo2"></div>

    

    <?php 


        $Adyacente = (isset($_POST["Echo"]))?$_POST["Echo"]:"";

        $msj="";

        

        switch ($Adyacente) {
                case 'Ver adyacente':
                                
                    if (isset($_POST["ver_adyacentes"]) && isset($_POST["Echo"])) {

                        if (empty($_POST["ver_adyacentes"])) {

                            echo "<script type='text/javascript'>alert('Campo vacio');</script>";
                            
                        }else{

                        $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                        $p = $_POST["ver_adyacentes"];
                        $cont = 0;

                        foreach ($Mtriz as $key => $value) {
                            if ($key == $p && $value != null) {
                                $cont = 2;
                            }else{
                                if ($key == $p && $value == null) {
                                    $cont = 1;
                                }
                            }
                        }

                        if ($cont == 1) {
                            echo "<script type='text/javascript'>alert('Vertice No Tiene Adyacentes');</script>";
                        }else{
                            if ($cont == 0) {
                                echo "<script type='text/javascript'>alert('Vertice No Existe');</script>";
                            }
                        }
                    }
                }

                    break;

                default:
                    # code...
                    break;
            }  
            
        
    
    ?>

    <form class="Recorridos" action="index.php" method="post">
    
    <h4>Recorridos</h4>

    <input class = "item" placeholder= "Vertice Inicial" type= "text" name="nodo">
    <input class = "item" placeholder= "Vertice Destino" type= "text" name="nodo2">
    <input class = "Botom" type = "submit" value = "Recorrido de anchura"  name="Action">
    <input class = "Botom" type = "submit" value = "Recorrido de profundidad"  name="Action">
    <input class = "Botom" type = "submit" value = "Recorrido m??s corto"  name="Action">
    
    </form><br>
 <?php 

    $Recorrido = (isset($_POST["Action"]))?$_POST["Action"]:"";

    switch ($Recorrido) {
        case 'Recorrido de anchura':
            if(empty($_POST["nodo"])){
                echo "<script type='text/javascript'>alert('Vertice Inicial Vacio');</script>";
            }else{
                $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                $i = false; 
                $p;
                if($Mtriz != null){
                    foreach ($Mtriz as $key => $value) {
                        if ($key == $_POST["nodo"]) {
                            $i = true;
                        }
                     }
                    
                }
                
               if ($i == false) {
                    echo "<script type='text/javascript'>alert('Vertice no existe');</script>";
               }else{
                    $n = $_SESSION["Grafo"]->GetVertice($_POST["nodo"]);
                    $msj = $_SESSION["Grafo"]->Recorrer_anchura($n);
                    $p = count($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]));

                    if ($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) != $_POST["nodo"]) && ($p >= 1 )){
                        echo "<script type='text/javascript'>alert('El recorrido de profundidad es $msj');</script>";
    
                       }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) == $_POST["nodo"]) && ($p > 1)){
                        echo "<script type='text/javascript'>alert('El recorrido de profundidad es $msj');</script>";
    
                       }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) == $_POST["nodo"]) && ($p == 1)){
                        echo "<script type='text/javascript'>alert('Nodo inicial no posee adyacentes diferentes a ??l mismo');</script>";
                        
                       }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) == null){
                        echo "<script type='text/javascript'>alert('Nodo inicial invalido, no posee adyacentes');</script>";   
                       }               }
            }
            break;

        case 'Recorrido de profundidad':

            if(empty($_POST["nodo"])){
                echo "<script type='text/javascript'>alert('Vertice Inicial Vacio');</script>";
            }else{

                $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                $i = false; 
                $p;
                if($Mtriz != null){
                    foreach ($Mtriz as $key => $value) {
                        if ($key == $_POST["nodo"]) {
                            $i = true;
                        }
                     }
                    
                }
                
                
               if ($i == false) {
                    echo "<script type='text/javascript'>alert('Vertice no existe');</script>";
               }else{
                    $n = $_SESSION["Grafo"]->GetVertice($_POST["nodo"]);
                    $msj = $_SESSION["Grafo"]->Recorrer_profundidad($n);
                    $p = count($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]));

                   if ($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) != $_POST["nodo"]) && ($p >= 1 )){
                    echo "<script type='text/javascript'>alert('El recorrido de profundidad es $msj');</script>";

                   }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) == $_POST["nodo"]) && ($p > 1)){
                    echo "<script type='text/javascript'>alert('El recorrido de profundidad es $msj');</script>";

                   }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null && (key($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"])) == $_POST["nodo"]) && ($p == 1)){
                    echo "<script type='text/javascript'>alert('Nodo inicial no posee adyacentes diferentes a ??l mismo');</script>";
                    
                   }elseif($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) == null){
                    echo "<script type='text/javascript'>alert('Nodo inicial invalido, no posee adyacentes');</script>";   
                   }
                    
               }
            }
            break;

           case 'Recorrido m??s corto':

           		if (empty($_POST["nodo"]) && empty($_POST["nodo2"])) {
                	echo "<script type='text/javascript'>alert('Vertice Inicial o Vertice Final Vacio');</script>";
           		}else{
           			$i = false;
           			$d = false;

                       $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                       if($Mtriz != null){
                        foreach ($Mtriz as $key => $value) {
                              
                            if($_POST["nodo2"] == $_POST["nodo"] && $key == $_POST["nodo"]){
                             $i = true;
                             $d = true;
                         
                             }elseif($key == $_POST["nodo"]){
                                     $i = true;
                                 }elseif ($key == $_POST["nodo2"]) {
                                     $d = true;
                                 }
                              }
                       } 

                        

           			if ($i == false) {
                    	echo "<script type='text/javascript'>alert('Vertice inicial no existe');</script>";
                        break;
           			}else{
           				if ($d == false) {
                    		echo "<script type='text/javascript'>alert('Vertice Destino no existe');</script>";
                            break;
           				}else{
           					if (($_SESSION["Grafo"]->GetAdyacentes($_POST["nodo"]) != null)  && ($i!=false) && ($d!=false)) {
           						$activar = true;
                                $corto = $_SESSION["Grafo"]->caminoMasCorto($_POST["nodo"],$_POST["nodo2"]);
                                if(is_array($corto)){
                                    $activar = true;
                                }elseif(!is_array($corto)){
                                    $activar=false;
                                    echo "<script type='text/javascript'>alert('$corto');</script>";
                                }
           					}
           				}
           			}
           		}

            break;    
        
        default:
            # code...
            break;
    }
    

 
 ?>
        <script type="text/javascript">

            var nodos = new vis.DataSet([
                <?php
                
                    if(isset($_POST["ver_adyacentes"]) && isset($_POST["Echo"])!=null){

                    $p = $_POST["ver_adyacentes"];
                
                    $Mtriz = $_SESSION["Grafo"]->GetAdyacentes($_POST["ver_adyacentes"]);

                    $cont=0;

                    foreach ($Mtriz as $key => $value) {
                        echo "{id : '$key', label: '$key'},";
                    };
                    if (!isset($Mtriz[$p])) {
                        echo "{id: '$p', label: '$p' },";
                    }
                }

                if(isset($_POST["nodo"]) && isset($_POST["nodo2"]) && isset($_POST["Action"])!=null && $activar == true){
                    $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                    $corto = $_SESSION["Grafo"]->caminoMasCorto($_POST["nodo"],$_POST["nodo2"]);
                   
                    foreach ($Mtriz as $key => $value) {
                        if(in_array($key,$corto)){
                        echo "{id: '$key', label: '$key', color:{background:'green'}},";
                          }else{
                            echo "{id: '$key', label: '$key'},";
                          }
                }

            }   

                ?>
                ]);


            var arista = new vis.DataSet([
                <?php
                if(isset($_POST["ver_adyacentes"]) && isset($_POST["Echo"])!=null){
                    $Mtriz = $_SESSION["Grafo"]->GetAdyacentes($_POST["ver_adyacentes"]);
                    $p = $_POST["ver_adyacentes"];
                    foreach ($Mtriz as $key => $value) {
                            echo "{from: '$p', to: '$key', label: '$value'},";     
                        };
                    }


                    if(isset($_POST["nodo"]) && isset($_POST["nodo2"]) && isset($_POST["Action"])!=null && $activar == true){

                    
                        $Mtriz = $_SESSION["Grafo"]->GetMatriz();
                        
                        
                        $Mc = $_SESSION["Grafo"]->caminoMasCorto($_POST["nodo"],$_POST["nodo2"]);

                        foreach ($Mtriz as $key => $value) {
                            $c = 0;
                            $control = null;
                            
                            if ($value != null) {   
                                foreach ($value as $Val => $Aris) {
                                   
                                    if((count($Mc)==1) && ($key == $Mc[0])&& ($Val == $Mc[0])){    
                                        $sh = $Mc[0];        
                                         echo "{from: '$sh', to: '$sh', label: '$Aris', color:{color:'green'}},";
                                         
                                     }
                                    elseif((in_array($Val, $Mc)) && (in_array($key, $Mc)) && (end($Mc) != $key) && ($c == 0) && ($key != $Val) && ($control!=$Val) && ($Val != $_POST["nodo"])&& (array_search($key, $Mc ) < array_search($Val, $Mc ) && $activar == true) && (array_search($key, $Mc) == array_search($Val, $Mc)-1)) {
                                        echo "{from: '$key', to: '$Val', label: '$Aris', color:{color:'green'}},";
                                        $c=1;
                                        $control = $key;
                                        
                                    }else{
                                        
                                        echo "{from: '$key', to: '$Val', label: '$Aris'},";
                                    
                                }
                                };
                            }
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