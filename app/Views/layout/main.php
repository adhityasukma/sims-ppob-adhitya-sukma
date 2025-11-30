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
                <li><a class="<?php echo (uri_string()=="topup")?'active':''?>" href="/topup">Top Up</a></li>
                <li><a class="<?php echo (uri_string()=="transaction")?'active':''?>" href="/transaction">Transaction</a></li>
                <li><a class="<?php echo (uri_string()=="profile")?'active':''?>" href="/profile">Akun</a></li>
            </ul>
        </div>
    </div>
</header>
<main class="main-content w-100 px-5">
<?php echo $this->renderSection('content');?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery(function ($) {
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
    })
</script>
</body>
</html>