<?php
namespace App;

class ApiData
{
    public static function S($data,$code=200){
        return response()->json(['data'=>$data,'status'=>true,'error'=>null],$code);
    }
    public static function F($data,$code=200){
        return response()->json(['data'=>null,'status'=>false,'error'=>$data],$code);
    }
}
