<?php

namespace SwagConnectAttributeExample\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\Logger;
use Shopware\Connect\Struct\Product;

class CustomAttributeSubscriber implements SubscriberInterface
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
            'Connect_ProductToShop_InsertOrUpdate_Before' => 'readCustomAttributeFromConnectProduct',
            'Connect_Supplier_Get_Single_Product_Before' => 'addCustomAttributeData'
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @return Product
     */
    public function readCustomAttributeFromConnectProduct(\Enlight_Event_EventArgs $args)
    {
        /** @var Product $product */
        $product = $args->getReturn();

        //Receive product from connect and implement your own logic
        if ($product->customAttribute === 'My custom attribute') {
            $this->logger->addNotice(
                'READ ' . $product->title . ' with custom attribute ' . $product->customAttribute
            );
        }

        return $product;
    }

    /**
     * Write into the custom attribute before it will be synced to the connect platform
     *
     * @param \Enlight_Event_EventArgs $args
     * @return Product
     */
    public function addCustomAttributeData(\Enlight_Event_EventArgs $args)
    {
        /** @var Product $product */
        $product = $args->get('product');

        $this->logger->addNotice('WRITE ' . $product->title);

        $product->customAttribute = 'My custom attribute';
        return $product;
    }
}