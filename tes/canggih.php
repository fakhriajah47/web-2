<?php
declare(strict_types=1);  // Mengaktifkan strict typing untuk memastikan tipe data yang tepat

// Fungsi untuk mencetak pesan
function printMessage(string $message): void {
    echo $message . PHP_EOL;
}

// Fungsi anonim untuk menghitung jumlah karakter dalam string
$lengthOfString = fn(string $input): int => strlen($input);

// Fungsi untuk memproses data pengguna
function processUserData(?string $name, ?int $age): void {
    // Memastikan nilai tidak null dan valid
    if ($name && $age) {
        printMessage("Nama: $name, Usia: $age");
    } else {
        printMessage("Data tidak lengkap.");
    }
}

// Penggunaan array dengan fungsi array_map dan array_filter
$numbers = [1, 2, 3, 4, 5];
$squaredNumbers = array_map(fn($n) => $n * $n, $numbers); // Menaikkan setiap angka kuadrat
$evenNumbers = array_filter($numbers, fn($n) => $n % 2 === 0); // Memilih angka genap

// Menampilkan hasil
printMessage("Angka kuadrat: " . implode(', ', $squaredNumbers));
printMessage("Angka genap: " . implode(', ', $evenNumbers));

// Menyelesaikan tugas dengan menggunakan data pengguna
processUserData("John Doe", 30);
processUserData(null, null);
?>
