<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DistrictModel;
use App\Models\WardModel;

class WardController extends BaseController
{
    public function index()
    {
        $_wardModel = model(WardModel::class);
        $data = $_wardModel
        ->select(['tmt_wards.*', 'tmt_districts.full_name as district_name'])
        ->join('tmt_districts', 'tmt_districts.id = tmt_wards.district_id')
        ->findAll();

        return view('data_content', [
            'title' => 'Wards Data Table',
            'data' => $data,
            'isWard' => true
        ]);
    }

    public function clone()
    {
        try {
            $_districtModel = model(DistrictModel::class);
            $_wardModel = model(WardModel::class);

            $districts = $_districtModel->findAll(); //dd($districts);
            if ( !empty($districts) ) {
                foreach($districts as $item) {
                    $wardData = $_wardModel->getData($item->code); //dd($wardData, $item);
                    
                    if ( !empty($wardData) ) {
                        $_wardModel->convertData($wardData, $item->id);
                    }
                }
            }
            
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        
        $data = $_wardModel
        ->select(['tmt_wards.*', 'tmt_districts.full_name as district_name'])
        ->join('tmt_districts', 'tmt_districts.id = tmt_wards.district_id')
        ->findAll();

        return view('data_content', [
            'title' => 'Wards Data Table',
            'data' => $data,
            'isWard' => true
        ]);
    }
}
