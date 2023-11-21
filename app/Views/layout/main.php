<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>SIMS PPOB - Adhitya Sukma</title>
    <script type="text/javascript" src="/assets/vendor/jquery/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/owl.theme.default.min.css">
    <script type="text/javascript" src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/vendor/jquery-blockui/jquery.blockUI.js"></script>
    <script src="/assets/vendor/jquery.session.js"></script>
    <script src="/assets/js/helper.js"></script>
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="py-4 bg-body-tertiary">
<header class="top-header mb-5">
    <div class="d-flex border-bottom px-5">
        <div class="col-4">
            <div class="h3 mb-3 fw-normal"><a href="/dashboard"><img class="align-top me-2" src="../assets/img/Logo.png"
                                                                     alt="Logo.png"><span
                            class="logo-text align-top">SIMS PPOB -  Adhitya Sukma</span></a></div>
        </div>
        <div class="col-8 text-end top-header-right">
            <ul>
                <li><a class="<?php echo (uri_string() == "topup") ? 'active' : '' ?>" href="/topup">Top Up</a></li>
                <li><a class="<?php echo (uri_string() == "transaction") ? 'active' : '' ?>" href="/transaction">Transaction</a>
                </li>
                <li><a class="<?php echo (uri_string() == "profile") ? 'active' : '' ?>" href="/profile">Akun</a></li>
            </ul>
        </div>
    </div>
</header>
<main class="main-content w-100 px-5">
    <?php if(uri_string() !== "profile"):?>
    <div class="d-flex">
        <div class="section-profile col-5">

        </div>
        <div class="section-total-saldo col-7">
            <div class="rounded p-3 mb-2 bg-danger text-white">
                <div>Saldo anda</div>
                <div>
                    <span class="currency fw-bold fs-4">Rp </span><span
                            class="nominal fw-bold fs-4 balance">0</span>
                </div>
                <div class="lihat-saldo">Lihat saldo <i class="fa fa-eye"></i></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php echo $this->renderSection('content'); ?>
</main>
<div class="modal fade modal-container" id="main-modal" tabindex="-1" aria-labelledby="main-modalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#main-modal").modal({backdrop: 'static', keyboard: false})
        if(typeof $.session.get("token") == "undefined"){
            window.location.href = '<?php echo site_url("/logout")?>';
        }
        $(document).on(
            "click",
            ".password_show_hide",
            function (e) {
                if ($(this).hasClass("fa-eye")) {
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                    $("input[name='password']").attr("type", "text");
                } else {
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                    $("input[name='password']").attr("type", "password");
                }
            });
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
                ci_helper.helper.unblockUI('html');
                let profile_image;
                if (typeof response.data !== "undefined") {
                    profile_image = response.data.profile_image;
                    const pathArray = profile_image.split("/");
                    if (pathArray.at(-1) == "null") {
                        profile_image = "<?php echo site_url("../assets/img/profile/Profile Photo.png")?>";
                    }
                    $.session.set("user_profile_image",profile_image);
                }
                $.session.set("user_email",response.data.email);
                $.session.set("user_first_name",response.data.first_name);
                $.session.set("user_last_name",response.data.last_name);

                let html = '';
                html += '<img class="align-top profile-photo hide me-2" src="' + profile_image + '" alt="' + profile_image + '">';
                html += '<div class="mt-2 profile-title">Selamat datang, </div><div class="fw-medium fs-4 profile-name">' + response.data.first_name + ' ' + response.data.last_name + '</div>';
                $(".section-profile").html(html);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if(typeof jqXHR.responseJSON.message !== "undefined"){
                    let html ='';
                    html += '<div class="text-center text-center my-3">' +
                        '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                        '</div>';
                    html += '<div class="text-center">' + jqXHR.responseJSON.message + '</div>';
                    html += '<div class="text-center my-3"><a href="/" class="kembali-login-modal text-danger fw-medium">Kembali ke Login</a></div>';
                    $("#main-modal").find(".modal-body").html(html);
                    $("#main-modal").modal("show");
                    $.session.clear();
                }
            }
        });
        jQuery.ajax({
            url: "https://take-home-test-api.nutech-integrasi.app/balance",
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
                let balance;
                if (typeof response.data !== "undefined") {
                    $.session.set("balance",response.data.balance);
                    balance = response.data.balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }

                $(".balance").html(balance);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                ci_helper.helper.unblockUI('html');
            }
        });

        /** Banners **/
        jQuery.ajax({
            url: "https://take-home-test-api.nutech-integrasi.app/banner",
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
                let banners, html = '';
                if (typeof response.data !== "undefined") {
                    $.each(response.data, function (i, v) {
                        html += '<div class="item"><img src="' + v.banner_image + '" class="banners_icon"></div>';
                    });
                }
                $(".banners").html(html);
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
            },
            error: function (jqXHR, textStatus, errorThrown) {
                ci_helper.helper.unblockUI('html');
            }
        });

        $(document).on(
            "click",
            ".kembali-login-modal",
            function (e) {
                window.location.href = '<?php echo site_url("/logout")?>';
            });
    })
</script>
</body>
</html>