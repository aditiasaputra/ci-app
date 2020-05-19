<div class="page-content">

    <div class="container-fluid">
        <div class="page-content__header">
            <div>
                <h2 class="page-content__header-heading"><?= $title; ?></h2>
            </div>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="main-container container-fh__content">
            <?= form_open_multipart() ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="form-control" placeholder="Contoh: your@youremail.com" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control" placeholder="Contoh: Budi Setiawan" name="nama" value="<?= $user['nama']; ?>">
                            <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="ttl">Tempat Tanggal Lahir (TTL)</label>
                            <input id="ttl" type="text" class="form-control" placeholder="Contoh: Jakarta, 19 Oktober 2000" name="ttl" value="<?= $user['tempat']; ?>,<?= $user['tgl_lahir']; ?>">
                            <?= form_error('ttl', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input id="jabatan" type="text" class="form-control" placeholder="Contoh: IT Support" name="jabatan" value="<?= $user['jabatan']; ?>">
                            <?= form_error('jabatan', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="jenis_kelamin form-control" name="jenis_kelamin">
                                <option value="Pria">Pria</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="agama form-control" name="agama">
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time-mask">No. Handphone/Telepon <span class="form-label__desc">jumlah digit: 10 - 13</span></label> <input id="time-mask" type="text" class="form-control" placeholder="Contoh: 081234567890" name="hp_telepon" value="<?= $user['hp_telepon']; ?>">
                            <?= form_error('hp_telepon', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label for="credit-card-mask">No KTP/SIM <span class="form-label__desc">jumlah digit: KTP = 16; SIM = 12</span></label>
                            <input id="credit-card-mask" type="text" class="form-control" name="ktp_sim" value="<?= $user['ktp_sim']; ?>">
                            <?= form_error('ktp_sim', '<small class="text-danger pl-1">', '</small>'); ?>

                        </div>
                    </div>
                    <div class="col-lg-3 offset-1">
                        <h2 class="mb-5">Foto Profil</h2>
                        <div class="btn-upload mb-5">

                            <div class="btn-upload__top-side">
                                <span class="btn-upload__desc">Ganti foto</span>
                                <span class="ua-icon-btn-upload btn-upload__icon"></span>
                                <input type="file" class="btn-upload__input-file" style="cursor:pointer" name="gambar">
                                <!-- <input type="hidden" id="image-data" name="image-data"> -->
                            </div>
                            <ul class="btn-upload__files">
                                <li class="btn-upload__file">
                                    <div id="upload-demo-i"></div>
                                    <img width="100" src="<?= base_url("/assets/img/avatars/{$user['image']}"); ?>" alt="" class="rounded-circle" id="item-img-output">
                                </li>
                                <li class="btn-upload__file">
                                    <!-- <?= $user['image']; ?> -->
                                </li>
                            </ul>
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

    <!-- <div class="modal fade-in" id="cropImagePop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upload_gambar" class="center-block"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" id="cropImageBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div> -->

</div>