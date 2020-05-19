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
                <h4>Role: <span id="role"><?= $role['role']; ?></span></h4>
                <a href="<?= base_url('admin/role'); ?>">
                    <span class="btn btn-secondary mb-2 mr-3 text-dark" type="button">Kembali</span>
                </a>
                <div class="main-container table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu</th>
                                <th>Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <td><strong><?= $i++; ?></strong></td>
                                    <td><strong><?= $m['menu']; ?></strong></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>" data-baseurl=" <?= base_url(); ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>