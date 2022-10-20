<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item as GoblinItem;

class Sulfuras extends BaseItem
{
    const NAME = 'Sulfuras, Hand of Ragnaros';
    
    public function __construct(GoblinItem $itemData)
    {
        $itemData->quality = 80;
        parent::__construct($itemData);
    }

    protected function UpdateQuality(): self
    {
        return $this;
    }

    protected function UpdateSellIn(): self
    {
        return $this;
    }
}