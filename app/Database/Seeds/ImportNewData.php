<?php

namespace App\Database\Seeds;

use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class ImportNewData extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        // Turn off foreign key checks to allow truncation
        // and prevent errors when dropping tables with foreign key constraints
        // Note: This is a MySQL specific command, other databases may have different syntax
        $db->query('SET FOREIGN_KEY_CHECKS = 0');

        // truncate all tables
        $this->db->table('administrative_regions')->truncate();
        $this->db->table('administrative_units')->truncate();
        $this->db->table('provinces')->truncate();
        $this->db->table('districts')->truncate();
        $this->db->table('wards')->truncate();

        $this->db->table('tmt_provinces')->truncate();
        $this->db->table('tmt_districts')->truncate();
        $this->db->table('tmt_wards')->truncate();

        // Re-enable foreign key checks after truncation
        // This is important to ensure that future operations respect foreign key constraints
        // Note: This is a MySQL specific command, other databases may have different syntax
        $db->query('SET FOREIGN_KEY_CHECKS = 1');


        // import new data
        $dataFile = ROOTPATH . 'app/Database/mysql/ImportData_v01Mar2025.sql';

        if (file_exists($dataFile)) {
            $sql = file_get_contents($dataFile);
            $mysqli = $db->connID;
            if ($mysqli->multi_query($sql)) {
                do {
                    // store first result set
                    if ($result = $mysqli->store_result()) {
                        $result->free();
                    }
                } while ($mysqli->more_results() && $mysqli->next_result());
                CLI::write("Insert '$dataFile' successfully.\n", 'green');
            } else {
                CLI::write("MySQL Error: " . $mysqli->error . "\n", 'error');
            }
        } else {
            CLI::write("SQL file not found: " . $dataFile . "\n", 'error');
        }
    }
}
