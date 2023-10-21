<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProvinceModel;

class ProvinceControllser extends BaseController
{
    public function index()
    {
        try {
            $_provinceModel = model(ProvinceModel::class);

            $provinceData = $_provinceModel->getData();
    
            if ( !empty($provinceData) ) {
                $_provinceModel->convertData($provinceData);
            }
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        

        return view('province', [
            'data' => $_provinceModel->findAll()
        ]);
    }
}
