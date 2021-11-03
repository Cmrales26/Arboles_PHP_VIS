<?php
include("node.php");
class Arbol{
    private $Raiz;
    private $Vector_Recorrido = null;

    function __construct() {
        $this->Raiz = null;
    }
    public function CrearArbol($Raiz){
        if($this->Raiz == null){
            $this->Raiz = new Node($Raiz);
        }else{
            echo 'Ya hay una raiz';
            return false;
        }
    }
    public function setraiz($raiz){
        $this->raiz = $raiz; 
    }

    public function Optener_Raiz(){
        return $this->Raiz; 
    }
    public function getVectorR(){
        return $this->Vector_Recorrido;
    }
    public function setVectorR(){
        $this->Vector_Recorrido = null;
    }

    public function Busqueda($nodo, $valor){
        if ($nodo == null) {
            return null;
        }else{
            if ($nodo->getValor()==$valor) {
                return $nodo;
            }else{
                $aux = $this->Busqueda($nodo->getIzquierda(),$valor);
                if($aux != null){
                    return $aux;
                }else{
                    $aux2 = $this->Busqueda($nodo->getDerecha(),$valor);
                    if ($aux2 != null) {
                        return $aux2;
                    }
                }
            }
        }
    }

    public function agregarNodo($padre,$ubicacion,$nodo){
        if($this->Raiz!=null){
            $NodoPadre=$this->Busqueda($this->Raiz,$padre);
            if($NodoPadre!=null){
                if(strcasecmp($ubicacion,"Izquierda")== 0 ){
                    if($NodoPadre->getIzquierda()==null){
                        $NodoPadre->setIzquierda($nodo); 
                    }else{
                        $anterior=$NodoPadre->getIzquierda();
                        $NodoPadre->setIzquierda($nodo);  
                        $this->agregarNodo($NodoPadre->getIzquierda()->getValor(),$ubicacion,$anterior);
                    }
                }else{
                    if($NodoPadre->getDerecha()==null){
                        $NodoPadre->setDerecha($nodo);
                    }else{
                        $anterior=$NodoPadre->getDerecha();
                        $NodoPadre->setDerecha($nodo);  
                        $this->agregarNodo($NodoPadre->getDerecha()->getValor(),$ubicacion,$anterior); 
                    } 
                }
            }
        }
    }
    public function buscarPadre($n, $x) {
        if ($n == null) {
            return null;
        }
        if (($n->getDerecha() != null && $n->getDerecha()->getValor() == $x) || ($n->getIzquierda() != null && $n->getIzquierda()->getValor() == $x)) {
            return $n;
        } else {
            $i = $this->buscarPadre($n->getIzquierda(), $x);
            if ($i != null) {
                return $i;
            } else {
                $d = $this->buscarPadre($n->getDerecha(), $x);
                return $d;
            }
        }
    }
    public function EliminarNodo($n) {
        $x = $this->Busqueda($this-> Raiz, $n);
        if ($x != null) {
            if (($x->getIzquierda() == null && $x->getDerecha()==null)) {
                $p = $this->buscarPadre($this->Raiz, $n);
                if ($p->getIzquierda() != null && $p->getIzquierda()->getValor() == $n) {
                    $p->setIzquierda(null);
                }
                if ($p->getDerecha() != null && $p->getDerecha()->getValor() == $n) {
                    $p->setDerecha(null);
                }
                echo "<script languaje= 'javascript'>
                    alert('Nodo  hoja Eliminado');
                </script>"; 
                } else {
                echo "<script languaje= 'javascript'>
                    alert('No se puede eliminar este nodo');
                </script>"; 
                }
                } else {
                echo "<script languaje= 'javascript'>
                alert('Nodo no existe');
                </script>"; 
            }
            echo "<script>draw();</script>";
        }
    // RECORRIDOS
    public function preOrden($nodo){
        if($nodo!=null){
            $this->Vector_Recorrido[$nodo->getValor()]=null;
            $this->preOrden($nodo->getIzquierda());
            $this->preOrden($nodo->getDerecha());
        }
    }

    public function inOrden($nodo){
        if($nodo!=null){
            $this->inOrden($nodo->getIzquierda());
            $this-> Vector_Recorrido[$nodo->getValor()]=null;
            $this->inOrden($nodo->getDerecha());
        }
    }

    public function posOrden($nodo){
        if($nodo!=null){
            $this->posOrden($nodo->getIzquierda());
            $this->posOrden($nodo->getDerecha());
            $this-> Vector_Recorrido[$nodo->getValor()]=null;
        }
    }
    public function recorridoN($n){
        if($n!=null){
            $r="";
            $tail= array();
            array_push($tail, $n);
            while (count($tail)!=0){
                $aux= array_shift($tail);
                $r=$r." | ".$aux->getValor()." | ";
                if($aux->getIzquierda()!= null){
                    array_push($tail, $aux->getIzquierda());
                }
                if($aux->getDerecha()!= null){
                    array_push($tail, $aux->getDerecha());
                }
            }
            return $r;
        }
    }
    //CONTADORES
    public function Contar_Nodos($n){
        if($n!=null){
            if($n->getIzquierda() == null && $n->getDerecha()==null){
                return 1;
            }else{
                return $this->Contar_Nodos($n->getDerecha())+$this->Contar_Nodos($n->getIzquierda())+1;
            }
        }else{
            return 0;
        }
    }
    public function contarPares($n) {
        if ($n != null) {
            if ($n->getValor() % 2 == 0) {
                return $this->contarPares($n->getIzquierda()) + $this->contarPares($n->getDerecha()) + 1;
            }else{
                return $this->contarPares($n->getIzquierda()) + $this->contarPares($n->getDerecha());
            }
        }else {
            return 0;
        }
    }
    public function alturaArbol($n){
        if($n==NULL){
            return 0;
        }
        else{
            $altIzq = $this->alturaArbol($n->getIzquierda());
            $altDer = $this->alturaArbol($n->getDerecha());
            if($altIzq>=$altDer){
                return $altIzq+1;
            }
            else{
                return $altDer+1;
            }
        }
    }
    public function Completo($n){
        $arbol=$this->alturaArbol($n);
        $completo=(pow(2,$arbol))-1;
        $cantidad=$this->Contar_Nodos($n);
        if($cantidad<$completo){
            $falta=$completo-$cantidad;
            return "El Arbol no esta completo, faltan ".$falta." nodos para que sea completo";
        }else{
            return "El Arbol esta completo";
        }
    }
    public function MostrarHojas($n){
        if($n!=null){
            if($n->getIzquierda() == null && $n->getDerecha()==null){
                $this->Vector_Recorrido[$n->getValor()]=null; 
            }else{
                $i=$this->MostrarHojas($n->getIzquierda());
                if($i!= null){
                    return $i;
                }else{$s=$this->MostrarHojas($n->getDerecha());
                    return $s;
                }
            }
        }
    }
}
?>
