<?php declare(strict_types=1);

namespace App\Gacha;

class Prize
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var int
     */
    private $probability;

    /**
     * Prize constructor.
     * @param Item $item
     * @param int $probability
     */
    public function __construct(Item $item, int $probability)
    {
        $this->item = $item;
        $this->probability = $probability;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getProbability(): int
    {
        return $this->probability;
    }
}
