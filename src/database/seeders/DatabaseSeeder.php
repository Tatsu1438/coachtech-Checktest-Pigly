<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1名のユーザー作成
        $user = User::factory()->create();

        // そのユーザーに紐づくweight_logsを35件作成
        WeightLog::factory(35)->create([
            'user_id' => $user->id,
        ]);

        // そのユーザーに紐づくweight_targetを1件作成
        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}