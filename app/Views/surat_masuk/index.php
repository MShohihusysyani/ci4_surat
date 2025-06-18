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
                <h3>Surat Masuk</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Surat Masuk</li>
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
                    <h3>Surat Masuk</h3>
                    <a href="suratmasuk/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
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
                                    <th>Bpr/Klien</th>
                                    <th>Perihal</th>
                                    <!-- <th>Status</th> -->
                                    <th>Progres</th>
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
                                        <td><?= $suratmasuk->no_surat; ?></td>
                                        <td><?= $suratmasuk->nama_klien; ?></td>
                                        <td><?= $suratmasuk->perihal; ?></td>
                                        <td>
                                            <?php if ($suratmasuk->progres_surat == 'Proses') : ?>
                                                <span class="badge rounded-pill badge-primary">Proses</span>

                                            <?php elseif ($suratmasuk->progres_surat == 'Proses Disposisi') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Disposisi</span>

                                            <?php elseif ($suratmasuk->progres_surat == 'Finish') : ?>
                                                <span class="badge rounded-pill badge-success">Finish</span>

                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="suratmasuk/edit/<?= $suratmasuk->id_surat_masuk ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="suratmasuk/hapus/<?= $suratmasuk->id_surat_masuk ?>" class="tombol-hapus"><i class="icon-trash"></i></a></li>
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