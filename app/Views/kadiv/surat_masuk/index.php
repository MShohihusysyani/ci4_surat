<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
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
                    <h3>Disposisi Keatasan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File</th>
                                    <th>Bpr/Klien</th>
                                    <th>Tgl Surat</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Catatan</th>
                                    <th>Progres Surat</th>
                                    <th>Handler Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($disposisiatasan as $disposisiatas) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="action">
                                            <?php if (!empty($disposisiatas->file)) : ?>
                                                <?php $file_url = base_url('file/surat_masuk/' . $disposisiatas->file); ?>

                                                <!-- Preview untuk PDF -->
                                                <?php if (preg_match('/\.pdf$/i', $disposisiatas->file)) : ?>
                                                    <a href="" class="preview-file pdf" data-toggle="modal" data-target="#previewModal" data-file-url="<?php echo $file_url; ?>" data-id="<?php echo $disposisiatas->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-pdf"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Preview untuk Gambar -->
                                                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $disposisiatas->file)) : ?>
                                                    <a href="#" class="image-preview" data-toggle="modal" data-target="#imageModal" data-file-url="<?= $file_url; ?>" data-id="<?php echo $disposisiatas->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-jpg"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Tautan untuk Dokumen Word -->
                                                <?php if (preg_match('/\.docx?$/i', $disposisiatas->file)) : ?>
                                                    <a href="<?php echo $file_url; ?>" target="_blank" onclick="updateStatus(<?php echo $disposisiatas->id; ?>)">
                                                        Open Word Document
                                                    </a>
                                                <?php endif; ?>

                                            <?php else : ?>
                                                <span>Tidak ada file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $disposisiatas->nama_klien; ?></td>
                                        <td><?= $disposisiatas->tgl_surat; ?></td>
                                        <td>
                                            <a href="#" class="lihat-komentar" data-toggle="modal" data-target="#komentarModal"
                                                data-id="<?= $disposisiatas->id_surat_masuk; ?>">
                                                <?= $disposisiatas->no_surat; ?>
                                            </a>
                                        </td>
                                        <td><?= $disposisiatas->perihal; ?></td>
                                        <td><?= $disposisiatas->catatan_kadiv; ?></td>
                                        <td>
                                            <?php if ($disposisiatas->progres_surat == 'Proses') : ?>
                                                <span class="badge rounded-pill badge-primary">Proses</span>

                                            <?php elseif ($disposisiatas->progres_surat == 'Proses Disposisi') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Disposisi</span>

                                            <?php elseif ($disposisiatas->progres_surat == 'Handle') : ?>
                                                <span class="badge rounded-pill badge-warning">Handle</span>

                                            <?php elseif ($disposisiatas->progres_surat == 'Finish') : ?>
                                                <span class="badge rounded-pill badge-success">Finish</span>

                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $disposisiatas->handler_surat; ?></td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modal-disposisi" data-id_surat_masuk="<?= $disposisiatas->id_surat_masuk; ?>" data-tgl_surat="<?= $disposisiatas->tgl_surat; ?>" data-no_surat="<?= $disposisiatas->no_surat; ?>" data-perihal="<?= $disposisiatas->perihal; ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="history">
                                                    <a href="/riwayat/riwayat_surat_masuk/<?= $disposisiatas->id_surat_masuk; ?>">
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
                    <h3>Disposisi Kebawahan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-8">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File</th>
                                    <th>Bpr/Klien</th>
                                    <th>Tgl Surat</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Disposisi Kadiv</th>
                                    <th>Disposisi Dirops</th>
                                    <th>Disposisi Dirut</th>
                                    <th>Progres Surat</th>
                                    <th>Status Disposisi</th>
                                    <th>Handler Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($disposisibawahans as $disposisibawahan) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="action">
                                            <?php if (!empty($disposisibawahan->file)) : ?>
                                                <?php $file_url = base_url('file/surat_masuk/' . $disposisibawahan->file); ?>

                                                <!-- Preview untuk PDF -->
                                                <?php if (preg_match('/\.pdf$/i', $disposisibawahan->file)) : ?>
                                                    <a href="" class="preview-file pdf" data-toggle="modal" data-target="#previewModal" data-file-url="<?php echo $file_url; ?>" data-id="<?php echo $disposisibawahan->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-pdf"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Preview untuk Gambar -->
                                                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $disposisibawahan->file)) : ?>
                                                    <a href="#" class="image-preview" data-toggle="modal" data-target="#imageModal" data-file-url="<?= $file_url; ?>" data-id="<?php echo $disposisibawahan->id_surat_masuk; ?>">
                                                        <i class="icofont icofont-file-jpg"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Tautan untuk Dokumen Word -->
                                                <?php if (preg_match('/\.docx?$/i', $disposisibawahan->file)) : ?>
                                                    <a href="<?php echo $file_url; ?>" target="_blank" onclick="updateStatus(<?php echo $disposisibawahan->id; ?>)">
                                                        Open Word Document
                                                    </a>
                                                <?php endif; ?>

                                            <?php else : ?>
                                                <span>Tidak ada file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $disposisibawahan->nama_klien; ?></td>
                                        <td><?= $disposisibawahan->tgl_surat; ?></td>
                                        <td>
                                            <a href="#" class="lihat-komentar" data-toggle="modal" data-target="#komentarModal"
                                                data-id="<?= $disposisibawahan->id_surat_masuk; ?>">
                                                <?= $disposisibawahan->no_surat; ?>
                                            </a>
                                        </td>
                                        <td><?= $disposisibawahan->perihal; ?></td>
                                        <td><?= $disposisibawahan->disposisi_kadiv; ?></td>
                                        <td><?= $disposisibawahan->disposisi_dirops; ?></td>
                                        <td><?= $disposisibawahan->disposisi_dirut; ?></td>
                                        <td>
                                            <?php if ($disposisibawahan->progres_surat == 'Proses') : ?>
                                                <span class="badge rounded-pill badge-primary">Proses</span>

                                            <?php elseif ($disposisibawahan->progres_surat == 'Proses Disposisi') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Disposisi</span>

                                            <?php elseif ($disposisibawahan->progres_surat == 'Handle') : ?>
                                                <span class="badge rounded-pill badge-warning">Handle</span>

                                            <?php elseif ($disposisibawahan->progres_surat == 'Finish') : ?>
                                                <span class="badge rounded-pill badge-success">Finish</span>

                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($disposisibawahan->status_disposisi_kadiv == 'belum disposisi') : ?>
                                                <span class="badge rounded-pill badge-primary">Belum Diposisi</span>
                                            <?php elseif ($disposisibawahan->status_disposisi_kadiv == 'sudah disposisi') : ?>
                                                <span class="badge rounded-pill badge-success">Sudah Diposisi</span>
                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $disposisibawahan->handler_surat; ?></td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modal-disposisi-bawah" data-id_surat_masuk="<?= $disposisibawahan->id_surat_masuk; ?>" data-tgl_surat="<?= $disposisibawahan->tgl_surat; ?>" data-no_surat="<?= $disposisibawahan->no_surat; ?>" data-perihal="<?= $disposisibawahan->perihal; ?>"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="history">
                                                    <a href="/riwayat/riwayat_surat_masuk/<?= $disposisibawahan->id_surat_masuk; ?>">
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
<!-- Modal Disposisi -->
<div class="modal fade bd-example-modal-lg" id="modal-disposisi" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('kadiv/surat-masuk/disposisi-atas') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Disposisi</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_surat_masuk" id="id_surat_masuk">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="no_surat">Nomor Surat</label>
                                <input class="form-control" id="no_surat" name="no_surat" type="text" placeholder="Nomor Surat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="tgl_surat">Tanggal Surat</label>
                                <input class="form-control" id="tgl_surat" name="tgl_surat" type="date" placeholder="Tanggal Surat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="perihal">Perihal</label>
                                <input class="form-control" id="perihal" name="perihal" type="text" placeholder="Perihal" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="perihal">Catatan</label>
                                <textarea class="form-control" name="catatan_kadiv" id="catatan_kadiv"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="tgl_surat">Pilih Dirops</label>
                                <select class="form-control" id="namadirops" name="namadirops">
                                    <option value="">Pilih Dirops</option>
                                    <?php foreach ($users as $row) : ?>
                                        <option value="<?= $row->id_user ?>"><?= $row->nama_user ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <!-- <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <button class="btn btn-secondary" type="submit">Disposisi</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Disposisi Kebawahan -->
<div class="modal fade bd-example-modal-lg" id="modal-disposisi-bawah" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('kadiv/surat-masuk/disposisi-bawah') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Disposisi</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_surat_masuk" id="id_surat_masuk">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="no_surat">Nomor Surat</label>
                                <input class="form-control" id="no_surat" name="no_surat" type="text" placeholder="Nomor Surat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="tgl_surat">Tanggal Surat</label>
                                <input class="form-control" id="tgl_surat" name="tgl_surat" type="date" placeholder="Tanggal Surat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="perihal">Perihal</label>
                                <input class="form-control" id="perihal" name="perihal" type="text" placeholder="Perihal" readonly>
                            </div>
                        </div>
                    </div>
                    <small class="ml-3" style="color:red; font-size:17px;">* Pilih salah satu diposisisi, melalui dropdown atau input manual</small>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label>Disposisi</label>
                                <select class="form-control" id="disposisi_kadiv_select" name="disposisi_kadiv_select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Tindaklanjuti">Tindaklanjuti</option>
                                    <option value="Dokumentasikan">Dokumentasikan</option>
                                    <option value="Fasilitasi">Fasilitasi</option>
                                    <option value="Persiapkan tim">Persiapkan tim</option>
                                    <option value="Kirim penawaran">Kirim penawaran</option>
                                    <option value="Diarsipkan">Diarsipkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Diposisi Lainya</label>
                                <textarea class="form-control" name="disposisi_kadiv_manual" id="disposisi_kadiv_manual"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="namastaf">Pilih Staf/Kadiv</label>
                                <select class="form-control" id="namastaf" name="namastaf">
                                    <option value="">Pilih Staf/Kadiv</option>
                                    <!-- Staf Divisi Sendiri -->
                                    <optgroup label="Staf Divisi Sendiri">
                                        <?php foreach ($staf_users as $user): ?>
                                            <option value="<?= $user->id_user; ?>"><?= $user->nama_user; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>

                                    <!-- Kadiv Divisi Lain (Hanya Jika Kadiv CBS) -->
                                    <?php if (!empty($kadiv_lain)): ?>
                                        <optgroup label="Kadiv Divisi Lain">
                                            <?php foreach ($kadiv_lain as $kadiv): ?>
                                                <option value="<?= $kadiv->id_user; ?>"> <?= $kadiv->nama_user; ?> (<?= $kadiv->divisi; ?>)</option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <!-- <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <button class="btn btn-secondary" type="submit">Disposisi</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form>
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

<!-- Modal Disposisi -->
<script>
    $('#modal-disposisi').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id_surat_masuk = button.data('id_surat_masuk');
        var no_surat = button.data('no_surat');
        var tgl_surat = button.data('tgl_surat');
        var perihal = button.data('perihal');

        var modal = $(this);
        modal.find('.modal-body #id_surat_masuk').val(id_surat_masuk);
        modal.find('.modal-body #no_surat').val(no_surat);
        modal.find('.modal-body #tgl_surat').val(tgl_surat);
        modal.find('.modal-body #perihal').val(perihal);
    });
</script>
<script>
    $('#modal-disposisi-bawah').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id_surat_masuk = button.data('id_surat_masuk');
        var no_surat = button.data('no_surat');
        var tgl_surat = button.data('tgl_surat');
        var perihal = button.data('perihal');

        var modal = $(this);
        modal.find('.modal-body #id_surat_masuk').val(id_surat_masuk);
        modal.find('.modal-body #no_surat').val(no_surat);
        modal.find('.modal-body #tgl_surat').val(tgl_surat);
        modal.find('.modal-body #perihal').val(perihal);
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