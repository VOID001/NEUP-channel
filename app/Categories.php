<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $primaryKey = "cat_id";
    public static function getCategories()
    {
        $resultArr = [];
        $catsObj = Categories::all();
        foreach($catsObj as $cat)
        {
            $tmpData = [
                'cat_id' => $cat->cat_id,
                'cat_name' => $cat->cat_name,
            ];
            array_push($resultArr, $tmpData);
        }
        //var_dump($resultArr);
        return $resultArr;
    }
}
