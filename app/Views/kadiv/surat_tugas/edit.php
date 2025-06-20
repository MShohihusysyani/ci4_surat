<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit Surat</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Edit Surat</li>
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
                    <h5>Edit Surat</h5>
                </div>
                <?php foreach ($surattugas as $surat) : ?>
                    <form class="form theme-form" action="<?= base_url('kadiv/surat-tugas/update/' . $surat->id_surat_tugas . '/') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $surat->no_surat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-multiple col-sm-12" multiple="multiple" id="anggota" name="anggota[]" required>
                                                <!-- <option value="">-- Pilih Nama --</option> -->
                                                <?php foreach ($karyawans as $karyawan): ?>
                                                    <?php
                                                    $anggota_terpilih = explode(',', $surat->anggota);
                                                    ?>
                                                    <option value="<?= $karyawan->nama_lengkap ?>"
                                                        <?= in_array(trim($karyawan->nama_lengkap), $anggota_terpilih) ? 'selected' : '' ?>>
                                                        <?= $karyawan->nama_lengkap ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <h5> <b>Tujuan Perjalanan Dinas</b></h5>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Unit Kerja</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="unit_kerja" name="unit_kerja" placeholder="Unit Kerja" value="<?= $surat->unit_kerja ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tempat dituju</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat" value="<?= $surat->tempat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Alamat" value="<?= $surat->alamat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Maksud Penugasan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="tugas" name="tugas" placeholder="Maksud penugasan" value="<?= $surat->tugas ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Berangkat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="date" id="tgl_berangkat" name="tgl_berangkat" value="<?= $surat->tgl_berangkat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jam Berangkat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="time" id="jam_berangkat" name="jam_berangkat" value="<?= $surat->jam_berangkat ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Kembali</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="date" id="tgl_kembali" name="tgl_kembali" value="<?= $surat->tgl_kembali ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jam Kembali</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="time" id="jam_kembali" name="jam_kembali" value="<?= $surat->jam_kembali ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Lama Tugas</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="lama_bertugas" name="lama_bertugas" placeholder="Lama tugas" value="<?= $surat->lama_bertugas ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Bertugas</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="date" id="tgl_bertugas" name="tgl_bertugas" value="<?= $surat->tgl_bertugas ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jam tugas</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="jam_tugas" name="jam_tugas" placeholder="Jam tugas" value="<?= $surat->jam_tugas ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Laporan Pertanggungjawaban</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="lpj" name="lpj" placeholder="Laporan Pertanggungjawaban" value="<?= $surat->lpj ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Laporan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="laporan" name="laporan" placeholder="Laporan" value="<?= $surat->laporan ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-9">
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="10"> <?= $surat->keterangan ?></textarea>
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

<?= $this->endSection() ?>