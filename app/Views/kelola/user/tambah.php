<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tambah User</h3>
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
                    <h5>Tambah User</h5>
                </div>
                <form class="form theme-form" action="simpan" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama User</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="nama_user" name="nama_user" placeholder="Nama User">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">No HP</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" id="no_hp" name="no_hp" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single col-sm-12" id="role" name="role" required>
                                            <option value="">-- Pilih Role --</option>
                                            <?php foreach ($roles as $role): ?>
                                                <option value="<?= $role->nama_role ?>"><?= $role->nama_role ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row" id="klien" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Klien</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single col-sm-12" id="klien_id" name="klien_id" required>
                                            <option value="">-- Pilih Klien --</option>
                                            <?php foreach ($kliens as $klien): ?>
                                                <option value="<?= $klien->id_klien ?>">
                                                    <?= $klien->no_klien . ' - ' . $klien->nama_klien ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Divisi</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single col-sm-12" id="divisi" name="divisi" required>
                                            <option value="">-- Pilih Divisi --</option>
                                            <option value="cbs">Divisi Core Banking</option>
                                            <option value="digital">Divisi Digital</option>
                                            <option value="support">Divisi Support</option>
                                            <option value="superadmin">Superadmin</option>
                                            <option value="klien">Klien</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal Registrasi</label>
                                    <div class="col-sm-9">
                                        <input class="form-control digits" type="date" id="tgl_register" name="tgl_register">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Foto</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="foto" name="foto">
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
                            <input class="btn btn-light" type="reset" value="Cancel">
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
    $(document).ready(function() {
        $('#role').on('change', function() {
            if ($(this).val() === 'klien') {
                $('#klien').show();
            } else {
                $('#klien').hide();
                $('#klien_id').val('');
            }
        });
    });
</script>
<?= $this->endSection() ?>