<?php
class Pais {
    private $conn;
    private $table_name = "paises";

    public $id_pais;
    public $id_continente;
    public $nombre_pais;
    public $codigo_pais;
    public $poblacion;
    public $area_km2;
    public $pib_anual;
    public $emisiones_co2;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT p.*, c.nombre_continente 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN continentes c ON p.id_continente = c.id_continente 
                  ORDER BY p.nombre_pais";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET id_continente=:id_continente, nombre_pais=:nombre_pais, codigo_pais=:codigo_pais, 
                     poblacion=:poblacion, area_km2=:area_km2, pib_anual=:pib_anual, emisiones_co2=:emisiones_co2";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_pais = htmlspecialchars(strip_tags($this->nombre_pais));
        $this->codigo_pais = htmlspecialchars(strip_tags($this->codigo_pais));
        
        $stmt->bindParam(":id_continente", $this->id_continente);
        $stmt->bindParam(":nombre_pais", $this->nombre_pais);
        $stmt->bindParam(":codigo_pais", $this->codigo_pais);
        $stmt->bindParam(":poblacion", $this->poblacion);
        $stmt->bindParam(":area_km2", $this->area_km2);
        $stmt->bindParam(":pib_anual", $this->pib_anual);
        $stmt->bindParam(":emisiones_co2", $this->emisiones_co2);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pais = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pais);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->id_continente = $row['id_continente'];
            $this->nombre_pais = $row['nombre_pais'];
            $this->codigo_pais = $row['codigo_pais'];
            $this->poblacion = $row['poblacion'];
            $this->area_km2 = $row['area_km2'];
            $this->pib_anual = $row['pib_anual'];
            $this->emisiones_co2 = $row['emisiones_co2'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET id_continente=:id_continente, nombre_pais=:nombre_pais, codigo_pais=:codigo_pais, 
                     poblacion=:poblacion, area_km2=:area_km2, pib_anual=:pib_anual, emisiones_co2=:emisiones_co2 
                 WHERE id_pais=:id_pais";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre_pais = htmlspecialchars(strip_tags($this->nombre_pais));
        $this->codigo_pais = htmlspecialchars(strip_tags($this->codigo_pais));
        
        $stmt->bindParam(":id_continente", $this->id_continente);
        $stmt->bindParam(":nombre_pais", $this->nombre_pais);
        $stmt->bindParam(":codigo_pais", $this->codigo_pais);
        $stmt->bindParam(":poblacion", $this->poblacion);
        $stmt->bindParam(":area_km2", $this->area_km2);
        $stmt->bindParam(":pib_anual", $this->pib_anual);
        $stmt->bindParam(":emisiones_co2", $this->emisiones_co2);
        $stmt->bindParam(":id_pais", $this->id_pais);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pais = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pais);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getByContinente($id_continente) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_continente = ? ORDER BY nombre_pais";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_continente);
        $stmt->execute();
        return $stmt;
    }
}
?>