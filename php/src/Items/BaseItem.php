<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item as GoblinItem;
use GildedRose\Items\UpdatableInterface;

class BaseItem implements UpdatableInterface
{
    protected GoblinItem $itemData;
    protected bool $isConjured;

    protected function __construct(GoblinItem $itemData)
    {
        $this->isConjured = self::isConjured($itemData);
        $this->itemData = $itemData;
    }

    public static function create(GoblinItem $itemData): BaseItem
    {
        if (stripos($itemData->name, AgedBrie::NAME) !== false)
            return new AgedBrie($itemData);
        if (stripos($itemData->name, Sulfuras::NAME) !== false)
            return new Sulfuras($itemData);
        if (stripos($itemData->name, BackstagePasses::NAME) !== false)
                return new BackstagePasses($itemData);
        return new BaseItem($itemData);
    }

    protected static function isConjured(GoblinItem $itemData): bool
    {
        return stripos($itemData->name, 'conjured') !== false;
    }

    public function Update(): void
    {
        if ($this->isConjured)
            $this->updateQuality();

        $this
            ->updateQuality()
            ->updateSellIn()
            ->minQualityCheck()
            ->maxQualityCheck();
    }

    protected function minQualityCheck(): self
    {
        if ($this->itemData->quality < 0)
            $this->itemData->quality = 0;
        return $this;
    }

    protected function maxQualityCheck(): self
    {
        if ($this->itemData->quality > 50)
            $this->itemData->quality = 50;
        return $this;
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
        return $this->itemData->__toString();
    }
}