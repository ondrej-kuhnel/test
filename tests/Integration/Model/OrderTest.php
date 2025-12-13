<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Integration\Model;

use Acme\SyliusExamplePlugin\Model\FreeShippingOrderInterface;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class OrderTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
    }

    public function testSyliusUsesCustomOrderModel(): void
    {
        $orderClass = self::$kernel->getContainer()->getParameter('sylius.model.order.class');

        $this->assertSame(
            'Tests\Acme\SyliusExamplePlugin\Entity\Order\Order',
            $orderClass,
        );
    }

    public function testOrderFactoryCreatesFreeShippingOrder(): void
    {
        $orderFactory = self::$kernel->getContainer()->get('sylius.factory.order');
        $order = $orderFactory->createNew();

        $this->assertInstanceOf(FreeShippingOrderInterface::class, $order);
    }

    public function testOrderFromFactoryReturnsZeroShippingTotal(): void
    {
        $container = self::$kernel->getContainer();

        $orderFactory = $container->get('sylius.factory.order');
        $adjustmentFactory = $container->get('sylius.factory.adjustment');

        /** @var FreeShippingOrderInterface $order */
        $order = $orderFactory->createNew();

        /** @var AdjustmentInterface $shippingAdjustment */
        $shippingAdjustment = $adjustmentFactory->createNew();
        $shippingAdjustment->setType(AdjustmentInterface::SHIPPING_ADJUSTMENT);
        $shippingAdjustment->setAmount(1500);
        $shippingAdjustment->setLabel('FedEx');

        $order->addAdjustment($shippingAdjustment);

        $this->assertSame(0, $order->getShippingTotal());
    }
}
