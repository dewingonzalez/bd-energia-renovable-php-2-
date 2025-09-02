<?php
// Incluir configuración y modelos
include_once 'config/database.php';
include_once 'models/Continente.php';
include_once 'models/Pais.php';
include_once 'models/TipoEnergia.php';
include_once 'controllers/DashboardController.php';

// Inicializar base de datos
$database = new Database();
$db = $database->getConnection();

// Obtener estadísticas del dashboard
$dashboardController = new DashboardController();
$estadisticas = $dashboardController->getEstadisticas();
$produccionContinente = $dashboardController->getProduccionPorContinente();
$topPaises = $dashboardController->getTopPaisesProduccion();

// Mostrar vista del dashboard
include 'views/dashboard.php';
?>