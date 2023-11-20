<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Balances extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'users_id' => [
                'type' => 'INT',
                'constraint' => 100
            ],
            'balance' => [
                'type' => 'BIGINT',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('users_id', 'users', 'id');
        $this->forge->createTable('balances',true);
    }

    public function down()
    {
        $this->forge->dropTable('balances',true);
    }
}
