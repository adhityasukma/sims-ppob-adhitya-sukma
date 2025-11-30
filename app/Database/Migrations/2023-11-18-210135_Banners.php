<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Banners extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'banner_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'banner_image' => [
                'type' => 'TEXT'
            ],
            'description' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('banners',true);
    }

    public function down()
    {
        $this->forge->dropTable('banners',true);
    }
}
