<?php


namespace App\Helper;


class Helper
{

    public function insertDataIntoArray($key,$values)
    {
        $array = [];
        foreach ($values as $val) {
            $product = array_combine($key, $val);
            array_push($array, $product);
        }
        return $array;
    }


    public function addDatatoMultidimensialArray($array, $data)
    {
        $i = 0;
        foreach ($array as $arr){
            $temp = array_merge($arr, $data);
            $array[$i]= $temp;
            $i+=1;
        }
        return $array;
    }

}






