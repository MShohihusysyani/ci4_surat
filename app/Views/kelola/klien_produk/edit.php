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
                    <li class="breadcrumb-item active">Edit Klien Produk</li>
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
                    <h5>Edit Klien Produk</h5>
                </div>
                <?php foreach ($klien_produks as $klien_produk) : ?>
                    <form class="form theme-form" action="/kelola/klien-produk/update/<?= $klien_produk->id_klien_produk ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kode Klien</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="no_klien" name="no_klien" required>
                                                <option value="">-- Pilih Kode --</option>
                                                <?php foreach ($kliens as $klien): ?>
                                                    <option value="<?= $klien->no_klien; ?>" <?= ($klien->no_klien == $klien_produk->no_klien) ? 'selected' : ''; ?>>
                                                        <?= $klien->no_klien; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama Klien</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nama_klien" name="nama_klien" placeholder="Nama Klien" value="<?= $klien_produk->nama_klien; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Produk</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="nama_produk" name="nama_produk" required>
                                                <option value="">-- Pilih Produk --</option>
                                                <?php foreach ($produks as $produk): ?>
                                                    <option value="<?= $produk->nama_produk; ?>" <?= ($produk->nama_produk == $klien_produk->nama_produk) ? 'selected' : ''; ?>>
                                                        <?= $produk->nama_produk; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" value="<?= $klien_produk->deskripsi; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Pakai</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_pakai" name="tgl_pakai" value="<?= $klien_produk->tgl_pakai; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Jatuh Tempo</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" value="<?= $klien_produk->tgl_jatuh_tempo; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jangka Waktu</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="jangka_waktu" name="jangka_waktu" placeholder="Jangka Waktu" value="<?= $klien_produk->jangka_waktu; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Biaya Setup</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="biaya_setup" name="biaya_setup" placeholder="Biaya Setup" value="<?= $klien_produk->biaya_setup; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Biaya Bulanan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="biaya_bulanan" name="biaya_bulanan" placeholder="Biaya Bulanan" value="<?= $klien_produk->biaya_bulanan; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Biaya Cloud</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="biaya_cloud" name="biaya_cloud" placeholder="Biaya Cloud" value="<?= $klien_produk->biaya_cloud; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Share Fee</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="share_fee" name="share_fee" required>
                                                <option value="">-- Pilih Share Fee --</option>
                                                <option value="Ya" <?= ($klien_produk->share_fee == 'Ya') ? 'selected' : '' ?>>Ya</option>
                                                <option value="Tidak" <?= ($klien_produk->share_fee == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
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
        console.log("DOM Ready");

        // Pastikan Select2 aktif (kalau memang Anda pakai)
        $('.js-example-basic-single').select2();

        // Event untuk no_klien
        $('#no_klien').on('change', function() {
            const noKlien = $(this).val();
            console.log("Selected no_klien:", noKlien);
            if (noKlien) {
                fetch('<?= base_url('kelola/get-nama-klien'); ?>/' + encodeURIComponent(noKlien))
                    .then(res => res.json())
                    .then(data => {
                        console.log('Response nama_klien:', data);
                        $('#nama_klien').val(data.nama_klien || '');
                    })
                    .catch(err => console.error('Error fetching nama_klien:', err));
            }
        });

        // Event untuk nama_produk
        $('#nama_produk').on('change', function() {
            const namaProduk = $(this).val();
            console.log("Selected nama_produk:", namaProduk);
            if (namaProduk) {
                fetch('<?= base_url('kelola/get-deskripsi-produk'); ?>/' + encodeURIComponent(namaProduk))
                    .then(res => res.json())
                    .then(data => {
                        console.log('Response deskripsi:', data);
                        $('#deskripsi').val(data.deskripsi || '');
                    })
                    .catch(err => console.error('Error fetching deskripsi:', err));
            }
        });
    });
</script>

<!-- script  untuk menghitung jangka waktu -->
<script>
    document.getElementById('tgl_pakai').addEventListener('change', calculateJangkaWaktu);
    document.getElementById('tgl_jatuh_tempo').addEventListener('change', calculateJangkaWaktu);

    function calculateJangkaWaktu() {
        var tglPakai = document.getElementById('tgl_pakai').value;
        var tglJatuhTempo = document.getElementById('tgl_jatuh_tempo').value;

        if (tglPakai && tglJatuhTempo) {
            // Convert input dates to Date objects
            var startDate = new Date(tglPakai);
            var endDate = new Date(tglJatuhTempo);

            // Calculate the difference in months
            var yearDiff = endDate.getFullYear() - startDate.getFullYear();
            var monthDiff = endDate.getMonth() - startDate.getMonth();

            var totalMonths = (yearDiff * 12) + monthDiff;

            // Display the calculated jangka waktu in months
            document.getElementById('jangka_waktu').value = totalMonths;
        }
    }
</script>

<?= $this->endSection() ?>