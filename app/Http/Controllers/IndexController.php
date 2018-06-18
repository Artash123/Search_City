<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function index(){


        return view('index');
    }
}
