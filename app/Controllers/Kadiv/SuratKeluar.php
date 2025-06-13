<?php

namespace App\Controllers\Kadiv;

use App\Models\SuratKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuratKeluar extends BaseController
{
    protected $suratKeluarModel;
    public function __construct()
    {
        $this->suratKeluarModel = new SuratKeluarModel();
    }
    public function index()
    {
        $data = [
            'title'        => 'Surat Keluar',
            'suratkeluars' => $this->suratKeluarModel->getDataDraft(),
        ];

        return view('kadiv/surat_keluar/index', $data);
    }
}
