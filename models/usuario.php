<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        // Conexión base de datos
        $this->db = Database::connect();
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self {
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     */
    public function setApellidos($apellidos): self {
        $this->apellidos = $this->db->real_escape_string($apellidos);
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self {
        $this->email = $this->db->real_escape_string($email);
        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     */
    public function setTelefono($telefono): self {
        $this->telefono = $this->db->real_escape_string($telefono);
        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost'=>4]);
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol() {
        return $this->rol;
    }

    /**
     * Set the value of rol
     */
    public function setRol($rol): self {
        $this->rol = $rol;
        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen() {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     */
    public function setImagen($imagen): self {
        $this->imagen = $imagen;
        return $this;
    }

    // Método guardar
    public function save(){
        // Guardar registro
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getTelefono()}', '{$this->getPassword()}', 'user', NULL)";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function getAll(){
        $usuarios = $this->db->query("SELECT * FROM usuarios ORDER BY id DESC;");
        return $usuarios;
    }

    public function getOne(){
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE id = {$this->getId()}");
        return $usuario->fetch_object();
    }

    // Método login
    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        // Comprobar el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', email='{$this->getEmail()}', telefono='{$this->getTelefono()}', password='{$this->getPassword()}' WHERE id={$this->id}";

        $save = $this->db->query($sql);
   
        $resul = false;
        if($save){
            $resul = true;
        }
        return $resul;
       
    }
}