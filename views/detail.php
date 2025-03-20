<?php
require_once("controllers/prodi.php")

if (isset ($_GET['id'])){
    $id = $_GET['id'];
    $data = $prodi->$show($id))

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    
</head>
<body>
<h1>detail prodi</h1>
<?php if($data) :?>
<p> kode: <?= $data ['kode'] ?></p>
<p> nama: <?= $data ['nama'] ?></p>
<p> kaprodi: <?= $data ['kaprodi'] ?></p>

<?php else:?>
    <p>data tidak ditemukan</p>
<?php endif ?>
<a href="?url=prodi">kembali</a>

</body>
</html>