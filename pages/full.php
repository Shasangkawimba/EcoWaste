<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EcoWaste System — Bank Sampah Digital (UI Prototype)</title>
  <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
  <style>
    body { padding-top: 70px; }
    .pointer { cursor: pointer; }
    .level-badge { font-weight:700 }
    .card-compact { padding: 1rem }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <a class="navbar-brand" href="#" data-route="home">EcoWaste</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMain">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navMain">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link pointer" data-route="home">Beranda</a></li>
      <li class="nav-item"><a class="nav-link pointer" data-route="warga">Dashboard Warga</a></li>
      <li class="nav-item"><a class="nav-link pointer" data-route="petugas">Dashboard Petugas</a></li>
      <li class="nav-item"><a class="nav-link pointer" data-route="leaderboard">Leaderboard</a></li>
      <li class="nav-item"><a class="nav-link pointer" data-route="katalog">Katalog Penukaran</a></li>
      <li class="nav-item"><a class="nav-link pointer" data-route="laporan">Laporan</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-light mr-2" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-light" type="button" data-toggle="modal" data-target="#registerModal">Register</button>
    </form>
  </div>
</nav>

<div class="container" id="app">
  <!-- HOME -->
  <section id="home" class="route">
    <div class="jumbotron bg-light">
      <h1 class="display-5">EcoWaste System</h1>
      <p class="lead">Sistem Bank Sampah Digital untuk mendukung gerakan green living di lingkungan Anda.</p>
      <hr class="my-4">
      <p>Fitur: pencatatan setoran, sistem poin & level, e-receipt, leaderboard, katalog penukaran, laporan, dan notifikasi.</p>
      <p class="lead">
        <a class="btn btn-success btn-lg" href="#" data-route="warga" role="button">Coba Dashboard Warga</a>
        <a class="btn btn-outline-success btn-lg" href="#" data-route="petugas" role="button">Coba Dashboard Petugas</a>
      </p>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card card-compact">
          <h5>♻ Sistem Poin & Level</h5>
          <p>Setoran dihitung jadi poin. Warga memiliki level: Pemula, Peduli, Eco Hero.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-compact">
          <h5>📱 Dashboard Interaktif</h5>
          <p>Warga melihat riwayat setoran; Petugas melihat transaksi harian dan laporan.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-compact">
          <h5>🌍 Leaderboard</h5>
          <p>Papan peringkat warga paling aktif tiap bulan (top 10).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- WARGA DASHBOARD -->
  <section id="warga" class="route" style="display:none">
    <div class="row mb-3">
      <div class="col-md-8">
        <h3>Dashboard Warga</h3>
        <p>Halo, <strong id="wargaName">Ibu Sari</strong> — Level: <span id="wargaLevel" class="badge badge-success level-badge">Pemula</span></p>
      </div>
      <div class="col-md-4 text-right">
        <h5>Saldo Poin: <span id="wargaPoints">120</span></h5>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Form Setor Sampah</h5>
            <form id="setorForm">
              <div class="form-group">
                <label>Jenis Sampah</label>
                <select class="form-control" id="jenisSampah">
                  <option value="plastik">Plastik</option>
                  <option value="kertas">Kertas</option>
                  <option value="kaleng">Kaleng</option>
                  <option value="organik">Organik</option>
                </select>
              </div>
              <div class="form-group">
                <label>Berat (kg)</label>
                <input type="number" step="0.1" class="form-control" id="berat" value="1">
              </div>
              <button type="button" class="btn btn-success" id="btnSetor">Setor & Dapatkan Poin</button>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Riwayat Setoran Terakhir</h5>
            <table class="table table-sm table-striped" id="riwayatTable">
              <thead><tr><th>Tgl</th><th>Jenis</th><th>Berat</th><th>Poin</th><th></th></tr></thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Katalog Penukaran Poin</h5>
            <div id="katalogCards" class="row"></div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">E-Receipt Terakhir</h5>
            <div id="lastReceipt">Belum ada transaksi</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PETUGAS DASHBOARD -->
  <section id="petugas" class="route" style="display:none">
    <div class="d-flex justify-content-between mb-3">
      <h3>Dashboard Petugas</h3>
      <div>
        <button class="btn btn-primary" id="refreshTrans">Refresh</button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <h5>Transaksi Hari Ini</h5>
            <table class="table table-sm table-hover" id="transTable">
              <thead><tr><th>#</th><th>Warga</th><th>Jenis</th><th>Berat</th><th>Poin</th><th>Tgl</th></tr></thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5>Laporan Ringkas</h5>
            <p>Total Berat Hari Ini: <strong id="totalBerat">0</strong> kg</p>
            <p>Transaksi Hari Ini: <strong id="countTrans">0</strong></p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body">
            <h5>Warga Paling Aktif</h5>
            <ol id="topWarga"></ol>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5>Quick Actions</h5>
            <button class="btn btn-success btn-block" id="fakeTrans">Tambah Transaksi Contoh</button>
            <button class="btn btn-outline-danger btn-block" id="clearData">Reset UI Data</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- LEADERBOARD -->
  <section id="leaderboard" class="route" style="display:none">
    <h3>Leaderboard Bulanan — Top 10 Warga</h3>
    <table class="table table-striped" id="leaderTable">
      <thead><tr><th>Rank</th><th>Nama</th><th>Poin Bulan Ini</th></tr></thead>
      <tbody></tbody>
    </table>
  </section>

  <!-- KATALOG -->
  <section id="katalog" class="route" style="display:none">
    <h3>Katalog Penukaran Poin</h3>
    <div class="row" id="katalogList"></div>
  </section>

  <!-- LAPORAN -->
  <section id="laporan" class="route" style="display:none">
    <h3>Laporan & Analitik</h3>
    <p>Contoh laporan otomatis (statistik sederhana) — hanya UI</p>
    <div class="row">
      <div class="col-md-4"><div class="card p-3">Total Berat Bulan Ini: <strong id="repTotalBerat">0</strong> kg</div></div>
      <div class="col-md-4"><div class="card p-3">Jenis Paling Banyak: <strong id="repTopJenis">-</strong></div></div>
      <div class="col-md-4"><div class="card p-3">Rata-rata Poin Warga: <strong id="repAvgPoints">0</strong></div></div>
    </div>
  </section>

</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white"><h5 class="modal-title">Login</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
      <div class="modal-body">
        <form id="loginForm">
          <div class="form-group"><label>Username</label><input class="form-control" id="loginUser"></div>
          <div class="form-group"><label>Password</label><input type="password" class="form-control" id="loginPass"></div>
          <button type="button" class="btn btn-success" id="doLogin">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white"><h5 class="modal-title">Register Akun Warga</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
      <div class="modal-body">
        <form id="regForm">
          <div class="form-group"><label>Nama</label><input class="form-control" id="regNama"></div>
          <div class="form-group"><label>Alamat</label><input class="form-control" id="regAlamat"></div>
          <button type="button" class="btn btn-success" id="doRegister">Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white"><h5 class="modal-title">E-Receipt</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
      <div class="modal-body" id="receiptBody">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="downloadReceipt">Download</button>
        <button class="btn btn-success" id="sendWA">Kirim via WhatsApp</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ----- SAMPLE IN-MEMORY DATA (UI-only) -----
let warga = { id:1, name: 'Ibu Sari', points: 120, totalPoints: 120 };
let transaksi = [];
let katalog = [
  {id:1, title:'Bibit Tanaman', points:200, stock:10},
  {id:2, title:'Sabun Eco', points:150, stock:20},
  {id:3, title:'Pulsa 10K', points:500, stock:5}
];

// routing
$('[data-route]').click(function(){
  const r = $(this).data('route');
  $('.route').hide(); $('#'+r).show();
});

// init
function renderKatalogCards(){
  $('#katalogCards').empty(); $('#katalogList').empty();
  katalog.forEach(k=>{
    const card = `<div class="col-md-6 mb-2"><div class="card p-2"><h6>${k.title}</h6><p>Poin: ${k.points} &middot; Stok: ${k.stock}</p><button class="btn btn-sm btn-outline-success" onclick="tryRedeem(${k.id})">Tukar</button></div></div>`;
    $('#katalogCards').append(card);
    const item = `<div class="col-md-4"><div class="card p-2"><h6>${k.title}</h6><p>${k.points} poin</p><button class="btn btn-sm btn-success" onclick="tryRedeem(${k.id})">Tukar</button></div></div>`;
    $('#katalogList').append(item);
  });
}

function renderRiwayat(){
  const tbody = $('#riwayatTable tbody'); tbody.empty();
  transaksi.slice().reverse().forEach((t,i)=>{
    tbody.append(`<tr><td>${t.tgl}</td><td>${t.jenis}</td><td>${t.berat} kg</td><td>${t.points}</td><td><button class='btn btn-sm btn-info' onclick='showReceipt(${t.id})'>Bukti</button></td></tr>`);
  });
  $('#wargaPoints').text(warga.points);
}

function calcPoints(jenis, berat){
  const rate = {plastik:5, kertas:3, kaleng:6, organik:1};
  return Math.round((rate[jenis]||1)*berat);
}

$('#btnSetor').click(function(){
  const jenis = $('#jenisSampah').val();
  const berat = parseFloat($('#berat').val())||0;
  if(berat<=0) { alert('Masukkan berat yang valid'); return; }
  const p = calcPoints(jenis, berat);
  const id = transaksi.length+1;
  const t = {id, wargaId: warga.id, nama: warga.name, jenis, berat, points:p, tgl: new Date().toLocaleString() };
  transaksi.push(t);
  warga.points += p; warga.totalPoints += p;
  renderRiwayat(); renderPetugas(); renderReports(); renderLeaderboard(); renderTopWarga();
  $('#lastReceipt').html(`<button class='btn btn-sm btn-outline-info' onclick='showReceipt(${id})'>Lihat E-Receipt</button>`);
});

function showReceipt(id){
  const t = transaksi.find(x=>x.id===id); if(!t) return;
  $('#receiptBody').html(`<p><strong>${t.nama}</strong></p><p>Jenis: ${t.jenis}</p><p>Berat: ${t.berat} kg</p><p>Poin: ${t.points}</p><p>Tanggal: ${t.tgl}</p>`);
  $('#receiptModal').modal('show');
}

function tryRedeem(kid){
  const k = katalog.find(x=>x.id===kid); if(!k) return;
  if(warga.points < k.points) { alert('Poin tidak cukup'); return; }
  if(!confirm(`Tukar ${k.title} dengan ${k.points} poin?`)) return;
  warga.points -= k.points; k.stock--; renderKatalogCards(); renderRiwayat(); renderReports(); alert('Penukaran dicatat (UI-only)');
}

// PETUGAS UI
function renderPetugas(){
  const tbody = $('#transTable tbody'); tbody.empty();
  transaksi.forEach((t,i)=>{
    tbody.append(`<tr><td>${t.id}</td><td>${t.nama}</td><td>${t.jenis}</td><td>${t.berat}</td><td>${t.points}</td><td>${t.tgl}</td></tr>`);
  });
  const total = transaksi.reduce((s,x)=>s+x.berat,0); $('#totalBerat').text(total); $('#countTrans').text(transaksi.length);
}

$('#fakeTrans').click(function(){
  const jenis = ['plastik','kertas','kaleng','organik'][Math.floor(Math.random()*4)];
  const berat = (Math.random()*2+0.2).toFixed(1);
  const p = calcPoints(jenis, parseFloat(berat));
  const id = transaksi.length+1;
  transaksi.push({id,wargaId:1,nama:'Random Warga',jenis,berat:parseFloat(berat),points:p,tgl:new Date().toLocaleString()});
  renderPetugas(); renderLeaderboard(); renderTopWarga(); renderReports();
});

$('#clearData').click(function(){ if(confirm('Reset semua data UI?')){ transaksi=[]; warga.points=0; renderRiwayat(); renderPetugas(); renderLeaderboard(); renderTopWarga(); renderReports(); renderKatalogCards(); } });

// Leaderboard
function renderLeaderboard(){
  const byWarga = {};
  transaksi.forEach(t=>{ byWarga[t.nama] = (byWarga[t.nama]||0) + t.points; });
  const arr = Object.keys(byWarga).map(n=>({nama:n, points:byWarga[n]})).sort((a,b)=>b.points-a.points);
  $('#leaderTable tbody').empty(); arr.slice(0,10).forEach((r,i)=>$('#leaderTable tbody').append(`<tr><td>${i+1}</td><td>${r.nama}</td><td>${r.points}</td></tr>`));
}

function renderTopWarga(){
  const byWarga = {};
  transaksi.forEach(t=>{ byWarga[t.nama] = (byWarga[t.nama]||0) + t.points; });
  const arr = Object.keys(byWarga).map(n=>({nama:n, points:byWarga[n]})).sort((a,b)=>b.points-a.points);
  $('#topWarga').empty(); arr.slice(0,5).forEach(r=>$('#topWarga').append(`<li>${r.nama} — ${r.points} pts</li>`));
}

// Reports simple
function renderReports(){
  const totalBerat = transaksi.reduce((s,x)=>s+x.berat,0); $('#repTotalBerat').text(totalBerat);
  const jenisCount = {}; transaksi.forEach(t=>jenisCount[t.jenis]=(jenisCount[t.jenis]||0)+t.berat);
  const topJenis = Object.keys(jenisCount).sort((a,b)=>jenisCount[b]-jenisCount[a])[0]||'-'; $('#repTopJenis').text(topJenis);
  const avgPoints = warga.totalPoints ? Math.round(warga.totalPoints / 1) : 0; $('#repAvgPoints').text(avgPoints);
}

// Init render
renderKatalogCards(); renderRiwayat(); renderPetugas(); renderLeaderboard(); renderTopWarga(); renderReports();

// Simple login/register handlers (UI-only)
$('#doRegister').click(function(){ const name = $('#regNama').val().trim(); if(!name){alert('Masukkan nama'); return;} warga.name = name; $('#wargaName').text(warga.name); $('#registerModal').modal('hide'); alert('Akun terdaftar (UI-only)'); });
$('#doLogin').click(function(){ $('#loginModal').modal('hide'); alert('Login sukses (UI-only)'); });

// download receipt (simple)
$('#downloadReceipt').click(function(){ const html = $('#receiptBody').html(); const blob = new Blob([html], {type:'text/html'}); const url = URL.createObjectURL(blob); const a = document.createElement('a'); a.href = url; a.download = 'receipt.html'; a.click(); URL.revokeObjectURL(url); });

</script>
</body>
</html>
