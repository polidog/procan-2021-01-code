<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Gacha;
use App\Models\Item;
use App\Models\Prize;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();
        $gachas = Gacha::factory(1)->create();
        $gacha = $gachas->get(0);
        Item::factory(10)->create()->each(function ($item) use ($gacha): void {
            Prize::factory()->for($item)->for($gacha)->create();
        });
    }
}
