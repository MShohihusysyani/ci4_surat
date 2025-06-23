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
                    <h3>Filter</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" id="toggle-filter">
                        <span class="icon-filter"></span>Filter
                    </button>
                    <form id="form-filter">
                        <div class="row d-none" id="form-filter-wrapper">
                            <!-- Tanggal Awal -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Awal</label>
                                    <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control">
                                    <!-- <input class="datepicker-here form-control digits" type="text" data-language="en" id="tanggal_awal" name="tanggal_awal"> -->
                                </div>
                            </div>

                            <!-- Tanggal Akhir -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control">
                                    <!-- <input class="datepicker-here form-control digits" type="text" data-language="en" id="tanggal_akhir" name="tanggal_akhir"> -->
                                </div>
                            </div>

                            <!-- Pilih Klien -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Klien</label>
                                    <select class="form-control js-example-basic-single" id="nama_klien" name="nama_klien">
                                        <option value="">-- Pilih Klien --</option>
                                        <?php foreach ($kliens as $klien): ?>
                                            <option value="<?= $klien->id_klien ?>">
                                                <?= $klien->no_klien . ' - ' . $klien->nama_klien ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Progres</label>
                                    <select class="form-control js-example-basic-single" id="progres" name="progres">
                                        <option value="">-- Pilih --</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Proses Disposisi">Proses Disposisi</option>
                                        <option value="Handle">Handle</option>
                                        <option value="Finish">Finish</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-primary" id="filter" type="submit"> <span class="icon-filter"></span>Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Surat Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <form action="" method="POST">
                            <button type="button" id="export_pdf" class="btn btn-danger" style="margin-right: 10px;">
                                <i class="fa fa-file-pdf-o">Pdf</i>
                            </button>
                        </form>
                        <form action="" method="POST">
                            <button type="button" id="export_excel" class="btn btn-success">
                                <i class="fa fa-file-excel-o">Excel</i>
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                    <th>BPR/Klien</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Progres</th>
                                    <th>Status Balas</th>
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
<!-- animasi -->
<div id="lottie-loader-overlay" class="hidden">
    <dotlottie-player src="https://lottie.host/76b2e413-aa9e-4831-a747-ebf842fcf8c0/JtDR6u8OzR.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
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
<!-- font -->
<script src="<?= base_url() ?>/assets/js/icons/icons-notify.js"></script>
<script src="<?= base_url() ?>/assets/js/icons/icon-clipart.js"></script>
<!-- lottie -->
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<!-- JS serverside -->
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#basic-1')) {
            $('#basic-1').DataTable().clear().destroy();
        }

        var table = $('#basic-1').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('laporan/ajax-surat-masuk') ?>",
                type: 'POST',
                data: function(d) {
                    d.tanggal_awal = $('#tanggal_awal').val();
                    d.tanggal_akhir = $('#tanggal_akhir').val();
                    d.nama_klien = $('#nama_klien').val();
                    d.progres = $('#progres').val();
                }
            },
            columns: [{
                    data: 'no',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_terima'
                },
                {
                    data: 'file',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_klien'
                },
                {
                    data: 'no_surat'
                },
                {
                    data: 'perihal'
                },
                {
                    data: 'status_surat'
                },
                {
                    data: 'progres_surat'
                },
                {
                    data: 'status_balas'
                },
                {
                    data: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'desc']
            ]
        });

        // Trigger reload table saat form filter disubmit
        $('#form-filter').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });


        // Reset tombol reload data dan reset form
        $('button[type="reset"]').on('click', function() {
            $('#tanggal_awal').val('');
            $('#tanggal_akhir').val('');
            $('#nama_klien').val('');
            $('#nama_produk').val('');
            $('#nama_perusahaan').val('');
            table.ajax.reload();
        });

        // Preview modal script tetap sama, atau sesuaikan sesuai data baru
    });

    // Handle export buttons
    $('#export_pdf').on('click', function() {
        exportData('pdf');
    });

    $('#export_excel').on('click', function() {
        exportData('excel');
    });


    function exportData(format) {
        $('#lottie-loader-overlay').removeClass('hidden'); // Tampilkan loader

        var filters = {
            tanggal_awal: $('#tanggal_awal').val(),
            tanggal_akhir: $('#tanggal_akhir').val(),
            nama_klien: $('#nama_klien').val(),
            progres: $('#progres').val()
        };

        var actionUrl = format === 'pdf' ?
            '<?= base_url('export/surat-masuk-pdf'); ?>' :
            '<?= base_url('export/surat-masuk-excel'); ?>';

        // Kirim request menggunakan AJAX dan terima file sebagai Blob
        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: filters,
            xhrFields: {
                responseType: 'blob' // Penting agar bisa proses file
            },
            success: function(response, status, xhr) {
                // Ambil nama file dari header jika ada
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('filename=') !== -1) {
                    filename = disposition.split('filename=')[1].replace(/"/g, '');
                } else {
                    filename = format === 'pdf' ? 'Laporan.pdf' : 'Laporan.xlsx';
                }

                // Buat link download dari blob
                var blob = new Blob([response], {
                    type: xhr.getResponseHeader('Content-Type')
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                $('#lottie-loader-overlay').addClass('hidden'); // Sembunyikan loader
            },
            error: function() {
                alert('Gagal mengekspor data!');
                $('#lottie-loader-overlay').addClass('hidden');
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#toggle-filter').on('click', function() {
            $('#form-filter-wrapper').toggleClass('d-none');
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