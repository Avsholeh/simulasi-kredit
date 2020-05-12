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
    $pokok = pokokPerbulan($jumlahPinjaman, $jangkaWaktu);
    $bunga = bungaPerbulan($jumlahPinjaman, $sukuBunga);
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

function metode_efektif() {
    
}

function metode_anuitas() {

}

function bungaPerbulan($pokokPinjaman, $sukuBunga) {
    return ($pokokPinjaman * $sukuBunga) / BULAN_TAHUN;
}

function pokokPerbulan($pokokPinjaman, $jangkaWaktu) {
    return $pokokPinjaman / $jangkaWaktu;
}

echo var_dump(metode_flat(100000000, 12, 11/100));
?>