<?php
header("Content-Type:application/json");

define("HARI_BULAN", 30);
define("HARI_TAHUN", 360);
define("BULAN_TAHUN", 12);

// if (isset($_POST['param'])) {
    
// } else {

//     response("param");

// }

function response($param){
    $response['param'] = $param;
    $json_response = json_encode($response);
    echo $json_response;
}

function metode_flat($jumlahPinjaman, $jangkaWaktu, $sukuBunga) {
    $data = [];
    $pokok = $jumlahPinjaman / $jangkaWaktu;
    $bunga = ($jumlahPinjaman * $sukuBunga) / BULAN_TAHUN;
    $sisaPinjaman = $jumlahPinjaman;
    $jumlahAngsuran = ( $pokok + $bunga );

    for($i = 0; $i < $jangkaWaktu; $i++) {
        $sisaPinjaman -= $pokok;
        array_push($data, [
            "no"                => $i + 1,
            "pokok"             => round($pokok),
            "bunga"             => round($bunga),
            "jumlahAngsuran"    => round($jumlahAngsuran),
            "sisaPinjaman"      => round($sisaPinjaman)
        ]);
    }
    return $data;
}

function metode_efektif($jumlahPinjaman, $jangkaWaktu, $sukuBunga) {
    $data = [];
    $sisaPinjaman = $jumlahPinjaman;
    $pokok = $jumlahPinjaman / $jangkaWaktu;
    
    for($i = 0; $i < $jangkaWaktu; $i++) {
        $bunga = $sisaPinjaman * $sukuBunga * (HARI_BULAN / HARI_TAHUN);
        $jumlahAngsuran = ( $pokok + $bunga );
        $sisaPinjaman -= $pokok;
        array_push($data, [
            "no"                => $i + 1,
            "pokok"             => round($pokok),
            "bunga"             => round($bunga),
            "jumlahAngsuran"    => round($jumlahAngsuran),
            "sisaPinjaman"      => round($sisaPinjaman)
        ]);
    }
    return $data;
}

function metode_anuitas() {

}

?>