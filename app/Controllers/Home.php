<?php

namespace App\Controllers;

use App\Models\ProvinceModel;

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
}
