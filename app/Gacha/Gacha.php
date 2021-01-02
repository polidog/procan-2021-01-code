<?php declare(strict_types=1);

namespace App\Gacha;

class Gacha
{
    private const MAX_PRIZE = 10;

    /**
     * @var Prize[]
     */
    private $prizes = [];

    /**
     * @return Item
     * @throws \Exception
     */
    public function draw(): Item
    {
        $totalProbability = array_reduce($this->prizes, static function (int $ac, Prize $prize) {
            return $ac + $prize->getProbability();
        }, 0);
        $boundary = random_int(1, $totalProbability);
        $countPriority = 0;

        foreach ($this->prizes as $prize) {
            $countPriority += $prize->getProbability();

            if ($boundary <= $countPriority) {
                return $prize->getItem();
            }
        }

        throw new \RuntimeException('item not found.');
    }

    public function addPrize(Prize $prize): void
    {
        if ($this->hasPrizes()) {
            throw new \Exception('景品の上限を超えています');
        }
        $this->prizes[] = $prize;
    }

    public function hasPrizes(): bool
    {
        return count($this->prizes) === self::MAX_PRIZE;
    }
}
