<?php

namespace Database\Seeders;

use App\Classes\ErrorMessages;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDOException;

class ExpenditureItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchasedProducts = [
            [
                'product_id' => 2,
                'measure_id' => 1,
                'price' => 20000,
                'quantity' => 5,
                'created_at' => '2021-08-29 10:00:00'
            ],
            [
                'product_id' => 1,
                'measure_id' => 1,
                'price' => 30000,
                'quantity' => 5,
                'created_at' => '2021-08-29 10:10:00'
            ],
            [
                'product_id' => 4,
                'measure_id' => 3,
                'price' => 30000,
                'quantity' => 5,
                'created_at' => '2021-08-29 10:20:00'
            ],
            [
                'product_id' => 5,
                'measure_id' => 1,
                'price' => 90000,
                'quantity' => 2,
                'created_at' => '2021-09-05 09:25:00'
            ],
            [
                'product_id' => 7,
                'measure_id' => 4,
                'price' => 5000,
                'quantity' => 1,
                'created_at' => '2021-09-05 10:00:00'
            ],
            [
                'product_id' => 11,
                'measure_id' => 1,
                'price' => 10000,
                'quantity' => 5,
                'created_at' => '2021-09-11 10:15:00'
            ],
            [
                'product_id' => 1,
                'measure_id' => 1,
                'price' => 10000,
                'quantity' => 5,
                'created_at' => '2021-09-11 10:20:00'
            ],
            [
                'product_id' => 6,
                'measure_id' => 1,
                'price' => 180000,
                'quantity' => 2,
                'created_at' => '2021-09-11 10:30:00'
            ],
            [
                'product_id' => 8,
                'measure_id' => 4,
                'price' => 15000,
                'quantity' => 1,
                'created_at' => '2021-09-11 10:36:00'
            ],
            [
                'product_id' => 10,
                'measure_id' => 1,
                'price' => 10000,
                'quantity' => 1,
                'created_at' => '2021-09-19 09:10:00'
            ],
            [
                'product_id' => 11,
                'measure_id' => 1,
                'price' => 8000,
                'quantity' => 4,
                'created_at' => '2021-09-19 09:30:00'
            ],
            [
                'product_id' => 2,
                'measure_id' => 1,
                'price' => 16000,
                'quantity' => 4,
                'created_at' => '2021-09-19 09:40:00'
            ],
        ];

        DB::beginTransaction();

        try {
            foreach ($purchasedProducts as $product) {
                DB::table('expenditure_items')->insert($product);
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
