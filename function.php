<?php
header("Content-Type:application/json");

define("HARI_BULAN", 30);
define("HARI_TAHUN", 360);
define("BULAN_TAHUN", 12);

if (isset($_POST['jumlahKredit']) && 
    $_POST['jangkaWaktu'] &&
    $_POST['bungaPertahun'] &&
    $_POST['metode']) {
    
    $_metode = $_POST['metode'];
    $_jumlahKredit = $_POST['jumlahKredit'];
    $_jangkaWaktu = $_POST['jangkaWaktu'];
    $_bungaPertahun = $_POST['bungaPertahun'];

    switch ($_metode) {
        case 1:
            $hasil = metode_flat($_jumlahKredit, $_jangkaWaktu, $_bungaPertahun);
            response($_metode, $hasil);
            break;
        case 2:
            $hasil = metode_efektif($_jumlahKredit, $_jangkaWaktu, $_bungaPertahun);
            response($_metode, $hasil);
            break;
        case 3:
            $hasil = metode_anuitas($_jumlahKredit, $_jangkaWaktu, $_bungaPertahun);
            response($_metode, $hasil);
            break;
        default:
            response("Invalid request.");
            break;
        }
    

} else {

    response("Invalid request.");

}

function response($metode, $data){
    $res['metode'] = $metode;
    $res['data'] = $data;
    $json_response = json_encode($res);
    echo $json_response;
}

function metode_flat($jumlahPinjaman, $jangkaWaktu, $sukuBunga) {
    $data = [];
    $pokok = $jumlahPinjaman / $jangkaWaktu;
    $bunga = ($jumlahPinjaman * ($sukuBunga/100)) / $jangkaWaktu;
    $sisaPinjaman = $jumlahPinjaman;
    $jumlahAngsuran = $pokok + $bunga;

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
        $bunga = $sisaPinjaman * ($sukuBunga/100) * (HARI_BULAN / HARI_TAHUN);
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