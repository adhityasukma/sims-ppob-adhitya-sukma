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
    <div class="section-th mt-4">
        <div class="fw-medium">Semua Transaksi</div>
        <div class="th-content">
            <?php if ($data['history']): ?>
                <?php foreach ($data['history'] as $thv): ?>
                    <div class="d-flex mt-4 border rounded px-3 py-2">
                        <div class="col-6">
                            <div class="row">
                                <div class="<?php echo $thv['type_class']; ?> fw-medium th-nominal"><?php echo $thv['total_amount']; ?></div>
                            </div>
                            <div class="row">
                                <div class="text-body-tertiary fw-medium th-date"><?php echo $thv['created_on']; ?></div>
                            </div>
                        </div>
                        <div class="col-6 py-2">
                            <div class="th-type text-end py-2 fw-medium"><?php echo $thv['description']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (!$data['hide_showmore_btn']): ?>
                    <div class="row">
                        <a href="#" class="th-show-more text-danger fw-bold text-center mt-4"
                           data-limit="<?php echo $data['limit'] ?>">Show more</a>
                    </div>
                <?php endif; ?>
            <?php
            else:?>
                <div class="text-center text-body-tertiary">Maaf tidak ada histori transaksi</div>
            <?php endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                $(document).on(
                    "click",
                    ".th-show-more",
                    function (e) {
                        e.preventDefault();
                        let limit = $(this).attr("data-limit");
                        $.ajax({
                            url: "<?php echo site_url('history/')?>" + limit,
                            type: "GET",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('html');
                                $(".th-content").html(data.html);
                                // if (!data.status) {
                                //     $("#ts-modal").find(".modal-content").html(data.pesan);
                                //     $("#ts-modal").modal("show");
                                // }else{
                                //     $("#ts-modal").find(".modal-content").html(data.pesan);
                                //     $("#ts-modal").modal("show");
                                //     $(".section-total-saldo .nominal").html(data.total_saldo_user);
                                // }
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