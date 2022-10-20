<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item as GoblinItem;

class AgedBrie extends BaseItem
{
    const NAME = 'Aged Brie';

    protected function UpdateQuality(): self
    {
        if ($this->itemData->quality < 50)
            $this->itemData->quality++;
        return $this;
    }

    protected function UpdateSellIn(): self
    {
        if ($this->itemData->sell_in > 0)
            $this->itemData->sell_in--;
        return $this;
    }
}