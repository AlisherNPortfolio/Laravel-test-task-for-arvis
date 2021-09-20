<?php

namespace Database\Seeders;

use App\Classes\ErrorMessages;
use App\Models\Measure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PDOException;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $measures = [
            ['name' => 'kg'],
            ['name' => 'm'],
            ['name' => 'l'],
            ['name' => 'pease'],
            ['name' => 'bottle(s)'],
            ['name' => 'pocket(s)'],
        ];

        DB::beginTransaction();

        try {
            foreach ($measures as $measure) {
                Measure::create($measure);
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
