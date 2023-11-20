<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
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
            'invoice_number' => [
                'type' => 'BIGINT',
                'constraint' => 100
            ],
            'services_id' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => true,
            ],
            'transaction_type' => [
                'type'       => 'ENUM',
                'constraint' => ['TOPUP', 'PAYMENT'],
                'default'    => 'TOPUP',
            ],
            'total_amount' => [
                'type' => 'BIGINT',
                'constraint' => 100
            ],
            'created_on' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('services_id', false);
        $this->forge->addForeignKey('users_id', 'users', 'id');
        $this->forge->createTable('transactions',true);
    }

    public function down()
    {
        $this->forge->dropTable('transactions',true);
    }
}
