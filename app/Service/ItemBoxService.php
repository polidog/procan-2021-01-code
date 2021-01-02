<?php declare(strict_types=1);

namespace App\Service;

use App\Models\Item;
use App\Models\ItemBox;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ItemBoxService
{
    private const MAX_ITEMS = 10;

    /**
     * @var User
     */
    private $user;

    /**
     * ItemBoxRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add(Item $item): void
    {
        $itemBox = new ItemBox();
        $itemBox->user()->associate($this->user);
        $itemBox->item()->associate($item);
        $itemBox->save();
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return ItemBox::where('user_id', $this->user->id)->get();
    }

    /**
     * @param int $itemBoxId
     * @throws \Exception
     */
    public function remove(int $itemBoxId): void
    {
        $itemBox = ItemBox::find($itemBoxId);

        if (!$itemBox instanceof ItemBox) {
            throw new \Exception('アイテムが取得できません');
        }
        $itemBox->delete();
    }

    public function isFull(): bool
    {
        return ItemBox::where('user_id', $this->user->id)->count() >= self::MAX_ITEMS;
    }
}
