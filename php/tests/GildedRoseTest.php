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

    public function testAllItemsHaveASellInValue(): void
    {
        $this->assertClassHasAttribute("sell_in", Item::class);
    }

    public function testAllItemsHaveAQualityValue(): void
    {
        $this->assertClassHasAttribute("quality", Item::class);
    }

    public function testWhenNextDayUpdateThenValueDecreasesByOne(): void
    {
        $quality = 1;
        $sell_in = 1;
        $items      = [new Item('Example', $quality, $sell_in)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality-1, $items[0]->quality);
        $this->assertEquals($sell_in-1, $items[0]->sell_in);
    }

    public function testWhenNextDayUpdateAndSellByPassedThenQualityValueDecreasesByTwo(): void
    {
        $quality = 2;
        $sell_in = 0;
        $items = [new Item('Example', $quality, $sell_in)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality-2, $items[0]->quality);
    }

    public function testWhenQualityIsZeroThenQualityDoesNotLower(): void
    {
        $quality = 0;
        $sell_in = 0;
        $items = [new Item('Example', $quality, $sell_in)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality, $items[0]->quality);
    }

    public function testWhenAgedBrieThenQualityIncreases(): void
    {
        $quality = 10;
        $items = [new Item("Aged Brie", 10, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality+1, $items[0]->quality);
    }

    public function testWhenSulfurasThenQualityAlwaysEightyAndSellInDoesNotDecrease(): void
    {
        $quality = 10;
        $sell_in = 10;
        $items = [new Item("Sulfuras, Hand of Ragnaros", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals($sell_in, $items[0]->sell_in);
    }

    public function testWhenBackstageTicketPassesAfterTenDaysThenQualityIncreaseByTwo(): void
    {
        $quality = 10;
        $sell_in = 10;
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality+2, $items[0]->quality);
    }

    public function testWhenBackstageTicketPassesAfterFiveDaysThenQualityIncreasesByThree(): void
    {
        $quality = 10;
        $sell_in = 5;
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality+3, $items[0]->quality);
    }

    public function testWhenBackstageTicketPassedThenQualityBecomesZero(): void
    {
        $quality = 10;
        $sell_in = 0;
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testAnItemCannotHaveMoreThanFiftyQuality(): void
    {
        $quality = 100;
        $sell_in = 10;
        $items = [new Item("Anything", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testAConjuredItemLosesTwiceTheQuality(): void
    {
        $quality = 10;
        $sell_in = 3;
        $items = [new Item("Conjured Item", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(8, $items[0]->quality);
    }

    public function testAllHailTheConjuredBrie(): void
    {
        $quality = 10;
        $sell_in = 4;
        $items = [new Item("Conjured Aged Brie", $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($quality+2, $items[0]->quality);
    }
}
