<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ErrorPage extends BaseController
{
    public function show404()
    {
        $data = [
            'title' => '404 - Not Found'
        ];
        return view('errors/404', $data);
    }
}
