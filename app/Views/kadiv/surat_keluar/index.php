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
                <h3>Surat Keluar</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Surat Keluar</li>
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
                    <a href="surat-keluar/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                foreach ($suratkeluars as $suratkeluar) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $suratkeluar->tgl_surat; ?></td>
                                        <td><?= $suratkeluar->no_surat; ?></td>
                                        <td><?= $suratkeluar->nama_klien; ?></td>
                                        <td><?= $suratkeluar->perihal; ?></td>
                                        <td>
                                            <?php if ($suratkeluar->progres == 'proses draft') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Draft</span>

                                            <?php elseif ($suratkeluar->progres == 'draft') : ?>
                                                <span class="badge rounded-pill badge-primary">Draft</span>

                                            <?php elseif ($suratkeluar->progres == 'Proses Disposisi') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Disposisi</span>

                                            <?php elseif ($suratkeluar->progres == 'Approve') : ?>
                                                <span class="badge rounded-pill badge-success">Approve</span>

                                            <?php else : ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icon-settings"></i> Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if ($suratkeluar->jenis_surat != 'manual') : ?>
                                                        <li>
                                                            <a class="dropdown-item preview"
                                                                data-id_surat_keluar="<?= $suratkeluar->id_surat_keluar; ?>"
                                                                data-template="<?= $suratkeluar->template ?? '' ?>"
                                                                data-tipe="suratkeluar">
                                                                <i class="icon-eye"></i> Preview
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a class="dropdown-item" href="/riwayat/riwayat_surat_keluar/<?= $suratkeluar->id_surat_keluar; ?>">
                                                            <i class="icon-arrow-circle-left"></i> Riwayat
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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

<div class="modal fade bd-example-modal-lg" id="previewModal" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>


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
                    $('#previewModal .modal-body').html(
                        `<embed src="data:application/pdf;base64,${response.pdf}" type="application/pdf" width="100%" height="500px">`
                    );
                    $('#download-pdf').attr('href', `data:application/pdf;base64,${response.pdf}`);
                    $('#download-pdf').attr('download', response.filename);

                    // 3. Tampilkan modalnya
                    $('#previewModal').modal('show');

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
    $('#previewModal').on('shown.bs.modal', function() {
        // Baru sembunyikan loader sekarang untuk transisi yang mulus
        $('#lottie-loader-overlay').addClass('hidden');
    });
</script>

<?= $this->endSection() ?>