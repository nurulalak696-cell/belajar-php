<?php
include 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    echo "Koneksi berhasil";
} catch (PDOException $e){
    die("Koneksi gagal: " . $e->getMessage());
}
