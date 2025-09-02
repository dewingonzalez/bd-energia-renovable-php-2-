<?php include 'views/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Dashboard - Energía Renovable</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Continentes</h5>
                <h2 class="card-text"><?php echo $estadisticas['total_continentes']; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Países</h5>
                <h2 class="card-text"><?php echo $estadisticas['total_paises']; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Tipos de Energía</h5>
                <h2 class="card-text"><?php echo $estadisticas['total_tipos_energia']; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Producción Total (MWh)</h5>
                <h2 class="card-text"><?php echo number_format($estadisticas['produccion_total'], 0); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Producción por Continente</h5>
            </div>
            <div class="card-body">
                <canvas id="produccionContinenteChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Top 10 Países por Producción</h5>
            </div>
            <div class="card-body">
                <canvas id="topPaisesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Gráfico de Producción por Continente
const ctx1 = document.getElementById('produccionContinenteChart').getContext('2d');
const produccionContinenteChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: [<?php 
            $produccionContinente->execute();
            while ($row = $produccionContinente->fetch(PDO::FETCH_ASSOC)) {
                echo "'" . $row['nombre_continente'] . "',";
            }
        ?>],
        datasets: [{
            data: [<?php 
                $produccionContinente->execute();
                while ($row = $produccionContinente->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['produccion_total'] . ",";
                }
            ?>],
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Gráfico de Top Países
const ctx2 = document.getElementById('topPaisesChart').getContext('2d');
const topPaisesChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [<?php 
            $topPaises->execute();
            while ($row = $topPaises->fetch(PDO::FETCH_ASSOC)) {
                echo "'" . $row['nombre_pais'] . "',";
            }
        ?>],
        datasets: [{
            label: 'Producción (MWh)',
            data: [<?php 
                $topPaises->execute();
                while ($row = $topPaises->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['produccion_total'] . ",";
                }
            ?>],
            backgroundColor: '#28a745'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<?php include 'views/footer.php'; ?>