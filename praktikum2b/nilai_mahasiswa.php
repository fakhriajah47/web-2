<?php
// Periksa apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $matkul = $_POST['matkul'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nilai_tugas = $_POST['nilai_tugas'];

    // Hitung nilai akhir dengan bobot
    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.4) + ($nilai_tugas * 0.3);

    // Menentukan grade nilai
    if ($nilai_akhir >= 85) {
        $grade = "A";
    } elseif ($nilai_akhir >= 75) {
        $grade = "B";
    } elseif ($nilai_akhir >= 65) {
        $grade = "C";
    } elseif ($nilai_akhir >= 50) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    // Menentukan keterangan lulus/tidak
    $keterangan = ($grade == "A" || $grade == "B" || $grade == "C") ? "Lulus" : "Tidak Lulus";

    // Konversi kode matkul ke nama lengkap
    $daftar_matkul = [
        "DDP" => "Dasar Dasar Pemrograman",
        "BD1" => "Basis Data",
        "WEB1" => "Pemrograman Web"
    ];
    $nama_matkul = $daftar_matkul[$matkul];

    // Tampilkan hasil dalam tabel
    echo "<h2>Hasil Perhitungan Nilai</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><td><b>Nama Mahasiswa</b></td><td>$nama</td></tr>";
    echo "<tr><td><b>Mata Kuliah</b></td><td>$nama_matkul</td></tr>";
    echo "<tr><td><b>Nilai UTS</b></td><td>$nilai_uts</td></tr>";
    echo "<tr><td><b>Nilai UAS</b></td><td>$nilai_uas</td></tr>";
    echo "<tr><td><b>Nilai Tugas</b></td><td>$nilai_tugas</td></tr>";
    echo "<tr><td><b>Nilai Akhir</b></td><td>$nilai_akhir</td></tr>";
    echo "<tr><td><b>Grade</b></td><td>$grade</td></tr>";
    echo "<tr><td><b>Keterangan</b></td><td><b>$keterangan</b></td></tr>";
    echo "</table>";
} else {
    echo "<h3>Silakan isi form terlebih dahulu.</h3>";
}
?>
