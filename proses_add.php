<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (proses insert database kamu di sini) ...
} else {
    // SANGAT BERGUNA DI SINI: Jika diakses langsung tanpa form, tendang balik ke form!
    header('Location: add.php');
    exit;
}