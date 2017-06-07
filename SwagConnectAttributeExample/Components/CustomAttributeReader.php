<?php


namespace SwagConnectAttributeExample\Components;


use Shopware\Components\Logger;
use Shopware\Connect\Struct\Product;

class CustomAttributeReader
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
     * Read the custom attribute if the client shop receives the product from connect
     *
     * @param Product $product
     * @return Product
     */
    public function read(Product $product)
    {
        //Receive product from connect and implement your own logic
        if ($product->customAttribute === 'My custom attribute') {
            $this->logger->addNotice(
                'READ ' . $product->title . ' with custom attribute ' . $product->customAttribute
            );
        }

        return $product;
    }
}