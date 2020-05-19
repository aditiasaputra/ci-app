<?= $this->session->flashdata('message'); ?>

<div class="page-content">

    <div class="container-fluid">
        <div class="page-content__header">
            <div>
                <h2 class="page-content__header-heading"><?= $title; ?></h2>
            </div>
        </div>
        <div class="main-container container-fh__content">
            <?= form_open('user/ubahpassword') ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password_lama">Masukkan Password Lama</label>
                            <input id="password_lama" type="password" class="form-control" name="password_lama">
                            <?= form_error('password_lama', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="password_baru1">Masukkan Password Baru</label>
                            <input id="password_baru1" type="password" class="form-control" name="password_baru1">
                            <?= form_error('password_baru1', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="password_baru2">Ulangi Password</label>
                            <input id="password_baru2" type="password" class="form-control" name="password_baru2">
                            <?= form_error('password_baru2', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-lg" type="submit">
                                Simpan!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>

</div>