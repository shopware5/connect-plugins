<?php

namespace SwagConnectAttributeExample\OrderAttributes;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\Logger;
use Shopware\Connect\Struct\Order;

class OrderSubscriber implements SubscriberInterface
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Connect_Order_Checkout_Order' => 'event',
            'Shopware_Connect_Order_ProductFromShop_Buy' => 'buy_order'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return Order
     */
    public function buy_order(\Enlight_Event_EventArgs $args)
    {
        /** @var Order $order */
        $order = $args->getReturn();

        /** Process your order */
        $this->logger->addNotice('Order with customAttribute ' . $order->customAttribute);

        return $order;
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return Order
     */
    public function event(\Enlight_Event_EventArgs $args)
    {
        /** @var Order $order */
        $order = $args->getReturn();
        $order->customAttribute = 'test';
        return $order;
    }
}