<?php

$this->extend('layout\main');

$this->section('content') ?>
    <div class="d-flex">
        <div class="section-profile col-5">
            <?php
            if (empty($data['user']['profile_image'])):?>
                <img class="align-top me-2" src="../assets/img/profile/Profile Photo.png"
                     alt="Profile Photo.png">
            <?php
            else:?>
                <img class="align-top me-2" src="<?php echo $data['user']['profile_image'] ?>"
                     alt="Profile Photo.png">
            <?php
            endif;
            ?>
            <div class="mt-2">
                Selamat datang,
            </div>
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
    <div class="section-service mt-4">
        <div class="row justify-content-between">
            <?php
            if ($data['services']):?>
                <?php foreach ($data['services'] as $sv): ?>
                    <div class="col text-center my-3">
                        <a href="/services/<?php echo strtolower($sv['service_code']); ?>">
                            <img src="<?php echo $sv['service_icon'] ?>" class="service_icon">
                            <div class="service_name px-4"><?php echo $sv['service_name']; ?></div>
                        </a>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
    <div class="section-banners mt-4">
        <div class="fw-medium mb-3">Temukan promo menarik</div>
        <div class="owl-carousel owl-theme">
            <?php
            if ($data['banners']):?>
                <?php foreach ($data['banners'] as $sv): ?>
                    <div class="item">
                        <img src="<?php echo $sv['banner_image'] ?>" class="banners_icon">
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function (e) {
                $('.owl-carousel').owlCarousel({
                    margin: 10,
                    loop: true,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
            });
        })
    </script>
<?php $this->endSection() ?>