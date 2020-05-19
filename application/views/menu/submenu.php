<?= $this->session->flashdata('message'); ?>
<div class="page-content">

    <div class="container-fluid">
        <div class="page-content__header">
            <div>
                <h2 class="page-content__header-heading"><?= $title; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <button class="btn btn-info btn-lg mt-1 mb-4" type="button" data-toggle="modal" data-target="#tambahMenuModal">Tambah Submenu</button>
                <?php if (validation_errors()) : ?>
                    <div class="error"></div>
                <?php endif; ?>
                <div class="main-container table-container">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Menu</th>
                                <th>Url</th>
                                <th>Icon</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($submenu as $sm) : ?>
                                <tr>
                                    <td><strong><?= $i++; ?></strong></td>
                                    <td><strong><?= $sm['title']; ?></strong></td>
                                    <td><strong><?= $sm['menu']; ?></strong></td>
                                    <td><strong><?= $sm['url']; ?></strong></td>
                                    <td><strong><?= $sm['icon']; ?></strong></td>
                                    <td><strong><?= $sm['is_active']; ?></strong></td>
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
                            <?= form_open('menu/submenu'); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Nama Judul</label>
                                    <input id="title" type="text" class="form-control" placeholder="Contoh: Dashboard" name="title" value="<?= set_value('title'); ?>">
                                    <?= form_error('title', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="menu_id" id="menu_id">
                                        <option value="">Pilih Menu</option>
                                        <?php foreach ($menu as $m) : ?>
                                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="url">Nama Submenu Url</label>
                                    <input id="url" type="text" class="form-control" placeholder="Contoh: Dashboard" name="url" value="<?= set_value('url'); ?>">
                                    <?= form_error('url', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="icon">Pilih Icon</label>
                                    <input id="icon" type="text" class="form-control" placeholder="Contoh: Dashboard" name="icon" value="<?= set_value('icon'); ?>">
                                    <?= form_error('icon', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked id="is_active" value="1" name="is_active">
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
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