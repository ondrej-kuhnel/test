<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Unit\Model;

use Acme\SyliusExamplePlugin\Model\FreeShippingOrderTrait;
use PHPUnit\Framework\TestCase;

final class FreeShippingOrderTraitTest extends TestCase
{
    public function testGetShippingTotalReturnsZero(): void
    {
        $order = new class {
            use FreeShippingOrderTrait;
        };

        $this->assertSame(0, $order->getShippingTotal());
    }
}
