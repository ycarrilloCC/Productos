<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name_product'  => 'Producto 1',
                'product_price' => 123.45,
                'product_tax'   => 5,
                'status'        => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ],
            [
                'name_product'  => 'Producto 2',
                'product_price' => 45.65,
                'product_tax'   => 15,
                'status'        => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ],
            [
                'name_product'  => 'Producto 3',
                'product_price' => 39.73,
                'product_tax'   => 12,
                'status'        => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ],
            [
                'name_product'  => 'Producto 4',
                'product_price' => 250.00,
                'product_tax'   => 8,
                'status'        => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ],
            [
                'name_product'  => 'Producto 5',
                'product_price' => 59.35,
                'product_tax'   => 10,
                'status'        => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ]
        ]);
    }
}
