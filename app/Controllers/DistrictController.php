<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DistrictModel;
use App\Models\ProvinceModel;

class DistrictController extends BaseController
{
    public function index()
    {
        try {
            $_districtModel = model(DistrictModel::class);
            $_provinceModel = model(ProvinceModel::class);

            $procinces = $_provinceModel->findAll();
            if ( !empty($procinces) ) {
                foreach($procinces as $item) {
                    $districData = $_districtModel->getData($item->code);
                    
                    if ( !empty($districData) ) {
                        $_districtModel->convertData($districData, $item->id);
                    }
                }
            }
            
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        
        $data = $_districtModel
        ->select(['tmt_districts.*', 'tmt_provinces.full_name as province_name'])
        ->join('tmt_provinces', 'tmt_provinces.id = tmt_districts.province_id')
        ->findAll();

        return view('data_content', [
            'title' => 'District Data Table',
            'data' => $data,
            'isDistrict' => true
        ]);
    }
}
