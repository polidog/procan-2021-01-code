<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Gacha;
use Illuminate\Database\Eloquent\Factories\Factory;

class GachaFactory extends Factory
{
    protected $model = Gacha::class;

    public function definition(): array
    {
        return [
            'name' => '通常ガチャ',
        ];
    }
}
