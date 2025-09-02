<?php include '../views/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h2>Editar Registro de Producción</h2>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="Produccion.php?action=edit&id=<?php echo $produccion->id_produccion; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>País *</label>
                                <select name="id_pais" class="form-control" required>
                                    <option value="">Seleccionar país</option>
                                    <?php 
                                    $paises->execute();
                                    while ($pais = $paises->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = ($pais['id_pais'] == $produccion->id_pais) ? 'selected' : '';
                                        echo "<option value='{$pais['id_pais']}' $selected>{$pais['nombre_pais']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Energía *</label>
                                <select name="id_tipo_energia" class="form-control" required>
                                    <option value="">Seleccionar tipo</option>
                                    <?php 
                                    $tipos_energia->execute();
                                    while ($tipo = $tipos_energia->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = ($tipo['id_tipo_energia'] == $produccion->id_tipo_energia) ? 'selected' : '';
                                        echo "<option value='{$tipo['id_tipo_energia']}' $selected>{$tipo['nombre_energia']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Año *</label>
                                <input type="number" name="anio" class="form-control" required 
                                       min="2000" max="2030" value="<?php echo $produccion->anio; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mes *</label>
                                <select name="mes" class="form-control" required>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($i == $produccion->mes) ? 'selected' : ''; ?>>
                                            <?php echo DateTime::createFromFormat('!m', $i)->format('F'); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Capacidad Instalada (MW) *</label>
                                <input type="number" name="capacidad_instalada_mw" class="form-control" 
                                       step="0.01" min="0" required value="<?php echo $produccion->capacidad_instalada_mw; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Producción (MWh) *</label>
                                <input type="number" name="produccion_mwh" class="form-control" 
                                       step="0.01" min="0" required value="<?php echo $produccion->produccion_mwh; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>% Renovable *</label>
                                <input type="number" name="porcentaje_renovable" class="form-control" 
                                       step="0.01" min="0" max="100" required value="<?php echo $produccion->porcentaje_renovable; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Reducción CO₂ (toneladas)</label>
                                <input type="number" name="reduccion_co2" class="form-control" 
                                       step="0.01" min="0" value="<?php echo $produccion->reduccion_co2; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Inversión Anual ($)</label>
                                <input type="number" name="inversion_anual" class="form-control" 
                                       step="0.01" min="0" value="<?php echo $produccion->inversion_anual; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Empleos Generados</label>
                                <input type="number" name="empleos_generados" class="form-control" 
                                       min="0" value="<?php echo $produccion->empleos_generados; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <a href="Produccion.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../views/footer.php'; ?>