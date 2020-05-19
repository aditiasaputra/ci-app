<div class="p-front__content">

    <div class="p-signup">
        <form class="p-signup__form" action="<?= base_url('auth/signup'); ?>" method="POST">
            <h2 class="p-signup__form-heading">Sign Up</h2>
            <div class="p-signup__form-content">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signup-full-name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="p-signup-full-name" placeholder="Nama Lengkap" name="nama" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signup-work-email">Email</label>
                        <input type="text" class="form-control" id="p-signup-work-email" placeholder="example@examplemail.com" name="email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signup-set-password">Set Password</label>
                        <input type="password" class="form-control" id="p-signup-set-password" placeholder="Password" name="password">
                        <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="p-signup-repeat-password">Ulangi Password</label>
                        <input type="password" class="form-control" id="p-signup-repeat-password" placeholder="Ulangi Password" name="ulangi_password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-info btn-block btn-lg p-signup__form-submit">Buat Akun!</button>
                </div>

                <div class="p-signup__form-links">
                    <div class="p-signup__form-link">
                        Sudah punya akun? <a href="<?= base_url(); ?>" class="link-info">Sign In</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>