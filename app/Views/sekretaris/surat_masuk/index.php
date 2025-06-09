<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Terima</th>
                                    <th>File</th>
                                    <th>Bpr/Klien</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Status Surat</th>
                                    <th>Progres Surat</th>
                                    <th>Status balas</th>
                                    <th>Handler Surat</th>
                                    <th>Tags</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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

<!-- Modal Disposisi -->
<div class="modal fade bd-example-modal-lg" id="modal-disposisi" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('surat-masuk/disposisi-kadiv') ?>" method="post"> <!-- Form MULAI DI SINI -->
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
                                <label class="form-label" for="tgl_surat">Pilih Kadiv</label>
                                <select class="form-control" id="namakadiv" name="namakadiv">
                                    <option value="">Pilih Kadiv</option>
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

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('kelola/tambah-role') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="nama_role">Nama Role</label>
                                <input class="form-control" id="nama_role" name="nama_role" type="text" placeholder="Masukkan nama role" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Save changes</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form> <!-- Form DITUTUP DI SINI -->
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('kelola/edit-role') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_role" id="id_role">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="nama_role">Nama Role</label>
                                <input class="form-control" id="nama_role" name="nama_role" type="text" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Save changes</button> <!-- TYPE = submit -->
                </div>
            </div>
        </form> <!-- Form DITUTUP DI SINI -->
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>
<!-- JS serverside -->
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#basic-1')) {
            $('#basic-1').DataTable().clear().destroy();
        }
        $('#basic-1').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "<?= site_url('surat-masuk/ajax-surat-masuk') ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "tgl_terima"
                },
                {
                    "data": "file"
                },
                {
                    "data": "nama_klien"
                },
                {
                    "data": "no_surat"
                },
                {
                    "data": "perihal"
                },
                {
                    "data": "status_surat"
                },
                {
                    "data": "progres_surat"
                },
                {
                    "data": "status_balas"
                },
                {
                    "data": "handler_surat"
                },
                {
                    "data": "tags"
                },
                {
                    "data": "aksi"
                }
            ],
            "order": [
                [1, 'desc']
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false,
                "render": function(data, type, row, meta) {
                    return data;
                }
            }]
        });
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

            // // Update status ke server
            // $.ajax({
            //     url: '<?= base_url('surat-masuk/update-status') ?>/' + suratId,
            //     type: 'POST',
            //     success: function(response) {
            //         // Opsional: bisa refresh table atau kasih notif sukses
            //         console.log('Status berhasil diperbarui');
            //     },
            //     error: function() {
            //         alert('Terjadi kesalahan saat memperbarui status.');
            //     }
            // });
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
<!-- Modal Disposis -->
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

<?= $this->endSection() ?>