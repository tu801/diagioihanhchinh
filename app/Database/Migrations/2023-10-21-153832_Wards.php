<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Wards extends Migration
{
    public function up()
    {
        // create province table
        $fields = [
            'id'          		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'district_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'code'        	    => ['type' => 'varchar', 'constraint' => 20],
            'name'        	    => ['type' => 'varchar', 'constraint' => 255],
            'name_en'        	=> ['type' => 'varchar', 'constraint' => 255],
            'full_name'        	=> ['type' => 'varchar', 'constraint' => 255],
            'full_name_en'      => ['type' => 'varchar', 'constraint' => 255],
            'unit_name'	 		=> ['type' => 'varchar', 'constraint' => 255],
            'unit_name_en'	 	=> ['type' => 'varchar', 'constraint' => 255],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id');
        $this->forge->addForeignKey('district_id', 'tmt_districts', 'id', 'CASCADE', 'CASCADE', 'idx_district_id');
        $this->forge->createTable('tmt_wards', true);
    }

    public function down()
    {
        //drop table
		$this->forge->dropTable('tmt_wards', true);
    }
}
