<?php

use Illuminate\Database\Seeder;

class linksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         $data = [
            [
                'links_name' => '后盾网',
                'links_title' => '国内口碑最好的PHP培训机构',
                'links_url' => 'http://www.houdunwang.com',
                'links_order' => 1,
            ],
            [
                'links_name' => '后盾论坛',
                'links_title' => '后盾网，人人做后盾',
                'links_url' => 'http://bbs.houdunwang.com',
                'links_order' => 2,
            ]
        ];
        DB::table('links')->insert($data);
    }
}
