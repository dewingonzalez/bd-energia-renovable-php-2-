<?php include 'views/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Continentes</h1>
    <a href="pais.php?action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Continente
    </a>
</div>

<?php
if(isset($_GET['message'])) {
    $messages = [
        'continente_created' => 'Continente creado exitosamente',
        'continente_updated' => 'Continente actualizado exitosamente',
        'continente_deleted' => 'Continente eliminado exitosamente',
        'continente_not_deleted' => 'Error al eliminar el continente'
    ];
    
    if(isset($messages[$_GET['message']])) {
        echo '<div class="alert alert-success">' . $messages[$_GET['message']] . '</div>';
    }
}
?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Población</th>
                        <th>Área (km²)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['id_pais']; ?></td>
                        <td><?php echo $row['nombre_pais']; ?></td>
                        <td><?php echo $row['codigo_pais']; ?></td>
                        <td><?php echo number_format($row['poblacion_pais']); ?></td>
                        <td><?php echo number_format($row['area_km2'], 2); ?></td>
                        <td>
                            <a href="pais.php?action=edit&id=<?php echo $row['id_pais']; ?>" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="pais.php?action=delete&id=<?php echo $row['id_pais']; ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('¿Está seguro de eliminar este continente?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>