<?php

// Fungsi untuk menghitung koefisien regresi linear (slope dan intercept)
function linearRegression(array $x, array $y) {
    $n = count($x);
    if ($n != count($y)) {
        throw new Exception("Array x dan y harus memiliki jumlah elemen yang sama.");
    }

    $sumX = array_sum($x);
    $sumY = array_sum($y);
    $sumXY = 0;
    $sumX2 = 0;

    // Hitung sumXY dan sumX2
    for ($i = 0; $i < $n; $i++) {
        $sumXY += $x[$i] * $y[$i];
        $sumX2 += $x[$i] * $x[$i];
    }

    // Hitung slope (m) dan intercept (b)
    $m = (($n * $sumXY) - ($sumX * $sumY)) / (($n * $sumX2) - ($sumX * $sumX));
    $b = ($sumY - $m * $sumX) / $n;

    return ['slope' => $m, 'intercept' => $b];
}

// Fungsi untuk memprediksi nilai Y berdasarkan X
function predict($m, $b, $x) {
    return ($m * $x) + $b;
}

// Contoh data (X = Input, Y = Output)
$x = [1, 2, 3, 4, 5];
$y = [2, 4, 5, 4, 5];

// Menghitung koefisien regresi
$result = linearRegression($x, $y);
$m = $result['slope'];
$b = $result['intercept'];

// Menampilkan hasil regresi linear
echo "Regresi Linear: Y = {$m}X + {$b}\n";

// Prediksi berdas
