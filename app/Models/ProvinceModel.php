<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tmt_provinces';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code', 'name', 'name_en', 'full_name', 'full_name_en', 'unit_name', 'unit_name_en'];

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

    public function getData()
    {
        $builder = $this->db->table('provinces');

        $data = $builder->select([ 'provinces.code', 'provinces.name', 'provinces.name_en', 'provinces.full_name', 'provinces.full_name_en', 
        'administrative_units.short_name', 'administrative_units.short_name_en' ])
        ->join('administrative_units', 'administrative_units.id = provinces.administrative_unit_id')
        ->get()->getResultArray();

        return $data ?? [];
    }

    public function convertData(array $data)
    {
        $builder = $this->db->table($this->table);
        foreach($data as $item) {
            $check = $builder->where('code', $item['code'])->get()->getFirstRow();

            if ( !isset($check->id) ) {
                $newItem = [
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
