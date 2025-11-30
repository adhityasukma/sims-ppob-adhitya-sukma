<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'service_code' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'service_icon' => [
                'type' => 'TEXT'
            ],
            'service_tariff' => [
                'type' => 'BIGINT',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('services',true);
    }

    public function down()
    {
        $this->forge->dropTable('services',true);
    }
}
