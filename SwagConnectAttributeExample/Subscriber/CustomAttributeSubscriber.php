<?php

namespace SwagConnectAttributeExample\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Connect\Struct\Product;
use SwagConnectAttributeExample\Components\CustomAttributeReader;
use SwagConnectAttributeExample\Components\CustomAttributeWriter;

class CustomAttributeSubscriber implements SubscriberInterface
{
    /**
     * @var CustomAttributeWriter
     */
    private $writer;

    /**
     * @var CustomAttributeReader
     */
    private $reader;

    /**
     * @param CustomAttributeWriter $writer
     * @param CustomAttributeReader $reader
     */
    public function __construct(CustomAttributeWriter $writer, CustomAttributeReader $reader)
    {
        $this->writer = $writer;
        $this->reader = $reader;
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

        //Implement your own logic to process custom attributes from connect
        return $this->reader->read($product);
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function addCustomAttributeData(\Enlight_Event_EventArgs $args)
    {
        /** @var Product $product */
        $product = $args->get('product');

        //Implement your own logic to add custom attributes
        $this->writer->write($product);
    }
}