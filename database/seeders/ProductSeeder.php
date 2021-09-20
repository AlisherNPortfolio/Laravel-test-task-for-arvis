<?php

namespace Database\Seeders;

use App\Classes\ErrorMessages;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PDOException;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Tomato'], // 1
            ['name' => 'Potato'], // 2
            ['name' => 'Cucumber'], // 3
            ['name' => 'Vegetable oil'], // 4
            ['name' => 'Fish'], // 5
            ['name' => 'Meat'], // 6
            ['name' => 'Foil paper'], // 7
            ['name' => 'Melon'], // 8
            ['name' => 'Matches'], // 9
            ['name' => 'Apple'], // 10
            ['name' => 'Onion'], // 11
        ];

        DB::beginTransaction();

        try {
            foreach ($products as $product) {
                Product::create($product);
            }

            DB::commit();
        } catch (PDOException $e) {
            DB::rollback();
            dd($e->getMessage());
            return response()->json([
                'success' => false,
                'code' => ErrorMessages::CAN_NOT_CREATE,
                'message' => ErrorMessages::CAN_NOT_CREATE_MSG,
                'details' => $e->getMessage()
            ]);
        }
    }
}
