$(document).ready(function() {
    init();
    const URL_REQUEST = "function.php";
    
    let $jumlahKredit = $('#jumlahKredit');
    let $jangkaWaktu = $('#jangkaWaktu');
    let $bungaPertahun = $('#bungaPertahun');
    let submited = false;

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

        submitHandler: function() {
            hitung();
            submited = true;
        }
    });

    $("#btnUlangi").click(function(e) {
        e.preventDefault();
        ulangi();
        submited = false;
    });

    $("input[name=metode]").change(function() {
        if (submited) hitung();
    });

    function init() {
        $("aside").hide();
    }

    function hitung() {
        $("aside").hide();
        $("#tableAngsuran tbody tr").remove(); 
        let data = $("#simulasiKredit").serializeArray();
        $.post(URL_REQUEST, data, function(e) {
            setInfoPinjaman(
                    e.metode,
                    $jumlahKredit.val(),
                    $jangkaWaktu.val(),
                    $bungaPertahun.val(),
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
        $jumlahKredit.val("");
        $jangkaWaktu.val("");
        $bungaPertahun.val("");
    }

    function setInfoPinjaman(
        metode,
        total,
        lama,
        bunga,
        angsuranPokok,
        angsuranBunga,
        totalAngsuran
    ) {
        let $totalPinjaman = $("#resultTotalPinjaman");
        let $lamaPinjaman = $("#resultLamaPinjaman");
        let $bunga = $("#resultBungaPertahun");
        let $angPokok = $("#resultAngPokokBulan");
        let $angBunga = $("#resultAngBungaBulan");
        let $ang = $("#resultAngBulan");
        let $flatOnly = $(".flatOnly");

        if (metode == 1) {
            
            $totalPinjaman.text(rupiah_format(total));
            $lamaPinjaman.text(lama);
            $bunga.text(bunga + " %");
            $flatOnly.show();

            $angPokok.text(rupiah_format(angsuranPokok));
            $angBunga.text(rupiah_format(angsuranBunga));
            $ang.text(rupiah_format(totalAngsuran));

        } else {

            $totalPinjaman.text(rupiah_format(total));
            $lamaPinjaman.text(lama);
            $bunga.text(bunga + " %");
            $flatOnly.hide();

        }
    }

    function setInfoTable(
        bulan,
        angsuranpokok,
        angsuranBunga,
        jumlahAngsuran,
        sisaPinjaman
    ) {
        let markup = `
            <tr>
                <td>${bulan}</td>
                <td>${rupiah_format(angsuranpokok)}</td>
                <td>${rupiah_format(angsuranBunga)}</td>
                <td>${rupiah_format(jumlahAngsuran)}</td>
                <td>${rupiah_format(sisaPinjaman)}</td>
            </tr>
        `;
        $("#tableAngsuran > tbody:last-child").append(markup);
    }

    function rupiah_format(number) {
        return number == 0 ? "Rp. " + 0 : "Rp. " + numeral(number).format('0,0');
    }

}); // eof document.ready