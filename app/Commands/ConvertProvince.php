<?php

namespace App\Commands;

use App\Models\ProvinceModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ConvertProvince extends BaseCommand
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
    protected $name = 'convert:province';

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
    protected $usage = 'convert:province [arguments] [options]';

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
         * convert province data from repository to table tmt_provinces
         */

        $provinceModel = model(ProvinceModel::class);

        try {
            $provinceData = $provinceModel->getData();

            if (!empty($provinceData)) {
                $provinceModel->convertData($provinceData);
                CLI::write('Province data converted successfully.', 'green');
            }
        } catch (\Exception $e) {
            CLI::error('Error: ' . $e->getMessage());
            return;
        }
    }
}
