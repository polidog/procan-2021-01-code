<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gacha
 *
 * @property Collection $prizes
 */
class Gacha extends Model
{
    use HasFactory;

    /**
     * @return Item
     * @throws \Exception
     */
    public function draw(): Item
    {
        $totalProbability = $this->prizes->reduce(static function (int $ac, Prize $prize) {
            return $ac + $prize->probability;
        }, 0);

        $boundary = random_int(1, $totalProbability);
        $countPriority = 0;

        foreach ($this->prizes as $prize) {
            $countPriority += $prize->probability;

            if ($boundary <= $countPriority) {
                return $prize->item;
            }
        }

        throw new \RuntimeException('item not found.');
    }

    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }
}
