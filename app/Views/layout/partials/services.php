<?php

$this->extend('layout\main');

$this->section('content') ?>
<div class="d-flex">
        <div class="section-profile col-5">
            <?php
            if (empty($data['user']['profile_image'])):?>
                <img class="align-top me-2" src="../assets/img/profile/Profile Photo.png"
                     alt="Profile Photo.png">
                <div class="mt-2">
                    Selamat datang,
                </div>
            <?php
            else:?>
                <img class="align-top me-2" src="<?php echo $data['user']['profile_image'] ?>"
                     alt="Profile Photo.png">
            <?php
            endif;
            ?>
            <div class="fw-medium fs-4">
                <?php echo $data['user']['first_name'] . " " . $data['user']['last_name']; ?>
            </div>
        </div>
        <div class="section-total-saldo col-7">
            <div class="rounded p-3 mb-2 bg-danger text-white">
                <div>Saldo anda</div>
                <div><?php
                    if (!isset($data['balance']['balance'])):?>
                        <span class="currency fw-bold fs-4">Rp </span><span
                                class="nominal fw-bold fs-4"><?php echo format_rupiah(0); ?></span>

                    <?php
                    else:?>
                        <span class="currency fw-bold fs-4">Rp </span><span
                                class="nominal fw-bold fs-4"><?php echo format_rupiah($data['balance']['balance']); ?></span>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="lihat-saldo">Lihat saldo <i class="fa fa-eye"></i></div>
            </div>
        </div>
    </div>
    <div class="section-ts mt-4">
        <div>Pembayaran</div>
        <div class="d-flex">
            <img class="align-middle me-2" src="<?php echo $data['services']['service_icon']?>"
                 alt="<?php echo $data['services']['service_icon']?>"><span
                    class="logo-service pt-1 fw-medium"><?php echo $data['services']['service_name']?></span>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <label class="input-group-text" id="password"><i class="fa fa-cash-register"></i></label>
                    <input type="text" class="nominal-ts form-control" disabled name="ts" value="<?php echo $data['services']['service_tariff'];?>">
                </div>
                <div class="input-group mb-3">
                    <button type="button" class="btn-nominal-ts btn btn-danger" data-service="<?php echo $data['services']['service_name']?>">Bayar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-container" id="ts-modal" tabindex="-1" aria-labelledby="ts-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                $("#ts-modal").modal({backdrop: 'static', keyboard: false})
                $(document).on(
                    "click",
                    ".lanjutkan-ts-modal",
                    function (e) {
                        e.preventDefault();
                        let service_code = $(this).attr("data-code");
                        $.ajax({
                            url: "<?php echo site_url('transaction')?>",
                            data: {
                                service_code: service_code
                            },
                            type: "POST",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('#ts-modal');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('#ts-modal');
                                if (!data.status) {
                                    $("#ts-modal").find(".modal-content").html(data.pesan);
                                    $("#ts-modal").modal("show");
                                }else{
                                    $("#ts-modal").find(".modal-content").html(data.pesan);
                                    $("#ts-modal").modal("show");
                                    $(".section-total-saldo .nominal").html(data.total_saldo_user);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('#ts-modal');
                            }
                        });
                    });
                $(document).on(
                    "click",
                    ".btn-nominal-ts",
                    function (e) {
                        let nominal_ts = $('.nominal-ts').val();
                        let service_name = $(this).attr("data-service");
                        $.ajax({
                            url: "<?php echo site_url('ts_content/')?>"+nominal_ts +"/"+service_name,
                            type: "GET",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('html');
                                $("#ts-modal").find(".modal-content").html(data.pesan);
                                $("#ts-modal").modal("show");
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('html');
                            }
                        });

                    });
            });
        })
    </script>

<?php $this->endSection() ?>