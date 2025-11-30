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
                    if ($data['nominal']):
                        foreach ($data['nominal'] as $nominal):
                            ?>
                            <div class="col-4 mb-3">
                                <button type="button"
                                        class="nominal_topup btn btn-outline-secondary rounded"
                                        data-nominal="<?php echo $nominal; ?>">
                                    Rp <?php echo number_format($nominal, 0, ',', "."); ?></button>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-container" id="topup-modal" tabindex="-1" aria-labelledby="topup-modalLabel" aria-hidden="true">
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
                        let nominal_topup = $('.nominal-topup').val();
                        $.ajax({
                            url: "<?php echo site_url('topup')?>",
                            data: {
                                top_up_amount: nominal_topup
                            },
                            type: "POST",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('#topup-modal');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('#topup-modal');
                                if (!data.status) {
                                    $("#topup-modal").find(".modal-content").html(data.pesan);
                                    $("#topup-modal").modal("show");
                                }else{
                                    $("#topup-modal").find(".modal-content").html(data.pesan);
                                    $("#topup-modal").modal("show");
                                    $(".section-total-saldo .nominal").html(data.total_saldo_user);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('#topup-modal');
                            }
                        });
                    });
                $(document).on(
                    "click",
                    ".btn-nominal-topup",
                    function (e) {
                        let nominal_topup = $('.nominal-topup').val();
                        $.ajax({
                            url: "<?php echo site_url('topup_content/')?>"+nominal_topup,
                            type: "GET",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('html');
                                $("#topup-modal").find(".modal-content").html(data.pesan);
                                $("#topup-modal").modal("show");
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                        console.log(nominal_topup)

                    });
            });
        })
    </script>

<?php $this->endSection() ?>