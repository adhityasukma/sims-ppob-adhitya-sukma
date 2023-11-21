<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>SIMS PPOB Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <script type="text/javascript" src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/vendor/jquery-blockui/jquery.blockUI.js"></script>
    <script src="/assets/vendor/jquery.session.js"></script>
    <script src="/assets/js/helper.js"></script>
    <!-- Custom styles for this template -->
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-login w-100 mx-5 px-5">
    <div class="row">
        <div class="col col-left">
            <div class="col-6 align-self-center">
                <div class="h3 mb-3 fw-normal text-center"><img class="align-middle me-2" src="../assets/img/Logo.png"
                                                                alt="Logo.png"><span
                            class="align-middle text-logo">SIMS PPOB - Adhitya Sukma</span></div>
                <h1 class="h3 mb-3 fw-medium text-center">Masuk atau buat akun untuk memulai</h1>
                <div class="berhasil-pesan"></div>
                <form class="mt-5 login-form" method="post" action="/login">
                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               id="email">@</label>
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="masukan email anda" aria-label="email" aria-describedby="email">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" id="password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="password" class="form-control" placeholder="masukan password anda"
                               aria-label="password" aria-describedby="password">
                        <label class="input-group-text" id="password"><i
                                    class="password_show_hide fa fa-eye"></i></label>
                    </div>

                    <button class="btn-login btn btn-danger w-100 py-2 mt-4" type="button">Masuk</button>
                    <p class="my-3 text-body-secondary text-center">Belum punya akun? registrasi <a href="/registration"
                                                                                                    target="_self"
                                                                                                    class="text-danger fw-medium link-underline link-underline-opacity-0">di
                            sini</a></p>
                </form>
                <div class="error-pesan"></div>
            </div>

        </div>
        <div class="col col-right">
            <img class="thumbnail" src="../assets/img/Illustrasi Login.png" alt="Illustrasi Login.png">
        </div>
    </div>

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
        $(document).on(
            "click",
            ".btn-login",
            function (e) {
                $(".berhasil-pesan").html("");
                $(".error-pesan").html("");
                $.ajax({
                    url: "https://take-home-test-api.nutech-integrasi.app/login",
                    type: "POST",
                    data: $(".login-form").serializeArray(),
                    dataType: 'json',
                    beforeSend: function () {
                        ci_helper.helper.blockUI('html');
                    },
                    success: function (data) {
                        ci_helper.helper.unblockUI('html');
                        let token = data.data.token;
                        let html = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            data.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        $(html).appendTo($(".berhasil-pesan"));
                        $.session.set('token', token);
                        // ci_helper.helper.unblockUI('html');
                        jQuery.ajax({
                            url: "<?php echo site_url('set_session')?>",
                            type: "POST",
                            data:{
                                token:token
                            },
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('html');
                                if(data.status){
                                    window.location.href='<?php echo site_url("dashboard")?>';
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                    jqXHR.responseJSON.message +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                $(html).appendTo($(".error-pesan"));
                                ci_helper.helper.unblockUI('html');
                            }
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            jqXHR.responseJSON.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        $(html).appendTo($(".error-pesan"));
                        ci_helper.helper.unblockUI('html');
                    }
                });
            });

    })
</script>
</body>
</html>