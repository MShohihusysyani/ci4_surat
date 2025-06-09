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
$routes->group('kelola', function ($routes) {
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
$routes->group('klien', function ($routes) {
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
$routes->group('surat-masuk', function ($routes) {
    $routes->get('', 'Sekretaris\SuratMasuk::index');
    $routes->post('ajax-surat-masuk', 'Sekretaris\SuratMasuk::ajax_surat_masuk');
    $routes->post('disposisi-kadiv', 'Sekretaris\SuratMasuk::disposisi_kadiv');
});

// Routes Surat Masuk Kadiv
$routes->group('kadiv', function ($routes) {
    $routes->get('surat-masuk', 'Kadiv\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-atas', 'Kadiv\SuratMasuk::disposisi_keatasan');
});

// Routes Surat Masuk Dirops
$routes->group('dirops', function ($routes) {
    $routes->get('surat-masuk', 'Dirops\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-atas', 'Dirops\SuratMasuk::disposisi_keatasan');
});

// Routes Surat Masuk Dirut
$routes->group('dirut', function ($routes) {
    $routes->get('surat-masuk', 'Dirut\SuratMasuk::index');
    $routes->post('surat-masuk/disposisi-bawah', 'Dirut\SuratMasuk::disposisi_kebawahan');
});
