<?php

namespace App\Commands;

use App\Models\DistrictModel;
use App\Models\WardModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ConvertWard extends BaseCommand
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
    protected $name = 'convert:ward';

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
    protected $usage = 'convert:ward [arguments] [options]';

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
         * Convert ward data from old format to table tmt_wards
         */
        $_districtModel = model(DistrictModel::class);
        $_wardModel = model(WardModel::class);

        try {
            $districts = $_districtModel->findAll();
            if (!empty($districts)) {
                foreach ($districts as $item) {
                    $wardData = $_wardModel->getData($item->code);

                    if (!empty($wardData)) {
                        $_wardModel->convertData($wardData, $item->id);
                        CLI::write('Converted wards for district: ' . $item->full_name, 'green');
                    }
                }
                CLI::write('=== All wards converted successfully ===', 'green');
            }
        } catch (\Exception $e) {
            CLI::error('Error: ' . $e->getMessage());
        }
    }
}
