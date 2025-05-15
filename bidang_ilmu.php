<?php
include 'config/database.php';
session_start();


if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stmt = $conn->prepare("INSERT INTO bidang_ilmu (nama, deskripsi) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $deskripsi);
    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Bidang ilmu berhasil ditambahkan!";
    } else {
        $_SESSION['pesan'] = "Gagal menambahkan data.";
    }
    $stmt->close();
    header("Location: bidang_ilmu.php");
    exit;
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM bidang_ilmu WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['pesan'] = "Bidang ilmu berhasil dihapus.";
    header("Location: bidang_ilmu.php");
    exit;
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stmt = $conn->prepare("UPDATE bidang_ilmu SET nama=?, deskripsi=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $deskripsi, $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['pesan'] = "Bidang ilmu berhasil diupdate.";
    header("Location: bidang_ilmu.php");
    exit;
}


$data = mysqli_query($conn, "SELECT * FROM bidang_ilmu");
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container py-4">
    <h2 class="mb-4">Manajemen Bidang Ilmu</h2>


    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= $_SESSION['pesan']; unset($_SESSION['pesan']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Tambah Bidang Ilmu</div>
        <div class="card-body">
            <form method="POST" novalidate>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bidang Ilmu</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" rows="2"></textarea>
                </div>
                <button name="tambah" class="btn btn-success">Tambah</button>
            </form>
        </div>
    </div>

 
    <div class="card">
        <div class="card-header bg-secondary text-white">Daftar Bidang Ilmu</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                                <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                       
                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Bidang Ilmu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <div class="mb-3">
                                                <label for="nama<?= $row['id'] ?>" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" id="nama<?= $row['id'] ?>" value="<?= htmlspecialchars($row['nama']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi<?= $row['id'] ?>" class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" id="deskripsi<?= $row['id'] ?>" rows="3"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button name="update" type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
