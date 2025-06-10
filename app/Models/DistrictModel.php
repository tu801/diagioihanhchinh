<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tmt_districts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['province_id', 'code', 'name', 'name_en', 'full_name', 'full_name_en', 'unit_name', 'unit_name_en'];

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
        $districtBuilder = $this->db->table('districts');

        $data = $districtBuilder->select([ 'districts.code', 'districts.name', 'districts.name_en', 'districts.full_name', 'districts.full_name_en', 
        'districts.province_code', 'administrative_units.short_name', 'administrative_units.short_name_en' ])
        ->join('administrative_units', 'administrative_units.id = districts.administrative_unit_id')
        ->where('districts.province_code', $code)
        ->get()->getResultArray();

        return $data ?? [];
    }

    public function convertData(array $data, $province_id)
    {
        $builder = $this->db->table($this->table);
        foreach($data as $item) {
            $check = $builder->where('code', $item['code'])->get()->getFirstRow();

            if ( !isset($check->id) ) {
                $newItem = [
                    'province_id' => $province_id, 
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
