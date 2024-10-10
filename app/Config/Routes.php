<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// pasien
$routes->get('/pasien', 'Pasien::index', ['filter' => 'patientAuth']);

$routes->get('/', 'Home::index');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/save', 'Auth::save');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/loginAuth', 'Auth::loginAuth');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/pasien/lengkapi_profil', 'Pasien::complete_profile', ['filter' => 'patientAuth']);
$routes->post('/pasien/store_profile', 'Pasien::store_profile', ['filter' => 'patientAuth']);
$routes->post('/pasien/store_pasienbaru', 'Pasien::store_pasienbaru', ['filter' => 'patientAuth']);
$routes->get('/pasien/akun_keluarga', 'Pasien::akun', ['filter' => 'patientAuth']);
$routes->get('/pasien/pasien_lama', 'Pasien::pasien_lama', ['filter' => 'patientAuth']);
$routes->post('/pasien/get_data_pasien', 'Pasien::getDataPasien');
$routes->get('/pasien/pasien_daftar/(:segment)', 'Pasien::second_pasien_daftar/$1', ['filter' => 'patientAuth']);
$routes->group('pasien', function ($routes) {
    $routes->get('resetPassword', 'Pasien::resetPassword');
    $routes->post('updatePassword', 'Pasien::updatePassword');
});

// API
$routes->post('/dokter/get_data_dokter', 'Dokter::getDokter');


// jadwal
$routes->get('/jadwal', 'Jadwal::index');
$routes->get('/jadwal/create', 'Jadwal::create');
$routes->post('/jadwal/store', 'Jadwal::store');
$routes->get('/jadwal/setStatus/(:num)/(:alpha)', 'Jadwal::setStatus/$1/$2');


// daftar jalan
$routes->get('/daftar', 'Daftar::index');
$routes->get('/daftar/create', 'Daftar::create');
$routes->post('/daftar/store', 'Daftar::store');
$routes->post('/daftar/store_second_pasien', 'Daftar::store_second_pasien');
$routes->get('/daftar/direct_daftar', 'Daftar::direct_registration');
$routes->post('/daftar/store_direct_registration', 'Daftar::store_direct_registration');
$routes->post('/daftar/get_data_daftar', 'Daftar::getDataDaftar');


// admin
$routes->get('/admin/register', 'Admin::register');
$routes->post('/admin/store_registration', 'Admin::store_registration');
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/authenticate', 'Admin::authenticate');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/create_outpatient', 'Admin::create_outpatient');
$routes->post('/admin/store_outpatient', 'Admin::store_outpatient');
$routes->get('/admin/pending_registrations', 'Admin::pending_registrations');
$routes->get('/admin/approve_registration/(:num)', 'Admin::approve_registration/$1');
$routes->get('/admin/logout', 'Admin::logout');
$routes->group('admin', function($routes) {
    $routes->get('datapasien', 'Admin::index_pasien');
    $routes->get('create_pasien', 'Admin::create_pasien');
    $routes->post('store_pasien', 'Admin::store_pasien');
    $routes->get('pasien/edit/(:num)', 'Admin::edit_pasien/$1');
    $routes->post('pasien/update/(:num)', 'Admin::update_pasien/$1');
    $routes->post('pasien/delete/(:num)', 'Admin::delete_pasien/$1');
});
$routes->post('/admin/pilihdokter', 'Daftar::store_pilihdokter');
$routes->post('/admin/hapus/daftar/(:num)', 'Daftar::hapus/$1');

// admin /dokter
$routes->group('admin/dokter', function($routes) {
    $routes->get('/', 'Dokter::index');
    $routes->get('create', 'Dokter::create');
    $routes->post('store', 'Dokter::store');
    $routes->get('edit/(:num)', 'Dokter::edit/$1');
    $routes->post('update/(:num)', 'Dokter::update/$1');
    $routes->post('delete/(:num)', 'Dokter::delete/$1');
});
// admin /poli
$routes->group('admin/poli', function($routes) {
    $routes->get('/', 'Poli::index');
    $routes->get('create', 'Poli::create');
    $routes->post('store', 'Poli::store');
    $routes->get('edit/(:num)', 'Poli::edit/$1');
    $routes->post('update/(:num)', 'Poli::update/$1');
    $routes->post('delete/(:num)', 'Poli::delete/$1');
});


$routes->group('admin', function ($routes) {
    $routes->get('jadwal', 'Admin::index_jadwal');
    $routes->get('jadwal/create', 'Admin::create_jadwal');
    $routes->post('jadwal/store', 'Admin::store_jadwal');
    $routes->get('jadwal/setStatus/(:num)/(:alpha)', 'Admin::setStatus/$1/$2');
});

// rekam medis
$routes->get('/catatanmedis', 'Catatanmedis::index');
$routes->get('/catatanmedis/create', 'Catatanmedis::create');
$routes->post('/catatanmedis/store', 'Catatanmedis::store');
$routes->get('/catatanmedis/edit/(:num)', 'Catatanmedis::edit/$1');
$routes->post('/catatanmedis/update/(:num)', 'Catatanmedis::update/$1');
$routes->post('/catatanmedis/delete/(:num)', 'Catatanmedis::delete/$1');

// resep
$routes->get('/resep', 'Resep::index');
$routes->get('/resep/create', 'Resep::create');
$routes->post('/resep/store', 'Resep::store');
$routes->get('/resep/show/(:num)', 'Resep::show/$1');


// resep obat
$routes->get('/resepobat', 'Resepobat::index');
$routes->get('/resepobat/create', 'Resepobat::create');
$routes->post('/resepobat/store', 'Resepobat::store');
$routes->get('/resepobat/edit/(:segment)', 'Resepobat::edit/$1');
$routes->post('/resepobat/update/(:segment)', 'Resepobat::update/$1');
$routes->get('/resepobat/delete/(:segment)', 'Resepobat::delete/$1');




