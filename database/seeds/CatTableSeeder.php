<?php

use Illuminate\Database\Seeder;

use App\Categories;
class CatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $infoArr = [
            [
                "cat_name" => "先锋网络部专版"
            ],
            [
                "cat_name" => "吐槽什么什么的"
            ],
            [
                "cat_name" => "技术宅们的世界"
            ],
            [
                "cat_name" => "音游交流区"
            ],
            [
                "cat_name" => "niconico 分享"
            ],
            [
                "cat_name" => "声控灯"
            ],
            [
                "cat_name" => "管理版"
            ],
        ];
        foreach($infoArr as $data)
        {
            Categories::create($data);
        }
    }
}
