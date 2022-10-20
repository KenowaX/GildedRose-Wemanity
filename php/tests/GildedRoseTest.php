<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('fixme', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('fixme', $items[0]->name);
    }

    public function testAllItemsHaveASellInValue()
    {
        $this->assertClassHasAttribute("sell_in", Item::class);
    }

    public function testAllItemsHaveAQualityValue()
    {
        $this->assertClassHasAttribute("quality", Item::class);
    }

    public function testWhenNextDayUpdateThenValueDecreasesByOne()
    {
        $quality = 1;
        $sell_in = 1;
        $items      = [new Item('Example', $quality, $sell_in)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality-1, $items[0]->quality);
        $this->assertEquals($sell_in-1, $items[0]->sell_in);
    }


}
