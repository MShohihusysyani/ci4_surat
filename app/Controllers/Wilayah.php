<?php

namespace App\Controllers;

use App\Models\WilayahModel;
use App\Models\KelurahanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Wilayah extends BaseController
{
    protected $kelurahanModel;

    public function __construct()
    {
        $this->kelurahanModel = new KelurahanModel();
    }
    public function getKabupaten($provinsiId)
    {
        $model = new WilayahModel();
        $kabupaten = $model->getKabupatenByProvinsi($provinsiId);

        return $this->response->setJSON($kabupaten);
    }

    public function getKecamatan($kabupatenId)
    {
        $model = new WilayahModel();
        $kecamatan = $model->getKecamatanByKabupaten($kabupatenId);

        return $this->response->setJSON($kecamatan);
    }

    public function getKelurahan($kecamatanId)
    {
        $model = new WilayahModel();
        $kelurahan = $model->getKelurahanByKecamatan($kecamatanId);

        return $this->response->setJSON($kelurahan);
    }
    public function getKodePos($kelurahanId)
    {
        $kelurahan = $this->kelurahanModel->getKelurahanById($kelurahanId);
        if ($kelurahan) {
            echo json_encode(['kode_pos' => $kelurahan->kode_pos]);
        } else {
            echo json_encode(['kode_pos' => null]);
        }
    }
}
