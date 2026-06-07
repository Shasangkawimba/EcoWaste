<?php 
require '../koneksi.php';
require '../../layout/layout.php';

// Total berat sampah terkumpul
$q_total_berat = mysqli_query($conn, "
    SELECT SUM(berat) AS total_berat
    FROM transaksi_detail
");
$total_berat = mysqli_fetch_assoc($q_total_berat)['total_berat'] ?? 0;

// Total poin warga
$q_total_poin = mysqli_query($conn, "
    SELECT SUM(total_poin) AS total_poin
    FROM poin
");
$total_poin = mysqli_fetch_assoc($q_total_poin)['total_poin'] ?? 0;

// Rata rata poin warga
$q_avg_poin = mysqli_query($conn, "
    SELECT AVG(total_poin) AS avg_poin
    FROM poin
");
$avg_poin = mysqli_fetch_assoc($q_avg_poin)['avg_poin'] ?? 0;

// Jenis sampah paling banyak disetor
$q_sampah_terbanyak = mysqli_query($conn, "
    SELECT s.nama_sampah, SUM(d.berat) AS total
    FROM transaksi_detail d
    JOIN sampah s ON d.id_sampah = s.id_sampah
    GROUP BY s.id_sampah
    ORDER BY total DESC
    LIMIT 1
");
$sampah_terbanyak = mysqli_fetch_assoc($q_sampah_terbanyak);

?>

<h2 class="fw-bold mb-2">Laporan EcoWaste</h2>
<p class="text-muted mb-4">Ringkasan aktivitas pengelolaan sampah dan poin warga</p>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card-custom text-center mb-0 h-100">
            <h5 class="fw-bold mb-2">Total Berat Sampah</h5>
            <p class="h3 text-success mb-0"><?= number_format($total_berat, 2) ?> kg</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center mb-0 h-100">
            <h5 class="fw-bold mb-2">Total Poin Warga</h5>
            <p class="h3 text-primary mb-0"><?= number_format($total_poin) ?> poin</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center mb-0 h-100">
            <h5 class="fw-bold mb-2">Rata Rata Poin</h5>
            <p class="h3 text-success mb-0"><?= number_format($avg_poin, 0) ?> poin</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center mb-0 h-100">
            <h5 class="fw-bold mb-2">Sampah Terbanyak</h5>
            <p class="h3 text-warning mb-0">
                <?= $sampah_terbanyak ? htmlspecialchars($sampah_terbanyak['nama_sampah']) : 'Tidak ada data' ?>
            </p>
        </div>
    </div>
</div>

<div class="card-custom">
    <h3 class="mb-4">Grafik Berat Sampah per Tanggal Setor</h3>
    <canvas id="chartBerat" style="max-height: 400px;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
$q_chart = mysqli_query($conn, "
    SELECT DATE(t.tgl_transaksi) AS tanggal, SUM(d.berat) AS total
    FROM transaksi_setor t
    JOIN transaksi_detail d ON t.id_transaksi = d.id_transaksi
    GROUP BY DATE(t.tgl_transaksi)
    ORDER BY tanggal ASC
");

$labels = [];
$values = [];
while ($row = mysqli_fetch_assoc($q_chart)) {
    $labels[] = $row['tanggal'];
    $values[] = $row['total'];
}
?>

<script>
const ctx = document.getElementById('chartBerat').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Kg Sampah',
            data: <?= json_encode($values) ?>,
            borderColor: '#2d8c3a',
            backgroundColor: 'rgba(215, 235, 128, 0.15)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#333333',
            pointBorderColor: '#d7eb80',
            pointHoverBackgroundColor: '#d7eb80',
            pointHoverBorderColor: '#333333',
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    font: {
                        family: "'Inter', sans-serif",
                        size: 13,
                        weight: 500
                    },
                    color: '#333333'
                }
            },
            tooltip: {
                backgroundColor: '#333333',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                bodyFont: {
                    family: "'Inter', sans-serif"
                },
                titleFont: {
                    family: "'Inter', sans-serif",
                    weight: 'bold'
                }
            }
        },
        scales: {
            x: {
                grid: {
                    color: '#f0f0eb'
                },
                ticks: {
                    font: {
                        family: "'Inter', sans-serif"
                    },
                    color: '#333333'
                }
            },
            y: {
                grid: {
                    color: '#f0f0eb'
                },
                ticks: {
                    font: {
                        family: "'Inter', sans-serif"
                    },
                    color: '#333333'
                }
            }
        }
    }
});
</script>
<?php include __DIR__ . '/../../layout/footer.php'; ?>
