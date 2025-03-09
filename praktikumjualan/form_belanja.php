<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
</head>
<body>
    <h2>Form Belanja</h2>

    <form method="POST" action="total_belanja.php">

    <label for="customer">Nama Customer:</label>
    <input type="text" id="customer" name="customer" required>
    <br><br>

    <label>Pilih Produk: </label>
    <input type="text" id="customer" name="customer" required>
    <br><br>

    <label>Pilih produk:</label> <br>
    <input type="radio"id="tv" name="produk" value="kulkas">
    <label for="tv">Kulkas</label>

    <input type="radio" id="mesin cucu" name="produk" value="mesin cuci">
    <label for="mesin cucu">Mesin Cuci</label>

    <input type="radio" id="kulkas" name="produk" value="mesin cuci">
    <label for="mesin cuci">mesin cuci</label>

    <label for="jumlah">Jumlah Barang</label>
    <input type="number" id="jumlah" min="1" required>
    <br><br>

    <button type="submit" name="proses"></button>
    
        </form>
</body>
</html>