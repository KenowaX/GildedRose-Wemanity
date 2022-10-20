<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\BaseItem;

final class GildedRose
{
    /**
     * @var BaseItem[]
     */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = array_map(fn($item) => BaseItem::create($item), $items);
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item)
            $item->Update();
    }
}
