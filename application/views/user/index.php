        <?= $this->session->flashdata('auth_message'); ?>
        <?= $this->session->flashdata('message'); ?>

        <div class="page-content">

            <div class="container-fluid">
                <div class="page-content__header">
                    <div>
                        <h2 class="page-content__header-heading"><?= $title; ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card-widget card-widget-g">
                            <a href="#" class="card-widget-g__avatar">
                                <img src="<?= base_url("/assets/img/avatars/{$user['image']}"); ?>" alt="" class="card-widget-g__image rounded-circle">
                            </a>
                            <a href="#" class="card-widget-g__name"><?= $user['nama']; ?></a>
                            <span class="card-widget-g__desc"><strong>Jabatan:</strong> Web Programmer
                            </span>
                            <span class="card-widget-g__desc">
                                <strong>Bergabung:</strong> <?= date('d-m-Y', $user['date_created']); ?> | <?= date('H:i:s', $user['date_created']); ?>
                            </span>
                            <a href="#" class="card-widget-g__website-link">https://www.example.com</a>
                            <a href="<?= base_url("user/edit"); ?>" class="btn btn-info card-widget-g__action-link">Ubah Profil</a>
                            <div class="card-widget-g__links">
                                <a href="#" class="ua-icon-twitter-square card-widget-g__link card-widget-g__link--twitter"></a>
                                <a href="#" class="ua-icon-facebook-square card-widget-g__link card-widget-g__link--facebook"></a>
                                <a href="#" class="ua-icon-social-instagram card-widget-g__link card-widget-g__link--instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>