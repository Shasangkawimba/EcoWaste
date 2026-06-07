<?php
// Load .env file jika ada (untuk development lokal)
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv("{$name}={$value}");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Konfigurasi database - prioritas Environment Variables
$host     = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname   = getenv('DB_NAME');
$port     = getenv('DB_PORT');
$ssl_mode = getenv('DB_SSL_MODE');

$conn = mysqli_init();
if (!$conn) {
    die("mysqli_init gagal");
}

if ($ssl_mode === "REQUIRED") {
    // Path ke sertifikat CA
    $ca_cert = __DIR__ . '/../certs/ca.pem';
    mysqli_ssl_set($conn, NULL, NULL, $ca_cert, NULL, NULL);
    
    // Koneksi dengan SSL
    if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
        die("Koneksi database gagal (SSL): " . mysqli_connect_error());
    }
} else {
    // Koneksi standar (tanpa SSL)
    if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, $port)) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
}
?>
