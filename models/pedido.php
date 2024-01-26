<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $ciudad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $db;

    public function __construct()
    {
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
     * Get the value of usuario_id
     */
    public function getUsuarioId() {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     */
    public function setUsuarioId($usuario_id): self {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad() {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     */
    public function setCiudad($ciudad): self {
        $this->ciudad = $this->db->real_escape_string($ciudad);
        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     */
    public function setDireccion($direccion): self {
        $this->direccion = $this->db->real_escape_string($direccion);
        return $this;
    }

    /**
     * Get the value of coste
     */
    public function getCoste() {
        return $this->coste;
    }

    /**
     * Set the value of coste
     */
    public function setCoste($coste): self {
        $this->coste = $coste;
        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado($estado): self {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self {
        $this->fecha = $fecha;
        return $this;
    }

    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }

    public function getOne(){
        $pedido = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $pedido->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste, u.nombre, u.apellidos, u.email, u.telefono FROM pedidos p "
        ."INNER JOIN usuarios u ON p.usuario_id = u.id "
        ."WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC LIMIT 1";
        
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
        ."WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC";
        
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductosByPedido($id){
        // $sql = "SELECT * FROM productos WHERE id IN "
        // ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id})";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                ."WHERE lp.pedido_id = {$id}";

        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuarioId()}, '{$this->getCiudad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE()) ";
        $save =$this->db->query($sql);

        $resul = false;
        if($save){
            $resul = true;
        }
        return $resul;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
 
            $save = $this->db->query($insert);
        } 

        $resul = false;
        if($save){
            $resul = true;
        }
        return $resul;
    }

    public function edit(){
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' ";
        $sql .= "WHERE id = {$this->getId()}";

        $save = $this->db->query($sql);

        $resul = false;
        if($save){
            $resul = true;
        }
        return $resul;
    }
}