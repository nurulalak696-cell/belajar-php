<?php
require_once 'config.php';

$id     = $_GET['id'] ?? '';
$action = $_GET['action'] ?? '';

if (!empty($id) && !empty($action)) {
    try {
        if ($action === 'in') {
            $stmt = $pdo->prepare("UPDATE products SET stock = stock + 1 WHERE id = :id");
        } elseif ($action === 'out') {
            $check = $pdo->prepare("SELECT stock FROM products WHERE id = :id");
            $check->execute([':id' => $id]);
            $current = $check->fetch();
            
            if (($current['stock'] ?? 0) > 0) {
                $stmt = $pdo->prepare("UPDATE products SET stock = stock - 1 WHERE id = :id");
            } else {
                echo "<script>alert('Gagal! Stok minimum sudah mencapai 0 item.'); window.location.href='index.php';</script>";
                exit;
            }
        }
        
        if (isset($stmt)) {
            $stmt->execute([':id' => $id]);
        }
        
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>