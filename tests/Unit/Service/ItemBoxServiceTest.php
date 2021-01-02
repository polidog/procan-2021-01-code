<?php declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Models\Item;
use App\Models\ItemBox;
use App\Models\User;
use App\Service\ItemBoxService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemBoxServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function testAdd(): void
    {
        $this->seed();
        $user = User::first();
        $this->saveItemBox($user);

        self::assertTrue(ItemBox::where('user_id', $user->id)->count() > 0);
    }

    public function testRemove(): void
    {
        $this->seed();

        $user = User::first();
        $this->saveItemBox($user);

        $boxCount = ItemBox::where('user_id', $user->id)->count();
        $itemBox = ItemBox::where('user_id', $user->id)->first();

        $service = new ItemBoxService($user);
        $service->remove($itemBox->id);
        self::assertSame(ItemBox::where('user_id', $user->id)->count(), $boxCount - 1);
    }

    public function testIsFull(): void
    {
        $this->seed();

        $user = User::first();
        $service = new ItemBoxService($user);

        foreach (Item::get() as $item) {
            $service->add($item);
        }

        self::assertTrue($service->isFull());
    }

    private function saveItemBox(User $user): void
    {
        $item = Item::first();
        $service = new ItemBoxService($user);
        $service->add($item);
    }
}
