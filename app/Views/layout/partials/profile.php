<?php

$this->extend('layout\main');

$this->section('content') ?>
    <div class="section-akun row">
        <div class="text-center">
            <?php
            if (empty($data['user']['profile_image'])):?>
                <div class="row-profile">
                    <a href="#" class="ubah_photo_profile">
                        <img class="align-top me-2 rounded-circle border img-thumbnail"
                             src="../assets/img/profile/Profile Photo.png"
                             alt="Profile Photo.png">
                        <i class="bi bi-pencil-fill rounded-circle border icon-ubah-photo"></i>

                    </a>
                </div>
            <?php
            else:?>
                <div class="row-profile">
                    <a href="#" class="ubah_photo_profile">
                        <img class="align-top me-2 rounded-circle border img-thumbnail"
                             src="<?php echo $data['user']['profile_image'] ?>"
                             alt="<?php echo $data['user']['profile_image'] ?>">
                        <i class="bi bi-pencil-fill rounded-circle border icon-ubah-photo"></i>
                    </a>
                </div>
            <?php
            endif;
            ?>
            <form class="akun-update-photo" method="post" enctype="application/x-www-form-urlencoded">
                <input type="file" name="profile_image" class="img uploadFile"/>
            </form>
            <div class="fw-medium akun-name fs-4 mt-3">
                <?php echo $data['user']['first_name'] . " " . $data['user']['last_name']; ?>
            </div>
        </div>
        <div class="section-form-profile mt-4 col-6 m-auto">
            <div class="pesan">
            </div>
            <form class="mt-5 form-akun" method="post" action="/profile/update"
                  enctype="application/x-www-form-urlencoded">
                <?= csrf_field() ?>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Email</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text">@</label>
                    <input type="email" name="email" id="email"
                           class="form-control <?php echo isset(session()->get("errors")['email']) ? 'is-invalid' : '' ?>"
                           placeholder="masukan email anda" aria-label="email" aria-describedby="email" required
                           disabled value="<?php echo $data['user']['email']; ?>">
                    <div class="invalid-feedback text-end">
                        <?php
                        if (isset(session()->get("errors")['email'])):
                            echo session()->getFlashdata('errors')['email'];
                        endif;
                        ?>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Nama Depan</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text"
                           id="first_name"><i class="fa fa fa-user"></i></label>
                    <input type="text" name="first_name"
                           class="form-control <?php echo isset(session()->get("errors")['first_name']) ? 'is-invalid' : '' ?>"
                           placeholder="nama depan" aria-label="first_name" aria-describedby="first_name" disabled
                           required value="<?php echo $data['user']['first_name']; ?>">
                    <div class="invalid-feedback text-end">
                        <?php
                        if (isset(session()->get("errors")['first_name'])):
                            echo session()->getFlashdata('errors')['first_name'];
                        endif;
                        ?>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label fw-medium">Nama Belakang</label>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text"
                           id="last_name"><i class="fa fa fa-user"></i></label>
                    <input type="text" name="last_name"
                           class="form-control <?php echo isset(session()->get("errors")['last_name']) ? 'is-invalid' : '' ?>"
                           placeholder="nama belakang" aria-label="last_name" aria-describedby="last_name" disabled
                           required value="<?php echo $data['user']['last_name']; ?>">
                    <div class="invalid-feedback text-end">
                        <?php
                        if (isset(session()->get("errors")['last_name'])):
                            echo session()->getFlashdata('errors')['last_name'];
                        endif;
                        ?>
                    </div>
                </div>
                <input class="btn-1 btn-edit-profile btn btn-outline-danger w-100 py-2 mt-4" type="button"
                       value="Edit Profile">
                <a href="/logout" class="btn-2 btn-logout btn btn-danger text-light w-100 py-2 mt-4">Logout</a>
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
                        $(".uploadFile").click();
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
                            $(".form-akun").find("input").removeAttr("disabled");
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
                        jQuery.ajax({
                            url: "<?php echo site_url('profile/get_data')?>",
                            type: "GET",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                console.log(data);
                                ci_helper.helper.unblockUI('html');
                                if (!data.status) {
                                    $(".pesan").html(data.pesan);
                                } else {
                                    $("input[name='email']").val(data.email);
                                    $("input[name='first_name']").val(data.first_name);
                                    $("input[name='last_name']").val(data.last_name);
                                    if ($('.btn-2').hasClass("btn-back-e-profile")) {
                                        $('.btn-2').removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                                    }
                                    if ($('.btn-1').hasClass("btn-update-profile")) {
                                        $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                                    }
                                    $(".form-akun").find("input").not(".btn-1").attr("disabled", "disabled");
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                        if ($(this).hasClass("btn-back-e-profile")) {

                            $(this).removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                        }
                        if ($('.btn-1').hasClass("btn-update-profile")) {
                            $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                        }
                        $(".form-akun").find("input").not(".btn-1").attr("disabled", "disabled");
                    });
                $(document).on(
                    "click",
                    ".btn-update-profile",
                    function (e) {
                        e.preventDefault();
                        let formData = new FormData($(".form-akun")[0]);
                        jQuery.ajax({
                            url: "<?php echo site_url('profile/update')?>",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: "POST",
                            dataType: "JSON",
                            beforeSend: function () {
                                ci_helper.helper.blockUI('html');
                            },
                            success: function (data) {
                                ci_helper.helper.unblockUI('html');
                                if (!data.status) {
                                    $(".pesan").html(data.pesan);
                                    // $("#akun-modal").find(".modal-content").html(data.pesan);
                                    // $("#akun-modal").modal("show");
                                } else {
                                    if ($('.btn-2').hasClass("btn-back-e-profile")) {
                                        $('.btn-2').removeClass("btn-back-e-profile").addClass("btn-logout").attr("href", "/logout").html("Logout");
                                    }
                                    if ($('.btn-1').hasClass("btn-update-profile")) {
                                        $(".btn-1").removeClass("btn-update-profile").addClass("btn-edit-profile").attr("type", "button").val("Edit Profile");
                                    }
                                    $(".form-akun").find("input").not(".btn-1").attr("disabled", "disabled");
                                    $(".pesan").html(data.pesan);
                                    $(".akun-name").html(data.akun_name);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert('Error get data from ajax');
                                ci_helper.helper.unblockUI('html');
                            }
                        });
                    });
                $("#akun-modal").modal({backdrop: 'static', keyboard: false});

                $(document).on('submit', '.akun-update-photo', function (e) {
                    // e.preventDefault();
                    let formData = new FormData($(this)[0]);
                    jQuery.ajax({
                        url: "<?php echo site_url('profile/image')?>",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        dataType: "JSON",
                        beforeSend: function () {
                            ci_helper.helper.blockUI('html');
                        },
                        success: function (data) {
                            ci_helper.helper.unblockUI('html');
                            if (!data.status) {
                                $("#akun-modal").find(".modal-content").html(data.pesan);
                                $("#akun-modal").modal("show");
                            } else {
                                $(".ubah_photo_profile").find("img").attr("src", data.img);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Error get data from ajax');
                            ci_helper.helper.unblockUI('html');
                        }
                    });
                    return false;
                });
                $(".uploadFile").on("change", function () {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
                    $(".akun-update-photo").submit();
                    // let formData = new FormData();
                    // formData.append('profile_image', files);
                    // console.log(files[0]);
                    //jQuery.ajax({
                    //    url: "<?php //echo site_url('profile/image')?>//",
                    //    data: {
                    //        profile_image: files[0]
                    //    },
                    //    type: "POST",
                    //    dataType: "JSON",
                    //    beforeSend: function () {
                    //        // ci_helper.helper.blockUI('#topup-modal');
                    //    },
                    //    success: function (data) {
                    //        // ci_helper.helper.unblockUI('#topup-modal');
                    //        // if (!data.status) {
                    //        //     $("#topup-modal").find(".modal-content").html(data.pesan);
                    //        //     $("#topup-modal").modal("show");
                    //        // }else{
                    //        //     $("#topup-modal").find(".modal-content").html(data.pesan);
                    //        //     $("#topup-modal").modal("show");
                    //        //     $(".section-total-saldo .nominal").html(data.total_saldo_user);
                    //        // }
                    //    },
                    //    error: function (jqXHR, textStatus, errorThrown) {
                    //        alert('Error get data from ajax');
                    //        // ci_helper.helper.unblockUI('#topup-modal');
                    //    }
                    //});
                });
            });
        })
    </script>

<?php $this->endSection() ?>