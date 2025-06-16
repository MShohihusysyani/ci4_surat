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

                                            <?php elseif ($suratkeluar->progres == 'Proses Approve') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Approve</span>

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
                                                        <a class="dropdown-item"
                                                            href="#"
                                                            data-bs-toggle="modal"
                                                            data-original-title="test"
                                                            data-bs-target="#modal-disposisi"
                                                            data-id_surat_keluar="<?= $suratkeluar->id_surat_keluar; ?>"
                                                            data-tgl_surat="<?= $suratkeluar->tgl_surat; ?>"
                                                            data-no_surat="<?= $suratkeluar->no_surat; ?>"
                                                            data-perihal="<?= $suratkeluar->perihal; ?>">
                                                            <i class="icon-pencil-alt"></i> Disposisi
                                                        </a>
                                                    </li>
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

<!-- Modal Disposisi Keatasan -->
<div class="modal fade bd-example-modal-lg" id="modal-disposisi" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form-disposisi" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Disposisi</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_surat_keluar" id="id_surat_keluar">
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
                                <label>Pilih</label>
                                <select class="form-control" id="jenis_disposisi">
                                    <option value="">-- Pilih --</option>
                                    <option value="disposisi_atas">Approve</option>
                                    <option value="catatan">Catatan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="disposisi-atas" style="display: none;">
                        <button class="btn btn-secondary" type="button" onclick="submitFormAction('disposisi-atas')">Approve</button>
                    </div>

                    <div id="catatan" style="display: none;">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan_dirops" id="catatan_dirops"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="button" onclick="submitFormAction('catatan')">Submit</button>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <!-- <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <!-- TYPE = submit -->
                </div>
            </div>
        </form>
    </div>
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

<!-- Modal Disposisi -->
<script>
    $('#modal-disposisi').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id_surat_keluar = button.data('id_surat_keluar');
        var no_surat = button.data('no_surat');
        var tgl_surat = button.data('tgl_surat');
        var perihal = button.data('perihal');

        var modal = $(this);
        modal.find('.modal-body #id_surat_keluar').val(id_surat_keluar);
        modal.find('.modal-body #no_surat').val(no_surat);
        modal.find('.modal-body #tgl_surat').val(tgl_surat);
        modal.find('.modal-body #perihal').val(perihal);
    });
</script>

<script>
    // Event listener untuk menangani perubahan pilihan jenis surat
    document.getElementById('jenis_disposisi').addEventListener('change', function() {
        let selectedValue = this.value;

        // Sembunyikan semua form terlebih dahulu
        document.getElementById('disposisi-atas').style.display = 'none';
        document.getElementById('catatan').style.display = 'none';

        // Tampilkan form yang sesuai berdasarkan pilihan
        if (selectedValue === 'disposisi_atas') {
            document.getElementById('disposisi-atas').style.display = 'block';
        } else if (selectedValue === 'catatan') {
            document.getElementById('catatan').style.display = 'block';
        }
    });
</script>


<script>
    function submitFormAction(actionType) {
        let form = document.getElementById('form-disposisi');
        let id_surat_keluar = document.getElementById('id_surat_keluar').value;
        console.log("Id surat yang dikirim: ", id_surat_keluar);
        if (actionType === 'disposisi-atas') {
            form.action = '/dirut/surat-keluar/approve';
        } else if (actionType === 'catatan') {
            form.action = '/dirut/surat-keluar/catatan';
        }
        form.submit();
    }
</script>
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