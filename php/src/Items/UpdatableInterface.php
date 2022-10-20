<?php

declare(strict_types=1);

namespace GildedRose\Items;

interface UpdatableInterface
{
    public function Update(): void;
    public function __toString(): string;
}