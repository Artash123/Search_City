<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    protected function index(){
        echo 'ggg';
    }

    protected function autocomplate(Request $request){
        $value = $request->input('value');

        $cities = DB::table('ru_cities')
            ->select(DB::raw('name'))
            ->where('name', 'like', $value.'%')
            ->limit(10)
            ->get();
        echo json_encode($cities);
    }

    protected function get_near_cities(Request $request){
        $value = $request->input('value');

        $current_city = DB::table('ru_cities')
            ->select('lng','lat')
            ->where('name',$value)
            ->get();
        $current_lat = $current_city[0]->lat;
        $current_lng = $current_city[0]->lng;
        $arr = [$current_lat,$current_lng];

        $cities = DB::table('ru_cities')
            ->select('name','lng','lat')
            ->where('lat', 'like', floor($current_lat).'%')
            ->where('lng', 'like', floor($current_lng).'%')
            ->orWhere('lat', 'like', floor($current_lat-1).'%')
            ->orWhere('lat', 'like', floor($current_lat-1).'%')
            ->orWhere('lat', 'like', floor($current_lat+1).'%')
            ->orWhere('lat', 'like', floor($current_lat+1).'%')
            ->get();
        if(count($cities)<21){
            $cities = DB::table('ru_cities')
                ->select('name','lng','lat')
                ->get();
        }
        $near_city_arr = [];
        $near_city_arr[0] = [$value, $current_lat, $current_lng];
        for ($i = 1;$i <= 20;$i++) {
            $max_distance=1000;
            foreach ($cities as $key => $value) {
                $lat = $value->lat;
                $lng = $value->lng;
                $distance = sqrt(pow(($lat - $current_lat), 2) + pow(($lng - $current_lng), 2));
                if ($distance < $max_distance) {
                    $near_city = [$value->name, $value->lat, $value->lng];
                    $current_key = $key;
                    $max_distance = $distance;
                }
            }
            $near_city_arr[$i] = $near_city;
            unset($cities[$current_key]);
        }
        echo json_encode($near_city_arr);
    }

}
