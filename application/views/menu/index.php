<?= $this->session->flashdata('message'); ?>
<div class="page-content">

    <div class="container-fluid">
        <div class="page-content__header">
            <div>
                <h2 class="page-content__header-heading"><?= $title; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <button class="btn btn-info btn-lg mt-1 mb-4" type="button" data-toggle="modal" data-target="#tambahMenuModal">Tambah Menu</button>
                <?php if (validation_errors()) : ?>
                    <div class="error"></div>
                <?php endif; ?>
                <div class="main-container table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <td><strong><?= $i++; ?></strong></td>
                                    <td><strong><?= $m['menu']; ?></strong></td>
                                    <td>
                                        <a href="">
                                            <span class="badge badge-sm badge-warning mb-3 mr-3">Edit</span>
                                        </a>
                                        <a href="">
                                            <span class="badge badge-sm badge-danger mb-3 mr-3">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open('menu'); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Menu</label>
                                    <input id="nama" type="text" class="form-control" placeholder="Contoh: Manajemen Pegawai" name="menu" value="<?= set_value('menu'); ?>">
                                    <?= form_error('menu', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Tambah!</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>