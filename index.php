<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- debugging purpose -->
    <meta http-equiv="refresh" content="5">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Simulasi Kredit</title>
</head>

<style>
    main {
        margin: 10rem 10rem 20rem 10rem;
    }
</style>

<body>

    <main>
        <form>
            <h1 class="h3 mb-3">Simulasi Kredit</h1>

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
                    <input type="radio" class="form-check-input" name="metode" id="metode1">
                    <label class="form-check-label" for="metode1">Flat</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" name="metode" id="metode2">
                    <label class="form-check-label" for="metode2">Efektif</label>
                </div>

                <div class="form-check-inline">
                    <input type="radio" class="form-check-input" name="metode" id="metode3">
                    <label class="form-check-label" for="metode3">Anuitas</label>
                </div>
            </div>

            <div class="form-group">
                <button id="btnKalkulasi" type="submit" class="btn btn-primary">Hitung</button>
                <button id="btnUlangi" type="submit" class="btn btn-secondary">Ulangi</button>
            </div>
        </form>
    </main>

</body>
<script src="assets/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    
</script>

</html>