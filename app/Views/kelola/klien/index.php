<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Data Klien</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola Data</li>
                    <li class="breadcrumb-item active">Data Klien</li>
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
                    <h3>Data Klien</h3>
                    <a href="klien/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Klien</th>
                                    <th>Nama Klien</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kliens as $klien):
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $klien->no_klien ?></td>
                                        <td><?= $klien->nama_klien ?></td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="klien/edit/<?= $klien->id_klien ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="klien/hapus/<?= $klien->id_klien ?>" class="tombol-hapus"><i class="icon-trash"></i></a></li>
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
<?= $this->endSection() ?>