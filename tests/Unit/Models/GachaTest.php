<?php declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Gacha;
use App\Models\Item;
use App\Models\Prize;
use Tests\TestCase;

class GachaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testDraw(): void
    {
        /** @var Gacha $gacha */
        $gacha = Gacha::first();
        $item = $gacha->draw();

        self::assertTrue($item->id > 0);
        self::assertTrue($item->id < 11);
    }

    public function testAddPrize(): void
    {
        $gacha = new Gacha();
        $gacha->name = 'test';
        $gacha->save();

        $item = Item::first();

        $prize = new Prize();
        $prize->probability = 1;
        $prize->item()->associate($item);

        $gacha->addPrize($prize);
        self::assertSame(1, $gacha->prizes()->count('id'));
    }
}
