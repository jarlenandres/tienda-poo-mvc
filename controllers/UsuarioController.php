<?php
require_once 'models/usuario.php';

class usuarioController{

    public function index(){
        echo "Controlador Usuario, Acción index";
    }

    public function registro(){
        //
        require_once 'views/usuario/registro.php';
    }

    //Método guardar usuario
    public function save(){
        //
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($nombre && $apellidos && $email && $telefono && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setTelefono($telefono);
                $usuario->setPassword($password);
              
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $usuario->setId($id);
                    $save = $usuario->edit();
                }else{
                    $save = $usuario->save();
                }
              
                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'usuario/registro');
    }

    //Método login
    public function login(){
        // Validar si existe el metodo post
        if(isset($_POST)){
            // Identificar al usuario
            // Consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            $identity = $usuario->login();

            // Crear una sesión
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
           
                if($identity->rol== 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'Identificación fallida';
            }
        }
        header("Location:".base_url);
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".base_url);
    }

    public function gestion(){
        Utils::isAdmin();

        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once 'views/usuario/gestion.php';
    }

    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            $user = $usuario->getOne();

            require_once 'views/usuario/registro.php';
        }else{
            header("Location:".base_url.'usuario/gestion');
        }
    }
}