<?php
include 'config.php';

$products = [];
$error = '';

try {
    // DIUBAH DI SINI: Menggunakan ASC agar data baru ditambahkan ke baris paling bawah
    $query = "SELECT * FROM products ORDER BY id ASC";
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Gagal mengambil data: " . $e->getMessage();
}

$page_title = "Katalog Produk - Simple ERP";
include 'header.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products List</h1>
        <a href="add.php" class="btn btn-primary">Tambah Produk Baru</a>
    </div>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
        <div class="card shadow-sm">
            <table class="table table-striped table-bordered table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 70px;" class="text-center">Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th class="text-center" style="width: 150px;">Stock Control</th>
                        <th class="text-center" style="width: 180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr><td colspan="5" class="text-center py-3 text-muted">Belum ada data produk.</td></tr>
                    <?php else: ?>
                        <?php 
                        $no = 1; 
                        foreach ($products as $product): 
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($product['name'] ?? ''); ?></td>
                                <td>Rp <?php echo htmlspecialchars(number_format($product['price'] ?? 0, 0, ',', '.')); ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="stock.php?action=out&id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-danger fw-bold">-</a>
                                        <span class="fw-bold"><?php echo htmlspecialchars($product['stock'] ?? 0); ?></span>
                                        <a href="stock.php?action=in&id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-success fw-bold">+</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?php echo htmlspecialchars($product['id'] ?? ''); ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete.php?id=<?php echo htmlspecialchars($product['id'] ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>