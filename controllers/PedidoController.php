<?php
require_once 'models/pedido.php';
require_once 'models/producto.php';

class pedidoController{

    public function hacer(){
        
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            $uni = $stats['uni'];

            // Guardar datos en la BD
            if($ciudad && $direccion){
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setCiudad($ciudad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                $producto = new Producto();
                $producto->setStock($uni);
                $producto->update_product();

                // Guardar linea pedido
               $save_linea = $pedido->save_linea();

                if($save && $save_linea && $producto){
                    $_SESSION['pedido'] = "complete";
                }else{
                    $_SESSION['pedido'] = "failed";
                }
            }else{
                $_SESSION['pedido'] = "failed";
            }
            header("Location:".base_url.'pedido/confirmado');
        }else{
            // Redirigir al index
            header("Location:".base_url);
        }
    }

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuarioId($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        // Sacar los pedidos del usuario
        $pedido->setUsuarioId($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id']) ){
            $id = $_GET['id'];

            // Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            $usuario_id = $pedido->usuario_id;

            // Sacar el usuario
            $usuario = new Pedido();
            $usuario->setUsuarioId($usuario_id);
            $usuario = $usuario->getOneByUser();
         
            // Sacer los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:".base_url.'pedido/mis_pedidos');
        }

    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            // Recoger los datos del form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            // Update del estado del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url.'pedido/detalle&id='.$id);
        }else{
            header("Location:".base_url);
        }
    }
}