<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'service_code' => 'PAJAK',
                'service_name' => 'PBB',
                'service_icon' => site_url("/assets/img/services/PBB.png"),
                'service_tariff' => 40000,

            ],
            [
                'service_code' => 'PLN',
                'service_name' => 'Listrik',
                'service_icon' => site_url("/assets/img/services/Listrik.png"),
                'service_tariff' => 10000,

            ],
            [
                'service_code' => 'PDAM',
                'service_name' => 'PDAM',
                'service_icon' => site_url("/assets/img/services/PDAM.png"),
                'service_tariff' => 40000,

            ],
            [
                'service_code' => 'PULSA',
                'service_name' => 'Pulsa',
                'service_icon' => site_url("/assets/img/services/Pulsa.png"),
                'service_tariff' => 40000,

            ],
            [
                'service_code' => 'PGN',
                'service_name' => 'PGN',
                'service_icon' => site_url("/assets/img/services/PGN.png"),
                'service_tariff' => 50000,

            ],
            [
                'service_code' => 'MUSIK',
                'service_name' => 'Musik',
                'service_icon' => site_url("/assets/img/services/Musik.png"),
                'service_tariff' => 50000,

            ],[
                'service_code' => 'TV',
                'service_name' => 'TV Berlangganan',
                'service_icon' => site_url("/assets/img/services/Televisi.png"),
                'service_tariff' => 50000,

            ],[
                'service_code' => 'PAKET_DATA',
                'service_name' => 'Paket Data',
                'service_icon' => site_url("/assets/img/services/Paket-Data.png"),
                'service_tariff' => 50000,

            ],[
                'service_code' => 'VOUCHER_GAME',
                'service_name' => 'Voucher Game',
                'service_icon' => site_url("/assets/img/services/Game.png"),
                'service_tariff' => 100000,

            ],[
                'service_code' => 'VOUCHER_MAKANAN',
                'service_name' => 'Voucher Makanan',
                'service_icon' => site_url("/assets/img/services/Voucher-Makanan.png"),
                'service_tariff' => 100000,

            ],[
                'service_code' => 'QURBAN',
                'service_name' => 'Kurban',
                'service_icon' => site_url("/assets/img/services/Kurban.png"),
                'service_tariff' => 200000,

            ],[
                'service_code' => 'ZAKAT',
                'service_name' => 'Zakat',
                'service_icon' => site_url("/assets/img/services/Zakat.png"),
                'service_tariff' => 300000,

            ],
        ];
        foreach ($data as $v){
            // Using Query Builder
            $this->db->table('services')->insert($v);
        }
    }
}
