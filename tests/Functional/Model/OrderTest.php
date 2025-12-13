<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Functional\Model;

use Acme\SyliusExamplePlugin\Model\FreeShippingOrderInterface;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Tests\Acme\SyliusExamplePlugin\Entity\Order\Order;

final class OrderTest extends TestCase
{
    public function testOrderImplementsFreeShippingOrderInterface(): void
    {
        $order = new Order();

        $this->assertInstanceOf(FreeShippingOrderInterface::class, $order);
    }

    public function testGetShippingTotalReturnsZeroEvenWithShippingAdjustment(): void
    {
        $order = new Order();

        $shippingAdjustment = new \Sylius\Component\Order\Model\Adjustment();
        $shippingAdjustment->setType(AdjustmentInterface::SHIPPING_ADJUSTMENT);
        $shippingAdjustment->setAmount(1000);
        $shippingAdjustment->setLabel('DHL Express');

        $order->addAdjustment($shippingAdjustment);

        $this->assertSame(0, $order->getShippingTotal());
    }
}
