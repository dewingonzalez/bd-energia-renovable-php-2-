<?php
include_once 'config/database.php';
include_once 'models/Continente.php';

$database = new Database();
$db = $database->getConnection();
$continente = new Continente($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'create':
        if($_POST){
            $continente->nombre_continente = $_POST['nombre_continente'];
            $continente->codigo_continente = $_POST['codigo_continente'];
            $continente->poblacion_aproximada = $_POST['poblacion_aproximada'];
            $continente->area_km2 = $_POST['area_km2'];
            
            if($continente->create()){
                header("Location: continentes.php?message=continente_created");
            } else{
                echo "<div class='alert alert-danger'>No se pudo crear el continente.</div>";
            }
        }
        include 'views/continentes/create.php';
        break;
        
    case 'edit':
        $continente->id_continente = $_GET['id'];
        $continente->readOne();
        
        if($_POST){
            $continente->nombre_continente = $_POST['nombre_continente'];
            $continente->codigo_continente = $_POST['codigo_continente'];
            $continente->poblacion_aproximada = $_POST['poblacion_aproximada'];
            $continente->area_km2 = $_POST['area_km2'];
            
            if($continente->update()){
                header("Location: continentes.php?message=continente_updated");
            } else{
                echo "<div class='alert alert-danger'>No se pudo actualizar el continente.</div>";
            }
        }
        include 'views/continentes/edit.php';
        break;
        
    case 'delete':
        $continente->id_continente = $_GET['id'];
        if($continente->delete()){
            header("Location: continentes.php?message=continente_deleted");
        } else{
            header("Location: continentes.php?message=continente_not_deleted");
        }
        break;
        
    default:
        $stmt = $continente->read();
        include 'views/continentes/list.php';
        break;
}
?>