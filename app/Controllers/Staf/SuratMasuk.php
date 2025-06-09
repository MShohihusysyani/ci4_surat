<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\DisposisiBawahModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuratMasuk extends BaseController
{
    protected $disposisiBawahanModel;

    public function __construct()
    {
        $this->disposisiBawahanModel = new DisposisiBawahModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'suratmasuks' => $this->disposisiBawahanModel->getData(),
        ];

        return view('staf/surat_masuk/index', $data);
    }
}
