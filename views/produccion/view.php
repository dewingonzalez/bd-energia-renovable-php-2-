<?php include '../views/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Detalles de Producción</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>País:</strong> <?php echo htmlspecialchars($produccion->nombre_pais); ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo de Energía:</strong> <?php echo htmlspecialchars($produccion->nombre_energia); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Período:</strong> <?php echo $produccion->anio . '/' . str_pad($produccion->mes, 2, '0', STR_PAD_LEFT); ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Capacidad Instalada:</strong> <?php echo number_format($produccion->capacidad_instalada_mw, 2); ?> MW
                    </div>
                    <div class="col-md-4">
                        <strong>Producción:</strong> <?php echo number_format($produccion->produccion_mwh, 2); ?> MWh
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>% Renovable:</strong> <?php echo number_format($produccion->porcentaje_renovable, 2); ?>%
                    </div>
                    <div class="col-md-4">
                        <strong>Reducción CO₂:</strong> <?php echo number_format($produccion->reduccion_co2, 2); ?> toneladas
                    </div>
                    <div class="col-md-4">
                        <strong>Inversión:</strong> $<?php echo number_format($produccion->inversion_anual, 2); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <strong>Empleos Generados:</strong> <?php