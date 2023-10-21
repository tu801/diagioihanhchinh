<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DistrictModel;

class DistrictController extends BaseController
{
    public function index()
    {
        try {
            $_districtModel = model(DistrictModel::class);

            $districData = $_districtModel->getData();
    
            if ( !empty($provinceData) ) {
                $_districtModel->convertData($provinceData);
            }
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        

        return view('province', [
            'data' => $_districtModel->findAll()
        ]);
    }
}
