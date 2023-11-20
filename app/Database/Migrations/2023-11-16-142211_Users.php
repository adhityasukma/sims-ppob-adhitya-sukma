<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users',true);
    }

    public function down()
    {
        $this->forge->dropTable('users',true);
    }
}
