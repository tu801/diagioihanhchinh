<?php

namespace App\Commands;

use App\Models\DistrictModel;
use App\Models\ProvinceModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ConvertDistrict extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'convert';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'convert:district';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'convert:district [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        /**
         * Convert district data from old format to table tmt_districts
         */
        $districtModel = model(DistrictModel::class);
        $provinceModel = model(ProvinceModel::class);

        try {
            $provinces = $provinceModel->findAll();
            if (!empty($provinces)) {
                foreach ($provinces as $item) {
                    $districtData = $districtModel->getData($item->code);

                    if (!empty($districtData)) {
                        $districtModel->convertData($districtData, $item->id);
                        CLI::write("Convert district data completed for province: {$item->full_name}", 'green');
                    }
                }
                CLI::write('=== All district data converted successfully ===', 'green');
            }
        } catch (\Exception $e) {
            CLI::error('Error converting district data: ' . $e->getMessage());
        }
    }
}
