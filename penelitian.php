<?php
include 'config/database.php';

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $bidang_ilmu_id = $_POST['bidang_ilmu_id'];

    mysqli_query($conn, "INSERT INTO penelitian (judul, mulai, akhir, tahun_ajaran, bidang_ilmu_id)
                         VALUES ('$judul', '$mulai', '$akhir', '$tahun_ajaran', '$bidang_ilmu_id')");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM penelitian WHERE id=$id");
    header("Location: penelitian.php");
}

$data = mysqli_query($conn, "SELECT p.*, b.nama AS nama_bidang 
                             FROM penelitian p 
                             LEFT JOIN bidang_ilmu b ON p.bidang_ilmu_id = b.id");

$bidang_ilmu = mysqli_query($conn, "SELECT * FROM bidang_ilmu");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $bidang_ilmu_id = $_POST['bidang_ilmu_id'];
    $stmt = $conn->prepare("UPDATE penelitian SET judul=?, mulai=?, akhir=?, tahun_ajaran=?, bidang_ilmu_id=? WHERE id=?");
    $stmt->bind_param("sssssi", $judul, $mulai, $akhir, $tahun_ajaran, $bidang_ilmu_id, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: penelitian.php");
}

$edit_row = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT p.*, b.nama AS nama_bidang 
                            FROM penelitian p 
                            LEFT JOIN bidang_ilmu b ON p.bidang_ilmu_id = b.id 
                            WHERE p.id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main class="container-fluid p-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Data Penelitian</h4>
            </div>
            <div class="card-body">
                <form method="POST" class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Judul Penelitian</label>
                        <textarea class="form-control" name="judul" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="mulai" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="akhir" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" name="tahun_ajaran" placeholder="Contoh: 2023/2024" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bidang Ilmu</label>
                        <select class="form-select" name="bidang_ilmu_id" required>
                            <option value="">-- Pilih Bidang Ilmu --</option>
                            <?php while ($b = mysqli_fetch_assoc($bidang_ilmu)) { ?>
                                <option value="<?= $b['id'] ?>"><?= $b['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-success" name="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Daftar Penelitian</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th>Tahun Ajaran</th>
                            <th>Bidang Ilmu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['mulai']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['akhir']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['tahun_ajaran']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['nama_bidang']) ?></td>
                            <td class="text-center">
                                <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</a>
                                <a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header bg-secondary text-white">
                                            <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Data Penelitian</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row g-3">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <div class="col-md-12">
                                                <label class="form-label">Judul Penelitian</label>
                                                <textarea class="form-control" name="judul" required><?= htmlspecialchars($row['judul']) ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="mulai" value="<?= htmlspecialchars($row['mulai']) ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Selesai</label>
                                                <input type="date" class="form-control" name="akhir" value="<?= htmlspecialchars($row['akhir']) ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <input type="text" class="form-control" name="tahun_ajaran" value="<?= htmlspecialchars($row['tahun_ajaran']) ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Bidang Ilmu</label>
                                                <select class="form-select" name="bidang_ilmu_id" required>
                                                    <?php 
                                                    $bidang_ilmu = mysqli_query($conn, "SELECT * FROM bidang_ilmu");
                                                    while ($b = mysqli_fetch_assoc($bidang_ilmu)) { ?>
                                                        <option value="<?= $b['id'] ?>" <?= $row['bidang_ilmu_id'] == $b['id'] ? 'selected' : '' ?>><?= $b['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    </main>
</div>

<?php include 'layout/footer.php'; ?>
