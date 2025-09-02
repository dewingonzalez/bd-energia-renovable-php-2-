<?php
include_once 'config/database.php';
include_once 'models/Pais.php';

$database = new Database();
$db = $database->getConnection();
$pais = new Pais($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'create':
        if($_POST){
            $paises->nombre_paises = $_POST['nombre_pais'];
            $paises->codigo_paises = $_POST['codigo_pais'];
            $paises->poblacion_aproximada = $_POST['poblacion'];
            $paises->area_km2 = $_POST['area_km2'];
            
            if($paises->create()){
                header("Location: paises$paisess.php?message=paises$paises_created");
            } else{
                echo "<div class='alert alert-danger'>No se pudo crear el paises$paises.</div>";
            }
        }
        include 'views/paises$paisess/create.php';
        break;
        
    case 'edit':
        $paises->id_paises = $_GET['id'];
        $paises->readOne();
        
        if($_POST){
            $paises->nombre_paises = $_POST['nombre_paises'];
            $paises->codigo_paises = $_POST['codigo_paises$paises'];
            $paises->poblacion_aproximada = $_POST['poblacion'];
            $paises->area_km2 = $_POST['area_km2'];
            
            if($paises->update()){
                header("Location: paises$paisess.php?message=paises$paises_updated");
            } else{
                echo "<div class='alert alert-danger'>No se pudo actualizar el paises$paises.</div>";
            }
        }
        include 'views/paises$paisess/edit.php';
        break;
        
    case 'delete':
        $paises->id_paises = $_GET['id'];
        if($paises->delete()){
            header("Location: paises$paisess.php?message=paises$paises_deleted");
        } else{
            header("Location: paises$paisess.php?message=paises$paises_not_deleted");
        }
        break;
        
    default:
        $stmt = $Paises->read();
        include 'views/paises/list.php';
        break;
}
?>