<?php

namespace SwagConnectAttributeExample\OrderAttributes;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\Logger;
use Shopware\Connect\Struct\Order;

class OrderAttributeSubscriber implements SubscriberInterface
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
            'Connect_Subscriber_OrderReservation_OrderFilter' => 'addOrderAttributes',
            'Connect_Components_ProductFromShop_Buy_OrderFilter' => 'readOrderAttributes'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return Order
     */
    public function readOrderAttributes(\Enlight_Event_EventArgs $args)
    {
        /** @var Order $order */
        $order = $args->getReturn();

        /** Process your order */
        $this->logger->addNotice('READ ORDER: with customAttribute ' . $order->customAttribute);

        return $order;
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return Order
     */
    public function addOrderAttributes(\Enlight_Event_EventArgs $args)
    {
        /** @var Order $order */
        $order = $args->getReturn();

        $order->customAttribute = 'test';
        $this->logger->addNotice('WRITE ORDER: with customAttribute ' . $order->customAttribute);

        return $order;
    }
}