<?php
// index.php
require_once "database.php";
require_once "products.php";
$db = new Database();
$produk = new Products($db->getConnection());
$data = $produk->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi Sekolah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>🏫 Koperasi Sekolah</h1>
        <p>Kelola data produk dan stok dengan mudah</p>
    </div>

    <div class="container">
        <div class="card">
            <div class="toolbar">
                <h2>Daftar Produk <span class="badge"><?= count($data) ?> item</span></h2>
                <a class="btn" href="addProducts.php">+ Tambah Produk</a>
            </div>

            <?php if (empty($data)): ?>
                <div class="empty">Belum ada produk. Klik "Tambah Produk" untuk memulai.</div>
            <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th class="num">Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $p):
                        $stok = (int) $p['quantityInStock'];
                        $kelas = $stok === 0 ? 'out' : ($stok <= 5 ? 'low' : '');
                    ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><strong><?= htmlspecialchars($p['productName']) ?></strong></td>
                            <td class="num">Rp <?= number_format($p['buyPrice'], 0, ',', '.') ?></td>
                            <td><span class="stock <?= $kelas ?>"><?= $stok ?></span></td>
                            <td class="actions">
                                <a class="btn btn-sm btn-edit" href="edit.php?id=<?= $p['id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-delete" href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>