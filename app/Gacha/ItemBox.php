<?php declare(strict_types=1);

namespace App\Gacha;

class ItemBox
{
    private const MAX_ITEMS = 10;

    /**
     * @var Item[]
     */
    private $items = [];

    public function add(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function remove(int $index): void
    {
        unset($this->items[$index]);
    }

    public function isFull(): bool
    {
        return count($this->items) > self::MAX_ITEMS;
    }
}
