<?php
namespace Vendor\ApiGetProductDetailModule\Api;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterface;

interface RelatedProductInterface
{
    /**
     * Get related products by SKU
     *
     * @param string $sku
     * @return \Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterface
     */
    public function getRelatedProducts(string $sku):RelatedProductResponseInterface;
}
