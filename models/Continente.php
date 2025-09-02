<?php
class Continente {
    private $conn;
    private $table_name = "continentes";

    public $id_continente;
    public $nombre_continente;
    public $codigo_continente;
    public $poblacion_aproximada;
    public $area_km2;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nombre_continente";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nombre_continente=:nombre_continente, codigo_continente=:codigo_continente, 
                     poblacion_aproximada=:poblacion_aproximada, area_km2=:area_km2";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_continente = htmlspecialchars(strip_tags($this->nombre_continente));
        $this->codigo_continente = htmlspecialchars(strip_tags($this->codigo_continente));
        
        $stmt->bindParam(":nombre_continente", $this->nombre_continente);
        $stmt->bindParam(":codigo_continente", $this->codigo_continente);
        $stmt->bindParam(":poblacion_aproximada", $this->poblacion_aproximada);
        $stmt->bindParam(":area_km2", $this->area_km2);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_continente = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_continente);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre_continente = $row['nombre_continente'];
            $this->codigo_continente = $row['codigo_continente'];
            $this->poblacion_aproximada = $row['poblacion_aproximada'];
            $this->area_km2 = $row['area_km2'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nombre_continente=:nombre_continente, codigo_continente=:codigo_continente, 
                     poblacion_aproximada=:poblacion_aproximada, area_km2=:area_km2 
                 WHERE id_continente=:id_continente";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_continente = htmlspecialchars(strip_tags($this->nombre_continente));
        $this->codigo_continente = htmlspecialchars(strip_tags($this->codigo_continente));
        
        $stmt->bindParam(":nombre_continente", $this->nombre_continente);
        $stmt->bindParam(":codigo_continente", $this->codigo_continente);
        $stmt->bindParam(":poblacion_aproximada", $this->poblacion_aproximada);
        $stmt->bindParam(":area_km2", $this->area_km2);
        $stmt->bindParam(":id_continente", $this->id_continente);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_continente = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_continente);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>