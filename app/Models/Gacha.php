<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gacha
 *
 * @property string $name
 * @property Collection $prizes
 */
class Gacha extends Model
{
    use HasFactory;
    private const MAX_PRIZE = 10;

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

    /**
     * @param Prize $prize
     * @throws \Exception
     */
    public function addPrize(Prize $prize): void
    {
        if ($this->hasPrizes()) {
            throw new \Exception('景品の上限を超えています');
        }
        $prize->gacha()->associate($this);
        $this->prizes()->save($prize);
    }

    public function hasPrizes(): bool
    {
        return $this->prizes()->count('id') === self::MAX_PRIZE;
    }

    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }
}
