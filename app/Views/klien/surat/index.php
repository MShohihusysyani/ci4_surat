<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
<style>
    #lottie-loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* Tambahkan backdrop blur */
        backdrop-filter: blur(5px);
        background-color: rgba(255, 255, 255, 0.3);
        /* bisa diubah ke hitam rgba(0,0,0,0.3) */

        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1060;
        transition: all 0.3s ease-in-out;
    }

    /* Class untuk menyembunyikan elemen */
    .hidden {
        display: none !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Surat</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Surat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <!-- Untuk pesan sukses -->
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="login" data-login="<?= session()->getFlashdata('pesan') ?>"></div>
            <?php endif; ?>

            <!-- Untuk pesan error -->
            <?php if (session()->getFlashdata('alert')): ?>
                <div class="error" data-error="<?= session()->getFlashdata('alert') ?>"></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Surat Keluar</h3>
                    <a href="surat/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File</th>
                                    <th>Tgl Surat</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Progres Surat</th>
                                    <th>Handler Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($suratmasuks as $suratmasuk) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="action">
                                            <?php if (!empty($suratmasuk->file)) : ?>
                                                <?php $file_url = base_url('file/surat_masuk/' . $suratmasuk->file); ?>

                                                <!-- Preview untuk PDF -->
                                                <?php if (preg_match('/\.pdf$/i', $suratmasuk->file)) : ?>
                                                    <a href="" class="preview-file pdf" data-toggle="modal" data-target="#previewModal" data-file-url="<?php echo $file_url; ?>" data-id="<?php echo $suratmasuk->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-pdf"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Preview untuk Gambar -->
                                                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $suratmasuk->file)) : ?>
                                                    <a href="#" class="image-preview" data-toggle="modal" data-target="#imageModal" data-file-url="<?= $file_url; ?>" data-id="<?php echo $suratmasuk->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-jpg"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Tautan untuk Dokumen Word -->
                                                <?php if (preg_match('/\.docx?$/i', $suratmasuk->file)) : ?>
                                                    <a href="<?php echo $file_url; ?>" target="_blank" onclick="updateStatus(<?php echo $suratmasuk->id; ?>)">
                                                        Open Word Document
                                                    </a>
                                                <?php endif; ?>

                                            <?php else : ?>
                                                <span>Tidak ada file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $suratmasuk->tgl_surat; ?></td>
                                        <td>
                                            <a href="#" class="lihat-komentar" data-toggle="modal" data-target="#komentarModal"
                                                data-id="<?= $suratmasuk->id_surat_masuk; ?>">
                                                <?= $suratmasuk->no_surat; ?>
                                            </a>
                                        </td>
                                        <td><?= $suratmasuk->perihal; ?></td>
                                        <td>
                                            <?php if ($suratmasuk->progres_surat == 'Proses') : ?>
                                                <span class="badge rounded-pill badge-info">Proses</span>

                                            <?php elseif ($suratmasuk->progres_surat == 'Proses Disposisi') : ?>
                                                <span class="badge rounded-pill badge-primary">Proses Disposisi</span>

                                            <?php elseif ($suratmasuk->progres_surat == 'Handle') : ?>
                                                <span class="badge rounded-pill badge-warning">Handle</span>

                                            <?php elseif ($suratmasuk->progres_surat == 'Finish') : ?>
                                                <span class="badge rounded-pill badge-success">Finish</span>

                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $suratmasuk->handler_surat; ?></td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="surat/edit/<?= $suratmasuk->id_surat_masuk ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="surat/hapus/<?= $suratmasuk->id_surat_masuk ?>" class="tombol-hapus"><i class="icon-trash"></i></a></li>
                                                <li class="history">
                                                    <a href="/riwayat/riwayat_surat_masuk/<?= $suratmasuk->id_surat_masuk; ?>">
                                                        <i class="icon-arrow-circle-left"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Surat Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-8">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Balasan Dari Nomor Surat</th>
                                    <th>Nomor Surat</th>
                                    <th>Perihal</th>
                                    <th>Lampiran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($suratkeluars as $suratkeluar) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $suratkeluar->nomor_surat_masuk; ?></td>
                                        <td><?= $suratkeluar->no_surat; ?></td>
                                        <td><?= $suratkeluar->perihal; ?></td>
                                        <td><?= $suratkeluar->lampiran; ?></td>
                                        <td>
                                            <ul class="action">
                                                <?php if ($suratkeluar->jenis_surat != 'manual') : ?>
                                                    <li class="edit">
                                                        <a class="preview"
                                                            data-id_surat_keluar="<?= $suratkeluar->id_surat_keluar; ?>"
                                                            data-template="<?= $suratkeluar->template ?? '' ?>"
                                                            data-tipe="suratkeluar">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li class="delete">
                                                    <a href="/riwayat/riwayat_surat_keluar/<?= $suratkeluar->id_surat_keluar; ?>">
                                                        <i class="icon-arrow-circle-left"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
<!-- animasi -->
<div id="lottie-loader-overlay" class="hidden">
    <dotlottie-player src="https://lottie.host/76b2e413-aa9e-4831-a747-ebf842fcf8c0/JtDR6u8OzR.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
</div>

<!-- Modal Preview surat masuk -->
<div class="modal fade bd-example-modal-lg" id="previewModal2" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Preview</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="download-pdf" download>Download</a> <!-- TYPE = submit -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Preview -->
<div class="modal fade bd-example-modal-lg" id="previewModal" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Preview File</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed id="filePreview" style="width:100%; height:400px;" frameborder="0"></embed>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="imageModal" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Preview File</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="" style="max-width: 100%;">
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>
<script src="<?= base_url() ?>/assets/js/icons/icons-notify.js"></script>
<script src="<?= base_url() ?>/assets/js/icons/icon-clipart.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

<!-- Preview surat masuk -->
<script>
    $(document).on('click', '.preview', function(e) {
        e.preventDefault();

        var id_surat_keluar = $(this).data('id_surat_keluar');
        var template = $(this).data('template') || '';

        // 1. Tampilkan Lottie Loader
        $('#lottie-loader-overlay').removeClass('hidden');

        var url = (template === "pengumuman") ?
            "/export/print-pengumuman/" + id_surat_keluar :
            "/export/print-suratkeluar/" + id_surat_keluar;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if (response.pdf) {
                    // 2. Siapkan konten modal, TAPI JANGAN TAMPILKAN DULU
                    $('#previewModal2 .modal-body').html(
                        `<embed src="data:application/pdf;base64,${response.pdf}" type="application/pdf" width="100%" height="500px">`
                    );
                    $('#download-pdf').attr('href', `data:application/pdf;base64,${response.pdf}`);
                    $('#download-pdf').attr('download', response.filename);

                    // 3. Tampilkan modalnya
                    $('#previewModal2').modal('show');

                    // PENTING: Jangan sembunyikan loader di sini lagi

                } else {
                    // Jika gagal, langsung sembunyikan loader dan tampilkan alert
                    $('#lottie-loader-overlay').addClass('hidden');
                    alert('Gagal memuat data.');
                }
            },
            error: function() {
                // Jika error, langsung sembunyikan loader dan tampilkan alert
                $('#lottie-loader-overlay').addClass('hidden');
                alert('Terjadi kesalahan saat memuat PDF.');
            }
        });
    });

    // 4. Tambahkan event listener untuk modal
    // Ini akan berjalan SETELAH modal selesai ditampilkan
    $('#previewModal2').on('shown.bs.modal', function() {
        // Baru sembunyikan loader sekarang untuk transisi yang mulus
        $('#lottie-loader-overlay').addClass('hidden');
    });
</script>

<!-- Preview -->
<script>
    $(document).ready(function() {
        // Untuk preview file PDF
        $(document).on('click', '.preview-file', function(e) {
            e.preventDefault();

            var fileUrl = $(this).data('file-url');
            var suratId = $(this).data('id');

            // Tampilkan modal dulu
            $('#filePreview').attr('src', fileUrl);
            $('#previewModal').modal('show');

        });

        // Untuk preview gambar
        $(document).on('click', '.image-preview', function(e) {
            e.preventDefault();

            var fileUrl = $(this).data('file-url');
            $('#modalImage').attr('src', fileUrl);
            $('#imageModal').modal('show');
        });

        // Hapus backdrop kalau modal ditutup
        $('#previewModal').on('hidden.bs.modal', function() {
            $('.modal-backdrop').remove();
        });
    });
</script>

<?= $this->endSection() ?>