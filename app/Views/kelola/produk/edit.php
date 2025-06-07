<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit Produk</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Tambah Produk</li>
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
                    <h5>Edit Produk</h5>
                </div>
                <?php foreach ($produks as $produk) : ?>
                    <form class="form theme-form" action="/kelola/produk/update/<?= $produk->id_produk ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama Produk</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= $produk->nama_produk ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" value="<?= $produk->deskripsi ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perusahaan</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="perusahaan" name="perusahaan" required>
                                                <option value="">-- Pilih Perusahaan --</option>
                                                <?php foreach ($perusahaans as $perusahaan): ?>
                                                    <option value="<?= $perusahaan->nama_perusahaan ?>" <?= ($produk->perusahaan == $perusahaan->nama_perusahaan) ? 'selected' : '' ?>>
                                                        <?= $perusahaan->nama_perusahaan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="status_produk" name="status_produk" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Aktif" <?= ($produk->status_produk == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                                                <option value="Discontinue" <?= ($produk->status_produk == 'Discontinue') ? 'selected' : '' ?>>Discontinue</option>
                                                <option value="Develop" <?= ($produk->status_produk == 'Develop') ? 'selected' : '' ?>>Develop</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Logo</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" id="logo_produk" name="logo_produk">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Current Logo</label>
                                        <div class="col-sm-9">
                                            <div>
                                                <?php if (!empty($produk->logo_produk)): ?>
                                                    <img src="<?= base_url('assets/img/logo_produk/' . $produk->logo_produk); ?>" alt="Logo Produk" width="100%">
                                                <?php else: ?>
                                                    <p>Tidak ada logo yang diunggah.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Time</label>
                                    <div class="col-sm-9">
                                        <input class="form-control digits" type="time" value="21:45:00">
                                    </div>
                                </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <!-- <input class="btn btn-light" type="reset" value="Cancel"> -->
                            </div>
                        </div>
                    </form>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        function toggleKlienField() {
            if ($('#role').val().toLowerCase() === 'klien') {
                $('#klien').show();
            } else {
                $('#klien').hide();
                $('#klien_id').val('');
            }
        }

        // Jalankan saat halaman dimuat (EDIT mode)
        // Jadi, kalau user punya role = klien, maka field Klien langsung muncul tanpa harus ubah dropdown.
        toggleKlienField();

        // Jalankan juga saat dropdown diubah (ADD mode)
        $('#role').on('change', toggleKlienField);
    });
</script>

<?= $this->endSection() ?>