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

    <!-- Custom styles for this template -->
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-registration w-100 mx-5 px-5">
    <div class="row">
        <div class="col col-left">
            <div class="col-6 align-self-center">
                <div class="h3 mb-3 fw-normal text-center"><img class="align-middle me-2" src="../assets/img/Logo.png"
                                                                alt="Logo.png"><span
                            class="align-middle text-logo">SIMS PPOB - Adhitya Sukma</span></div>
                <h1 class="h3 mb-3 fw-medium text-center">Lengkapi data untuk membuat akun</h1>
                <form class="mt-5" method="post" action="/registration">
                    <?= csrf_field() ?>
                    <?php
                    echo form_hidden('is_registration', true);
                    ?>
                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               id="email">@</label>
                        <input type="email" name="email"
                               class="form-control <?php echo isset(session()->get("errors")['email']) ? 'is-invalid' : '' ?>"
                               placeholder="masukan email anda" aria-label="email" aria-describedby="email" required value="<?php echo set_value("email");?>">
                        <div class="invalid-feedback text-end">
                            <?php
                            if(isset(session()->get("errors")['email'])):
                                echo session()->getFlashdata('errors')['email'];
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               id="first_name"><i class="fa fa fa-user"></i></label>
                        <input type="text" name="first_name"
                               class="form-control <?php echo isset(session()->get("errors")['first_name']) ? 'is-invalid' : '' ?>"
                               placeholder="nama depan" aria-label="first_name" aria-describedby="first_name" required value="<?php echo set_value("first_name");?>">
                        <div class="invalid-feedback text-end">
                            <?php
                            if(isset(session()->get("errors")['first_name'])):
                                echo session()->getFlashdata('errors')['first_name'];
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               id="last_name"><i class="fa fa fa-user"></i></label>
                        <input type="text" name="last_name"
                               class="form-control <?php echo isset(session()->get("errors")['last_name']) ? 'is-invalid' : '' ?>"
                               placeholder="nama belakang" aria-label="last_name" aria-describedby="last_name" required value="<?php echo set_value("last_name");?>">
                        <div class="invalid-feedback text-end">
                            <?php
                            if(isset(session()->get("errors")['last_name'])):
                                echo session()->getFlashdata('errors')['last_name'];
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               id="password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="password"
                               class="form-control password <?php echo isset(session()->get("errors")['password']) ? 'is-invalid' : '' ?>"
                               placeholder="buat password" aria-label="password" aria-describedby="password" required>
                        <label class="input-group-text" id="password"><i class="password_show_hide fa fa-eye"></i></label>
                        <div class="invalid-feedback text-end">
                            <?php
                            if(isset(session()->get("errors")['password'])):
                                echo session()->getFlashdata('errors')['password'];
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" id="confirm_password"><i class="fa fa-lock"></i></label>
                        <input type="password" name="confirm_password" class="form-control password <?php echo isset(session()->get("errors")['confirm_password']) ? 'is-invalid' : '' ?>" placeholder="konfirmasi password"
                               aria-label="confirm_password" aria-describedby="confirm_password" required>
                        <label class="input-group-text" id="password"><i class="password_show_hide fa fa-eye"></i></label>
                        <div class="invalid-feedback text-end">
                            <?php
                            if(isset(session()->get("errors")['confirm_password'])):
                                echo session()->getFlashdata('errors')['confirm_password'];
                            endif;
                            ?>
                        </div>
                    </div>

                    <button class="btn btn-danger w-100 py-2 mt-4" type="submit">Registrasi</button>
                    <p class="my-3 text-body-secondary text-center">Sudah punya akun? login <a href="/" target="_self" class="text-danger fw-medium link-underline link-underline-opacity-0">di sini</a></p>
                </form>
                <?php
                if (session()->get("error_email")) {
                    ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    echo session()->getFlashdata('error_email');
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    session()->destroy();
                }
                ?>
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
    jQuery(function($){
        $(document).on(
            "click",
            ".password_show_hide",
            function (e) {
                if($(this).hasClass("fa-eye")) {
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                    $(this).parent("label").prev("input.password").attr("type", "text");
                }else{
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                    $(this).parent("label").prev("input.password").attr("type", "password");
                }
            });

    })
</script>
</body>
</html>