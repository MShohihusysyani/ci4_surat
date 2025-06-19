<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Pilih Template</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Pilih Template</li>
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
                <div class="card-body">
                    <input type="hidden" name="id_surat_keluar" id="id_surat_keluar" value="<?= $id_surat_keluar ?>">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Pilih Template</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single col-sm-12" id="template" name="template">
                                        <option value="">-- Pilih Template --</option>
                                        <option value="backdate">Backdate</option>
                                        <option value="penawaran">Penawaran</option>
                                    </select>
                                    <small class="text-danger" id="error-message" style="display: none;"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="col-sm-9 offset-sm-3">
                        <button class="btn btn-primary">Preview</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".btn-primary").addEventListener("click", function() {
            let selectedTemplate = document.getElementById("template").value;
            let errorMessage = document.getElementById("error-message");

            if (selectedTemplate === "") {
                errorMessage.style.display = "block";
                errorMessage.textContent = "Silakan pilih template terlebih dahulu!";
            } else {
                errorMessage.style.display = "none";
                window.location.href = "<?= base_url('suratkeluar/preview-template') ?>/" + selectedTemplate;
            }
        });
    });
</script>
<?= $this->endSection() ?>