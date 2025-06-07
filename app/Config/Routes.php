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
