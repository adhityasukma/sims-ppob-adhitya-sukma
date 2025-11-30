let ci_helper;
ci_helper = {
    el: {
        window: $(window),
        document: $(document),
    },
    var: {
        search: [],
        hari: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        bulan: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        save_method: null
    },
    helper: {
        blockUI: function (selector = "") {
            if (selector) {
                $(selector).block({
                    message: '<div class="spinner-border text-danger" role="status">\n' +
                        '  <span class="visually-hidden">Loading...</span>\n' +
                        '</div>',
                    css: {backgroundColor: 'transparent', border: 0, color: '#fff'}
                });
            } else {
                $.blockUI({
                    message: '<div class="spinner-border text-danger" role="status">\n' +
                        '  <span class="visually-hidden">Loading...</span>\n' +
                        '</div>',
                    css: {backgroundColor: 'transparent', border: 0, color: '#fff'}
                });
            }
        },
        formatRupiah:function(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        },
        unblockUI: function (selector = "") {
            if (selector) {
                $(selector).unblock();
            } else {
                $.unblockUI();
            }
        },
        tooltips_initialize: function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        },
        initTooltips: function (selector = "") {
            $(selector).tipTip({
                attribute: 'data-tip',
                fadeIn: 50,
                fadeOut: 50,
                delay: 200,
            });
        },
        select2_initialize: function (selector = "", args = []) {
            if (selector) {
                $(selector).select2(args);
            }
        },
        getUrlParameter: function (sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        },
    }
}