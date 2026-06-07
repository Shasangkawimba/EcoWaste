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

<div class="page-container">

    <div class="header-section">
        <h2>Laporan EcoWaste</h2>
        <p class="subtitle">Ringkasan aktivitas pengelolaan sampah dan poin warga</p>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <h4>Total Berat Sampah</h4>
            <p class="stat-value"><?= number_format($total_berat, 2) ?> kg</p>
        </div>

        <div class="stat-card">
            <h4>Total Poin Warga</h4>
            <p class="stat-value"><?= number_format($total_poin) ?> poin</p>
        </div>

        <div class="stat-card">
            <h4>Rata Rata Poin</h4>
            <p class="stat-value"><?= number_format($avg_poin, 2) ?> poin</p>
        </div>

        <div class="stat-card">
            <h4>Sampah Terbanyak</h4>
            <p class="stat-value">
                <?= $sampah_terbanyak ? $sampah_terbanyak['nama_sampah'] : 'Tidak ada data' ?>
            </p>
        </div>

    </div>

    <hr>

    <div class="chart-section">
        <h3>Grafik Berat Sampah per Tanggal Setor</h3>
        <canvas id="chartBerat"></canvas>
    </div>

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
            borderWidth: 2,
            tension: 0.3
        }]
    }
});
</script>

<style>
.page-container {
    padding: 20px;
}
.header-section h2 {
    font-weight: 700;
    color: #1B6B3A;
}
.subtitle {
    font-size: 14px;
    opacity: .7;
    margin-top: -5px;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin: 25px 0;
}
.stat-card {
    background: white;
    padding: 18px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-left: 6px solid #1B6B3A;
}
.stat-value {
    font-size: 22px;
    font-weight: 600;
    margin-top: 6px;
}
.chart-section {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
</style>
