<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src=" vis/dist/vis.js"></script>
    <link href="vis/dist/vis.css" rel="stylesheet" type="text/css">
    <title>Arbol Binario</title>
    <style>
    .Canvas_arbol {
        text-align: center;
        border: 2px solid black;
        height: 400px;
    }
    .Container_Mensajes{
        text-align: center;
        border: 2px solid black;
        height: 200px;
    }
    </style>
</head>
<body onload="draw();">
    <?php
    include("Arbol.php");
    session_start();
    if (!isset($_SESSION["Arbol"])) {
    $_SESSION["Arbol"] = new Arbol();
    echo "< language='javascript'>alert('Se están implementando el uso de cookies');</script>";
    }
?>
    <h1>Arbol Binario</h1>
    <div class="Canvas_arbol" id="Canvas_arbol"></div>
    <div class="Formulario_raiz">
        <form action="index.php" method="Post" id="Agergar_Raiz">
        <h2>Agergar Raiz</h2>
        <input type="number" min="1" name="Raiz" placeholder="ID RAIZ" require> 
        <input type="submit" value="Agregar raiz">
    </form>
    <br><hr>
    </div>
    
    <div class="formulario_nodo">
        <h2>Agregar Nodo</h2>
        <form action="index.php" method="post" id="Agergar_nodo">
            <input type="number" min="1" placeholder="Numero del padre" name="Numero_Padre" require>
            <br><br>
            <input type="radio" name="Lado" id="izquierda" value="Izquierda" required> <label for="izquierda" >Izquierda </label>
            <input type="radio" name="Lado" id="derecha" value="Derecha" required> <label for="derecha" >Derecha </label><br>
            <br>
            <input type="number" min="1" placeholder="Numero del hijo" name="Numero_Hijo" require>
            <input type="submit" value="Agregar nodo">
        </form>
        <hr>
    </div>
    <div class="Eliminar">
        <h2>Eliminar nodo</h2>
        <form action="index.php" method ="post">
            <input type="number" min="1" placeholder="Nodo que desea elmiminar" name="Nodo_Eliminar" require>
            <input type="submit" value="Eliminar Nodo">
        </form>
    </div><hr>


    <div class="Opciones">
    <form action="index.php" method= "post">
    <h2>Opciones</h2>
    <!-- RECORRIDOS -->
    <input type="submit" name="PreOrden" class="btn" value="Recorrido Pre-Orden"></input>
    <input type="submit" name="InOrden" class="btn" value="Recorrido In-Orden"></input>
    <input type="submit" name="PosOrden" class="btn" value="Recorrdio Pos-Orden"></input>
    <input type="submit" name="PorNiveles" class="btn" value="Recorrido Por Niveles"></input>
    <!--  -->
    <!-- CONTADORES -->
    <input type="submit" name="ContarNodo" class="btn" value="Contar Nodos"></input>
    <input type="submit" name="contarP" class="btn" value="Contar Nodos Pares"></input>  
    <input type="submit" name="Altura" class="btn" value="Calcular Altura"></input>
    <!--  -->
    <!-- ARBOLES -->
    <input type="submit" name="ArbolCompleto" class="btn" value="¿Arbol Completo?"></input>
    <input type="submit" name="NodosHojas" class="btn" value="Ver Nodos Hojas"></input>
    
    </form>
    <br>
    </div>

    <!-- PARTE PARA EL PHP -->
    <div class="Container_Mensajes">
        <h1>MENASJES</h1>
        <div class="agergar_raiz">
        <?php
        if (isset($_POST["Raiz"])){
            $_SESSION["Arbol"]->CrearArbol($_POST["Raiz"]);
        }
        ?>
    </div>

    <div class="agergar_nodo">
        <?php
        if (isset($_POST["Numero_Padre"], $_POST["Numero_Hijo"], $_POST["Lado"])) {
            if($_SESSION["Arbol"]->Obtener_Raiz() !=null){
                $aux= $_SESSION["Arbol"]->Busqueda($_SESSION["Arbol"]->Obtener_Raiz(),$_POST["Numero_Padre"]);
                $aux2 = $_SESSION["Arbol"]->Busqueda($_SESSION["Arbol"]->Obtener_Raiz(),$_POST["Numero_Hijo"]);
                if($aux!=null){
                    if ($aux2 == null) {
                        $_SESSION["Arbol"]-> agregarNodo($_POST["Numero_Padre"], $_POST["Lado"], new Node($_POST["Numero_Hijo"]));
                    }else{
                        echo "LA ID ". $_POST["Numero_Hijo"]." YA SE ENCUENTRA REGISTRADA";
                    }
                }else{
                    echo "NO SE HA ENCONTRADO ESTE NODO ".$_POST["Numero_Padre"]. " COMO PADRE";
                }
            }
        }
        ?>
    </div>
    <div class="eliminar_nodo">
        <?php
        if (isset($_POST["Nodo_Eliminar"])){
            echo $_SESSION["Arbol"]->EliminarNodo($_POST["Nodo_Eliminar"]);
        }
        ?>
    </div>

    <!-- RECORRIDOS -->
    <div class="Pre-Order">
        <?php
        if (isset($_POST["PreOrden"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->preOrden($_SESSION["Arbol"]->Obtener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x = $x. " | ".$valor." | ";
            }  
            echo"EL RECORRIDO PRE-ORDEN ES: <br><br>". $x;
        }else{
            echo "EL ARBOL ESTÁ VACIO";
        } 
    }
        ?>
    </div>

    <div class="in_order">
        <?php
        if (isset($_POST["InOrden"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->InOrden($_SESSION["Arbol"]->Obtener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
                echo'EL RECORRIDO IN-ORDEN ES:<br><br>'.$x;
        }else{
                echo'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div>
    <div class="post_order">
        <?php
        if (isset($_POST["PosOrden"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->PosOrden($_SESSION["Arbol"]->Obtener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
            echo 'EL RECORRIDO POS-ORDEN ES:<br><br> ' .$x;
        }else{
            echo 'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div>
    <div class="Por_niveles">
        <?php
        if (isset($_POST["PorNiveles"])) { 
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $x=($_SESSION["Arbol"]->recorridoN($_SESSION["Arbol"]->Obtener_Raiz()));
            echo 'EL RECORRIDO POR NIVELES ES: <br><br> '. $x;
        }else{
            echo 'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div>

    <!-- CONTADORES -->
    <div class="ContarNodos">
        <?php
        if (isset($_POST["ContarNodo"])) {
        $x=($_SESSION["Arbol"]-> Contar_Nodos($_SESSION["Arbol"]->Obtener_Raiz()));
        echo'EL NÚMERO DE NODOS EN EL ARBOL ES: <br><br>' .$x;
    }
        ?>
    </div>
    <div class="contar_pares"> <!---No se si esta bien el de pares, no tengo muy claro en funcionamiento--->
        <?php
        if (isset($_POST["contarP"])) {
        $x=($_SESSION["Arbol"]->contarPares($_SESSION["Arbol"]->Obtener_Raiz()));
        echo'EL NÚMERO DE NODOS PARES EN EL ARBOL ES:<br><br>'.$x;
    }
        ?>
    </div>
    <div class="Calcular_altura">
        <?php
        if (isset($_POST["Altura"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $x=$_SESSION["Arbol"]->alturaArbol($_SESSION["Arbol"]->Obtener_Raiz());;
            echo 'LA ALTURA DEL ARBOL ES:<br><br>' .$x;
        }else{
            echo 'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div>
    <!-- ¿ARBOL COMPLETO? -->
    <div class="Arbol_Completo">
        <?php
        if (isset($_POST["ArbolCompleto"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $x=($_SESSION["Arbol"]->Completo($_SESSION["Arbol"]->Obtener_Raiz()));
            echo $x;
        }else{
            echo 'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div>
    <!-- VISUALIZAR HOJAS -->
    <div class="verHojas">
        <?php
        if (isset($_POST["NodosHojas"])) {
        if($_SESSION["Arbol"]->Obtener_Raiz()!=null){
            $_SESSION["Arbol"]->setVectorR();
            $_SESSION["Arbol"]->MostrarHojas($_SESSION["Arbol"]->Obtener_Raiz());
            $x="";
            foreach ($_SESSION["Arbol"]->getVectorR() as $valor => $value) {
                $x=$x. " | ".$valor." | ";
            }
            echo 'LOS NODOS HOJAS SON:<br><br>'. $x;
        }else{
            echo 'EL ARBOL ESTÁ VACIO';
        }
    }
        ?>
    </div> 
    </div>

    
    <?php
    class Optener{ //RECURSIVIDAD
        public function Optener_nodos($nodo) {
            if ($nodo != null) {
                $Valor = $nodo->getValor();
                echo "Nodos.push({id: $Valor, label: String($Valor)});";
                $this->Optener_nodos($nodo->getIzquierda());
                $this->Optener_nodos($nodo->getDerecha());
            }
        }
    public function edges($n) {
        if ($n != null) {
            $p = $n->getValor();
            if ($n->getIzquierda() != null) {
                $h = $n->getIzquierda()->getValor();
                echo "edges.push({from: $p, to: $h});";
            }
            if ($n->getDerecha() != null) {
                $h = $n->getDerecha()->getValor();
                echo "edges.push({from: $p, to: $h},);";
            }
            $this->edges($n->getIzquierda());
            $this->edges($n->getDerecha());
            }
        }
    }
?>

    <!-- VIS -->
    <script type="text/javascript">
    var network = null;

    function destroy() {
        if (network !== null) {
            network.destroy();
            network = null;
        }
    }

    function draw() {
        destroy();
        Nodos = [];
        edges = [];

        <?php
        $op = new Optener();
        $op->Optener_nodos($_SESSION['Arbol']->Obtener_Raiz());
        $op->edges($_SESSION['Arbol']->Obtener_Raiz());
        ?>
        var container = document.getElementById('Canvas_arbol');

        var data = {
            nodes: Nodos,
            edges: edges
        };
        var options = {
            interaction: {
            zoomView: false
        },
            edges: {
                smooth: {
                    roundness: 0
                }
            },
            layout: {
                hierarchical: {
                    sortMethod: "directed"
                },
            },
        };
        network = new vis.Network(container, data, options);
    }
    </script>
</body>
</html>