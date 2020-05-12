$(document).ready(function() {
    init();
    const urlRequest = "function.php";
    let jumlahKredit = $('#jumlahKredit');
    let jangkaWaktu = $('#jangkaWaktu');
    let bungaPertahun = $('#bungaPertahun');
    let metode = $("#simulasiKredit input[name=metode]:checked");

    $("#simulasiKredit").validate({
        rules: {
            jumlahKredit: "required",
            jangkaWaktu: "required",
            bungaPertahun: "required"
        },

        messages: {
            jumlahKredit: "Silahkan masukkan jumlah kredit atau pinjaman.",
            jangkaWaktu: "Silahkan masukkan jangka waktu.",
            bungaPertahun: "Silahkan masukkan bunga."
        },

        submitHandler: function(form) {
            hitung();
        }
    });

    $("#btnUlangi").click(function(e) {
        e.preventDefault();
        ulangi();
    });

    function init() {
        $("aside").hide();
    }

    function hitung() {
        $("aside").hide();
        $("#tableAngsuran tbody tr").remove(); 
        let data = $("#simulasiKredit").serializeArray();
        $.post(urlRequest, data, function(e) {
            setInfoPinjaman(
                    e.metode,
                    jumlahKredit.val(),
                    jangkaWaktu.val(),
                    bungaPertahun.val(),
                    e.data[0].pokok,
                    e.data[0].bunga,
                    e.data[0].jumlahAngsuran
            );
            $.each(e.data, function(key, val) {
                setInfoTable(
                    val.no,
                    val.pokok,
                    val.bunga,
                    val.jumlahAngsuran,
                    val.sisaPinjaman
                );
            })
        });
        $("aside").show();
    }

    function ulangi() {
        $("aside").hide();
        jumlahKredit.val("");
        jumlahKredit.val("");
        jangkaWaktu.val("");
        bungaPertahun.val("");
    }

    function setInfoPinjaman(
        metode,
        totalPinjaman,
        lamaPinjaman,
        bunga,
        angPokokPerbulan,
        angBungaPerbulan,
        totalAngsuranPerbulan
    ) {
        let $totalPinjaman = $("#resultTotalPinjaman");
        let $lamaPinjaman = $("#resultLamaPinjaman");
        let $bunga = $("#resultBungaPertahun");
        let $angPokok = $("#resultAngPokokBulan");
        let $angBunga = $("#resultAngBungaBulan");
        let $ang = $("#resultAngBulan");

        if (metode == 1) {
            
            $totalPinjaman.text(rupiah_format(totalPinjaman));
            $lamaPinjaman.text(lamaPinjaman);
            $bunga.text(bunga_format(bunga));

            $angPokok.parent().show();
            $angBunga.parent().show();
            $ang.parent().show();

            $angPokok.text(rupiah_format(angPokokPerbulan));
            $angBunga.text(rupiah_format(angBungaPerbulan));
            $ang.text(rupiah_format(totalAngsuranPerbulan));

        } else {

            $totalPinjaman.text(rupiah_format(totalPinjaman));
            $lamaPinjaman.text(lamaPinjaman);
            $bunga.text(bunga_format(bunga));

            $angPokok.parent().hide();
            $angBunga.parent().hide();
            $ang.parent().hide();

        }
    }

    function setInfoTable(
        bulan,
        pokok,
        bunga,
        jumlahAngsuran,
        sisaPinjaman
    ) {
        let markup = `
            <tr>
                <td>${bulan}</td>
                <td>${rupiah_format(pokok)}</td>
                <td>${rupiah_format(bunga)}</td>
                <td>${rupiah_format(jumlahAngsuran)}</td>
                <td>${rupiah_format(sisaPinjaman)}</td>
            </tr>
        `;
        $("#tableAngsuran > tbody:last-child").append(markup);
    }

    function rupiah_format(number) {
        return number == 0 ? "Rp. " + 0 : "Rp. " + numeral(number).format('0,0');
    }

    function bunga_format(number) {
        return numeral(number).format('0,0') + " %";
    }

}); // eof document.ready