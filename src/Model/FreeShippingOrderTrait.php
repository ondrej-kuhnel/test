<?php

declare(strict_types=1);

namespace Acme\SyliusExamplePlugin\Model;

trait FreeShippingOrderTrait
{
    public function getShippingTotal(): int
    {
        return 0;
    }
}
