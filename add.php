<?php
// PASTIKAN TIDAK ADA SPASI ATAU BARIS KOSONG DI ATAS TAG PHP INI
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $productPrice = $_POST['product_price'] ?? '';
    $productStock = $_POST['product_stock'] ?? 0;

    if (empty($productName) || empty($productPrice)) {
        header("Location: add.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)");
        $stmt->execute([
            ':name' => $productName,
            ':price' => $productPrice,
            ':stock' => $productStock
        ]);

        // REFRESH-PROOF: Pengalihan murni tanpa echo script/alert agar konfirmasi tidak muncul 2 kali
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Error saat menyimpan data: " . $e->getMessage());
    }
}

// Bagian tampilan HTML diletakkan di bawah setelah semua logika redirect selesai
$page_title = "Tambah Produk - Simple ERP";
include 'header.php';
?>

<div class="container" style="max-width: 500px;">
    <h1 class="mb-4">Tambah Produk</h1>
    <div class="card p-4 shadow-sm">
        <form action="add.php" method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="product_price" name="product_price" required>
            </div>
            <div class="mb-3">
                <label for="product_stock" class="form-label">Stok Awal</label>
                <input type="number" class="form-control" id="product_stock" name="product_stock" value="0" min="0">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Simpan Produk</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>