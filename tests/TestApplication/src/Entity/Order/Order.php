<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Entity\Order;

use Acme\SyliusExamplePlugin\Model\FreeShippingOrderInterface;
use Acme\SyliusExamplePlugin\Model\FreeShippingOrderTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Order as BaseOrder;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_order')]
class Order extends BaseOrder implements FreeShippingOrderInterface
{
    use FreeShippingOrderTrait;
}
