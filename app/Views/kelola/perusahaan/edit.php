<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit Perusahaan</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Edit Perusahaan</li>
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
                    <h5>Edit Perusahaan</h5>
                </div>
                <?php if (!empty($perusahaans) && is_array($perusahaans)): ?>
                    <?php $perusahaan = $perusahaans; // Fetch the first (and possibly only) client 
                    ?>
                    <form class="form theme-form" action="/kelola/perusahaan/update/<?= $perusahaan['id_perusahaan'] ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama Perusahaan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" value="<?= $perusahaan['nama_perusahaan'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Npwp</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="npwp" name="npwp" placeholder="Npwp" value="<?= $perusahaan['npwp'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Alamat" value="<?= $perusahaan['alamat'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Provinsi</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="provinsi" name="provinsi" required>
                                                <option value="">-- Pilih Provinsi --</option>
                                                <?php foreach ($provinsi as $prov): ?>
                                                    <option value="<?= $prov['id_wilayah_propinsi'] ?>" <?= ($prov['id_wilayah_propinsi'] == $perusahaan['provinsi']) ? 'selected' : '' ?>>
                                                        <?= $prov['nama_propinsi'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kabupaten</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="kabupaten" name="kabupaten" required>
                                                <option value="">-- Pilih Kabupaten --</option>
                                                <?php foreach ($kabupaten as $kab): ?>
                                                    <option value="<?= $kab['id_wilayah_kabupaten'] ?>" <?= ($kab['id_wilayah_kabupaten'] == $perusahaan['kabupaten']) ? 'selected' : '' ?>>
                                                        <?= $kab['nama_kabupaten'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="kecamatan" name="kecamatan" required>
                                                <option value="">-- Pilih Kecamatan --</option>
                                                <?php foreach ($kecamatan as $kec): ?>
                                                    <option value="<?= $kec['id_wilayah_kecamatan'] ?>" <?= ($kec['id_wilayah_kecamatan'] == $perusahaan['kecamatan']) ? 'selected' : '' ?>>
                                                        <?= $kec['nama_kecamatan'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kelurahan</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="kelurahan" name="kelurahan" required>
                                                <option value="">-- Pilih Kelurahan --</option>
                                                <?php foreach ($kelurahan as $kel): ?>
                                                    <option value="<?= $kel['id_wilayah_kelurahan'] ?>" <?= ($kel['id_wilayah_kelurahan'] == $perusahaan['kelurahan']) ? 'selected' : '' ?>>
                                                        <?= $kel['nama_kelurahan'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kode Pos</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="kode_pos" name="kode_pos" required>
                                                <option value="">-- Pilih Kode Pos --</option>
                                                <?php foreach ($kodepos as $kop): ?>
                                                    <option value="<?= $kop['id_wilayah_kelurahan'] ?>" <?= ($kop['id_wilayah_kelurahan'] == $perusahaan['kode_pos']) ? 'selected' : '' ?>>
                                                        <?= $kop['kode_pos'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Dati</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="dati2" name="dati2" required>
                                                <option value="">-- Pilih Dati --</option>
                                                <?php foreach ($dati2 as $dati): ?>
                                                    <option value="<?= $dati['dati2'] ?>" <?= ($dati['dati2'] == $perusahaan['dati2']) ? 'selected' : '' ?>>
                                                        <?= $dati['dati2'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Logo</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" id="logo" name="logo">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Current Logo</label>
                                        <div class="col-sm-9">
                                            <div>
                                                <?php if (!empty($perusahaan['logo'])): ?>
                                                    <img src="<?= base_url('assets/img/logo_perusahaan/' . $perusahaan['logo']); ?>" alt="Logo Perusahaan" width="100%">
                                                <?php else: ?>
                                                    <p>Tidak ada logo yang diunggah.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">No Telp</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" id="no_telp" name="no_telp" placeholder="No Telp" value="<?= $perusahaan['no_telp'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="email" name="email" placeholder="Email" value="<?= $perusahaan['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="website" name="website" placeholder="Website" value="<?= $perusahaan['website'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Instagram</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="instagram" name="instagram" placeholder="Instagram" value="<?= $perusahaan['instagram'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Facebook</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="facebook" name="facebook" placeholder="Facebook" value="<?= $perusahaan['facebook'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Twitter</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="twitter" name="twitter" placeholder="Twitter" value="<?= $perusahaan['twitter'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Youtube</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="youtube" name="youtube" placeholder="Youtube" value="<?= $perusahaan['youtube'] ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tiktok</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="tiktok" name="tiktok" placeholder="Tiktok" value="<?= $perusahaan['tiktok'] ?>">
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
                <?php else: ?>
                    <div class="alert alert-warning">No client found to edit.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Ketika provinsi dipilih
        $('#provinsi').change(function() {
            var provinsiId = $(this).val();
            console.log("Selected provinsi ID:", provinsiId); // Debugging provinsi ID

            if (provinsiId) {
                $.ajax({
                    url: "/wilayah/getKabupaten/" + provinsiId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log("Received kabupaten data:", data); // Debugging kabupaten data

                        $('#kabupaten').empty().append('<option value="">-- Pilih Kabupaten --</option>');
                        $.each(data, function(key, value) {
                            $('#kabupaten').append('<option value="' + value.id_wilayah_kabupaten + '">' + value.nama_kabupaten + '</option>');
                        });
                        $('#kabupaten').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching kabupaten:", error); // Debugging error in fetching kabupaten
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#kabupaten').empty().append('<option value="">-- Pilih Kabupaten --</option>').prop('disabled', true);
                $('#kecamatan, #kelurahan').empty().append('<option value="">-- Pilih --</option>').prop('disabled', true);
            }
        });

        // Ketika kabupaten dipilih
        $('#kabupaten').on('change', function() {
            var kabupatenId = $(this).val();
            console.log("Selected kabupaten ID:", kabupatenId); // Debugging kabupaten ID

            if (kabupatenId) {
                $.ajax({
                    url: "/wilayah/getKecamatan/" + kabupatenId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log("Received kecamatan data:", data); // Debugging kecamatan data

                        $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(data, function(key, value) {
                            console.log("Adding kecamatan with ID:", value.id_wilayah_kecamatan); // Debug kecamatan ID
                            $('#kecamatan').append('<option value="' + value.id_wilayah_kecamatan + '">' + value.nama_kecamatan + '</option>');
                        });
                        $('#kecamatan').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching kecamatan:", error); // Debugging error in fetching kecamatan
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
                $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>').prop('disabled', true);
            }
        });

        // Ketika kecamatan dipilih
        $('#kecamatan').change(function() {
            var kecamatanId = $(this).val();
            console.log("Selected kecamatan ID:", kecamatanId); // Debugging kecamatan ID

            if (kecamatanId) {
                $.ajax({
                    url: "/wilayah/getKelurahan/" + kecamatanId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log("Received kelurahan data:", data); // Debugging kelurahan data

                        $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>');
                        $.each(data, function(key, value) {
                            $('#kelurahan').append('<option value="' + value.id_wilayah_kelurahan + '">' + value.nama_kelurahan + '</option>');
                        });
                        $('#kelurahan').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching kelurahan:", error); // Debugging error in fetching kelurahan
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>').prop('disabled', true);
            }
        });

        // Ketika kelurahan dipilih
        $('#kelurahan').change(function() {
            var kelurahanId = $(this).val();
            console.log("Selected kelurahan ID:", kelurahanId); // Debugging kelurahan ID

            if (kelurahanId) {
                $.ajax({
                    url: "/wilayah/getKodePos/" + kelurahanId, // Endpoint untuk mengambil kode pos
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log("Received kode pos data:", data); // Debugging kode pos data

                        if (data && data.kode_pos) {
                            console.log("Setting kode pos to select:", data.kode_pos); // Debugging saat set value

                            // Hapus opsi lama jika ada
                            $('#kode_pos').empty();

                            // Tambahkan opsi kode pos baru
                            $('#kode_pos').append('<option value="' + data.kode_pos + '">' + data.kode_pos + '</option>');
                        } else {
                            $('#kode_pos').empty(); // Kosongkan dropdown jika tidak ada kode pos
                            $('#kode_pos').append('<option value="">-- Pilih Kode Pos --</option>'); // Opsi default
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching kode pos:", error); // Debugging error in fetching kode pos
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#kode_pos').empty(); // Kosongkan dropdown jika kelurahan tidak dipilih
                $('#kode_pos').append('<option value="">-- Pilih Kode Pos --</option>'); // Opsi default
            }
        });

        // Trigger change event on page load if kelurahan is already selected
        var initialKelurahanId = $('#kelurahan').val();
        if (initialKelurahanId) {
            console.log("Triggering change event for initial kelurahan ID:", initialKelurahanId); // Debugging initial kelurahan
            $('#kelurahan').trigger('change'); // Trigger change event to populate kode pos
        }

    });
</script>

<?= $this->endSection() ?>