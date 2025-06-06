<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Role</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola Data</li>
                    <li class="breadcrumb-item active">Data Role</li>
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
                    <h3>Data Role</h3>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modal-tambah">
                        <i class="icon-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($roles as $role):
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $role->nama_role ?></td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a><i class="icon-pencil-alt" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modal-edit" data-id_role="<?= $role->id_role; ?>" data-nama_role="<?= $role->nama_role; ?>"></i></a></li>
                                                <li class="delete"><a href="/kelola/hapus-role/<?= $role->id_role; ?>" class="tombol-hapus"><i class="icon-trash"></i></a></li>
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

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('kelola/tambah-role') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="nama_role">Nama Role</label>
                                <input class="form-control" id="nama_role" name="nama_role" type="text" placeholder="Masukkan nama role" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Save changes</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form> <!-- Form DITUTUP DI SINI -->
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('kelola/edit-role') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_role" id="id_role">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="nama_role">Nama Role</label>
                                <input class="form-control" id="nama_role" name="nama_role" type="text" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Save changes</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form> <!-- Form DITUTUP DI SINI -->
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>

<!-- Script untuk modal edit -->
<script>
    $('#modal-edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_role = button.data('id_role') // Extract info from data-* attributes
        var nama_role = button.data('nama_role')

        var modal = $(this)
        modal.find('.modal-body #id_role').val(id_role)
        modal.find('.modal-body #nama_role').val(nama_role)
    })
</script>
<?= $this->endSection() ?>