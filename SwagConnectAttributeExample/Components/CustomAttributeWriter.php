<?php

namespace SwagConnectAttributeExample\Components;

use Shopware\Components\Logger;
use Shopware\Connect\Struct\Product;

class CustomAttributeWriter
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
     * Write into the custom attribute before it will be synced to the connect platform
     *
     * @param Product $product
     * @return Product
     */
    public function write(Product $product)
    {
        $this->logger->addNotice('WRITE ' . $product->title);

        $product->customAttribute = 'My custom attribute';
        return $product;
    }
}