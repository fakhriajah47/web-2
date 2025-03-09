<?php
$customer = $_POST["customer"];
$produk = $_POST["produk"];
$jumlah = $_POST["jumlah"]


$harga_produk = [
    "tv" => 3000000,
    "kulkas" => 2000000,
    "mesin cuci" => 1500000,
];

if (array_key_exists($produk, $harga_produk)) {
    $total = $harga_produk[$produk] * $jumlah;
}
else
{
    $total_harga = 0; 
}

echo "<h2>Detail Belanja<?h2>";
echo "Nama Customer: <b>$produk </b> <br>";
echo "Produk yang dibeli: <b>$produk</b><br>";

echo "Jumlah: <b>$jumlah </b> <br>";
echo "Total Harga: <b>Rp " . number_format($total_harga, 0 ',', '.') . "</br>";


?>