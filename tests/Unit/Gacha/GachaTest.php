<?php declare(strict_types=1);

namespace Tests\Unit\Gacha;

use App\Gacha\Gacha;
use App\Gacha\Item;
use App\Gacha\Prize;
use PHPUnit\Framework\TestCase;

class GachaTest extends TestCase
{
    public function testDraw(): void
    {
        $gacha = new Gacha();
        $item = new Item();

        $prize = $this->prophesize(Prize::class);
        $prize->getProbability()->willReturn(1);
        $prize->getItem()->willReturn($item);

        $gacha->addPrize($prize->reveal());
        $gacha->draw();

        $prize->getProbability()->shouldHaveBeenCalledTimes(2);
        $prize->getItem()->shouldHaveBeenCalledTimes(1);
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
