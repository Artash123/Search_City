<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class updateCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateCities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will update cities database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = storage_path('RU.txt');

        $lastModificationTs = File::get(storage_path('lastmodification.txt'));


        $modifiedTs = filemtime($filename);
        if ($modifiedTs != $lastModificationTs){
            DB::table('ru_cities')->delete();
            $contents = File::get(storage_path('RU.txt'));
            $city_array = explode("\n", $contents);
            array_pop($city_array);
            foreach ($city_array as $key=>$line){
                $array[$key] = preg_split('/[\t]/', $line);
                DB::table('ru_cities')->insert(
                    ['name' => $array[$key][1], 'lat' => $array[$key][4], 'lng' => $array[$key][5]]
                );
            }
        }
        File::put(storage_path('lastmodification.txt'),$modifiedTs);
    }
}
