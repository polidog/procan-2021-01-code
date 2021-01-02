<?php declare(strict_types=1);

namespace Tests\Unit\Gacha;

use App\Gacha\Gacha;
use App\Gacha\Item;
use App\Gacha\ItemBox;
use App\Gacha\Prize;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class GachaTest extends TestCase
{
    use ProphecyTrait;

    public function testDraw(): void
    {
        $gacha = new Gacha();
        $item = new Item();

        $itemBox = $this->prophesize(ItemBox::class);
        $itemBox->isFull()->willReturn(false);

        $prize = $this->prophesize(Prize::class);
        $prize->getProbability()->willReturn(1);
        $prize->getItem()->willReturn($item);

        $gacha->addPrize($prize->reveal());
        $item = $gacha->draw($itemBox->reveal());

        $prize->getProbability()->shouldHaveBeenCalledTimes(2);
        $prize->getItem()->shouldHaveBeenCalledTimes(1);

        $itemBox->isFull()->shouldHaveBeenCalledTimes(1);
        $itemBox->add($item)->shouldHaveBeenCalledTimes(1);
    }

    public function testHasPrizes(): void
    {
        $gacha = new Gacha();

        foreach (range(1, 10) as $_) {
            $gacha->addPrize(new Prize(new Item(), 10));
        }

        self::assertTrue($gacha->hasPrizes());
    }
}
