<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BannersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'banner_name' => 'Banner 1',
                'banner_image' => site_url("/assets/img/banners/Banner-1.png"),
                'description' => 'Lerem Ipsum Dolor sit amet',

            ],[
                'banner_name' => 'Banner 2',
                'banner_image' => site_url("/assets/img/banners/Banner-2.png"),
                'description' => 'Lerem Ipsum Dolor sit amet2',

            ],[
                'banner_name' => 'Banner 3',
                'banner_image' => site_url("/assets/img/banners/Banner-3.png"),
                'description' => 'Lerem Ipsum Dolor sit amet3',

            ],[
                'banner_name' => 'Banner 4',
                'banner_image' => site_url("/assets/img/banners/Banner-4.png"),
                'description' => 'Lerem Ipsum Dolor sit amet4',

            ],[
                'banner_name' => 'Banner 5',
                'banner_image' => site_url("/assets/img/banners/Banner-5.png"),
                'description' => 'Lerem Ipsum Dolor sit amet5',

            ],

        ];
        foreach ($data as $v){
            // Using Query Builder
            $this->db->table('banners')->insert($v);
        }
    }
}
