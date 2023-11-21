<?php

$this->extend('layout/main');

$this->section('content') ?>
    <div class="section-th mt-4">
        <div class="fw-medium">Semua Transaksi</div>
        <div class="th-content data-th"></div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                let history_limit = 5;

                jQuery.ajax({
                    url: "https://take-home-test-api.nutech-integrasi.app/transaction/history?offset=0&limit="+history_limit,
                    type: "GET",
                    dataType: "JSON",
                    headers: {
                        Authorization: 'Bearer ' + $.session.get('token')
                    },
                    beforeSend: function () {
                        ci_helper.helper.blockUI('html');
                    },
                    success: function (response) {
                        ci_helper.helper.unblockUI('html');
                        $.session.set("history_limit",response.data.limit);

                        let html = '', history = '', store_service = {},type_class='',indicator='+';
                        if (typeof response.data !== "undefined") {
                            if (typeof response.data.records !== "undefined") {
                                $.each(response.data.records, function (i, v) {
                                    let total_amount = v.total_amount;
                                    if(v.transaction_type=="PAYMENT"){
                                        type_class='text-danger';
                                        indicator = "-"
                                    }else{
                                        type_class='text-success';
                                    }

                                    var date = new Date(v.created_on);
                                    var tahun = date.getFullYear();
                                    var bulan = date.getMonth();
                                    var tanggal = date.getDate();
                                    var hari = date.getDay();
                                    var jam = date.getHours();
                                    var menit = date.getMinutes();
                                    var detik = date.getSeconds();
                                    switch(hari) {
                                        case 0: hari = "Minggu"; break;
                                        case 1: hari = "Senin"; break;
                                        case 2: hari = "Selasa"; break;
                                        case 3: hari = "Rabu"; break;
                                        case 4: hari = "Kamis"; break;
                                        case 5: hari = "Jum'at"; break;
                                        case 6: hari = "Sabtu"; break;
                                    }
                                    switch(bulan) {
                                        case 0: bulan = "Januari"; break;
                                        case 1: bulan = "Februari"; break;
                                        case 2: bulan = "Maret"; break;
                                        case 3: bulan = "April"; break;
                                        case 4: bulan = "Mei"; break;
                                        case 5: bulan = "Juni"; break;
                                        case 6: bulan = "Juli"; break;
                                        case 7: bulan = "Agustus"; break;
                                        case 8: bulan = "September"; break;
                                        case 9: bulan = "Oktober"; break;
                                        case 10: bulan = "November"; break;
                                        case 11: bulan = "Desember"; break;
                                    }
                                    var tampilTanggal =  hari + " " + tanggal + " " + bulan + " " + tahun;
                                    var tampilWaktu =  jam + ":" + menit + ":" + detik;
                                    html +='<div class="d-flex mt-4 border rounded px-3 py-2">';
                                    html +='<div class="col-6">';

                                    html +='<div class="row">';
                                    html +='<div class="'+type_class+' fw-medium th-nominal">'+indicator+ ' Rp '+ total_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                                    html +='</div>';

                                    html +='<div class="row">';
                                    html +='<div class="text-body-tertiary fw-medium th-date">'+tampilTanggal+' '+tampilWaktu+'</div>';
                                    html +='</div>';

                                    html +='</div>';

                                    html +='<div class="col-6 py-2">';
                                    html +='<div class="th-type text-end py-2 fw-medium">'+v.description+'</div>';
                                    html +='</div>';
                                    html +='</div>';
                                });

                                if(parseInt(response.data.limit) > parseInt(response.data.records.length)){
                                }else{
                                    html +='<div class="row">';
                                    html +=' <a href="#" class="th-show-more text-danger fw-bold text-center mt-4" data-limit="'+response.data.limit+'">Show more</a>';
                                    html +='</div>';
                                }

                                if(parseInt(response.data.records.length)=== 0){
                                    html +='<div class="text-center text-body-tertiary">Maaf tidak ada histori transaksi</div>';
                                }

                                $(".data-th").html(html);
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        ci_helper.helper.unblockUI('html');
                    }
                });
                $(document).on(
                    "click",
                    ".th-show-more",
                    function (e) {
                        e.preventDefault();
                        let history_limit = parseInt($.session.get("history_limit"))+5;

                        jQuery.ajax({
                            url: "https://take-home-test-api.nutech-integrasi.app/transaction/history?offset=0&limit="+history_limit,
                            type: "GET",
                            dataType: "JSON",
                            headers: {
                                Authorization: 'Bearer ' + $.session.get('token')
                            },
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (response) {
                                ci_helper.helper.unblockUI('html');
                                $.session.set("history_limit",response.data.limit);

                                let html = '', history = '', store_service = {},type_class='',indicator='+';
                                if (typeof response.data !== "undefined") {
                                    if (typeof response.data.records !== "undefined") {
                                        $.each(response.data.records, function (i, v) {
                                            let total_amount = v.total_amount;
                                            if(v.transaction_type=="PAYMENT"){
                                                type_class='text-danger';
                                                indicator = "-"
                                            }else{
                                                type_class='text-success';
                                            }

                                            var date = new Date(v.created_on);
                                            var tahun = date.getFullYear();
                                            var bulan = date.getMonth();
                                            var tanggal = date.getDate();
                                            var hari = date.getDay();
                                            var jam = date.getHours();
                                            var menit = date.getMinutes();
                                            var detik = date.getSeconds();
                                            switch(hari) {
                                                case 0: hari = "Minggu"; break;
                                                case 1: hari = "Senin"; break;
                                                case 2: hari = "Selasa"; break;
                                                case 3: hari = "Rabu"; break;
                                                case 4: hari = "Kamis"; break;
                                                case 5: hari = "Jum'at"; break;
                                                case 6: hari = "Sabtu"; break;
                                            }
                                            switch(bulan) {
                                                case 0: bulan = "Januari"; break;
                                                case 1: bulan = "Februari"; break;
                                                case 2: bulan = "Maret"; break;
                                                case 3: bulan = "April"; break;
                                                case 4: bulan = "Mei"; break;
                                                case 5: bulan = "Juni"; break;
                                                case 6: bulan = "Juli"; break;
                                                case 7: bulan = "Agustus"; break;
                                                case 8: bulan = "September"; break;
                                                case 9: bulan = "Oktober"; break;
                                                case 10: bulan = "November"; break;
                                                case 11: bulan = "Desember"; break;
                                            }
                                            var tampilTanggal =  hari + " " + tanggal + " " + bulan + " " + tahun;
                                            var tampilWaktu =  jam + ":" + menit + ":" + detik;
                                            html +='<div class="d-flex mt-4 border rounded px-3 py-2">';
                                            html +='<div class="col-6">';

                                            html +='<div class="row">';
                                            html +='<div class="'+type_class+' fw-medium th-nominal">'+indicator+ ' Rp '+ total_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                                            html +='</div>';

                                            html +='<div class="row">';
                                            html +='<div class="text-body-tertiary fw-medium th-date">'+tampilTanggal+' '+tampilWaktu+'</div>';
                                            html +='</div>';

                                            html +='</div>';

                                            html +='<div class="col-6 py-2">';
                                            html +='<div class="th-type text-end py-2 fw-medium">'+v.description+'</div>';
                                            html +='</div>';
                                            html +='</div>';
                                        });
                                        if(parseInt(response.data.limit) > parseInt(response.data.records.length)){
                                        }else{
                                            html +='<div class="row">';
                                            html +=' <a href="#" class="th-show-more text-danger fw-bold text-center mt-4" data-limit="'+response.data.limit+'">Show more</a>';
                                            html +='</div>';
                                        }

                                        if(parseInt(response.data.records.length) ==0){
                                            html +='<div class="text-center text-body-tertiary">Maaf tidak ada histori transaksi</div>';
                                        }

                                        $(".data-th").html(html);
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                    });
            });
        })
    </script>

<?php $this->endSection() ?>