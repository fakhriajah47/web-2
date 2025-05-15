<?php
include 'config/database.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    mysqli_query($conn, "INSERT INTO jenis_kegiatan (nama) VALUES ('$nama')");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jenis_kegiatan WHERE id=$id");
    header("Location: jenis_kegiatan.php");
}

$data = mysqli_query($conn, "SELECT * FROM jenis_kegiatan");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $stmt = $conn->prepare("UPDATE jenis_kegiatan SET nama=? WHERE id=?");
    $stmt->bind_param("si", $nama, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: jenis_kegiatan.php");
}

$edit_row = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM jenis_kegiatan WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main class="py-4">
        <div class="container-fluid px-4">
            <h2 class="mb-4">Data Jenis Kegiatan</h2>

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" class="row g-3 align-items-center">
                        <div class="col-md-10">
                            <input type="text" class="form-control form-control-lg" name="nama" placeholder="Nama Jenis Kegiatan" required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100 btn-lg" name="tambah">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td>
                                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</a>
                                        <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-3 shadow">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Jenis Kegiatan</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <div class="mb-3 text-start">
                                                        <label for="nama<?= $row['id'] ?>" class="form-label">Nama Jenis Kegiatan</label>
                                                        <input type="text" class="form-control" id="nama<?= $row['id'] ?>" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" name="update" class="btn btn-success me-2">Simpan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'layout/footer.php'; ?>
