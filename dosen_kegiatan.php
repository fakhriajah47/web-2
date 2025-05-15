<?php
include 'config/database.php';

function shorten_text($text, $max_length = 30) {
    return (strlen($text) > $max_length) ? substr($text, 0, $max_length) . '...' : $text;
}

if (isset($_POST['tambah'])) {
    $dosen_id = $_POST['dosen_id'];
    $kegiatan_id = $_POST['kegiatan_id'];
    $stmt = $conn->prepare("INSERT INTO dosen_kegiatan (dosen_id, kegiatan_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $dosen_id, $kegiatan_id);
    $stmt->execute();
    $stmt->close();
    header("Location: dosen_kegiatan.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $dosen_id = $_GET['dosen_id'];
    $kegiatan_id = $_GET['kegiatan_id'];
    $stmt = $conn->prepare("DELETE FROM dosen_kegiatan WHERE dosen_id = ? AND kegiatan_id = ?");
    $stmt->bind_param("ii", $dosen_id, $kegiatan_id);
    $stmt->execute();
    $stmt->close();
    header("Location: dosen_kegiatan.php");
    exit;
}

$data = mysqli_query($conn, "SELECT dk.dosen_id, dk.kegiatan_id, d.nama AS nama_dosen, jk.nama AS nama_kegiatan 
                             FROM dosen_kegiatan dk
                             JOIN dosen d ON dk.dosen_id = d.id
                             JOIN kegiatan k ON dk.kegiatan_id = k.id
                             JOIN jenis_kegiatan jk ON k.jenis_kegiatan_id = jk.id");

$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$kegiatan = mysqli_query($conn, "SELECT k.id, jk.nama AS nama_kegiatan 
                                FROM kegiatan k 
                                JOIN jenis_kegiatan jk ON k.jenis_kegiatan_id = jk.id");

if (isset($_POST['update'])) {
    $old_dosen_id = $_POST['old_dosen_id'];
    $old_kegiatan_id = $_POST['old_kegiatan_id'];
    $dosen_id = $_POST['dosen_id'];
    $kegiatan_id = $_POST['kegiatan_id'];
    $stmt = $conn->prepare("UPDATE dosen_kegiatan SET dosen_id = ?, kegiatan_id = ? WHERE dosen_id = ? AND kegiatan_id = ?");
    $stmt->bind_param("iiii", $dosen_id, $kegiatan_id, $old_dosen_id, $old_kegiatan_id);
    $stmt->execute();
    $stmt->close();
    header("Location: dosen_kegiatan.php");
    exit;
}

$edit_row = null;
if (isset($_GET['edit'])) {
    $dosen_id = $_GET['dosen_id'];
    $kegiatan_id = $_GET['kegiatan_id'];
    $stmt = $conn->prepare("SELECT dk.dosen_id, dk.kegiatan_id, d.nama AS nama_dosen, jk.nama AS nama_kegiatan 
                            FROM dosen_kegiatan dk
                            JOIN dosen d ON dk.dosen_id = d.id
                            JOIN kegiatan k ON dk.kegiatan_id = k.id
                            JOIN jenis_kegiatan jk ON k.jenis_kegiatan_id = jk.id
                            WHERE dk.dosen_id = ? AND dk.kegiatan_id = ?");
    $stmt->bind_param("ii", $dosen_id, $kegiatan_id);
    $stmt->execute();
    $edit_row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-primary">Relasi Dosen dan Kegiatan</h2>
        
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <form method="POST" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Pilih Dosen</label>
                        <select name="dosen_id" required class="form-select">
                            <option value="">-- Pilih Dosen --</option>
                            <?php while ($d = mysqli_fetch_assoc($dosen)) { ?>
                                <option value="<?= $d['id'] ?>"><?= htmlspecialchars(shorten_text($d['nama'])) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Pilih Kegiatan</label>
                        <select name="kegiatan_id" required class="form-select">
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php while ($k = mysqli_fetch_assoc($kegiatan)) { ?>
                                <option value="<?= $k['id'] ?>"><?= htmlspecialchars(shorten_text($k['nama_kegiatan'])) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button name="tambah" class="btn btn-primary w-100">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars(shorten_text($row['nama_dosen'])) ?></td>
                                <td><?= htmlspecialchars(shorten_text($row['nama_kegiatan'])) ?></td>
                                <td>
                                    <a href="?hapus=1&dosen_id=<?= $row['dosen_id'] ?>&kegiatan_id=<?= $row['kegiatan_id'] ?>" 
                                       class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if (mysqli_num_rows($data) === 0): ?>
                        <div class="text-center p-4 text-muted">Belum ada relasi yang ditambahkan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
