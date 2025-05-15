<?php
include 'config/database.php';

// Tambah data kegiatan
if (isset($_POST['tambah'])) {
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_kegiatan_id = $_POST['jenis_kegiatan_id'];
    $stmt = $conn->prepare("INSERT INTO kegiatan (tanggal_mulai, tanggal_selesai, tempat, deskripsi, jenis_kegiatan_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $tanggal_mulai, $tanggal_selesai, $tempat, $deskripsi, $jenis_kegiatan_id);
    $stmt->execute();
    $stmt->close();
    header("Location: kegiatan.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id=$id");
    header("Location: kegiatan.php");
}

$data = mysqli_query($conn, "SELECT kegiatan.*, jenis_kegiatan.nama AS jenis_nama FROM kegiatan LEFT JOIN jenis_kegiatan ON kegiatan.jenis_kegiatan_id = jenis_kegiatan.id");
$jenis = mysqli_query($conn, "SELECT * FROM jenis_kegiatan");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_kegiatan_id = $_POST['jenis_kegiatan_id'];
    $stmt = $conn->prepare("UPDATE kegiatan SET tanggal_mulai=?, tanggal_selesai=?, tempat=?, deskripsi=?, jenis_kegiatan_id=? WHERE id=?");
    $stmt->bind_param("sssssi", $tanggal_mulai, $tanggal_selesai, $tempat, $deskripsi, $jenis_kegiatan_id, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: kegiatan.php");
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="mb-4 text-primary fw-bold">Manajemen Data Kegiatan</h2>

        <button class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="bi bi-plus-circle"></i> Tambah Kegiatan
        </button>

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow-sm">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Data Kegiatan</h5>
                        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" class="p-3">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat</label>
                            <input type="text" name="tempat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kegiatan</label>
                            <select name="jenis_kegiatan_id" class="form-select" required>
                                <option value="">Pilih Jenis Kegiatan</option>
                                <?php while ($j = mysqli_fetch_assoc($jenis)) { ?>
                                    <option value="<?= $j['id'] ?>"><?= $j['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered align-middle rounded shadow-sm overflow-hidden">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Tempat</th>
                        <th>Deskripsi</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_selesai']) ?></td>
                        <td><?= htmlspecialchars($row['tempat']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_nama']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title">Edit Kegiatan</h5>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" class="p-3">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" value="<?= $row['tanggal_mulai'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control" value="<?= $row['tanggal_selesai'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tempat</label>
                                        <input type="text" name="tempat" class="form-control" value="<?= $row['tempat'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required><?= $row['deskripsi'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kegiatan</label>
                                        <select name="jenis_kegiatan_id" class="form-select" required>
                                            <?php 
                                            $jenis_edit = mysqli_query($conn, "SELECT * FROM jenis_kegiatan");
                                            while ($j = mysqli_fetch_assoc($jenis_edit)) { ?>
                                                <option value="<?= $j['id'] ?>" <?= $row['jenis_kegiatan_id'] == $j['id'] ? 'selected' : '' ?>>
                                                    <?= $j['nama'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="update" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
