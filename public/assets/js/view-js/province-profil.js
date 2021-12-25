$(document).ready(function () {
    //saat pilihan provinsi di pilih, maka akan mengambil data kota
    //di data-wilayah.php menggunakan ajax
    $("#provinsi").change(function () {
        var id_provinces = $(this).val();
        $.ajax({
            type: "POST",
            url: "/getKota",
            data: { province_id: id_provinces },
            cache: false,
            success: function (msg) {
                $("#kota").html(msg);
            },
        });
    });
});
