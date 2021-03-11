<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tables = ['users' => User::class,
            'products' => Product::class,
            'inventory' => Inventory::class,
            'orders' => Orders::class];

        foreach($tables as $table => $class){
            echo 'seeding table '.$table.'...'.PHP_EOL;

            $data = file(__DIR__ . '/../../resources/seeds/'.$table.'.csv');
            $fields = [];
            foreach($data as $i=>$line){
                if($i==0){ //header
                    $fields = str_getcsv($line);
                }else{
                    $entity = App::make($class);
                    $values = str_getcsv($line);
                    foreach($values as $v=>$value){
                        $entity->{$fields[$v]} = ($value=='NULL') ? null : $value;
                    }
                    $entity->save();
                }
            }
        }
    }
}
