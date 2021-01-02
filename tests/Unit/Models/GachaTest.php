<?php declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Gacha;
use App\Models\Item;
use App\Models\Prize;
use App\Service\ItemBoxService;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class GachaTest extends TestCase
{
    use ProphecyTrait;

    /**
     * A basic unit test example.
     */
    public function testDraw(): void
    {
        $itemBox = $this->prophesize(ItemBoxService::class);
        $itemBox->isFull()->willReturn(false);


        /** @var Gacha $gacha */
        $gacha = Gacha::first();
        $item = $gacha->draw($itemBox->reveal());

        self::assertTrue($item->id > 0);
        self::assertTrue($item->id < 11);

        $itemBox->isFull()->shouldHaveBeenCalledTimes(1);
        $itemBox->add($item)->shouldHaveBeenCalledTimes(1);
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
