<div class="p-front__content">

    <div class="p-signin">
        <?= $this->session->flashdata('auth_message'); ?>
        <!-- <form class="p-signin__form" action="<?= base_url(); ?>" method="POST"> -->
        <?= form_open(base_url(), ['class' => 'p-signin__form']); ?>
        <h2 class="p-signin__form-heading">Sign In</h2>
        <div class="p-signin__form-content">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="p-signin-work-email">Email Anda</label>
                    <input type="text" class="form-control" id="p-signin-work-email" placeholder="you@youremail.com" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="p-signin-set-password">Password</label>
                    <input type="password" class="form-control" id="p-signin-set-password" placeholder="Password" name="password">
                    <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                </div>
            </div>
            <!-- <div class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                    <label class="custom-control-label" for="remember">Ingat Saya</label>
                </div> -->
            <div>
                <button type="submit" class="btn btn-info btn-block btn-lg p-signin__form-submit">Login!</button>
            </div>
            <div class="p-signin__form-links">
                <div class="p-signin__form-link">
                    Belum punya akun? <a href="<?= base_url("signup"); ?>" class="link-info">Sign Up</a>
                </div>
            </div>
        </div>
        <!-- </form> -->
        <?= form_close(); ?>
    </div>

</div>