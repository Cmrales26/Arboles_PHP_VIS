<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .Canvas_arbol{
        border: 2px solid black;
        height: 400px;
        display: flex;
    }
    </style>
</head>
<body onload="draw();">
    <?php
    include("Arbol.php");
    session_start();
    if (!isset($_SESSION["Arbol"])) {
    $_SESSION["Arbol"] = new Arbol();
    echo "<script language='javascript'>alert('Se están implementando el uso de cookies');</script>";
    }
?>
    <h1>Arbol Binario</h1>
    <!-- <div class="Canvas_arbol" id="Canvas_arbol"></div> -->
    <div class="Formulario_raiz">
        <form action="index.php" method="Post" id="Agergar_Raiz">
        <h2>Agergar Raiz</h2>
        <input type="number" min="1" name="Raiz" placeholder="ID RAIZ" require> 
        <input type="submit" value="Agregar raiz">
    </form>
    <br><hr>
    </div>
    
    <div class="formulario_nodo">
        <form action="index.php" method="post" id="Agergar_nodo">
            <input type="number" min="1" placeholder="Numero del padre" name="Numero_Padre" require>
            <br><br>
            <input type="radio" name="Lado" id="izquierda" value="Izquierda" required> <label for="izquierda" >Izquierda </label>
            <input type="radio" name="Lado" id="derecha" value="Derecha" required> <label for="derecha" >Derecha </label><br>
            <br>
            <input type="number" min="1" placeholder="Numero del hijo" name="Numero_Hijo" require>
            <br><br>
            <input type="submit" value="Agregar nodo">
        </form>
        <hr><br>
    </div>
    <div class="Eliminar">
        <h2>Eliminar nodo</h2>
        <form action="index.php" methof ="post">
            <input type="number" min="1" placeholder="Nodo que desea elmiminar" name=Nodo_Eliminar require>
            <input type="submit" value="Eliminar Nodo">
        </form>
    </div><hr>


    <div class="Opciones">
    <form action="index.php" method= "post">
    <h1>Opciones</h1>
    <!-- RECORRIDOS -->
    <input type="submit" name="PreOrden" class="btn" value="Recorrido Pre-Orden"></input>
    <input type="submit" name="InOrden" class="btn" value="Recorrido In-Orden"></input>
    <input type="submit" name="PosOrden" class="btn" value="Recorrdio Pos-Orden"></input>
    <input type="submit" name="PorNiveles" class="btn" value="Recorrido Por Niveles"></input><br><br>
    <!--  -->
    <!-- CONTADORES -->
    <input type="submit" name="ContarNodo" class="btn" value="Contar Nodos"></input>
    <input type="submit" name="contarP" class="btn" value="Contar Nodos Pares"></input>  
    <input type="submit" name="Altura" class="btn" value="Calcular Altura"></input><br><br>
    <!--  -->
    <!-- ARBOLES -->
    <input type="submit" name="ArbolCompleto" class="btn" value="¿Arbol Completo?"></input>
    <input type="submit" name="NodosHojas" class="btn" value="Ver Nodos Hojas"></input>
    
    </form>
    </div>

    <!-- PARTE PARA EL PHP -->
    <div class="agergar_raiz">
        <?php
        if (isset($_POST["Raiz"])){
            $_SESSION["Arbol"]->CrearArbol($_POST["Raiz"]);
            echo "<script languaje= 'javascript'>
            alert('Raiz Agregada Correctamente');
            </script>";
        }
        ?>
    </div>

    <div class="agergar_nodo">
        <?php
        if (isset($_POST["Numero_Padre"], $_POST["Numero_Hijo"], $_POST["Lado"])) {
            if($_SESSION["Arbol"]->Optener_Raiz() !=null){
                $aux= $_SESSION["Arbol"]->Busqueda($_SESSION["Arbol"]->Optener_Raiz(),$_POST["Numero_Padre"]);
                if($aux!=null){
                $_SESSION["Arbol"]-> agregarNodo($_POST["Numero_Padre"], $_POST["Lado"], new Node($_POST["Numero_Hijo"]));
                echo "<script languaje= 'javascript'>
                    alert('Nodo Agregado Correctamente');
                </script>";
                }else{
                echo "<script languaje= 'javascript'>
                    alert('Nodo Padre No Existe');
                </script>";
                }
                }else{
                echo "<script languaje= 'javascript'>
                    alert('El Arbol esta Vacio');
                </script>";
            }
        }
        ?>
    </div>

    <!-- RECORRIDOS -->
    <div class="Pre-Order">
        <?php
        if (isset($_POST["PreOrden"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->preOrden($_SESSION["Arbol"]->Optener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }  
            echo "<script languaje= 'javascript'>
                alert('El Recorrido PreOrden es: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";
        } 
    }
        ?>
    </div>

    <div class="in_order">
        <?php
        if (isset($_POST["InOrden"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->InOrden($_SESSION["Arbol"]->Optener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
            echo "<script languaje= 'javascript'>
                alert('El Recorrido InOrden es: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";   
        }
    }
        ?>
    </div>
    <div class="post_order">
        <?php
        if (isset($_POST["PosOrden"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->PosOrden($_SESSION["Arbol"]->Optener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
            echo "<script languaje= 'javascript'>
                alert('El Recorrido PosOrden es: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";
        }
    }
        ?>
    </div>
    <div class="Por_niveles">
        <?php
        if (isset($_POST["PorNiveles"])) { 
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $x=($_SESSION["Arbol"]->recorridoN($_SESSION["Arbol"]->Optener_Raiz()));
            echo "<script languaje= 'javascript'>
                alert('El Recorrido Por Niveles es: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";
        }
    }
        ?>
    </div>

    <!-- CONTADORES -->
    <div class="ContarNodos">
        <?php
        if (isset($_POST["ContarNodo"])) {
        $x=($_SESSION["Arbol"]-> Contar_Nodos($_SESSION["Arbol"]->Optener_Raiz()));
            echo "<script languaje= 'javascript'>
                alert('El Numero de Nodos en el Arbol es: $x');
            </script>";
    }
        ?>
    </div>
    <div class="contar_pares"> <!---No se si esta bien el de pares, no tengo muy claro en funcionamiento--->
        <?php
        if (isset($_POST["contarP"])) {
        $x=($_SESSION["Arbol"]->contarPares($_SESSION["Arbol"]->Optener_Raiz()));
        echo "<script languaje= 'javascript'>
            alert('El Numero de Nodos Pares en el Arbol es: $x');
        </script>";
    }
        ?>
    </div>
    <div class="Calcular_altura">
        <?php
        if (isset($_POST["Altura"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $x=$_SESSION["Arbol"]->alturaArbol($_SESSION["Arbol"]->Optener_Raiz());;
            echo "<script languaje= 'javascript'>
                alert('La Altura del Arbol es: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('La Altura es 0 porque el Arbol esta Vacio');
            </script>";
        }
    }
        ?>
    </div>
    <!-- ¿ARBOL COMPLETO? -->
    <div class="Arbol_Completo">
        <?php
        if (isset($_POST["ArbolCompleto"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $x=($_SESSION["Arbol"]->Completo($_SESSION["Arbol"]->Optener_Raiz()));
            echo "<script languaje= 'javascript'>
                alert('$x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";
        }
    }
        ?>
    </div>
    <!-- VISUALIZAR HOJAS -->
    <div class="verHojas">
        <?php
        if (isset($_POST["NodosHojas"])) {
        if($_SESSION["Arbol"]->Optener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->MostrarHojas($_SESSION["Arbol"]->Optener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
            echo "<script languaje= 'javascript'>
                alert('Los Nodos Hojas Son: $x');
            </script>";
        }else{
            echo "<script languaje= 'javascript'>
                alert('El Arbol esta Vacio');
            </script>";
        }
    }
        ?>
    </div>

<!-- VIS -->
<script>

</script>

</body>
</html>