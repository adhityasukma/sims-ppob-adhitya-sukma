<?php

$this->extend('layout/main');

$this->section('content') ?>
    <div class="section-topup mt-4">
        <div>Silakan masukan</div>
        <div class="fw-medium fs-4">Nominal Top Up</div>
        <div class="row mt-4">
            <div class="col-8">
                <div class="input-group mb-3">
                    <label class="input-group-text" id="password"><i class="fa fa-cash-register"></i></label>
                    <input type="text" class="nominal-topup form-control" name="topup"
                           placeholder="masukan nominal Top Up">
                </div>
                <div class="input-group mb-3">
                    <button type="button" class="btn-nominal-topup btn btn-danger" disabled>Top Up</button>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <?php
                    $nominals = ['10000', '20000', '50000', '100000', '250000', '500000'];
                    foreach ($nominals as $nominal):
                        ?>
                        <div class="col-4 mb-3">
                            <button type="button"
                                    class="nominal_topup btn btn-outline-secondary rounded"
                                    data-nominal="<?php echo $nominal; ?>">
                                Rp <?php echo number_format($nominal, 0, ',', "."); ?></button>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-container" id="topup-modal" tabindex="-1" aria-labelledby="topup-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                $(document).on(
                    "click",
                    ".nominal_topup",
                    function (e) {
                        let nominal = $(this).attr("data-nominal");
                        $(".nominal-topup").val(nominal);
                        $(".btn-nominal-topup").removeAttr("disabled");
                    });

                $(document).on(
                    "change paste keyup",
                    ".nominal-topup",
                    function (e) {
                        if ($(this).val() == "") {
                            $(".btn-nominal-topup").attr("disabled", 'disabled');
                        } else {
                            $(".btn-nominal-topup").removeAttr("disabled");
                        }
                    });
                $("#topup-modal").modal({backdrop: 'static', keyboard: false});
                $(document).on(
                    "click",
                    ".lanjutkan-topup-modal",
                    function (e) {
                        e.preventDefault();
                        let nominal_topup = $('.nominal-topup').val(),is_valid=true,minimum_topup=10000,maksimum_topup=1000000;
                        if(nominal_topup<minimum_topup){
                            let html='';
                            html += '<div class="text-center text-center my-3">' +
                                '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                '</div>';
                            html +='<div class="text-center">Top Up sebesar</div>';
                            html +='<div class="nominal-modal text-center fs-4 fw-bold">Rp '+nominal_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                            html +='<div class="text-center">Top Up gagal, minimum nominal sebesar</div>';
                            html +='<div class="nominal-modal text-center fs-4 fw-bold">Rp '+minimum_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                            html +='<div class="text-center my-3"><a href="#" class="batalkan-topup-modal text-secondary" data-bs-dismiss="modal">Tutup</a></div>';
                            $("#topup-modal").find(".modal-body").html(html);
                            is_valid = false;
                        }
                        if(nominal_topup>maksimum_topup){
                            let html='';
                            html += '<div class="text-center text-center my-3">' +
                                '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                '</div>';
                            html +='<div class="text-center">Top Up sebesar</div>';
                            html +='<div class="nominal-modal text-center fs-4 fw-bold">Rp '+nominal_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                            html +='<div class="text-center">Top Up gagal, maksimum nominal sebesar</div>';
                            html +='<div class="nominal-modal text-center fs-4 fw-bold">Rp '+maksimum_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+'</div>';
                            html +='<div class="text-center my-3"><a href="#" data-bs-dismiss="modal" class="batalkan-topup-modal text-secondary">Tutup</a></div>';
                            $("#topup-modal").find(".modal-body").html(html);
                            is_valid = false;
                        }
                        if(is_valid) {
                            $.ajax({
                                url: "https://take-home-test-api.nutech-integrasi.app/topup",
                                data: {
                                    top_up_amount: nominal_topup
                                },
                                headers: {
                                    Authorization: 'Bearer ' + $.session.get('token')
                                },
                                type: "POST",
                                dataType: "JSON",
                                beforeSend: function () {
                                    ci_helper.helper.blockUI('#topup-modal');
                                },
                                success: function (data) {
                                    ci_helper.helper.unblockUI('#topup-modal');
                                    let html = '',balance=parseInt($.session.get("balance")) + parseInt(nominal_topup);

                                    html += '<div class="text-center text-center my-3">' +
                                        '<i class="topup-berhasil-icon bi bi-check-circle-fill text-success"></i>' +
                                        '</div>';
                                    html += '<div class="text-center">Top Up sebesar</div>';
                                    html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + nominal_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                                    html += '<div class="text-center">' + data.message + '</div>';
                                    html += '<div class="text-center my-3"><a href="/dashboard" class="kembali-beranda-modal text-danger fw-medium">Kembali ke Beranda</a></div>';
                                    $("#topup-modal").find(".modal-body").html(html);
                                    $(".balance").html(balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    let html = '';
                                    html += '<div class="text-center text-center my-3">' +
                                        '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                        '</div>';
                                    html += '<div class="text-center">Top Up sebesar</div>';
                                    html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + nominal_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                                    html += '<div class="text-center">' + jqXHR.responseJSON.message + '</div>';
                                    html +='<div class="text-center my-3"><a href="#" data-bs-dismiss="modal" class="batalkan-topup-modal text-secondary">Tutup</a></div>';
                                    $("#topup-modal").find(".modal-body").html(html);
                                    ci_helper.helper.unblockUI('#topup-modal');
                                }
                            });
                        }
                    });
                $(document).on(
                    "click",
                    ".btn-nominal-topup",
                    function (e) {
                        let nominal_topup = $('.nominal-topup').val(), html = '';
                        html += '<div class="text-center text-center my-3">' +
                            '<img class="align-top me-2" src="../assets/img/Logo.png" alt="Logo.png">' +
                            '</div>';
                        html += '<div class="text-center">Anda yakin untuk Top Up sebesar</div>';
                        html += '<div class="nominal-modal text-center fs-4 fw-bold">Rp ' + nominal_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '</div>';
                        html += '<div class="text-center mt-4"><a href="#" class="lanjutkan-topup-modal text-danger fw-medium">Ya, lanjutkan Bayar</a></div>';
                        html += '<div class="text-center my-3"><a href="#" class="batalkan-topup-modal text-secondary" data-bs-dismiss="modal">Batalkan</a></div>';

                        $("#topup-modal").find(".modal-body").html(html);
                        $("#topup-modal").modal("show");
                    });
            });
        })
    </script>

<?php $this->endSection() ?>