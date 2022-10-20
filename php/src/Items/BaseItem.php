<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item as GoblinItem;
use GildedRose\Items\UpdatableInterface;

class BaseItem implements UpdatableInterface
{
    protected GoblinItem $itemData;

    protected function __construct(GoblinItem $itemData)
    {
        $this->itemData = $itemData;
    }

    public static function create(GoblinItem $itemData): BaseItem
    {
        switch($itemData->name)
        {
            case AgedBrie::NAME:
                return new AgedBrie($itemData);
            case Sulfuras::NAME:
                return new Sulfuras($itemData);
            case BackstagePasses::NAME:
                return new BackstagePasses($itemData);
            default:
                return new BaseItem($itemData);
        }
    }

    public function Update()
    {
        $this
            ->updateQuality()
            ->updateSellIn();
    }

    protected function UpdateQuality(): self
    {
        if ($this->itemData->quality > 0)
            $this->itemData->quality--;
        return $this;
    }

    protected function UpdateSellIn(): self
    {
        if ($this->itemData->sell_in > 0)
            $this->itemData->sell_in--;
        return $this;
    }

    public function __toString(): string
    {
        return $this->item->__toString();
    }
}