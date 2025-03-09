<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi IT Club Data Science</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
require_once "data-form-regis.php"; // Pastikan file ini berisi array $ar_prodi dan $ar_domisili
?>

<body style="font-size: 18px;">
<form method="POST" action="hasil-form-regis.php" class="container mt-5">
    <fieldset class="border border-dark p-3 rounded" style="background-color: lightyellow;">
        <legend class="float-none w-auto px-3 fw-bold h3">Form Registrasi IT Club Data Science</legend>

        <!-- Nama Lengkap -->
        <div class="form-group row">
            <label for="nama_lengkap" class="col-4 col-form-label">Nama Lengkap</label> 
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-address-book"></i></div>
                    </div> 
                    <input id="nama_lengkap" name="nama_lengkap" placeholder="*Agus" type="text" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- NIM -->
        <div class="form-group row">
            <label for="nim" class="col-4 col-form-label">NIM</label> 
            <div class="col-8">
                <input id="nim" name="nim" placeholder="*0110122156" type="text" class="form-control" required>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group row">
            <label for="jk" class="col-4 col-form-label">Jenis Kelamin</label> 
            <div class="col-8">
                <select id="jk" name="jk" class="custom-select" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Program Studi -->
        <div class="form-group row">
            <label for="prodi" class="col-4 col-form-label">Program Studi</label> 
            <div class="col-8">
                <select id="prodi" name="prodi" class="custom-select" required>
                    <?php 
                    foreach ($ar_prodi as $kode => $nama) {  
                        echo "<option value='$kode'>$nama</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Skill Web & Programming -->
        <div class="form-group row">
            <label class="col-4">Skill Web & Programming</label> 
            <div class="col-8">
                <?php 
                $ar_skill = [
                    'HTML' => 10,
                    'CSS' => 10,
                    'JavaScript' => 20,
                    'RWD Bootstrap' => 20,
                    'PHP' => 30,
                    'Python' => 30,
                    'Java' => 50
                ];
                foreach ($ar_skill as $skill => $score) {
                    echo "<div class='form-check'>
                            <input type='checkbox' name='skill[]' value='$skill' class='form-check-input'>
                            <label class='form-check-label'>$skill ($score)</label>
                          </div>";
                }
                ?>
            </div>
        </div>

        <!-- Domisili -->
        <div class="form-group row">
            <label for="domisili" class="col-4 col-form-label">Domisili</label> 
            <div class="col-8">
                <select id="domisili" name="domisili" class="custom-select" required>
                    <?php
                    foreach ($ar_domisili as $dom) {
                        echo "<option value='$dom'>$dom</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email</label> 
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div> 
                    <input id="email" name="email" placeholder="*email@example.com" type="email" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </fieldset>
</form>
</body>
</html>
