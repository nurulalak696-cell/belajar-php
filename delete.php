<?php
require_once 'config.php';

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        echo "<script>alert('Product deleted successfully!'); window.location.href='index.php';</script>";
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