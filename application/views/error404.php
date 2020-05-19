<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/favicon.png">


    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/open-sans/style.min.css"> <!-- common font  styles  -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/universe-admin/style.css"> <!-- universeadmin icon font styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/mdi/css/materialdesignicons.min.css"> <!-- meterialdesignicons -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/iconfont/style.css"> <!-- DEPRECATED iconmonstr -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/flatpickr/flatpickr.min.css"> <!-- original flatpickr plugin (datepicker) styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/simplebar/simplebar.css"> <!-- original simplebar plugin (scrollbar) styles  -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/tagify/tagify.css"> <!-- styles for tags -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/tippyjs/tippy.css"> <!-- original tippy plugin (tooltip) styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/select2/css/select2.min.css"> <!-- original select2 plugin styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css"> <!-- original bootstrap styles -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style.min.css" id="stylesheet"> <!-- universeadmin styles -->



    <script src="<?= base_url('assets'); ?>/js/ie.assign.fix.min.js"></script>
</head>

<body>
    <!-- add for rounded corners: form-controls-rounded -->

    <div class="error404-b">
        <div class="error404-b__body">
            <div>
                <h2 class="error404-b__heading">Ouch!</h2>
                <h3 class="error404-b__sub-heading">Halaman <strong class="text-decoration"><?= $uri; ?></strong> tidak ada</h3>
                <div class="error404-b__desc">
                    Anda mungkin mencari alamat URL yang salah, sudah dihapus atau halaman sudah dipindahkan<br>
                    Untuk itu, silahkan cari dengan benar atau <a href="<?= base_url(); ?>">kembali ke halaman utama</a>.
                </div>
            </div>
            <div class="error404-b__image-wrap mt-1">
                <img src="<?= base_url("assets"); ?>/img/404/01.png" alt="" class="error404-b__image">
            </div>
            <div class="mt-3">
                <p>Copyright &copy; <?= date('Y'); ?> <a href="https://instagram.com/aditiaspt" style="text-decoration:none">Aditia Saputra</a>.</p>
            </div>
        </div>
    </div>

</body>

</html>