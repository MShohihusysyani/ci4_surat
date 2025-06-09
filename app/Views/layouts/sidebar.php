<?php
$role = session('role'); // Ambil role dari session

switch ($role) {
    case 'superadmin':
        echo view('layouts/sidebar/superadmin');
        break;
    case 'klien':
        echo view('layouts/sidebar/klien');
        break;
    case 'sekretaris':
        echo view('layouts/sidebar/sekretaris');
        break;
    case 'kadiv':
        echo view('layouts/sidebar/kadiv');
        break;
    case 'dirops':
        echo view('layouts/sidebar/dirops');
        break;
    case 'dirut':
        echo view('layouts/sidebar/dirut');
        break;
    case 'staf':
        echo view('layouts/sidebar/staf');
        break;
    default:
        echo '<p>Role tidak dikenali atau belum login.</p>';
        break;
}
