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
        get_profile:function(){
            jQuery.ajax({
                url: "https://take-home-test-api.nutech-integrasi.app/profile/",
                type: "GET",
                dataType: "JSON",
                headers: {
                    Authorization: 'Bearer ' + $.session.get('token')
                },
                beforeSend: function () {
                    ci_helper.helper.blockUI('html');
                },
                success: function (response) {
                    console.log(response);
                    ci_helper.helper.unblockUI('html');
                    let profile_image;
                    if (typeof response.data !== "undefined") {
                        profile_image = response.data.profile_image;
                        const pathArray = profile_image.split("/");
                        console.log(pathArray.at(-1));
                        if(pathArray.at(-1)=="null"){
                            profile_image = "<?php echo "
                        }
                        // if(profile_image.indexOf('null') > -1){
                        //
                        // }
                    }
                    // let html = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    //     data.message +
                    //     '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    // $(html).appendTo($(".berhasil-pesan"));
                    // ci_helper.helper.unblockUI('html');
                    // $(".registration-form")[0].reset();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    //     jqXHR.responseJSON.message +
                    //     '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    // $(html).appendTo($(".error-pesan"));
                    ci_helper.helper.unblockUI('html');
                }
            });
        },
        get_token:function(){
            return $.session.get('token');
        },
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
        formatBytes:function(bytes, decimals = 2,withTextsize=false) {
            if (!+bytes) return '0 Bytes'

            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];

            const i = Math.floor(Math.log(bytes) / Math.log(k));

            if(withTextsize){
                return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
            }else{
                return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))}`;
            }

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