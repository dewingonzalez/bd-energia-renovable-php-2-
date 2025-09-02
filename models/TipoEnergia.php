<?php
class TipoEnergia {
    private $conn;
    private $table_name = "tipos_energia";

    public $id_tipo_energia;
    public $nombre_energia;
    public $descripcion;
    public $capacidad_maxima_teorica;
    public $eficiencia_promedio;
    public $costo_instalacion_mw;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Leer todos los tipos de energía
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nombre_energia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear nuevo tipo de energía
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nombre_energia=:nombre_energia, descripcion=:descripcion, 
                     capacidad_maxima_teorica=:capacidad_maxima_teorica, 
                     eficiencia_promedio=:eficiencia_promedio, 
                     costo_instalacion_mw=:costo_instalacion_mw";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_energia = htmlspecialchars(strip_tags($this->nombre_energia));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        
        $stmt->bindParam(":nombre_energia", $this->nombre_energia);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":capacidad_maxima_teorica", $this->capacidad_maxima_teorica);
        $stmt->bindParam(":eficiencia_promedio", $this->eficiencia_promedio);
        $stmt->bindParam(":costo_instalacion_mw", $this->costo_instalacion_mw);
        
        return $stmt->execute();
    }

    // Leer un tipo de energía específico
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_tipo_energia = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_tipo_energia);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre_energia = $row['nombre_energia'];
            $this->descripcion = $row['descripcion'];
            $this->capacidad_maxima_teorica = $row['capacidad_maxima_teorica'];
            $this->eficiencia_promedio = $row['eficiencia_promedio'];
            $this->costo_instalacion_mw = $row['costo_instalacion_mw'];
            return true;
        }
        return false;
    }

    // Actualizar tipo de energía
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nombre_energia=:nombre_energia, descripcion=:descripcion, 
                     capacidad_maxima_teorica=:capacidad_maxima_teorica, 
                     eficiencia_promedio=:eficiencia_promedio, 
                     costo_instalacion_mw=:costo_instalacion_mw 
                 WHERE id_tipo_energia=:id_tipo_energia";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_energia = htmlspecialchars(strip_tags($this->nombre_energia));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        
        $stmt->bindParam(":nombre_energia", $this->nombre_energia);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":capacidad_maxima_teorica", $this->capacidad_maxima_teorica);
        $stmt->bindParam(":eficiencia_promedio", $this->eficiencia_promedio);
        $stmt->bindParam(":costo_instalacion_mw", $this->costo_instalacion_mw);
        $stmt->bindParam(":id_tipo_energia", $this->id_tipo_energia);
        
        return $stmt->execute();
    }

    // Eliminar tipo de energía
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_tipo_energia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_tipo_energia);
        return $stmt->execute();
    }

    // Buscar tipos de energía por nombre
    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE nombre_energia LIKE ? OR descripcion LIKE ? 
                  ORDER BY nombre_energia";
        
        $stmt = $this->conn->prepare($query);
        
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->execute();
        
        return $stmt;
    }
}
?>