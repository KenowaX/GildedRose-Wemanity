<?php

declare(strict_types=1);

namespace GildedRose\Items;

class BackstagePasses extends BaseItem
{
    const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    protected array $qualityOverSellIn = [
        5 => 3,
        10 => 2
    ];

    protected function UpdateQuality(): self
    {
        foreach($this->qualityOverSellIn as $sellLimit => $upQuality)
            if ($this->itemData->sell_in <= $sellLimit)
                return $this->SetQuality($upQuality);
    }

    private function SetQuality(int $upQuality): self
    {
        $this->itemData->quality += $upQuality;
        if ($this->itemData->sell_in === 0)
            $this->itemData->quality = 0;
        return $this;
    }

    protected function UpdateSellIn(): self
    {
        $this->itemData->sell_in--;
        return $this;
    }
}