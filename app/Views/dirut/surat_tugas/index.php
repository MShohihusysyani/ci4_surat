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
                <h3>Surat Tugas</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Surat Tugas</li>
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
                    <h3>Surat Tugas</h3>
                    <?php if (session()->get('divisi') == 'umum') : ?>
                        <a href="surat-tugas/tambah" class="btn btn-primary"> <i class="icon-plus"></i></a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Unit Kerja</th>
                                    <th>Tempat Dituju</th>
                                    <th>Tugas</th>
                                    <!-- <th>Status</th> -->
                                    <th>Progres</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($surat_tugas as $surattugas) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $surattugas->no_surat; ?></td>
                                        <td><?= $surattugas->unit_kerja; ?></td>
                                        <td><?= $surattugas->tempat; ?></td>
                                        <td><?= $surattugas->tugas; ?></td>
                                        <td>
                                            <?php if ($surattugas->progres == 'proses draft') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Draft</span>

                                            <?php elseif ($surattugas->progres == 'draft') : ?>
                                                <span class="badge rounded-pill badge-primary">Draft</span>

                                            <?php elseif ($surattugas->progres == 'Proses Approve') : ?>
                                                <span class="badge rounded-pill badge-info">Proses Approve</span>

                                            <?php elseif ($surattugas->progres == 'Approve') : ?>
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
                                                    <?php
                                                    $user_role   = session()->get('role');
                                                    $user_divisi = strtolower(session()->get('divisi')); // biar konsisten huruf kecil
                                                    $progres     = $surattugas->progres;

                                                    // Daftar progres yang diizinkan untuk diedit
                                                    $progres_boleh = ['draft', 'proses draft', 'revisi-1', 'revisi-2', 'revisi-3'];

                                                    // Cek semua syarat sekaligus
                                                    if (
                                                        $user_role === 'kadiv' &&
                                                        $user_divisi === 'umum' &&
                                                        in_array($progres, $progres_boleh)
                                                    ):
                                                    ?>
                                                        <li>
                                                            <a class="dropdown-item" href="surat-tugas/edit/<?= $surattugas->id_surat_tugas ?>">
                                                                <i class="icon-pencil-alt"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item"><a href="surat-tugas/hapus/<?= $surattugas->id_surat_tugas ?>" class="tombol-hapus"><i class="icon-trash"></i> Hapus</a></li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a class="dropdown-item preview"
                                                            data-id_surat_tugas="<?= $surattugas->id_surat_tugas; ?>"
                                                            data-tipe="surattugas">
                                                            <i class="icon-eye"></i> Preview
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="#"
                                                            data-bs-toggle="modal"
                                                            data-original-title="test"
                                                            data-bs-target="#modal-disposisi"
                                                            data-id_surat_tugas="<?= $surattugas->id_surat_tugas; ?>"
                                                            data-no_surat="<?= $surattugas->no_surat; ?>"
                                                            data-tugas="<?= $surattugas->tugas; ?>"
                                                            data-tempat="<?= $surattugas->tempat; ?>"
                                                            data-alamat="<?= $surattugas->alamat; ?>"
                                                            data-unit_kerja="<?= $surattugas->unit_kerja; ?>"
                                                            data-anggota="<?= $surattugas->anggota; ?>">
                                                            <i class="icon-pencil-alt"></i> Approve
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="/riwayat/riwayat_surat_keluar/<?= $surattugas->id_surat_tugas; ?>">
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

<!-- Modal Disposisi -->
<div class="modal fade bd-example-modal-lg" id="modal-disposisi" tabindex=" -1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('dirut/surat-tugas/approve') ?>" method="post"> <!-- Form MULAI DI SINI -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Approve</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_surat_tugas" id="id_surat_tugas">
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
                                <label class="form-label" for="tugas">Maksud Penugasan</label>
                                <input class="form-control" id="tugas" name="tugas" type="text" placeholder="Perihal" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="tempat">Tempat</label>
                                <input class="form-control" id="tempat" name="tempat" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <input class="form-control" id="alamat" name="alamat" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="unit_kerja">Unit Kerja</label>
                                <input class="form-control" id="unit_kerja" name="unit_kerja" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="anggota">Anggota</label>
                                <input class="form-control" id="anggota" name="tempat" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="perihal">Catatan</label>
                                <textarea class="form-control" name="catatan_kadiv" id="catatan_kadiv"></textarea>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <!-- Tombol submit HARUS DI DALAM form -->
                    <!-- <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <button class="btn btn-secondary" type="submit">Approve</button> <!-- TYPE = submit -->
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
        var id_surat_tugas = button.data('id_surat_tugas');
        var no_surat = button.data('no_surat');
        var tugas = button.data('tugas');
        var tempat = button.data('tempat');
        var alamat = button.data('alamat');
        var unit_kerja = button.data('unit_kerja');
        var anggota = button.data('anggota');

        var modal = $(this);
        modal.find('.modal-body #id_surat_tugas').val(id_surat_tugas);
        modal.find('.modal-body #no_surat').val(no_surat);
        modal.find('.modal-body #tugas').val(tugas);
        modal.find('.modal-body #tempat').val(tempat);
        modal.find('.modal-body #alamat').val(alamat);
        modal.find('.modal-body #unit_kerja').val(unit_kerja);
        modal.find('.modal-body #anggota').val(anggota);
    });
</script>
<script>
    $(document).on('click', '.preview', function(e) {
        e.preventDefault();

        var id_surat_tugas = $(this).data('id_surat_tugas');

        // 1. Tampilkan Lottie Loader
        $('#lottie-loader-overlay').removeClass('hidden');

        $.ajax({
            url: '/export/print-surat-tugas/' + id_surat_tugas,
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