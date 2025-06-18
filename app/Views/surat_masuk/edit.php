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
                <?php foreach ($suratmasuks as $suratmasuk): ?>
                    <form class="form theme-form" action="/suratmasuk/update/<?= $suratmasuk->id_surat_masuk ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Klien</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="klien_id" name="klien_id">
                                                <option value="">-- Pilih Klien --</option>
                                                <?php foreach ($kliens as $klien): ?>
                                                    <option value="<?= $klien->id_klien ?>" <?= ($suratmasuk->klien_id == $klien->id_klien) ? 'selected' : '' ?>>
                                                        <?= $klien->no_klien . ' - ' . $klien->nama_klien ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Surat dari</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="surat_dari" name="surat_dari">
                                                <option value="">-- Pilih --</option>
                                                <option value="Klien MSO" <?= ($suratmasuk->surat_dari == 'Klien MSO') ? 'selected' : '' ?>>Klien MSO</option>
                                                <option value="Non MSO" <?= ($suratmasuk->surat_dari == 'Non MSO') ? 'selected' : '' ?>>Non MSO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Terima</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_terima" name="tgl_terima" value="<?= $suratmasuk->tgl_terima ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_surat" name="tgl_surat" value="<?= $suratmasuk->tgl_surat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $suratmasuk->no_surat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="perihal" name="perihal" placeholder="Perihal" value="<?= $suratmasuk->perihal ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prioritas</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="prioritas_surat" name="prioritas_surat">
                                                <option value="">-- Pilih --</option>
                                                <option value="mendesak" <?= ($suratmasuk->prioritas_surat == 'mendesak') ? 'selected' : '' ?>>Mendesak</option>
                                                <option value="segera" <?= ($suratmasuk->prioritas_surat == 'segera') ? 'selected' : '' ?>>Segera</option>
                                                <option value="biasa" <?= ($suratmasuk->prioritas_surat == 'biasa') ? 'selected' : '' ?>>Biasa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perlu dibalas</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="butuh_balas" name="butuh_balas">
                                                <option value="">-- Pilih --</option>
                                                <option value="Ya" <?= ($suratmasuk->butuh_balas == 'Ya') ? 'selected' : '' ?>>Ya</option>
                                                <option value="Tidak" <?= ($suratmasuk->butuh_balas == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perusahaan</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-control-inverse-fill" id="perusahaan" name="perusahaan">
                                                <option value="">-- Pilih Perusahaan --</option>
                                                <?php foreach ($perusahaans as $perusahaan): ?>
                                                    <option value="<?= $perusahaan->nama_perusahaan ?>" <?= ($suratmasuk->perusahaan == $perusahaan->nama_perusahaan) ? 'selected' : '' ?>>
                                                        <?= $perusahaan->nama_perusahaan ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Produk</label>
                                        <div class="col-sm-9">
                                            <select id="produk" name="produk[]" class="js-example-basic-hide-search col-sm-12" multiple="multiple">
                                                <option value="">-- Pilih Produk --</option>
                                                <?php foreach ($produks as $produk): ?>
                                                    <option value="<?= $produk->nama_produk ?>">
                                                        <?= $produk->nama_produk ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tujuan</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-control-inverse-fill" id="tujuan_surat" name="tujuan_surat">
                                                <option value="">-- Pilih --</option>
                                                <option value="Divisi Core Banking" <?= ($suratmasuk->tujuan_surat == 'Divisi Core Banking') ? 'selected' : '' ?>>Divisi Core Banking</option>
                                                <option value="Divisi Support" <?= ($suratmasuk->tujuan_surat == 'Divisi Support') ? 'selected' : '' ?>>Divisi Support</option>
                                                <!-- <option value="Divisi Core Banking">Divisi Core Banking</option>
                                            <option value="Divisi Support">Divisi Support</option> -->
                                            </select>
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
<script>
    $(document).ready(function() {
        // let oldPerusahaan = "<?= old('perusahaan') ?>";
        // let oldProduk = <?= json_encode(old('produk') ?? []) ?>;

        function loadProduk(perusahaan, selectedProduk = []) {
            if (perusahaan) {
                $.ajax({
                    url: "<?= base_url('produk/getProdukByPerusahaan') ?>",
                    type: "POST",
                    data: {
                        perusahaan: perusahaan
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#produk").empty();

                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                let selected = selectedProduk.includes(value.nama_produk) ? 'selected' : '';
                                $("#produk").append('<option value="' + value.nama_produk + '" ' + selected + '>' + value.nama_produk + '</option>');
                            });
                        } else {
                            $("#produk").append('<option value="" disabled>Data tidak ditemukan</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $("#produk").empty();
            }
        }

        // Trigger saat perusahaan dipilih
        $("#perusahaan").change(function() {
            var perusahaan = $(this).val();
            loadProduk(perusahaan);
        });

        // // Auto load jika ada old value
        // if (oldPerusahaan) {
        //     $("#perusahaan").val(oldPerusahaan); // pastikan perusahaan terpilih
        //     loadProduk(oldPerusahaan, oldProduk);
        // }
    });
</script>

<!-- script tujuan surat -->
<script>
    $(document).ready(function() {
        $('#perusahaan').on('change', function() {
            const selectedPerusahaan = $(this).val();

            // Kosongkan dropdown tujuan surat dan beri opsi default
            $('#tujuan_surat').html('<option value="" selected disabled>-- Pilih --</option>');

            if (selectedPerusahaan === "PT Mitranet Software Online") {
                $('#tujuan_surat').append('<option value="Divisi Core Banking">Divisi Core Banking</option>');
                $('#tujuan_surat').append('<option value="Divisi Support">Divisi Support</option>');
            }
        });
    });
</script>



<?= $this->endSection() ?>