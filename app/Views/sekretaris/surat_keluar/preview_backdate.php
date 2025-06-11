<?= $this->extend('layouts/master'); ?>
<?= $this->section('css'); ?>
<style>
    /* CSS untuk style template surat */
    .header-container {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .hr-line {
        border: 1px solid black;
        margin-top: 10px;
    }

    .date-container {
        text-align: right;
        font-size: 14px;
    }

    .content-container {
        font-size: 14px;
        margin-top: 10px;
    }

    .recipient-container {
        margin-left: 20px;
        font-size: 14px;
    }

    .signature-container {
        text-align: left;
        font-size: 14px;
    }

    .footer-container {
        text-align: center;
        font-size: 12px;
        border-top: 1px solid black;
        padding-top: 10px;
        color: grey;
    }

    /* Styling untuk full-screen spinner */
    .full-screen-spinner {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Semi-transparan hitam */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Pastikan spinner di atas semua konten */
    }

    /* Styling spinner */
    .spinner-border {
        width: 3rem;
        /* Ukuran spinner */
        height: 3rem;
        border-width: 0.3rem;
    }

    /* Styling text inside spinner (optional) */
    .spinner-border span {
        color: white;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('main-content'); ?>

<!-- Full-screen loading spinner -->
<div id="loadingSpinner" class="full-screen-spinner" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>



<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Preview</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Preview</li>
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
                    <h5>Preview</h5>
                </div>
                <form class="form theme-form" action="<?= base_url('surat-keluar/simpan-draft') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="template">
                                <input type="hidden" name="id_surat_keluar" id="id_surat_keluar" value="<?= $suratkeluar->id_surat_keluar; ?>">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $suratkeluar->no_surat; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control digits" type="date" id="tgl_surat" name="tgl_surat" value="<?= $suratkeluar->tgl_surat; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Lampiran</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="lampiran" name="lampiran" placeholder="Lampiran" value="<?= $suratkeluar->lampiran; ?>" required>
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
                                        <input class="form-control" type="text" id="perihal" name="perihal" placeholder="Perihal" value="<?= $suratkeluar->perihal; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prioritas</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="prioritas" name="prioritas" placeholder="Perihal" value="<?= $suratkeluar->prioritas; ?>" required>
                                    </div>
                                </div>
                                <!-- <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prioritas</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single col-sm-12" id="prioritas" name="prioritas">
                                            <option value="">-- Pilih Prioritas --</option>
                                            <option value="biasa">Biasa</option>
                                            <option value="segera">Segera</option>
                                            <option value="mendesak">Mendesak</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Klien</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="nama_klien" name="nama_klien" placeholder="Perihal" value="<?= $suratkeluar->nama_klien; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tempat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat" value="<?= $suratkeluar->tempat; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Konten Surat</label>
                                    <div class="col-sm-9">
                                        <textarea name="konten" id="konten" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="button" id="btn_simpan">Submit</button>
                            <button type="button" class="btn btn-info" id="btn_pdf">Preview</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- Modal untuk Preview PDF -->
<div class="modal fade bd-example-modal-lg" id="previewModal" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Preview</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfPreviewIframe" src="" width="100%" height="500px"></iframe>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let editorInstance = null; // Buat variabel global

        var konten = `
        <div class="body-container">
            <p>Dengan Hormat,</p>                                  
            <p>Demikian yang dapat kami sampaikan. Atas perhatian dan kerjasama yang baik, kami ucapkan terima kasih.</p>
        </div>
        <br>
    `;

        ClassicEditor
            .create(document.querySelector('#konten'), {
                toolbar: {
                    items: [
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                        'undo', 'redo',
                    ]
                },
                language: 'id',
                height: 300
            })
            .then(editor => {
                editorInstance = editor; // Simpan instance editor
                editor.setData(konten); // Set isi editor dengan template
            });
        // .catch(error => {
        //     console.error("CKEditor Error:", error);
        // });

        document.getElementById("btn_pdf").addEventListener("click", function() {
            // if (!editorInstance) {
            //     console.error("CKEditor belum siap!");
            //     return;
            // }

            let konten = editorInstance.getData(); // Ambil isi CKEditor
            // console.log("Konten Surat Sebelum Fetch:", konten_surat); // Debugging

            let formData = new FormData();
            formData.append("konten", konten);
            // Menampilkan spinner full-screen saat proses dimulai
            document.getElementById('loadingSpinner').style.display = 'flex';

            // Kirim data ke server untuk generate PDF                 
            fetch('<?= site_url("preview-template/backdate"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?= csrf_hash(); ?>'
                    },
                    body: JSON.stringify({
                        konten: konten
                    })
                })
                .then(response => {
                    // console.log("Fetch response:", response); // Debugging                         
                    return response.blob(); // Ubah ke blob                     
                })
                .then(blob => {
                    // console.log("Blob received:", blob); // Pastikan blob diterima dengan benar                         
                    const pdfUrl = URL.createObjectURL(blob); // Membuat URL untuk blob                         
                    document.getElementById('pdfPreviewIframe').src = pdfUrl; // Menampilkan PDF di iframe                         
                    // Menampilkan modal                         
                    const myModal = new bootstrap.Modal(document.getElementById('previewModal'));
                    myModal.show(); // Menampilkan modal PDF Preview                     

                    // Menyembunyikan spinner setelah selesai
                    document.getElementById('loadingSpinner').style.display = 'none';
                })
                .catch(error => {
                    console.error('Error generating PDF:', error);
                    // Menyembunyikan spinner saat terjadi error
                    document.getElementById('loadingSpinner').style.display = 'none';
                }); // Tangani error
        });

        $("#btn_simpan").click(function() {
            var formData = {
                id_surat_keluar: $("#id_surat_keluar").val(),
                no_surat: $("#no_surat").val(),
                tgl_surat: $("#tgl_surat").val(),
                lampiran: $("#lampiran").val(),
                perihal: $("#perihal").val(),
                // tags: $("#tags").val(),
                prioritas: $("#prioritas").val(),
                konten: editorInstance.getData(), // Ambil data dari CKEditor

            };

            // console.log(formData); // Debugging untuk cek ID yang dikirim

            $.ajax({
                url: "<?= base_url('surat-keluar/simpan-draft-final'); ?>",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "<?= site_url('/surat-keluar'); ?>"; // Arahkan setelah sukses
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan saat menyimpan data!",
                        icon: "error",
                        timer: 3000,
                        showConfirmButton: true
                    });

                }
            });
        });
    });
</script>

<!-- script edit data -->
<script>
    $(document).ready(function() {
        $("#btn_edit").click(function() {
            var formData = new FormData(); // Gunakan FormData untuk kirim data dan file

            // Ambil data form
            formData.append('id', $("#id").val());
            formData.append('nomor_surat', $("#nomor_surat").val());
            formData.append('tanggal_surat', $("#tanggal_surat").val());
            formData.append('lampiran', $("#lampiran").val());
            formData.append('perihal', $("#perihal").val());
            formData.append('tags', $("#tags").val());
            formData.append('prioritas_surat', $("#prioritas_surat").val());

            // Ambil file yang diunggah
            var file_surat = $("#file_surat")[0].files[0]; // Mengambil file yang diunggah
            if (file_surat) {
                formData.append('file_surat', file_surat); // Menambahkan file ke FormData
            }

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "<?= site_url('edit-draft/keluar'); ?>",
                type: "POST",
                data: formData,
                processData: false, // Jangan memproses data
                contentType: false, // Jangan set contentType karena FormData akan mengurus ini
                success: function(response) {
                    alert("Draft berhasil diedit!");
                    location.reload();
                },
                error: function() {
                    alert("Gagal mengedit draft!");
                }
            });
        });
    });
</script>

<?= $this->endSection('script'); ?>