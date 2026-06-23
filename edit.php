<?php
require_once 'config.php';

$id = $_GET['id'] ?? '';
$product = [];

if (!empty($id)) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch();
    
    if (!$product) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $productPrice = $_POST['product_price'] ?? '';
    $productStock = $_POST['product_stock'] ?? 0;

    if (empty($productName) || empty($productPrice)) {
        echo "<script>alert('Please fill in all fields'); window.location.href='edit.php?id=$id';</script>";
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id");
        $stmt->execute([
            ':name'  => $productName,
            ':price' => $productPrice,
            ':stock' => $productStock,
            ':id'    => $id
        ]);

        echo "<script>alert('Product updated successfully!'); window.location.href='index.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='edit.php?id=$id';</script>";
        exit;
    }
}

$page_title = "Edit Produk - Simple ERP";
include 'header.php';
?>

<div class="container" style="max-width: 500px;">
    <h1 class="mb-4">Edit Produk</h1>
    <div class="card p-4 shadow-sm">
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_stock" class="form-label">Jumlah Stok</label>
                <input type="number" class="form-control" id="product_stock" name="product_stock" value="<?php echo htmlspecialchars($product['stock'] ?? 0); ?>" min="0">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>