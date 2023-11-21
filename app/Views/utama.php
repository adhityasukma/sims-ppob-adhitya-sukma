<?php

$this->extend('layout/main');

$this->section('content') ?>

    <div class="section-service mt-4">
        <div class="row justify-content-between service"></div>
    </div>
    <div class="section-banners mt-4">
        <div class="fw-medium mb-3">Temukan promo menarik</div>
        <div class="owl-carousel owl-theme banners"></div>
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
                        let html = '';
                        if (typeof response.data !== "undefined") {
                            $.each(response.data, function (i, v) {
                                $.session.set("service", v);
                                html += '<div class="col-sm-1 text-center my-3">' +
                                    '<a href="/services/' + v.service_code + '">' +
                                    '<img src="' + v.service_icon + '" class="service_icon">' +
                                    '<div class="service_name px-4">' + v.service_name + '</div>' +
                                    '</a>' +
                                    '</div>';
                                $(".service").html(html);
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        ci_helper.helper.unblockUI('html');
                    }
                });
            });
        })
    </script>
<?php $this->endSection() ?>