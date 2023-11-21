<?php

$this->extend('layout/main');

$this->section('content') ?>
    <div class="section-ts mt-4">
        <div>Pembayaran</div>
        <div class="d-flex title-service"></div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <label class="input-group-text" id="password"><i class="fa fa-cash-register"></i></label>
                    <input type="text" class="nominal-ts form-control" disabled name="ts" value="">
                </div>
                <div class="input-group mb-3">
                    <button type="button" class="btn-nominal-ts btn btn-danger" data-service="">Bayar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-container" id="ts-modal" tabindex="-1" aria-labelledby="ts-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-2">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                /** Services **/
                jQuery.ajax({
                    url: "https://take-home-test-api.nutech-integrasi.app/services",
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
                        let html = '', service_code = '', store_service = {};
                        var quotations = [];
                        if (typeof response.data !== "undefined") {
                            $.each(response.data, function (i, v) {
                                $.session.set("service", v);
                                const pathArray = window.location.pathname.split("/");
                                service_code = pathArray.at(-1);
                                if (service_code.toLowerCase() == v.service_code.toLowerCase()) {
                                    $.session.set("service_icon", v.service_icon);
                                    $.session.set("service_code", v.service_code);
                                    $.session.set("service_tariff", v.service_tariff);
                                    $.session.set("service_name", v.service_name);
                                    html += '<img class="align-middle me-2" src="' + v.service_icon + '" alt="' + v.service_icon + '"><span class="logo-service pt-1 fw-medium">' + v.service_name + '</span>';
                                    $(".title-service").html(html);
                                    $("input[name='ts']").val(v.service_tariff);
                                    $(".btn-nominal-ts").attr("data-service", v.service_code);
                                }

                            });
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        ci_helper.helper.unblockUI('html');
                    }
                });
                $("#ts-modal").modal({backdrop: 'static', keyboard: false})
                $(document).on(
                    "click",
                    ".lanjutkan-ts-modal",
                    function (e) {
                        e.preventDefault();
                        $.ajax({
                            url: "https://take-home-test-api.nutech-integrasi.app/transaction",
                            headers: {
                                Authorization: 'Bearer ' + $.session.get('token')
                            },
                            data: {
                                service_code: $.session.get("service_code")
                            },
                            type: "POST",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('#ts-modal');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('#ts-modal');
                                let html = '',balance=parseInt($.session.get("balance")) - parseInt($.session.get("service_tariff"));
                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="topup-berhasil-icon bi bi-check-circle-fill text-success"></i>' +
                                    '</div>';
                                html += '<div class="text-center">Pembayaran ' + $.session.get("service_name").toLowerCase() + ' sebesar</div>';
                                html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + $.session.get("service_tariff").toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                                html += '<div class="text-center">' + data.message + '</div>';
                                html += '<div class="text-center my-3"><a href="/dashboard" class="kembali-beranda-modal text-danger fw-medium">Kembali ke Beranda</a></div>';
                                $("#ts-modal").find(".modal-content").html(html);
                                $(".balance").html(balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                ci_helper.helper.unblockUI('#ts-modal');
                                let html = '';
                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                    '</div>';
                                html += '<div class="text-center">Pembayaran ' + $.session.get("service_name").toLowerCase() + ' sebesar</div>';
                                html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + $.session.get("service_tariff").toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                                html += '<div class="text-center">' + jqXHR.responseJSON.message + '</div>';
                                html += '<div class="text-center my-3"><a href="/dashboard" class="kembali-beranda-modal text-danger fw-medium">Kembali ke Beranda</a></div>';
                                $("#ts-modal").find(".modal-body").html(html);
                            }
                        });
                    });
                $(document).on(
                    "click",
                    ".btn-nominal-ts",
                    function (e) {
                        let html ='';
                        html += '<div class="text-center text-center my-3">' +
                            '<img class="align-top me-2" src="../assets/img/Logo.png" alt="Logo.png">' +
                            '</div>';
                        html += '<div class="text-center">Beli '+ $.session.get("service_name").toLowerCase()+' senilai</div>';
                        html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + $.session.get("service_tariff").toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                        html += '<div class="text-center mt-4"><a href="#" class="lanjutkan-ts-modal text-danger fw-medium">Ya, lanjutkan Bayar</a></div>';
                        html += '<div class="text-center my-3"><a href="#" class="batalkan-topup-modal text-secondary" data-bs-dismiss="modal">Batalkan</a></div>';

                        $("#ts-modal").find(".modal-body").html(html);
                        $("#ts-modal").modal("show");

                    });
            });
        })
    </script>

<?php $this->endSection() ?>