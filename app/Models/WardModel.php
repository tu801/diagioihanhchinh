<?php

namespace App\Models;

use CodeIgniter\Model;

class WardModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tmt_wards';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['district_id', 'code', 'name', 'name_en', 'full_name', 'full_name_en', 'unit_name', 'unit_name_en'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getData($code)
    {
        $wardBuilder = $this->db->table('wards');

        $data = $wardBuilder->select([ 'wards.code', 'wards.name', 'wards.name_en', 'wards.full_name', 'wards.full_name_en', 
        'wards.district_code ', 'districts.full_name as district_name', 'administrative_units.short_name', 'administrative_units.short_name_en' ])
        ->join('administrative_units', 'administrative_units.id = wards.administrative_unit_id')
        ->join('districts', 'districts.code = wards.district_code')
        ->where('wards.district_code', $code)
        ->get()->getResultArray();

        return $data ?? [];
    }

    public function convertData(array $data, $district_id)
    {
        $builder = $this->db->table($this->table);
        foreach($data as $item) {
            $check = $builder->where('code', $item['code'])->get()->getFirstRow();

            if ( !isset($check->id) ) {
                $newItem = [
                    'district_id' => $district_id, 
                    'code' => $item['code'], 
                    'name' => $item['name'], 
                    'name_en' => $item['name_en'], 
                    'full_name' => $item['full_name'], 
                    'full_name_en' => $item['full_name_en'], 
                    'unit_name' => $item['short_name'], 
                    'unit_name_en' => $item['short_name_en']
                ];
                $builder->insert($newItem);
            }
        }        
    }
}
