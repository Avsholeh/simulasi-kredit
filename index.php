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
    
    <main class="row d-flex justify-content-center">
        <form class="col-6" id="simulasiKredit">
            <h1 class="display-3 mb-3 text-center">Simulasi Kredit</h1>

            <div class="form-group">
                <label for="jumlahKredit">Jumlah Kredit (rupiah): </label>
                <input type="number" class="form-control" id="jumlahKredit" name="jumlahKredit"
                    placeholder="Contoh: 150000000">
            </div>

            <div class="form-group">
                <label for="jangkaWaktu">Jangka Waktu (bulan): </label>
                <input type="number" class="form-control" id="jangkaWaktu" name="jangkaWaktu"
                    placeholder="Contoh: 120">
            </div>

            <div class="form-group">
                <label for="bungaPertahun">Bunga Pertahun (%): </label>
                <input type="number" class="form-control" id="bungaPertahun" name="bungaPertahun"
                    placeholder="Contoh: 10.5">
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
    
        <h1 class="display-4 mb-3 text-center">Pinjaman Anda</h1>
        
        <div class="row d-flex justify-content-center">
            <div class="col-3">Total Pinjaman</div>
            <div class="col-3">: <span id="resultTotalPinjaman"></span></div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-3">Lama Pinjaman</div>
            <div class="col-3">: <span id="resultLamaPinjaman"></span></div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-3">Bunga Pertahun</div>
            <div class="col-3">: <span id="resultBungaPertahun"></span></div>
        </div>

        <div class="flatOnly">

            <div class="row d-flex justify-content-center">
                <div class="col-3">Angsuran Pokok Perbulan</div>
                <div class="col-3">: <span id="resultAngPokokBulan"></span></div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-3">Angsuran Bunga Perbulan</div>
                <div class="col-3">: <span id="resultAngBungaBulan"></span></div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-3">Total angsuran per bulan</div>
                <div class="col-3">: <span id="resultAngBulan"></span></div>
            </div>
        
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <table id="tableAngsuran" class="col-8">
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
        </div>
    </aside>

</body>
<script src="assets/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/jquery/jquery.validate.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/numeraljs/numeral.min.js"></script>
<script src="assets/custom.js"></script>
</html>

