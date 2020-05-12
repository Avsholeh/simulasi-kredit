<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Simulasi Kredit - PT. BPR Karimun Sejahtera</title>
</head>

<style>
    main, aside {
        margin: 5rem 10rem 0rem 10rem;
    }
</style>

<body>

    <main>
        <form id="simulasiKredit">
            <h1 class="h1 mb-3">Simulasi Kredit</h1>

            <div class="form-group">
                <label for="jumlahKredit">Jumlah Kredit: </label>
                <input type="number" class="form-control" id="jumlahKredit">
            </div>

            <div class="form-group">
                <label for="jangkaWaktu">Jangka Waktu (bulan): </label>
                <input type="number" class="form-control" id="jangkaWaktu">
            </div>

            <div class="form-group">
                <label for="bungaPertahun">Bunga Pertahun (%): </label>
                <input type="number" class="form-control" id="bungaPertahun">
            </div>

            <div class="form-group">
                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="Flat" name="metode" id="Flat" checked>
                    <label class="form-check-label" for="Flat">Flat</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="Efektif" name="metode" id="Efektif">
                    <label class="form-check-label" for="Efektif">Efektif</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="Anuitas" name="metode" id="Anuitas">
                    <label class="form-check-label" for="Anuitas">Anuitas</label>
                </div>
            </div>

            <div class="form-group">
                <button id="btnKalkulasi" type="submit" class="btn btn-primary">Hitung</button>
                <button id="btnUlangi" type="submit" class="btn btn-secondary">Ulangi</button>
            </div>
        </form>
    </main>

    <aside>
        <hr>
        <h3 class="h3 mb-3">Pinjaman Anda</h1>
        <p>Total Pinjaman : <span id="resultTotalPinjaman">Rp.1000.000.00</span></p>
        <p>Lama Pinjaman :	<span id="resultLamaPinjaman">24 Bulan</span></p>
        <p>Bunga Pertahun :	<span id="resultBungaPertahun">11 %</span></p>
        <p>Angsuran Pokok Perbulan : <span id="resultAngPokokBulan">Rp. 4,166,667</span></p>
        <p>Angsuran Bunga Perbulan : <span id="resultBungaBulan">Rp. 916,667</span></p>
        <p>Total angsuran per bulan	: <span id="resultAngBulan">Rp. 5,083,333</span></p>
        <hr>
    </aside>

</body>
<script src="assets/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        init();
        let jumlahKredit = $('#jumlahKredit');
        let jangkaWaktu = $('#jangkaWaktu');
        let bungaPertahun = $('#bungaPertahun');
        let metode = $("#simulasiKredit input[name=metode]:checked");

        $("#btnKalkulasi").click(function(e) {
            e.preventDefault();
        });

        $("#btnUlangi").click(function(e) {
            e.preventDefault();
            ulangi();
        });

        function init() {
            $("aside").hide();
        }

        function hitung(metode) {
            if (metode == "Anuitas") {
                // hitung anuitas
            } else if (metode == "Efektif") {
                // hitung efektif
            } else {
                // hitung flat
            }
        }

        function ulangi() {
            $("aside").hide();
            jumlahKredit.val("");
        }
    });
</script>

</html>