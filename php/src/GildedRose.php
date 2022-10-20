<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItemQuality($item);
        }
    }

    protected function updateItemQuality(Item $item)
    {
        switch($item->name)
        {
            case 'Aged Brie':
                $this->updateAgedBrie($item);
                break;
            case 'Sulfuras, Hand of Ragnaros':
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                $this->updateBackstagePasses($item);
                break;
            default:
                $this->updateOtherItem($item);
                break;
        }
    }
    
    protected function updateAgedBrie(Item $item)
    {
        if ($item->quality < 50)
        {
            $item->quality++;
        }

        if ($item->sell_in > 0)
        {
            $item->sell_in--;
        }
    }

    protected function updateBackstagePasses(Item $item)
    {
        if ($item->sell_in <= 0)
        {
            $item->quality = 0;
            return;
        }

        if ($item->sell_in <= 10)
        {
            $item->quality++;
            $item->quality++;
        }
        
        if ($item->sell_in <= 5)
        {
            $item->quality++;
        }
    }

    protected function updateOtherItem(Item $item)
    {
        if ($item->quality > 0)
        {
            $item->quality--;
        }

        if ($item->sell_in > 0)
        {
            $item->sell_in--;
        }
    }
}
