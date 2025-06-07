<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit User</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Kelola</li>
                    <li class="breadcrumb-item active">Tambah User</li>
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
                    <h5>Edit User</h5>
                </div>
                <?php foreach ($karyawans as $karyawan) : ?>
                    <form class="form theme-form" action="/kelola/karyawan/update/<?= $karyawan->id_karyawan ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= $karyawan->nama_lengkap ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nama_panggilan" name="nama_panggilan" placeholder="Nama Panggilan" value="<?= $karyawan->nama_panggilan ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">NIP</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP" value="<?= $karyawan->nip ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">NIK</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="nik" name="nik" placeholder="NIK" value="<?= $karyawan->nik ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Alamat" value="<?= $karyawan->alamat ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $karyawan->tempat_lahir ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= $karyawan->tanggal_lahir ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">No HP</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" id="no_hp" name="no_hp" value="<?= $karyawan->no_hp ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="<?= $karyawan->email ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="L" <?= ($karyawan->jenis_kelamin == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                                <option value="P" <?= ($karyawan->jenis_kelamin == 'P') ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jabatan</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="jabatan_id" name="jabatan_id" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php foreach ($jabatans as $jabatan): ?>
                                                    <option value="<?= $jabatan->id_jabatan ?>" <?= ($jabatan->id_jabatan == $karyawan->jabatan_id) ? 'selected' : '' ?>>
                                                        <?= $jabatan->nama_jabatan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perusahaan</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="perusahaan_id" name="perusahaan_id" required>
                                                <option value="">-- Pilih Perusahaan --</option>
                                                <?php foreach ($perusahaans as $perusahaan): ?>
                                                    <option value="<?= $perusahaan->id_perusahaan ?>" <?= ($perusahaan->id_perusahaan == $karyawan->perusahaan_id) ? 'selected' : '' ?>>
                                                        <?= $perusahaan->nama_perusahaan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Foto</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" id="foto" name="foto">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Current Foto</label>
                                        <div class="col-sm-9">
                                            <div>
                                                <?php if (!empty($karyawan->foto)): ?>
                                                    <img src="<?= base_url('assets/img/foto_karyawan/' . $karyawan->foto); ?>" alt="User Photo" width="100%">
                                                <?php else: ?>
                                                    <p>Tidak ada foto yang diunggah.</p>
                                                <?php endif; ?>
                                            </div>
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

<?= $this->endSection() ?>