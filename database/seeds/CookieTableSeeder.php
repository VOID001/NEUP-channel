<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\ChCookie;

class CookieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $charTblStr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charTbl = [];
        for($i = 0; $i < 10; $i++)
        {
            for ($len = 0; $len < strlen($charTblStr); $len++)
            {
                array_push($charTbl, $charTblStr[$len]);
            }
            $shortCookie = "";
            for ($j = 0; $j < 8; $j++)
            {
                shuffle($charTbl);
                $shortCookie = $shortCookie . $charTbl[0];
            }
            var_dump($shortCookie);
            $longCookie = md5($shortCookie . time());
            var_dump($longCookie);
            ChCookie::create([
                "cookie" => $longCookie,
                "short_cookie" => $shortCookie,
                "state" => 0,
            ]);
        }
        echo "Seeded 10 more cookies into the database\n";
        Model::reguard();
    }
}