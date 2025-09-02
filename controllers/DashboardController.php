<?php
class DashboardController {
    private $conn;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getEstadisticas() {
        $estadisticas = array();

        // Total de continentes
        $query = "SELECT COUNT(*) as total FROM continentes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $estadisticas['total_continentes'] = $row['total'];

        // Total de países
        $query = "SELECT COUNT(*) as total FROM paises";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $estadisticas['total_paises'] = $row['total'];

        // Total de tipos de energía
        $query = "SELECT COUNT(*) as total FROM tipos_energia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $estadisticas['total_tipos_energia'] = $row['total'];

        // Producción total de energía
        $query = "SELECT SUM(produccion_mwh) as total FROM produccion_energia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $estadisticas['produccion_total'] = $row['total'] ? $row['total'] : 0;

        return $estadisticas;
    }

    public function getProduccionPorContinente() {
        $query = "SELECT c.nombre_continente, SUM(p.produccion_mwh) as produccion_total
                  FROM produccion_energia p
                  JOIN paises pa ON p.id_pais = pa.id_pais
                  JOIN continentes c ON pa.id_continente = c.id_continente
                  GROUP BY c.id_continente
                  ORDER BY produccion_total DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTopPaisesProduccion() {
        $query = "SELECT pa.nombre_pais, SUM(p.produccion_mwh) as produccion_total
                  FROM produccion_energia p
                  JOIN paises pa ON p.id_pais = pa.id_pais
                  GROUP BY pa.id_pais
                  ORDER BY produccion_total DESC
                  LIMIT 10";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>