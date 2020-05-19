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
                <button class="btn btn-info btn-lg mt-1 mb-4" type="button" data-toggle="modal" data-target="#tambahRoleModal">Tambah Role</button>
                <?php if (validation_errors()) : ?>
                    <div class="error"></div>
                <?php endif; ?>
                <div class="main-container table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r) : ?>
                                <tr>
                                    <td><strong><?= $i++; ?></strong></td>
                                    <td><strong><?= $r['role']; ?></strong></td>
                                    <td>
                                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">
                                            <span class="btn btn-sm btn-success mb-3 mr-3">Akses</span>
                                        </a>
                                        <a href="">
                                            <span class="btn btn-sm btn-warning mb-3 mr-3">Edit</span>
                                        </a>
                                        <a href="">
                                            <span class="btn btn-sm btn-danger mb-3 mr-3">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="tambahRoleModal" tabindex="-1" role="dialog" aria-labelledby="tambahRoleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahRoleModalLabel">Tambah Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open('admin/role'); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="role">Nama Role</label>
                                    <input id="role" type="text" class="form-control" placeholder="Contoh: Manajemen Pegawai" name="role" value="<?= set_value('role'); ?>">
                                    <?= form_error('role', '<small class="text-danger pl-1">', '</small>'); ?>
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