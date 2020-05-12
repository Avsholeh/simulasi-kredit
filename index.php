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
        margin: 1rem 10rem 1rem 10rem;
    }
    table {
        width: 100%;
    }
</style>

<body>
    
    <main>
        <form id="simulasiKredit">
            <h1 class="h1 mb-3">Simulasi Kredit</h1>

            <div class="form-group">
                <label for="jumlahKredit">Jumlah Kredit: </label>
                <input type="number" class="form-control" id="jumlahKredit" name="jumlahKredit" value="100000000">
            </div>

            <div class="form-group">
                <label for="jangkaWaktu">Jangka Waktu (bulan): </label>
                <input type="number" class="form-control" id="jangkaWaktu" name="jangkaWaktu" value="12">
            </div>

            <div class="form-group">
                <label for="bungaPertahun">Bunga Pertahun (%): </label>
                <input type="number" class="form-control" id="bungaPertahun" name="bungaPertahun" value="11">
            </div>

            <div class="form-group">
                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="1" name="metode" id="Flat" checked>
                    <label class="form-check-label" for="Flat">Flat</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="2" name="metode" id="Efektif">
                    <label class="form-check-label" for="Efektif">Efektif</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" value="3" name="metode" id="Anuitas">
                    <label class="form-check-label" for="Anuitas">Anuitas</label>
                </div>
            </div>

            <div class="form-group">
                <button id="btnHitung" type="submit" class="btn btn-primary">Hitung</button>
                <button id="btnUlangi" type="submit" class="btn btn-secondary">Ulangi</button>
            </div>
        </form>
    </main>

    <aside>
        <hr>
        <h3 class="h3 mb-3">Pinjaman Anda</h1>
        <p>Total Pinjaman : <span id="resultTotalPinjaman"></span></p>
        <p>Lama Pinjaman :	<span id="resultLamaPinjaman"></span></p>
        <p>Bunga Pertahun :	<span id="resultBungaPertahun"></span></p>
        <p>Angsuran Pokok Perbulan : <span id="resultAngPokokBulan"></span></p>
        <p>Angsuran Bunga Perbulan : <span id="resultAngBungaBulan"></span></p>
        <p>Total angsuran per bulan	: <span id="resultAngBulan"></span></p>
        <hr>

        <table id="tableAngsuran">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Bulan</th>
                <th scope="col">Pokok</th>
                <th scope="col">Bunga</th>
                <th scope="col">Angsuran</th>
                <th scope="col">Sisa Pinjaman</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </aside>

</body>
<script src="assets/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/jquery/jquery.validate.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/numeraljs/numeral.min.js"></script>
<script src="assets/custom.js"></script>
</html>

