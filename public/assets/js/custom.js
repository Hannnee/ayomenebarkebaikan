    /**
     * function format input to rupiah
     */
    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    /**
     * event for format rupiah
     */
    let format_rupiah = document.querySelector('.format-rupiah');

    $('.format-rupiah').keyup(function (e) {
        format_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /**
     * global modal confirmation you can use
     */
    $('#confirmation-modal-submit').click(function (e) {
        e.preventDefault();
        $('#confirmation-modal-cancel').remove();
        $(this).attr("disabled", 'disabled');
        $('#confirmation-modal-submit').prop("disabled", true);
        $('.lead-information').html('Please wait, your process is running . . . ')
        $('.form-submit').submit();
    });

    /**
     * if page want to no sidebar
     */
    if($("#no-sidebar").length == 1) {
        $('.nk-sidebar nk-sidebar-fixed')
        const div = document.querySelector(".nk-sidebar");
        div.classList.add("is-compact");
    }
    window.formatRupiah = formatRupiah;


