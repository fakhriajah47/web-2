<?php
include 'config/database.php';

if (isset($_POST['tambah'])) {
    $penelitian_id = $_POST['penelitian_id'];
    $dosen_id = $_POST['dosen_id'];
    $peran = $_POST['peran'];
    mysqli_query($conn, "INSERT INTO tim_penelitian (penelitian_id, dosen_id, peran) VALUES ('$penelitian_id', '$dosen_id', '$peran')");
}

if (isset($_GET['hapus'])) {
    $penelitian_id = $_GET['penelitian_id'];
    $dosen_id = $_GET['dosen_id'];
    mysqli_query($conn, "DELETE FROM tim_penelitian WHERE penelitian_id=$penelitian_id AND dosen_id=$dosen_id");
    header("Location: tim_penelitian.php");
}

$data = mysqli_query($conn, "SELECT tp.*, d.nama AS nama_dosen, p.judul AS judul_penelitian
                             FROM tim_penelitian tp
                             LEFT JOIN dosen d ON tp.dosen_id = d.id
                             LEFT JOIN penelitian p ON tp.penelitian_id = p.id");

$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$penelitian = mysqli_query($conn, "SELECT * FROM penelitian");

if (isset($_POST['update'])) {
    $old_penelitian_id = $_POST['old_penelitian_id'];
    $old_dosen_id = $_POST['old_dosen_id'];
    $penelitian_id = $_POST['penelitian_id'];
    $dosen_id = $_POST['dosen_id'];
    $peran = $_POST['peran'];
    $stmt = $conn->prepare("UPDATE tim_penelitian SET penelitian_id=?, dosen_id=?, peran=? WHERE penelitian_id=? AND dosen_id=?");
    $stmt->bind_param("iissi", $penelitian_id, $dosen_id, $peran, $old_penelitian_id, $old_dosen_id);
    $stmt->execute();
    $stmt->close();
    header("Location: tim_penelitian.php");
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Data Tim Penelitian</h2>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Judul Penelitian</label>
                        <select name="penelitian_id" class="form-select" required>
                            <option value="">-- Pilih Judul --</option>
                            <?php while ($p = mysqli_fetch_assoc($penelitian)) { ?>
                                <option value="<?= $p['id'] ?>"><?= $p['judul'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nama Dosen</label>
                        <select name="dosen_id" class="form-select" required>
                            <option value="">-- Pilih Dosen --</option>
                            <?php while ($d = mysqli_fetch_assoc($dosen)) { ?>
                                <option value="<?= $d['id'] ?>"><?= $d['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Peran</label>
                        <input type="text" name="peran" class="form-control" placeholder="Contoh: Ketua, Anggota" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Judul Penelitian</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $result = mysqli_query($conn, "SELECT tp.*, d.nama AS nama_dosen, p.judul AS judul_penelitian FROM tim_penelitian tp LEFT JOIN dosen d ON tp.dosen_id = d.id LEFT JOIN penelitian p ON tp.penelitian_id = p.id");
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                                    <td><?= htmlspecialchars($row['judul_penelitian']) ?></td>
                                    <td><?= htmlspecialchars($row['peran']) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['penelitian_id'] . '_' . $row['dosen_id'] ?>">Edit</button>
                                        <a href="?hapus=1&penelitian_id=<?= $row['penelitian_id'] ?>&dosen_id=<?= $row['dosen_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal<?= $row['penelitian_id'] . '_' . $row['dosen_id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content shadow">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tim Penelitian</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <input type="hidden" name="old_penelitian_id" value="<?= $row['penelitian_id'] ?>">
                                                    <input type="hidden" name="old_dosen_id" value="<?= $row['dosen_id'] ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Judul Penelitian</label>
                                                        <select name="penelitian_id" class="form-select">
                                                            <?php 
                                                            $penelitian2 = mysqli_query($conn, "SELECT * FROM penelitian");
                                                            while ($p2 = mysqli_fetch_assoc($penelitian2)) { ?>
                                                                <option value="<?= $p2['id'] ?>" <?= $row['penelitian_id'] == $p2['id'] ? 'selected' : '' ?>>
                                                                    <?= $p2['judul'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Dosen</label>
                                                        <select name="dosen_id" class="form-select">
                                                            <?php 
                                                            $dosen2 = mysqli_query($conn, "SELECT * FROM dosen");
                                                            while ($d2 = mysqli_fetch_assoc($dosen2)) { ?>
                                                                <option value="<?= $d2['id'] ?>" <?= $row['dosen_id'] == $d2['id'] ? 'selected' : '' ?>>
                                                                    <?= $d2['nama'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Peran</label>
                                                        <input type="text" class="form-control" name="peran" value="<?= htmlspecialchars($row['peran']) ?>">
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'layout/footer.php'; ?>
