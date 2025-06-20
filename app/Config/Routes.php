<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/cekUser', 'Auth::cekUser');
$routes->get('logout', 'Auth::logout');

// Route untuk login
$routes->group('/', ['filter' => 'login'], function ($routes) {
    $routes->get('home', 'Home::index');
});

// Route Kelola data
$routes->group('kelola', ['filter' => 'role:superadmin'], function ($routes) {
    // Role
    $routes->get('role', 'Role::index');
    $routes->post('tambah-role', 'Role::tambah');
    $routes->post('edit-role', 'Role::update');
    $routes->get('hapus-role/(:num)', 'Role::hapus/$1');

    // Jabatan
    $routes->get('jabatan', 'Jabatan::index');
    $routes->post('tambah-jabatan', 'Jabatan::tambah');
    $routes->post('edit-jabatan', 'Jabatan::update');
    $routes->get('hapus-jabatan/(:num)', 'Jabatan::hapus/$1');

    // Karyawan
    $routes->get('karyawan', 'Karyawan::index');
    $routes->get('karyawan/tambah', 'Karyawan::tambah');
    $routes->post('karyawan/simpan', 'Karyawan::simpan');
    $routes->get('karyawan/edit/(:segment)', 'Karyawan::edit/$1');
    $routes->post('karyawan/update/(:num)', 'Karyawan::update/$1');
    $routes->get('karyawan/hapus/(:num)', 'Karyawan::hapus/$1');

    // User
    $routes->get('user', 'User::index');
    $routes->get('user/tambah', 'User::tambah');
    $routes->post('user/simpan', 'User::simpan');
    $routes->get('user/edit/(:segment)', 'User::edit/$1');
    $routes->post('user/update/(:num)', 'User::update/$1');
    $routes->get('user/hapus/(:num)', 'User::hapus/$1');
    $routes->post('user/update-status', 'User::update_status');

    //Klien
    $routes->get('klien', 'Klien::index');
    $routes->get('klien/tambah', 'Klien::tambah');
    $routes->post('klien/simpan', 'Klien::simpan');
    $routes->get('klien/edit/(:segment)', 'Klien::edit/$1');
    $routes->post('klien/update/(:num)', 'Klien::update/$1');
    $routes->get('klien/hapus/(:num)', 'Klien::hapus/$1');

    // Produk
    $routes->get('produk', 'Produk::index');
    $routes->get('produk/tambah', 'Produk::tambah');
    $routes->post('produk/simpan', 'Produk::simpan');
    $routes->get('produk/edit/(:segment)', 'Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');
    $routes->get('produk/hapus/(:num)', 'Produk::hapus/$1');

    // Klien Produk
    $routes->get('klien-produk', 'KlienProduk::index');
    $routes->get('klien-produk/tambah', 'KlienProduk::tambah');
    $routes->post('klien-produk/simpan', 'KlienProduk::simpan');
    $routes->get('klien-produk/edit/(:segment)', 'KlienProduk::edit/$1');
    $routes->post('klien-produk/update/(:num)', 'KlienProduk::update/$1');
    $routes->get('klien-produk/hapus/(:num)', 'KlienProduk::hapus/$1');
    $routes->get('get-nama-klien/(:any)', 'KlienProduk::getNamaKlien/$1');
    $routes->get('get-deskripsi-produk/(:any)', 'KlienProduk::getDeskripsiProduk/$1');

    // Perusahaan
    $routes->get('perusahaan', 'Perusahaan::index');
    $routes->get('perusahaan/tambah', 'Perusahaan::tambah');
    $routes->post('perusahaan/simpan', 'Perusahaan::simpan');
    $routes->get('perusahaan/edit/(:segment)', 'Perusahaan::edit/$1');
    $routes->post('perusahaan/update/(:num)', 'Perusahaan::update/$1');
    $routes->get('perusahaan/hapus/(:num)', 'Perusahaan::hapus/$1');
});

// Wilayah
$routes->group('wilayah', function ($routes) {
    $routes->get('getKabupaten/(:num)', 'Wilayah::getKabupaten/$1');
    $routes->get('getKecamatan/(:num)', 'Wilayah::getKecamatan/$1');
    $routes->get('getKelurahan/(:num)', 'Wilayah::getKelurahan/$1');
    $routes->get('getKodePos/(:num)', 'Wilayah::getKodePos/$1');
});

// Route Surat Masuk 
// $routes->group('surat-masuk', function ($routes) {
//     // Sekretaris
//     $routes->group('sekretaris', function ($routes) {
//         $routes->get('', 'Sekretaris\SuratMasuk::index');
//         $routes->post('ajax-surat-masuk', 'Sekretaris\SuratMasuk::ajax_surat_masuk');
//     });
// });

// Route Klien
$routes->group('klien', ['filter' => 'role:klien'], function ($routes) {
    $routes->get('surat', 'Klien\SuratMasuk::index');
    $routes->get('surat/tambah', 'Klien\SuratMasuk::tambah');
    $routes->post('surat/simpan', 'Klien\SuratMasuk::simpan');
    $routes->get('surat/edit/(:segment)', 'Klien\SuratMasuk::edit/$1');
    $routes->post('surat/update/(:num)', 'Klien\SuratMasuk::update/$1');
    $routes->get('surat/hapus/(:num)', 'Klien\SuratMasuk::hapus/$1');
    $routes->get('surat/detail/(:num)', 'Klien\SuratMasuk::detail/$1');
    $routes->post('surat-masuk/balas-surat', 'Klien\SuratMasuk::balas_surat');
});

// Route Surat Masuk Sekretaris
$routes->group('surat-masuk', ['filter' => 'role:sekretaris'], function ($routes) {
    $routes->get('', 'Sekretaris\SuratMasuk::index');
    $routes->post('ajax-surat-masuk', 'Sekretaris\SuratMasuk::ajax_surat_masuk');
    $routes->post('disposisi-kadiv', 'Sekretaris\SuratMasuk::disposisi_kadiv');

    // Balas Surat
    $routes->get('balas/(:num)', 'Sekretaris\SuratMasuk::balas/$1');
    $routes->post('balas-surat', 'Sekretaris\SuratMasuk::simpan_balasan');
    $routes->get('pilih-template', 'Sekretaris\SuratMasuk::pilih_template');
    $routes->post('simpan-balasan-final', 'Sekretaris\SuratMasuk::simpan_balasan_final');
});

// Routes Kadiv
$routes->group('kadiv', ['filter' => 'role:kadiv'], function ($routes) {
    // Surat Masuk
    $routes->get('surat-masuk', 'Kadiv\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-atas', 'Kadiv\SuratMasuk::disposisi_keatasan');
    $routes->post('surat-masuk/disposisi-bawah', 'Kadiv\SuratMasuk::disposisi_kebawahan');

    // Surat Keluar
    $routes->get('surat-keluar', 'Kadiv\SuratKeluar::index');
    $routes->post('surat-keluar/disposisi', 'Kadiv\SuratKeluar::disposisi');
    $routes->post('surat-keluar/approve', 'Kadiv\SuratKeluar::approve');

    $routes->get('surat-tugas', 'SuratTugas::index');
    $routes->get('surat-tugas/generate-nomor-surat', 'SuratTugas::generate_nomor_surat');
    $routes->get('surat-tugas/tambah', 'SuratTugas::tambah', ['filter' => 'divisi:umum']);
    $routes->post('surat-tugas/simpan-draft', 'SuratTugas::simpan_draft');
    $routes->get('surat-tugas/pilih-template', 'SuratTugas::pilih_template');
    $routes->get('surat-tugas/preview-template/(:segment)', 'SuratTugas::preview_template/$1');
    $routes->post('surat-tugas/preview', 'SuratTugas::preview');
    $routes->post('surat-tugas/simpan-draft-final', 'SuratTugas::simpan_draft_final');
    $routes->get('surat-tugas/edit/(:segment)', 'SuratTugas::edit/$1');
    $routes->post('surat-tugas/update/(:num)', 'SuratTugas::update/$1');
    $routes->get('surat-tugas/hapus/(:num)', 'SuratTugas::hapus/$1');
    $routes->post('surat-tugas/disposisi', 'SuratTugas::disposisi');
});

// Routes Surat  Dirops
$routes->group('dirops', ['filter' => 'role:dirops'], function ($routes) {
    $routes->get('surat-masuk', 'Dirops\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-atas', 'Dirops\SuratMasuk::disposisi_keatasan');
    $routes->post('surat-masuk/disposisi-bawah', 'Dirops\SuratMasuk::disposisi_kebawahan');

    // Surat Keluar
    $routes->get('surat-keluar', 'Dirops\SuratKeluar::index');
    $routes->post('surat-keluar/disposisi', 'Dirops\SuratKeluar::disposisi');
    $routes->post('surat-keluar/approve', 'Dirops\SuratKeluar::approve');
});

// Routes Surat Masuk Dirut
$routes->group('dirut', ['filter' => 'role:dirut'], function ($routes) {
    $routes->get('surat-masuk', 'Dirut\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-bawah', 'Dirut\SuratMasuk::disposisi_kebawahan');

    // Surat Keluar
    $routes->get('surat-keluar', 'Dirut\SuratKeluar::index');
    $routes->post('surat-keluar/approve', 'Dirut\SuratKeluar::approve');
});

// Routes Surat Masuk Staf
$routes->group('staf', ['filter' => 'role:staf'], function ($routes) {
    $routes->get('surat-masuk', 'Staf\SuratMasuk::index');
    $routes->post('surat-masuk/finish', 'Staf\SuratMasuk::finish_surat');
});

// Tambah Surat Masuk
$routes->group('suratmasuk', ['filter' => 'role:sekretaris, kadiv, dirops'], function ($routes) {
    $routes->get('', 'SuratMasuk::index');
    $routes->get('tambah', 'SuratMasuk::tambah');
    $routes->post('simpan', 'SuratMasuk::simpan');
    $routes->get('edit/(:segment)', 'SuratMasuk::edit/$1');
    $routes->post('update/(:num)', 'SuratMasuk::update/$1');
    $routes->get('hapus/(:num)', 'SuratMasuk::hapus/$1');
});
$routes->post('produk/getProdukByPerusahaan', 'Produk::get_produk_by_perusahaan');

// Tambah surat keluar
$routes->group('suratkeluar', ['filter' => 'role:kadiv, dirops'], function ($routes) {
    $routes->get('', 'SuratKeluar::index');
    $routes->get('tambah', 'SuratKeluar::tambah');
    $routes->post('simpan-draft', 'SuratKeluar::simpan_draft');
    $routes->get('pilih-template', 'SuratKeluar::pilih_template');
    $routes->get('preview-template/(:segment)', 'SuratKeluar::preview_template/$1');
    $routes->post('backdate', 'SuratKeluar::preview_backdate');
    $routes->post('pengumuman', 'SuratKeluar::preview_pengumuman');
    $routes->post('simpan-draft-final', 'SuratKeluar::simpan_draft_final');
    $routes->get('edit/(:segment)', 'SuratKeluar::edit/$1');
    $routes->post('update/(:num)', 'SuratKeluar::update/$1');
    $routes->get('hapus/(:num)', 'SuratKeluar::hapus/$1');
});

// Tambah Surat Tugas
$routes->group('surattugas', ['filter' => 'role:kadiv'], function ($routes) {
    $routes->get('', 'SuratTugas::index');
    $routes->get('tambah', 'SuratTugas::tambah');
    $routes->post('simpan-draft', 'SuratTugas::simpan_draft');
    $routes->get('pilih-template', 'SuratTugas::pilih_template');
    $routes->get('preview-template/(:segment)', 'SuratTugas::preview_template/$1');
    $routes->post('tugas', 'SuratTugas::preview_surat_tugas');
    $routes->post('simpan-draft-final', 'SuratTugas::simpan_draft_final');
    $routes->get('edit/(:segment)', 'SuratTugas::edit/$1');
    $routes->post('update/(:num)', 'SuratTugas::update/$1');
    $routes->get('hapus/(:num)', 'SuratTugas::hapus/$1');
});


// Routes Surat Keluar Sekretaris
$routes->group('surat-keluar', ['filter' => 'role:sekretaris'], function ($routes) {
    $routes->get('', 'Sekretaris\SuratKeluar::index');
    $routes->get('tambah', 'Sekretaris\SuratKeluar::tambah');
    $routes->post('simpan-draft', 'Sekretaris\SuratKeluar::simpan_draft');
    $routes->get('pilih-template', 'Sekretaris\SuratKeluar::pilih_template');
    $routes->post('simpan-draft-final', 'Sekretaris\SuratKeluar::simpan_draft_final');
    $routes->post('simpan', 'Sekretaris\SuratKeluar::simpan');
    $routes->get('edit/(:segment)', 'Sekretaris\SuratKeluar::edit/$1');
    $routes->post('update/(:num)', 'Sekretaris\SuratKeluar::update/$1');
});

// Routes untuk preview template
// $routes->get('pilih-template', 'Sekretaris\SuratKeluar::pilih_template');
$routes->group('preview-template', function ($routes) {
    $routes->get('baru/(:segment)', 'Sekretaris\SuratKeluar::preview_template/$1');
    $routes->post('backdate', 'Sekretaris\SuratKeluar::preview_backdate');
    $routes->post('pengumuman', 'Sekretaris\SuratKeluar::preview_pengumuman');
    $routes->post('tugas', 'SuratKeluar::preview_surat_tugas');
});

// Routes untuk export
$routes->get('export/print-suratkeluar/(:num)', 'Export::export_backdate/$1');
$routes->get('export/print-surat-tugas/(:num)', 'Export::export_surat_tugas/$1');
$routes->get('export/print-pengumuman/(:num)', 'Export::export_pengumuman/$1');

//Verifikasi surat keluar
$routes->group('pindai', function ($routes) {
    $routes->get('surat/(:segment)', 'Pindai::detail/$1');
});

// custom 404
$routes->set404Override('App\Controllers\ErrorPage::show404');
