<?php

namespace App\Controllers;

use App\Models\DistrictModel;
use App\Models\ProvinceModel;
use App\Models\WardModel;

class Home extends BaseController
{
    public function index(): string
    {
        $province = model(ProvinceModel::class)->findAll();
        return view('home', [
            'title' => 'Địa giới hành chính',
            'data' => $province,
            'isDistrict' => true
        ]);
    }

    public function exportProvince()
    {
        $province = model(ProvinceModel::class)->findAll();
        $name = 'provinces.json';

        return $this->response->download($name, json_encode($province));
    }

    public function exportDistrict()
    {
        $districts = model(DistrictModel::class)->findAll();
        
        $name = 'districts.json';

        return $this->response->download($name, json_encode($districts));
    }

    public function exportWard()
    {
        $wards = model(WardModel::class)->findAll();
        $name = 'wards.json';

        return $this->response->download($name, json_encode($wards));
    }
}
