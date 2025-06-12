<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data User</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola Data</li>
                    <li class="breadcrumb-item active">Data User</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <!-- Sweetalert -->
            <!-- Untuk pesan sukses -->
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="login" data-login="<?= session()->getFlashdata('pesan') ?>"></div>
            <?php endif; ?>

            <!-- Untuk pesan error -->
            <?php if (session()->getFlashdata('alert')): ?>
                <div class="error" data-error="<?= session()->getFlashdata('alert') ?>"></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Data User</h3>
                    <a href="user/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama User</th>
                                    <th>Role</th>
                                    <th>Divisi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($users as $user):
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->nama_user ?></td>
                                        <td><?= $user->role ?></td>
                                        <td><?= $user->divisi ?></td>
                                        <td>
                                            <div class="media mb-2">
                                                <label class="col-form-label m-r-10 status-label<?= $user->id_user ?>">
                                                    <?= esc($user->status_user) ?>
                                                </label>
                                                <div class="media-body text-end icon-state">
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            class="toggle-status"
                                                            data-id_user="<?= $user->id_user ?>"
                                                            <?= ($user->status_user == 'Aktif') ? 'checked' : '' ?>>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- <td>
                                            <?php if ($user->status_user == 'Aktif') : ?>
                                                <span class="badge rounded-pill badge-info">Aktif</span>
                                            <?php elseif ($user->status_user == 'N') : ?>
                                                <span class="badge rounded-pill badge-danger">Non Aktif</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="user/edit/<?= $user->id_user ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="user/hapus/<?= $user->id_user ?>" class="tombol-hapus"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>

<script>
    $('#basic-1').on('change', '.toggle-status', function() {
        const userId = $(this).data('id_user');
        const statusBaru = $(this).is(':checked') ? 'Aktif' : 'Non Aktif';

        $.ajax({
            url: 'user/update-status',
            type: 'POST',
            data: {
                id_user: userId,
                status_user: statusBaru
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('.status-label' + userId).text(statusBaru);
                } else {
                    alert('Gagal update status!');
                }
            },
            error: function() {
                alert('Terjadi kesalahan koneksi.');
            }
        });
    });
</script>

<?= $this->endSection() ?>