<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tambah Surat</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Tambah Surat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if (session()->getFlashdata('swal_success')) : ?>
                <meta name="swal-success" content="<?= session()->getFlashdata('swal_success') ?>">
            <?php endif; ?>

            <?php if (session()->getFlashdata('swal_error')) : ?>
                <meta name="swal-error" content="<?= session()->getFlashdata('swal_error') ?>">
            <?php endif; ?>

            <?php if (session()->getFlashdata('validation_errors')) : ?>
                <meta name="swal-validation-errors" content='<?= json_encode(session()->getFlashdata('validation_errors')) ?>'>
            <?php endif; ?>

            <!-- Untuk pesan error -->
            <?php if (session()->getFlashdata('alert')): ?>
                <div class="error" data-error="<?= session()->getFlashdata('alert') ?>"></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5>Tambah Surat</h5>
                </div>
                <?php foreach ($suratmasuks as $suratmasuk) : ?>
                    <form class="form theme-form" action="/klien/surat/update/<?= $suratmasuk->id_surat_masuk ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_surat" name="tgl_surat" value="<?= $suratmasuk->tgl_surat; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $suratmasuk->no_surat; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="perihal" name="perihal" placeholder="Perihal" value="<?= $suratmasuk->perihal; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">File</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" id="file" name="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <input class="btn btn-light" type="reset" value="Cancel">
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->endSection() ?>