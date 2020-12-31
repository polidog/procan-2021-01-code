<?php declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Gacha;
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
}
