<?php

$this->extend('layout/main');

$this->section('content') ?>
    <div class="section-akun row">
        <div class="content-akun text-center"></div>
        <div class="section-form-profile mt-4 col-6 m-auto">
            <div class="pesan">
            </div>
            <form class="mt-5 form-akun" method="post"
                  action="https://take-home-test-api.nutech-integrasi.app/profile/update"
                  enctype="application/x-www-form-urlencoded">
                <?= csrf_field() ?>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Email</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text">@</label>
                    <input type="email" name="email" id="email"
                           class="form-control email"
                           placeholder="masukan email anda" aria-label="email" aria-describedby="email" required
                           disabled>
                    <div class="invalid-feedback text-end">
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Nama Depan</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text"
                           id="first_name"><i class="fa fa fa-user"></i></label>
                    <input type="text" name="first_name"
                           class="form-control"
                           placeholder="nama depan" aria-label="first_name" aria-describedby="first_name" disabled
                           required>
                    <div class="invalid-feedback text-end">
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Nama Belakang</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text"
                           id="last_name"><i class="fa fa fa-user"></i></label>
                    <input type="text" name="last_name"
                           class="form-control"
                           placeholder="nama belakang" aria-label="last_name" aria-describedby="last_name" disabled
                           required>
                    <div class="invalid-feedback text-end">
                    </div>
                </div>
                <input class="btn-1 btn-edit-profile btn btn-outline-danger w-100 py-2 mt-4" type="button"
                       value="Edit Profile">
                <a href="#" class="btn-2 btn-logout btn btn-danger text-light w-100 py-2 mt-4">Logout</a>
            </form>
        </div>
    </div>

    <div class="modal fade modal-container" id="akun-modal" tabindex="-1" aria-labelledby="akun-modalLabel"
         aria-hidden="true">
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
                if ($.session.get("user_email")) {
                    $("input[name='email']").val($.session.get("user_email"));
                }
                if ($.session.get("user_first_name")) {
                    $("input[name='first_name']").val($.session.get("user_first_name"));
                }
                if ($.session.get("user_last_name")) {
                    $("input[name='last_name']").val($.session.get("user_last_name"));
                }
                if ($.session.get("user_profile_image")) {
                    let html = '';
                    html += '<div class="row-profile">' +
                        '<a href="#" class="ubah_photo_profile">' +
                        '<img class="align-top me-2 rounded-circle border img-thumbnail" src="' + $.session.get("user_profile_image") + '" alt="' + $.session.get("user_profile_image") + '">' +
                        '<i class="bi bi-pencil-fill rounded-circle border icon-ubah-photo"></i>' +
                        '</a>' +
                        '</div>';
                    html += '<form class="akun-update-photo">' +
                        '<input type="file" name="file" id="uploadFile" class="img uploadFile"/>' +
                        '</form>';
                    if ($.session.get("user_first_name") && $.session.get("user_last_name")) {
                        html += '<div class="fw-medium akun-name fs-4 mt-3">';
                        html += $.session.get("user_first_name") + ' ' + $.session.get("user_last_name");
                        html += '</div>';
                    }
                    $(".content-akun").html(html);
                }
                $(document).on(
                    "mouseover",
                    ".ubah_photo_profile",
                    function (e) {
                        $(".icon-ubah-photo").show().css("display", 'inline-flex');
                    }).on(
                    "mouseleave",
                    ".ubah_photo_profile",
                    function (e) {
                        $(".icon-ubah-photo").hide();
                    });

                $(document).on(
                    "click",
                    ".ubah_photo_profile",
                    function (e) {
                        e.preventDefault();
                        $("#uploadFile").trigger('click');
                    });
                $(document).on(
                    "click",
                    ".btn-logout",
                    function (e) {
                        e.preventDefault();
                        $.session.clear();
                        window.location.href = '<?php echo site_url("/logout")?>';
                    });
                $(document).on(
                    "click",
                    ".btn-1",
                    function (e) {
                        if ($(this).hasClass("btn-edit-profile")) {
                            e.preventDefault();
                            if ($(".btn-2").hasClass("btn-logout")) {
                                $(".btn-2").removeClass("btn-logout").addClass("btn-back-e-profile").attr("href", "#").html("Batalkan");
                            }
                            $(this).removeClass("btn-edit-profile").addClass("btn-update-profile").attr("type", "submit").val("Simpan");
                            $(".form-akun").find("input").not(".email").removeAttr("disabled");

                        }

                    });
                $(document).on(
                    "click",
                    ".btn-2",
                    function (e) {
                        if ($(this).hasClass("btn-back-e-profile")) {
                            e.preventDefault();
                            $(this).removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                        }
                        if ($('.btn-1').hasClass("btn-update-profile")) {
                            $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                        }
                        $(".form-akun").find("input").not(".btn-1").attr("disabled", "disabled");
                    });
                $(document).on(
                    "click",
                    ".btn-back-e-profile",
                    function (e) {
                        e.preventDefault();
                        if ($.session.get("user_email")) {
                            $("input[name='email']").val($.session.get("user_email"));
                        }
                        if ($.session.get("user_first_name")) {
                            $("input[name='first_name']").val($.session.get("user_first_name"));
                        }
                        if ($.session.get("user_last_name")) {
                            $("input[name='last_name']").val($.session.get("user_last_name"));
                        }
                        if ($('.btn-2').hasClass("btn-back-e-profile")) {
                            $('.btn-2').removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                        }
                        if ($('.btn-1').hasClass("btn-update-profile")) {
                            $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                        }
                        $(".form-akun").find("input").not(".btn-1").not(".email").attr("disabled", "disabled");
                    });
                $(document).on(
                    "click",
                    ".btn-update-profile",
                    function (e) {
                        e.preventDefault();
                        let formData = new FormData($(".form-akun")[0]);
                        jQuery.ajax({
                            url: "https://take-home-test-api.nutech-integrasi.app/profile/update",
                            data: {
                                first_name: $("input[name='first_name']").val(),
                                last_name: $("input[name='last_name']").val(),
                            },
                            headers: {
                                Authorization: 'Bearer ' + $.session.get('token')
                            },
                            type: "PUT",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (response) {
                                ci_helper.helper.unblockUI('html');

                                let html = '';
                                $.session.set("user_email", response.data.email);
                                $.session.set("user_first_name", response.data.first_name);
                                $.session.set("user_last_name", response.data.last_name);

                                $(".akun-name").html(response.data.first_name + " " + response.data.last_name);

                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="modal-icon bi bi-check-circle-fill text-success"></i>' +
                                    '</div>';
                                html += '<div class="text-center">' + response.message + '</div>';
                                html += '<div class="text-center my-3"><a href="#" class="text-secondary fw-medium" data-bs-dismiss="modal">Tutup</a></div>';
                                $("#main-modal").find(".modal-body").html(html);
                                $("#main-modal").modal("show");

                                if ($('.btn-2').hasClass("btn-back-e-profile")) {
                                    $('.btn-2').removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                                }
                                if ($('.btn-1').hasClass("btn-update-profile")) {
                                    $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                                }
                                $(".form-akun").find("input").not(".btn-1").not(".email").attr("disabled", "disabled");
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                let html = '';
                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                    '</div>';
                                html += '<div class="text-center">' + jqXHR.responseJSON.message + '</div>';
                                html += '<div class="text-center my-3"><a href="#" class="text-secondary fw-medium" data-bs-dismiss="modal">Tutup</a></div>';
                                $("#main-modal").find(".modal-body").html(html);
                                $("#main-modal").modal("show");
                                if ($.session.get("user_first_name")) {
                                    $("input[name='first_name']").val($.session.get("user_first_name"));
                                }
                                if ($.session.get("user_last_name")) {
                                    $("input[name='last_name']").val($.session.get("user_last_name"));
                                }
                                if ($('.btn-2').hasClass("btn-back-e-profile")) {
                                    $('.btn-2').removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                                }
                                if ($('.btn-1').hasClass("btn-update-profile")) {
                                    $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                                }
                                $(".form-akun").find("input").not(".btn-1").not(".email").attr("disabled", "disabled");
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                    });
                $("#akun-modal").modal({backdrop: 'static', keyboard: false});
                $("input:file").change(function () {
                    let formData = new FormData($('.akun-update-photo')[0]),
                        filesize = ci_helper.helper.formatBytes($("input[type='file']")[0].files[0].size, 2);
                    if (filesize > 100) {
                        let html = '';
                        html += '<div class="text-center text-center my-3">' +
                            '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                            '</div>';
                        html += '<div class="text-center">Maksimum ukuran image yang diupload dibawah 100 kb</div>';
                        html += '<div class="text-center my-3"><a href="#" class="text-secondary fw-medium" data-bs-dismiss="modal">Tutup</a></div>';
                        $("#main-modal").find(".modal-body").html(html);
                        $("#main-modal").modal("show");
                    } else {
                        $.ajax({
                            url: "https://take-home-test-api.nutech-integrasi.app/profile/image",
                            data: formData,
                            contentType: false,
                            processData: false,
                            type: "PUT",
                            dataType: "JSON",
                            headers: {
                                Authorization: 'Bearer ' + $.session.get('token')
                            },
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (response) {
                                ci_helper.helper.unblockUI('html');
                                let profile_image, htmlp = '', html = '';
                                if (typeof response.data !== "undefined") {
                                    profile_image = response.data.profile_image;
                                    const pathArray = profile_image.split("/");
                                    if (pathArray.at(-1) == "null") {
                                        profile_image = "<?php echo site_url("../assets/img/profile/Profile Photo.png")?>";
                                    }
                                    $.session.set("user_profile_image", profile_image);
                                }

                                $(".ubah_photo_profile").find("img").attr("src", response.data.profile_image);
                                $(".ubah_photo_profile").find("img").attr("alt", response.data.profile_image);

                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="modal-icon bi bi-check-circle-fill text-success"></i>' +
                                    '</div>';
                                html += '<div class="text-center">' + response.message + '</div>';
                                html += '<div class="text-center my-3"><a href="#" class="text-secondary fw-medium" data-bs-dismiss="modal">Tutup</a></div>';
                                $("#akun-modal").find(".modal-body").html(html);
                                $("#akun-modal").modal("show");
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                let html = '';
                                html += '<div class="text-center text-center my-3">' +
                                    '<i class="topup-gagal-icon bi bi-x-circle-fill"></i>' +
                                    '</div>';
                                html += '<div class="text-center">' + jqXHR.responseJSON.message + '</div>';
                                html += '<div class="text-center my-3"><a href="#" class="text-secondary fw-medium" data-bs-dismiss="modal">Tutup</a></div>';
                                $("#main-modal").find(".modal-body").html(html);
                                $("#main-modal").modal("show");
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                    }
                });
            });
        })
    </script>

<?php $this->endSection() ?>