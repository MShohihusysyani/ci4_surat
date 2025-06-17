<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Balas Surat</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Balas Surat</li>
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
                    <h5>Balas Surat</h5>
                </div>
                <form class="form theme-form" action="<?= base_url('surat-masuk/balas-surat') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="surat_masuk_id" value="<?= $suratmasuk->id_surat_masuk; ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Balasan dari</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="no_surat_masuk" name="no_surat_masuk" placeholder="Nomor Surat" value="<?= $suratmasuk->no_surat; ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Klien</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="nama_klien" name="nama_klien" placeholder="Nomor Surat" value="<?= $suratmasuk->nama_klien; ?>" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="klien_id" id="klien_id" value="<?= $suratmasuk->klien_id; ?>">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tempat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control digits" type="date" id="tgl_surat" name="tgl_surat" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Lampiran</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="lampiran" name="lampiran" placeholder="Lampiran" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <small class="ml-3" style="color:red; font-size:17px;">* File lampiran opotional, diisi jika ada lampiran*</small>
                                    <label class="col-sm-3 col-form-label">File Lampiran</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="file_lampiran" name="file_lampiran">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="perihal" name="perihal" placeholder="Perihal" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prioritas</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="prioritas" name="prioritas" placeholder="Prioritas" value="<?= $suratmasuk->prioritas_surat; ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Penerbit</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single col-sm-12" id="penerbit_id" name="penerbit_id" required>
                                            <option value="">-- Pilih Penerbit --</option>
                                            <?php foreach ($pejabats as $pejabat): ?>
                                                <option value="<?= $pejabat->id_karyawan ?>">
                                                    <?= $pejabat->nama_lengkap . ' (' . $pejabat->nama_jabatan . ')'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    // get nama klien
    $('#klien_id').on('change', function() {
        var namaKlien = $(this).find(':selected').data('nama');
        $('#nama_klien').val(namaKlien);
    });
</script>
<?= $this->endSection() ?>