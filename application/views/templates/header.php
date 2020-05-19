<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/favicon.png">


    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/open-sans/style.min.css"> <!-- common font  styles  -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/universe-admin/style.css"> <!-- universeadmin icon font styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/mdi/css/materialdesignicons.min.css"> <!-- meterialdesignicons -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/iconfont/style.css"> <!-- DEPRECATED iconmonstr -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/flatpickr/flatpickr.min.css">
    <!-- original flatpickr plugin (datepicker) styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/simplebar/simplebar.css"> <!-- original simplebar plugin (scrollbar) styles  -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/tagify/tagify.css"> <!-- styles for tags -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/tippyjs/tippy.css"> <!-- original tippy plugin (tooltip) styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/select2/css/select2.min.css"> <!-- original select2 plugin styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/croppie/css/croppie.css"> <!-- original croppie plugin styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/datatables/datatables.min.css">

    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css"> <!-- original bootstrap styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style.min.css" id="stylesheet"> <!-- universeadmin styles -->

    <script src="<?= base_url('assets'); ?>/js/ie.assign.fix.min.js"></script>

</head>

<body>
    <!-- add for rounded corners: form-controls-rounded -->


    <div class="navbar navbar-light navbar-expand-lg">
        <button class="sidebar-toggler" type="button">
            <span class="ua-icon-sidebar-open sidebar-toggler__open"></span>
            <span class="ua-icon-alert-close sidebar-toggler__close"></span>
        </button>

        <span class="navbar-brand">
            <a href="<?= base_url("admin"); ?>"><img src="<?= base_url('assets'); ?>/img/logo.png" alt="" class="navbar-brand__logo"></a>
        </span>

        <span class="navbar-brand-sm">
            <a href="/"><img src="<?= base_url('assets'); ?>/img/logo-sm.png" alt="" class="navbar-brand__logo"></a>
            <span class="ua-icon-menu slide-nav-toggle"></span>
        </span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="ua-icon-navbar-open navbar-toggler__open"></span>
            <span class="ua-icon-alert-close navbar-toggler__close"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="navbar__menu">

            </div>
            <div class="dropdown navbar-dropdown no-arrow navbar-help-dropdown navbar-notify-dropdown--help">
                <a class="dropdown-toggle navbar-dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="navbar-notify">
                        <span>
                            <span class="navbar-notify__icon mdi mdi-help-circle"></span>
                            <span class="navbar-notify__text">Info</span>
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-center navbar-dropdown-menu">
                    <h6 class="navbar-help-dropdown__heading">Butuh bantuan?</h6>
                    <p class="navbar-help-dropdown__desc">
                        Hubungi: +6221-123456 (ext:123) <br> atau <br>
                        kirim email ke: <a href="#">admin@admin.com</a> <br>
                    </p>
                </div>
            </div>
            <div class="dropdown navbar-dropdown">
                <a class="dropdown-toggle navbar-dropdown-toggle navbar-dropdown-toggle__user" data-toggle="dropdown" href="#">
                    <img src="<?= base_url("/assets/img/avatars/{$user['image']}"); ?>" alt="" class="navbar-dropdown-toggle__user-avatar">
                    <span class="navbar-dropdown__user-name"><?= $user['nama']; ?></span>
                </a>
                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu__user">
                    <div class="navbar-dropdown-user-content">
                        <div class="dropdown-user__avatar"><img src="<?= base_url("/assets/img/avatars/{$user['image']}"); ?>" alt="" /></div>
                        <div class="dropdown-info">
                            <div class="dropdown-info__name"><?= $user['nama']; ?></div>
                            <div class="dropdown-info__job">Manager</div>
                            <div class="dropdown-info-buttons"><a class="dropdown-info__viewprofile" href="<?= base_url('user/edit'); ?>">View Profile</a><a class="dropdown-info__addaccount" href="#">Add account</a></div>
                        </div>
                    </div>
                    <a class="dropdown-item navbar-dropdown__item" href="#">Settings</a>
                    <a class="dropdown-item navbar-dropdown__item" id="signout" href="<?= base_url('auth/signout'); ?>">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-wrap">